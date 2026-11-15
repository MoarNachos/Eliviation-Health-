<?php
/**
 * Title: Treatment: drip menu
 * Slug: elivation/treatment-drips
 * Categories: elivation
 * Inserter: no
 * Description: Comparison cards linking to anchored photo details and drip-specific booking.
 *
 * TODO(client): verify every drip name, price, duration and description (from the current site, Aug 2026).
 * TODO(client): verify "Your price includes the nurse visit, health screening and supplies. Travel fees may apply outside our core area."
 *
 * TODO(client): Medical director review of every new hook, description and Good for chip in elivation_drip_details().
 * TODO(client): Photos home-recovery.jpg, relaxed-home-iv-detail-1.jpg and nurse-home-vitals-1.jpg require client-treatment consent; see inc/treatments.php and TODO.md.
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
			<a class="eh-btn eh-btn--ghost" href="#<?php echo esc_attr( $elivation_drip['anchor'] ); ?>" aria-label="View drip details for <?php echo esc_attr( $elivation_drip['name'] ); ?>">View drip details →</a>
		</div>
	</article>
<?php endforeach; ?>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:html -->
<div class="eh-scope eh-drip-details">
<?php foreach ( $elivation_tx['drips'] as $elivation_drip ) : ?>
	<section class="eh-drip-detail" id="<?php echo esc_attr( $elivation_drip['anchor'] ); ?>" aria-labelledby="<?php echo esc_attr( $elivation_drip['anchor'] ); ?>-title">
		<div class="eh-container eh-drip-detail__layout">
			<figure class="eh-drip-detail__photo" data-photo="<?php echo esc_attr( $elivation_drip['photo'] ); ?>">
				<?php echo elivation_photo_image( $elivation_drip['photo'], '', '(min-width: 1280px) 520px, (min-width: 900px) 45vw, calc(100vw - 40px)' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the image helper. ?>
			</figure>
			<div class="eh-drip-detail__body">
				<p class="eh-eyebrow"><?php echo esc_html( $elivation_drip['name'] ); ?></p>
				<h2 class="eh-h2" id="<?php echo esc_attr( $elivation_drip['anchor'] ); ?>-title"><?php echo esc_html( $elivation_drip['hook'] ); ?></h2>
				<p class="eh-drip-detail__description"><?php echo esc_html( $elivation_drip['description'] ); ?></p>
				<p class="eh-drip-detail__meta"><strong><?php echo esc_html( elivation_price( $elivation_drip['price'] ) ); ?></strong><span><?php echo esc_html( $elivation_drip['dur'] ); ?></span></p>
				<div>
					<h3 class="eh-drip-detail__label">Good for</h3>
					<ul class="eh-drip-detail__chips">
					<?php foreach ( $elivation_drip['good_for'] as $elivation_chip ) : ?>
						<li><?php echo esc_html( $elivation_chip ); ?></li>
					<?php endforeach; ?>
					</ul>
				</div>
				<div class="eh-actions">
					<a class="eh-btn eh-btn--primary" href="<?php echo esc_url( add_query_arg( 'drip', $elivation_drip['id'], ELIVATION_BOOKING_URL ) ); ?>" data-eh-book="<?php echo esc_attr( $elivation_drip['id'] ); ?>" aria-label="Book this drip: <?php echo esc_attr( $elivation_drip['name'] ); ?>">Book this drip</a>
					<a class="eh-drip-detail__back" href="#drips">Back to all <?php echo esc_html( $elivation_tx['name'] ); ?> drips ↑</a>
				</div>
			</div>
		</div>
	</section>
<?php endforeach; ?>
</div>
<!-- /wp:html -->
