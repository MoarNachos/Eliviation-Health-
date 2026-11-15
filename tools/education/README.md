# Education guide

`elivation/content/ingredients.json` owns editable medical copy, FAQ answers, sources, metadata, review status and related ingredients. `elivation/inc/treatments.php` owns prices/durations and the confirmed ingredient mapping. Empty mappings are intentional pending client formulas; they must never be inferred from treatment names.

Run `python3 tools/education/build-review-log.py` after copy changes to regenerate the Education claims section in `elivation/TODO.md`. Medical claims have stable identifiers in the rendered HTML and the ledger. The visible review line is pending; schema omits `reviewedBy` and `lastReviewed` until the corresponding fields contain real approval data. No guaranteed rankings, AI citations or rich results are claimed.

The installer creates missing native WordPress child pages, preserves existing page IDs/content, and lets the normal WordPress/Yoast sitemap include them. The education template renders the guide in place of the archived original hub copy; it does not erase that original content. Theme activation/admin installation creates the pages. On a new WP installation, explicitly call `elivation_install_education()` after activation if needed.

`/llms.txt` is a theme-owned virtual endpoint at the WordPress site root. The review export writes `/design-review/llms.txt` with review URLs. Do not replace the live root resource with review URLs. Existing public production pages remain unchanged until launch.

Legacy fragment URLs are handled by a small browser redirect and meaningful fallback links. Fragments are never sent in HTTP requests, so an anchor-specific server 301 is impossible. The former Taurine navigation link incorrectly used `#nad`; that ambiguous legacy fragment must continue to go to NAD+, while `#taurine` goes to Taurine.

The ingredient drawer uses an accessible native modal with a preselected drip, live source prices and durations, Escape/close support, focus restoration, and a direct booking-link fallback. It does not collect unused personal details. The external booking provider's support for `?drip=` remains a client TODO; the handoff explicitly asks visitors to confirm their selection there.

## Preview and validation

Run the committed `preview-blueprint.json` with WordPress Playground and this theme mounted. Use a free port (export script currently uses 9467). It imports existing articles, creates guide pages, and uses an indexable local environment for SEO auditing. `export-review.py` writes only 13 Education pages, three treatment pages, Education CSS/JS and review llms.txt; it never overwrites the production site or unrelated review pages. Review pages explicitly remain noindex.

Lighthouse reports belong in `tools/education/qa/`; audit URLs and indexing conditions must be reported with the scores. Test all goal filters, legacy fragment forwarding, matching drip links, source URLs, sitemap inclusion, metadata lengths, single H1, mobile overflow and booking selection before publishing.
