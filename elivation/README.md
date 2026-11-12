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

**Treatment pages.** Activating the theme creates three pages: `/treatments/recovery`, `/treatments/relief` and `/treatments/rejuvenation`. If the theme was already active, they are created the first time an administrator opens wp-admin. They use `templates/treatment.html`. Permalinks must be set to anything other than "Plain" (Settings > Permalinks, for example "Post name"). On a treatment page, every Book button opens the in-page booking drawer.

Add `?debug=1` to any URL for an on-page debug panel (tokens, fonts, heading count, alt text, JSON-LD, photo failures, form payloads).

## How it is put together

| Path | What it is |
|------|------------|
| `theme.json` | **Generated** from `tokens/*.css`. Palette, font families and sizes, spacing, shadows, radii |
| `assets/css/tokens.css` | **Generated** copy of the tokens as CSS custom properties |
| `assets/css/theme.css` | Layout and components. Colors come from tokens only |
| `assets/js/theme.js` | Mobile menu, scroll reveal, ZIP check, event form check, debug panel |
| `assets/photos/` | **Generated** WebP files (800, 1400, 2000px) plus `picks.txt` and `manifest.json` |
| `assets/reviews.json` | **Generated** copy of `content/reviews.json` (verbatim client reviews) |
| `functions.php` | Fonts, styles, photo `srcset`, hero preload, `MedicalBusiness` JSON-LD |
| `patterns/` | One pattern per homepage section, plus header and footer. `treatment-*.php` are the treatment page sections |
| `inc/treatments.php` | Treatment data (drips, prices, FAQs), page creation, title, meta description, `MedicalBusiness` + `Service` + `FAQPage` JSON-LD |
| `templates/treatment.html` | Treatment landing page: hero, who it's for, drip menu, how a visit works, safety, FAQ, cross-sell, closing band (shared service-areas pattern), booking drawer |
| `templates/front-page.html` | Assembles the section patterns |
| `parts/` | Header and footer template parts |
| `TODO.md` | Every open item: content to verify, consent flags, things not wired up |

## Rebuilding generated files

```bash
npm run tokens   # tokens/*.css -> theme.json and assets/css/tokens.css
npm run photos   # assets/photos/*.jpg -> elivation/assets/photos/*.webp
npm run reviews  # content/reviews.json -> elivation/assets/reviews.json
```

## Changing the palette

The palette is navy + sky (from the logo) with coral for primary buttons.

Edit the values in `tokens/colors.css`, run `npm run tokens`, and reload. `theme.css` has no color literals, so nothing else needs to change.

## Editing content

Drips, prices, "good for" lines and FAQs for the treatment pages live in one place: `elivation_treatments()` in `inc/treatments.php`.

Each section is a pattern in `patterns/`. Edit the PHP file to change it everywhere, or open Appearance > Editor to change it in WordPress. The header, footer, ZIP card and event form are Custom HTML blocks; everything else is standard blocks (group, heading, paragraph, image, list, buttons, quote).

## Known differences from the reference

- Gallery uses four columns on desktop. The reference's auto-fit grid gives five at 1280px and leaves a ragged second row.
- "How it works" has top padding. In the reference its rules sit flush against the bottom of the hero photo.
- Card and form shadows use the `--shadow-2` and `--shadow-3` tokens. The reference hardcodes slightly different values.
- Dead `#` links point at the booking site or a page section; "Meet the full team" is left out until that page exists.

## FAQ and organic search

The theme creates a published WordPress page at `/faq/` on activation. For an existing installation, open wp-admin once as a user with permission to publish pages after updating the theme. An existing FAQ record keeps its ID and publication status. The answers rendered by `patterns/faq-page.php` and the FAQ structured data both use `elivation_faq_groups()` in `inc/faq.php`. The source for individual treatment prices and durations is `inc/treatments.php`.

The canonical production site is `https://www.elivationhealth.com/`. For a static copy of the Viacopia preview, set `WP_ENVIRONMENT_TYPE` to `staging` **when rendering the export** so the saved HTML includes `noindex`. The same directive is applied when WordPress is served from the Viacopia preview URL. Use the production environment and the real site URL for the live deployment. Production respects WordPress and SEO-plugin indexing settings.

After deployment, check the homepage, FAQ and three treatments in Search Console URL Inspection. Confirm the published URLs are in the active sitemap (Yoast uses `/sitemap_index.xml`; WordPress core uses `/wp-sitemap.xml`). The original `/recovery/`, `/relief/` and `/rejuvenation/` addresses should each return one permanent redirect to the published treatment. Existing Orange County and city URLs are separate content; preserve them during a migration and review their search traffic before consolidating any.

Use Search Console to compare non-branded local queries and landing pages with completed bookings and qualified calls in the booking system. Verify the official service-area Business Profile, phone, booking link and coverage with the business owner. Check the production host/CDN allows Googlebot, Bingbot and OAI-SearchBot to retrieve public pages and rendering assets. Theme changes alone cannot verify profile ownership, server rules, or completed bookings.
