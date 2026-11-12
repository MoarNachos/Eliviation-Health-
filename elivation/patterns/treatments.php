<?php
/**
 * Title: Treatments
 * Slug: elivation/treatments
 * Categories: elivation
 * Description: The three treatment categories as cards with drip names.
 *
 * TODO(client): drip names are taken from the current site. Verify them (prices are on the treatment pages).
 * TODO(client): the "Compare all drips" link points at the booking site until a comparison page exists.
 * "Explore" links go to the treatment pages (inc/treatments.php).
 * TODO(client): community-2.jpg (Recovery card) has a consent flag: one golfer is visible in profile. Confirm consent, crop or swap.
 *
 * @package elivation
 */

$elivation_treatments = array(
	array(
		'key'   => 'recovery',
		'title' => 'Recovery',
		'photo' => 'community-2',
		'text'  => 'Restore strength and muscle performance after training, travel or a big night.',
		'drips' => array( 'Myers\' Cocktail', 'Performance', 'Defense', 'Hangover Remedy', 'Build-a-Bag' ),
	),
	array(
		'key'   => 'relief',
		'title' => 'Relief',
		'photo' => 'event-4',
		'text'  => 'Support when you\'re run down — cold and flu, nausea, migraines and food poisoning.',
		'drips' => array( 'Cold &amp; Flu', 'Migraine Relief', 'Nausea', 'Basic Drip', 'Lactated Ringer\'s' ),
	),
	array(
		'key'   => 'rejuvenation',
		'title' => 'Rejuvenation',
		'photo' => 'community-3',
		'text'  => 'Refresh body, skin and energy with our wellness-focused drips and NAD+.',
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
<p class="eh-eyebrow">Treatments</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Three ways to <em>feel like yourself</em> again.</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"eh-more"} -->
<p class="eh-more"><a href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Compare all drips &amp; pricing →</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-cards"} -->
<div class="wp-block-group eh-cards">
<?php foreach ( $elivation_treatments as $elivation_tx ) : ?>
<!-- wp:group {"tagName":"article","className":"eh-card"} -->
<article class="wp-block-group eh-card">
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-card__media"} -->
<figure class="wp-block-image size-full eh-card__media"><img src="<?php echo esc_url( elivation_photo_url( $elivation_tx['photo'] ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( $elivation_tx['photo'] ) ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"eh-card__body"} -->
<div class="wp-block-group eh-card__body">
<!-- wp:heading {"level":3,"className":"eh-card__title"} -->
<h3 class="wp-block-heading eh-card__title"><?php echo esc_html( $elivation_tx['title'] ); ?></h3>
<!-- /wp:heading -->

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
<p class="eh-more eh-more--accent eh-card__cta"><a href="<?php echo esc_url( elivation_treatment_url( $elivation_tx['key'] ) ); ?>">Explore <?php echo esc_html( $elivation_tx['title'] ); ?> →</a></p>
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
