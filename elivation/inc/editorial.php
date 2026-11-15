<?php
/** SEO fallback for portable article imports when Yoast is not installed. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_filter( 'pre_get_document_title', static function ( $title ) {
	if ( defined( 'WPSEO_VERSION' ) || ! is_singular() ) { return $title; }
	return get_post_meta( get_queried_object_id(), '_yoast_wpseo_title', true ) ?: $title;
} );
add_action( 'wp_head', static function () {
	if ( defined( 'WPSEO_VERSION' ) || ! is_singular() ) { return; }
	$description = get_post_meta( get_queried_object_id(), '_yoast_wpseo_metadesc', true );
	if ( $description ) { echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n"; }
}, 3 );
