<?php
/**
 * Title: Footer
 * Slug: elivation/footer
 * Categories: elivation
 * Inserter: no
 * Description: Footer with four columns and the medical disclaimer, plus the sticky mobile booking bar.
 *
 * TODO(client): Pricing, Careers, Privacy and Terms pages do not exist yet. Pricing points at the booking site; the others are left out or shown as plain text.
 * TODO(client): have the medical disclaimer line reviewed.
 * TODO(client): swap the PNG logo (assets/images/logo-white.png) for an SVG when supplied.
 *
 * @package elivation
 */

?>
<!-- wp:html -->
<div class="eh-scope eh-footer">
	<div class="eh-container eh-stack-48">
		<div class="eh-footer__grid">
			<div class="eh-footer__brand">
				<img class="eh-logo__img eh-logo__img--footer" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo-white.png' ) ); ?>" alt="Elivation Health" width="407" height="103" loading="lazy">
				<span>Expert care. A personal touch. Wherever you are.</span>
			</div>
			<nav class="eh-footer__col" aria-label="Treatments">
				<span class="eh-footer__heading">Treatments</span>
				<a href="<?php echo esc_url( elivation_treatment_url( 'recovery' ) ); ?>">Recovery</a>
				<a href="<?php echo esc_url( elivation_treatment_url( 'relief' ) ); ?>">Relief</a>
				<a href="<?php echo esc_url( elivation_treatment_url( 'rejuvenation' ) ); ?>">Rejuvenation</a>
				<a href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Pricing</a>
			</nav>
			<nav class="eh-footer__col" aria-label="Company">
				<span class="eh-footer__heading">Company</span>
				<a href="<?php echo esc_url( home_url( '/#team' ) ); ?>">Our nurses</a>
				<a href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Events &amp; groups</a>
				<a href="<?php echo esc_url( home_url( '/#reviews' ) ); ?>">Reviews</a>
				<?php if ( elivation_faq_url() ) : ?>
				<a href="<?php echo esc_url( elivation_faq_url() ); ?>">FAQ</a>
				<?php endif; ?>
				<a href="<?php echo esc_url( home_url( '/#areas' ) ); ?>">Areas</a>
			</nav>
			<nav class="eh-footer__col" aria-label="Contact">
				<span class="eh-footer__heading">Contact</span>
				<a class="eh-footer__phone" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>"><?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a>
				<a href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book online</a>
				<a href="<?php echo esc_url( ELIVATION_INSTAGRAM_URL ); ?>">Instagram</a>
			</nav>
		</div>
		<div class="eh-footer__legal">
			<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Elivation Health. IV therapy is provided under physician direction after a health screening. Not a substitute for emergency care.</span>
			<span>Privacy · Terms</span>
		</div>
	</div>
</div>
<div class="eh-bookbar" role="region" aria-label="Book or call">
	<a class="eh-btn eh-btn--ghost" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>">Call</a>
	<a class="eh-btn eh-btn--primary" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book a visit</a>
</div>
<!-- /wp:html -->
