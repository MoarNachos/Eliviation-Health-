<?php
/**
 * Title: Treatment hero
 * Slug: elivation/treatment-hero
 * Categories: elivation
 * Inserter: no
 * Description: Treatment page hero: breadcrumb, H1, one-line promise, photo, Book and See drips buttons, trust line.
 *
 * Content comes from elivation_treatments() in inc/treatments.php.
 * TODO(client): verify "HSA / FSA eligible" and "Registered Nurses · Physician directed".
 *
 * @package elivation
 */

$elivation_key = elivation_current_treatment( true );
$elivation_tx  = elivation_treatment( $elivation_key );
$elivation_from = elivation_price( elivation_treatment_from_price( $elivation_tx ) );
?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-tx-hero"} -->
<section class="wp-block-group eh-scope eh-tx-hero">
<!-- wp:group {"className":"eh-container eh-split eh-split--440 eh-split--center"} -->
<div class="wp-block-group eh-container eh-split eh-split--440 eh-split--center">
<!-- wp:group {"className":"eh-stack-24"} -->
<div class="wp-block-group eh-stack-24">
<!-- wp:html -->
<nav class="eh-crumbs" aria-label="Breadcrumb">
	<ol>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
		<li><a href="<?php echo esc_url( home_url( '/#treatments' ) ); ?>">Treatments</a></li>
		<li aria-current="page"><?php echo esc_html( $elivation_tx['name'] ); ?></li>
	</ol>
</nav>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"eh-eyebrow eh-eyebrow--dot"} -->
<p class="eh-eyebrow eh-eyebrow--dot"><?php echo esc_html( $elivation_tx['name'] ); ?> IV therapy · delivered to you</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"eh-tx-hero__title"} -->
<h1 class="wp-block-heading eh-tx-hero__title"><?php echo esc_html( $elivation_tx['h1'][0] ); ?><em><?php echo esc_html( $elivation_tx['h1'][1] ); ?></em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede"><?php echo esc_html( $elivation_tx['promise'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="eh-actions eh-tx-hero__actions">
	<a class="eh-btn eh-btn--primary" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>" data-eh-book>Book <?php echo esc_html( $elivation_tx['name'] ); ?></a>
	<a class="eh-btn eh-btn--ghost" href="#drips">See drips &amp; prices</a>
</div>
<!-- /wp:html -->

<!-- wp:list {"className":"eh-tx-hero__trust"} -->
<ul class="wp-block-list eh-tx-hero__trust">
<!-- wp:list-item -->
<li>From <?php echo esc_html( $elivation_from ); ?></li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li><?php echo esc_html( $elivation_tx['session'] ); ?> sessions</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>HSA / FSA eligible</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Registered Nurses · Physician directed</li>
<!-- /wp:list-item -->
</ul>
<!-- /wp:list -->
</div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-tx-hero__photo"} -->
<figure class="wp-block-image size-full eh-tx-hero__photo"><img src="<?php echo esc_url( elivation_photo_url( $elivation_tx['photo'] ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( $elivation_tx['photo'] ) ); ?>"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
