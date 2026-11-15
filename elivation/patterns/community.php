<?php
/**
 * Title: Community gallery
 * Slug: elivation/community
 * Categories: elivation, gallery
 * Description: Photo grid of the team out at local events, with the Instagram link.
 *
 * Photos in order: care in progress (2x2 lead), home vitals, home IV detail, event setup, quiet seating.
 *
 * TODO(client): Photo branded-tent-care-wide-3.jpg — Confirm consent for the identifiable standing guest and seated client; verify provider identity and RN status.
 * TODO(client): Photo nurse-home-vitals-1.jpg — Confirm consent for both clients; one seated face is visible. Confirm the care provider’s identity and RN status.
 * TODO(client): Photo relaxed-home-iv-detail-1.jpg — Confirm authorization for this client-treatment image despite the face being outside the frame. Also applies to home-community-iv (same source DSC_1818.jpg).
 * TODO(client): Photo branded-event-table-wide-2.jpg — Verify background people’s staff/client roles and consent for identifiable non-staff.
 *
 * @package elivation
 */

$elivation_gallery = array( 'branded-tent-care-wide-3', 'nurse-home-vitals-1', 'relaxed-home-iv-detail-1', 'branded-event-table-wide-2', 'community-4' );
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
