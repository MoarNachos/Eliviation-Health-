<?php
/**
 * Title: Treatment: drip menu
 * Slug: elivation/treatment-drips
 * Categories: elivation
 * Inserter: no
 * Description: One card per drip with name, price, duration, description, optional tag and a Book this drip button.
 *
 * TODO(client): verify every drip name, price, duration and description (from the current site, Aug 2026).
 * TODO(client): verify "Your price includes the nurse visit, health screening and supplies. Travel fees may apply outside our core area."
 *
 * @package elivation
 */

$elivation_tx = elivation_treatment( elivation_current_treatment( true ) );
?>
<!-- wp:group {"tagName":"section","anchor":"drips","className":"eh-scope eh-section eh-section--sunken"} -->
<section id="drips" class="wp-block-group eh-scope eh-section eh-section--sunken">
<!-- wp:group {"className":"eh-container eh-stack-40"} -->
<div class="wp-block-group eh-container eh-stack-40">
<!-- wp:group {"className":"eh-section__head"} -->
<div class="wp-block-group eh-section__head">
<!-- wp:group {"className":"eh-section__intro eh-section__intro--640"} -->
<div class="wp-block-group eh-section__intro eh-section__intro--640">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow"><?php echo esc_html( $elivation_tx['name'] ); ?> drips</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Compare <em><?php echo esc_html( $elivation_tx['name'] ); ?> options.</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"eh-drips__note"} -->
<p class="eh-drips__note">Your price includes the nurse visit, health screening and supplies. Travel fees may apply outside our core area.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="eh-drips">
<?php foreach ( $elivation_tx['drips'] as $elivation_drip ) : ?>
	<article class="eh-card eh-drip" id="drip-<?php echo esc_attr( $elivation_drip['id'] ); ?>">
		<div class="eh-drip__head">
			<h3 class="eh-card__title"><?php echo esc_html( $elivation_drip['name'] ); ?></h3>
			<?php if ( ! empty( $elivation_drip['tag'] ) ) : ?>
			<span class="eh-tag"><?php echo esc_html( $elivation_drip['tag'] ); ?></span>
			<?php endif; ?>
		</div>
		<p class="eh-drip__desc"><?php echo esc_html( $elivation_drip['desc'] ); ?></p>
		<div class="eh-drip__foot">
			<p class="eh-drip__meta">
				<span class="eh-drip__price"><?php echo esc_html( elivation_price( $elivation_drip['price'] ) ); ?></span>
				<span class="eh-drip__dur"><?php echo esc_html( $elivation_drip['dur'] ); ?></span>
			</p>
			<a class="eh-btn eh-btn--secondary" href="<?php echo esc_url( add_query_arg( 'drip', $elivation_drip['id'], ELIVATION_BOOKING_URL ) ); ?>" data-eh-book="<?php echo esc_attr( $elivation_drip['id'] ); ?>" aria-label="Book the <?php echo esc_attr( $elivation_drip['name'] ); ?> drip">Book this drip</a>
		</div>
	</article>
<?php endforeach; ?>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
