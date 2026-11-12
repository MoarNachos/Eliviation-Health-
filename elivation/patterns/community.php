<?php
/**
 * Title: Community gallery
 * Slug: elivation/community
 * Categories: elivation, gallery
 * Description: Photo grid of the team out at local events, with the Instagram link.
 *
 * Photos in order: team-4 (2x2 lead), community-1, event-3, event-2, community-4.
 *
 * @package elivation
 */

$elivation_gallery = array( 'team-4', 'community-1', 'event-3', 'event-2', 'community-4' );
?>
<!-- wp:group {"tagName":"section","anchor":"community","className":"eh-scope eh-section"} -->
<section id="community" class="wp-block-group eh-scope eh-section">
<!-- wp:group {"className":"eh-container eh-stack-40"} -->
<div class="wp-block-group eh-container eh-stack-40">
<!-- wp:group {"className":"eh-section__head"} -->
<div class="wp-block-group eh-section__head">
<!-- wp:group {"className":"eh-section__intro"} -->
<div class="wp-block-group eh-section__intro">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">Out in the community</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Your neighbors in <em>Orange County.</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"eh-more"} -->
<p class="eh-more"><a href="<?php echo esc_url( ELIVATION_INSTAGRAM_URL ); ?>">@elivation.health on Instagram →</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-gallery"} -->
<div class="wp-block-group eh-gallery">
<?php
foreach ( $elivation_gallery as $elivation_index => $elivation_photo ) :
	$elivation_class = 0 === $elivation_index ? 'eh-gallery__item eh-gallery__lead' : 'eh-gallery__item';
	?>
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"<?php echo esc_attr( $elivation_class ); ?>"} -->
<figure class="wp-block-image size-full <?php echo esc_attr( $elivation_class ); ?>"><img src="<?php echo esc_url( elivation_photo_url( $elivation_photo ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( $elivation_photo ) ); ?>"/></figure>
<!-- /wp:image -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
