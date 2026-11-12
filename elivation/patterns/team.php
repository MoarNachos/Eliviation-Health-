<?php
/**
 * Title: Team
 * Slug: elivation/team
 * Categories: elivation
 * Description: Dark section introducing the nurses, with three portrait cards and a group photo.
 *
 * TODO(client): Kathy's and Jon's portraits still load from the old site's uploads folder. They need new photos, and those URLs will break when the old site is replaced.
 * TODO(client): verify every name, credential and title (RN, BSN, "Critical Care RN, 10+ years").
 * TODO(client): verify the description of the medical director's oversight.
 * TODO(client): supply the medical director's verified name and credentials if they should appear.
 * TODO(client): "Meet the full team" is left out until a team page exists.
 *
 * @package elivation
 */

$elivation_people = array(
	array(
		'name'  => 'Richard Ladines, RN, BSN',
		'role'  => 'Chief Nursing Officer · Critical Care RN, 10+ years',
		'photo' => get_theme_file_uri( 'assets/images/richard-ladines.webp' ),
		'alt'   => 'Richard Ladines, Chief Nursing Officer at Elivation Health',
	),
	array(
		'name'  => 'Kathy Tran',
		'role'  => 'Clinical Operations Lead',
		'photo' => 'https://www.elivationhealth.com/wp-content/uploads/2026/03/Kathy-Tran.png',
		'alt'   => 'Kathy Tran',
	),
	array(
		'name'  => 'Jon Lai',
		'role'  => 'Co-founder · Chief Operating Officer',
		'photo' => 'https://www.elivationhealth.com/wp-content/uploads/2026/03/Jon-Lai.png',
		'alt'   => 'Jon Lai',
	),
);
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

<!-- wp:group {"className":"eh-team"} -->
<div class="wp-block-group eh-team">
<?php foreach ( $elivation_people as $elivation_person ) : ?>
<!-- wp:group {"className":"eh-person"} -->
<div class="wp-block-group eh-person">
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-person__photo"} -->
<figure class="wp-block-image size-full eh-person__photo"><img src="<?php echo esc_url( $elivation_person['photo'] ); ?>" alt="<?php echo esc_attr( $elivation_person['alt'] ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"className":"eh-person__name"} -->
<h3 class="wp-block-heading eh-person__name"><?php echo esc_html( $elivation_person['name'] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-person__role"} -->
<p class="eh-person__role"><?php echo esc_html( $elivation_person['role'] ); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<?php endforeach; ?>
</div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-team__group"} -->
<figure class="wp-block-image size-full eh-team__group"><img src="<?php echo esc_url( elivation_photo_url( 'team-2' ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( 'team-2' ) ); ?>"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
