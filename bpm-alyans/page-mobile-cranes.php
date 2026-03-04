<?php
/**
 * Template Name: Автомобильные краны
 */
get_header(); ?>

<div class="breadcrumbs">
  <div class="container">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span>
    <a href="#">Услуги</a><span>&gt;</span>
    Аренда автомобильных кранов
  </div>
</div>

<!-- Page Hero -->
<section class="page-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/hero-bg2.jpg');">
  <div class="container">
    <h1 class="page-hero__title">Аренда автомобильных кранов</h1>
    <p class="page-hero__text">Автокраны от 25 до 100 тонн с опытными операторами. Быстрая подача на объект, работа по всей Беларуси.</p>
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
            'terms'    => 'mobile',
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
    <h2 class="section-title">Парк автомобильных кранов</h2>
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

<!-- Pricing Table -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title">Цены на аренду автомобильного крана</h2>
    <br>
    <table class="pricing-table">
      <thead>
        <tr>
          <th>Грузоподъемность</th>
          <th>Смена (8 часов)</th>
          <th>Час работы</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>100 тонн</td><td>от 2 360 BYN</td><td>от 295 BYN</td></tr>
        <tr><td>80 тонн</td><td>от 1 840 BYN</td><td>от 230 BYN</td></tr>
        <tr><td>50-60 тонн</td><td>от 1 320 BYN</td><td>от 165 BYN</td></tr>
        <tr><td>25 тонн</td><td>от 800 BYN</td><td>от 100 BYN</td></tr>
      </tbody>
    </table>
  </div>
</section>

<!-- Pricing Factors -->
<section class="section">
  <div class="container">
    <div class="pricing-factors">
      <p class="pricing-factors__title">Стоимость аренды рассчитывается индивидуально и зависит от нескольких факторов:</p>
      <div class="pricing-factors__grid">
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Модель и грузоподъемность</div><div class="pricing-factor__text">Чем выше параметры крана, тем выше стоимость</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Срок аренды</div><div class="pricing-factor__text">При долгосрочной аренде действуют скидки</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Монтаж и демонтаж</div><div class="pricing-factor__text">Зависит от сложности и высоты установки</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Удаленность объекта</div><div class="pricing-factor__text">Учитывается стоимость доставки</div></div></div>
      </div>
    </div>
  </div>
</section>

<!-- How We Work -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title text-center">Как мы работаем</h2>
    <br>
    <div class="steps-grid">
      <div class="step"><div class="step__number">01</div><h3 class="step__title">Заявка</h3><p class="step__text">Вы оставляете заявку на сайте или звоните нам</p></div>
      <div class="step"><div class="step__number">02</div><h3 class="step__title">Консультация</h3><p class="step__text">Наш специалист поможет подобрать оптимальное решение</p></div>
      <div class="step"><div class="step__number">03</div><h3 class="step__title">Расчет</h3><p class="step__text">Рассчитываем стоимость и согласовываем условия</p></div>
      <div class="step"><div class="step__number">04</div><h3 class="step__title">Работа</h3><p class="step__text">Доставляем технику и выполняем работы в срок</p></div>
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

<!-- Requirements -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title">Требования к площадке и подготовке</h2>
    <br>
    <div class="two-col-info">
      <div class="two-col-info__col">
        <h3 class="two-col-info__title">Подготовка площадки:</h3>
        <ul class="two-col-info__list">
          <li>Площадка должна быть относительно ровной</li>
          <li>Грунт с несущей способностью от 1 кг/см&sup2;</li>
          <li>Свободное пространство для маневрирования</li>
          <li>Подъезд для трала с техникой</li>
        </ul>
      </div>
      <div class="two-col-info__col">
        <h3 class="two-col-info__title">Безопасность:</h3>
        <ul class="two-col-info__list">
          <li>Отсутствие ЛЭП в зоне работы</li>
          <li>Ограждение опасной зоны</li>
          <li>ППР и схемы строповки</li>
          <li>Наличие сигнальщика</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section">
  <div class="container">
    <h2 class="section-title">FAQ</h2>
    <br>
    <div class="faq-list">
      <div class="faq-item">
        <button class="faq-item__question">Как выбрать автокран нужной грузоподъемности?</button>
        <div class="faq-item__answer"><div class="faq-item__answer-inner">Выбор зависит от массы груза, высоты подъема и вылета стрелы. Наши специалисты бесплатно помогут подобрать оптимальную технику.</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-item__question">Какова минимальная продолжительность аренды автокрана?</button>
        <div class="faq-item__answer"><div class="faq-item__answer-inner">Минимальная продолжительность — 1 смена (8 часов). При заказе от 3 смен действуют скидки.</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-item__question">Нужно ли готовить площадку для работы автокрана?</button>
        <div class="faq-item__answer"><div class="faq-item__answer-inner">Да, площадка должна быть ровной с достаточной несущей способностью. Необходимо пространство для выдвижения аутригеров.</div></div>
      </div>
      <div class="faq-item">
        <button class="faq-item__question">Можно ли заказать автокран срочно?</button>
        <div class="faq-item__answer"><div class="faq-item__answer-inner">Да, при наличии свободной техники подача возможна в течение 1-2 часов по Минску.</div></div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Form -->
<?php get_template_part( 'template-parts/contact-form' ); ?>

<!-- SEO Text -->
<section class="seo-text">
  <div class="container">
    <p><strong>Аренда автомобильных кранов</strong> — самый востребованный вид услуг в сфере грузоподъемных работ. Автокраны сочетают мобильность, универсальность и экономичность, что делает их незаменимыми для большинства строительных и монтажных задач. Наша компания предлагает современный парк автокранов грузоподъемностью от 25 до 100 тонн с опытными операторами и полным пакетом документов.</p>
  </div>
</section>

<?php get_footer(); ?>
