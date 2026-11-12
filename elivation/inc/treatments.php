<?php
/**
 * Treatment landing pages: Recovery, Relief and Rejuvenation.
 *
 * - elivation_treatments(): every drip, price, duration, "good for" line and FAQ
 * - Creates the pages /treatments/recovery, /treatments/relief and
 *   /treatments/rejuvenation (on theme activation, and once from wp-admin for
 *   sites where the theme was already active)
 * - Uses templates/treatment.html for those pages
 * - Unique title, meta description, and MedicalBusiness + Service + FAQPage JSON-LD
 *
 * Source for drips, prices and durations: elivationhealth.com, Aug 2026
 * (design_handoff_homepage/design/templates/treatment/treatments-data.js).
 * TODO(client): verify every drip name, price, duration and description before launch.
 *
 * @package elivation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ELIVATION_TREATMENTS_PARENT', 'treatments' );
define( 'ELIVATION_TREATMENT_PAGES_VERSION', '1' );

/* -------------------------------------------------------------------------
 * Content
 * ---------------------------------------------------------------------- */

/**
 * All three treatment categories, keyed by page slug.
 *
 * Each FAQ answer is plain text; it is shown on the page and copied into the
 * FAQPage JSON-LD, so keep the two in step by editing only here.
 *
 * @return array<string, array>
 */
function elivation_treatments() {
	$treatments = array(
		'recovery'     => array(
			'name'        => 'Recovery',
			// H1: plain part, then the italic serif part.
			'h1'          => array( 'IV hydration after ', 'training or travel.' ),
			'promise'     => 'Home from a race, a long flight or a late night? A registered nurse can bring IV hydration to your home or hotel. They’ll check your vitals and talk through your options before you start.',
			'meta'        => 'At-home recovery IV visits after training or travel in Orange County and parts of Los Angeles. See options, prices and what to expect from your nurse.',
			'fit_heading' => array( 'When people book ', 'a recovery visit.' ),
			'photo'       => 'community-2',
			'session'     => '1h 15m',
			// Review ids from content/reviews.json; mentions "hangover remedies".
			'reviews'     => array( 'r5' ),
			'excerpts'    => array( 'r5' => 'My nurse, Joshua, was extremely professional and guided me through the process with ease.' ),
			'good_for'    => array(
				'After a race or tournament',
				'After a long training block',
				'When you arrive after a long flight',
				'The morning after a celebration',
			),
			'drips'       => array(
				array( 'id' => 'myers', 'name' => 'Myers\' Cocktail', 'price' => 245, 'dur' => '1h 15m', 'desc' => 'A vitamin and mineral infusion. Ask your nurse what’s in the blend and whether it fits your visit.' ),
				array( 'id' => 'defense', 'name' => 'Defense', 'price' => 279, 'dur' => '1h 15m', 'desc' => 'A blend of vitamins and antioxidants. Your nurse reviews the ingredients with you during screening.' ),
				array( 'id' => 'hangover', 'name' => 'Hangover Remedy', 'price' => 279, 'dur' => '1h 15m', 'desc' => 'IV hydration for the morning after a celebration. Let your nurse know about any headache or nausea before the infusion.' ),
				array( 'id' => 'performance', 'name' => 'Performance', 'price' => 359, 'dur' => '1h 15m', 'desc' => 'A hydration and nutrient blend for a visit after a race, game or training session.' ),
				array( 'id' => 'maxdefense', 'name' => 'Max Defense', 'price' => 369, 'dur' => '1h 15m', 'desc' => 'This blend includes high-dose vitamin C and magnesium. Your nurse checks whether these ingredients are appropriate for you.' ),
				array( 'id' => 'buildabag', 'name' => 'Build-a-Bag', 'price' => 420, 'dur' => '1h 15m', 'desc' => 'Your nurse builds a bag around your goals, with four add-ons included.', 'tag' => 'Customizable' ),
			),
			// TODO(client): have every FAQ answer on all three pages checked by the medical director,
			// in particular: emergency symptoms (Relief), pregnancy (Relief), NAD+ infusion speed
			// (Rejuvenation), HSA / FSA (Rejuvenation) and "Same-day visits are often available" (Relief).
			'faq'         => array(
				array(
					'q' => 'Which Recovery drip should I pick?',
					'a' => 'Performance is the option designed for training days. Myers’ Cocktail is a vitamin and mineral blend. If you’re deciding between them, call before booking. A nurse can explain the ingredients and what to expect.',
				),
				array(
					'q' => 'How long does a Recovery drip take?',
					'a' => 'Plan for about 1 hour 15 minutes, including the health screening. You can stay on the couch, work or nap while it runs.',
				),
				array(
					'q' => 'How soon after a race or game can I book?',
					'a' => 'Many people book for the same afternoon or the next morning. Tell us when you finish and where you\'ll be, and we\'ll tell you what\'s open. If you feel dizzy, confused or have chest pain after exercise, call 911 first.',
				),
				array(
					'q' => 'Will a Hangover Remedy drip fix a hangover?',
					'a' => 'It can\'t promise that. It rehydrates you and replaces nutrients, which may ease nausea, headache and fatigue. Your nurse will check your vitals first and may suggest waiting or another option.',
				),
				array(
					'q' => 'What does Build-a-Bag include?',
					'a' => 'Your nurse builds the bag around your goals, with four add-ons included in the price. They\'ll go through the options with you after your health screening.',
				),
				array(
					'q' => 'Can I book Recovery drips for a team or a group?',
					'a' => 'Yes. We bring a nurse team to races, tournaments, offsites and celebrations. Tell us about it through Events & Groups and we\'ll put a quote together.',
				),
			),
		),
		'relief'       => array(
			'name'        => 'Relief',
			'h1'          => array( 'When you feel awful, the last thing you want is ', 'a waiting room.' ),
			'promise'     => 'If nausea or a stomach bug has made it hard to stay hydrated, a registered nurse can assess you at home and discuss whether IV fluids are appropriate.',
			'meta'        => 'Explore mobile IV hydration for illness-related dehydration in Orange County and parts of Los Angeles. See visit prices and ask a nurse whether home care fits.',
			'fit_heading' => array( 'Is an at-home visit ', 'right for you?' ),
			'photo'       => 'event-4',
			'session'     => '1h 15m',
			// General account of a home visit. Do not present it as a Relief treatment outcome.
			'reviews'     => array( 'r4' ),
			'excerpts'    => array( 'r4' => 'Richard arrived right on time, fully equipped, and made me feel comfortable from the moment he walked in.' ),
			'good_for'    => array(
				'Cold and flu symptoms',
				'Food poisoning or stomach bugs',
				'Migraines and tension headaches',
				'Nausea, including motion sickness',
			),
			'drips'       => array(
				array( 'id' => 'basic', 'name' => 'Basic Drip', 'price' => 185, 'dur' => '1h 15m', 'desc' => 'Sterile saline for hydration. Your nurse can help you choose between saline and an electrolyte solution.' ),
				array( 'id' => 'lr', 'name' => 'Lactated Ringer\'s', 'price' => 185, 'dur' => '1h 15m', 'desc' => 'A balanced electrolyte solution for hydration. Your nurse will review your health history before choosing a fluid.' ),
				array( 'id' => 'nausea', 'name' => 'Nausea', 'price' => 215, 'dur' => '1h 15m', 'desc' => 'An option when nausea has made drinking fluids difficult. Tell your nurse if you’re pregnant or may be pregnant.' ),
				array( 'id' => 'migraine', 'name' => 'Migraine Relief', 'price' => 229, 'dur' => '1h 15m', 'desc' => 'An option for people who experience migraines. Your nurse will ask about your symptoms and assess whether home care is appropriate.' ),
				array( 'id' => 'coldflu', 'name' => 'Cold & Flu', 'price' => 299, 'dur' => '1h 15m', 'desc' => 'A hydration option when a cold or flu has made it difficult to keep up with fluids.' ),
				array( 'id' => 'foodpoison', 'name' => 'Food Poisoning', 'price' => 329, 'dur' => '1h 15m', 'desc' => 'An infusion with electrolytes, vitamins and medication. Your nurse reviews your symptoms, medications and allergies first.' ),
			),
			'faq'         => array(
				array(
					'q' => 'Should I go to urgent care or the ER instead?',
					'a' => 'IV therapy is not emergency care. Call 911 or go to the ER for chest pain, trouble breathing, confusion, a stiff neck with fever, fainting, blood in vomit or stool, or the worst headache of your life.',
				),
				array(
					'q' => 'How fast can a nurse get to me?',
					'a' => 'Same-day visits are often available. Book online or call, and we\'ll give you an arrival window before you confirm.',
				),
				array(
					'q' => 'Do Relief drips include medication?',
					'a' => 'Some can. The Food Poisoning drip includes medication, and your nurse may offer anti-nausea or other add-ons if our physician-directed protocols say they\'re right for you. Everything is checked against your health screening first.',
				),
				array(
					'q' => 'What\'s the difference between the Basic Drip and Lactated Ringer\'s?',
					'a' => 'Both rehydrate you. The Basic Drip is sterile saline. Lactated Ringer\'s is a balanced electrolyte solution. Your nurse can help you choose based on how you feel.',
				),
				array(
					'q' => 'Can I get a drip while I\'m pregnant?',
					'a' => 'Tell us when you book. The Nausea drip is often asked about for morning sickness, but whether it\'s right for you depends on your health screening, and we may ask you to check with your doctor first.',
				),
				array(
					'q' => 'How long does a Relief visit take?',
					'a' => 'About 1 hour 15 minutes, including the health screening. You can stay in bed the whole time.',
				),
			),
		),
		'rejuvenation' => array(
			'name'        => 'Rejuvenation',
			'h1'          => array( 'NAD+ and wellness infusions, ', 'at home.' ),
			'promise'     => 'Compare shorter wellness visits with longer NAD+ infusions. Your registered nurse checks your vitals, sets the pace of the infusion and stays with you throughout your visit.',
			'meta'        => 'Compare at-home wellness and NAD+ infusion visits in Orange County and parts of Los Angeles. See individual prices, visit lengths and how your nurse monitors you.',
			'fit_heading' => array( 'Exploring your ', 'wellness options?' ),
			'photo'       => 'community-3',
			'session'     => '1h 15m – 2h 30m',
			// Review ids from content/reviews.json; mentions "IV + NAD treatment".
			'reviews'     => array( 'r3' ),
			'excerpts'    => array( 'r3' => 'He came right to my home, made the process easy and comfortable' ),
			'good_for'    => array(
				'You’re considering NAD+ for the first time',
				'You’ve had NAD+ and want to compare the options',
				'You’re interested in the Radiance blend',
				'You have questions about an infusion for menstrual discomfort',
			),
			'drips'       => array(
				array( 'id' => 'pms', 'name' => 'Premenstrual Tension', 'price' => 239, 'dur' => '1h 15m', 'desc' => 'An infusion offered for premenstrual discomfort. Your nurse reviews your symptoms and the ingredients with you before the visit proceeds.' ),
				array( 'id' => 'radiance', 'name' => 'Radiance', 'price' => 279, 'dur' => '1h 15m', 'desc' => 'Our skin, hair and nail wellness blend. Your nurse can explain the ingredients before your infusion.' ),
				array( 'id' => 'nad250', 'name' => 'NAD+ 250mg', 'price' => 449, 'dur' => 'Up to 2h 30m', 'desc' => 'A 250 mg NAD+ infusion given slowly while your nurse monitors your comfort. An additional 50 mg is $60.' ),
				array( 'id' => 'elivation', 'name' => 'The Elivation', 'price' => 539, 'dur' => 'Up to 2h 30m', 'desc' => 'Our signature infusion combines NAD+ with glutathione. An additional 50 mg of NAD+ is $60.', 'tag' => 'Signature' ),
				array( 'id' => 'nad500', 'name' => 'NAD+ 500mg', 'price' => 649, 'dur' => 'Up to 2h 30m', 'desc' => 'A 500 mg NAD+ infusion. Your nurse will ask about previous infusions and how well you tolerated them. An additional 50 mg is $60.' ),
			),
			'faq'         => array(
				array(
					'q' => 'Why do NAD+ drips take up to 2.5 hours?',
					'a' => 'NAD+ is given slowly. Running it faster can feel uncomfortable, so your nurse sets the pace and adjusts it as you go. Plan to settle in with a show, a book or work.',
				),
				array(
					'q' => 'Should I start with 250mg or 500mg of NAD+?',
					'a' => 'Tell your nurse if this is your first NAD+ infusion or how previous visits felt. They’ll review the options and whether an infusion is appropriate for you.',
				),
				array(
					'q' => 'What is The Elivation?',
					'a' => 'Our signature infusion combines NAD+ with glutathione. Allow up to 2 hours 30 minutes for your visit.',
				),
				array(
					'q' => 'When will I notice a difference?',
					'a' => 'It varies from person to person, and we can\'t promise a result. Some people book a series. Your nurse can talk through what\'s realistic for you.',
				),
				array(
					'q' => 'Can I book Rejuvenation drips for a group?',
					'a' => 'Yes, for wellness days, bridal parties and offsites. NAD+ sessions are long, so tell us how much time you have and we\'ll plan around it through Events & Groups.',
				),
				array(
					'q' => 'Can I pay with HSA or FSA?',
					'a' => 'Ask us when you book and we\'ll tell you how HSA and FSA cards work with your visit. Your plan administrator has the final say on what\'s covered.',
				),
			),
		),
	);

	return apply_filters( 'elivation_treatments', $treatments );
}

/**
 * One treatment, or null.
 *
 * @param string $key recovery, relief or rejuvenation.
 * @return array|null
 */
function elivation_treatment( $key ) {
	$all = elivation_treatments();
	return isset( $all[ $key ] ) ? $all[ $key ] : null;
}

/**
 * Lowest drip price in a treatment.
 *
 * @param array $treatment Treatment data.
 * @return int
 */
function elivation_treatment_from_price( $treatment ) {
	return (int) min( wp_list_pluck( $treatment['drips'], 'price' ) );
}

/**
 * Public URL of a treatment page.
 *
 * @param string $key Treatment key.
 * @return string
 */
function elivation_treatment_url( $key ) {
	return home_url( '/' . ELIVATION_TREATMENTS_PARENT . '/' . $key . '/' );
}

/**
 * Key of the treatment page being viewed, or null.
 *
 * In the site editor (no queried treatment page) patterns fall back to
 * Recovery so the template still previews.
 *
 * @param bool $fallback Return 'recovery' when not on a treatment page.
 * @return string|null
 */
function elivation_current_treatment( $fallback = false ) {
	$post = get_queried_object();
	if ( $post instanceof WP_Post && 'page' === $post->post_type && elivation_treatment( $post->post_name ) ) {
		$parent = $post->post_parent ? get_post( $post->post_parent ) : null;
		if ( $parent && ELIVATION_TREATMENTS_PARENT === $parent->post_name ) {
			return $post->post_name;
		}
	}
	return $fallback ? 'recovery' : null;
}

/**
 * Format a price for display.
 *
 * @param int $price Whole dollars.
 * @return string
 */
function elivation_price( $price ) {
	return '$' . number_format_i18n( (int) $price );
}

/* -------------------------------------------------------------------------
 * Pages and template
 * ---------------------------------------------------------------------- */

/**
 * Create the /treatments/ parent page and one child page per treatment.
 * Safe to run more than once: existing pages are left alone.
 */
function elivation_ensure_treatment_pages() {
	$parent = get_page_by_path( ELIVATION_TREATMENTS_PARENT );
	if ( ! $parent ) {
		$parent_id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => 'Treatments',
				'post_name'    => ELIVATION_TREATMENTS_PARENT,
				'post_content' => '',
			)
		);
		if ( is_wp_error( $parent_id ) || ! $parent_id ) {
			return;
		}
	} else {
		$parent_id = $parent->ID;
	}

	$order = 0;
	foreach ( elivation_treatments() as $key => $treatment ) {
		++$order;
		if ( get_page_by_path( ELIVATION_TREATMENTS_PARENT . '/' . $key ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_type'     => 'page',
				'post_status'   => 'publish',
				'post_title'    => $treatment['name'],
				'post_name'     => $key,
				'post_parent'   => $parent_id,
				'menu_order'    => $order,
				'post_content'  => '',
				'page_template' => 'treatment',
			)
		);
	}

	update_option( 'elivation_treatment_pages', ELIVATION_TREATMENT_PAGES_VERSION );
}
add_action( 'after_switch_theme', 'elivation_ensure_treatment_pages' );

/**
 * Sites where the theme was active before this code existed: create the pages
 * the first time an administrator opens wp-admin.
 */
function elivation_maybe_ensure_treatment_pages() {
	if ( ELIVATION_TREATMENT_PAGES_VERSION !== get_option( 'elivation_treatment_pages' ) && current_user_can( 'publish_pages' ) ) {
		elivation_ensure_treatment_pages();
	}
}
add_action( 'admin_init', 'elivation_maybe_ensure_treatment_pages' );

/**
 * Always use the treatment template for the three treatment pages, even if
 * someone created them by hand without picking it.
 *
 * @param string[] $templates Template hierarchy.
 * @return string[]
 */
function elivation_treatment_template_hierarchy( $templates ) {
	if ( elivation_current_treatment() ) {
		array_unshift( $templates, 'treatment' );
	}
	return $templates;
}
add_filter( 'page_template_hierarchy', 'elivation_treatment_template_hierarchy' );

/**
 * /treatments/ itself has no page of its own yet: send it to the homepage section.
 *
 * TODO(build): replace with a drip comparison page if the client wants one.
 */
function elivation_treatments_parent_redirect() {
	if ( is_page( ELIVATION_TREATMENTS_PARENT ) && ! get_post_field( 'post_parent', get_queried_object_id() ) ) {
		wp_safe_redirect( home_url( '/#treatments' ), 302 );
		exit;
	}
}
add_action( 'template_redirect', 'elivation_treatments_parent_redirect' );

/**
 * Body classes for treatment pages (used to swap in the treatment booking bar).
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function elivation_treatment_body_class( $classes ) {
	$key = elivation_current_treatment();
	if ( $key ) {
		$classes[] = 'eh-treatment-page';
		$classes[] = 'eh-treatment-page--' . $key;
	}
	return $classes;
}
add_filter( 'body_class', 'elivation_treatment_body_class' );

/* -------------------------------------------------------------------------
 * Title, meta description, structured data
 * ---------------------------------------------------------------------- */

/**
 * Preload the hero photo on treatment pages.
 */
function elivation_treatment_preload_hero() {
	$key = elivation_current_treatment();
	if ( ! $key ) {
		return;
	}
	$photo  = elivation_treatment( $key )['photo'];
	$srcset = elivation_photo_srcset( $photo );
	if ( '' === $srcset ) {
		return;
	}
	printf(
		'<link rel="preload" as="image" type="image/webp" href="%s" imagesrcset="%s" imagesizes="(min-width: 1024px) 50vw, 100vw" fetchpriority="high">' . "\n",
		esc_url( elivation_photo_url( $photo ) ),
		esc_attr( $srcset )
	);
}
add_action( 'wp_head', 'elivation_treatment_preload_hero', 2 );

/**
 * MedicalBusiness + Service (with an offer per drip) + FAQPage + breadcrumbs.
 */
function elivation_treatment_json_ld() {
	$key = elivation_current_treatment();
	if ( ! $key ) {
		return;
	}
	$treatment = elivation_treatment( $key );
	$url       = elivation_treatment_url( $key );
	$business  = elivation_business_node();

	$offers = array();
	foreach ( $treatment['drips'] as $drip ) {
		$offers[] = array(
			'@type'         => 'Offer',
			'name'          => $drip['name'],
			'description'   => $drip['desc'],
			'price'         => (string) $drip['price'],
			'priceCurrency' => 'USD',
			'url'           => $url . '#drip-' . $drip['id'],
		);
	}

	$service = array(
		'@type'       => 'Service',
		'@id'         => $url . '#service',
		'name'        => $treatment['name'] . ' IV therapy',
		'serviceType' => 'Mobile IV therapy',
		'description' => $treatment['promise'],
		'url'         => $url,
		'image'       => elivation_photo_url( $treatment['photo'] ),
		'provider'    => array( '@id' => $business['@id'] ),
		'areaServed'  => $business['areaServed'],
		'offers'      => array(
			'@type'         => 'AggregateOffer',
			'priceCurrency' => 'USD',
			'lowPrice'      => (string) elivation_treatment_from_price( $treatment ),
			'highPrice'     => (string) max( wp_list_pluck( $treatment['drips'], 'price' ) ),
			'offerCount'    => count( $offers ),
			'offers'        => $offers,
		),
	);

	$faq = array(
		'@type'      => 'FAQPage',
		'@id'        => $url . '#faq',
		'mainEntity' => array_map(
			static function ( $item ) {
				return array(
					'@type'          => 'Question',
					'name'           => $item['q'],
					'acceptedAnswer' => array(
						'@type' => 'Answer',
						'text'  => $item['a'],
					),
				);
			},
			$treatment['faq']
		),
	);

	$breadcrumbs = array(
		'@type'           => 'BreadcrumbList',
		'itemListElement' => array(
			array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
			array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Treatments', 'item' => home_url( '/#treatments' ) ),
			array( '@type' => 'ListItem', 'position' => 3, 'name' => $treatment['name'], 'item' => $url ),
		),
	);

	unset( $business['@context'] );
	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => array( $business, $service, $faq, $breadcrumbs ),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'elivation_treatment_json_ld', 20 );
