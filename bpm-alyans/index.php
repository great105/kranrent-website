<?php
/**
 * Fallback template
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a></div></div>

<section class="section">
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article>
          <h2><?php the_title(); ?></h2>
          <div><?php the_content(); ?></div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p>Записей не найдено.</p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
