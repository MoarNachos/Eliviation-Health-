<?php
/** Shared home-visit video. TODO(client): permissions, transcript claims and upload date. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
function elivation_visit_video_data() {
 return array(
  'name' => 'An Elivation nurse visiting a client at home',
  'description' => 'A home visit showing a nurse arriving, checking the client, and providing care in the living room.',
  'duration' => 'PT31S',
  'upload_date' => null, // TODO(client): actual original publication date with timezone; never infer from filename.
 );
}
function elivation_visit_video_url( $file ) { return get_theme_file_uri( 'assets/video/' . $file ); }
function elivation_visit_video( $supporting = false ) {
 $id = $supporting ? 'relief-visit-video' : 'home-visit-video';
 ob_start(); ?>
 <figure class="eh-visit-film<?php echo $supporting ? ' eh-visit-film--supporting' : ''; ?>" data-visit-film>
  <div class="eh-visit-film__frame">
   <video id="<?php echo esc_attr( $id ); ?>" width="720" height="1280" preload="none" poster="<?php echo esc_url( elivation_visit_video_url( 'home-visit-doorway.jpg' ) ); ?>" data-mobile-poster="<?php echo esc_url( elivation_visit_video_url( 'home-visit-care.jpg' ) ); ?>" playsinline muted controls aria-label="Video: an Elivation nurse visiting a client at home" aria-describedby="<?php echo esc_attr( $id ); ?>-caption">
    <source src="<?php echo esc_url( elivation_visit_video_url( 'home-visit-720.webm' ) ); ?>" type="video/webm">
    <source src="<?php echo esc_url( elivation_visit_video_url( 'home-visit-720.mp4' ) ); ?>" type="video/mp4">
    <track kind="captions" src="<?php echo esc_url( elivation_visit_video_url( 'home-visit.en.vtt' ) ); ?>" srclang="en" label="English">
    <p><a href="<?php echo esc_url( elivation_visit_video_url( 'home-visit-720.mp4' ) ); ?>">Watch the home-visit video</a> or read the transcript below.</p>
   </video>
   <button class="eh-visit-film__play" type="button" aria-label="Play home-visit video with sound" aria-controls="<?php echo esc_attr( $id ); ?>" hidden><svg viewBox="0 0 32 32" aria-hidden="true" width="32" height="32"><path fill="currentColor" d="M11 6v20l16-10z"/></svg></button>
  </div>
  <figcaption id="<?php echo esc_attr( $id ); ?>-caption">A look inside an Elivation home visit. Captions are included in the video.</figcaption>
  <p class="eh-visit-film__status" role="status" data-video-status></p>
  <details class="eh-visit-film__transcript"><summary>Read the video transcript</summary><div><?php echo wp_kses_post( file_get_contents( __DIR__ . '/../content/home-visit-transcript.html' ) ); ?></div></details>
 </figure>
 <?php return ob_get_clean();
}
add_action( 'wp_enqueue_scripts', static function () {
 if ( ! is_front_page() && 'relief' !== elivation_current_treatment() ) { return; }
 // This small stylesheet is inlined to avoid another render-blocking request.
 wp_add_inline_style( 'elivation-theme', file_get_contents(get_theme_file_path('assets/css/visit-video.css')) );
 wp_enqueue_script( 'elivation-visit-video', get_theme_file_uri( 'assets/js/visit-video.js' ), array(), filemtime(get_theme_file_path('assets/js/visit-video.js')), array('in_footer'=>true,'strategy'=>'defer') );
}, 20 );
add_action( 'wp_head', static function () {
 if ( ! is_front_page() && 'relief' !== elivation_current_treatment() ) { return; }
 $video = elivation_visit_video_data();
 $node = array('@context'=>'https://schema.org','@type'=>'VideoObject','@id'=>home_url('/#home-visit-film'),'name'=>$video['name'],'description'=>$video['description'],'thumbnailUrl'=>array(elivation_visit_video_url('home-visit-doorway.jpg'),elivation_visit_video_url('home-visit-care.jpg')),'duration'=>$video['duration'],'contentUrl'=>elivation_visit_video_url('home-visit-720.mp4'),'inLanguage'=>'en');
 // TODO(client): populate the real uploadDate before relying on video rich-result eligibility.
 if ( $video['upload_date'] ) { $node['uploadDate']=$video['upload_date']; }
 echo '<script type="application/ld+json">'.wp_json_encode($node,JSON_UNESCAPED_SLASHES|JSON_HEX_TAG).'</script>';
}, 25 );
