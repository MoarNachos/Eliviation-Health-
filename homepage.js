/* Elivation Health homepage behavior. No dependencies.
   - Mobile nav toggle
   - Scroll reveal (fade and rise, skipped for prefers-reduced-motion)
   - Photo fallback: a photo that fails to load becomes a labeled empty slot
   - Event inquiry form: validation, on-page status, optional JSON POST
   - On-page debug panel, shown when the URL has ?debug=1 */
(function () {
  'use strict';

  var doc = document;
  var root = doc.documentElement;

  /* ---------- Debug log (always collected, shown on the page with ?debug=1) ---------- */
  var debugPanel = doc.querySelector('[data-debug]');
  var debugLog = doc.querySelector('[data-debug-log]');
  var debugOn = /[?&]debug=1(&|$)/.test(window.location.search);

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

  if (debugPanel && debugOn) {
    debugPanel.hidden = false;
    var closeBtn = doc.querySelector('[data-debug-close]');
    if (closeBtn) closeBtn.addEventListener('click', function () { debugPanel.hidden = true; });
  }

  window.addEventListener('error', function (e) {
    if (e && e.message) log('error', 'Script error: ' + e.message);
  });

  /* ---------- Token and font checks ---------- */
  function checkTokens() {
    var cs = getComputedStyle(root);
    var names = ['--coral-500', '--pine-800', '--paper', '--font-display', '--space-5', '--radius-lg', '--shadow-2'];
    var missing = names.filter(function (n) { return !cs.getPropertyValue(n).trim(); });
    if (missing.length) {
      log('error', 'Design tokens missing: ' + missing.join(', ') + '. Check that styles.css and tokens/ are served next to index.html.');
    } else {
      log('ok', 'Design tokens loaded (' + names.length + ' of ' + names.length + ' sampled).');
    }
  }

  function checkFonts() {
    if (!doc.fonts || !doc.fonts.ready) { log('warn', 'Font loading API unavailable; cannot verify brand fonts.'); return; }
    doc.fonts.ready.then(function () {
      var families = ['Bricolage Grotesque', 'Instrument Serif', 'Figtree', 'DM Mono'];
      families.forEach(function (f) {
        var ok = doc.fonts.check('16px "' + f + '"');
        log(ok ? 'ok' : 'warn', 'Font ' + f + ': ' + (ok ? 'loaded' : 'not loaded, fallback in use'));
      });
    });
  }

  /* ---------- Nav toggle ---------- */
  function initNav() {
    var nav = doc.querySelector('[data-nav]');
    var toggle = doc.querySelector('[data-nav-toggle]');
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
      if (e.key === 'Escape' && nav.hasAttribute('data-open')) { setOpen(false); toggle.focus(); }
    });
  }

  /* ---------- Scroll reveal ---------- */
  function initReveal() {
    var items = doc.querySelectorAll('[data-reveal]');
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!items.length || reduce || !('IntersectionObserver' in window)) return;
    root.classList.add('eh-js');
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) { entry.target.classList.add('is-in'); io.unobserve(entry.target); }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.1 });
    items.forEach(function (el) { io.observe(el); });
  }

  /* ---------- Photos ---------- */
  function initPhotos() {
    var imgs = doc.querySelectorAll('.eh-photo img');
    var empty = doc.querySelectorAll('.eh-photo--empty').length;
    if (empty) log('warn', empty + ' photo slots are empty and waiting on real photography (assets/photos/).');

    function fail(img) {
      var fig = img.closest('.eh-photo');
      if (!fig || fig.classList.contains('eh-photo--empty')) return;
      var cap = doc.createElement('figcaption');
      cap.textContent = 'Photo unavailable: ' + (img.alt || 'image');
      img.remove();
      fig.appendChild(cap);
      fig.classList.add('eh-photo--empty');
      log('error', 'Image failed to load: ' + img.src);
    }

    imgs.forEach(function (img) {
      if (img.complete) {
        if (img.naturalWidth === 0) fail(img); else log('ok', 'Image loaded: ' + img.src.split('/').pop());
      } else {
        img.addEventListener('load', function () { log('ok', 'Image loaded: ' + img.src.split('/').pop()); });
        img.addEventListener('error', function () { fail(img); });
      }
    });
  }

  /* ---------- Event inquiry form ---------- */
  function initForm() {
    var form = doc.querySelector('[data-event-form]');
    if (!form) return;
    var status = form.querySelector('[data-form-status]');
    var button = form.querySelector('button[type="submit"]');

    function say(kind, message) {
      if (!status) return;
      status.hidden = false;
      status.setAttribute('data-kind', kind);
      status.textContent = message;
    }

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      form.setAttribute('data-submitted', '');

      if (!form.checkValidity()) {
        var firstBad = form.querySelector(':invalid');
        say('error', 'Please add your name, a valid email and an event date.');
        log('warn', 'Form blocked: invalid field "' + (firstBad && firstBad.name) + '".');
        if (firstBad && firstBad.focus) firstBad.focus();
        return;
      }

      var payload = {};
      new FormData(form).forEach(function (value, key) { payload[key] = value; });
      log('ok', 'Form payload: ' + JSON.stringify(payload));

      var endpoint = (form.getAttribute('data-endpoint') || '').trim();
      if (!endpoint) {
        say('info', 'Online requests are not connected yet. Call (949) 561-0590 and we will put a quote together.');
        log('warn', 'Form has no data-endpoint; nothing was sent.');
        return;
      }

      button.disabled = true;
      say('info', 'Sending your request.');
      fetch(endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(payload)
      }).then(function (res) {
        log(res.ok ? 'ok' : 'error', 'POST ' + endpoint + ' returned ' + res.status);
        if (!res.ok) throw new Error('HTTP ' + res.status);
        say('ok', 'Thanks. We will reply within one business day with a quote.');
        form.reset();
        form.removeAttribute('data-submitted');
      }).catch(function (err) {
        say('error', 'That did not go through. Please call (949) 561-0590 and we will take it from there.');
        log('error', 'Form submit failed: ' + err.message);
      }).then(function () {
        button.disabled = false;
      });
    });
  }

  function init() {
    log('ok', 'homepage.js started. Viewport ' + window.innerWidth + 'x' + window.innerHeight + '.');
    checkTokens();
    checkFonts();
    initNav();
    initReveal();
    initPhotos();
    initForm();
  }

  if (doc.readyState === 'loading') doc.addEventListener('DOMContentLoaded', init); else init();
})();
