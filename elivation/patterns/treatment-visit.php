<?php
/**
 * Title: Treatment: how a visit works
 * Slug: elivation/treatment-visit
 * Categories: elivation
 * Inserter: no
 * Description: Three steps: book, a Registered Nurse arrives and screens you, relax. Reuses the homepage step styles.
 *
 * TODO(client): verify "Your nurse texts you before arriving" and the session length per category.
 *
 * @package elivation
 */

$elivation_tx = elivation_treatment( elivation_current_treatment( true ) );
?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-section eh-section--tight"} -->
<section class="wp-block-group eh-scope eh-section eh-section--tight">
<!-- wp:group {"className":"eh-container eh-stack-40"} -->
<div class="wp-block-group eh-container eh-stack-40">
<!-- wp:group {"className":"eh-section__intro eh-section__intro--640"} -->
<div class="wp-block-group eh-section__intro eh-section__intro--640">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">How a visit works</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Three steps. <em>All of them at your place.</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-steps__grid"} -->
<div class="wp-block-group eh-steps__grid">
<!-- wp:group {"className":"eh-step"} -->
<div class="wp-block-group eh-step">
<!-- wp:paragraph {"className":"eh-step__num"} -->
<p class="eh-step__num">01</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"eh-step__title"} -->
<h3 class="wp-block-heading eh-step__title">Book your drip</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Pick a drip, your ZIP and a time here, or call and talk to a real person.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-step"} -->
<div class="wp-block-group eh-step">
<!-- wp:paragraph {"className":"eh-step__num"} -->
<p class="eh-step__num">02</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"eh-step__title"} -->
<h3 class="wp-block-heading eh-step__title">A Registered Nurse arrives and screens you</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Your nurse texts you before arriving, reviews your health history and checks your vitals. Nothing starts until they're happy it's right for you.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-step"} -->
<div class="wp-block-group eh-step">
<!-- wp:paragraph {"className":"eh-step__num"} -->
<p class="eh-step__num">03</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"eh-step__title"} -->
<h3 class="wp-block-heading eh-step__title">Relax for <?php echo esc_html( $elivation_tx['session'] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Stay on the couch, take a call, or nap. Your nurse stays with you and cleans up when they leave.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
