<?php
/** Ingredient guide. All medical text remains TODO(client): medical director review. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
function elivation_ingredients() {
 static $data;
 if ( null === $data ) { $data = json_decode( file_get_contents( __DIR__ . '/../content/ingredients.json' ), true ); }
 return $data;
}
function elivation_education_slug() {
 if ( ! is_page() ) { return null; }
 $path = get_page_uri( get_queried_object_id() );
 if ( 'education' === $path ) { return ''; }
 if ( 0 === strpos( $path, 'education/' ) ) {
  $slug = substr( $path, 10 );
  return isset( elivation_ingredients()[ $slug ] ) ? $slug : null;
 }
 return null;
}
function elivation_education_url( $slug = '' ) { return home_url( '/education/' . ( $slug ? $slug . '/' : '' ) ); }
/** Creates missing native pages only; retains existing published content and IDs. */
function elivation_install_education() {
 $hub = get_page_by_path( 'education' );
 if ( ! $hub ) {
  $id = wp_insert_post( array( 'post_type'=>'page', 'post_status'=>'publish', 'post_title'=>"What's in your IV: an ingredient guide", 'post_name'=>'education' ), true );
  if ( is_wp_error( $id ) ) { return; }
 } else { $id = $hub->ID; }
 foreach ( elivation_ingredients() as $slug => $entry ) {
  if ( ! get_page_by_path( 'education/' . $slug ) ) {
   $created = wp_insert_post( array( 'post_type'=>'page', 'post_status'=>'publish', 'post_parent'=>$id, 'post_title'=>$entry['name'], 'post_name'=>$slug, 'comment_status'=>'closed' ), true );
   if ( is_wp_error( $created ) ) { return; }
  }
 }
 update_option( 'elivation_education_version', '1' );
 flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'elivation_install_education' );
add_action( 'admin_init', static function () {
 if ( current_user_can( 'publish_pages' ) && '1' !== get_option( 'elivation_education_version' ) ) { elivation_install_education(); }
} );
add_filter( 'page_template_hierarchy', static function ( $templates ) {
 if ( null !== elivation_education_slug() ) { array_unshift( $templates, 'page-education.html' ); }
 return $templates;
} );
function elivation_ingredient_drips( $slug ) {
 $matches = array();
 foreach ( elivation_treatments() as $category => $group ) {
  foreach ( $group['drips'] as $drip ) {
   if ( in_array( $slug, $drip['ingredients'] ?? array(), true ) ) {
    $drip['category'] = $category;
    $matches[] = $drip;
   }
  }
 }
 return $matches;
}
function elivation_drip_ingredient_links( $drip ) {
 $ingredients = $drip['ingredients'] ?? array();
 echo '<div class="eh-ingredient-links"><h3>Ingredient guide</h3>';
 if ( $ingredients ) {
  echo '<ul>';
  foreach ( $ingredients as $slug ) { printf( '<li><a href="%s">%s</a></li>', esc_url( elivation_education_url( $slug ) ), esc_html( elivation_ingredients()[ $slug ]['name'] ) ); }
  echo '</ul><p>Listed ingredients are based on the published menu; ask for the complete formula.</p>';
 } else {
  echo '<p>Full ingredient list awaiting confirmation. <a href="' . esc_url( elivation_education_url() ) . '">Explore the ingredient guide</a> or ask your nurse.</p>';
 }
 echo '</div>';
}
function elivation_education_meta() {
 $slug = elivation_education_slug();
 if ( null === $slug ) { return null; }
 return $slug ? elivation_ingredients()[ $slug ] : array(
  'title'=>"What's in your IV: an ingredient guide | Elivation Health",
  'meta'=>'Explore 12 IV ingredients, their roles, evidence, and safety questions. Find linked drips and prepare for your Orange County visit with our ingredient guide.',
 );
}
foreach ( array( 'pre_get_document_title', 'wpseo_title', 'rank_math/frontend/title' ) as $hook ) {
 add_filter( $hook, static function ( $value ) { $meta = elivation_education_meta(); return $meta ? $meta['title'] : $value; }, 30 );
}
foreach ( array( 'wpseo_metadesc', 'rank_math/frontend/description' ) as $hook ) {
 add_filter( $hook, static function ( $value ) { $meta = elivation_education_meta(); return $meta ? $meta['meta'] : $value; }, 30 );
}
add_action( 'wp_head', static function () {
 $meta = elivation_education_meta();
 if ( ! $meta ) { return; }
 if ( ! defined( 'WPSEO_VERSION' ) && ! defined( 'RANK_MATH_VERSION' ) ) { echo '<meta name="description" content="' . esc_attr( $meta['meta'] ) . '">' . "\n"; }
 $slug = elivation_education_slug(); $url = elivation_education_url( $slug );
 $crumbs = array( array('@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>home_url('/')), array('@type'=>'ListItem','position'=>2,'name'=>'Education','item'=>elivation_education_url()) );
 $page = array('@type'=>$slug ? 'MedicalWebPage' : 'CollectionPage','@id'=>$url.'#webpage','url'=>$url,'name'=>$meta['title'],'description'=>$meta['meta'],'dateModified'=>'2026-11-15','inLanguage'=>'en-US');
 $graph = array();
 if ( $slug ) {
  $entry = elivation_ingredients()[ $slug ];
  $page['about'] = array('@type'=>'Substance','name'=>$entry['name'],'alternateName'=>$entry['aka']);
  // TODO(client): fill these fields only after a real medical review. Never invent a reviewer or date.
  if ( $entry['reviewer'] && $entry['last_reviewed'] ) { $page['reviewedBy']=array('@type'=>'Person','name'=>$entry['reviewer']); $page['lastReviewed']=$entry['last_reviewed']; }
  $crumbs[] = array('@type'=>'ListItem','position'=>3,'name'=>$entry['name'],'item'=>$url);
  $graph[] = array('@type'=>'FAQPage','@id'=>$url.'#faq','mainEntity'=>array_map(static function($faq){return array('@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>array('@type'=>'Answer','text'=>$faq['a']));},$entry['faq']));
 } else {
  $page['hasPart'] = array();
  foreach ( elivation_ingredients() as $key=>$entry ) { $page['hasPart'][]=array('@type'=>'MedicalWebPage','url'=>elivation_education_url($key),'name'=>$entry['name']); }
 }
 $graph[]=$page; $graph[]=array('@type'=>'BreadcrumbList','@id'=>$url.'#breadcrumbs','itemListElement'=>$crumbs);
 echo '<script type="application/ld+json">'.wp_json_encode(array('@context'=>'https://schema.org','@graph'=>$graph),JSON_UNESCAPED_SLASHES|JSON_HEX_TAG|JSON_HEX_AMP).'</script>';
}, 25 );
add_action( 'wp_enqueue_scripts', static function () {
 if ( null === elivation_education_slug() && ! elivation_current_treatment() ) { return; }
 wp_enqueue_style('elivation-education',get_theme_file_uri('assets/css/education.css'),array('elivation-theme'),filemtime(get_theme_file_path('assets/css/education.css')));
 if ( null !== elivation_education_slug() ) {
  wp_enqueue_script('elivation-education',get_theme_file_uri('assets/js/education.js'),array(),filemtime(get_theme_file_path('assets/js/education.js')),array('in_footer'=>true,'strategy'=>'defer'));
 }
} );
function elivation_education_review_line() {
 $slug = elivation_education_slug();
 $entry = $slug ? elivation_ingredients()[ $slug ] : null;
 if ( $entry && $entry['reviewer'] && $entry['last_reviewed'] ) {
  echo '<p class="eh-edu-review">Reviewed by ' . esc_html( $entry['reviewer'] ) . ' · Reviewed ' . esc_html( $entry['last_reviewed'] ) . ' · Updated ' . esc_html( $entry['updated'] ) . '</p>';
  return;
 }
 echo '<p class="eh-edu-review">Medical review pending — <span>TODO(client): medical director</span> · Updated <time datetime="2026-11-15">November 15, 2026</time></p>';
}
function elivation_education_claim( $text, $id ) {
 return '<span data-medical-review="TODO(client)" data-claim-id="'.esc_attr($id).'">'.esc_html($text).'</span>';
}
function elivation_education_booking_card( $drip ) {
 $category=elivation_treatment($drip['category']);
 echo '<article class="eh-edu-drip"><h3>'.esc_html($drip['name']).'</h3><p class="eh-edu-price">'.esc_html(elivation_price($drip['price'])).' <span>· '.esc_html($drip['dur']).'</span></p><p><a href="'.esc_url(elivation_treatment_url($drip['category']).'#'.($drip['anchor']??'drip-'.$drip['id'])).'">View '.esc_html($category['name']).' drip details</a></p>';
 printf('<a class="eh-btn eh-btn--primary" href="%s" data-edu-book="%s">Book %s</a>',esc_url(add_query_arg('drip',$drip['id'],ELIVATION_BOOKING_URL)),esc_attr($drip['id']),esc_html($drip['name']));
 echo '</article>';
}
add_shortcode( 'elivation_education', static function () {
 $slug=elivation_education_slug(); if(null===$slug){return '';}
 ob_start();
 echo '<div class="eh-scope eh-edu" data-education-root="'.esc_url(elivation_education_url()).'">';
 echo '<nav aria-label="Breadcrumb" class="eh-edu-crumb"><a href="'.esc_url(home_url('/')).'">Home</a> <span aria-hidden="true">/</span> ';
 echo $slug ? '<a href="'.esc_url(elivation_education_url()).'">Education</a> <span aria-hidden="true">/</span> <span aria-current="page">'.esc_html(elivation_ingredients()[$slug]['name']).'</span>' : '<span aria-current="page">Education</span>';
 echo '</nav>';
 if(!$slug){
  echo '<header class="eh-edu-intro"><p class="eh-eyebrow">Know your ingredients</p><h1>What\'s in your IV: an ingredient guide</h1><p>Learn what the ingredients in an IV do in your body, what the evidence says, and which Elivation drips contain them. Use this guide to prepare questions for your nurse before an IV visit in Orange County.</p>';
  elivation_education_review_line(); echo '</header><section aria-labelledby="ingredient-heading"><h2 id="ingredient-heading">Explore the ingredients</h2><p>Browse by interest. These topics describe nutrient roles, not promised results from an IV.</p><div class="eh-edu-filters" role="group" aria-label="Filter ingredients by goal">';
  foreach(array('All','Energy','Recovery','Immune support','Skin & hair','Hydration') as $goal){printf('<button type="button" data-edu-filter="%s" aria-pressed="%s">%s</button>',esc_attr($goal),'All'===$goal?'true':'false',esc_html($goal));}
  echo '</div><p class="eh-edu-count" role="status" aria-live="polite" data-edu-count>12 ingredients</p><div class="eh-edu-grid">';
  foreach(elivation_ingredients() as $key=>$entry){
   $drips=elivation_ingredient_drips($key);
   echo '<article class="eh-edu-card" data-edu-goals="'.esc_attr(wp_json_encode($entry['goals'])).'"><h3><a href="'.esc_url(elivation_education_url($key)).'">'.esc_html($entry['name']).'</a></h3><p class="eh-edu-aka">'.esc_html($entry['aka']).'</p><p>'.elivation_education_claim($entry['card'],$key.'-card').'</p><p class="eh-edu-found">Found in <span>'.esc_html($drips?$drips[0]['name']:'Ask your nurse').'</span></p><a class="eh-more" href="'.esc_url(elivation_education_url($key)).'">Explore '.esc_html($entry['name']).' →</a></article>';
  }
  echo '</div></section><details class="eh-edu-legacy"><summary>Looking for an old ingredient link?</summary><ul>';
  $legacy=array('aminoblend','biotin','glutathione','lipo-c-mic','magnesium','nad','taurine','vitaminB12','Vitamin-B-Complex','Vitamin-C','Vitamin-D','Zinc');
  foreach(array_keys(elivation_ingredients()) as $i=>$key){echo '<li id="'.esc_attr($legacy[$i]).'"><a href="'.esc_url(elivation_education_url($key)).'">'.esc_html(elivation_ingredients()[$key]['name']).' guide</a></li>';}
  echo '</ul></details>';
 }else{
  $e=elivation_ingredients()[$slug]; $drips=elivation_ingredient_drips($slug);
  echo '<div class="eh-edu-layout"><div class="eh-edu-reading"><header><p class="eh-eyebrow">Ingredient guide</p><h1>'.esc_html($e['name']).'</h1><p class="eh-edu-aka">Also known as: '.esc_html($e['aka']).'</p>'; elivation_education_review_line(); echo '</header>';
  echo '<section class="eh-edu-short" aria-labelledby="in-short"><h2 id="in-short">In short</h2><p>'.elivation_education_claim($e['short'],$slug.'-short').'</p></section>';
  echo '<section><h2>What it does in your body</h2><ul>';
  foreach($e['body'] as $i=>$point){echo '<li>'.elivation_education_claim($point,$slug.'-body-'.($i+1)).'</li>';}
  echo '</ul></section><section><h2>Why people choose it</h2><p>'.elivation_education_claim($e['why'],$slug.'-why').'</p></section>';
  echo '<section id="found-in"><h2>Found in these drips</h2>';
  if($drips){foreach($drips as $drip){elivation_education_booking_card($drip);} echo '<p class="eh-edu-note">Confirm the current formula, price, and visit length with your nurse before booking.</p>';}
  else{echo '<p>A matching drip has not been verified from the published menu. Ask the team to confirm the current ingredients, dose, and route before booking.</p><a class="eh-btn eh-btn--ghost" href="tel:'.esc_attr(ELIVATION_PHONE_TEL).'">Ask a nurse about '.esc_html($e['name']).'</a>';}
  echo '</section><section><h2>Is it right for you?</h2><p>'.elivation_education_claim($e['safety'],$slug.'-safety').'</p><p class="eh-edu-note">TODO(client): medical director approval of these precautions and the nurse screening protocol.</p></section><section id="faq"><h2>Frequently asked questions</h2>';
  foreach($e['faq'] as $i=>$faq){echo '<details class="eh-edu-faq"><summary>'.esc_html($faq['q']).'</summary><p>'.elivation_education_claim($faq['a'],$slug.'-faq-'.($i+1)).'</p></details>';}
  echo '</section><section class="eh-edu-sources"><h2>Sources</h2><p>These sources explain nutrient roles and evidence. Research on oral products does not establish benefits from IV delivery.</p><ul>';
  foreach($e['sources'] as $source){echo '<li><a href="'.esc_url($source['url']).'">'.esc_html($source['label']).'</a></li>';}
  echo '</ul></section><section><h2>Keep exploring</h2><ul>';
  foreach($e['related'] as $related){echo '<li><a href="'.esc_url(elivation_education_url($related)).'">'.esc_html(elivation_ingredients()[$related]['name']).'</a></li>';}
  foreach(array_unique(array_column($drips,'category')) as $category){echo '<li><a href="'.esc_url(elivation_treatment_url($category)).'">'.esc_html(elivation_treatment($category)['name']).' treatments</a></li>';}
  if(!$drips){echo '<li><a href="'.esc_url(home_url('/#treatments')).'">Explore treatment categories</a></li>';}
  echo '</ul></section></div><aside class="eh-edu-sidebar" aria-label="Ingredient booking"><div class="eh-edu-sticky"><h2>Found in</h2>';
  if($drips){foreach($drips as $drip){elivation_education_booking_card($drip);}}
  else{echo '<p>Formula confirmation needed</p><p>Ask your nurse which options contain '.esc_html($e['name']).'.</p><a class="eh-btn eh-btn--primary" href="tel:'.esc_attr(ELIVATION_PHONE_TEL).'">Call the team</a>';}
  echo '<p class="eh-edu-note">A screening comes before any infusion.</p></div></aside></div>';
  echo '<div class="eh-edu-bookbar" aria-label="Booking options"><a href="tel:'.esc_attr(ELIVATION_PHONE_TEL).'">Call a nurse</a>';
  if($drips){printf('<a class="eh-btn eh-btn--primary" href="%s" data-edu-book="%s">Book %s</a>',esc_url(add_query_arg('drip',$drips[0]['id'],ELIVATION_BOOKING_URL)),esc_attr($drips[0]['id']),esc_html($drips[0]['name']));}
  else{echo '<a class="eh-btn eh-btn--primary" href="'.esc_url(ELIVATION_BOOKING_URL).'">View booking options</a>';}
  echo '</div>';
  if($drips){
   echo '<dialog class="eh-edu-dialog" aria-labelledby="edu-book-title"><form method="dialog"><button class="eh-edu-close" aria-label="Close booking drawer">Close ×</button></form><h2 id="edu-book-title">Your selected drip</h2><label for="edu-drip">Choose a drip</label><select id="edu-drip">';
   foreach($drips as $drip){printf('<option value="%s" data-url="%s">%s · %s · %s</option>',esc_attr($drip['id']),esc_url(add_query_arg('drip',$drip['id'],ELIVATION_BOOKING_URL)),esc_html($drip['name']),esc_html(elivation_price($drip['price'])),esc_html($drip['dur']));}
   echo '</select><p>Continue to the booking site to check availability and complete your booking. Confirm your drip selection there; opening this drawer does not reserve a visit.</p><a class="eh-btn eh-btn--primary" data-edu-continue href="'.esc_url(add_query_arg('drip',$drips[0]['id'],ELIVATION_BOOKING_URL)).'">Continue to booking</a><p class="eh-edu-note">Your nurse reviews suitability before treatment.</p></dialog>';
  }
 }
 echo '</div>'; return ob_get_clean();
} );
/** A theme-owned root resource; no server configuration or production files overwritten. */
function elivation_llms_text() {
 $text="# Elivation Health\n\n> Ingredient education and physician-directed mobile IV visits in Orange County. Medical review of the ingredient guide is pending.\n\n## Education\n\n- [Ingredient guide](".elivation_education_url()."): Nutrient roles, evidence limits, and questions for your nurse.\n";
 foreach(elivation_ingredients() as $slug=>$e){$text.='- ['.$e['name'].']('.elivation_education_url($slug).'): '.$e['card']."\n";}
 $text.="\n## Treatments\n\n";
 foreach(elivation_treatments() as $key=>$group){$text.='- ['.$group['name'].']('.elivation_treatment_url($key).'): Compare '.$group['name']." drips, listed prices, and visit lengths.\n";}
 return $text;
}
add_action('template_redirect',static function(){
 $request=wp_parse_url($_SERVER['REQUEST_URI']??'',PHP_URL_PATH);
 if($request===wp_parse_url(home_url('/llms.txt'),PHP_URL_PATH)){
  status_header(200); header('Content-Type: text/plain; charset=utf-8'); echo elivation_llms_text(); exit;
 }
},1);
