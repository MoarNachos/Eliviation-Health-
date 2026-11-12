# Elivation theme: open items

Every item marked ⚠ in `design_handoff_homepage/README.md` is listed here. Each one is also marked `TODO(client)` or `TODO(build)` in the file named, so `grep -rn "TODO(" elivation/` finds them all.

Nothing below has been invented. Where the design had placeholder content, the placeholder is still there.

## Content the client must verify or supply

| # | Item | Where |
|---|------|-------|
| 1 | Trust line: "Registered Nurses · Physician directed · HSA / FSA eligible" | `patterns/hero.php` |
| 2 | Coverage claim "Orange County & LA" | `patterns/hero.php`, `patterns/service-areas.php` |
| 3 | Step copy: "about two minutes" to book, "45–60 minutes" per visit | `patterns/how-it-works.php` |
| 4 | Drip names (taken from the current site) and prices (none shown yet) | `patterns/treatments.php` |
| 5 | Team names, credentials and titles | `patterns/team.php` |
| 6 | New team portraits. The three portraits load from the old site's uploads folder and will break when that site is replaced | `patterns/team.php` |
| 7 | "certified Registered Nurse under physician direction" | `patterns/team.php` |
| 8 | Event facts: "Groups of 4 to 100+ · Onsite nurse team · Custom menus" | `patterns/events.php` |
| 9 | "We reply within one business day" | `patterns/events.php`, `assets/js/theme.js` |
| 10 | **Reviews are placeholders.** Replace all three with real Google reviews before launch | `patterns/reviews.php` |
| 11 | City list, and "Same-day visits are often available" | `functions.php` (`elivation_service_cities()`), `patterns/service-areas.php` |
| 12 | Opening hours and (optionally) a postal address for the JSON-LD | `functions.php` (`elivation_json_ld()`) |
| 13 | Medical disclaimer wording in the footer | `patterns/footer.php` |
| 14 | Official logo SVG. The wordmark is set in type until it arrives | `patterns/header.php`, `patterns/footer.php` |

## Photo consent flags (from `assets/photos/picks.txt`)

| Photo | Flag | Used on the page? |
|-------|------|-------------------|
| `community-2` | One golfer is visible in profile. Confirm consent, crop or swap | Yes, Recovery card in `patterns/treatments.php` |
| `team-3` | Two people are holding cocktails | No |

## Not wired up yet (deliberately: content first)

| # | Item | Where |
|---|------|-------|
| 15 | Event inquiry form sends nothing. It checks the fields, then asks the visitor to call. Decide on email or CRM and connect it | `patterns/events.php`, `assets/js/theme.js` |
| 16 | ZIP card passes `?zip=` to the booking site. Confirm the booking platform reads it | `patterns/hero.php` |
| 17 | Out-of-area ZIP message is off until a list of covered ZIP codes is supplied | `functions.php` (`elivation_service_zips()`) |
| 18 | Pages that do not exist yet: treatment detail, pricing comparison, full team, FAQ, Careers, Privacy, Terms. Links point at the booking site or a page section, or are left out | `patterns/treatments.php`, `patterns/team.php`, `patterns/footer.php` |

## Open design question

The real brand (tent, scrubs, logo) is navy, and the client may switch the primary palette. Every color in the theme comes from `tokens/colors.css`. To switch: edit that file, run `npm run tokens`, done.
