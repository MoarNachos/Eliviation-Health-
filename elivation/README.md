# Elivation WordPress block theme

The new elivationhealth.com homepage as a block theme. Built from `design_handoff_homepage/` and the design tokens in `tokens/`.

## Run it locally

You need Node 18+ either way. From the repo root:

```bash
npm install
```

**Option A: wp-env (needs Docker Desktop running)**

```bash
npm run start        # starts WordPress at http://localhost:8888 and activates the theme
npm run stop
```

Admin is at `http://localhost:8888/wp-admin` (user `admin`, password `password`).

**Option B: WordPress Playground (no Docker)**

```bash
npm run playground   # prints a local URL; the theme is mounted and activated
```

**Option C: an existing WordPress site**

Copy or symlink the `elivation/` folder into `wp-content/themes/`, then activate "Elivation" under Appearance > Themes. Requires WordPress 6.6 or newer.

The homepage shows as soon as the theme is active: `templates/front-page.html` is used for the site front page.

Add `?debug=1` to any URL for an on-page debug panel (tokens, fonts, heading count, alt text, JSON-LD, photo failures, form payloads).

## How it is put together

| Path | What it is |
|------|------------|
| `theme.json` | **Generated** from `tokens/*.css`. Palette, font families and sizes, spacing, shadows, radii |
| `assets/css/tokens.css` | **Generated** copy of the tokens as CSS custom properties |
| `assets/css/theme.css` | Layout and components. Colors come from tokens only |
| `assets/js/theme.js` | Mobile menu, scroll reveal, ZIP check, event form check, debug panel |
| `assets/photos/` | **Generated** WebP files (800, 1400, 2000px) plus `picks.txt` and `manifest.json` |
| `functions.php` | Fonts, styles, photo `srcset`, hero preload, `MedicalBusiness` JSON-LD |
| `patterns/` | One pattern per homepage section, plus header and footer |
| `templates/front-page.html` | Assembles the section patterns |
| `parts/` | Header and footer template parts |
| `TODO.md` | Every open item: content to verify, consent flags, things not wired up |

## Rebuilding generated files

```bash
npm run tokens   # tokens/*.css -> theme.json and assets/css/tokens.css
npm run photos   # assets/photos/*.jpg -> elivation/assets/photos/*.webp
```

## Changing the palette (for example, to navy)

Edit the values in `tokens/colors.css`, run `npm run tokens`, and reload. `theme.css` has no color literals, so nothing else needs to change.

## Editing content

Each section is a pattern in `patterns/`. Edit the PHP file to change it everywhere, or open Appearance > Editor to change it in WordPress. The header, footer, ZIP card and event form are Custom HTML blocks; everything else is standard blocks (group, heading, paragraph, image, list, buttons, quote).

## Known differences from the reference

- Gallery uses four columns on desktop. The reference's auto-fit grid gives five at 1280px and leaves a ragged second row.
- "How it works" has top padding. In the reference its rules sit flush against the bottom of the hero photo.
- Card and form shadows use the `--shadow-2` and `--shadow-3` tokens. The reference hardcodes slightly different values.
- Dead `#` links point at the booking site or a page section; "Meet the full team" is left out until that page exists.
