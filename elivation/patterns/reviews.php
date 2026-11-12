<?php
/**
 * Title: Reviews
 * Slug: elivation/reviews
 * Categories: elivation, testimonials
 * Description: Three review cards.
 *
 * TODO(client): ALL THREE QUOTES ARE PLACEHOLDERS. Replace them with real, verified
 * Google reviews (under 40 words each, first name and initial, city) before launch.
 * Do not publish this section with the placeholder text.
 *
 * @package elivation
 */

$elivation_reviews = array(
	'Paste a verified Google review here — keep it under 40 words.',
	'A second verified review, ideally mentioning a nurse by name.',
	'A third verified review, ideally from an event or corporate client.',
);
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
<h2 class="wp-block-heading eh-h2">Care people <em>tell their friends about.</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-reviews"} -->
<div class="wp-block-group eh-reviews">
<?php foreach ( $elivation_reviews as $elivation_review ) : ?>
<!-- wp:quote {"className":"eh-review"} -->
<blockquote class="wp-block-quote eh-review"><!-- wp:paragraph -->
<p>“<?php echo esc_html( $elivation_review ); ?>”</p>
<!-- /wp:paragraph --><cite><strong>First name, initial</strong> · City · Google</cite></blockquote>
<!-- /wp:quote -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
