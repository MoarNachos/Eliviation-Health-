<?php
/**
 * Title: Header
 * Slug: elivation/header
 * Categories: elivation
 * Inserter: no
 * Description: Sticky header with logo, section links, phone and the Book a visit button.
 *
 * Logo: assets/images/logo-navy.png (official artwork, 407x103, recolored navy for light backgrounds).
 * TODO(client): supply an SVG master of the logo and swap it in here and in the footer.
 *
 * @package elivation
 */

?>
<!-- wp:html -->
<div class="eh-nav" data-eh-nav>
	<a class="eh-skip" href="#main">Skip to content</a>
	<div class="eh-nav__inner">
		<a class="eh-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="eh-logo__img" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo-navy.png' ) ); ?>" alt="Elivation Health" width="407" height="103"></a>
		<button class="eh-nav__toggle" type="button" aria-expanded="false" aria-controls="eh-site-nav" data-eh-nav-toggle>Menu</button>
		<nav class="eh-nav__links" id="eh-site-nav" aria-label="Primary">
			<a href="<?php echo esc_url( home_url( '/#treatments' ) ); ?>">Treatments</a>
			<a href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Events &amp; groups</a>
			<a href="<?php echo esc_url( home_url( '/#team' ) ); ?>">Care team</a>
			<a href="<?php echo esc_url( home_url( '/#reviews' ) ); ?>">Reviews</a>
			<a href="<?php echo esc_url( home_url( '/#areas' ) ); ?>">Service area</a>
		</nav>
		<a class="eh-nav__phone" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>"><?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a>
		<a class="eh-btn eh-btn--primary eh-btn--sm eh-nav__book" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book a visit</a>
	</div>
</div>
<!-- /wp:html -->
