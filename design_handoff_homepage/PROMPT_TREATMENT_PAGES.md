# Prompt: treatment landing pages (paste into Claude Code from the repo root)

Build one landing page for each treatment category of Elivation Health: Recovery, Relief and Rejuvenation. Each page should stand on its own and sell that treatment. It should not just link out to the booking site.

**Read first:**
- `design_handoff_homepage/README.md`
- `BRAND_GUIDE.md`
- `design/tokens/`
- the visual reference `design/templates/treatment/Treatment.dc.html` (open it in a browser)

Use `design/templates/treatment/treatments-data.js` as the starting data: drip names, prices, durations and descriptions taken from the live site.

**Page structure, top to bottom:**
1. **Hero:** category headline, a one-line promise, a category photo, and "Book [Category]" plus "See drips & prices" buttons. Under them, a trust line: "From $X · session length · HSA/FSA eligible ⚠".
2. **Who it's for:** 4 plain-language situations, from `goodFor`.
3. **Drip menu:** one card per drip with name, price, duration, a 1–2 sentence description, an optional tag ("Most booked") and a "Book this drip" button. Cards are white with a 24px radius and the soft warm shadow from the tokens.
4. **How a visit works:** 3 steps — book, an RN arrives and screens you, then relax.
5. **Safety and who's caring for you:** Registered Nurses, physician-directed protocols, the health screening before every drip, and a note on who shouldn't get IV therapy ⚠ (client must verify the wording).
6. **FAQ:** 5–6 questions specific to the category, in an accordion. Add FAQPage JSON-LD.
7. **Cross-sell:** short links to the other two categories and to Events & Groups.
8. **Closing CTA band** and footer, shared with the homepage.

**In-page booking (most important):**
- Build a booking drawer that opens from any Book button: a bottom sheet on mobile, a side panel on desktop. Steps:
  1. choose a drip (preselected if they came from a drip card)
  2. ZIP code, checked against the service area list
  3. pick a date and time
  4. name and phone, then a summary
- The final "Confirm" hands off to https://book.elivationhealth.com/, passing the drip, ZIP and slot as query params if the platform supports them; leave a TODO if it doesn't.
- Add a sticky "Book [Category] · from $X" bar on mobile.

**Rules:**
- Mobile-first. Tap targets at least 48px. One H1 per page.
- Use only the tokens; colors must stay swappable because the palette may move to navy.
- URLs: `/treatments/recovery`, `/treatments/relief`, `/treatments/rejuvenation`. Each page gets a unique title, meta description and `MedicalBusiness` + `Service` JSON-LD with price.
- Don't invent clinical claims, credentials or reviews. Medical wording stays cautious ("may help", "supports"). Mark anything unverified with a `⚠ TODO`.
- Reuse the homepage's header, footer, button and card components. Don't duplicate them.

**Before coding,** show me your plan and the file tree and wait for my OK. After building, tell me how to preview it locally and list every ⚠ TODO you left.
