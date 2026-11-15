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

## Education page claims

Every entry below is **TODO(client): medical director review**. Source links are in `content/ingredients.json`. No reviewer or lastReviewed date is asserted until approval.

### Amino Blend

- **TODO(client) amino-blend-card**: Provide building blocks for body proteins.
- **TODO(client) amino-blend-short**: Amino acids are building blocks your body uses to make proteins. An amino blend combines several of them, but its exact contents depend on the formulation. Evidence from food or oral supplements does not establish that a wellness IV improves recovery.
- **TODO(client) amino-blend-body-1**: Provide building blocks for body proteins.
- **TODO(client) amino-blend-body-2**: Participate in normal tissue maintenance.
- **TODO(client) amino-blend-body-3**: Some amino acids also take part in energy metabolism.
- **TODO(client) amino-blend-why**: People interested in exercise recovery may ask about amino acids. Their role in protein production does not mean an IV blend builds muscle or speeds recovery.
- **TODO(client) amino-blend-safety**: Talk with your clinician first if you have kidney problems, follow a medically prescribed protein restriction, or receive specialist care. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) amino-blend-faq-1**: What is in an Amino Blend IV? The name does not identify a standard recipe. Ask for the exact amino acids and amounts before booking.
- **TODO(client) amino-blend-faq-2**: Is an amino acid IV better than eating protein? Protein foods supply amino acids after digestion. Research on oral protein does not establish an advantage for a wellness IV.
- **TODO(client) amino-blend-faq-3**: Will an amino acid IV improve workout recovery? An improvement cannot be promised. Evidence for wellness IV blends is limited, and the formula matters.

### Biotin

- **TODO(client) biotin-card**: Helps enzymes process fatty acids.
- **TODO(client) biotin-short**: Biotin is a B vitamin that helps enzymes process fats, carbohydrates, and amino acids. It is sometimes included in wellness formulations. Evidence that extra biotin improves hair or nails in people with adequate intake is limited, and an IV benefit is not established.
- **TODO(client) biotin-body-1**: Helps enzymes process fatty acids.
- **TODO(client) biotin-body-2**: Participates in glucose metabolism.
- **TODO(client) biotin-body-3**: Helps process certain amino acids.
- **TODO(client) biotin-why**: People often ask about biotin for hair and nails. Its normal metabolic role should not be read as a promise of hair growth or stronger nails from an infusion.
- **TODO(client) biotin-safety**: Tell the nurse and the laboratory if you take biotin or have blood tests planned: biotin can interfere with some test results. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) biotin-faq-1**: Does biotin help hair grow? Evidence for extra biotin improving hair in people with adequate intake is limited. IV delivery does not establish a hair-growth benefit.
- **TODO(client) biotin-faq-2**: Can biotin affect blood tests? Yes, biotin can interfere with some laboratory tests. Tell your clinician and laboratory what you take and follow their instructions.
- **TODO(client) biotin-faq-3**: Is biotin included in Radiance? The current published menu does not confirm its complete formula. Ask the team to verify the ingredients before booking.

### Glutathione

- **TODO(client) glutathione-card**: Participates in the body’s antioxidant systems.
- **TODO(client) glutathione-short**: Glutathione is an antioxidant your body makes naturally from three amino acids. It participates in the chemical systems that help cells manage oxidation. It is offered in some IV blends, but evidence for general wellness benefits from IV use is limited.
- **TODO(client) glutathione-body-1**: Participates in the body’s antioxidant systems.
- **TODO(client) glutathione-body-2**: Cycles between reduced and oxidized forms.
- **TODO(client) glutathione-body-3**: Helps maintain the chemical environment within cells.
- **TODO(client) glutathione-why**: People may ask about glutathione when exploring antioxidant support. Its activity inside cells does not establish a noticeable benefit from an infusion.
- **TODO(client) glutathione-safety**: Discuss prior reactions to injectable products and any ongoing specialist treatment with your clinician. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) glutathione-faq-1**: What is glutathione made from? It is made from glutamate, cysteine, and glycine. Your body produces it naturally.
- **TODO(client) glutathione-faq-2**: Is IV glutathione proven to improve wellness? Evidence for general wellness outcomes is limited. Studies of oral products cannot establish the effects of an IV formulation.
- **TODO(client) glutathione-faq-3**: Which Elivation drip contains glutathione? The published description of The Elivation lists NAD+ and glutathione. Confirm the current formulation with the team before booking.

### Lipo-C/MIC

- **TODO(client) lipo-c-mic-card**: Methionine is an amino acid used in proteins.
- **TODO(client) lipo-c-mic-short**: Lipo-C/MIC is a formulation name rather than a single nutrient. MIC commonly refers to methionine, inositol, and choline, but products can differ. Elivation’s exact formula and whether it is offered as an IV ingredient or a separate injection need confirmation.
- **TODO(client) lipo-c-mic-body-1**: Methionine is an amino acid used in proteins.
- **TODO(client) lipo-c-mic-body-2**: Choline is used to make components of cell membranes.
- **TODO(client) lipo-c-mic-body-3**: Choline is also used to make acetylcholine, a nerve-signaling chemical.
- **TODO(client) lipo-c-mic-why**: People may ask about these nutrients when exploring metabolism. Their roles in the body do not establish a weight-management benefit from a Lipo-C/MIC product.
- **TODO(client) lipo-c-mic-safety**: Ask your clinician to review the exact formula, dose, and route before considering this product. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) lipo-c-mic-faq-1**: Is Lipo-C/MIC an IV or an injection? The product name alone does not establish its route. Elivation’s available formulation and route need confirmation.
- **TODO(client) lipo-c-mic-faq-2**: Does MIC mean one ingredient? No, MIC commonly refers to three ingredients. Additional ingredients and concentrations can vary by product.
- **TODO(client) lipo-c-mic-faq-3**: Does Lipo-C/MIC cause weight loss? A weight-loss result cannot be promised. Normal nutrient metabolism is not evidence that an injection changes body weight.

### Magnesium

- **TODO(client) magnesium-card**: Supports normal muscle and nerve function.
- **TODO(client) magnesium-short**: Magnesium is a mineral involved in normal muscle, nerve, and enzyme function. Some IV blends include magnesium alongside fluids and other nutrients. Its essential role does not establish that an infusion improves wellness in someone with adequate magnesium.
- **TODO(client) magnesium-body-1**: Supports normal muscle and nerve function.
- **TODO(client) magnesium-body-2**: Helps enzymes involved in energy production.
- **TODO(client) magnesium-body-3**: Participates in protein synthesis.
- **TODO(client) magnesium-why**: People interested in recovery or hydration may ask about magnesium. Evidence about a mineral’s normal function should not be presented as proof of a benefit from an elective infusion.
- **TODO(client) magnesium-safety**: Talk with your clinician first if you have reduced kidney function or take medicines that affect magnesium levels. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) magnesium-faq-1**: Is magnesium an electrolyte? Yes, magnesium is an electrolyte. It participates in nerve and muscle function.
- **TODO(client) magnesium-faq-2**: Will magnesium IV therapy improve exercise recovery? A recovery benefit cannot be promised. The role of magnesium in muscles does not establish a benefit from IV use for everyone.
- **TODO(client) magnesium-faq-3**: Which drip contains magnesium? The current Max Defense description explicitly includes magnesium. Ask the nurse to confirm its dose and whether it is appropriate for you.

### NAD+

- **TODO(client) nad-card**: Helps cells transfer energy from food through metabolic reactions.
- **TODO(client) nad-short**: NAD+ is a molecule found in cells that helps transfer electrons during energy metabolism. It also participates in processes involved in cell signaling and maintenance. NAD+ infusions are offered for wellness, but human evidence for meaningful wellness benefits remains limited.
- **TODO(client) nad-body-1**: Helps cells transfer energy from food through metabolic reactions.
- **TODO(client) nad-body-2**: Cycles between NAD+ and NADH.
- **TODO(client) nad-body-3**: Participates in enzyme reactions involved in cell maintenance.
- **TODO(client) nad-why**: People may explore NAD+ because they are interested in cellular energy. A molecule’s role in cells is not proof that an infusion will improve how energetic or focused you feel.
- **TODO(client) nad-safety**: Discuss your health history, current medicines, and previous infusion tolerance with your clinician. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) nad-faq-1**: How long does an NAD+ IV take? Elivation’s NAD+ visits currently list up to 2 hours 30 minutes. The team should confirm timing and any charges for additional time before booking.
- **TODO(client) nad-faq-2**: Will an NAD+ IV give me more energy? That outcome cannot be promised. Early human research on NAD+ handling in the body does not establish a reliable improvement in energy or focus.
- **TODO(client) nad-faq-3**: Is NAD+ the same as vitamin B3? No, NAD+ is a coenzyme, while vitamin B3 is a nutrient used in pathways that help make NAD+. Results for oral precursors cannot simply be applied to IV NAD+.
- **TODO(client) nad-faq-4**: Should I choose 250 mg or 500 mg? Ask the clinical team to review whether either option is appropriate. A higher listed amount does not establish a better wellness outcome.

### Taurine

- **TODO(client) taurine-card**: Participates in bile salt formation.
- **TODO(client) taurine-short**: Taurine is a compound found naturally in the body, often grouped with amino acids. It participates in bile salt formation and processes involved in cell balance. Evidence for a general wellness benefit from IV taurine is limited.
- **TODO(client) taurine-body-1**: Participates in bile salt formation.
- **TODO(client) taurine-body-2**: Is involved in the regulation of cell volume.
- **TODO(client) taurine-body-3**: Participates in processes related to cellular calcium handling.
- **TODO(client) taurine-why**: People interested in recovery or hydration may ask about taurine. Its normal physiological roles do not establish improved performance or recovery from a wellness infusion.
- **TODO(client) taurine-safety**: Ask your clinician about the proposed formula and route, particularly if you have kidney problems or receive specialist care. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) taurine-faq-1**: Is taurine a stimulant? Taurine is not caffeine. Its presence in some energy drinks does not mean an IV provides a stimulant effect.
- **TODO(client) taurine-faq-2**: Does taurine build muscle? A muscle-building benefit from an IV cannot be promised. Taurine is not used as a standard building block of body proteins.
- **TODO(client) taurine-faq-3**: Which drips contain taurine? The published menu does not confirm a taurine-containing formula. Ask the team for a current ingredient list before booking.

### Vitamin B12

- **TODO(client) vitamin-b12-card**: Supports normal nerve function.
- **TODO(client) vitamin-b12-short**: Vitamin B12 is a nutrient involved in normal nerve function, red blood cell formation, and DNA synthesis. It may be offered in injectable formulations, whose form and route should be checked. Extra B12 has not been shown to improve energy in people who already get enough.
- **TODO(client) vitamin-b12-body-1**: Supports normal nerve function.
- **TODO(client) vitamin-b12-body-2**: Participates in red blood cell formation.
- **TODO(client) vitamin-b12-body-3**: Is needed for DNA synthesis.
- **TODO(client) vitamin-b12-why**: People often ask about B12 when considering energy support. An essential nutritional role does not mean extra B12 will make someone with adequate intake feel more energetic.
- **TODO(client) vitamin-b12-safety**: Tell your clinician about any cobalt allergy, medicines, supplements, or recent B12 tests. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) vitamin-b12-faq-1**: Does B12 give you energy? B12 is needed for normal body function. Extra B12 has not been shown to improve energy in people who already get enough.
- **TODO(client) vitamin-b12-faq-2**: Are methylcobalamin and cyanocobalamin the same? Both are forms of vitamin B12. Ask which form is being offered and why it is appropriate for you.
- **TODO(client) vitamin-b12-faq-3**: Is a B12 shot the same as an IV? No, the routes are different. Ask the team to confirm the available product and route before booking.

### B-Complex

- **TODO(client) b-complex-card**: Some B vitamins help enzymes process carbohydrates.
- **TODO(client) b-complex-short**: B-Complex describes a combination of B vitamins rather than one ingredient. Several B vitamins help enzymes use nutrients from food. A blend’s exact contents vary, and that metabolic role does not establish extra energy from a wellness IV.
- **TODO(client) b-complex-body-1**: Some B vitamins help enzymes process carbohydrates.
- **TODO(client) b-complex-body-2**: Others participate in amino acid metabolism.
- **TODO(client) b-complex-body-3**: Individual B vitamins have distinct roles; a blend is not a standardized formula.
- **TODO(client) b-complex-why**: People interested in energy may ask about B vitamins. Evidence for a nutrient’s function does not prove that a particular IV blend improves fatigue or performance.
- **TODO(client) b-complex-safety**: Ask for the full ingredient list and review all vitamin supplements with your clinician to avoid overlapping doses. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) b-complex-faq-1**: Does B-Complex always contain B12? No, the name does not guarantee a specific recipe. Ask to see the exact formulation.
- **TODO(client) b-complex-faq-2**: Is B-Complex the same as biotin? No, biotin is one B vitamin. A B-Complex product combines several vitamins and may or may not include biotin.
- **TODO(client) b-complex-faq-3**: Will a B-Complex IV improve my energy? An energy boost cannot be promised. The vitamins’ metabolic roles do not establish benefits from an IV when intake is already adequate.

### Vitamin C

- **TODO(client) vitamin-c-card**: Helps make collagen, a structural protein in skin and connective tissue.
- **TODO(client) vitamin-c-short**: Vitamin C is a water-soluble nutrient involved in collagen production, normal immune function, and antioxidant protection. Some IV blends deliver it directly into the bloodstream, producing higher blood levels than oral intake. Higher blood levels alone do not establish better wellness outcomes.
- **TODO(client) vitamin-c-body-1**: Helps make collagen, a structural protein in skin and connective tissue.
- **TODO(client) vitamin-c-body-2**: Supports normal immune-system function.
- **TODO(client) vitamin-c-body-3**: Acts as an antioxidant, helping protect cells from free-radical damage.
- **TODO(client) vitamin-c-why**: If your interest is immune support or skin health, vitamin C’s normal roles may be relevant to your questions. Those roles do not establish that an IV improves immunity or skin appearance in someone already getting enough vitamin C.
- **TODO(client) vitamin-c-safety**: Talk with your clinician first if you have kidney disease, a history of kidney stones, G6PD deficiency, or iron overload. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) vitamin-c-faq-1**: Is IV vitamin C better than oral vitamin C? IV delivery produces higher blood concentrations than oral intake. That difference does not, by itself, prove better everyday health outcomes.
- **TODO(client) vitamin-c-faq-2**: Does IV vitamin C prevent colds? Vitamin C contributes to normal immune function, but that is not evidence that an IV prevents colds. This guide makes no cold-prevention promise.
- **TODO(client) vitamin-c-faq-3**: How long does a vitamin C drip take? Max Defense currently lists a visit length of about 75 minutes. Confirm the expected timing when booking.
- **TODO(client) vitamin-c-faq-4**: Can everyone receive IV vitamin C? No, suitability depends on health history and the proposed dose. Certain kidney conditions, G6PD deficiency, and iron overload require particular caution.

### Vitamin D

- **TODO(client) vitamin-d-card**: Helps the body absorb calcium.
- **TODO(client) vitamin-d-short**: Vitamin D is a fat-soluble vitamin involved in calcium absorption and normal bone and muscle function. Its role in nutrition does not establish that a wellness infusion is useful. Elivation’s available product and route need confirmation; an injection and an IV are not interchangeable.
- **TODO(client) vitamin-d-body-1**: Helps the body absorb calcium.
- **TODO(client) vitamin-d-body-2**: Supports normal bone maintenance.
- **TODO(client) vitamin-d-body-3**: Participates in normal muscle and immune function.
- **TODO(client) vitamin-d-why**: People may ask about vitamin D for general nutritional support. Decisions about extra vitamin D should consider total intake and clinical advice, not a promise of an immediate wellness effect.
- **TODO(client) vitamin-d-safety**: Ask your clinician before taking extra vitamin D if you have kidney problems, elevated calcium, or already take vitamin D products. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) vitamin-d-faq-1**: Is vitamin D offered in an IV drip? The current published menu does not confirm a vitamin D-containing IV. Ask the team to verify the product and route.
- **TODO(client) vitamin-d-faq-2**: Is more vitamin D always better? No, excessive vitamin D can be harmful. Review total intake with your clinician.
- **TODO(client) vitamin-d-faq-3**: Do I need a vitamin D blood test? Whether testing is appropriate depends on your circumstances. Ask your clinician rather than assuming an infusion or supplement is needed.

### Zinc

- **TODO(client) zinc-card**: Supports normal immune function.
- **TODO(client) zinc-short**: Zinc is a mineral involved in normal immune function, protein production, and cell division. Some nutrient formulations may include it, but Elivation’s current drip matches need confirmation. Evidence about oral zinc products does not establish a benefit from a wellness IV.
- **TODO(client) zinc-body-1**: Supports normal immune function.
- **TODO(client) zinc-body-2**: Participates in protein and DNA synthesis.
- **TODO(client) zinc-body-3**: Is involved in cell division and normal tissue maintenance.
- **TODO(client) zinc-why**: People interested in immune support may ask about zinc. Its normal function is not proof that an infusion prevents illness or improves skin appearance.
- **TODO(client) zinc-safety**: Review zinc supplements and medicines with your clinician: excess zinc can affect copper balance and interact with some medicines. Share your medicines, supplements, allergies, and previous infusion reactions with the nurse. The medical director must confirm the screening protocol, appropriate route, and any required tests.
- **TODO(client) zinc-faq-1**: Does IV zinc prevent colds? A cold-prevention benefit from IV zinc is not established here. Findings about oral lozenges do not demonstrate an IV benefit.
- **TODO(client) zinc-faq-2**: Can you have too much zinc? Yes, excess zinc can be harmful and affect copper balance. Discuss total intake and the proposed dose with your clinician.
- **TODO(client) zinc-faq-3**: Which drips contain zinc? The published menu does not confirm the complete ingredient lists. Ask the team for the current formula before choosing a drip.

### Shared approvals and formula gaps

- TODO(client): medical director name, credentials, actual review date and approval for all 12 pages. Reviewer fields are null until then.
- TODO(client): complete formulas, amounts, routes and availability for every drip. Published-menu matches only: Max Defense → vitamin C, magnesium; NAD+ 250mg / 500mg → NAD+; The Elivation → NAD+, glutathione.
- TODO(client): ingredient matches for Amino Blend, Biotin, Lipo-C/MIC, Taurine, B12, B-Complex, Vitamin D and Zinc. Confirm whether Vitamin D and Lipo-C/MIC are IV ingredients or separate injections.
- TODO(client): prices/durations and NAD+ additional-time charges, sourced from inc/treatments.php.
- TODO(client): screening, precautions, required tests and clinical protocols.
- TODO(client): booking provider support for the drip parameter; confirm the selection on the external booking site.
- TODO(client): goal tags describe browsing interests, not promised effects.
