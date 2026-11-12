#!/usr/bin/env node
/**
 * Converts the curated JPEGs in assets/photos/ to WebP at three widths and
 * writes them to elivation/assets/photos/ as <name>-<width>.webp.
 * Also copies picks.txt (descriptions and consent notes) next to them.
 *
 * Usage: node tools/build-photos.mjs
 * Requires: npm install (sharp)
 */
import { readdirSync, mkdirSync, copyFileSync, statSync, writeFileSync } from 'node:fs';
import { dirname, join, resolve, basename, extname } from 'node:path';
import { fileURLToPath } from 'node:url';
import sharp from 'sharp';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const srcDir = join(root, 'assets', 'photos');
const outDir = join(root, 'elivation', 'assets', 'photos');

const WIDTHS = [800, 1400, 2000];
const QUALITY = 70;

mkdirSync(outDir, { recursive: true });

const files = readdirSync(srcDir).filter((f) => /\.(jpe?g|png)$/i.test(f)).sort();
if (!files.length) {
  console.error(`No source photos found in ${srcDir}`);
  process.exit(1);
}

const manifest = {};
let total = 0;

for (const file of files) {
  const name = basename(file, extname(file));
  const input = sharp(join(srcDir, file)).rotate(); // apply EXIF orientation
  const meta = await input.metadata();
  const longEdgeIsWidth = meta.width >= meta.height;
  manifest[name] = { width: meta.width, height: meta.height, sizes: [] };

  for (const w of WIDTHS) {
    // Width-based sizes. Never upscale past the source.
    const target = Math.min(w, meta.width);
    const out = join(outDir, `${name}-${w}.webp`);
    const info = await input
      .clone()
      .resize({ width: target, withoutEnlargement: true })
      .webp({ quality: QUALITY, effort: 5 })
      .toFile(out);
    total += info.size;
    manifest[name].sizes.push({ width: info.width, height: info.height, file: `${name}-${w}.webp` });
  }
  const kb = manifest[name].sizes.map((s) => Math.round(statSync(join(outDir, s.file)).size / 1024));
  console.log(
    `${name.padEnd(13)} ${meta.width}x${meta.height} ${longEdgeIsWidth ? 'landscape' : 'portrait '} -> ${kb.join(' / ')} KB`
  );
}

copyFileSync(join(srcDir, 'picks.txt'), join(outDir, 'picks.txt'));
writeFileSync(join(outDir, 'manifest.json'), JSON.stringify(manifest, null, 2) + '\n');
console.log(`\n${files.length} photos, ${files.length * WIDTHS.length} WebP files, ${(total / 1e6).toFixed(1)} MB total`);
