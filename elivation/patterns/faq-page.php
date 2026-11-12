<?php
/**
 * Title: Mobile IV frequently asked questions
 * Slug: elivation/faq-page
 * Categories: elivation
 * Inserter: no
 *
 * @package elivation
 */

$elivation_groups = elivation_faq_groups();
?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-tx-hero"} -->
<section class="wp-block-group eh-scope eh-tx-hero">
<!-- wp:group {"className":"eh-container eh-stack-24"} -->
<div class="wp-block-group eh-container eh-stack-24">
<!-- wp:html -->
<nav class="eh-crumbs" aria-label="Breadcrumb">
	<ol>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
		<li aria-current="page">Frequently asked questions</li>
	</ol>
</nav>
<!-- /wp:html -->

<!-- wp:heading {"level":1,"className":"eh-tx-hero__title"} -->
<h1 class="wp-block-heading eh-tx-hero__title">Mobile IV therapy <em>FAQ</em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede eh-section__intro--640"} -->
<p class="eh-lede eh-section__intro--640">Elivation Health brings physician-directed IV hydration to homes, hotels, offices and events in Orange County and select Los Angeles communities. Find out what a nurse visit costs, what happens when we arrive, and how to book.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<nav aria-label="FAQ topics">
	<ul class="eh-areas">
	<?php foreach ( $elivation_groups as $elivation_id => $elivation_group ) : ?>
		<li><a href="#<?php echo esc_attr( $elivation_id ); ?>"><?php echo esc_html( $elivation_group['title'] ); ?></a></li>
	<?php endforeach; ?>
	</ul>
</nav>
<div class="eh-tx-hero__actions">
	<a class="eh-btn eh-btn--primary" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book a visit</a>
	<a class="eh-btn eh-btn--ghost" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>">Call <?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->

<?php foreach ( $elivation_groups as $elivation_id => $elivation_group ) : ?>
<!-- wp:group {"tagName":"section","anchor":"<?php echo esc_attr( $elivation_id ); ?>","className":"eh-scope eh-section eh-section--tight"} -->
<section id="<?php echo esc_attr( $elivation_id ); ?>" class="wp-block-group eh-scope eh-section eh-section--tight">
<!-- wp:group {"className":"eh-container eh-split eh-split--start"} -->
<div class="wp-block-group eh-container eh-split eh-split--start">
<!-- wp:group {"className":"eh-stack-20"} -->
<div class="wp-block-group eh-stack-20">
<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2"><?php echo esc_html( $elivation_group['title'] ); ?></h2>
<!-- /wp:heading -->

<!-- wp:html -->
<ul class="eh-more">
	<?php foreach ( $elivation_group['links'] as $elivation_label => $elivation_url ) : ?>
	<li><a href="<?php echo esc_url( $elivation_url ); ?>"><?php echo esc_html( $elivation_label ); ?></a></li>
	<?php endforeach; ?>
</ul>
<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="eh-faq">
	<?php foreach ( $elivation_group['items'] as $elivation_index => $elivation_item ) : ?>
	<details class="eh-faq__item"<?php echo 0 === $elivation_index ? ' open' : ''; ?>>
		<summary><h3 class="eh-faq__q"><?php echo esc_html( $elivation_item['q'] ); ?></h3></summary>
		<p><?php echo esc_html( $elivation_item['a'] ); ?></p>
		<?php foreach ( $elivation_item['link'] ?? array() as $elivation_label => $elivation_url ) : ?>
		<p class="eh-more"><a href="<?php echo esc_url( $elivation_url ); ?>"><?php echo esc_html( $elivation_label ); ?> →</a></p>
		<?php endforeach; ?>
	</details>
	<?php endforeach; ?>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
<?php endforeach; ?>

<!-- wp:group {"tagName":"section","className":"eh-scope eh-section eh-section--sunken eh-section--tight"} -->
<section class="wp-block-group eh-scope eh-section eh-section--sunken eh-section--tight">
<!-- wp:group {"className":"eh-container eh-stack-24"} -->
<div class="wp-block-group eh-container eh-stack-24">
<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Have a question about <em>your visit?</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">Call with your ZIP code, preferred time, or a treatment you’re considering. We’ll help you work out the next step.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="eh-tx-hero__actions">
	<a class="eh-btn eh-btn--primary" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book a visit</a>
	<a class="eh-btn eh-btn--ghost" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>">Call <?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
