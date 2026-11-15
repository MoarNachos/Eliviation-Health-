# Elivation polish pass — review record

Completed locally on November 15, 2026. Eight full-page PNGs were saved before the fourth commit. Open [the screenshot gallery](index.html) directly from disk; it does not need WordPress or a running server.

## Four reversible phases

| Phase | Commit | Scope |
|---|---|---|
| Photos | `b4293c9` | Requested swaps, removal of drinks/bar images, supporting home-care image, consent notes |
| Images | `104f07a` | Quality-78 responsive WebP delivery, actual dimensions, lazy loading, portraits and graphics |
| Layout | `71e1963` | Hero readability, quote card, responsive layout, contrast, local fonts and bundled CSS |
| Drips | `Polish: anchored drip sections and final QA` | 17 anchored sections, medical-review copy, drawer preselection, final responsive corrections and this review package |

The preview site has not been deployed. These are local Git commits. Each phase has its own commit; later phases reuse the photo and image helpers introduced earlier, so review dependencies when reverting an earlier phase.

## Mobile Lighthouse: before → after

The baseline is commit `ba57687`. Both versions ran in isolated WordPress Playground instances, PHP 8.3, with the same transparent gzip proxy and no proxy cache. The preview host returned `Content-Encoding: gzip`, so this matches its delivery behavior. No HTML rewriting, audit exclusions, or relaxed throttling were used.

Lighthouse 13.6.0; Chrome 157; default mobile emulation (412 × 823, DPR 1.75), simulated mobile network and 4× CPU slowdown. These are local lab results, not measurements of a deployed production site.

| Page | Performance | Accessibility | SEO | Best Practices |
|---|---:|---:|---:|---:|
| Homepage | 87 → 91 | 97 → 100 | 100 → 100 | 100 → 100 |
| Recovery | 95 → 100 | 96 → 100 | 100 → 100 | 100 → 100 |
| Relief | 95 → 100 | 96 → 100 | 100 → 100 | 100 → 100 |
| Rejuvenation | 87 → 98 | 96 → 100 | 100 → 100 | 100 → 100 |

Full JSON reports are in [lighthouse/before](lighthouse/before/) and [lighthouse/after](lighthouse/after/). Final runs have no failed binary audits. Earlier diagnostic runs used the runner's uncompressed transport (homepage 83 initially, 88 after layout work); their summaries remain in `lighthouse/diagnostics/` and are not mixed into the comparison above.

## Screenshots

| Page | 375px | 1280px |
|---|---|---|
| Homepage | [Mobile](home-375.png) | [Desktop](home-1280.png) |
| Recovery | [Mobile](recovery-375.png) | [Desktop](recovery-1280.png) |
| Relief | [Mobile](relief-375.png) | [Desktop](relief-1280.png) |
| Rejuvenation | [Mobile](rejuvenation-375.png) | [Desktop](rejuvenation-1280.png) |

Full-page captures retain the site's fixed mobile booking bar. It appears once near the initial viewport boundary in each long screenshot.

## Validation

- Checked all four pages at 375, 768, 1280 and 1600px: no horizontal overflow, broken/unloaded images, or visible link/button/input/select targets under 48px. No browser page errors. Evidence: [responsive-checks.json](responsive-checks.json).
- Clicked all 17 comparison-card anchors and all 17 section booking buttons at 375px. Every drawer selected the correct booking ID and closed with Escape. Evidence: [booking-checks.json](booking-checks.json). No bookings were submitted.
- No two drip sections on the same category page share a photo. Existing `#drip-<booking-id>` card anchors remain available alongside new descriptive section anchors, including `#myers` and `#cold-flu`.
- All rendered images have explicit width and height. Every image except the page hero is lazy-loaded. Each hero has a responsive preload and high fetch priority.
- Verified all 90 generated photo variants against their manifest dimensions and WebP format. The pipeline uses quality 78 at requested widths 800, 1400 and 2000, without upscaling undersized originals. Some staff portraits only have 300px sources; their srcset descriptors honestly reflect that limit. The tall vitals candidate has a 1500px source width and stops there.
- The five `home-*-1400.webp` files are 106, 235, 237, 176 and 123 KiB, all below 250 KiB. Unused source photos remain archival inputs, but drinks/bar photos are absent from pattern/inc references.
- Inspected the home-care crop, events imagery, hero text contrast, desktop quote card, mobile forms, treatment heroes and drip layouts. The quote hides below 1100px; the wide hero's tent lettering sits clear of the headline.
- Rebuilt tokens and the minified stylesheet; `git diff --check` passes. PHP rendering was exercised through WordPress on all four routes.

## Files changed

The complete path-by-path list, including generated assets and QA files, is [CHANGED-FILES.txt](CHANGED-FILES.txt).

Main editable files:

- `assets/photos/picks.txt`
- `tools/build-photos.mjs`, `tools/build-styles.mjs`
- `tokens/colors.css`, `package.json`, `package-lock.json`
- `elivation/functions.php`, `elivation/inc/team.php`, `elivation/inc/treatments.php`
- `elivation/patterns/community.php`, `events.php`, `footer.php`, `header.php`, `how-it-works.php`, `team.php`, `treatment-drips.php`, `treatments.php`, `hero.php`
- `elivation/templates/front-page.html`
- `elivation/assets/css/theme.css`, `tokens.css`, `fonts.css`, `site.css`
- `elivation/README.md`, `elivation/TODO.md`

Generated/supporting assets: responsive photos and manifest in `elivation/assets/photos/`, WebP logos/badges in `elivation/assets/images/`, licensed local fonts in `elivation/assets/fonts/`, and this `screenshots/polish-pass/` review package.

## New TODO(client) items

See [the theme TODO list](../../elivation/TODO.md) for the full wording and source comments.

1. Confirm client-treatment consent for all five candidates: `nurse-home-vitals-1`, `relaxed-home-iv-detail-1`, `branded-tent-lawn-wide-1` (also `hero-2`), `branded-event-table-wide-2`, and `branded-tent-care-wide-3`. Verify provider identities/RN status and background staff/client roles where flagged. A cropped face does not establish authorization.
2. Confirm consent for identifiable clients in existing `community-2` and `home-recovery`. Preserve the review note for archived `home-rejuvenation`; it is excluded from use, as is the cocktail image `team-3`.
3. Medical director review of all 17 new hook lines, descriptions and “Good for” chip sets: Myers' Cocktail, Defense, Hangover Remedy, Performance, Max Defense, Build-a-Bag, Basic Drip, Lactated Ringer's, Nausea, Migraine Relief, Cold & Flu, Food Poisoning, Premenstrual Tension, Radiance, NAD+ 250mg, The Elivation and NAD+ 500mg.
4. Approve general visit/setup photos alongside drip descriptions without implying a pictured client's diagnosis, formula or outcome. More distinct home-care photography remains a content need.

Existing booking-platform query-parameter support, contact/CRM wiring, pricing and duration review remain in the existing TODO list. This pass verifies the local drawer's preselection, not the external booking provider's behavior.
