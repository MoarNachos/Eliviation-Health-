<?php
/**
 * Title: Treatments
 * Slug: elivation/treatments
 * Categories: elivation
 * Description: Three reasons for a visit, with starting prices from the treatment menu.
 *
 * @package elivation
 */

$elivation_situations = array(
	'relief'       => 'When nausea, a migraine, or a stomach bug makes it hard to go out, a nurse can assess you at home.',
	'recovery'     => 'Hydration after a race, a long flight, or a late night. Your nurse can meet you at home or at your hotel.',
	'rejuvenation' => 'Compare vitamin infusions and longer NAD+ visits. See what’s in each option and how much time to set aside.',
);
$elivation_treatments = elivation_treatments();
$elivation_situations = array_intersect_key( $elivation_situations, $elivation_treatments );
?>
<!-- wp:group {"tagName":"section","anchor":"treatments","className":"eh-scope eh-section eh-section--sunken"} -->
<section id="treatments" class="wp-block-group eh-scope eh-section eh-section--sunken">
<!-- wp:group {"className":"eh-container eh-stack-48"} -->
<div class="wp-block-group eh-container eh-stack-48">
<!-- wp:group {"className":"eh-section__intro eh-section__intro--640"} -->
<div class="wp-block-group eh-section__intro eh-section__intro--640">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">Treatments &amp; prices</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">What brings <em>us to you?</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-cards"} -->
<div class="wp-block-group eh-cards">
<?php foreach ( $elivation_situations as $elivation_key => $elivation_situation ) : ?>
<?php $elivation_tx = $elivation_treatments[ $elivation_key ]; ?>
<!-- wp:group {"tagName":"article","className":"eh-card"} -->
<article class="wp-block-group eh-card">
<!-- wp:group {"className":"eh-card__body"} -->
<div class="wp-block-group eh-card__body">
<!-- wp:heading {"level":3,"className":"eh-card__title"} -->
<h3 class="wp-block-heading eh-card__title"><?php echo esc_html( $elivation_tx['name'] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-card__price"} -->
<p class="eh-card__price">From <?php echo esc_html( elivation_price( elivation_treatment_from_price( $elivation_tx ) ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $elivation_situation ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"eh-more eh-more--accent eh-card__cta"} -->
<p class="eh-more eh-more--accent eh-card__cta"><a href="<?php echo esc_url( elivation_treatment_url( $elivation_key ) ); ?>">See <?php echo esc_html( $elivation_tx['name'] ); ?> options →</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</article>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"eh-more"} -->
<p class="eh-more">Unsure which to choose? <a href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>">Call our team at <?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
