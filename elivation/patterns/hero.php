<?php
/**
 * Title: Hero
 * Slug: elivation/hero
 * Categories: elivation, featured
 * Description: Full-bleed hero photo with the headline, the ZIP booking card and the events link.
 *
 * TODO(client): verify the trust line (Registered Nurses, Physician directed, HSA / FSA eligible).
 * TODO(client): verify the "Orange County & LA" coverage claim in the eyebrow.
 * TODO(client): confirm whether the booking platform accepts a ?zip= parameter.
 * TODO(client): supply covered ZIP codes to switch on the out-of-area message (see elivation_service_zips()).
 *
 * @package elivation
 */

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
<p class="eh-eyebrow eh-eyebrow--dot eh-eyebrow--sun">Mobile IV hydration · Orange County &amp; LA</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"eh-hero__title"} -->
<h1 class="wp-block-heading eh-hero__title">Expert care. A personal touch. <em>Wherever you are.</em></h1>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-hero__bottom"} -->
<div class="wp-block-group eh-hero__bottom">
<!-- wp:html -->
<form class="eh-zip" action="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>" method="get" data-eh-zip novalidate>
	<label class="eh-zip__title" for="eh-zip-input">Where should we meet you?</label>
	<div class="eh-zip__row">
		<input id="eh-zip-input" name="zip" type="text" inputmode="numeric" autocomplete="postal-code" maxlength="5" placeholder="ZIP code" aria-describedby="eh-zip-msg">
		<button class="eh-btn eh-btn--primary eh-zip__submit" type="submit">Book a visit</button>
	</div>
	<p class="eh-zip__msg" id="eh-zip-msg" data-eh-zip-msg role="status" aria-live="polite" hidden></p>
	<ul class="eh-zip__trust">
		<li>✓ Registered Nurses</li>
		<li>✓ Physician directed</li>
		<li>✓ HSA / FSA eligible</li>
	</ul>
</form>
<!-- /wp:html -->

<!-- wp:group {"className":"eh-hero__aside"} -->
<div class="wp-block-group eh-hero__aside">
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
