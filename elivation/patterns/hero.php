<?php
/**
 * Title: Hero
 * Slug: elivation/hero
 * Categories: elivation, featured
 * Description: Full-bleed hero photo with the headline, the ZIP booking card, a client quote and the events link.
 *
 * TODO(client): verify the trust line (physician-directed care, starting price).
 * TODO(client): verify the coverage claim in the eyebrow.
 * TODO(client): confirm whether the booking platform accepts a ?zip= parameter.
 * TODO(client): supply covered ZIP codes to switch on the out-of-area message (see elivation_service_zips()).
 *
 * @package elivation
 */

$elivation_prices = array_map( 'elivation_treatment_from_price', elivation_treatments() );
$elivation_client = elivation_reviews( array( 'r3' ) );
$elivation_quote  = 'He came right to my home, made the process easy and comfortable';
?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-hero"} -->
<section class="wp-block-group eh-scope eh-hero">
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-hero__photo"} -->
<figure class="wp-block-image size-full eh-hero__photo"><img src="<?php echo esc_url( elivation_photo_url( 'hero-2' ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( 'hero-2' ) ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"eh-hero__inner"} -->
<div class="wp-block-group eh-hero__inner">
<!-- wp:group {"className":"eh-hero__copy"} -->
<div class="wp-block-group eh-hero__copy">
<!-- wp:paragraph {"className":"eh-eyebrow eh-eyebrow--dot eh-eyebrow--sun"} -->
<p class="eh-eyebrow eh-eyebrow--dot eh-eyebrow--sun">Orange County and select Los Angeles communities</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"eh-hero__title"} -->
<h1 class="wp-block-heading eh-hero__title">Mobile IV hydration <em>at your door.</em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-hero__lede"} -->
<p class="eh-hero__lede">A registered nurse comes to your home, hotel, or office. We check your vitals, talk through your options, and stay with you throughout your visit.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-hero__bottom"} -->
<div class="wp-block-group eh-hero__bottom">
<!-- wp:html -->
<form class="eh-zip" action="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>" method="get" data-eh-zip novalidate>
	<label class="eh-zip__title" for="eh-zip-input">Where should we meet you?</label>
	<div class="eh-zip__row">
		<input id="eh-zip-input" name="zip" type="text" inputmode="numeric" autocomplete="postal-code" maxlength="5" placeholder="ZIP code (optional)" aria-describedby="eh-zip-msg">
		<button class="eh-btn eh-btn--primary eh-zip__submit" type="submit">Book a visit</button>
	</div>
	<p class="eh-zip__msg" id="eh-zip-msg" data-eh-zip-msg role="status" aria-live="polite" hidden></p>
	<ul class="eh-zip__trust">
		<li>✓ Physician-directed care</li>
		<?php if ( $elivation_prices ) : ?>
		<li>✓ Visits from <?php echo esc_html( elivation_price( min( $elivation_prices ) ) ); ?></li>
		<?php endif; ?>
	</ul>
</form>
<!-- /wp:html -->

<!-- wp:group {"className":"eh-hero__aside"} -->
<div class="wp-block-group eh-hero__aside">
<?php if ( $elivation_client && false !== strpos( $elivation_client[0]['text'], $elivation_quote ) ) : ?>
<!-- wp:quote {"className":"eh-hero__review"} -->
<blockquote class="wp-block-quote eh-hero__review"><!-- wp:paragraph -->
<p>“<?php echo esc_html( $elivation_quote ); ?>…”</p>
<!-- /wp:paragraph --><cite><a href="<?php echo esc_url( elivation_reviews_url( 'r3' ) ); ?>"><?php echo esc_html( $elivation_client[0]['author'] ); ?> · Elivation client</a></cite></blockquote>
<!-- /wp:quote -->
<?php endif; ?>

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"eh-button-glass"} -->
<div class="wp-block-button eh-button-glass"><a class="wp-block-button__link wp-element-button" href="#events">Planning an event? →</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"className":"eh-hero__caption"} -->
<p class="eh-hero__caption">On the course with our team, Nov 2025</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
