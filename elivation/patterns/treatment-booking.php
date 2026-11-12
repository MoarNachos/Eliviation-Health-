<?php
/**
 * Title: Treatment: booking drawer and mobile bar
 * Slug: elivation/treatment-booking
 * Categories: elivation
 * Inserter: no
 * Description: In-page booking drawer (bottom sheet on mobile, side panel on desktop) opened by any Book button, plus the sticky "Book [Category] · from $X" bar on mobile.
 *
 * Steps: 1 drip, 2 ZIP, 3 date and time, 4 name and phone + summary. Confirm hands
 * off to the booking site. Behavior is in assets/js/theme.js (initBooking).
 * Without JavaScript the Book links go straight to the booking site.
 *
 * TODO(client): confirm the booking platform accepts drip, zip, date and time query parameters.
 * TODO(client): confirm the time windows below match the hours nurses are available.
 * TODO(build): name and phone are NOT sent anywhere (kept out of the URL on purpose). Send them to the CRM or booking API once one is chosen.
 *
 * @package elivation
 */

$elivation_key  = elivation_current_treatment( true );
$elivation_tx   = elivation_treatment( $elivation_key );
$elivation_from = elivation_price( elivation_treatment_from_price( $elivation_tx ) );
$elivation_slots = array(
	'morning'   => 'Morning · 8–11am',
	'midday'    => 'Midday · 11am–2pm',
	'afternoon' => 'Afternoon · 2–5pm',
	'evening'   => 'Evening · 5–8pm',
);
?>
<!-- wp:html -->
<div class="eh-bookbar eh-bookbar--treatment" role="region" aria-label="Book <?php echo esc_attr( $elivation_tx['name'] ); ?>">
	<a class="eh-btn eh-btn--ghost" href="tel:<?php echo esc_attr( ELIVATION_PHONE_TEL ); ?>">Call</a>
	<a class="eh-btn eh-btn--primary" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>" data-eh-book>Book <?php echo esc_html( $elivation_tx['name'] ); ?> · from <?php echo esc_html( $elivation_from ); ?></a>
</div>

<div class="eh-scope eh-drawer" data-eh-drawer hidden>
	<div class="eh-drawer__backdrop" data-eh-drawer-close></div>
	<div class="eh-drawer__panel" role="dialog" aria-modal="true" aria-labelledby="eh-drawer-title" tabindex="-1">
		<div class="eh-drawer__head">
			<div class="eh-drawer__heading">
				<p class="eh-drawer__progress" data-eh-drawer-progress>Step 1 of 4</p>
				<h2 class="eh-drawer__title" id="eh-drawer-title" data-eh-drawer-title>Choose your drip</h2>
			</div>
			<button class="eh-drawer__close" type="button" data-eh-drawer-close aria-label="Close booking">×</button>
		</div>

		<form class="eh-drawer__form" data-eh-booking-form action="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>" method="get" novalidate data-category="<?php echo esc_attr( $elivation_key ); ?>">
			<fieldset class="eh-drawer__step" data-step="1" data-title="Choose your drip">
				<legend class="eh-visually-hidden">Choose your drip</legend>
				<div class="eh-dripopts">
				<?php foreach ( $elivation_tx['drips'] as $elivation_drip ) : ?>
					<label class="eh-dripopt">
						<input type="radio" name="drip" value="<?php echo esc_attr( $elivation_drip['id'] ); ?>" data-name="<?php echo esc_attr( $elivation_drip['name'] ); ?>" data-price="<?php echo esc_attr( elivation_price( $elivation_drip['price'] ) ); ?>" data-dur="<?php echo esc_attr( $elivation_drip['dur'] ); ?>" required>
						<span class="eh-dripopt__box">
							<span class="eh-dripopt__name"><?php echo esc_html( $elivation_drip['name'] ); ?></span>
							<span class="eh-dripopt__meta"><?php echo esc_html( elivation_price( $elivation_drip['price'] ) . ' · ' . $elivation_drip['dur'] ); ?></span>
						</span>
					</label>
				<?php endforeach; ?>
				</div>
			</fieldset>

			<fieldset class="eh-drawer__step" data-step="2" data-title="Where should we meet you?" hidden>
				<legend class="eh-visually-hidden">Where should we meet you?</legend>
				<label class="eh-field">ZIP code
					<input name="zip" type="text" inputmode="numeric" autocomplete="postal-code" maxlength="5" placeholder="e.g. 92660" required pattern="\d{5}">
				</label>
				<p class="eh-drawer__hint">We'll ask for your full address when we confirm.</p>
			</fieldset>

			<fieldset class="eh-drawer__step" data-step="3" data-title="Pick a date and time" hidden>
				<legend class="eh-visually-hidden">Pick a date and time</legend>
				<label class="eh-field">Date
					<input name="date" type="date" required data-eh-date>
				</label>
				<fieldset class="eh-fieldset">
					<legend>Preferred time</legend>
					<div class="eh-choices">
					<?php foreach ( $elivation_slots as $elivation_slot => $elivation_slot_label ) : ?>
						<label class="eh-choice"><input type="radio" name="time" value="<?php echo esc_attr( $elivation_slot ); ?>" required><span><?php echo esc_html( $elivation_slot_label ); ?></span></label>
					<?php endforeach; ?>
					</div>
				</fieldset>
				<p class="eh-drawer__hint">We'll confirm an exact arrival window by text.</p>
			</fieldset>

			<fieldset class="eh-drawer__step" data-step="4" data-title="Your details" hidden>
				<legend class="eh-visually-hidden">Your details</legend>
				<div class="eh-form__grid">
					<label class="eh-field">Name
						<input name="name" type="text" autocomplete="name" required>
					</label>
					<label class="eh-field">Mobile phone
						<input name="phone" type="tel" autocomplete="tel" inputmode="tel" required pattern="[\d\s()+.\-]{10,}">
					</label>
				</div>
				<dl class="eh-summary" data-eh-summary aria-live="polite"></dl>
				<p class="eh-drawer__hint">A Registered Nurse will review your health history before your drip. Prices include the nurse visit, health screening and supplies.</p>
			</fieldset>

			<div class="eh-drawer__actions">
				<p class="eh-form__status" data-eh-booking-status role="alert" hidden></p>
				<button class="eh-btn eh-btn--ghost" type="button" data-eh-drawer-back hidden>Back</button>
				<button class="eh-btn eh-btn--primary" type="submit" data-eh-drawer-next>Continue</button>
			</div>
		</form>
	</div>
</div>
<!-- /wp:html -->
