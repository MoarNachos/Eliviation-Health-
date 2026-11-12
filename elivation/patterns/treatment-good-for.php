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
$elivation_fit_heading = $elivation_tx['fit_heading'] ?? array( 'Is this visit ', 'right for you?' );
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
<h2 class="wp-block-heading eh-h2"><?php echo esc_html( $elivation_fit_heading[0] ); ?><em><?php echo esc_html( $elivation_fit_heading[1] ); ?></em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">Have a question before you choose? Call <a href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>"><?php echo esc_html( ELIVATION_PHONE_DISPLAY ); ?></a> to talk through the options with our team.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-stack-24"} -->
<div class="wp-block-group eh-stack-24">
<!-- wp:list {"className":"eh-goodfor__list"} -->
<ul class="wp-block-list eh-goodfor__list">
<?php foreach ( $elivation_tx['good_for'] as $elivation_line ) : ?>
<!-- wp:list-item -->
<li><?php echo esc_html( $elivation_line ); ?></li>
<!-- /wp:list-item -->
<?php endforeach; ?>
</ul>
<!-- /wp:list -->

<!-- wp:pattern {"slug":"elivation/treatment-reviews"} /-->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
