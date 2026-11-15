#!/usr/bin/env node
/**
 * Converts the curated JPEGs in assets/photos/ to WebP at three widths and
 * writes them to elivation/assets/photos/ as <name>-<width>.webp.
 * Also copies picks.txt (descriptions and consent notes) next to them.
 *
 * Usage: node tools/build-photos.mjs
 * Requires: npm install (sharp)
 */
import { readdirSync, mkdirSync, copyFileSync, statSync, writeFileSync, readFileSync } from 'node:fs';
import { dirname, join, resolve, basename, extname } from 'node:path';
import { fileURLToPath } from 'node:url';
import sharp from 'sharp';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const srcDir = join(root, 'assets', 'photos');
const outDir = join(root, 'elivation', 'assets', 'photos');

const WIDTHS = [800, 1400, 2000];
const QUALITY = 78;

mkdirSync(outDir, { recursive: true });

const cropReview = JSON.parse(readFileSync(join(srcDir, 'candidates/crop-review.json'), 'utf8'));
const cropInputs = new Set(cropReview.crops.flatMap(c => [c.crop + '.jpg', c.crop.replace(/-(16x10|4x5|1x1)$/, '') + '.jpg']));
const files = readdirSync(srcDir, { recursive: true }).filter((f) => /\.(jpe?g|png)$/i.test(f) && !cropInputs.has(f.replace(/^candidates\//, ''))).sort();
const portraits = ['richard-ladines.webp', 'team/kathy-tran.png', 'team/jon-lai.png', 'team/charles-antis.png', 'team/eric-l-goodman.png'];
const sources = files.map(file => ({ name: basename(file, extname(file)), path: join(srcDir, file) }));
for (const file of portraits) sources.push({ name: 'portrait-' + basename(file, extname(file)), path: join(root, 'elivation/assets/images', file) });
if (new Set(sources.map(s => s.name)).size !== sources.length) throw new Error('Duplicate photo basenames');
if (!files.length) {
  console.error(`No source photos found in ${srcDir}`);
  process.exit(1);
}

const manifest = {};
let total = 0;

for (const { name, path } of sources) {
  const input = sharp(path).rotate(); // apply EXIF orientation
  const meta = await input.metadata();
  const rotated = [5, 6, 7, 8].includes(meta.orientation);
  const width = rotated ? meta.height : meta.width;
  const height = rotated ? meta.width : meta.height;
  const longEdgeIsWidth = width >= height;
  manifest[name] = { width, height, quality: QUALITY, sizes: [] };

  for (const w of WIDTHS) {
    // Width-based sizes. Never upscale past the source.
    const target = Math.min(w, width);
    const out = join(outDir, `${name}-${w}.webp`);
    const info = await input
      .clone()
      .resize({ width: target, withoutEnlargement: true })
      .webp({ quality: QUALITY, effort: 6 })
      .toFile(out);
    total += info.size;
    manifest[name].sizes.push({ width: info.width, height: info.height, file: `${name}-${w}.webp`, bytes: info.size });
  }
  const kb = manifest[name].sizes.map((s) => Math.round(statSync(join(outDir, s.file)).size / 1024));
  console.log(
    `${name.padEnd(13)} ${meta.width}x${meta.height} ${longEdgeIsWidth ? 'landscape' : 'portrait '} -> ${kb.join(' / ')} KB`
  );
}

// Approved crops are encoded directly from the copied originals, never from lossy JPEG exports.
for (const crop of cropReview.crops) {
  const name = basename(crop.crop);
  manifest[name] = { width: crop.rect.width, height: crop.rect.height, quality: QUALITY, sizes: [] };
  for (const variant of crop.variants) {
    const file = basename(variant.file);
    copyFileSync(join(srcDir, 'candidates', variant.file), join(outDir, file));
    manifest[name].sizes.push({ width: variant.width, height: variant.height, file, bytes: variant.bytes });
    total += variant.bytes;
  }
}

// Logos and trust badges are graphics rather than photo srcsets; retain their intrinsic dimensions.
for (const name of ['logo-navy', 'logo-white', 'hipaa-silver', 'doctor-owned-silver']) {
  await sharp(join(root, 'elivation/assets/images', name + '.png')).webp({quality: QUALITY, effort: 6}).toFile(join(root, 'elivation/assets/images', name + '.webp'));
}
copyFileSync(join(srcDir, 'picks.txt'), join(outDir, 'picks.txt'));
writeFileSync(join(outDir, 'manifest.json'), JSON.stringify(manifest, null, 2) + '\n');
console.log(`\n${Object.keys(manifest).length} photos/crops, ${Object.values(manifest).reduce((n, p) => n + p.sizes.length, 0)} WebP files, ${(total / 1e6).toFixed(1)} MB total`);
