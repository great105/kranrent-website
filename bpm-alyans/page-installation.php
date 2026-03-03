<?php
/**
 * Template Name: Монтаж и проектирование
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span><a href="#">Услуги</a><span>&gt;</span>Монтаж и проектирование</div></div>

<section class="page-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/hero-bg2.jpg');">
  <div class="container">
    <h1 class="page-hero__title">Монтаж и проектирование</h1>
    <p class="page-hero__text">Полный комплекс инженерных услуг: разработка ППР, схем строповки, подбор техники, организация и выполнение монтажных работ.</p>
    <div class="hero__buttons">
      <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="btn btn--primary btn--lg">Запросить консультацию</a>
      <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="btn btn--outline-dark btn--lg" style="border-color:rgba(255,255,255,0.4);color:#fff;">Получить расчет</a>
    </div>
  </div>
</section>

<!-- Services -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Что мы проектируем и организуем</h2>
    <br>
    <div class="eng-grid">
      <div class="eng-card">
        <div class="eng-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
        <h3 class="eng-card__title">ППР / ППРк</h3>
        <p class="eng-card__text">Проект производства работ и проект производства работ кранами</p>
      </div>
      <div class="eng-card">
        <div class="eng-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
        <h3 class="eng-card__title">Схемы строповки</h3>
        <p class="eng-card__text">Расчет и разработка схем строповки грузов различной конфигурации</p>
      </div>
      <div class="eng-card">
        <div class="eng-card__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6179D8" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
        <h3 class="eng-card__title">Подбор крана</h3>
        <p class="eng-card__text">Расчет требуемых параметров техники под конкретный объект</p>
      </div>
    </div>
  </div>
</section>

<!-- Steps -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title text-center">Этапы работы</h2>
    <br>
    <div class="steps-grid">
      <div class="step"><div class="step__number">01</div><h3 class="step__title">Анализ</h3><p class="step__text">Изучаем проектную документацию и условия объекта</p></div>
      <div class="step"><div class="step__number">02</div><h3 class="step__title">Проектирование</h3><p class="step__text">Разрабатываем ППР, схемы строповки и технологические карты</p></div>
      <div class="step"><div class="step__number">03</div><h3 class="step__title">Согласование</h3><p class="step__text">Согласовываем документацию с надзорными органами</p></div>
      <div class="step"><div class="step__number">04</div><h3 class="step__title">Реализация</h3><p class="step__text">Выполняем монтажные работы согласно разработанному проекту</p></div>
    </div>
  </div>
</section>

<!-- Form -->
<?php get_template_part( 'template-parts/contact-form' ); ?>

<?php get_footer(); ?>
