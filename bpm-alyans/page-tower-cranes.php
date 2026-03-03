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

<!-- Crane Fleet -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Парк башенных кранов</h2>
    <br>
    <div class="cranes-grid">
      <div class="crane-card">
        <div class="crane-card__img"><img src="<?php echo get_template_directory_uri(); ?>/img/cranes/tower-1.jpg" alt="КБ-403"></div>
        <div class="crane-card__name">КБ-403</div>
        <div class="crane-card__specs">
          <div class="crane-card__spec"><span class="crane-card__spec-label">Грузоподъемность:</span><span class="crane-card__spec-value">8 т</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Вылет стрелы:</span><span class="crane-card__spec-value">30 м</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Высота подъема:</span><span class="crane-card__spec-value">42 м</span></div>
        </div>
        <a href="#callback" class="btn btn--outline btn--full">Подробнее</a>
      </div>
      <div class="crane-card">
        <div class="crane-card__img"><img src="<?php echo get_template_directory_uri(); ?>/img/cranes/tower-2.jpg" alt="КБ-503"></div>
        <div class="crane-card__name">КБ-503</div>
        <div class="crane-card__specs">
          <div class="crane-card__spec"><span class="crane-card__spec-label">Грузоподъемность:</span><span class="crane-card__spec-value">10 т</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Вылет стрелы:</span><span class="crane-card__spec-value">35 м</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Высота подъема:</span><span class="crane-card__spec-value">55 м</span></div>
        </div>
        <a href="#callback" class="btn btn--outline btn--full">Подробнее</a>
      </div>
      <div class="crane-card">
        <div class="crane-card__img"><img src="<?php echo get_template_directory_uri(); ?>/img/cranes/tower-3.jpg" alt="КБ-674"></div>
        <div class="crane-card__name">КБ-674</div>
        <div class="crane-card__specs">
          <div class="crane-card__spec"><span class="crane-card__spec-label">Грузоподъемность:</span><span class="crane-card__spec-value">12 т</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Вылет стрелы:</span><span class="crane-card__spec-value">40 м</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Высота подъема:</span><span class="crane-card__spec-value">65 м</span></div>
        </div>
        <a href="#callback" class="btn btn--outline btn--full">Подробнее</a>
      </div>
      <div class="crane-card">
        <div class="crane-card__img"><img src="<?php echo get_template_directory_uri(); ?>/img/cranes/tower-4.jpg" alt="Liebherr 280 EC-H"></div>
        <div class="crane-card__name">Liebherr 280 EC-H</div>
        <div class="crane-card__specs">
          <div class="crane-card__spec"><span class="crane-card__spec-label">Грузоподъемность:</span><span class="crane-card__spec-value">12 т</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Вылет стрелы:</span><span class="crane-card__spec-value">50 м</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Высота подъема:</span><span class="crane-card__spec-value">75 м</span></div>
        </div>
        <a href="#callback" class="btn btn--outline btn--full">Подробнее</a>
      </div>
    </div>
  </div>
</section>

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
<section class="seo-text"><div class="container"><p><strong>Аренда башенных кранов в Минске</strong> — востребованная услуга для строительства многоэтажных жилых и коммерческих объектов. Мы предоставляем в аренду башенные краны грузоподъемностью до 12 тонн с полным комплексом услуг: монтаж, техническое обслуживание, демонтаж. Все краны проходят регулярное ТО и имеют необходимую документацию.</p></div></section>

<?php get_footer(); ?>
