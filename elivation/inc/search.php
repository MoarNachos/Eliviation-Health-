<?php
/**
 * Crawlable FAQ, page metadata and indexing controls for this theme.
 *
 * @package elivation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Create a native page so WordPress, its sitemap and its editors share one URL. */
function elivation_install_faq() {
	if ( get_option( 'elivation_faq_installed' ) ) {
		return;
	}
	$page = get_page_by_path( 'faq', OBJECT, array( 'page' ) );
	if ( ! $page ) {
		$page_id = wp_insert_post( array(
			'post_title'  => 'Mobile IV therapy FAQ',
			'post_name'   => 'faq',
			'post_type'   => 'page',
			'post_status' => 'publish',
		), true );
		if ( is_wp_error( $page_id ) || ! $page_id ) {
			return;
		}
	}
	update_option( 'elivation_faq_installed', 1 );
}
add_action( 'after_switch_theme', 'elivation_install_faq' );
add_action( 'admin_init', static function () {
	if ( current_user_can( 'publish_pages' ) ) {
		elivation_install_faq();
	}
} );

function elivation_faq_url() {
	$page = get_page_by_path( 'faq', OBJECT, array( 'page' ) );
	return $page && 'publish' === $page->post_status ? get_permalink( $page ) : '';
}

function elivation_is_faq() {
	return is_page() && 'faq' === get_page_uri( get_queried_object_id() );
}

/** Metadata for theme-owned pages only. Other site content keeps its own settings. */
function elivation_search_metadata() {
	if ( is_front_page() && ! is_paged() ) {
		return array(
			'title' => 'Mobile IV Therapy in Orange County & Los Angeles | Elivation Health',
			'description' => 'Elivation Health brings physician-directed IV hydration to homes, hotels, offices and events in Orange County and select Los Angeles communities. Explore treatments or book a nurse visit.',
			'url'   => home_url( '/' ),
			'image' => elivation_photo_url( 'hero-2' ),
		);
	}
	if ( elivation_is_faq() ) {
		return array(
			'title' => 'Mobile IV Therapy FAQ: Pricing, Coverage & Visits | Elivation Health',
			'description' => 'Find answers about mobile IV therapy in Orange County and Los Angeles, including prices, NAD+ visit lengths, nurse screening, service areas and booking for groups.',
			'url'   => get_permalink( get_queried_object_id() ),
			'image' => elivation_photo_url( 'hero-2' ),
		);
	}
	if ( elivation_is_page( 'about-us' ) ) {
		return array(
			'title'       => 'About Elivation Health: Our Nurses & Leadership Team',
			'description' => 'Meet the clinical team behind Elivation Health’s mobile IV visits, led by Chief Nursing Officer Richard Ladines, RN, BSN, and the Orange County leadership team.',
			'url'         => get_permalink( get_queried_object_id() ),
			'image'       => get_theme_file_uri( 'assets/images/richard-ladines.webp' ),
		);
	}
	if ( elivation_is_page( 'testimonials' ) ) {
		return array(
			'title'       => 'Client Reviews | Elivation Health Mobile IV Therapy',
			'description' => 'Read full reviews from Elivation Health clients about their at-home IV hydration visits with our registered nurses.',
			'url'         => get_permalink( get_queried_object_id() ),
			'image'       => elivation_photo_url( 'hero-2' ),
		);
	}
	$key = elivation_current_treatment();
	if ( ! $key ) {
		return array();
	}
	$treatment = elivation_treatment( $key );
	return array(
		'title' => sprintf( '%s IV therapy at home, from %s | Elivation Health', $treatment['name'], elivation_price( elivation_treatment_from_price( $treatment ) ) ),
		'description' => $treatment['meta'],
		'url'   => get_permalink( get_queried_object_id() ),
		'image' => elivation_photo_url( $treatment['photo'] ),
	);
}

/** Supply the same values to WordPress and to the SEO plugin when it owns the head. */
foreach ( array(
	'title'       => array( 'pre_get_document_title', 'wpseo_title', 'wpseo_opengraph_title', 'wpseo_twitter_title', 'rank_math/frontend/title' ),
	'description' => array( 'wpseo_metadesc', 'wpseo_opengraph_desc', 'wpseo_twitter_description', 'rank_math/frontend/description' ),
	'url'         => array( 'wpseo_opengraph_url' ),
	'image'       => array( 'wpseo_opengraph_image', 'wpseo_twitter_image' ),
) as $elivation_field => $elivation_hooks ) {
	foreach ( $elivation_hooks as $elivation_hook ) {
		add_filter( $elivation_hook, static function ( $original ) use ( $elivation_field ) {
			$meta = elivation_search_metadata();
			return $meta[ $elivation_field ] ?? $original;
		}, 20 );
	}
}

/** Core already emits rel_canonical for singular pages, including a static front page. */
function elivation_search_meta_tags() {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}
	$meta = elivation_search_metadata();
	if ( ! $meta ) {
		return;
	}
	if ( is_front_page() && ! is_singular() ) {
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $meta['url'] ) );
	}
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $meta['description'] ) );
	foreach ( array( 'type' => 'website', 'site_name' => 'Elivation Health', 'title' => $meta['title'], 'description' => $meta['description'], 'url' => $meta['url'], 'image' => $meta['image'] ) as $property => $value ) {
		printf( '<meta property="og:%s" content="%s">' . "\n", esc_attr( $property ), esc_attr( $value ) );
	}
}
add_action( 'wp_head', 'elivation_search_meta_tags', 1 );

/** Leave production crawler settings intact. Mark staging HTML explicitly, including static exports built in a staging environment. */
function elivation_is_staging_site() {
	if ( 'production' !== wp_get_environment_type() ) {
		return true;
	}
	$home = wp_parse_url( home_url( '/' ) );
	return in_array( $home['host'] ?? '', array( 'viacopia.co', 'www.viacopia.co' ), true )
		&& 0 === strpos( $home['path'] ?? '', '/elivation/' );
}

add_filter( 'wp_robots', static function ( $robots ) {
	if ( elivation_is_staging_site() ) {
		unset( $robots['index'] );
		$robots['noindex'] = true;
	}
	return $robots;
} );

foreach ( array( 'wpseo_robots_array', 'rank_math/frontend/robots' ) as $elivation_hook ) {
	add_filter( $elivation_hook, static function ( $robots ) {
		if ( elivation_is_staging_site() ) {
			$robots['index'] = 'noindex';
		}
		return $robots;
	}, 99 );
}

/** The structured and visible FAQ answers share their source in inc/faq.php. */
function elivation_faq_structured_data() {
	if ( ! elivation_is_faq() ) {
		return;
	}
	$questions = array();
	foreach ( elivation_faq_groups() as $group ) {
		foreach ( $group['items'] as $item ) {
			$questions[] = array(
				'@type'          => 'Question',
				'name'           => $item['q'],
				'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $item['a'] ),
			);
		}
	}
	$url      = get_permalink( get_queried_object_id() );
	$business = elivation_business_node();
	unset( $business['@context'] );
	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			$business,
			array(
				'@type'      => 'FAQPage',
				'@id'        => $url,
				'url'        => $url,
				'name'       => 'Mobile IV therapy FAQ',
				'publisher'  => array( '@id' => $business['@id'] ),
				'mainEntity' => $questions,
			),
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_HEX_TAG | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'elivation_faq_structured_data', 20 );
