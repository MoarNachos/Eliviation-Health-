#!/usr/bin/env node
/**
 * Copies content/reviews.json (the verbatim reviews taken from the live site)
 * into the theme as elivation/assets/reviews.json, where patterns/reviews.php reads it.
 *
 * Usage: node tools/build-reviews.mjs
 */
import { readFileSync, writeFileSync } from 'node:fs';
import { dirname, join, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const src = join(root, 'content', 'reviews.json');
const dest = join(root, 'elivation', 'assets', 'reviews.json');

const data = JSON.parse(readFileSync(src, 'utf8'));
for (const r of data.reviews) {
	if (!r.id || !r.author || !r.text) throw new Error(`Review is missing id, author or text: ${JSON.stringify(r)}`);
}
writeFileSync(dest, JSON.stringify(data, null, 2) + '\n');
console.log(`Wrote ${data.reviews.length} reviews to ${dest}`);
