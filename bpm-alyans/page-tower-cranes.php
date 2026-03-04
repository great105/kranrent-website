<?php
/**
 * Template Name: Башенные краны
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span><a href="#">Услуги</a><span>&gt;</span>Аренда башенных кранов</div></div>

<?php
$hero_title = bpm_meta( 'page_hero_title', 'Аренда башенных кранов' );
$hero_text  = bpm_meta( 'page_hero_text', 'Башенные краны различной грузоподъемности для строительства многоэтажных жилых и коммерческих объектов. Полный комплекс услуг: монтаж, обслуживание, демонтаж.' );
$hero_bg    = bpm_meta( 'page_hero_bg', get_template_directory_uri() . '/img/hero-bg2.jpg' );
?>
<!-- Page Hero -->
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

<?php
$pricing_intro_default = 'Стоимость аренды рассчитывается индивидуально и зависит от нескольких факторов:';
$pricing_intro = bpm_meta( 'page_pricing_intro', $pricing_intro_default );
$pricing_factors_raw = get_post_meta( get_the_ID(), 'page_pricing_factors', true );
if ( $pricing_factors_raw ) {
    $pricing_factors = bpm_parse_lines( $pricing_factors_raw );
} else {
    $pricing_factors = array(
        'Модель и грузоподъемность|Чем выше параметры крана, тем выше стоимость',
        'Срок аренды|При долгосрочной аренде действуют скидки',
        'Монтаж и демонтаж|Зависит от сложности и высоты установки',
        'Удаленность объекта|Учитывается стоимость доставки',
    );
}
$price_amount = bpm_meta( 'page_price_amount', 'от 15 000 BYN/мес' );
$price_note   = bpm_meta( 'page_price_note', '+ монтаж/демонтаж' );
?>
<!-- Price -->
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
        'Минимальный срок аренды — 1 месяц',
        'В стоимость входит: кран, оператор, обслуживание',
        'Монтаж и демонтаж оплачивается отдельно',
        'Требуется подготовленная площадка с фундаментом',
        'Необходимо энергоснабжение на объекте',
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
    array( 'Работа', 'Выполняем монтаж крана и запускаем в эксплуатацию' ),
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
    'Подготовленный фундамент под башенный кран',
    'Грунт с несущей способностью от 2 кг/см²',
    'Свободное пространство для монтажа',
    'Подъезд для трала с секциями крана',
);
$req_col2_title = bpm_meta( 'page_req_col2_title', 'Безопасность:' );
$req_col2_raw   = get_post_meta( get_the_ID(), 'page_req_col2_items', true );
$req_col2_items = $req_col2_raw ? bpm_parse_lines( $req_col2_raw ) : array(
    'Отсутствие ЛЭП в зоне работы',
    'Ограждение опасной зоны',
    'Энергоснабжение (380В) на объекте',
    'ППР и схемы строповки',
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
    array( 'Какой минимальный срок аренды башенного крана?', 'Минимальный срок аренды башенного крана — 1 месяц. При долгосрочной аренде от 3 месяцев действуют скидки.' ),
    array( 'Что входит в стоимость аренды?', 'В стоимость входит: сам кран, оператор, техническое обслуживание. Монтаж, демонтаж и доставка оплачиваются отдельно.' ),
    array( 'Сколько времени занимает монтаж башенного крана?', 'Монтаж башенного крана занимает от 1 до 3 дней в зависимости от модели и высоты установки. Предварительно необходимо подготовить фундамент.' ),
    array( 'Какие требования к электроснабжению?', 'Для работы башенного крана необходимо электропитание 380В. Мощность зависит от модели крана — от 30 до 60 кВт.' ),
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

<!-- Contact Form -->
<?php get_template_part( 'template-parts/contact-form' ); ?>

<!-- SEO Text -->
<section class="seo-text"><div class="container"><p><?php echo wp_kses_post( bpm_meta( 'page_seo_text', '<strong>Аренда башенных кранов в Минске и по всей Беларуси</strong> — востребованная услуга для строительства многоэтажных жилых и коммерческих объектов. Предоставляем в аренду башенные краны Raimondi MRT 180 и новый Zoomlion WA 6013-8 грузоподъемностью до 10 тонн, вылет стрелы до 60 м, высота подъема до 100 м. Полный комплекс услуг: монтаж, техническое обслуживание, демонтаж. Техника с экипажем, все необходимые лицензии и допуски.' ) ); ?></p></div></section>

<?php get_footer(); ?>
