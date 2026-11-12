<?php
/**
 * Title: Treatment: who it's for
 * Slug: elivation/treatment-good-for
 * Categories: elivation
 * Inserter: no
 * Description: Four plain-language situations the treatment is for.
 *
 * @package elivation
 */

$elivation_tx = elivation_treatment( elivation_current_treatment( true ) );
?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-section eh-section--tight eh-goodfor"} -->
<section class="wp-block-group eh-scope eh-section eh-section--tight eh-goodfor">
<!-- wp:group {"className":"eh-container eh-split eh-split--start"} -->
<div class="wp-block-group eh-container eh-split eh-split--start">
<!-- wp:group {"className":"eh-stack-20"} -->
<div class="wp-block-group eh-stack-20">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">Who it's for</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Sound familiar? <em>We can help.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">Not sure <?php echo esc_html( $elivation_tx['name'] ); ?> is the right fit? Call <a href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>"><?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a> and a nurse will tell you straight.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:list {"className":"eh-goodfor__list"} -->
<ul class="wp-block-list eh-goodfor__list">
<?php foreach ( $elivation_tx['good_for'] as $elivation_line ) : ?>
<!-- wp:list-item -->
<li><?php echo esc_html( $elivation_line ); ?></li>
<!-- /wp:list-item -->
<?php endforeach; ?>
</ul>
<!-- /wp:list -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
