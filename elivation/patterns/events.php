<?php
/**
 * Title: Events and groups
 * Slug: elivation/events
 * Categories: elivation, call-to-action
 * Description: Coral section pitching group events, with the inquiry form.
 *
 * TODO(client): verify "Groups of 4 to 100+", "Onsite nurse team" and "Custom menus".
 * TODO(client): verify the "reply within one business day" promise (also used in the success message in theme.js).
 * TODO(build): the form is NOT connected. It validates in the browser and then asks the visitor to call. Decide where inquiries go (email or CRM) and wire it up.
 *
 * @package elivation
 */

?>
<!-- wp:group {"tagName":"section","anchor":"events","className":"eh-scope eh-section eh-section--accent"} -->
<section id="events" class="wp-block-group eh-scope eh-section eh-section--accent">
<!-- wp:group {"className":"eh-container eh-split eh-split--start eh-split--440"} -->
<div class="wp-block-group eh-container eh-split eh-split--start eh-split--440">
<!-- wp:group {"className":"eh-stack-24"} -->
<div class="wp-block-group eh-stack-24">
<!-- wp:paragraph {"className":"eh-eyebrow"} -->
<p class="eh-eyebrow">Events &amp; groups</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"eh-events__title"} -->
<h2 class="wp-block-heading eh-events__title">Bring the IV lounge <em>to your people.</em></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"eh-lede"} -->
<p class="eh-lede">Bachelorette weekends, corporate wellness days, races, conferences and film sets. We bring the nurses, chairs and setup — you bring the guests.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"eh-events__photo"} -->
<figure class="wp-block-image size-full eh-events__photo"><img src="<?php echo esc_url( elivation_photo_url( 'event-1' ) ); ?>" alt="<?php echo esc_attr( elivation_photo_alt( 'event-1' ) ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:list {"className":"eh-events__facts"} -->
<ul class="wp-block-list eh-events__facts">
<!-- wp:list-item -->
<li>Groups of 4 to 100+</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Onsite nurse team</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Custom menus</li>
<!-- /wp:list-item -->
</ul>
<!-- /wp:list -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<form class="eh-form" data-eh-event-form novalidate>
	<h3 class="eh-form__title">Tell us about your event</h3>
	<p class="eh-form__note">We reply within one business day with a quote.</p>
	<div class="eh-form__grid">
		<label class="eh-field">Your name
			<input type="text" name="name" autocomplete="name" placeholder="Jordan Lee" required>
		</label>
		<label class="eh-field">Email
			<input type="email" name="email" autocomplete="email" placeholder="you@company.com" required>
		</label>
		<label class="eh-field">Event date
			<input type="date" name="date" required>
		</label>
		<label class="eh-field">Guests
			<select name="guests">
				<option>4–10</option>
				<option>11–25</option>
				<option>26–50</option>
				<option>50+</option>
			</select>
		</label>
	</div>
	<fieldset class="eh-fieldset">
		<legend>Type of event</legend>
		<div class="eh-choices">
			<label class="eh-choice"><input type="radio" name="type" value="Corporate" checked><span>Corporate</span></label>
			<label class="eh-choice"><input type="radio" name="type" value="Bachelorette"><span>Bachelorette</span></label>
			<label class="eh-choice"><input type="radio" name="type" value="Wedding"><span>Wedding</span></label>
			<label class="eh-choice"><input type="radio" name="type" value="Sports / race"><span>Sports / race</span></label>
			<label class="eh-choice"><input type="radio" name="type" value="Other"><span>Other</span></label>
		</div>
	</fieldset>
	<button class="eh-btn eh-btn--secondary eh-btn--block" type="submit">Request a quote</button>
	<p class="eh-form__status" data-eh-form-status role="status" aria-live="polite" hidden></p>
</form>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
