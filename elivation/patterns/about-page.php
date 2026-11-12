<?php
/**
 * Title: About: team profiles
 * Slug: elivation/about-page
 * Categories: elivation
 * Inserter: no
 * Description: The About page: clinical leadership first, then the founders and leadership, then community work.
 *
 * Profiles come from elivation_team() in inc/team.php. Each profile has a stable anchor
 * (for example /about-us/#richard-ladines) that the FAQ links to.
 *
 * TODO(client): verify every bio, title and award before launch.
 *
 * @package elivation
 */

$elivation_team     = elivation_team();
$elivation_director = elivation_medical_director();
$elivation_groups   = array(
	'clinical'   => array(),
	'leadership' => array(),
);
foreach ( $elivation_team as $elivation_id => $elivation_person ) {
	$elivation_groups[ $elivation_person['group'] ][ $elivation_id ] = $elivation_person;
}
?>
<!-- wp:group {"tagName":"section","className":"eh-scope eh-tx-hero"} -->
<section class="wp-block-group eh-scope eh-tx-hero">
<!-- wp:group {"className":"eh-container eh-stack-24"} -->
<div class="wp-block-group eh-container eh-stack-24">
<!-- wp:html -->
<nav class="eh-crumbs" aria-label="Breadcrumb">
	<ol>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
		<li aria-current="page">About us</li>
	</ol>
</nav>
<!-- /wp:html -->

<!-- wp:heading {"level":1,"className":"eh-tx-hero__title"} -->
<h1 class="wp-block-heading eh-tx-hero__title">The people behind <em>your visit.</em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede eh-section__intro--640"} -->
<p class="eh-lede eh-section__intro--640">Elivation Health provides physician-directed IV hydration, delivered by licensed Registered Nurses at your home, hotel, office or event. Meet the clinicians who lead our care and the leadership team behind the company.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<nav aria-label="On this page">
	<ul class="eh-areas">
		<li><a href="#clinical-leadership">Clinical leadership</a></li>
		<li><a href="#founders-and-leadership">Founders and leadership</a></li>
		<li><a href="#community">In our community</a></li>
	</ul>
</nav>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","anchor":"clinical-leadership","className":"eh-scope eh-section eh-section--inverse"} -->
<section id="clinical-leadership" class="wp-block-group eh-scope eh-section eh-section--inverse">
<!-- wp:group {"className":"eh-container eh-stack-48"} -->
<div class="wp-block-group eh-container eh-stack-48">
<!-- wp:group {"className":"eh-split eh-split--end"} -->
<div class="wp-block-group eh-split eh-split--end">
<!-- wp:group {"className":"eh-section__intro"} -->
<div class="wp-block-group eh-section__intro">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">Clinical leadership</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Who leads <em>your care.</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">Our medical director sets the treatment protocols. The registered nurse who visits you checks your vitals, reviews your medications and answers your questions before starting an IV. If a treatment isn't right for you, your nurse will tell you.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="eh-profiles">
<?php
if ( $elivation_director ) {
	echo elivation_profile( 'medical-director', $elivation_director ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped inside.
}
foreach ( $elivation_groups['clinical'] as $elivation_id => $elivation_person ) {
	echo elivation_profile( $elivation_id, $elivation_person ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped inside.
}
?>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","anchor":"founders-and-leadership","className":"eh-scope eh-section"} -->
<section id="founders-and-leadership" class="wp-block-group eh-scope eh-section">
<!-- wp:group {"className":"eh-container eh-stack-48"} -->
<div class="wp-block-group eh-container eh-stack-48">
<!-- wp:group {"className":"eh-split eh-split--end"} -->
<div class="wp-block-group eh-split eh-split--end">
<!-- wp:group {"className":"eh-section__intro"} -->
<div class="wp-block-group eh-section__intro">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">Founders and leadership</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">How Elivation <em>got started.</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">Elivation began with conversations between Jon Lai, his wife, an OB-GYN, and their partners about improving patient care. Together they recognized that something as simple as proper hydration could make a real difference to how people feel.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="eh-profiles">
<?php
foreach ( $elivation_groups['leadership'] as $elivation_id => $elivation_person ) {
	echo elivation_profile( $elivation_id, $elivation_person ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped inside.
}
?>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","anchor":"community","className":"eh-scope eh-section eh-section--sunken"} -->
<section id="community" class="wp-block-group eh-scope eh-section eh-section--sunken">
<!-- wp:group {"className":"eh-container eh-split eh-split--start"} -->
<div class="wp-block-group eh-container eh-split eh-split--start">
<!-- wp:group {"className":"eh-section__intro"} -->
<div class="wp-block-group eh-section__intro">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">In our community</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Giving back <em>in Orange County.</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"eh-stack-20"} -->
<div class="wp-block-group eh-stack-20">
<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">We’re committed to giving back to the communities we serve, including bringing quality IV fluid therapy to underserved communities and people who may benefit from it.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Our leadership team serves, or has served, on the boards of Orange County organizations including Ronald McDonald House Charities, Habitat for Humanity OC, Team Kids, United Way, OneOC, The Wooden Floor, Junior Achievement and the CSUF Center for Leadership.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="eh-tx-hero__actions">
	<a class="eh-btn eh-btn--primary" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>">Book a visit</a>
	<a class="eh-btn eh-btn--ghost" href="<?php echo esc_url( home_url( '/#events' ) ); ?>">Plan an event</a>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
