<?php
/**
 * News Archive Template
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span>Новости</div></div>

<section class="section">
  <div class="container">
    <h1 class="section-title" style="font-size:38px;margin-bottom:48px;">Новости</h1>
    <div class="news-grid">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="news-card">
          <div class="news-card__img">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'medium_large' ); ?>
            <?php endif; ?>
          </div>
          <div class="news-card__body">
            <div class="news-card__meta">
              <span><?php echo get_the_date( 'j F Y' ); ?></span>
              <?php
              $tags = get_the_terms( get_the_ID(), 'news_tag' );
              if ( $tags && ! is_wp_error( $tags ) ) :
                  foreach ( $tags as $tag ) :
              ?>
                <span class="news-card__tag"><?php echo esc_html( $tag->name ); ?></span>
              <?php endforeach; endif; ?>
            </div>
            <h3 class="news-card__title"><?php the_title(); ?></h3>
            <p class="news-card__text"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
            <a href="<?php the_permalink(); ?>" class="news-card__link">Читать далее &rarr;</a>
          </div>
        </div>
        <?php endwhile; ?>
      <?php else : ?>
        <p>Новостей пока нет.</p>
      <?php endif; ?>
    </div>

    <?php
    // Pagination
    $pagination = paginate_links( array(
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'type'      => 'array',
    ) );
    if ( $pagination ) : ?>
    <div class="pagination">
      <?php foreach ( $pagination as $link ) : ?>
        <?php echo $link; ?>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
