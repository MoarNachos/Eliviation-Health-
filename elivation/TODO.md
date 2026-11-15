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
| 6 | **Medical director profile.** Not shown anywhere until the founders supply an approved name, credentials, portrait and role description. Add it to `elivation_medical_director()` and it appears beside Richard on the homepage and at the top of About. Do not use a corporate filing or a matching physician name | `inc/team.php` |
| 7 | Description of the registered nurse’s visit and the medical director’s oversight, and the five bios on /about-us/ (lightly edited from the live site: verify titles, degrees, awards and family details) | `patterns/team.php`, `inc/team.php` |
| 8 | Event facts: "Groups of 4 to 100+ · Onsite nurse team · Custom menus" | `patterns/events.php` |
| 9 | "We reply within one business day" | `patterns/events.php`, `assets/js/theme.js` |
| 10 | **Reviews are real but self-published.** The homepage hero quotes an excerpt from r3, and the reviews section has cards for r1, r2 and r5 from `content/reviews.json`, copied verbatim from elivationhealth.com/testimonials/. None is tied to Google or Yelp, so they're labelled "Elivation client" and there is no review JSON-LD. Swap in Google Business Profile reviews if you want stars in search. "Read the full review" links go to the theme's /testimonials/ page (`elivation_reviews_url()`), which shows every review in full | `patterns/reviews.php`, `content/reviews.json` |
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

## Photo consent flags

Source: `assets/photos/candidates/picks.md` and `assets/photos/picks.txt`. Consent is not established by a person facing away or by a face falling outside the crop.

| Photo | TODO(client) | Use |
|---|---|---|
| `nurse-home-vitals-1.jpg` | Confirm consent for both clients; one seated face is visible. Confirm the care provider’s identity and RN status. | Theme photo; see source comments |
| `relaxed-home-iv-detail-1.jpg` | Confirm authorization for this client-treatment image despite the face being outside the frame. Also applies to home-community-iv (same source DSC_1818.jpg). | Theme photo; see source comments |
| `branded-tent-lawn-wide-1.jpg` | Check background people for identifiable clients and confirm their consent. Also applies to hero-2 (same source 20251110_093003.jpg). | Hero alias retained |
| `branded-event-table-wide-2.jpg` | Verify background people’s staff/client roles and consent for identifiable non-staff. | Theme photo; see source comments |
| `branded-tent-care-wide-3.jpg` | Confirm consent for the identifiable standing guest and seated client; verify provider identity and RN status. | Theme photo; see source comments |
| `community-2.jpg` | Confirm consent for the golfer visible in profile. | Theme photo; see source comments |
| `home-recovery.jpg` | Confirm consent for both identifiable clients on the sofa. | Theme photo; see source comments |
| `home-rejuvenation.jpg` | Confirm client consent for the injection photo; verify provider identity and RN status. | Not used: drinks and injection close-up |
| `team-3.jpg` | Cocktails visible: excluded from use, not approved for reinstatement. | Not used |

Removed from use after the drinks/bar audit: `team-2` (drinkware on the table), `team-4` (festival scene not retained), `home-relief` and `home-community-visit` (brewery context), and `home-rejuvenation` (visible cans and injection close-up). `team-3`, `community-1`, `event-1` and `hero-1` remain unused. Source images are retained as archival inputs.

## Not wired up yet (deliberately: content first)

| # | Item | Where |
|---|------|-------|
| 15 | Event inquiry form sends nothing. It checks the fields, then asks the visitor to call. Decide on email or CRM and connect it | `patterns/events.php`, `assets/js/theme.js` |
| 16 | ZIP card passes `?zip=` to the booking site. Confirm the booking platform reads it | `patterns/hero.php` |
| 17 | Out-of-area ZIP message is off until a list of covered ZIP codes is supplied | `functions.php` (`elivation_service_zips()`) |
| 18 | Pages that do not exist yet (About, Testimonials and Privacy now exist; see `inc/team.php`): pricing comparison, Careers, Terms. (`/treatments/` itself redirects to the homepage section.) Links point at the booking site or a page section, or are left out | `patterns/treatments.php`, `patterns/team.php`, `patterns/footer.php` |

## Palette

Navy + sky, taken from the official logo, with coral kept for primary buttons (see `design_handoff_homepage/BRAND_GUIDE.md`). Every color in the theme comes from `tokens/colors.css`. To change it: edit that file, run `npm run tokens`, done.

## Drip section copy — medical director review

TODO(client): Review the new hook, 2–3 sentence description and every “Good for” chip for each of the 17 drip sections in `inc/treatments.php` (`elivation_drip_details`). Prices, durations and booking IDs are unchanged, but remain subject to the existing T1/T5 review.

| Category | New copy requiring approval |
|---|---|
| Recovery | Myers' Cocktail; Defense; Hangover Remedy; Performance; Max Defense; Build-a-Bag |
| Relief | Basic Drip; Lactated Ringer's; Nausea; Migraine Relief; Cold & Flu; Food Poisoning |
| Rejuvenation | Premenstrual Tension; Radiance; NAD+ 250mg; The Elivation; NAD+ 500mg |

TODO(client): Confirm that using general home-care, chair and setup photographs alongside drip descriptions does not imply that a pictured client received that particular formula or experienced a particular outcome. There are not yet enough distinct treatment-specific photos; replacements can use the per-drip `photo` field. Photos repeat across categories, but no two drips within a category share a source photo.

## Additional photo candidates — approved crop compositions

- TODO(client): `home-visit-couch-1.jpg` and its crop variants — obtain consent for both identifiable clients in the source photo; confirm staff image authorization. The user approved the framing compromises: the desktop crop retains background equipment; the portrait shows one client. Consent remains to be confirmed.
- TODO(client): `group-event-guest-nurse-1.jpg` and its crop variants — obtain client-treatment consent from the identifiable guest in pink and confirm staff image authorization for the team member in navy.

The photo swap removes all active theme uses of `nurse-home-vitals-1` (20250819_195637). 20250819_194533 and `home-relief` (20260913_150229) also remain excluded. Archival files are not placed in the theme.
