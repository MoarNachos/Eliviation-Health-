#!/usr/bin/env node
/** Rebuild approved crops directly from the copied originals, preserving their exact framing. */
import fs from 'node:fs';
import sharp from 'sharp';
import { fileURLToPath } from 'node:url';

const out = fileURLToPath(new URL('../assets/photos/candidates/', import.meta.url));
const longEdges = [800, 1400, 2000];
const specs = [
  {
    source: '20250819_194922.jpg', category: 'nurse-at-home', name: 'home-visit-couch-1',
    crops: [
      ['16x10', { left: 400, top: 430, width: 3600, height: 2250 }],
      ['4x5', { left: 2080, top: 400, width: 1920, height: 2400 }],
    ],
  },
  {
    source: '20260913_154900.jpg', category: 'events', name: 'group-event-guest-nurse-1',
    crops: [
      ['4x5', { left: 1400, top: 900, width: 1680, height: 2100 }],
      ['1x1', { left: 1400, top: 950, width: 2050, height: 2050 }],
    ],
  },
];
const manifest = [];
for (const spec of specs) {
  const original = `${out}${spec.category}/${spec.name}.jpg`;
  for (const [ratio, rect] of spec.crops) {
    const stem = `${spec.category}/${spec.name}-${ratio}`;
    await sharp(original).rotate().extract(rect)
      .resize({ width: 2000, height: 2000, fit: 'inside' })
      .jpeg({ quality: 80 }).toFile(out + stem + '.jpg');
    const variants = [];
    for (const size of longEdges) {
      const file = `${stem}-${size}.webp`;
      const info = await sharp(original).rotate().extract(rect)
        .resize({ width: size, height: size, fit: 'inside' })
        .webp({ quality: 78, effort: 6 }).toFile(out + file);
      variants.push({ file, width: info.width, height: info.height, bytes: info.size });
    }
    manifest.push({ source: spec.source, crop: stem, rect, jpegQuality: 80, webpQuality: 78, longEdges, variants });
  }
}
fs.writeFileSync(out + 'crop-review.json', JSON.stringify({
  status: 'Crop compromises approved by user on 2026-11-15', crops: manifest,
}, null, 2));
