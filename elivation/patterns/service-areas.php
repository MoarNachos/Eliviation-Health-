<?php
/**
 * Title: Service areas
 * Slug: elivation/service-areas
 * Categories: elivation
 * Description: Where the service goes, with city pills and the booking and call buttons.
 *
 * TODO(client): verify the city list (edit elivation_service_cities() in functions.php; it also feeds the JSON-LD).
 * TODO(client): verify "Anywhere in Orange County. And a lot of LA." and "Same-day visits are often available."
 *
 * @package elivation
 */

?>
<!-- wp:group {"tagName":"section","anchor":"areas","className":"eh-scope eh-section eh-section--sunken eh-section--tight"} -->
<section id="areas" class="wp-block-group eh-scope eh-section eh-section--sunken eh-section--tight">
<!-- wp:group {"className":"eh-container eh-split eh-split--center"} -->
<div class="wp-block-group eh-container eh-split eh-split--center">
<!-- wp:group {"className":"eh-stack-20"} -->
<div class="wp-block-group eh-stack-20">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">Where we go</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Anywhere in Orange County. <em>And a lot of LA.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">Same-day visits are often available. Not sure we cover you? Call and we'll tell you straight.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"eh-actions"} -->
<div class="wp-block-buttons eh-actions"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book a visit</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>">Call <?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:list {"className":"eh-areas"} -->
<ul class="wp-block-list eh-areas">
<?php foreach ( elivation_service_cities() as $elivation_city ) : ?>
<!-- wp:list-item -->
<li><?php echo esc_html( $elivation_city ); ?></li>
<!-- /wp:list-item -->
<?php endforeach; ?>
</ul>
<!-- /wp:list -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
