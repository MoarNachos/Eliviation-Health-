<?php
/**
 * General questions about booking mobile care. The FAQ page and its
 * structured data read the same questions and plain-text answers here.
 *
 * @package elivation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return array Groups keyed by fragment ID, each with a title, questions and related links.
 */
function elivation_faq_groups() {
	$treatments    = elivation_treatments();
	$starting      = array();
	$timings       = array();
	$nad_options   = array();
	foreach ( $treatments as $treatment ) {
		if ( empty( $treatment['drips'] ) ) {
			continue;
		}
		$starting[] = sprintf( '%s starts at %s.', $treatment['name'], elivation_price( elivation_treatment_from_price( $treatment ) ) );
		foreach ( $treatment['drips'] as $drip ) {
			if ( 'basic' === $drip['id'] || 'nad250' === $drip['id'] ) {
				$duration = strtr( strtolower( $drip['dur'] ), array( '1h 15m' => '75 minutes', '2h 30m' => '2½ hours' ) );
				$timings[] = $drip['name'] . ' is booked for ' . $duration . '.';
			}
			if ( 'nad250' === $drip['id'] || 'nad500' === $drip['id'] ) {
				$nad_options[] = $drip['name'] . ' is ' . elivation_price( $drip['price'] );
			}
		}
	}

	return array(
		'locations' => array(
			'title' => 'Locations and booking',
			'items' => array(
				array(
					'q' => 'Where can I book mobile IV therapy in Orange County?',
					'a' => 'Elivation Health makes mobile visits in Orange County, California, including Irvine, Anaheim, Costa Mesa and Newport Beach. Choose your city when booking, or call with your address and preferred date to check availability.',
				),
				array(
					'q' => 'Which parts of Los Angeles can a nurse visit?',
					'a' => 'In Los Angeles, the booking menu includes neighborhoods such as Downtown LA and Van Nuys, as well as nearby cities including Pasadena and Long Beach. Look for your city or neighborhood by name. If you don’t see it, call with your ZIP code so we can check your address and date.',
				),
				array(
					'q' => 'Can I get an IV at a hotel or office?',
					'a' => 'Yes. You can request a visit to a hotel or workplace in our service area. Give the team the address, a way to reach you, and any front-desk or building entry instructions so your nurse knows where to meet you.',
				),
				array(
					'q' => 'How do I find a same-day appointment?',
					'a' => 'Call ' . ELIVATION_PHONE_DISPLAY . ' with your city or ZIP code and the time you have available. The team can check the schedule for your address. For a future visit, choose your city and preferred time through online booking.',
				),
			),
			'links' => array( 'See our service area' => home_url( '/#areas' ) ),
		),
		'pricing' => array(
			'title' => 'Prices and payment',
			'items' => array(
				array(
					'q' => 'How much does a mobile IV visit cost?',
					'a' => implode( ' ', $starting ) . ( $starting ? ' ' : '' ) . 'Your total depends on the infusion you select, any add-ons, and whether a travel fee applies to your address. Each treatment page lists individual prices before you choose a visit.',
				),
				array(
					'q' => 'What does the listed price include?',
					'a' => 'The listed infusion price includes the nurse’s visit, health screening and supplies. Travel fees may apply outside our core service area. Ask the team for the total for your address and selected treatment when you book.',
				),
				array(
					'q' => 'How much does an at-home NAD+ infusion cost?',
					'a' => ( $nad_options ? implode( ' and ', $nad_options ) . '. ' : '' ) . 'The Rejuvenation menu lists NAD+ options separately from other wellness infusions. If you’re considering an add-on, ask your nurse about the additional charge and whether it’s appropriate for you.',
				),
				array(
					'q' => 'Can I use HSA or FSA funds for a visit?',
					'a' => 'Ask your plan administrator whether your particular visit qualifies and what documentation they require. If you have questions about using your card when booking, call Elivation before you schedule.',
				),
			),
			'links' => array( 'Explore the treatments' => home_url( '/#treatments' ) ),
		),
		'treatments' => array(
			'title' => 'Choosing a treatment',
			'items' => array(
				array(
					'q' => 'How do I choose between Relief, Recovery and Rejuvenation?',
					'a' => 'Relief covers hydration visits when illness or nausea has made drinking fluids difficult. Recovery includes options after travel, a race or a late night. Rejuvenation includes planned wellness visits and NAD+ infusions. If more than one seems relevant, call and describe what’s bringing you in. A nurse can help you decide whether a visit fits.',
				),
				array(
					'q' => 'What is in an IV hydration bag?',
					'a' => 'The contents vary by treatment. For example, the Basic Drip uses sterile saline, while Lactated Ringer’s is a balanced electrolyte solution. Other options may contain vitamins or medications. Ask about the ingredients in the specific infusion you’re considering, especially if you have an allergy.',
				),
				array(
					'q' => 'What if I want help choosing before I book?',
					'a' => 'Call ' . ELIVATION_PHONE_DISPLAY . ' and explain your reason for the visit. Tell us if you’re comparing two menu options, have a question about an ingredient, or are unsure whether an infusion is appropriate. Your visiting nurse will also review your health history before starting any treatment.',
				),
			),
			'links' => array(
				'Relief options'       => elivation_treatment_url( 'relief' ),
				'Recovery options'     => elivation_treatment_url( 'recovery' ),
				'Rejuvenation options' => elivation_treatment_url( 'rejuvenation' ),
			),
		),
		'your-visit' => array(
			'title' => 'Your nurse and your visit',
			'items' => array(
				array(
					'q' => 'What is mobile IV hydration?',
					'a' => 'It’s an appointment with a registered nurse who brings IV equipment and supplies to you. After a health screening, the nurse can give fluids through a small tube placed in a vein. The nurse explains what’s in the bag and stays with you during the infusion.',
				),
				array(
					'q' => 'Who comes to my home, and what does physician-directed care mean?',
					'a' => 'A registered nurse comes to you. Elivation’s medical director sets the protocols for the infusions, and Richard Ladines, RN, BSN, leads the nursing team. The nurse who visits screens you, explains your options, places the IV if appropriate and monitors you throughout the infusion.',
				),
				array(
					'q' => 'What should I have ready when my nurse arrives?',
					'a' => 'Have your medication list and allergy information available. Choose a comfortable place where you can sit for the visit and tell the team how to find you. Your nurse brings the supplies, reviews your health history and checks your vitals before deciding whether to proceed.',
				),
				array(
					'q' => 'How long should I set aside for an appointment?',
					'a' => ( $timings ? implode( ' ', $timings ) . ' ' : '' ) . 'Allow time for the whole visit, including screening. Your nurse monitors your comfort and can adjust the pace of the infusion. Check the duration for your selected treatment before setting another appointment afterward.',
				),
				array(
					'q' => 'Does the nurse stay during the infusion?',
					'a' => 'Yes. Your nurse stays for the infusion, monitors how you’re feeling and removes the IV when the session is complete. You can rest, read or do quiet work while seated. Tell your nurse right away if you feel uncomfortable.',
				),
			),
			'links' => array( 'Meet the clinical team' => home_url( '/#team' ) ),
		),
		'health' => array(
			'title' => 'Health and safety questions',
			'items' => array(
				array(
					'q' => 'What health information should I share before scheduling?',
					'a' => 'Tell the team about any fluid restrictions, kidney or heart conditions, medications and allergies. These details can affect which fluids or ingredients are appropriate and whether you should have an infusion at all. If your clinician has given you specific instructions, share them before your visit.',
				),
				array(
					'q' => 'What if I’m pregnant or breastfeeding?',
					'a' => 'Mention this before booking. Your nurse will review your situation, including the proposed fluids and ingredients, and may ask you to speak with your own clinician before an infusion.',
				),
				array(
					'q' => 'When should I seek emergency care instead of booking?',
					'a' => 'Call 911 for a medical emergency, including chest pain, difficulty breathing or sudden confusion. Mobile IV visits are scheduled appointments. Seek emergency care right away if you’re experiencing these symptoms.',
				),
			),
			'links' => array( 'Recognizing a medical emergency (MedlinePlus)' => 'https://medlineplus.gov/ency/article/001927.htm' ),
		),
		'events' => array(
			'title' => 'Groups and events',
			'items' => array(
				array(
					'q' => 'Can I arrange mobile IV visits for a group?',
					'a' => 'Yes. Elivation brings an on-site nursing team, chairs and supplies to gatherings such as company wellness days, golf tournaments and wedding weekends. Event plans cover groups from four to 100 or more, depending on the venue, date, staffing and time available.',
				),
				array(
					'q' => 'What should I include when I ask for an event quote?',
					'a' => 'Share the event date, venue address or city, expected guest count, and the hours when guests will be available. Tell us whether you want everyone seen during one window or at different times. The team can discuss staffing, setup and treatment options for your group.',
				),
				array(
					'q' => 'Does every guest at an event need a screening?',
					'a' => 'Yes. Each guest meets individually with a nurse for a health screening before treatment. If your event has a tight schedule, include that screening time when you discuss the setup and expected guest count with the team.',
				),
			),
			'links' => array( 'Explore group and event visits' => home_url( '/#events' ) ),
		),
	);
}
