<?php
/**
 * Title: Treatment: reviews
 * Slug: elivation/treatment-reviews
 * Categories: elivation, testimonials
 * Inserter: no
 * Description: Real client reviews that mention this treatment. Renders nothing when there are none.
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
<!-- wp:group {"tagName":"section","className":"eh-scope eh-section"} -->
<section class="wp-block-group eh-scope eh-section">
<!-- wp:group {"className":"eh-container eh-stack-40"} -->
<div class="wp-block-group eh-container eh-stack-40">
<!-- wp:group {"className":"eh-section__intro"} -->
<div class="wp-block-group eh-section__intro">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">In their words</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">What clients <em>tell us.</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-reviews"} -->
<div class="wp-block-group eh-reviews">
<?php
foreach ( $elivation_reviews as $elivation_review ) {
	echo elivation_review_card( $elivation_review ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped inside.
}
?>
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
