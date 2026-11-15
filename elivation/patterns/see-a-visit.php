<?php
/**
 * Title: See a visit
 * Slug: elivation/see-a-visit
 * Categories: elivation
 * Description: A captioned home visit with a transcript and booking links.
 * @package elivation
 */
?>
<!-- wp:html -->
<section id="see-a-visit" class="eh-scope eh-section eh-see-visit" aria-labelledby="see-a-visit-heading">
 <div class="eh-container eh-see-visit__layout">
  <?php echo elivation_visit_video(); ?>
  <div class="eh-see-visit__copy">
   <p class="eh-eyebrow">SEE A VISIT</p>
   <h2 id="see-a-visit-heading" class="eh-h2">What a visit <em>actually</em> looks like.</h2>
   <ol class="eh-see-visit__steps">
    <li><span aria-hidden="true">01</span> Your nurse arrives</li>
    <li><span aria-hidden="true">02</span> Vitals and a quick health screen</li>
    <li><span aria-hidden="true">03</span> Relax while your drip runs</li>
   </ol>
   <div class="eh-actions">
    <a class="eh-btn eh-btn--primary" href="<?php echo esc_url( ELIVATION_BOOKING_URL ); ?>" data-eh-book>Book a visit</a>
    <a class="eh-btn eh-btn--ghost" href="tel:+19495610590">Call (949) 561-0590</a>
   </div>
  </div>
 </div>
</section>
<!-- /wp:html -->
