<?php
/**
 * Title: Reviews
 * Slug: elivation/reviews
 * Categories: elivation, testimonials
 * Description: Three review cards with real client reviews.
 *
 * Reviews come from content/reviews.json (copied into assets/reviews.json by
 * `npm run reviews`). The text is never edited: a long review shows its opening
 * sentences word for word, then "…" and a link to the full review.
 *
 * These reviews are published on the business's own site and are not tied to
 * Google or Yelp, so the cards say "Elivation client" and no Review or
 * AggregateRating JSON-LD is output.
 *
 * TODO(build): the full-review link points at the current site's /testimonials/ page.
 * Point it at the new reviews page once that exists.
 *
 * @package elivation
 */

$elivation_reviews = elivation_reviews( array( 'r1', 'r2', 'r5' ) );
if ( ! $elivation_reviews ) {
	return;
}
?>
<!-- wp:group {"tagName":"section","anchor":"reviews","className":"eh-scope eh-section"} -->
<section id="reviews" class="wp-block-group eh-scope eh-section">
<!-- wp:group {"className":"eh-container eh-stack-40"} -->
<div class="wp-block-group eh-container eh-stack-40">
<!-- wp:group {"className":"eh-section__intro"} -->
<div class="wp-block-group eh-section__intro">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">In their words</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">What clients say <em>about their visits.</em></h2>
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
