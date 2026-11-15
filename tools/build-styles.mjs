#!/usr/bin/env node
// One minified stylesheet avoids three render-blocking requests; source CSS stays editable.
import { readFileSync, writeFileSync } from 'node:fs';
import { fileURLToPath } from 'node:url';
import { transform } from 'lightningcss';
const dir = new URL('../elivation/assets/css/', import.meta.url);
const code = ['fonts.css', 'tokens.css', 'theme.css'].map(f => readFileSync(new URL(f, dir), 'utf8')).join('\n');
const result = transform({ filename: fileURLToPath(new URL('site.css', dir)), code: Buffer.from(code), minify: true });
writeFileSync(new URL('site.css', dir), result.code);
console.log(`site.css: ${Math.round(result.code.length / 1024)} KiB`);
