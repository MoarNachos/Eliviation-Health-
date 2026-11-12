<?php
/**
 * Keep old treatment links useful when the redesigned pages are published.
 *
 * @package elivation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const ELIVATION_LEGACY_TREATMENT_KEYS = array( 'relief', 'recovery', 'rejuvenation' );

/** Match only an old root path, including on subdirectory or index.php installs. */
function elivation_legacy_treatment_key( $url ) {
	global $wp_rewrite;

	$path   = (string) wp_parse_url( $url, PHP_URL_PATH );
	$prefix = trailingslashit( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ) );
	if ( 0 !== strpos( $path, $prefix ) ) {
		return null;
	}
	$key   = untrailingslashit( substr( $path, strlen( $prefix ) ) );
	$index = $wp_rewrite->index . '/';
	if ( 0 === strpos( $key, $index ) ) {
		$key = substr( $key, strlen( $index ) );
	}
	return in_array( $key, ELIVATION_LEGACY_TREATMENT_KEYS, true ) ? $key : null;
}

/** Return the public replacement permalink only when it is ready to receive traffic. */
function elivation_legacy_treatment_destination( $key ) {
	$page = get_page_by_path( ELIVATION_TREATMENTS_PARENT . '/' . $key, OBJECT, array( 'page' ) );
	if ( ! $page || 'publish' !== $page->post_status || '' !== $page->post_password ) {
		return false;
	}
	$url = wp_validate_redirect( get_permalink( $page ), false );
	return $url && ! elivation_legacy_treatment_key( $url ) ? $url : false;
}

function elivation_redirect_legacy_treatment() {
	if ( ! in_array( $_SERVER['REQUEST_METHOD'] ?? '', array( 'GET', 'HEAD' ), true )
		|| is_admin() || is_preview() || is_customize_preview() || isset( $_GET['preview'] ) ) {
		return;
	}
	$key = elivation_legacy_treatment_key( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ) );
	if ( ! $key ) {
		return;
	}
	$destination = elivation_legacy_treatment_destination( $key );
	if ( ! $destination ) {
		return;
	}

	// Carry campaign attribution, without forwarding unrelated query or preview data.
	$tracking = array();
	foreach ( wp_unslash( $_GET ) as $name => $value ) {
		if ( is_string( $value ) && preg_match( '/^(utm_[a-z0-9_]+|gclid|msclkid|fbclid)$/iD', $name ) ) {
			$tracking[ $name ] = rawurlencode( $value );
		}
	}
	if ( wp_safe_redirect( add_query_arg( $tracking, $destination ), 301, 'Elivation Health' ) ) {
		exit;
	}
}
add_action( 'template_redirect', 'elivation_redirect_legacy_treatment', 5 );

/** Omit only page records whose public links resolve to a redirect. */
function elivation_sitemap_redirect_exclusions( $excluded_ids ) {
	foreach ( ELIVATION_LEGACY_TREATMENT_KEYS as $key ) {
		$page = get_page_by_path( $key, OBJECT, array( 'page' ) );
		if ( $page && $key === elivation_legacy_treatment_key( get_permalink( $page ) )
			&& elivation_legacy_treatment_destination( $key ) ) {
			$excluded_ids[] = $page->ID;
		}
	}
	$parent = get_page_by_path( ELIVATION_TREATMENTS_PARENT, OBJECT, array( 'page' ) );
	if ( $parent && false !== has_action( 'template_redirect', 'elivation_treatments_parent_redirect' ) ) {
		$excluded_ids[] = $parent->ID;
	}
	return array_values( array_unique( $excluded_ids ) );
}
add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', 'elivation_sitemap_redirect_exclusions' );

function elivation_sitemap_page_query( $args, $post_type ) {
	if ( 'page' !== $post_type ) {
		return $args;
	}
	$exclusions = elivation_sitemap_redirect_exclusions( $args['post__not_in'] ?? array() );
	if ( ! empty( $args['post__in'] ) ) {
		// WP_Query gives post__in precedence. An empty inclusion list would include every page.
		$args['post__in'] = array_values( array_diff( $args['post__in'], $exclusions ) ) ?: array( 0 );
	} else {
		$args['post__not_in'] = $exclusions;
	}
	return $args;
}
add_filter( 'wp_sitemaps_posts_query_args', 'elivation_sitemap_page_query', 10, 2 );
