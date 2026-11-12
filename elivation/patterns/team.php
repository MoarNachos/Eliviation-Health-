<?php
/**
 * Title: Team
 * Slug: elivation/team
 * Categories: elivation
 * Description: Dark section introducing the clinical team: Richard Ladines's profile with a client quote, the physician-oversight explanation, a link to the full team and a group photo.
 *
 * Profiles come from elivation_team() in inc/team.php. The medical director appears next to
 * Richard only once elivation_medical_director() returns an approved profile.
 *
 * TODO(client): verify every name, credential and title.
 * TODO(client): verify the description of the medical director's oversight.
 * TODO(client): supply the medical director's verified name, credentials, portrait and role description (see inc/team.php).
 *
 * @package elivation
 */

$elivation_team     = elivation_team();
$elivation_lead     = $elivation_team['richard-ladines'];
$elivation_director = elivation_medical_director();
// Verbatim passage from Jackie G.'s review (r4 in content/reviews.json); shown only if it still matches.
$elivation_quote    = 'Richard arrived right on time, fully equipped, and made me feel comfortable from the moment he walked in.';
$elivation_client   = elivation_reviews( array( 'r4' ) );
$elivation_client   = $elivation_client && false !== strpos( $elivation_client[0]['text'], $elivation_quote ) ? $elivation_client[0] : null;
?>
<!-- wp:group {"tagName":"section","anchor":"team","className":"eh-scope eh-section eh-section--inverse"} -->
<section id="team" class="wp-block-group eh-scope eh-section eh-section--inverse">
<!-- wp:group {"className":"eh-container eh-stack-48"} -->
<div class="wp-block-group eh-container eh-stack-48">
<!-- wp:group {"className":"eh-split eh-split--end"} -->
<div class="wp-block-group eh-split eh-split--end">
<!-- wp:group {"className":"eh-section__intro"} -->
<div class="wp-block-group eh-section__intro">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">Your care team</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-h2"} -->
<h2 class="wp-block-heading eh-h2">Critical-care experience, <em>at your kitchen table.</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">Our medical director sets the treatment protocols. The registered nurse who visits you checks your vitals, reviews your medications and answers your questions before starting an IV. If a treatment isn't right for you, your nurse will tell you.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="eh-clinicians<?php echo $elivation_director ? ' eh-clinicians--pair' : ''; ?>">
	<div class="eh-clinicians__lead">
		<?php echo elivation_profile( 'richard-ladines', $elivation_lead, 'summary' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped inside. ?>
		<?php if ( $elivation_client ) : ?>
		<blockquote class="eh-clinicians__quote">
			<p>“<?php echo esc_html( $elivation_quote ); ?>”</p>
			<cite><?php echo esc_html( $elivation_client['author'] ); ?> · Elivation client · <a href="<?php echo esc_url( elivation_reviews_url( $elivation_client['id'] ) ); ?>">Read the full review</a></cite>
		</blockquote>
		<?php endif; ?>
	</div>
	<?php if ( $elivation_director ) : ?>
	<?php echo elivation_profile( 'medical-director', $elivation_director, 'summary' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped inside. ?>
	<?php endif; ?>
</div>
<p class="eh-more eh-clinicians__more"><a href="<?php echo esc_url( elivation_page_url( 'about-us' ) ); ?>">Meet the full team →</a></p>
<!-- /wp:html -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-team__group"} -->
<figure class="wp-block-image size-full eh-team__group"><img src="<?php echo esc_url( elivation_photo_url( 'team-2' ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( 'team-2' ) ); ?>"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
