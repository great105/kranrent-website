<?php
/**
 * Template Name: Гусеничные краны
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span><a href="#">Услуги</a><span>&gt;</span>Аренда гусеничных кранов</div></div>

<?php
$hero_title = bpm_meta( 'page_hero_title', 'Аренда гусеничных кранов' );
$hero_text  = bpm_meta( 'page_hero_text', 'Решение для работы с тяжелыми грузами и на сложных площадках. Гусеничный ход обеспечивает устойчивость и низкое давление на грунт.' );
$hero_bg    = bpm_meta( 'page_hero_bg', get_template_directory_uri() . '/img/hero-bg2.jpg' );
?>
<section class="page-hero" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
  <div class="container">
    <h1 class="page-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
    <p class="page-hero__text"><?php echo esc_html( $hero_text ); ?></p>
    <div class="hero__buttons">
      <a href="#callback" class="btn btn--primary btn--lg">Оставить заявку</a>
      <a href="#" class="btn btn--outline-dark btn--lg" style="border-color:rgba(255,255,255,0.4);color:#fff;" data-open-modal="calcModal">Рассчитать стоимость</a>
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
            'terms'    => 'crawler',
        ),
    ),
    'meta_key'       => 'crane_sort_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
) );

if ( $cranes->have_posts() ) : ?>

<!-- Fleet -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Парк гусеничных кранов</h2>
    <br>
    <div class="cranes-grid cranes-grid--3">
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

<?php
$pricing_intro = bpm_meta( 'page_pricing_intro', 'На стоимость аренды гусеничного крана влияют:' );
$pricing_factors_raw = get_post_meta( get_the_ID(), 'page_pricing_factors', true );
if ( $pricing_factors_raw ) {
    $pricing_factors = bpm_parse_lines( $pricing_factors_raw );
} else {
    $pricing_factors = array(
        'Грузоподъемность и технические характеристики',
        'Срок аренды и режим работы',
        'Доставка на тралах (расстояние до объекта)',
        'Условия площадки и сложность работ',
        'Необходимость дополнительного оборудования',
        'Объем и характер выполняемых работ',
    );
}
$price_amount = bpm_meta( 'page_price_amount', 'от 3 000 BYN/смена' );
$price_note   = bpm_meta( 'page_price_note', '+ доставка и дополнительные услуги' );
?>
<!-- Cost -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title">Стоимость аренды</h2>
    <br>
    <div class="pricing-factors">
      <p class="pricing-factors__title"><?php echo esc_html( $pricing_intro ); ?></p>
      <div class="pricing-factors__grid">
        <?php foreach ( $pricing_factors as $factor ) :
            $parts = explode( '|', $factor );
            $f_title = trim( $parts[0] );
            $f_text  = isset( $parts[1] ) ? trim( $parts[1] ) : '';
        ?>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title"><?php echo esc_html( $f_title ); ?></div><?php if ( $f_text ) : ?><div class="pricing-factor__text"><?php echo esc_html( $f_text ); ?></div><?php endif; ?></div></div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="price-highlight">
      <span class="price-highlight__amount"><?php echo esc_html( $price_amount ); ?></span>
      <span class="price-highlight__note"><?php echo esc_html( $price_note ); ?></span>
    </div>
  </div>
</section>

<?php
$conditions_raw = get_post_meta( get_the_ID(), 'page_conditions', true );
if ( $conditions_raw ) {
    $conditions = bpm_parse_lines( $conditions_raw );
} else {
    $conditions = array(
        'Минимальный срок аренды — 1 смена (8 часов)',
        'В стоимость входит: кран, оператор, обслуживание',
        'Доставка на тралах оплачивается отдельно',
        'При заказе от 3 смен действуют скидки',
        'Требуется подготовленная площадка',
    );
}
?>
<!-- Conditions -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Условия аренды</h2>
    <br>
    <ul class="conditions-list">
      <?php foreach ( $conditions as $item ) : ?>
      <li><?php echo esc_html( $item ); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php
$steps_defaults = array(
    array( 'Заявка', 'Вы оставляете заявку на сайте или звоните нам' ),
    array( 'Консультация', 'Наш специалист поможет подобрать оптимальное решение' ),
    array( 'Расчет', 'Рассчитываем стоимость и согласовываем условия' ),
    array( 'Работа', 'Доставляем технику и выполняем работы в срок' ),
);
$steps = array();
for ( $i = 1; $i <= 4; $i++ ) {
    $steps[] = array(
        bpm_meta( 'page_step_' . $i . '_title', $steps_defaults[ $i - 1 ][0] ),
        bpm_meta( 'page_step_' . $i . '_text', $steps_defaults[ $i - 1 ][1] ),
    );
}
?>
<!-- How We Work -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title text-center">Как мы работаем</h2>
    <br>
    <div class="steps-grid">
      <?php foreach ( $steps as $idx => $step ) : ?>
      <div class="step"><div class="step__number"><?php echo str_pad( $idx + 1, 2, '0', STR_PAD_LEFT ); ?></div><h3 class="step__title"><?php echo esc_html( $step[0] ); ?></h3><p class="step__text"><?php echo esc_html( $step[1] ); ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Documents -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Документы и допуски</h2>
    <br>
    <div class="docs-grid">
      <div class="doc-card">
        <div class="doc-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
        <div class="doc-card__title">Паспорт крана</div>
      </div>
      <div class="doc-card">
        <div class="doc-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg></div>
        <div class="doc-card__title">Допуски операторов</div>
      </div>
      <div class="doc-card">
        <div class="doc-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
        <div class="doc-card__title">ППР на работы</div>
      </div>
      <div class="doc-card">
        <div class="doc-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <div class="doc-card__title">Страхование</div>
      </div>
    </div>
  </div>
</section>

<?php
$req_col1_title = bpm_meta( 'page_req_col1_title', 'Подготовка площадки:' );
$req_col1_raw   = get_post_meta( get_the_ID(), 'page_req_col1_items', true );
$req_col1_items = $req_col1_raw ? bpm_parse_lines( $req_col1_raw ) : array(
    'Площадка должна быть относительно ровной',
    'Грунт с несущей способностью от 0,5 кг/см²',
    'Свободное пространство для маневрирования',
    'Подъезд для трала с техникой',
);
$req_col2_title = bpm_meta( 'page_req_col2_title', 'Безопасность:' );
$req_col2_raw   = get_post_meta( get_the_ID(), 'page_req_col2_items', true );
$req_col2_items = $req_col2_raw ? bpm_parse_lines( $req_col2_raw ) : array(
    'Отсутствие ЛЭП в зоне работы',
    'Ограждение опасной зоны',
    'ППР и схемы строповки',
    'Наличие сигнальщика',
);
?>
<!-- Requirements -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title">Требования к площадке и подготовке</h2>
    <br>
    <div class="two-col-info">
      <div class="two-col-info__col">
        <h3 class="two-col-info__title"><?php echo esc_html( $req_col1_title ); ?></h3>
        <ul class="two-col-info__list">
          <?php foreach ( $req_col1_items as $item ) : ?>
          <li><?php echo esc_html( $item ); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="two-col-info__col">
        <h3 class="two-col-info__title"><?php echo esc_html( $req_col2_title ); ?></h3>
        <ul class="two-col-info__list">
          <?php foreach ( $req_col2_items as $item ) : ?>
          <li><?php echo esc_html( $item ); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php
$faq_defaults = array(
    array( 'В чем преимущество гусеничного крана перед автокраном?', 'Гусеничный кран обеспечивает низкое давление на грунт, может перемещаться с грузом и работать на слабых грунтах, где автокран не сможет установить аутригеры.' ),
    array( 'Как доставляется гусеничный кран на объект?', 'Гусеничный кран доставляется на тралах в разобранном виде. Сборка на объекте занимает от нескольких часов до 1 дня в зависимости от модели.' ),
    array( 'Какова минимальная продолжительность аренды?', 'Минимальная продолжительность аренды — 1 смена (8 часов). При заказе от 3 смен действуют скидки.' ),
    array( 'Можно ли работать на слабых грунтах?', 'Да, гусеничный ход обеспечивает давление на грунт от 0,5 кг/см², что позволяет работать на площадках с низкой несущей способностью.' ),
);
$faq_items = array();
for ( $i = 1; $i <= 6; $i++ ) {
    $q = bpm_meta( 'page_faq_q_' . $i, isset( $faq_defaults[ $i - 1 ] ) ? $faq_defaults[ $i - 1 ][0] : '' );
    $a = bpm_meta( 'page_faq_a_' . $i, isset( $faq_defaults[ $i - 1 ] ) ? $faq_defaults[ $i - 1 ][1] : '' );
    if ( $q && $a ) {
        $faq_items[] = array( $q, $a );
    }
}
?>
<!-- FAQ -->
<section class="section">
  <div class="container">
    <h2 class="section-title">FAQ</h2>
    <br>
    <div class="faq-list">
      <?php foreach ( $faq_items as $faq ) : ?>
      <div class="faq-item">
        <button class="faq-item__question"><?php echo esc_html( $faq[0] ); ?></button>
        <div class="faq-item__answer"><div class="faq-item__answer-inner"><?php echo esc_html( $faq[1] ); ?></div></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Form -->
<?php get_template_part( 'template-parts/contact-form' ); ?>

<!-- SEO Text -->
<section class="seo-text"><div class="container"><p><?php echo wp_kses_post( bpm_meta( 'page_seo_text', '<strong>Аренда гусеничных кранов в Минске и Беларуси</strong> — решение для работы с тяжелыми грузами на сложных площадках. Гусеничный ход обеспечивает устойчивость и низкое давление на грунт. Предоставляем краны ДЭК 251 и RDK-25 грузоподъёмностью 25 тонн с экипажем. Стрела до 32 м + гусёк 5 м.' ) ); ?></p></div></section>

<?php get_footer(); ?>
