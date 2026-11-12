# Elivation Health — Brand & Design System

**Expert care. A personal touch. Wherever you are.**

Elivation Health provides mobile IV hydration and wellness therapy. Registered Nurses, working under physician direction, come to the customer's home, office, hotel or event. The service covers Orange County and nearby Southern California markets (verify the exact coverage list before publishing).

This is a full creative reset of elivationhealth.com, not a refresh of the old site.

## Sources
- Live site (content reference): https://www.elivationhealth.com
- Booking engine: https://book.elivationhealth.com/
- GitHub repo: https://github.com/MoarNachos/Eliviation-Health- (empty as of Nov 2026). Commit this design system there, then explore it for future builds.
- Photography: a shared Google Photos album, "Elivation · Jul 2025 – Sep 2026". It hasn't been imported yet; curated picks will go in `assets/photos/`.
- Phone: (949) 561-0590 · Instagram: @elivation.health

## Brand strategy
**Positioning:** the care of an excellent medical team plus the hospitality of a great local business. We stand out through our real people (named RNs, physician oversight), honest guidance with no upselling, and showing up in the local community. We are not another generic IV franchise.

**Personality:** human, welcoming, clinically credible, optimistic, local, polished but not elitist.

**Avoid:** med-spa clichés (marble, gold, spa stones), cold blue corporate healthcare, stock photos, AI gradients, and invented patients.

## Content fundamentals
- **Voice:** a knowledgeable friend who happens to be a nurse. Warm, plain and direct.
- **Person:** we talk to "you" and call ourselves "we". Never "the patient". Use "client" or "guest" for events.
- **Casing:** sentence case for headlines, buttons and nav ("Book a visit", not "Book A Visit"). Eyebrows are all caps with wide tracking.
- **Headlines:** short and declarative. They often use a two-part rhythm where the second phrase is set in the italic serif: "Expert care. A personal touch. *Wherever you are.*"
- **Specifics over superlatives:** use durations, prices, credentials and city names instead of "best" or "premium".
- **Clinical claims:** never promise outcomes. Say "support", "help restore" or "relief", never "cure" or "boost immunity". Every claim and credential must be verified before publishing. Always mention the health screening.
- **Emoji:** never. **Exclamation marks:** almost never.
- **Examples:** "A nurse comes to you." · "Relax for 45–60 minutes." · "Not sure we cover you? Call and we'll tell you straight."

## Visual foundations
- **Color — navy + sky, from the logo:** warm paper (#FBF6EE) page; **Navy** (#16355A–#0A1C33) for trust, dark sections, footer, secondary buttons (matches tent, scrubs, logo text); **Sky** (#20AEE0, light #A3D3F1) = the logo's "iv" blue, used for highlights, links on dark, small accents — never body text on white; **Coral** (#E2532E) stays as the single warm action color for primary CTAs; Sun tints for warmth. Neutrals are warm sand.
- **Type:**
  - Bricolage Grotesque for display and headings: bold, tight tracking (−0.035em).
  - Instrument Serif Italic for the emotional second phrase in headlines.
  - Figtree for body text and UI.
  - DM Mono for step numbers and small data.
  - These are Google Fonts substitutes. Replace them with licensed files if the brand has them.
- **Spacing:** 4px base scale (`--space-1…10`). Sections use `--section-y` (64–128px fluid) and a 1280px max container. Page margin is fluid from 20 to 72px.
- **Grid:** 12 columns on desktop, 8 on tablet, 4 on mobile. Layouts use auto-fit grids that collapse to one column under ~460px.
- **Radii:** soft and friendly. Pills (999px) for buttons and chips, 24px for cards, 28px for hero photos, 12px for inputs.
- **Cards:** white on paper, 24px radius, soft warm shadow (`--shadow-2`), no borders, no colored left edges.
- **Shadows:** warm brown-tinted shadows, never grey-blue. Three levels plus an inset hairline.
- **Backgrounds:** solid color blocks that alternate paper → sand → navy → coral. No gradients, except the photo scrim (`--scrim-photo`) used for text set on images.
- **Photography:** real team, real events, natural light, warm color grade with slight lift and no heavy filters. Faces and hands in frame, not equipment close-ups. Never show identifiable clients without written consent.
- **Motion:** quick and calm. 140–420ms with `--ease-out`, plus a slight spring for small confirmations. Fade and rise on scroll by 8–16px at most. Respect `prefers-reduced-motion`.
- **States:**
  - Hover: darken one step (coral-500 → 600), or an 8% navy tint on ghost buttons.
  - Press: one more step darker (coral-700).
  - Focus: a 2px navy ring offset from the paper background.
- **Transparency and blur:** only on the sticky nav (paper at 86% with a 14px blur).
- **Tap targets:** at least 48px. Booking must take one thumb on mobile.

## Iconography
No icon set has been supplied. Use **Lucide** from CDN (1.5–2px stroke, rounded caps), which matches the friendly geometric type. Keep icons small and functional; they are not illustrations. No emoji. The ✓ character is acceptable for trust lines. The current site's PNG trust badges (HIPAA, Doctor-Owned) should be replaced with plain text claims once verified.

## Logo
Official logo supplied as PNG (407×103): `assets/logo-white.png` (original, white wordmark + sky "iv") for dark/photo backgrounds; `assets/logo-navy.png` (same artwork, white recolored to navy #0F2846) for light backgrounds. Tagline lockup: "Elite Level IV Health For Everyone". Min height 32px; clear space = height of the "e". Never recolor the "iv" mark, stretch, or place on busy photo areas without a scrim. Ask the client for an SVG master.

## Index
- `styles.css`: global entry point (@imports only)
- `tokens/`: `colors.css`, `typography.css`, `fonts.css`, `spacing.css`, `effects.css`, `base.css`
- `templates/homepage/Homepage.dc.html`: full homepage concept (hero, how it works, treatments, nurses, community gallery, events and inquiry form, reviews, service areas, footer)
- `thumbnail.html`: design system tile
- `SKILL.md`: Agent Skill entry point

## Still to build
Component library (Button, Input, ServiceCard, ClinicianCard, Testimonial, TrustBar, Gallery, BookingBar, EventInquiry), foundation cards, mobile homepage, treatment page, events page, and the three creative explorations.
