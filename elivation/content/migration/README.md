# Published content snapshot — November 15, 2026

Public source: https://www.elivationhealth.com/

Includes all 17 published blog posts and the Education page's 12 ingredient sections. The article body text is retained verbatim; presentation markup and empty social-share widgets are removed. Education keeps its text and NIH source links, replaces Elementor wrappers with semantic content, and repairs topic anchors (including Taurine and Lipo-C/MIC).

`published-content.json` preserves original slugs, titles, publication/modification timestamps, categories, SEO titles/descriptions, source authors, and source URLs. `url-map.json` records original, review, and eventual production paths. There are no featured images assigned to these 17 posts in the source API.

## Import on a new staging/replacement installation

Activate the theme, back up the destination, then run explicitly:

```sh
wp eval 'define("ELIVATION_IMPORT_CONTENT", true); require get_theme_file_path("tools/import-published-content.php");'
```

The importer never runs during theme activation and skips existing matching posts/pages. It creates normal WordPress content, editable in the WordPress editor. It does not replace existing content, users, or production settings. Original source-author names are retained as metadata; no author accounts are fabricated. Yoast metadata is imported; a title/description fallback is provided when Yoast is absent.

## Existing production site / launch

Production content remains intact. When staying on the existing WordPress installation, retain its posts, SEO plugin, media, and permalink settings. Do not delete/recreate published posts to switch themes. Education currently uses Elementor: use this normalized copy on a staged migration, and review its editor conversion before replacing the live page. The 27 additional location/service SEO pages are outside this content import and remain on production; preserve them during any later full-site move. Our Stories is a separate page with media links, not the blog archive, and also remains on production.

The design-review export is intentionally noindex. Publishing this review does not transfer rankings or replace the indexed production URLs. At cutover, keep the original root-level article paths; remove review-only robots restrictions only on the actual production build. Any changed paths need explicit 301 redirects, followed by canonical/sitemap checks and Search Console validation. Retain the existing production SEO plugin's schema and metadata; don't replace them with the review export.
