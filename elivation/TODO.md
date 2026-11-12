# Elivation theme: open items

Every item marked ⚠ in `design_handoff_homepage/README.md` is listed here. Each one is also marked `TODO(client)` or `TODO(build)` in the file named, so `grep -rn "TODO(" elivation/` finds them all.

Nothing below has been invented. Where the design had placeholder content, the placeholder is still there.

## Content the client must verify or supply

| # | Item | Where |
|---|------|-------|
| 1 | Trust line: physician-directed care and the advertised starting price | `patterns/hero.php` |
| 2 | Coverage in Orange County and select Los Angeles communities | `patterns/hero.php`, `patterns/service-areas.php` |
| 3 | Appointment lengths: about 75 minutes for most visits and up to 2½ hours for NAD+ | `patterns/how-it-works.php` |
| 4 | Drip names, prices, durations and descriptions (taken from the current site, Aug 2026) | `inc/treatments.php`, `patterns/treatments.php` |
| 5 | Team names, credentials and titles | `patterns/team.php` |
| 6 | New portraits for Kathy Tran and Jon Lai. They still load from the old site's uploads folder and will break when that site is replaced (Richard's is now in `assets/images/`). Also the medical director's name and credentials, if they should appear | `patterns/team.php` |
| 7 | Description of the registered nurse’s visit and the medical director’s oversight | `patterns/team.php` |
| 8 | Event facts: "Groups of 4 to 100+ · Onsite nurse team · Custom menus" | `patterns/events.php` |
| 9 | "We reply within one business day" | `patterns/events.php`, `assets/js/theme.js` |
| 10 | **Reviews are real but self-published.** The homepage hero quotes an excerpt from r3, and the reviews section has cards for r1, r2 and r5 from `content/reviews.json`, copied verbatim from elivationhealth.com/testimonials/. None is tied to Google or Yelp, so they're labelled "Elivation client" and there is no review JSON-LD. Swap in Google Business Profile reviews if you want stars in search. The "Read the full review" link still points at the old /testimonials/ page | `patterns/reviews.php`, `content/reviews.json` |
| 11 | City list, and "Same-day visits are often available" | `functions.php` (`elivation_service_cities()`), `patterns/service-areas.php` |
| 12 | Opening hours and (optionally) a postal address for the JSON-LD | `functions.php` (`elivation_json_ld()`) |
| 13 | Medical disclaimer wording in the footer | `patterns/footer.php` |
| 14 | Official logo as SVG. The PNGs in `assets/images/` (navy for light backgrounds, white for dark) are used until it arrives | `patterns/header.php`, `patterns/footer.php` |

## Treatment pages (`/treatments/recovery`, `/relief`, `/rejuvenation`)

| # | Item | Where |
|---|------|-------|
| T1 | Every drip name, price, duration and description | `inc/treatments.php` |
| T2 | All FAQ answers, especially emergency symptoms, pregnancy, NAD+ infusion speed, HSA / FSA and "same-day visits" | `inc/treatments.php` (also feeds the FAQPage JSON-LD) |
| T3 | Safety section: "IV therapy may not be right for you if…" list, "nurse stays with you the whole session", "nurses don't improvise ingredients or doses". Medical director must approve | `patterns/treatment-safety.php` |
| T4 | Optionally name the medical director and credentials | `patterns/treatment-safety.php` |
| T5 | Session lengths and treatment availability | `patterns/treatment-hero.php`, `inc/treatments.php` |
| T6 | "Prices include the nurse visit, health screening and supplies. Travel fees may apply outside our core area." | `patterns/treatment-drips.php`, `patterns/treatment-booking.php` |
| T7 | "Your nurse texts you before arriving" | `patterns/treatment-visit.php` |
| T8 | Booking time windows (8–11am, 11am–2pm, 2–5pm, 5–8pm) match nurse hours | `patterns/treatment-booking.php` |
| T9 | Booking platform: does it read `drip`, `zip`, `date`, `time`, `category` query params? If not, Confirm still lands on the booking site without preselection | `assets/js/theme.js` (`handOff`) |
| T10 | Booking drawer name and phone are collected but **not sent anywhere** (kept out of the URL on purpose). Connect to the CRM or a booking API | `assets/js/theme.js`, `patterns/treatment-booking.php` |
| T11 | Meta descriptions mention Orange County and parts of Los Angeles | `inc/treatments.php` |

## Photo consent flags (from `assets/photos/picks.txt`)

| Photo | Flag | Used on the page? |
|-------|------|-------------------|
| `community-2` | One golfer is visible in profile. Confirm consent, crop or swap | Yes, Recovery card in `patterns/treatments.php` and the Recovery page hero (`inc/treatments.php`) |
| `team-3` | Two people are holding cocktails | No |

## Not wired up yet (deliberately: content first)

| # | Item | Where |
|---|------|-------|
| 15 | Event inquiry form sends nothing. It checks the fields, then asks the visitor to call. Decide on email or CRM and connect it | `patterns/events.php`, `assets/js/theme.js` |
| 16 | ZIP card passes `?zip=` to the booking site. Confirm the booking platform reads it | `patterns/hero.php` |
| 17 | Out-of-area ZIP message is off until a list of covered ZIP codes is supplied | `functions.php` (`elivation_service_zips()`) |
| 18 | Pages that do not exist yet: pricing comparison, full team, Careers, Privacy, Terms. (`/treatments/` itself redirects to the homepage section.) Links point at the booking site or a page section, or are left out | `patterns/treatments.php`, `patterns/team.php`, `patterns/footer.php` |

## Palette

Navy + sky, taken from the official logo, with coral kept for primary buttons (see `design_handoff_homepage/BRAND_GUIDE.md`). Every color in the theme comes from `tokens/colors.css`. To change it: edit that file, run `npm run tokens`, done.
