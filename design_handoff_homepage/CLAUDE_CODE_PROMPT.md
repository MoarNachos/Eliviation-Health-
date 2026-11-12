# Paste into Claude Code (from the repo root)

You're building the new Elivation Health website (elivationhealth.com), a mobile IV hydration service.

1. Read `design_handoff_homepage/README.md`, `design_handoff_homepage/BRAND_GUIDE.md` and every file in `design_handoff_homepage/design/tokens/`. Open `design_handoff_homepage/design/templates/homepage/Homepage.dc.html` in a browser as the visual reference.
2. Inspect this repo and tell me what stack it uses. If it's empty or WordPress, build a custom WordPress block theme called `elivation`:
   - `theme.json` generated from the CSS tokens (colors, font families and sizes, spacing, radii, shadows)
   - one block pattern per homepage section
   - a front-page template that assembles them
   - Google Fonts enqueued
   - photos converted to WebP in responsive sizes
   If the repo uses another stack, follow its conventions instead.
3. Recreate the homepage at high fidelity: exact hex values, type sizes, spacing and copy from the README. Mobile-first. Add the sticky mobile "Book a visit" bar. Booking links go to https://book.elivationhealth.com/.
4. Add `MedicalBusiness` JSON-LD, semantic headings and alt text from `assets/photos/picks.txt`.
5. Leave every item marked ⚠ in the README as a clearly marked TODO. Don't invent reviews, credentials, prices or claims.
6. Keep all colors behind tokens; the primary palette may switch to navy.
7. Before you write any code, give me a short plan and the file tree. After building, explain how to run it locally.
