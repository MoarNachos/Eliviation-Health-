<?php
/**
 * Title: Treatment: FAQ
 * Slug: elivation/treatment-faq
 * Categories: elivation
 * Inserter: no
 * Description: Category-specific questions in an accordion (details/summary, works without JavaScript). The same text feeds the FAQPage JSON-LD.
 *
 * TODO(client): answers are in elivation_treatments() (inc/treatments.php) and need medical director review.
 *
 * @package elivation
 */

$elivation_tx = elivation_treatment( elivation_current_treatment( true ) );
?>
<!-- wp:group {"tagName":"section","anchor":"faq","className":"eh-scope eh-section"} -->
<section id="faq" class="wp-block-group eh-scope eh-section">
<!-- wp:group {"className":"eh-container eh-split eh-split--start"} -->
<div class="wp-block-group eh-container eh-split eh-split--start">
<!-- wp:group {"className":"eh-stack-20"} -->
<div class="wp-block-group eh-stack-20">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">Questions</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2"><?php echo esc_html( $elivation_tx['name'] ); ?>, <em>asked and answered.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">Something else on your mind? Call <a href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>"><?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a>.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="eh-faq">
<?php foreach ( $elivation_tx['faq'] as $elivation_i => $elivation_item ) : ?>
	<details class="eh-faq__item"<?php echo 0 === $elivation_i ? ' open' : ''; ?>>
		<summary><h3 class="eh-faq__q"><?php echo esc_html( $elivation_item['q'] ); ?></h3></summary>
		<p><?php echo esc_html( $elivation_item['a'] ); ?></p>
	</details>
<?php endforeach; ?>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
