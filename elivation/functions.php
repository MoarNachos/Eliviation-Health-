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
define( 'ELIVATION_REVIEWS_URL', 'https://www.elivationhealth.com/testimonials/' ); // TODO(build): new reviews page.

require_once __DIR__ . '/inc/treatments.php';

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
	if ( false !== strpos( $class_name, 'eh-tx-hero__photo' ) ) {
		return '(min-width: 1024px) 50vw, 100vw';
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
	$is_hero    = false !== strpos( $class_name, 'eh-hero__photo' ) || false !== strpos( $class_name, 'eh-tx-hero__photo' );
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
 * Reviews
 * ---------------------------------------------------------------------- */

/**
 * Reviews from assets/reviews.json, in the order of the ids given.
 *
 * @param string[] $ids Review ids, for example array( 'r1', 'r3' ).
 * @return array[] Each with 'author' and 'text'. Missing ids are skipped.
 */
function elivation_reviews( $ids ) {
	static $all = null;
	if ( null === $all ) {
		$all  = array();
		$path = get_theme_file_path( 'assets/reviews.json' );
		if ( is_readable( $path ) ) {
			$decoded = json_decode( (string) file_get_contents( $path ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			foreach ( (array) ( $decoded['reviews'] ?? array() ) as $review ) {
				if ( ! empty( $review['id'] ) && ! empty( $review['text'] ) ) {
					$all[ $review['id'] ] = $review;
				}
			}
		}
	}
	$out = array();
	foreach ( $ids as $id ) {
		if ( isset( $all[ $id ] ) ) {
			$out[] = $all[ $id ];
		}
	}
	return $out;
}

/**
 * Opening sentences of a review, word for word, up to about $max_words.
 * Never cuts mid-sentence; the first sentence is always kept whole.
 *
 * @param string $text      Full review text.
 * @param int    $max_words Word budget.
 * @return array { text: string, cut: bool }
 */
function elivation_review_excerpt( $text, $max_words = 45 ) {
	$sentences = preg_split( '/(?<=[.!?])\s+/u', trim( $text ) );
	$kept      = array();
	$words     = 0;
	foreach ( $sentences as $sentence ) {
		$count = count( preg_split( '/\s+/u', $sentence ) );
		if ( $kept && $words + $count > $max_words ) {
			break;
		}
		$kept[] = $sentence;
		$words += $count;
	}
	return array(
		'text' => implode( ' ', $kept ),
		'cut'  => count( $kept ) < count( $sentences ),
	);
}

/**
 * Block markup for one review card: opening sentences verbatim, then "…" and
 * a link to the full review when the excerpt is cut.
 *
 * @param array $review One entry from elivation_reviews().
 * @return string
 */
function elivation_review_card( $review ) {
	$excerpt = elivation_review_excerpt( $review['text'] );
	$more    = $excerpt['cut']
		? ' · <a class="eh-review__more" href="' . esc_url( ELIVATION_REVIEWS_URL ) . '">Read the full review</a>'
		: '';
	return '<!-- wp:quote {"className":"eh-review"} -->' . "\n"
		. '<blockquote class="wp-block-quote eh-review"><!-- wp:paragraph -->' . "\n"
		. '<p>“' . esc_html( $excerpt['text'] ) . ( $excerpt['cut'] ? '…' : '' ) . '”</p>' . "\n"
		. '<!-- /wp:paragraph --><cite><strong>' . esc_html( $review['author'] ) . '</strong> · Elivation client' . $more . '</cite></blockquote>' . "\n"
		. '<!-- /wp:quote -->' . "\n";
}

/* -------------------------------------------------------------------------
 * Structured data
 * ---------------------------------------------------------------------- */

/**
 * The MedicalBusiness node, shared by the homepage and treatment page JSON-LD.
 *
 * TODO(client): add openingHoursSpecification once hours are confirmed.
 * TODO(client): add a postal address if the business wants one published.
 * TODO(client): verify areaServed (see elivation_service_cities()).
 *
 * No Review or AggregateRating on purpose: the reviews in assets/reviews.json are
 * published by the business itself and can't be checked against a review platform.
 *
 * @return array
 */
function elivation_business_node() {
	$area_served = array();
	foreach ( elivation_service_cities() as $city ) {
		$area_served[] = array(
			'@type' => 'City',
			'name'  => $city,
		);
	}

	return array(
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
}

/**
 * MedicalBusiness JSON-LD on the front page. Treatment pages print their own
 * graph (see inc/treatments.php).
 */
function elivation_json_ld() {
	if ( ! is_front_page() ) {
		return;
	}
	echo '<script type="application/ld+json">' . wp_json_encode( elivation_business_node(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'elivation_json_ld', 20 );
