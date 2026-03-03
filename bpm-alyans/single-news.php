<?php
/**
 * Single News Post Template
 */
get_header(); ?>

<div class="breadcrumbs">
  <div class="container">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span>
    <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>">Новости</a><span>&gt;</span>
    <?php the_title(); ?>
  </div>
</div>

<section class="section">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="news-card__meta" style="margin-bottom:16px;">
      <span><?php echo get_the_date( 'j F Y' ); ?></span>
      <?php
      $tags = get_the_terms( get_the_ID(), 'news_tag' );
      if ( $tags && ! is_wp_error( $tags ) ) :
          foreach ( $tags as $tag ) :
      ?>
        <span class="news-card__tag"><?php echo esc_html( $tag->name ); ?></span>
      <?php endforeach; endif; ?>
    </div>

    <h1 class="section-title" style="font-size:38px;margin-bottom:32px;"><?php the_title(); ?></h1>

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="single-news__featured">
      <?php the_post_thumbnail( 'large' ); ?>
    </div>
    <?php endif; ?>

    <div class="single-news__content">
      <?php the_content(); ?>
    </div>

    <?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
    <div class="single-news__tags">
      <?php foreach ( $tags as $tag ) : ?>
        <span class="news-card__tag"><?php echo esc_html( $tag->name ); ?></span>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php endwhile; ?>
  </div>
</section>

<?php get_footer(); ?>
