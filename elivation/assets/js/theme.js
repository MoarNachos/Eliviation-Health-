/* Elivation theme behavior. No dependencies.
   - Mobile menu toggle
   - Scroll reveal (fade and rise; skipped for prefers-reduced-motion)
   - Photo fallback: a photo that fails to load becomes a labeled empty block
   - ZIP card: checks for 5 digits, then goes to the booking site
   - Event form: checks required fields. NOT CONNECTED to email or a CRM yet.
   - Treatment pages: booking drawer (drip, ZIP, date and time, details) that
     hands off to the booking site
   - On-page debug panel when the URL has ?debug=1 */
(function () {
	'use strict';

	var doc = document;
	var root = doc.documentElement;
	var data = window.elivationData || {};
	var bookingUrl = data.bookingUrl || 'https://book.elivationhealth.com/';
	var phone = data.phone || '(949) 561-0590';
	var serviceZips = Array.isArray(data.serviceZips) ? data.serviceZips : [];

	/* ---------- Debug log (collected always, shown on the page with ?debug=1) ---------- */
	var debugOn = /[?&]debug=1(&|$)/.test(window.location.search);
	var debugLog = null;

	function buildDebugPanel() {
		var panel = doc.createElement('aside');
		panel.className = 'eh-debug';
		panel.setAttribute('aria-label', 'Debug output');

		var head = doc.createElement('div');
		head.className = 'eh-debug__head';
		var title = doc.createElement('strong');
		title.textContent = 'Debug';
		var close = doc.createElement('button');
		close.type = 'button';
		close.className = 'eh-debug__close';
		close.textContent = 'Hide';
		close.addEventListener('click', function () { panel.remove(); });
		head.appendChild(title);
		head.appendChild(close);

		debugLog = doc.createElement('ol');
		debugLog.className = 'eh-debug__log';

		panel.appendChild(head);
		panel.appendChild(debugLog);
		doc.body.appendChild(panel);
	}

	function log(level, message) {
		if (!debugLog) return;
		var li = doc.createElement('li');
		li.setAttribute('data-level', level);
		var t = new Date();
		var stamp = [t.getHours(), t.getMinutes(), t.getSeconds()].map(function (n) {
			return String(n).padStart(2, '0');
		}).join(':');
		li.textContent = stamp + '  ' + message;
		debugLog.appendChild(li);
		debugLog.scrollTop = debugLog.scrollHeight;
	}

	window.addEventListener('error', function (e) {
		if (e && e.message) log('error', 'Script error: ' + e.message);
	});

	/* ---------- Checks shown in the debug panel ---------- */
	function checkTokens() {
		var cs = getComputedStyle(root);
		var names = ['--coral-500', '--pine-800', '--paper', '--surface-page', '--action-primary', '--font-display', '--shadow-2'];
		var missing = names.filter(function (n) { return !cs.getPropertyValue(n).trim(); });
		if (missing.length) {
			log('error', 'Design tokens missing: ' + missing.join(', ') + '. Is assets/css/tokens.css loading?');
		} else {
			log('ok', 'Design tokens loaded (' + names.length + ' of ' + names.length + ' sampled).');
		}
	}

	function checkFonts() {
		if (!doc.fonts || !doc.fonts.ready) {
			log('warn', 'Font loading API unavailable; cannot verify brand fonts.');
			return;
		}
		doc.fonts.ready.then(function () {
			['Bricolage Grotesque', 'Instrument Serif', 'Figtree', 'DM Mono'].forEach(function (f) {
				var ok = doc.fonts.check('16px "' + f + '"');
				log(ok ? 'ok' : 'warn', 'Font ' + f + ': ' + (ok ? 'loaded' : 'not loaded, fallback in use'));
			});
		});
	}

	function checkStructure() {
		var h1 = doc.querySelectorAll('h1').length;
		log(h1 === 1 ? 'ok' : 'warn', 'H1 count: ' + h1 + ' (should be 1).');
		var noAlt = doc.querySelectorAll('main img:not([alt]), main img[alt=""]').length;
		log(noAlt ? 'warn' : 'ok', 'Images without alt text: ' + noAlt + '.');
		var ld = doc.querySelector('script[type="application/ld+json"]');
		log(ld ? 'ok' : 'warn', 'JSON-LD: ' + (ld ? 'present' : 'not found') + '.');
		log('warn', 'Event form is not connected to email or a CRM yet.');
		log(serviceZips.length ? 'ok' : 'warn', 'Covered ZIP list: ' + (serviceZips.length ? serviceZips.length + ' codes' : 'empty, out-of-area message is off') + '.');
	}

	/* ---------- Mobile menu ---------- */
	function initNav() {
		var nav = doc.querySelector('[data-eh-nav]');
		var toggle = doc.querySelector('[data-eh-nav-toggle]');
		if (!nav || !toggle) return;

		function setOpen(open) {
			if (open) nav.setAttribute('data-open', ''); else nav.removeAttribute('data-open');
			toggle.setAttribute('aria-expanded', String(open));
			toggle.textContent = open ? 'Close' : 'Menu';
		}

		toggle.addEventListener('click', function () { setOpen(!nav.hasAttribute('data-open')); });
		nav.addEventListener('click', function (e) {
			if (e.target.closest && e.target.closest('.eh-nav__links a')) setOpen(false);
		});
		doc.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && nav.hasAttribute('data-open')) {
				setOpen(false);
				toggle.focus();
			}
		});
	}

	/* ---------- Scroll reveal ---------- */
	function initReveal() {
		var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		if (reduce || !('IntersectionObserver' in window)) return;
		var items = doc.querySelectorAll('.eh-step, .eh-card, .eh-person, .eh-review, .eh-faq__item');
		if (!items.length) return;
		items.forEach(function (el) { el.setAttribute('data-eh-reveal', ''); });
		root.classList.add('eh-js');
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-in');
					io.unobserve(entry.target);
				}
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.1 });
		items.forEach(function (el) { io.observe(el); });
	}

	/* ---------- Photos ---------- */
	function initPhotos() {
		var imgs = doc.querySelectorAll('.eh-scope figure img');
		var loaded = 0;

		function fail(img) {
			var fig = img.closest('figure');
			if (!fig || fig.classList.contains('eh-photo-missing')) return;
			fig.setAttribute('data-eh-missing', 'Photo unavailable: ' + (img.alt || 'image'));
			fig.classList.add('eh-photo-missing');
			log('error', 'Image failed to load: ' + (img.currentSrc || img.src));
			img.remove();
		}

		imgs.forEach(function (img) {
			if (img.complete && img.naturalWidth === 0 && img.getAttribute('loading') !== 'lazy') {
				fail(img);
			} else {
				img.addEventListener('load', function () { loaded += 1; });
				img.addEventListener('error', function () { fail(img); });
			}
		});
		log('ok', 'Photos on page: ' + imgs.length + '.');
	}

	/* ---------- ZIP booking card ---------- */
	function initZip() {
		var form = doc.querySelector('[data-eh-zip]');
		if (!form) return;
		var input = form.querySelector('input[name="zip"]');
		var msg = form.querySelector('[data-eh-zip-msg]');

		function say(text) {
			if (!msg) return;
			msg.hidden = !text;
			msg.textContent = text || '';
			if (text) input.setAttribute('aria-invalid', 'true'); else input.removeAttribute('aria-invalid');
		}

		input.addEventListener('input', function () {
			input.value = input.value.replace(/\D/g, '').slice(0, 5);
			say('');
		});

		form.addEventListener('submit', function (e) {
			var zip = input.value.trim();
			if (zip === '') {
				// No ZIP entered: go straight to booking.
				e.preventDefault();
				log('ok', 'ZIP empty, going to booking.');
				window.location.href = bookingUrl;
				return;
			}
			if (!/^\d{5}$/.test(zip)) {
				e.preventDefault();
				say('Please enter a 5-digit ZIP code.');
				log('warn', 'ZIP rejected: "' + zip + '" is not 5 digits.');
				input.focus();
				return;
			}
			if (serviceZips.length && serviceZips.indexOf(zip) === -1) {
				e.preventDefault();
				say('We may not cover that ZIP yet. Call us at ' + phone + ' and we\'ll check.');
				log('warn', 'ZIP ' + zip + ' is not in the covered list.');
				return;
			}
			// Valid: the form submits by GET to the booking site with ?zip=.
			log('ok', 'ZIP ' + zip + ' accepted, handing off to booking.');
		});
	}

	/* ---------- Event inquiry form (not connected yet) ---------- */
	function initEventForm() {
		var form = doc.querySelector('[data-eh-event-form]');
		if (!form) return;
		var status = form.querySelector('[data-eh-form-status]');

		function say(kind, text) {
			if (!status) return;
			status.hidden = false;
			status.setAttribute('data-kind', kind);
			status.textContent = text;
		}

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			form.setAttribute('data-submitted', '');

			if (!form.checkValidity()) {
				var firstBad = form.querySelector(':invalid');
				say('error', 'Please add your name, a valid email and an event date.');
				log('warn', 'Event form blocked: invalid field "' + (firstBad && firstBad.name) + '".');
				if (firstBad && firstBad.focus) firstBad.focus();
				return;
			}

			var payload = {};
			new FormData(form).forEach(function (value, key) { payload[key] = value; });
			log('ok', 'Event form payload (not sent): ' + JSON.stringify(payload));

			// TODO(build): send the payload to the client's email or CRM, then show
			// "Thanks — we'll reply within one business day." (wording to be verified).
			say('info', 'Online requests are not connected yet. Call ' + phone + ' and we\'ll put a quote together.');
		});
	}

	/* ---------- Treatment booking drawer ---------- */
	function initBooking() {
		var drawer = doc.querySelector('[data-eh-drawer]');
		if (!drawer) return;
		var panel = drawer.querySelector('.eh-drawer__panel');
		var form = drawer.querySelector('[data-eh-booking-form]');
		var steps = Array.prototype.slice.call(form.querySelectorAll('.eh-drawer__step'));
		var titleEl = drawer.querySelector('[data-eh-drawer-title]');
		var progressEl = drawer.querySelector('[data-eh-drawer-progress]');
		var backBtn = drawer.querySelector('[data-eh-drawer-back]');
		var nextBtn = drawer.querySelector('[data-eh-drawer-next]');
		var status = drawer.querySelector('[data-eh-booking-status]');
		var summary = drawer.querySelector('[data-eh-summary]');
		var dateInput = form.querySelector('[data-eh-date]');
		var current = 0;
		var opener = null;

		function isoDate(d) {
			return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
		}
		var today = isoDate(new Date());
		if (dateInput) dateInput.min = today;

		function say(text) {
			status.hidden = !text;
			status.textContent = text || '';
			if (text) status.setAttribute('data-kind', 'error');
		}

		function field(name) { return form.elements[name]; }
		function checked(name) { return form.querySelector('input[name="' + name + '"]:checked'); }

		function show(i) {
			current = i;
			steps.forEach(function (step, n) { step.hidden = n !== i; });
			titleEl.textContent = steps[i].getAttribute('data-title');
			progressEl.textContent = 'Step ' + (i + 1) + ' of ' + steps.length;
			backBtn.hidden = i === 0;
			nextBtn.textContent = i === steps.length - 1 ? 'Confirm and book' : 'Continue';
			if (i === steps.length - 1) renderSummary();
			say('');
			var first = steps[i].querySelector('input:checked, input:not([type="radio"])') || steps[i].querySelector('input');
			if (first && !drawer.hidden) first.focus({ preventScroll: true });
		}

		function validate(i) {
			if (i === 0) {
				return checked('drip') ? '' : 'Choose a drip to continue.';
			}
			if (i === 1) {
				var zip = field('zip').value.trim();
				if (!/^\d{5}$/.test(zip)) return 'Please enter a 5-digit ZIP code.';
				if (serviceZips.length && serviceZips.indexOf(zip) === -1) {
					return 'We may not cover that ZIP yet. Call us at ' + phone + ' and we\'ll check.';
				}
				return '';
			}
			if (i === 2) {
				var date = dateInput.value;
				if (!date) return 'Pick a date.';
				if (date < today) return 'Pick today or a later date.';
				return checked('time') ? '' : 'Pick a preferred time.';
			}
			if (!field('name').value.trim()) return 'Please add your name.';
			if (field('phone').value.replace(/\D/g, '').length < 10) return 'Please add a mobile number we can text.';
			return '';
		}

		function renderSummary() {
			var drip = checked('drip');
			var time = checked('time');
			var dateText = dateInput.value;
			if (dateText) {
				var parts = dateText.split('-');
				dateText = new Date(+parts[0], parts[1] - 1, +parts[2]).toLocaleDateString(undefined, { weekday: 'long', month: 'long', day: 'numeric' });
			}
			var rows = [
				['Drip', drip ? drip.getAttribute('data-name') + ' · ' + drip.getAttribute('data-price') + ' · ' + drip.getAttribute('data-dur') : ''],
				['ZIP', field('zip').value],
				['When', dateText + (time ? ', ' + time.parentNode.textContent.trim() : '')]
			];
			summary.textContent = '';
			rows.forEach(function (row) {
				var dt = doc.createElement('dt');
				dt.textContent = row[0];
				var dd = doc.createElement('dd');
				dd.textContent = row[1];
				summary.appendChild(dt);
				summary.appendChild(dd);
			});
		}

		function open(dripId, trigger) {
			opener = trigger || null;
			var preselected = false;
			if (dripId) {
				var radio = form.querySelector('input[name="drip"][value="' + dripId + '"]');
				if (radio) { radio.checked = true; preselected = true; }
			}
			drawer.hidden = false;
			root.classList.add('eh-drawer-open');
			// Coming from a drip card: the drip is chosen, start at the ZIP step.
			show(preselected ? 1 : 0);
			if (!preselected) panel.focus({ preventScroll: true });
			log('ok', 'Booking drawer opened' + (dripId ? ' with drip "' + dripId + '"' : '') + '.');
		}

		function close() {
			drawer.hidden = true;
			root.classList.remove('eh-drawer-open');
			if (opener && opener.focus) opener.focus();
		}

		function handOff() {
			var url = new URL(bookingUrl);
			// TODO(client): confirm the booking platform reads these parameters.
			url.searchParams.set('drip', checked('drip').value);
			url.searchParams.set('zip', field('zip').value.trim());
			url.searchParams.set('date', dateInput.value);
			url.searchParams.set('time', checked('time').value);
			url.searchParams.set('category', form.getAttribute('data-category') || '');
			// TODO(build): name and phone are deliberately not put in the URL. Send them
			// to the CRM or booking API once one is chosen.
			log('ok', 'Booking hand-off: ' + url.toString());
			if (debugOn) {
				say('Debug mode: would go to ' + url.toString());
				status.setAttribute('data-kind', 'info');
				return;
			}
			window.location.href = url.toString();
		}

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			var problem = validate(current);
			if (problem) {
				say(problem);
				log('warn', 'Booking step ' + (current + 1) + ' blocked: ' + problem);
				return;
			}
			if (current < steps.length - 1) show(current + 1); else handOff();
		});

		field('zip').addEventListener('input', function () {
			this.value = this.value.replace(/\D/g, '').slice(0, 5);
		});

		backBtn.addEventListener('click', function () { if (current > 0) show(current - 1); });

		drawer.addEventListener('click', function (e) {
			if (e.target.closest('[data-eh-drawer-close]')) close();
		});

		drawer.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') { close(); return; }
			if (e.key !== 'Tab') return;
			var focusable = Array.prototype.filter.call(
				panel.querySelectorAll('button, input, select, textarea, a[href]'),
				function (el) { return !el.disabled && el.offsetParent !== null; }
			);
			if (!focusable.length) return;
			var first = focusable[0];
			var last = focusable[focusable.length - 1];
			if (e.shiftKey && doc.activeElement === first) { e.preventDefault(); last.focus(); }
			else if (!e.shiftKey && doc.activeElement === last) { e.preventDefault(); first.focus(); }
		});

		// Every Book button on the page opens the drawer, including the header one.
		doc.addEventListener('click', function (e) {
			var trigger = e.target.closest && e.target.closest('[data-eh-book], .eh-nav__book');
			if (!trigger) return;
			e.preventDefault();
			open(trigger.getAttribute('data-eh-book'), trigger);
		});

		log('ok', 'Booking drawer ready (' + form.querySelectorAll('input[name="drip"]').length + ' drips).');
	}

	function init() {
		if (debugOn) buildDebugPanel();
		log('ok', 'theme.js started. Viewport ' + window.innerWidth + 'x' + window.innerHeight + '.');
		checkTokens();
		checkFonts();
		checkStructure();
		initNav();
		initReveal();
		initPhotos();
		initZip();
		initEventForm();
		initBooking();
	}

	if (doc.readyState === 'loading') doc.addEventListener('DOMContentLoaded', init); else init();
})();
