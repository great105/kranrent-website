<?php
/**
 * Template Part: Crane Card
 *
 * Expects: current post in the loop (post_type = crane)
 */
$crane_capacity = get_post_meta( get_the_ID(), 'crane_capacity', true );
$crane_boom     = get_post_meta( get_the_ID(), 'crane_boom', true );
$crane_height   = get_post_meta( get_the_ID(), 'crane_height', true );
$crane_is_new   = get_post_meta( get_the_ID(), 'crane_is_new', true );
$crane_anchor   = get_post_meta( get_the_ID(), 'crane_anchor', true );
?>
<div class="crane-card"<?php if ( $crane_anchor ) echo ' id="' . esc_attr( $crane_anchor ) . '"'; ?>>
  <div class="crane-card__img">
    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail( 'medium_large' ); ?>
    <?php endif; ?>
  </div>
  <div class="crane-card__name">
    <?php if ( $crane_is_new === '1' ) : ?><span class="crane-card__badge">Новый</span> <?php endif; ?>
    <?php the_title(); ?>
  </div>
  <div class="crane-card__specs">
    <?php if ( $crane_capacity ) : ?>
      <div class="crane-card__spec"><span class="crane-card__spec-label">Грузоподъемность:</span><span class="crane-card__spec-value"><?php echo esc_html( $crane_capacity ); ?></span></div>
    <?php endif; ?>
    <?php if ( $crane_boom ) : ?>
      <div class="crane-card__spec"><span class="crane-card__spec-label">Вылет стрелы:</span><span class="crane-card__spec-value"><?php echo esc_html( $crane_boom ); ?></span></div>
    <?php endif; ?>
    <?php if ( $crane_height ) : ?>
      <div class="crane-card__spec"><span class="crane-card__spec-label">Высота подъема:</span><span class="crane-card__spec-value"><?php echo esc_html( $crane_height ); ?></span></div>
    <?php endif; ?>
  </div>
  <a href="#detail-<?php echo esc_attr( $crane_anchor ? $crane_anchor : get_the_ID() ); ?>" class="btn btn--outline btn--full">Подробнее</a>
</div>
