<?php
/**
 * Title: Footer
 * Slug: elivation/footer
 * Categories: elivation
 * Inserter: no
 * Description: Footer with four columns and the medical disclaimer, plus the sticky mobile booking bar.
 *
 * TODO(client): Careers and Terms pages do not exist yet. Privacy links to the existing notice (elivation_privacy_url()).
 * TODO(client): have the medical disclaimer line reviewed.
 * TODO(client): swap the PNG logo (assets/images/logo-white.webp) for an SVG when supplied.
 *
 * @package elivation
 */

?>
<!-- wp:html -->
<div class="eh-scope eh-footer">
	<div class="eh-container eh-stack-48">
		<div class="eh-footer__grid">
			<div class="eh-footer__brand">
				<img class="eh-logo__img eh-logo__img--footer" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo-white.webp' ) ); ?>" alt="Elivation Health" width="407" height="103" loading="lazy">
				<span>Mobile IV hydration at home, at work and at events.</span>
				<div class="eh-footer__badges" aria-label="Practice badges">
					<img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/hipaa-silver.webp' ) ); ?>" alt="HIPAA compliant" width="141" height="130" loading="lazy">
					<img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/doctor-owned-silver.webp' ) ); ?>" alt="Doctor owned and operated" width="130" height="123" loading="lazy">
				</div>
			</div>
			<nav class="eh-footer__col" aria-label="Treatments">
				<span class="eh-footer__heading">Treatments</span>
				<a href="<?php echo esc_url( elivation_treatment_url( 'recovery' ) ); ?>">Recovery</a>
				<a href="<?php echo esc_url( elivation_treatment_url( 'relief' ) ); ?>">Relief</a>
				<a href="<?php echo esc_url( elivation_treatment_url( 'rejuvenation' ) ); ?>">Rejuvenation</a>
				<a href="<?php echo esc_url( home_url( '/#treatments' ) ); ?>">Compare starting prices</a>
			</nav>
			<nav class="eh-footer__col" aria-label="Company">
				<span class="eh-footer__heading">Company</span>
				<a href="<?php echo esc_url( home_url( '/#team' ) ); ?>">Care team</a>
				<a href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Events &amp; groups</a>
				<a href="<?php echo esc_url( home_url( '/#reviews' ) ); ?>">Reviews</a>
				<?php if ( elivation_faq_url() ) : ?>
				<a href="<?php echo esc_url( elivation_faq_url() ); ?>">FAQ</a>
				<?php endif; ?>
				<a href="<?php echo esc_url( home_url( '/#areas' ) ); ?>">Service area</a>
			<a href="<?php echo esc_url( home_url( '/education/' ) ); ?>">Education</a>
			<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
			</nav>
			<nav class="eh-footer__col" aria-label="Contact">
				<span class="eh-footer__heading">Contact</span>
				<a class="eh-footer__phone" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>"><?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a>
				<a class="eh-footer__email" href="mailto:info@elivationhealth.com">info@elivationhealth.com</a>
				<a href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book online</a>
				<div class="eh-footer__socials" aria-label="Social media">
					<a href="https://www.facebook.com/people/Elivation-Health/61578667049809" aria-label="Elivation Health on Facebook"><svg focusable="false" aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg></a>
					<a href="<?php echo esc_url( ELIVATION_INSTAGRAM_URL ); ?>" aria-label="Elivation Health on Instagram"><svg focusable="false" aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg></a>
					<a href="https://x.com/elivationhealth" aria-label="Elivation Health on X"><svg focusable="false" aria-hidden="true" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path></svg></a>
					<a href="https://www.tiktok.com/@elivationhealth" aria-label="Elivation Health on TikTok"><svg focusable="false" aria-hidden="true" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"></path></svg></a>
				</div>
			</nav>
		</div>
		<div class="eh-footer__legal">
			<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Elivation Health. IV therapy is provided under physician direction after a health screening. Not a substitute for emergency care.</span>
			<span><a href="<?php echo esc_url( elivation_privacy_url() ); ?>">Privacy</a> · Terms</span>
		</div>
	</div>
</div>
<div class="eh-bookbar" role="region" aria-label="Book or call">
	<a class="eh-btn eh-btn--ghost" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>">Call</a>
	<a class="eh-btn eh-btn--primary" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book a visit</a>
</div>
<!-- /wp:html -->
