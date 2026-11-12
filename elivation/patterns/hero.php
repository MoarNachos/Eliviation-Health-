<?php
/**
 * Title: Hero
 * Slug: elivation/hero
 * Categories: elivation, featured
 * Description: Mobile IV home visits, starting price, booking and a client's experience.
 *
 * @package elivation
 */

$elivation_prices = array_map( 'elivation_treatment_from_price', elivation_treatments() );
$elivation_client = elivation_reviews( array( 'r3' ) );
$elivation_quote  = 'He came right to my home, made the process easy and comfortable';
?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-home-intro"} -->
<section class="wp-block-group eh-scope eh-home-intro">
<!-- wp:group {"className":"eh-container eh-home-intro__grid"} -->
<div class="wp-block-group eh-container eh-home-intro__grid">
<!-- wp:group {"className":"eh-home-intro__copy"} -->
<div class="wp-block-group eh-home-intro__copy">
<!-- wp:paragraph {"className":"eh-eyebrow eh-eyebrow--dot"} -->
<p class="eh-eyebrow eh-eyebrow--dot">Orange County and select Los Angeles communities</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"eh-home-intro__title"} -->
<h1 class="wp-block-heading eh-home-intro__title">Mobile IV hydration <em>at your door.</em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">A registered nurse comes to your home, hotel, or office. We check your vitals, talk through your options, and stay with you throughout your visit.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<form class="eh-zip" action="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>" method="get" data-eh-zip novalidate>
	<label class="eh-zip__title" for="eh-zip-input">Where should we meet you?</label>
	<div class="eh-zip__row">
		<input id="eh-zip-input" name="zip" type="text" inputmode="numeric" autocomplete="postal-code" maxlength="5" placeholder="ZIP code (optional)" aria-describedby="eh-zip-msg">
		<button class="eh-btn eh-btn--primary eh-zip__submit" type="submit">Book a visit</button>
	</div>
	<p class="eh-zip__msg" id="eh-zip-msg" data-eh-zip-msg role="status" aria-live="polite" hidden></p>
	<ul class="eh-zip__trust">
		<li>Physician-directed care</li>
		<?php if ( $elivation_prices ) : ?>
		<li>Visits from <?php echo esc_html( elivation_price( min( $elivation_prices ) ) ); ?></li>
		<?php endif; ?>
	</ul>
</form>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"eh-more eh-home-intro__links"} -->
<p class="eh-more eh-home-intro__links"><a href="#treatments">See treatments &amp; prices</a> <a href="#events">Planning an event?</a></p>
<!-- /wp:paragraph -->

<?php if ( $elivation_client && false !== strpos( $elivation_client[0]['text'], $elivation_quote ) ) : ?>
<!-- wp:quote {"className":"eh-home-intro__review"} -->
<blockquote class="wp-block-quote eh-home-intro__review"><!-- wp:paragraph -->
<p>“<?php echo esc_html( $elivation_quote ); ?>…”</p>
<!-- /wp:paragraph --><cite><a href="<?php echo esc_url( ELIVATION_REVIEWS_URL ); ?>"><?php echo esc_html( $elivation_client[0]['author'] ); ?> · Elivation client</a></cite></blockquote>
<!-- /wp:quote -->
<?php endif; ?>
</div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-home-intro__photo"} -->
<figure class="wp-block-image size-full eh-home-intro__photo"><img src="<?php echo esc_url( elivation_photo_url( 'mobile-iv-home' ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( 'mobile-iv-home' ) ); ?>"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
