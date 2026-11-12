# Handoff: Elivation Health — Homepage + Design Tokens

## Overview
This is a new homepage for elivationhealth.com, a mobile IV hydration service in Orange County and LA. It is a full creative reset of the current site. The page has to:
- communicate "a Registered Nurse comes to you"
- build trust in the nurses and the physician oversight
- show the three treatment categories
- push booking (especially on mobile)
- convert event and group leads

## About the design files
Everything in `design/` is a **design reference built in HTML**, not production code. Recreate it in the repo's stack using that stack's own patterns. `design/templates/homepage/Homepage.dc.html` opens directly in a browser. It uses a small runtime (`support.js`) and an `<image-slot>` web component; neither belongs in production.

**Target stack:** keep the existing architecture. The live site is WordPress (its images are served from `/wp-content/uploads/`). The default plan is a custom WordPress block theme, using `theme.json` mapped from `design/tokens/*.css` plus block patterns for each section. If the repo already contains a different stack, use that instead and leave a note in the PR.

## Fidelity
**High-fidelity.** Match the colors, type, spacing, radii and copy exactly. Copy marked ⚠ needs client verification before it goes live.

## Page structure (top to bottom)
Container max-width is 1280px. Page margin is `clamp(20px,5vw,72px)`. Section vertical padding is `clamp(64px,8vw,128px)`. The type and color values below map to tokens in `design/tokens/`.

1. **Sticky header:** paper at 86% opacity (`rgba(251,246,238,.86)`) with `backdrop-filter: saturate(1.4) blur(14px)` and a 1px `#ECDFCB` bottom border.
   - Left to right: the wordmark "elivation" plus a coral "." (Bricolage Grotesque 700, 24px, −.03em, #10463F); nav links (Figtree 500, 15px, gap 22px); a phone link `(949) 561-0590` (600, #165A50); a primary pill "Book a visit".
   - On narrow screens the nav items that don't fit drop out whole. On mobile, replace them with a menu button and add a sticky bottom "Book a visit" bar (tap targets of at least 48px).
2. **Hero (full-bleed):** `min-height: min(88vh,820px)`. Background photo `hero-2.jpg` set to object-fit cover.
   - Scrim: `linear-gradient(180deg, rgba(8,37,34,.78) 0%, rgba(8,37,34,.5) 32%, rgba(8,37,34,.1) 58%, rgba(8,37,34,.5) 100%)`.
   - Eyebrow: 12px, 700, .14em tracking, uppercase, #FDF0CC, with an 8px #F2B93B dot.
   - H1: "Expert care. A personal touch. *Wherever you are.*" in Bricolage 700, `clamp(3rem,1.6rem+5vw,6.75rem)`, line-height .98, −.04em, white. The italic phrase is Instrument Serif italic 400 in #FDF0CC.
   - Bottom left: a booking card (#FBF6EE, radius 28px, padding 22px, max-width 460px) with the title "Where should we meet you?" (Bricolage 22px, 700), a ZIP input (pill, 52px tall, 1.5px #DCCAAE border) and a coral "Book a visit" button that links to https://book.elivationhealth.com/. Trust line: ✓ Registered Nurses · ✓ Physician directed · ✓ HSA / FSA eligible ⚠.
   - Bottom right: a ghost pill "Planning an event? →" (white 1.5px border at 70% opacity, 8px blur) linking to #events, with the caption "On the course with our team, Nov 2025". Below about 1000px it stacks under the card.
   - The alternative "collage" hero is in the file behind the `heroVariant` prop. Ignore it.
3. **How it works:** a 3-column auto-fit grid (min 260px). Each step has a 2px #1B1F1E top rule, a DM Mono step number in #C44020, an H3 (Bricolage 24px, 700) and 16px body text. The steps are "Pick a drip & a time", "A nurse comes to you" and "Relax for 45–60 minutes" ⚠.
4. **Treatments:** #F5EDE0 background.
   - Header: eyebrow plus H2 "Three ways to *feel like yourself* again." with a link "Compare all drips & pricing →".
   - Three cards: white, radius 24px, `--shadow-2`, a 220px photo, 28px padding, an H3 at 28px and pine chips (#ECF4F2 background, #10463F text, 13px, 600, pill). The cards are Recovery, Relief and Rejuvenation; the drip names are taken from the current site ⚠ prices still need to be added.
5. **Team:** #0C3530 background, cream text.
   - H2 "Critical-care experience, *at your kitchen table.*"
   - Three portrait cards (340px tall, radius 24px) with name and role ⚠ the portraits currently link to the old site's uploads and need new photos.
   - A full-width team photo `team-2.jpg`.
6. **Community gallery:** an auto-fit grid (min 240px) with 240px rows. The first tile spans 2×2. Photos are team-4, community-1, event-3, event-2 and community-4. Links to Instagram @elivation.health.
7. **Events & groups:** #E2532E background.
   - Left: an H2 at `clamp(2.25rem,…,4rem)` "Bring the IV lounge *to your people.*", supporting copy, a 300px photo `event-1.jpg`, and the facts "Groups of 4 to 100+ · Onsite nurse team · Custom menus" ⚠.
   - Right: an inquiry form card (#FBF6EE, radius 28px) with fields for name, email, event date and guests (select). Event type uses single-select chips: Corporate, Bachelorette, Wedding, Sports / race, Other. The submit button "Request a quote" is pine #10463F.
   - Inputs are 16px with 14px/16px padding, radius 12px and a 1.5px #DCCAAE border.
8. **Reviews:** three white figure cards, radius 24px. Each has an Instrument Serif 26px quote. ⚠ These are placeholders; pull real Google reviews.
9. **Service areas:** #F5EDE0 background. An H2 sits next to a set of city pills (white, 15px, 600) ⚠ verify the city list. Buttons: primary "Book a visit" and secondary "Call (949) 561-0590".
10. **Footer:** #082522 background with four columns (brand, Treatments, Company, Contact). Column headings are 12px uppercase in #73AFA1. The footer ends with a medical disclaimer line.

## Interactions
- Buttons:
  - Primary is coral #E2532E. Hover goes to #C44020 and press to #9C3119.
  - Secondary/ghost uses a 1.5px pine border. Hover adds `rgba(31,111,98,.08)`.
  - Focus ring is `0 0 0 3px #FBF6EE, 0 0 0 5px #1F6F62`.
- Motion is 140–420ms with `cubic-bezier(.2,.7,.2,1)`. Optionally fade in sections on scroll (rising 8–16px). Respect `prefers-reduced-motion`.
- ZIP field: validate 5 digits, then hand off to book.elivationhealth.com, passing the ZIP if the booking platform accepts it. If the ZIP is outside the service area, show "We may not cover that ZIP yet. Call us and we'll check."
- Event form: name, email and date are required. Send it to the client's email or CRM (TBD) and show an inline success message "Thanks — we'll reply within one business day ⚠".

## SEO / AI search requirements
- One H1 per page, real heading hierarchy and semantic sections.
- JSON-LD `MedicalBusiness` (or `HealthAndBeautyBusiness`) with name, telephone, url, areaServed (cities), sameAs (Instagram) and openingHours ⚠.
- Descriptive alt text on every photo (see `assets/photos/picks.txt`).
- Images as WebP/AVIF at 2–3 responsive sizes. Preload the hero image.

## Design tokens
Source of truth: `design/tokens/` (`colors.css`, `typography.css`, `spacing.css`, `effects.css`, `base.css`).
- Fonts are Google Fonts: Bricolage Grotesque, Instrument Serif, Figtree and DM Mono.
- Palette is **navy + sky (from the logo) with coral CTAs**. See BRAND_GUIDE.md.

## Assets
- `design/assets/photos/`: 15 curated event and team photos, 2000px on the long edge. `picks.txt` has a description and consent notes for each. ⚠ team-3 and community-2 have consent flags.
- Logo: `design/assets/logo-navy.png` (light bg) and `logo-white.png` (dark bg). SVG still to come.

## Files
- `design/templates/homepage/Homepage.dc.html`: the homepage reference
- `design/tokens/*.css`, `design/styles.css`: tokens
- `BRAND_GUIDE.md`: voice, visual rules, photography and iconography (Lucide)
- `SKILL.md`: Agent Skill for brand-consistent work
- `CLAUDE_CODE_PROMPT.md`: the kickoff prompt
- `PROMPT_BRAND_UPDATE.md`: apply the logo + navy palette to work already built
- `PROMPT_TREATMENT_PAGES.md`: treatment landing pages
