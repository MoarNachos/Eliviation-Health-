<?php
/**
 * Title: Testimonials: full client reviews
 * Slug: elivation/testimonials-page
 * Categories: elivation, testimonials
 * Inserter: no
 * Description: Every client review in full, each with an anchor (#review-r1 …) that "Read the full review" links point to.
 *
 * Reviews come from content/reviews.json (copied into assets/reviews.json by `npm run reviews`),
 * shown exactly as published on elivationhealth.com/testimonials/. No review JSON-LD: the
 * reviews are self-published and not tied to a review platform.
 *
 * @package elivation
 */

$elivation_reviews = elivation_reviews( array( 'r1', 'r2', 'r3', 'r4', 'r5' ) );
?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-tx-hero"} -->
<section class="wp-block-group eh-scope eh-tx-hero">
<!-- wp:group {"className":"eh-container eh-stack-24"} -->
<div class="wp-block-group eh-container eh-stack-24">
<!-- wp:html -->
<nav class="eh-crumbs" aria-label="Breadcrumb">
	<ol>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
		<li aria-current="page">Client reviews</li>
	</ol>
</nav>
<!-- /wp:html -->

<!-- wp:heading {"level":1,"className":"eh-tx-hero__title"} -->
<h1 class="wp-block-heading eh-tx-hero__title">Client reviews, <em>in full.</em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede eh-section__intro--640"} -->
<p class="eh-lede eh-section__intro--640">What clients have told us about their visits, in their own words.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"eh-scope eh-section eh-section--sunken"} -->
<section class="wp-block-group eh-scope eh-section eh-section--sunken">
<!-- wp:group {"className":"eh-container"} -->
<div class="wp-block-group eh-container">
<!-- wp:html -->
<div class="eh-review-list">
<?php foreach ( $elivation_reviews as $elivation_review ) : ?>
	<article class="eh-review-full" id="review-<?php echo esc_attr( $elivation_review['id'] ); ?>">
		<blockquote>
			<?php foreach ( preg_split( '/\n\s*\n/u', $elivation_review['text'] ) as $elivation_paragraph ) : ?>
			<p><?php echo esc_html( $elivation_paragraph ); ?></p>
			<?php endforeach; ?>
		</blockquote>
		<p class="eh-review-full__by"><strong><?php echo esc_html( $elivation_review['author'] ); ?></strong> · Elivation client</p>
	</article>
<?php endforeach; ?>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"eh-scope eh-section eh-section--tight"} -->
<section class="wp-block-group eh-scope eh-section eh-section--tight">
<!-- wp:group {"className":"eh-container eh-stack-24"} -->
<div class="wp-block-group eh-container eh-stack-24">
<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Ready for <em>your visit?</em></h2>
<!-- /wp:heading -->

<!-- wp:html -->
<div class="eh-tx-hero__actions">
	<a class="eh-btn eh-btn--primary" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book a visit</a>
	<a class="eh-btn eh-btn--ghost" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>">Call <?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
