<?php
/**
 * Template Name: Монтаж и проектирование
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span><a href="#">Услуги</a><span>&gt;</span>Монтаж и проектирование</div></div>

<?php
$hero_title = bpm_meta( 'page_hero_title', 'Монтаж и проектирование' );
$hero_text  = bpm_meta( 'page_hero_text', 'Полный комплекс инженерных услуг: монтаж башенного крана за 1 день, разработка ППРк, проектирование фундаментов, изготовление и корректировка ПОС.' );
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
$extra_text_1_default = '<p class="crane-detail__text">БПМ Альянс выполняет <strong>монтаж башенного крана за 1 световой день</strong> (до высоты свободностоящего крана), независимо от условий строительной площадки — это ключевое преимущество, которое выделяет нас среди конкурентов.</p>
<p class="crane-detail__text">Работа выполняется высококвалифицированными специалистами, включая пусконаладочные работы после монтажа башенного крана, наращивания высоты крана с помощью монтажной обоймы и его крепления к зданию.</p>
<p class="crane-detail__text"><strong>Монтаж за 1 день</strong> снижает стоимость работ и позволяет заказчику приступить к строительству уже на следующий день, что экономит время и бюджет.</p>';
$extra_text_1_raw = get_post_meta( get_the_ID(), 'page_extra_text_1', true );
if ( $extra_text_1_raw ) {
    $extra_text_1 = '';
    foreach ( bpm_parse_lines( $extra_text_1_raw ) as $line ) {
        $extra_text_1 .= '<p class="crane-detail__text">' . wp_kses_post( $line ) . '</p>';
    }
} else {
    $extra_text_1 = $extra_text_1_default;
}
?>
<!-- Монтаж и эксплуатация -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Монтаж и эксплуатация</h2>
    <br>
    <div class="two-col-info">
      <div class="two-col-info__col" style="flex:1.2;">
        <?php echo $extra_text_1; ?>
      </div>
      <div class="two-col-info__col">
        <div class="crane-detail__specs-list">
          <div class="crane-detail__spec"><strong>Монтаж башенного крана</strong> — за 1 световой день</div>
          <div class="crane-detail__spec"><strong>Пусконаладочные работы</strong> — после монтажа</div>
          <div class="crane-detail__spec"><strong>Наращивание высоты</strong> — с помощью монтажной обоймы</div>
          <div class="crane-detail__spec"><strong>Крепление к зданию</strong> — на любой высоте</div>
          <div class="crane-detail__spec"><strong>Демонтаж</strong> — после завершения работ</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Преимущества монтажа -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title text-center">Почему монтаж за 1 день — это важно</h2>
    <br>
    <div class="advantages-grid">
      <div class="advantage-card">
        <div class="advantage-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
        <h3 class="advantage-card__title">Экономия времени</h3>
        <p class="advantage-card__text">Строительство начинается уже на следующий день после монтажа</p>
      </div>
      <div class="advantage-card">
        <div class="advantage-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div>
        <h3 class="advantage-card__title">Снижение затрат</h3>
        <p class="advantage-card__text">Быстрый монтаж — меньше расходов на простой техники и бригад</p>
      </div>
      <div class="advantage-card">
        <div class="advantage-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3 class="advantage-card__title">Безопасность</h3>
        <p class="advantage-card__text">Все работы выполняют квалифицированные специалисты с допусками</p>
      </div>
      <div class="advantage-card">
        <div class="advantage-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
        <h3 class="advantage-card__title">Любые условия</h3>
        <p class="advantage-card__text">Монтаж выполняется независимо от условий строительной площадки</p>
      </div>
    </div>
  </div>
</section>

<?php
$extra_text_2_default = '<p class="crane-detail__text">Сегодня на стройках приоритетным для заказчика является полный спектр услуг: помимо аренды и монтажа крана, обязательная разработка <strong>ППРк</strong> (проекта производства работ краном), проектирование фундаментной площадки под кран, а также изготовление или внесение изменений в <strong>ПОС</strong> (проект организации строительства).</p>
<p class="crane-detail__text">Наши специалисты выполнят весь комплекс проектных работ, необходимых для монтажа и эксплуатации любого вида крана, включая автокран грузоподъемностью 100 тонн.</p>';
$extra_text_2_raw = get_post_meta( get_the_ID(), 'page_extra_text_2', true );
if ( $extra_text_2_raw ) {
    $extra_text_2 = '';
    foreach ( bpm_parse_lines( $extra_text_2_raw ) as $line ) {
        $extra_text_2 .= '<p class="crane-detail__text">' . wp_kses_post( $line ) . '</p>';
    }
} else {
    $extra_text_2 = $extra_text_2_default;
}
?>
<!-- Проектные работы -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Проектные работы</h2>
    <br>
    <?php echo $extra_text_2; ?>
    <br>
    <div class="eng-grid">
      <div class="eng-card">
        <div class="eng-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
        <h3 class="eng-card__title">ППРк</h3>
        <p class="eng-card__text">Проект производства работ краном — обязательный документ для эксплуатации башенных кранов</p>
      </div>
      <div class="eng-card">
        <div class="eng-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div>
        <h3 class="eng-card__title">Фундамент под кран</h3>
        <p class="eng-card__text">Проектирование фундаментной площадки с учетом грунтов и нагрузок</p>
      </div>
      <div class="eng-card">
        <div class="eng-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
        <h3 class="eng-card__title">Схемы строповки</h3>
        <p class="eng-card__text">Расчет и разработка схем строповки грузов различной конфигурации</p>
      </div>
      <div class="eng-card">
        <div class="eng-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg></div>
        <h3 class="eng-card__title">ПОС</h3>
        <p class="eng-card__text">Изготовление или внесение изменений в проект организации строительства</p>
      </div>
      <div class="eng-card">
        <div class="eng-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
        <h3 class="eng-card__title">Подбор крана</h3>
        <p class="eng-card__text">Расчет требуемых параметров техники под конкретный объект</p>
      </div>
      <div class="eng-card">
        <div class="eng-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg></div>
        <h3 class="eng-card__title">Технический надзор</h3>
        <p class="eng-card__text">Контроль соответствия работ проектной документации и нормам безопасности</p>
      </div>
    </div>
  </div>
</section>

<?php
$extra_highlight = bpm_meta( 'page_extra_highlight', 'Когда эксплуатация башенных кранов невозможна без изготовления ППРк, мы обеспечим выезд <strong>100-тонного автомобильного крана с готовым проектом производства работ</strong>, изготовленным нашей компанией в кратчайший срок. Полный цикл: проект + техника + экипаж.' );
?>
<!-- Ключевое отличие -->
<section class="section section--gray">
  <div class="container">
    <div class="pricing-factors" style="border-left:4px solid var(--orange);padding-left:24px;">
      <p class="pricing-factors__title" style="font-size:18px;font-weight:700;color:var(--dark);">Ключевое отличие БПМ Альянс</p>
      <p class="crane-detail__text" style="margin-top:12px;"><?php echo wp_kses_post( $extra_highlight ); ?></p>
    </div>
  </div>
</section>

<?php
$steps_defaults = array(
    array( 'Анализ', 'Изучаем проектную документацию и условия объекта' ),
    array( 'Проектирование', 'Разрабатываем ППРк, схемы строповки и технологические карты' ),
    array( 'Согласование', 'Согласовываем документацию с надзорными органами' ),
    array( 'Монтаж', 'Выполняем монтаж крана за 1 день и пусконаладку' ),
);
$steps = array();
for ( $i = 1; $i <= 4; $i++ ) {
    $steps[] = array(
        bpm_meta( 'page_step_' . $i . '_title', $steps_defaults[ $i - 1 ][0] ),
        bpm_meta( 'page_step_' . $i . '_text', $steps_defaults[ $i - 1 ][1] ),
    );
}
?>
<!-- Этапы работы -->
<section class="section">
  <div class="container">
    <h2 class="section-title text-center">Этапы работы</h2>
    <br>
    <div class="steps-grid">
      <?php foreach ( $steps as $idx => $step ) : ?>
      <div class="step"><div class="step__number"><?php echo str_pad( $idx + 1, 2, '0', STR_PAD_LEFT ); ?></div><h3 class="step__title"><?php echo esc_html( $step[0] ); ?></h3><p class="step__text"><?php echo esc_html( $step[1] ); ?></p></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Documents -->
<section class="section section--gray">
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
        <div class="doc-card__title">Допуски специалистов</div>
      </div>
      <div class="doc-card">
        <div class="doc-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
        <div class="doc-card__title">Лицензия на проектирование</div>
      </div>
      <div class="doc-card">
        <div class="doc-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <div class="doc-card__title">Страхование</div>
      </div>
    </div>
  </div>
</section>

<?php
$faq_defaults = array(
    array( 'Сколько времени занимает монтаж башенного крана?', 'БПМ Альянс выполняет монтаж башенного крана (до высоты свободностоящего крана) за 1 световой день, независимо от условий площадки. Это включает пусконаладочные работы.' ),
    array( 'Обязательно ли разрабатывать ППРк?', 'Да, ППРк (проект производства работ краном) — обязательный документ для эксплуатации башенных кранов на строительных площадках. Наши специалисты разработают его в кратчайший срок.' ),
    array( 'Выполняете ли вы наращивание высоты крана?', 'Да, мы выполняем наращивание высоты крана с помощью монтажной обоймы и его крепление к зданию на любой высоте.' ),
    array( 'Можно ли заказать только проектные работы без аренды крана?', 'Да, мы выполняем проектные работы как в комплексе с арендой, так и отдельно: ППРк, проектирование фундамента, схемы строповки, корректировку ПОС.' ),
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
<section class="seo-text"><div class="container"><p><?php echo wp_kses_post( bpm_meta( 'page_seo_text', '<strong>Монтаж и проектирование кранов в Минске и Беларуси</strong> — полный комплекс инженерных услуг от БПМ Альянс. Монтаж башенного крана за 1 световой день, разработка ППРк, проектирование фундаментных площадок, изготовление и корректировка ПОС. Выезд 100-тонного автокрана с готовым проектом производства работ. Все необходимые лицензии и допуски.' ) ); ?></p></div></section>

<?php get_footer(); ?>
