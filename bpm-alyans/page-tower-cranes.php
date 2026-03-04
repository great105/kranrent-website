<?php
/**
 * Template Name: Башенные краны
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span><a href="#">Услуги</a><span>&gt;</span>Аренда башенных кранов</div></div>

<!-- Page Hero -->
<section class="page-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/hero-bg2.jpg');">
  <div class="container">
    <h1 class="page-hero__title">Аренда башенных кранов</h1>
    <p class="page-hero__text">Башенные краны различной грузоподъемности для строительства многоэтажных жилых и коммерческих объектов. Полный комплекс услуг: монтаж, обслуживание, демонтаж.</p>
    <div class="hero__buttons">
      <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="btn btn--primary btn--lg">Запросить консультацию</a>
      <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="btn btn--outline-dark btn--lg" style="border-color:rgba(255,255,255,0.4);color:#fff;">Получить расчет</a>
    </div>
  </div>
</section>

<?php
$cranes = new WP_Query( array(
    'post_type'      => 'crane',
    'posts_per_page' => -1,
    'tax_query'      => array(
        array(
            'taxonomy' => 'crane_type',
            'field'    => 'slug',
            'terms'    => 'tower',
        ),
    ),
    'meta_key'       => 'crane_sort_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
) );

if ( $cranes->have_posts() ) : ?>

<!-- Crane Fleet -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Парк башенных кранов</h2>
    <br>
    <div class="cranes-grid">
      <?php while ( $cranes->have_posts() ) : $cranes->the_post(); ?>
        <?php get_template_part( 'template-parts/crane-card' ); ?>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<!-- Crane Details -->
<?php
$cranes->rewind_posts();
$detail_index = 0;
while ( $cranes->have_posts() ) : $cranes->the_post();
    get_template_part( 'template-parts/crane-detail', null, array( 'index' => $detail_index ) );
    $detail_index++;
endwhile;
wp_reset_postdata();
?>

<?php endif; ?>

<!-- Price -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title">Стоимость аренды</h2>
    <br>
    <div class="pricing-factors">
      <p class="pricing-factors__title">Стоимость аренды рассчитывается индивидуально и зависит от нескольких факторов:</p>
      <div class="pricing-factors__grid">
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Модель и грузоподъемность</div><div class="pricing-factor__text">Чем выше параметры крана, тем выше стоимость</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Срок аренды</div><div class="pricing-factor__text">При долгосрочной аренде действуют скидки</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Монтаж и демонтаж</div><div class="pricing-factor__text">Зависит от сложности и высоты установки</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Удаленность объекта</div><div class="pricing-factor__text">Учитывается стоимость доставки</div></div></div>
      </div>
    </div>
    <div class="price-highlight">
      <span class="price-highlight__amount">от 15 000 BYN/мес</span>
      <span class="price-highlight__note">+ монтаж/демонтаж</span>
    </div>
  </div>
</section>

<!-- Conditions -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Условия аренды</h2>
    <br>
    <ul class="conditions-list">
      <li>Минимальный срок аренды - 1 месяц</li>
      <li>В стоимость входит: кран, оператор, обслуживание</li>
      <li>Монтаж и демонтаж оплачивается отдельно</li>
      <li>Требуется подготовленная площадка</li>
      <li>Необходимо энергоснабжение на объекте</li>
    </ul>
  </div>
</section>

<!-- Contact Form -->
<?php get_template_part( 'template-parts/contact-form' ); ?>

<!-- SEO Text -->
<section class="seo-text"><div class="container"><p><strong>Аренда башенных кранов в Минске и по всей Беларуси</strong> — востребованная услуга для строительства многоэтажных жилых и коммерческих объектов. Предоставляем в аренду башенные краны Raimondi MRT 180 и новый Zoomlion WA 6013-8 грузоподъемностью до 10 тонн, вылет стрелы до 60 м, высота подъема до 100 м. Полный комплекс услуг: монтаж, техническое обслуживание, демонтаж. Техника с экипажем, все необходимые лицензии и допуски.</p></div></section>

<?php get_footer(); ?>
