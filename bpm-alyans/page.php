<?php
/**
 * Default page template
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span><?php the_title(); ?></div></div>

<section class="section">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <h1 class="section-title" style="font-size:38px;"><?php the_title(); ?></h1>
      <div class="about-text">
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<?php get_footer(); ?>
