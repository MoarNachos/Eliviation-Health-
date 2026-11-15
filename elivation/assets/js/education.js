(function () {
 'use strict';
 var root = document.querySelector('[data-education-root]');
 if (!root) return;
 var cards = Array.from(root.querySelectorAll('[data-edu-goals]'));
 root.querySelectorAll('[data-edu-filter]').forEach(function (button) {
  button.addEventListener('click', function () {
   var goal = button.dataset.eduFilter, count = 0;
   root.querySelectorAll('[data-edu-filter]').forEach(function (b) { b.setAttribute('aria-pressed', String(b === button)); });
   cards.forEach(function (card) { card.hidden = goal !== 'All' && !JSON.parse(card.dataset.eduGoals).includes(goal); if (!card.hidden) count++; });
   root.querySelector('[data-edu-count]').textContent = count + ' ingredients' + (goal === 'All' ? '' : ' · ' + goal);
  });
 });
 var legacy = {aminoblend:'amino-blend',biotin:'biotin',glutathione:'glutathione','lipo-c-mic':'lipo-c-mic',magnesium:'magnesium',nad:'nad',taurine:'taurine',vitaminb12:'vitamin-b12','vitamin-b-complex':'b-complex','vitamin-c':'vitamin-c','vitamin-d':'vitamin-d',zinc:'zinc'};
 function forwardLegacy() {
  if (!cards.length) return;
  var hash; try { hash = decodeURIComponent(window.location.hash.slice(1)).toLowerCase(); } catch (_) { return; }
  if (legacy[hash]) window.location.replace(root.dataset.educationRoot + legacy[hash] + '/');
 }
 forwardLegacy(); window.addEventListener('hashchange', forwardLegacy);
 var drawer = root.querySelector('dialog'), opener;
 if (!drawer) return;
 var select = drawer.querySelector('select'), next = drawer.querySelector('[data-edu-continue]');
 function update() { next.href = select.selectedOptions[0].dataset.url; }
 root.querySelectorAll('[data-edu-book]').forEach(function (button) {
  button.addEventListener('click', function (event) {
   if (typeof drawer.showModal !== 'function') return;
   event.preventDefault(); opener = button; select.value = button.dataset.eduBook; update(); drawer.showModal(); select.focus();
  });
 });
 select.addEventListener('change', update);
 drawer.addEventListener('close', function () { if (opener) opener.focus(); });
 drawer.addEventListener('click', function (event) { if (event.target === drawer) { var r=drawer.getBoundingClientRect(); if(event.clientX<r.left||event.clientX>r.right||event.clientY<r.top||event.clientY>r.bottom) drawer.close(); } });
}());
