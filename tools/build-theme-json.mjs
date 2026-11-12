#!/usr/bin/env node
/**
 * Generates elivation/theme.json and elivation/assets/css/tokens.css from the
 * design-system tokens in tokens/*.css.
 *
 * The tokens are the single source of truth. To change the palette (for
 * example, to switch the primary palette to navy), edit tokens/colors.css and
 * run `npm run tokens`. Nothing else needs to change: theme.css only refers to
 * tokens through var().
 *
 * Usage: node tools/build-theme-json.mjs
 */
import { readFileSync, writeFileSync, mkdirSync } from 'node:fs';
import { dirname, join, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const tokensDir = join(root, 'tokens');
const themeDir = join(root, 'elivation');

const read = (name) => readFileSync(join(tokensDir, name), 'utf8');

/** Parse `--name: value;` declarations out of a CSS file, in order. */
function parseTokens(css) {
  const out = [];
  const stripped = css.replace(/\/\*[\s\S]*?\*\//g, '');
  const re = /(--[a-z0-9-]+)\s*:\s*([^;]+);/gi;
  let m;
  while ((m = re.exec(stripped))) out.push([m[1], m[2].trim()]);
  return out;
}

const colors = parseTokens(read('colors.css'));
const typography = parseTokens(read('typography.css'));
const spacing = parseTokens(read('spacing.css'));
const effects = parseTokens(read('effects.css'));

const isRawColor = (v) => /^#[0-9a-f]{3,8}$/i.test(v);
const title = (slug) =>
  slug.replace(/-/g, ' ').replace(/\b\w/g, (c) => c.toUpperCase());

/* ---------- Colors ---------- */
// Base palette entries are the tokens with a literal hex value.
const palette = colors
  .filter(([, v]) => isRawColor(v))
  .map(([name, v]) => {
    const slug = name.slice(2);
    return { slug, name: title(slug), color: v.toUpperCase() };
  });

// Semantic tokens (surface, text, border, action) point at base tokens.
// They are exposed as --wp--custom--color--* and resolve through tokens.css.
const semantic = {};
for (const [name, v] of colors) {
  if (isRawColor(v) || name === '--focus-ring') continue;
  semantic[name.slice(2)] = /^var\(/.test(v) ? `var(${name})` : v;
}

/* ---------- Typography ---------- */
const get = (list, name) => (list.find(([n]) => n === name) || [])[1];

const fontFamilies = [
  ['display', 'Display (Bricolage Grotesque)', '--font-display'],
  ['serif', 'Serif (Instrument Serif)', '--font-serif'],
  ['body', 'Body (Figtree)', '--font-body'],
  ['mono', 'Mono (DM Mono)', '--font-mono'],
].map(([slug, name, token]) => ({
  slug,
  name,
  fontFamily: get(typography, token).replace(/'/g, '"'),
}));

const sizeNames = {
  'display-xl': 'Display XL',
  'display-l': 'Display L',
  h1: 'Heading 1',
  h2: 'Heading 2',
  h3: 'Heading 3',
  h4: 'Heading 4',
  'body-l': 'Body large',
  body: 'Body',
  'body-s': 'Body small',
  caption: 'Caption',
  eyebrow: 'Eyebrow',
};
const fontSizes = typography
  .filter(([n]) => n.startsWith('--fs-'))
  .map(([n, v]) => {
    const slug = n.slice(5);
    return { slug, name: sizeNames[slug] || title(slug), size: v, fluid: false };
  });

/* ---------- Spacing ---------- */
const spacingSizes = spacing
  .filter(([n]) => /^--space-\d+$/.test(n))
  .map(([n, v]) => {
    const step = n.replace('--space-', '');
    return { slug: step, name: `Space ${step} (${v})`, size: v };
  });

/* ---------- Radii, shadows, motion ---------- */
const radius = Object.fromEntries(
  effects.filter(([n]) => n.startsWith('--radius-')).map(([n, v]) => [n.slice(9), v])
);
const shadowPresets = effects
  .filter(([n]) => /^--shadow-\d$/.test(n))
  .map(([n, v]) => ({ slug: n.slice(9), name: `Shadow ${n.slice(9)}`, shadow: v }));

const theme = {
  $schema: 'https://schemas.wp.org/trunk/theme.json',
  version: 3,
  settings: {
    appearanceTools: true,
    useRootPaddingAwareAlignments: false,
    layout: {
      contentSize: get(spacing, '--container-max'),
      wideSize: get(spacing, '--container-max'),
    },
    color: {
      defaultPalette: false,
      defaultGradients: false,
      defaultDuotone: false,
      custom: false,
      customGradient: false,
      palette,
    },
    typography: {
      fluid: false,
      defaultFontSizes: false,
      customFontSize: false,
      fontFamilies,
      fontSizes,
    },
    spacing: {
      defaultSpacingSizes: false,
      units: ['px', 'rem', '%', 'vw'],
      spacingSizes,
    },
    shadow: {
      defaultPresets: false,
      presets: shadowPresets,
    },
    custom: {
      color: semantic,
      radius: {
        ...radius,
        // README: 28px for hero photos and feature cards, 12px for inputs.
        photo: '28px',
        input: '12px',
      },
      layout: {
        sectionY: get(spacing, '--section-y'),
        gutter: get(spacing, '--gutter'),
        pageMargin: get(spacing, '--page-margin'),
        containerMax: get(spacing, '--container-max'),
        containerText: get(spacing, '--container-text'),
        tapMin: get(spacing, '--tap-min'),
      },
      motion: {
        easeOut: get(effects, '--ease-out'),
        easeSpring: get(effects, '--ease-spring'),
        durFast: get(effects, '--dur-fast'),
        durBase: get(effects, '--dur-base'),
        durSlow: get(effects, '--dur-slow'),
      },
      lineHeight: {
        tight: get(typography, '--lh-tight'),
        snug: get(typography, '--lh-snug'),
        body: get(typography, '--lh-body'),
      },
      letterSpacing: {
        display: get(typography, '--ls-display'),
        heading: get(typography, '--ls-heading'),
        eyebrow: get(typography, '--ls-eyebrow'),
      },
    },
  },
  styles: {
    color: {
      background: 'var(--surface-page)',
      text: 'var(--text-body)',
    },
    typography: {
      fontFamily: 'var(--wp--preset--font-family--body)',
      fontSize: 'var(--wp--preset--font-size--body)',
      lineHeight: 'var(--wp--custom--line-height--body)',
    },
    spacing: {
      blockGap: '0px',
      padding: { top: '0px', right: '0px', bottom: '0px', left: '0px' },
    },
    elements: {
      heading: {
        typography: {
          fontFamily: 'var(--wp--preset--font-family--display)',
          fontWeight: '700',
          lineHeight: 'var(--wp--custom--line-height--snug)',
          letterSpacing: 'var(--wp--custom--letter-spacing--heading)',
        },
        color: { text: 'var(--text-strong)' },
      },
      h1: { typography: { fontSize: 'var(--wp--preset--font-size--h-1)' } },
      h2: { typography: { fontSize: 'var(--wp--preset--font-size--h-2)' } },
      h3: { typography: { fontSize: 'var(--wp--preset--font-size--h-3)' } },
      h4: { typography: { fontSize: 'var(--wp--preset--font-size--h-4)' } },
      link: {
        color: { text: 'var(--text-link)' },
        ':hover': { color: { text: 'var(--text-link-hover)' } },
      },
      button: {
        color: {
          background: 'var(--action-primary)',
          text: 'var(--text-on-accent)',
        },
        border: { radius: 'var(--wp--custom--radius--pill)', width: '0' },
        typography: {
          fontFamily: 'var(--wp--preset--font-family--body)',
          fontSize: '17px',
          fontWeight: '600',
          lineHeight: '1',
        },
        spacing: {
          padding: { top: '16px', right: '28px', bottom: '16px', left: '28px' },
        },
        ':hover': { color: { background: 'var(--action-primary-hover)' } },
        ':active': { color: { background: 'var(--action-primary-press)' } },
      },
    },
  },
  templateParts: [
    { name: 'header', title: 'Header', area: 'header' },
    { name: 'footer', title: 'Footer', area: 'footer' },
  ],
  customTemplates: [
    { name: 'treatment', title: 'Treatment landing page', postTypes: ['page'] },
  ],
};

/* ---------- Write theme.json ---------- */
mkdirSync(themeDir, { recursive: true });
writeFileSync(join(themeDir, 'theme.json'), JSON.stringify(theme, null, '\t') + '\n');

/* ---------- Write tokens.css (colors, typography, spacing, effects, base) ---------- */
// fonts.css is skipped on purpose: Google Fonts are enqueued from functions.php.
const banner =
  '/* GENERATED by tools/build-theme-json.mjs from tokens/*.css. Do not edit here.\n' +
  '   Edit the files in tokens/ and run `npm run tokens`. */\n';
const tokensCss =
  banner +
  ['colors.css', 'typography.css', 'spacing.css', 'effects.css', 'base.css']
    .map((f) => `\n/* ---- tokens/${f} ---- */\n${read(f).trim()}\n`)
    .join('');
mkdirSync(join(themeDir, 'assets', 'css'), { recursive: true });
writeFileSync(join(themeDir, 'assets', 'css', 'tokens.css'), tokensCss);

console.log(
  `theme.json: ${palette.length} colors, ${fontFamilies.length} font families, ` +
    `${fontSizes.length} font sizes, ${spacingSizes.length} spacing steps, ` +
    `${shadowPresets.length} shadows, ${Object.keys(radius).length} radii, ` +
    `${Object.keys(semantic).length} semantic colors`
);
console.log('tokens.css written to elivation/assets/css/tokens.css');
