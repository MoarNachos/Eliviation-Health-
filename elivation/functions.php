<?php
/**
 * Elivation theme functions.
 *
 * - Enqueues Google Fonts, the generated tokens and the theme stylesheet
 * - Registers the pattern category
 * - Photo helpers: URLs, alt text from picks.txt, responsive srcset, hero preload
 * - MedicalBusiness JSON-LD
 *
 * Forms are not wired to anything yet (content first). See TODO.md.
 *
 * @package elivation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ELIVATION_VERSION', '0.1.0' );
define( 'ELIVATION_BOOKING_URL', 'https://book.elivationhealth.com/' );
define( 'ELIVATION_PHONE_DISPLAY', '(949) 561-0590' );
define( 'ELIVATION_PHONE_TEL', '+19495610590' );
define( 'ELIVATION_INSTAGRAM_URL', 'https://www.instagram.com/elivation.health' );

/* -------------------------------------------------------------------------
 * Content that is shared between patterns and structured data
 * ---------------------------------------------------------------------- */

/**
 * Cities shown in the service-areas section and in JSON-LD areaServed.
 *
 * TODO(client): verify this city list before launch (README item marked with a warning).
 *
 * @return string[]
 */
function elivation_service_cities() {
	return apply_filters(
		'elivation_service_cities',
		array(
			'Irvine',
			'Newport Beach',
			'Costa Mesa',
			'Huntington Beach',
			'Laguna Beach',
			'Tustin',
			'Anaheim',
			'Mission Viejo',
			'Dana Point',
			'Long Beach',
			'Los Angeles',
		)
	);
}

/**
 * ZIP codes the service covers. Empty by default, which turns the
 * out-of-area message off: every 5-digit ZIP is passed to the booking site.
 *
 * TODO(client): supply the list of covered ZIP codes. Add them with the
 * `elivation_service_zips` filter or replace the array below.
 *
 * @return string[]
 */
function elivation_service_zips() {
	return apply_filters( 'elivation_service_zips', array() );
}

/* -------------------------------------------------------------------------
 * Theme setup and assets
 * ---------------------------------------------------------------------- */

/**
 * Google Fonts URL. These are the substitutes named in the brand guide;
 * replace with licensed files if the brand supplies them.
 *
 * @return string
 */
function elivation_fonts_url() {
	return 'https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,600;12..96,700;12..96,800&family=Instrument+Serif:ital@0;1&family=Figtree:ital,wght@0,400;0,500;0,600;0,700;1,400&family=DM+Mono:wght@400;500&display=swap';
}

/**
 * Theme supports and editor styles.
 */
function elivation_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style(
		array(
			elivation_fonts_url(),
			'assets/css/tokens.css',
			'assets/css/theme.css',
		)
	);
}
add_action( 'after_setup_theme', 'elivation_setup' );

/**
 * Front-end styles and script.
 */
function elivation_enqueue_assets() {
	$dir = get_theme_file_path();
	$uri = get_theme_file_uri();

	// Fonts. Version is null so WordPress does not append ?ver to the Google URL.
	wp_enqueue_style( 'elivation-fonts', elivation_fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

	wp_enqueue_style(
		'elivation-tokens',
		$uri . '/assets/css/tokens.css',
		array(),
		(string) filemtime( $dir . '/assets/css/tokens.css' )
	);
	wp_enqueue_style(
		'elivation-theme',
		$uri . '/assets/css/theme.css',
		array( 'elivation-tokens' ),
		(string) filemtime( $dir . '/assets/css/theme.css' )
	);

	wp_enqueue_script(
		'elivation-theme',
		$uri . '/assets/js/theme.js',
		array(),
		(string) filemtime( $dir . '/assets/js/theme.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
	wp_localize_script(
		'elivation-theme',
		'elivationData',
		array(
			'bookingUrl'  => ELIVATION_BOOKING_URL,
			'phone'       => ELIVATION_PHONE_DISPLAY,
			'serviceZips' => array_values( elivation_service_zips() ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'elivation_enqueue_assets' );

/**
 * Preconnect to the Google Fonts hosts.
 *
 * @param array  $urls          Resource hint URLs.
 * @param string $relation_type Hint type.
 * @return array
 */
function elivation_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'elivation_resource_hints', 10, 2 );

/**
 * Pattern category for the homepage sections.
 */
function elivation_register_pattern_category() {
	register_block_pattern_category(
		'elivation',
		array( 'label' => __( 'Elivation', 'elivation' ) )
	);
}
add_action( 'init', 'elivation_register_pattern_category' );

/* -------------------------------------------------------------------------
 * Photos
 * ---------------------------------------------------------------------- */

/**
 * Photo manifest written by tools/build-photos.mjs.
 *
 * @return array<string, array{width:int,height:int,sizes:array<int,array{width:int,height:int,file:string}>}>
 */
function elivation_photo_manifest() {
	static $manifest = null;
	if ( null === $manifest ) {
		$manifest = array();
		$path     = get_theme_file_path( 'assets/photos/manifest.json' );
		if ( is_readable( $path ) ) {
			$decoded = json_decode( (string) file_get_contents( $path ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			if ( is_array( $decoded ) ) {
				$manifest = $decoded;
			}
		}
	}
	return $manifest;
}

/**
 * URL of the largest WebP for a photo, e.g. elivation_photo_url( 'hero-2' ).
 *
 * @param string $name Photo name without extension.
 * @return string
 */
function elivation_photo_url( $name ) {
	return get_theme_file_uri( 'assets/photos/' . $name . '-2000.webp' );
}

/**
 * Alt text for a photo, taken from the description column of picks.txt.
 *
 * @param string $name Photo name without extension.
 * @return string
 */
function elivation_photo_alt( $name ) {
	static $alts = null;
	if ( null === $alts ) {
		$alts = array();
		$path = get_theme_file_path( 'assets/photos/picks.txt' );
		if ( is_readable( $path ) ) {
			$lines = file( $path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
			foreach ( (array) $lines as $line ) {
				$cols = array_map( 'trim', explode( '|', $line ) );
				if ( count( $cols ) >= 2 ) {
					$key          = preg_replace( '/\.[a-z0-9]+$/i', '', $cols[0] );
					$alts[ $key ] = $cols[1];
				}
			}
		}
	}
	return isset( $alts[ $name ] ) ? $alts[ $name ] : '';
}

/**
 * srcset string for a theme photo.
 *
 * @param string $name Photo name without extension.
 * @return string
 */
function elivation_photo_srcset( $name ) {
	$manifest = elivation_photo_manifest();
	if ( empty( $manifest[ $name ]['sizes'] ) ) {
		return '';
	}
	$parts = array();
	$seen  = array();
	foreach ( $manifest[ $name ]['sizes'] as $size ) {
		$width = (int) $size['width'];
		if ( isset( $seen[ $width ] ) ) {
			continue; // Portrait sources repeat their largest width.
		}
		$seen[ $width ] = true;
		$parts[]        = get_theme_file_uri( 'assets/photos/' . $size['file'] ) . ' ' . $width . 'w';
	}
	return implode( ', ', $parts );
}

/**
 * sizes attribute for a photo, chosen from the image block's class name.
 *
 * @param string $class_name Class attribute of the image block.
 * @return string
 */
function elivation_photo_sizes( $class_name ) {
	if ( false !== strpos( $class_name, 'eh-hero__photo' ) ) {
		return '100vw';
	}
	if ( false !== strpos( $class_name, 'eh-team__group' ) ) {
		return '(min-width: 1424px) 1280px, 100vw';
	}
	if ( false !== strpos( $class_name, 'eh-gallery__lead' ) ) {
		return '(min-width: 768px) 50vw, 100vw';
	}
	if ( false !== strpos( $class_name, 'eh-gallery__item' ) ) {
		return '(min-width: 768px) 25vw, 50vw';
	}
	if ( false !== strpos( $class_name, 'eh-card__media' ) ) {
		return '(min-width: 1024px) 33vw, (min-width: 700px) 50vw, 100vw';
	}
	return '(min-width: 1024px) 50vw, 100vw';
}

/**
 * Adds srcset, sizes, dimensions and loading hints to image blocks that use
 * theme photos. The pattern markup stays a plain, valid core/image block.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block.
 * @return string
 */
function elivation_responsive_theme_photos( $block_content, $block ) {
	if ( false === strpos( $block_content, '/assets/photos/' ) ) {
		return $block_content;
	}
	if ( ! preg_match( '#/assets/photos/([a-z0-9-]+)-\d+\.webp#', $block_content, $m ) ) {
		return $block_content;
	}
	$name     = $m[1];
	$manifest = elivation_photo_manifest();
	$srcset   = elivation_photo_srcset( $name );
	if ( '' === $srcset || empty( $manifest[ $name ] ) ) {
		return $block_content;
	}

	$class_name = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';
	$is_hero    = false !== strpos( $class_name, 'eh-hero__photo' );
	$largest    = end( $manifest[ $name ]['sizes'] );

	$tags = new WP_HTML_Tag_Processor( $block_content );
	if ( $tags->next_tag( 'img' ) ) {
		$tags->set_attribute( 'srcset', $srcset );
		$tags->set_attribute( 'sizes', elivation_photo_sizes( $class_name ) );
		$tags->set_attribute( 'width', (string) (int) $largest['width'] );
		$tags->set_attribute( 'height', (string) (int) $largest['height'] );
		$tags->set_attribute( 'decoding', 'async' );
		if ( $is_hero ) {
			$tags->set_attribute( 'fetchpriority', 'high' );
			$tags->set_attribute( 'loading', 'eager' );
		} else {
			$tags->set_attribute( 'loading', 'lazy' );
		}
		return $tags->get_updated_html();
	}
	return $block_content;
}
add_filter( 'render_block_core/image', 'elivation_responsive_theme_photos', 10, 2 );

/**
 * Preload the hero photo on the front page.
 */
function elivation_preload_hero() {
	if ( ! is_front_page() ) {
		return;
	}
	$srcset = elivation_photo_srcset( 'hero-2' );
	if ( '' === $srcset ) {
		return;
	}
	printf(
		'<link rel="preload" as="image" type="image/webp" href="%s" imagesrcset="%s" imagesizes="100vw" fetchpriority="high">' . "\n",
		esc_url( elivation_photo_url( 'hero-2' ) ),
		esc_attr( $srcset )
	);
}
add_action( 'wp_head', 'elivation_preload_hero', 2 );

/* -------------------------------------------------------------------------
 * Structured data
 * ---------------------------------------------------------------------- */

/**
 * MedicalBusiness JSON-LD on the front page.
 *
 * TODO(client): add openingHoursSpecification once hours are confirmed.
 * TODO(client): add a postal address if the business wants one published.
 * TODO(client): verify areaServed (see elivation_service_cities()).
 */
function elivation_json_ld() {
	if ( ! is_front_page() ) {
		return;
	}

	$area_served = array();
	foreach ( elivation_service_cities() as $city ) {
		$area_served[] = array(
			'@type' => 'City',
			'name'  => $city,
		);
	}

	$data = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'MedicalBusiness',
		'@id'             => home_url( '/#business' ),
		'name'            => 'Elivation Health',
		'description'     => 'Registered Nurses bring physician-directed IV therapy to your home, office, hotel or event.',
		'url'             => home_url( '/' ),
		'telephone'       => ELIVATION_PHONE_TEL,
		'image'           => elivation_photo_url( 'hero-2' ),
		'areaServed'      => $area_served,
		'sameAs'          => array( ELIVATION_INSTAGRAM_URL ),
		'potentialAction' => array(
			'@type'  => 'ReserveAction',
			'name'   => 'Book a visit',
			'target' => ELIVATION_BOOKING_URL,
		),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'elivation_json_ld', 20 );
