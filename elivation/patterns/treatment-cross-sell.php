<?php
/**
 * Title: Treatment: cross-sell
 * Slug: elivation/treatment-cross-sell
 * Categories: elivation
 * Inserter: no
 * Description: Links to the other two treatment pages and to Events & Groups.
 *
 * @package elivation
 */

$elivation_key   = elivation_current_treatment( true );
$elivation_blurb = array(
	'recovery'     => 'Bounce back from training, travel or a big night.',
	'relief'       => 'Cold and flu, nausea, migraines and food poisoning.',
	'rejuvenation' => 'NAD+ and wellness drips for energy, focus and skin.',
);
?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-section eh-section--sunken eh-section--tight"} -->
<section class="wp-block-group eh-scope eh-section eh-section--sunken eh-section--tight">
<!-- wp:group {"className":"eh-container eh-stack-40"} -->
<div class="wp-block-group eh-container eh-stack-40">
<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Something else <em>in mind?</em></h2>
<!-- /wp:heading -->

<!-- wp:html -->
<div class="eh-xsell">
<?php
foreach ( elivation_treatments() as $elivation_other_key => $elivation_other ) :
	if ( $elivation_other_key === $elivation_key ) {
		continue;
	}
	?>
	<a class="eh-card eh-xsell__card" href="<?php echo esc_url( elivation_treatment_url( $elivation_other_key ) ); ?>">
		<span class="eh-xsell__title"><?php echo esc_html( $elivation_other['name'] ); ?> <span aria-hidden="true">→</span></span>
		<span><?php echo esc_html( $elivation_blurb[ $elivation_other_key ] ?? $elivation_other['promise'] ); ?></span>
		<span class="eh-xsell__from">From <?php echo esc_html( elivation_price( elivation_treatment_from_price( $elivation_other ) ) ); ?></span>
	</a>
<?php endforeach; ?>
	<a class="eh-card eh-xsell__card eh-xsell__card--events" href="<?php echo esc_url( home_url( '/#events' ) ); ?>">
		<span class="eh-xsell__title">Events &amp; Groups <span aria-hidden="true">→</span></span>
		<span>Bring the IV lounge to your team, race or celebration.</span>
		<span class="eh-xsell__from">Request a quote</span>
	</a>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
