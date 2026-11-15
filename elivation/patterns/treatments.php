<?php
/**
 * Title: Treatments
 * Slug: elivation/treatments
 * Categories: elivation
 * Description: The three treatment categories as photo cards with starting price, drip names and a link to each page.
 *
 * TODO(client): drip names are taken from the current site. Verify them (prices are on the treatment pages).
 * "Explore" links go to the treatment pages (inc/treatments.php).
 *
 * TODO(client): Photo relaxed-home-iv-detail-1.jpg — Confirm authorization for this client-treatment image despite the face being outside the frame. Also applies to home-community-iv (same source DSC_1818.jpg).
 * TODO(client): Photo home-recovery.jpg — Confirm consent for both identifiable clients on the sofa.
 * TODO(client): Photo home-visit-couch-1-16x10.jpg — Confirm consent for both clients; verify provider identity and RN status.
 *
 * @package elivation
 */

$elivation_treatments = array(
	array(
		'key'   => 'recovery',
		'title' => 'Recovery',
		'photo' => 'home-recovery',
		'text'  => 'Hydration after a race, a long flight, or a late night. Your nurse can meet you at home or at your hotel.',
		'drips' => array( 'Myers\' Cocktail', 'Performance', 'Defense', 'Hangover Remedy', 'Build-a-Bag' ),
	),
	array(
		'key'   => 'relief',
		'title' => 'Relief',
		'photo' => 'home-relief',
		'text'  => 'When nausea, a migraine, or a stomach bug makes it hard to go out, a nurse can assess you at home.',
		'drips' => array( 'Cold &amp; Flu', 'Migraine Relief', 'Nausea', 'Basic Drip', 'Lactated Ringer\'s' ),
	),
	array(
		'key'   => 'rejuvenation',
		'title' => 'Rejuvenation',
		'photo' => 'home-rejuvenation',
		'text'  => 'Compare vitamin infusions and longer NAD+ visits. See what’s in each option and how much time to set aside.',
		'drips' => array( 'NAD+ 250mg', 'NAD+ 500mg', 'Radiance', 'The Elivation' ),
	),
);
?>
<!-- wp:group {"tagName":"section","anchor":"treatments","className":"eh-scope eh-section eh-section--sunken"} -->
<section id="treatments" class="wp-block-group eh-scope eh-section eh-section--sunken">
<!-- wp:group {"className":"eh-container eh-stack-48"} -->
<div class="wp-block-group eh-container eh-stack-48">
<!-- wp:group {"className":"eh-section__head"} -->
<div class="wp-block-group eh-section__head">
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

<!-- wp:paragraph {"className":"eh-more"} -->
<p class="eh-more">Unsure which to choose? <a href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>">Call our team at <?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-cards"} -->
<div class="wp-block-group eh-cards">
<?php foreach ( $elivation_treatments as $elivation_tx ) : ?>
<!-- wp:group {"tagName":"article","className":"eh-card"} -->
<article class="wp-block-group eh-card">
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-card__media"} -->
<figure class="wp-block-image size-full eh-card__media"><img<?php if ( 'recovery' === $elivation_tx['key'] ) : ?> style="object-position:50% 35%"<?php endif; ?> src="<?php echo esc_url( elivation_photo_url( $elivation_tx['photo'] ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( $elivation_tx['photo'] ) ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"eh-card__body"} -->
<div class="wp-block-group eh-card__body">
<!-- wp:heading {"level":3,"className":"eh-card__title"} -->
<h3 class="wp-block-heading eh-card__title"><?php echo esc_html( $elivation_tx['title'] ); ?></h3>
<!-- /wp:heading -->

<?php $elivation_full = elivation_treatment( $elivation_tx['key'] ); ?>
<?php if ( $elivation_full ) : ?>
<!-- wp:paragraph {"className":"eh-card__price"} -->
<p class="eh-card__price">From <?php echo esc_html( elivation_price( elivation_treatment_from_price( $elivation_full ) ) ); ?></p>
<!-- /wp:paragraph -->
<?php endif; ?>

<!-- wp:paragraph -->
<p><?php echo esc_html( $elivation_tx['text'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"eh-chips"} -->
<ul class="wp-block-list eh-chips">
<?php foreach ( $elivation_tx['drips'] as $elivation_drip ) : ?>
<!-- wp:list-item -->
<li><?php echo wp_kses_post( $elivation_drip ); ?></li>
<!-- /wp:list-item -->
<?php endforeach; ?>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph {"className":"eh-more eh-more--accent eh-card__cta"} -->
<p class="eh-more eh-more--accent eh-card__cta"><a href="<?php echo esc_url( elivation_treatment_url( $elivation_tx['key'] ) ); ?>">See <?php echo esc_html( $elivation_tx['title'] ); ?> options →</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</article>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
