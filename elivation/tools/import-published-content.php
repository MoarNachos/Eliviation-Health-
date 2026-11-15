<?php
/** Explicit content import for a NEW staging/replacement WordPress installation.
 * Never runs on theme activation; existing posts/pages are left untouched.
 * wp eval 'define("ELIVATION_IMPORT_CONTENT", true); require get_theme_file_path("tools/import-published-content.php");'
 */
if ( ! defined( 'ABSPATH' ) || ! defined( 'ELIVATION_IMPORT_CONTENT' ) || ! ELIVATION_IMPORT_CONTENT ) {
	return;
}
$entries = json_decode( file_get_contents( __DIR__ . '/../content/migration/published-content.json' ), true );
foreach ( $entries as $entry ) {
	if ( get_page_by_path( $entry['slug'], OBJECT, $entry['type'] ) ) {
		continue;
	}
	$content = $entry['content'];
	// Keep links to content outside this migration on the current production site.
	foreach ( $entries as $target ) {
		$content = str_replace( $target['source_url'], home_url( '/' . $target['slug'] . '/' ), $content );
	}
	$id = wp_insert_post( array(
		'post_type' => $entry['type'], 'post_status' => 'publish',
		'post_name' => $entry['slug'], 'post_title' => $entry['title'],
		'post_content' => "<!-- wp:html -->\n" . $content . "\n<!-- /wp:html -->",
		'post_excerpt' => wp_strip_all_tags( $entry['excerpt'] ),
		'post_date' => $entry['date'], 'post_date_gmt' => $entry['date_gmt'],
		'comment_status' => 'closed',
	), true );
	if ( is_wp_error( $id ) ) { throw new RuntimeException( $id->get_error_message() ); }
	foreach ( array( '_yoast_wpseo_title' => $entry['seo_title'], '_yoast_wpseo_metadesc' => $entry['description'], '_elivation_source_url' => $entry['source_url'], '_elivation_source_author' => $entry['source_author'] ?? '' ) as $key => $value ) {
		update_post_meta( $id, $key, $value );
	}
	$terms = array();
	foreach ( $entry['categories'] as $category ) {
		$term = term_exists( $category['slug'], 'category' );
		if ( ! $term ) { $term = wp_insert_term( $category['name'], 'category', array( 'slug' => $category['slug'] ) ); }
		if ( ! is_wp_error( $term ) ) { $terms[] = (int) ( is_array( $term ) ? $term['term_id'] : $term ); }
	}
	if ( $terms ) { wp_set_post_categories( $id, $terms ); }
	// Preserve the source modification timestamp without changing published content.
	global $wpdb;
	$wpdb->update( $wpdb->posts, array( 'post_modified' => $entry['modified'], 'post_modified_gmt' => $entry['modified_gmt'] ), array( 'ID' => $id ) );
	clean_post_cache( $id );
}
if ( ! get_page_by_path( 'blog' ) ) {
	wp_insert_post( array( 'post_type' => 'page', 'post_status' => 'publish', 'post_name' => 'blog', 'post_title' => 'Blog' ) );
}

// Refresh routes after creating the first posts on a new installation.
flush_rewrite_rules();
