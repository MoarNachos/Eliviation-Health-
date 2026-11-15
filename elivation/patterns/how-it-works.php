<?php
/**
 * Title: How it works
 * Slug: elivation/how-it-works
 * Categories: elivation
 * Description: Three numbered steps from booking to the visit.
 *
 * Visit lengths correspond to the full appointments listed on the treatment pages.
 *
 * TODO(client): Photo nurse-home-vitals-1.jpg — Confirm consent for both clients; one seated face is visible. Confirm the care provider’s identity and RN status.
 *
 * @package elivation
 */

?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-steps"} -->
<section class="wp-block-group eh-scope eh-steps">
<!-- wp:heading {"className":"eh-visually-hidden"} -->
<h2 class="wp-block-heading eh-visually-hidden">How it works</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"eh-steps__layout"} -->
<div class="wp-block-group eh-steps__layout">
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-steps__photo"} -->
<figure class="wp-block-image size-full eh-steps__photo"><img src="<?php echo esc_url( elivation_photo_url( 'nurse-home-vitals-1' ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( 'nurse-home-vitals-1' ) ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"eh-steps__grid"} -->
<div class="wp-block-group eh-steps__grid">
<!-- wp:group {"className":"eh-step"} -->
<div class="wp-block-group eh-step">
<!-- wp:paragraph {"className":"eh-step__num"} -->
<p class="eh-step__num">01</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"eh-step__title"} -->
<h3 class="wp-block-heading eh-step__title">Choose a visit</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Choose your treatment and a time online, or call if you’d like help picking an option.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-step"} -->
<div class="wp-block-group eh-step">
<!-- wp:paragraph {"className":"eh-step__num"} -->
<p class="eh-step__num">02</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"eh-step__title"} -->
<h3 class="wp-block-heading eh-step__title">Meet your nurse</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>At your home, office or hotel, your nurse reviews your health history, checks your vitals and talks you through the visit.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-step"} -->
<div class="wp-block-group eh-step">
<!-- wp:paragraph {"className":"eh-step__num"} -->
<p class="eh-step__num">03</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"eh-step__title"} -->
<h3 class="wp-block-heading eh-step__title">Settle in at home</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Your nurse stays with you. Allow about 75 minutes for most visits, including screening, or up to 2½ hours for NAD+.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
