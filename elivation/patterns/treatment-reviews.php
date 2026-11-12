<?php
/**
 * Title: Treatment: reviews
 * Slug: elivation/treatment-reviews
 * Categories: elivation, testimonials
 * Inserter: no
 * Description: A sourced client account of what an Elivation visit feels like.
 *
 * Which reviews show is set by 'reviews' in elivation_treatments() (inc/treatments.php).
 * See patterns/reviews.php for how the text is excerpted and why there is no review JSON-LD.
 *
 * @package elivation
 */

$elivation_treatment = elivation_treatment( elivation_current_treatment( true ) );
$elivation_reviews   = elivation_reviews( $elivation_treatment['reviews'] ?? array() );
if ( ! $elivation_reviews ) {
	return;
}

?>
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">A client on meeting their nurse</p>
<!-- /wp:paragraph -->
<?php
foreach ( $elivation_reviews as $elivation_review ) {
	$elivation_excerpt = $elivation_treatment['excerpts'][ $elivation_review['id'] ] ?? '';
	echo elivation_review_card( $elivation_review, $elivation_excerpt ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped inside.
}
