<?php
/**
 * Template Part: Crane Detail Section
 *
 * Expects: current post in the loop (post_type = crane)
 * Optional $args['index'] for alternating gray/white sections
 */
$crane_capacity     = get_post_meta( get_the_ID(), 'crane_capacity', true );
$crane_boom         = get_post_meta( get_the_ID(), 'crane_boom', true );
$crane_height       = get_post_meta( get_the_ID(), 'crane_height', true );
$crane_manufacturer = get_post_meta( get_the_ID(), 'crane_manufacturer', true );
$crane_description  = get_post_meta( get_the_ID(), 'crane_description', true );
$crane_price        = get_post_meta( get_the_ID(), 'crane_price', true );
$crane_pdf          = get_post_meta( get_the_ID(), 'crane_pdf', true );
$crane_scheme_1     = get_post_meta( get_the_ID(), 'crane_scheme_1', true );
$crane_scheme_2     = get_post_meta( get_the_ID(), 'crane_scheme_2', true );
$crane_is_new       = get_post_meta( get_the_ID(), 'crane_is_new', true );
$crane_anchor       = get_post_meta( get_the_ID(), 'crane_anchor', true );

// Skip detail if no description and no schemes
if ( ! $crane_description && ! $crane_scheme_1 && ! $crane_scheme_2 ) {
    return;
}

$index = isset( $args['index'] ) ? (int) $args['index'] : 0;
$section_class = ( $index % 2 === 0 ) ? 'section section--gray' : 'section';
$detail_id = $crane_anchor ? 'detail-' . $crane_anchor : 'detail-' . get_the_ID();
?>
<section class="<?php echo esc_attr( $section_class ); ?>" id="<?php echo esc_attr( $detail_id ); ?>">
  <div class="container">
    <h2 class="section-title">
      <?php if ( $crane_is_new === '1' ) : ?><span class="crane-card__badge">Новый</span> <?php endif; ?>
      <?php the_title(); ?><?php if ( $crane_capacity ) echo ' — ' . esc_html( $crane_capacity ); ?>
    </h2>
    <?php if ( $crane_manufacturer ) : ?>
      <p class="section-subtitle"><?php echo esc_html( $crane_manufacturer ); ?></p>
    <?php endif; ?>

    <div class="crane-detail">
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="crane-detail__photo">
          <?php the_post_thumbnail( 'medium_large', array( 'alt' => get_the_title() ) ); ?>
        </div>
      <?php endif; ?>

      <div class="crane-detail__info">
        <div class="crane-detail__specs-list">
          <?php if ( $crane_capacity ) : ?>
            <div class="crane-detail__spec"><strong>Грузоподъёмность:</strong> <?php echo esc_html( $crane_capacity ); ?></div>
          <?php endif; ?>
          <?php if ( $crane_boom ) : ?>
            <div class="crane-detail__spec"><strong>Макс. вылет стрелы:</strong> <?php echo esc_html( $crane_boom ); ?></div>
          <?php endif; ?>
          <?php if ( $crane_height ) : ?>
            <div class="crane-detail__spec"><strong>Высота подъёма:</strong> <?php echo esc_html( $crane_height ); ?></div>
          <?php endif; ?>
          <?php if ( $crane_manufacturer ) : ?>
            <div class="crane-detail__spec"><strong>Производитель:</strong> <?php echo esc_html( $crane_manufacturer ); ?></div>
          <?php endif; ?>
        </div>
        <?php if ( $crane_description ) : ?>
          <p class="crane-detail__text"><?php echo nl2br( esc_html( $crane_description ) ); ?></p>
        <?php endif; ?>
        <?php if ( $crane_price ) : ?>
          <p class="crane-detail__text"><strong>Стоимость:</strong> <?php echo esc_html( $crane_price ); ?></p>
        <?php endif; ?>
        <div class="crane-detail__actions">
          <?php if ( $crane_pdf ) : ?>
            <a href="<?php echo esc_url( $crane_pdf ); ?>" target="_blank" class="btn btn--outline">Скачать PDF спецификацию</a>
          <?php endif; ?>
          <a href="#" class="btn btn--primary" data-open-modal="calcModal">Рассчитать стоимость</a>
        </div>
      </div>
    </div>

    <?php if ( $crane_scheme_1 || $crane_scheme_2 ) : ?>
      <div class="crane-detail__schemes">
        <h3 class="crane-detail__schemes-title">Схемы грузоподъёмности</h3>
        <div class="crane-detail__schemes-grid">
          <?php if ( $crane_scheme_1 ) : ?>
            <a href="<?php echo esc_url( $crane_scheme_1 ); ?>" class="crane-detail__scheme-thumb" data-lightbox>
              <img src="<?php echo esc_url( $crane_scheme_1 ); ?>" alt="<?php the_title_attribute(); ?> — схема" loading="lazy">
              <span class="crane-detail__scheme-zoom">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
              </span>
            </a>
          <?php endif; ?>
          <?php if ( $crane_scheme_2 ) : ?>
            <a href="<?php echo esc_url( $crane_scheme_2 ); ?>" class="crane-detail__scheme-thumb" data-lightbox>
              <img src="<?php echo esc_url( $crane_scheme_2 ); ?>" alt="<?php the_title_attribute(); ?> — данные" loading="lazy">
              <span class="crane-detail__scheme-zoom">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
              </span>
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>
