<?php
/**
 * Team profiles, the medical director slot, and the site pages the theme links to
 * (About, Testimonials, Privacy).
 *
 * Bios are lightly edited from the profiles published on elivationhealth.com (Nov 2026).
 * Portraits are the original files from that site, bundled in assets/images/.
 *
 * @package elivation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Everyone on the About page, in display order, keyed by their anchor id.
 *
 * 'group' is 'clinical' (clinical leadership) or 'leadership' (founders and leadership).
 * 'summary' is the two-sentence version used on the homepage; only the featured
 * clinician needs one.
 *
 * @return array<string, array>
 */
function elivation_team() {
	return array(
		'richard-ladines' => array(
			'group'   => 'clinical',
			'name'    => 'Richard Ladines, RN, BSN',
			'role'    => 'Chief Nursing Officer',
			'photo'   => 'assets/images/richard-ladines.webp',
			'size'    => array( 797, 800 ),
			'alt'     => 'Richard Ladines, Chief Nursing Officer at Elivation Health',
			'summary' => array(
				'Richard leads our nursing team and oversees how Elivation’s nurses deliver care.',
				'He brings more than a decade of critical-care and mobile-care experience, including cardiothoracic, neurological and medical-surgical intensive care.',
			),
			'bio'     => array(
				'Richard is a Critical Care Registered Nurse with more than a decade of experience in high-acuity hospital and mobile healthcare settings. He specializes in cardiothoracic, neurological and medical-surgical intensive care, and brings that clinical background, and a compassionate, patient-centered approach, to Elivation.',
				'As Chief Nursing Officer, Richard leads the nursing team and oversees how our IV hydration services are delivered. His goal is wellness care that is evidence-based, personal and convenient, with every visit grounded in safety, trust and long-term well-being.',
				'Richard earned his BSN summa cum laude from Rowan University and holds degrees in Social Ecology and Sociology from UC Irvine. He is certified in ACLS, BLS, stroke care and infectious disease protocols, and is a member of the American Association of Critical-Care Nurses.',
				'Outside of work, Richard is a proud husband and father. He loves building LEGO creations with his son, collecting sets and spending time with his family. His approach to care is just as personal, rooted in family values, professional integrity and a passion for helping people feel their best.',
			),
		),
		'kathy-tran'      => array(
			'group' => 'clinical',
			'name'  => 'Kathy Tran',
			'role'  => 'Clinical Operations Lead',
			'photo' => 'assets/images/team/kathy-tran.png',
			'size'  => array( 300, 300 ),
			'alt'   => 'Kathy Tran, Clinical Operations Lead at Elivation Health',
			'bio'   => array(
				'Kathy spent most of her career in accounting and human resources, where she learned to value organization, efficiency and supporting others. After COVID, conversations with her husband and a wish to make a more meaningful impact led her to healthcare, with the goal of becoming a Registered Nurse.',
				'As Clinical Operations Lead, Kathy works closely with Elivation’s medical, nursing and operations leadership to keep each day running smoothly for our nurses and dispatch team, so every client receives an elevated standard of care.',
				'Kathy also trained in esthetics after COVID, bringing together her interest in wellness and self-care with her commitment to helping others.',
				'Born in Massachusetts and raised in California, Kathy loves traveling the world, exploring authentic cuisines and spending time with her family. As a wife and mother of one, she makes the most of every chance to build lasting memories with the people she loves.',
			),
		),
		'jon-lai'         => array(
			'group' => 'leadership',
			'name'  => 'Jon Lai',
			'role'  => 'Chief Operating Officer',
			'photo' => 'assets/images/team/jon-lai.png',
			'size'  => array( 300, 300 ),
			'alt'   => 'Jon Lai, Chief Operating Officer at Elivation Health',
			'bio'   => array(
				'Jon has called Southern California home since he was eight, and technology has been part of his life the whole time. He started writing code at an early age and began a Computer Science degree before graduating from UC Irvine with a bachelor’s degree in Economics.',
				'After starting his career at a financial investment firm in Los Angeles, Jon realized his real passion was technology and moved into IT and operations, where he has worked ever since.',
				'Jon has been married for almost 20 years and has two sons. In his free time he golfs and travels with family and friends, and he and his wife share a passion for food and adventure.',
			),
		),
		'charles-antis'   => array(
			'group' => 'leadership',
			'name'  => 'Charles Antis',
			'role'  => 'Chief Marketing Officer · Founder, Antis Roofing & Waterproofing',
			'photo' => 'assets/images/team/charles-antis.png',
			'size'  => array( 300, 300 ),
			'alt'   => 'Charles Antis, Chief Marketing Officer at Elivation Health',
			'bio'   => array(
				'Charles is a roofing expert, entrepreneur and humanitarian, and one of the most trusted names in roofing nationwide. In 2024, Antis Roofing & Waterproofing celebrated 35 years of “Keeping Families Safe & Dry.”',
				'He has served on a dozen national and local boards. With the National Roofing Contractors Association, he co-initiated the national adoption of all 165 Ronald McDonald Houses across the country. Locally, he served on the board of Ronald McDonald House Orange County, co-chaired its capital campaign to double the size of the house and chaired the Rock the Socks campaign.',
				'Charles has also served on the boards of Orange County United Way and the CSUF Center for Leadership. He currently serves on the boards of the Boys & Girls Club of Central Orange Coast, Team Kids and Habitat for Humanity of Orange County, where he has donated every roof installation since 2009.',
				'A storyteller and sought-after speaker, Charles has received many awards, including the 2023 Ronald McDonald House Bill Moore Award, 2022 Irvine Chamber Business Philanthropist of the Year and the 2017 US Chamber of Commerce Corporate Citizens Award, and has been a Civic 50 honoree each year since 2017.',
			),
		),
		'eric-l-goodman'  => array(
			'group' => 'leadership',
			'name'  => 'Eric L. Goodman',
			'role'  => 'Chief Innovation Officer · CEO, MVS, Inc.',
			'photo' => 'assets/images/team/eric-l-goodman.png',
			'size'  => array( 300, 300 ),
			'alt'   => 'Eric L. Goodman, Chief Innovation Officer at Elivation Health',
			'bio'   => array(
				'Eric is President and CEO of MVS, Inc. (Mountain View Services), a healthcare supply and distribution company serving more than 500 care facilities, including homes for developmentally disabled adults and children, home care and hospice companies, nonprofits, schools and homeless shelters.',
				'In 2023 he acquired Chem-Pak, a janitorial, facility and office supply company, from his father, making the 37-year-old family business second-generation owned.',
				'Eric believes in building relationships within the community. He has served on the boards of nonprofits including the American Heart Association and Ronald McDonald House Charities. MVS was a Points of Light Civic 50 honoree in 2022, 2023 and 2024, and Eric was named the Greater Irvine Chamber Philanthropist of the Year in 2024.',
				'Eric and his wife, Roxanne, have been married for 30 years. They have two children, Vanessa and Grant, and a grandchild, Delaney. A photographer whose work has appeared in galleries, he donates all proceeds from it to charity. He is also a classic car enthusiast and President of the Vintage Volkswagen Club of America.',
			),
		),
	);
}

/**
 * The medical director's approved profile, or null until the founders supply one.
 *
 * TODO(client): supply the medical director's name, credentials, a portrait and an approved
 * description of their role. Until then this stays null and no profile is shown; the pages
 * keep the general explanation of physician oversight instead. Do not fill this in from a
 * corporate filing or a matching physician name.
 *
 * Expected shape (same as elivation_team() entries): name, role, photo, size, alt, summary, bio.
 *
 * @return array|null
 */
function elivation_medical_director() {
	return null;
}

/**
 * URL of a profile on the About page, for example elivation_profile_url( 'richard-ladines' ).
 *
 * @param string $id Profile anchor id.
 * @return string
 */
function elivation_profile_url( $id ) {
	return elivation_page_url( 'about-us' ) . '#' . rawurlencode( $id );
}

/**
 * Markup for one profile: portrait, name, role and bio (or the short summary).
 *
 * @param string $id      Profile anchor id.
 * @param array  $person  Entry from elivation_team().
 * @param string $variant 'full' (bio) or 'summary' (homepage).
 * @param string $heading Heading tag for the name.
 * @return string
 */
function elivation_profile( $id, $person, $variant = 'full', $heading = 'h3' ) {
	$lines = 'summary' === $variant && ! empty( $person['summary'] ) ? $person['summary'] : $person['bio'];
	$html  = '<article class="eh-profile eh-profile--' . esc_attr( $variant ) . '" id="' . esc_attr( $id ) . '">';
	$html .= '<figure class="eh-profile__photo"><img src="' . esc_url( get_theme_file_uri( $person['photo'] ) ) . '" width="' . (int) $person['size'][0] . '" height="' . (int) $person['size'][1] . '" loading="lazy" alt="' . esc_attr( $person['alt'] ) . '"></figure>';
	$html .= '<div class="eh-profile__body">';
	$html .= '<' . $heading . ' class="eh-profile__name">' . esc_html( $person['name'] ) . '</' . $heading . '>';
	$html .= '<p class="eh-profile__role">' . esc_html( $person['role'] ) . '</p>';
	$html .= '<div class="eh-profile__bio">';
	foreach ( $lines as $line ) {
		$html .= '<p>' . esc_html( $line ) . '</p>';
	}
	$html .= '</div></div></article>';
	return $html;
}

/* -------------------------------------------------------------------------
 * Site pages: About, Testimonials, Privacy
 * ---------------------------------------------------------------------- */

/**
 * Pages the theme links to. Each is created only when no page with that slug exists,
 * so pages (and editor-managed content) on an existing site are left alone.
 *
 * @return array<string, array{title: string, content_file?: string}>
 */
function elivation_site_pages() {
	return array(
		'about-us'       => array( 'title' => 'About Us' ),
		'testimonials'   => array( 'title' => 'Testimonials' ),
		'privacy-policy' => array(
			'title'        => 'Privacy Policy',
			// Verbatim copy of the notice published at elivationhealth.com/privacy-policy/ (Nov 2026).
			'content_file' => 'content/privacy-policy.html',
		),
	);
}

/** Create any missing site pages. Runs once per site; existing pages are never changed. */
function elivation_ensure_site_pages() {
	if ( get_option( 'elivation_site_pages_installed' ) ) {
		return;
	}
	foreach ( elivation_site_pages() as $slug => $spec ) {
		$existing = get_page_by_path( $slug, OBJECT, array( 'page' ) );
		// WordPress creates an unpublished "Privacy Policy" draft on install. If that draft is
		// still untouched, fill it with the real notice; any other existing page is left alone.
		$is_install_draft = $existing
			&& 'privacy-policy' === $slug
			&& 'draft' === $existing->post_status
			&& $existing->post_modified_gmt === $existing->post_date_gmt
			&& (int) get_option( 'wp_page_for_privacy_policy' ) === (int) $existing->ID;
		if ( $existing && ! $is_install_draft ) {
			continue;
		}
		$content = '';
		if ( ! empty( $spec['content_file'] ) ) {
			$path    = get_theme_file_path( $spec['content_file'] );
			$content = is_readable( $path ) ? (string) file_get_contents( $path ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			if ( '' === $content ) {
				continue; // Never publish an empty privacy notice.
			}
			$content = "<!-- wp:html -->\n" . $content . "<!-- /wp:html -->\n";
		}
		$page = array(
			'post_title'   => $spec['title'],
			'post_name'    => $slug,
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_content' => $content,
		);
		if ( $is_install_draft ) {
			$page['ID'] = $existing->ID;
		}
		$page_id = wp_insert_post( $page, true );
		if ( 'privacy-policy' === $slug && $page_id && ! is_wp_error( $page_id ) && ! get_option( 'wp_page_for_privacy_policy' ) ) {
			update_option( 'wp_page_for_privacy_policy', $page_id );
		}
	}
	update_option( 'elivation_site_pages_installed', 1 );
}
add_action( 'after_switch_theme', 'elivation_ensure_site_pages' );
add_action(
	'admin_init',
	static function () {
		if ( current_user_can( 'publish_pages' ) ) {
			elivation_ensure_site_pages();
		}
	}
);

/**
 * Permalink of a published page by slug, falling back to /<slug>/ under the site URL,
 * so links work on production and under the /elivation/ staging path.
 *
 * @param string $slug Page slug.
 * @return string
 */
function elivation_page_url( $slug ) {
	$page = get_page_by_path( $slug, OBJECT, array( 'page' ) );
	if ( $page && 'publish' === $page->post_status ) {
		return get_permalink( $page );
	}
	return home_url( '/' . $slug . '/' );
}

/** URL of the privacy notice: WordPress's privacy page setting, else the privacy-policy page. */
function elivation_privacy_url() {
	$url = get_privacy_policy_url();
	return $url ? $url : elivation_page_url( 'privacy-policy' );
}

/**
 * URL of the full reviews page, optionally at one review.
 *
 * @param string $review_id Review id from content/reviews.json, for example 'r4'.
 * @return string
 */
function elivation_reviews_url( $review_id = '' ) {
	$url = elivation_page_url( 'testimonials' );
	return $review_id ? $url . '#review-' . rawurlencode( $review_id ) : $url;
}

/** Whether the current request is the given theme page. */
function elivation_is_page( $slug ) {
	return is_page() && get_page_uri( get_queried_object_id() ) === $slug;
}
