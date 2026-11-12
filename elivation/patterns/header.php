<?php
/**
 * Title: Header
 * Slug: elivation/header
 * Categories: elivation
 * Inserter: no
 * Description: Sticky header with wordmark, section links, phone and the Book a visit button.
 *
 * The wordmark is set in type until the official logo arrives.
 * TODO(client): replace the text wordmark with assets/logo.svg when supplied.
 *
 * @package elivation
 */

?>
<!-- wp:html -->
<div class="eh-nav" data-eh-nav>
	<a class="eh-skip" href="#main">Skip to content</a>
	<div class="eh-nav__inner">
		<a class="eh-wordmark" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Elivation Health, home">elivation<span class="eh-wordmark__dot">.</span></a>
		<button class="eh-nav__toggle" type="button" aria-expanded="false" aria-controls="eh-site-nav" data-eh-nav-toggle>Menu</button>
		<nav class="eh-nav__links" id="eh-site-nav" aria-label="Primary">
			<a href="<?php echo esc_url( home_url( '/#treatments' ) ); ?>">Treatments</a>
			<a href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Events &amp; Groups</a>
			<a href="<?php echo esc_url( home_url( '/#team' ) ); ?>">Our Nurses</a>
			<a href="<?php echo esc_url( home_url( '/#reviews' ) ); ?>">Reviews</a>
			<a href="<?php echo esc_url( home_url( '/#areas' ) ); ?>">Areas</a>
		</nav>
		<a class="eh-nav__phone" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>"><?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a>
		<a class="eh-btn eh-btn--primary eh-btn--sm eh-nav__book" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book a visit</a>
	</div>
</div>
<!-- /wp:html -->
