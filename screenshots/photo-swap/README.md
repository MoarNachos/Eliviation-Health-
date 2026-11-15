# Photo swap — November 15, 2026

Published to https://www.elivationhealth.com/design-review/ using the existing WordPress File Manager folder-upload workflow. Only the `design-review/` directory was merged; the active production theme, production database and booking application were not changed.

## Included

- Approved 16:10 home-visit crop beside homepage steps on desktop; approved 4:5 crop on mobile. Recovery uses the same responsive crops, with matching hero preloads.
- Relief retains the approved IV-detail hero. Rejuvenation retains its existing hero and gains an IV-detail supporting image in “What to expect at home.”
- Events shows the square guest/team-member crop beside the branded care-in-progress image.
- All active uses of the prohibited vitals photo were replaced, including gallery, card and drip-section uses. The other two prohibited sources remain unused.
- Copied original home/event photos, four 2000px-long-edge JPEG crops at quality 80, and twelve WebP exports at quality 78 with 800/1400/2000px long edges. Actual widths are used in srcset descriptors. The existing Relief candidate was preserved.
- Crop coordinates and a repeatable export command (`npm run photos`) are committed. The crop builder reads the copied original JPEGs and encodes WebP directly, avoiding recompression of the JPEG previews.
- Consent flags are recorded in candidate picks, theme source comments and `elivation/TODO.md`. User approval covers framing compromises; client releases are still TODO(client).

## Checks and screenshots

[Open the screenshot gallery](index.html). Requested homepage, Recovery, Relief and Events captures are saved at 375px and 1280px. Additional captures show Rejuvenation and How it works at both widths. Full-page captures retain fixed navigation; section-only captures hide fixed navigation and disable reveal animations so the whole section is visible.

- Four pages × two widths: zero horizontal overflow, broken images, undersized visible control targets or browser page errors. See `responsive-checks.json`.
- Confirmed the mobile homepage selects the 4:5 source, while desktop selects 16:10. Explicit dimensions, lazy loading and Recovery hero priority are retained.
- Checked all twelve crop variants against their recorded dimensions.
- No prohibited photo references remain in theme patterns or treatment data.
- Build scripts pass Node syntax checks; theme routes render without PHP errors; `git diff --check` passes.
- Published 27 HTML pages and 59 assets verified byte-for-byte against the tested export: all 86 public files match. See `deployment-checks.json`. The directory `.htaccess` is intentionally not publicly readable; the export also includes noindex metadata on every page.
- `live-review.png` is a browser screenshot of the published review page.

The design-review copy retains its existing banner and booking behavior: booking controls open the existing booking application, and the event form remains a preview. The WordPress theme's booking drawer is unchanged.

## Deployment and rollback

The export is stored locally at `../../../staging-build/photo-swap-build/design-review/` relative to this folder. A rollback snapshot of the 40 previously existing public files being replaced, plus a hash manifest identifying 47 newly added paths, is stored in the workspace's `staging-build/photo-swap-backup/`. Old unreferenced review assets were not deleted. These deployment directories are outside the Git repository.

This photo swap is one commit named `Photos: home-visit crop, IV detail, event guest`. The four earlier polish commits remain separate. The deployment includes those earlier changes as well as this photo swap; no new Education ingredient-guide rewrite was included.
