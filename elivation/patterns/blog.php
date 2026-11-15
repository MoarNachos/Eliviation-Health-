<?php
/**
 * Title: Blog archive
 * Slug: elivation/blog
 * Categories: elivation
 */
$elivation_articles = new WP_Query( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
?>
<!-- wp:html -->
<section class="eh-scope eh-section eh-journal"><div class="eh-container">
<p class="eh-eyebrow">From Elivation Health</p>
<h1 class="eh-h1">Blog</h1>
<p class="eh-journal__intro">Articles on hydration, wellness, and care in Orange County. <a href="<?php echo esc_url( home_url( '/education/' ) ); ?>">Explore our ingredient education guide →</a></p>
<div class="eh-journal__grid">
<?php while ( $elivation_articles->have_posts() ) : $elivation_articles->the_post(); ?>
<article class="eh-journal__card">
<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></time>
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), 32 ) ); ?></p>
<a class="eh-more" href="<?php the_permalink(); ?>">Read article →</a>
</article>
<?php endwhile; wp_reset_postdata(); ?>
</div></div></section>
<!-- /wp:html -->
