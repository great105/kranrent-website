<?php
/**
 * Template Name: Гусеничные краны
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span><a href="#">Услуги</a><span>&gt;</span>Аренда гусеничных кранов</div></div>

<section class="page-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/hero-bg2.jpg');">
  <div class="container">
    <h1 class="page-hero__title">Аренда гусеничных кранов</h1>
    <p class="page-hero__text">Решение для работы с тяжелыми грузами и на сложных площадках. Гусеничный ход обеспечивает устойчивость и низкое давление на грунт.</p>
    <div class="hero__buttons">
      <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="btn btn--primary btn--lg">Запросить консультацию</a>
      <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="btn btn--outline-dark btn--lg" style="border-color:rgba(255,255,255,0.4);color:#fff;">Получить расчет</a>
    </div>
  </div>
</section>

<!-- Fleet -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Парк гусеничных кранов</h2>
    <br>
    <div class="cranes-grid cranes-grid--3">
      <div class="crane-card">
        <div class="crane-card__img"><img src="<?php echo get_template_directory_uri(); ?>/img/cranes/crawler-1.jpg" alt="ДЭК-251"></div>
        <div class="crane-card__name">ДЭК-251</div>
        <div class="crane-card__specs">
          <div class="crane-card__spec"><span class="crane-card__spec-label">Грузоподъемность:</span><span class="crane-card__spec-value">50 т</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Вылет стрелы:</span><span class="crane-card__spec-value">25 м</span></div>
        </div>
        <a href="#callback" class="btn btn--outline btn--full">Подробнее</a>
      </div>
      <div class="crane-card">
        <div class="crane-card__img"><img src="<?php echo get_template_directory_uri(); ?>/img/cranes/crawler-2.jpg" alt="МКГ-25БР"></div>
        <div class="crane-card__name">МКГ-25БР</div>
        <div class="crane-card__specs">
          <div class="crane-card__spec"><span class="crane-card__spec-label">Грузоподъемность:</span><span class="crane-card__spec-value">100 т</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Вылет стрелы:</span><span class="crane-card__spec-value">30 м</span></div>
        </div>
        <a href="#callback" class="btn btn--outline btn--full">Подробнее</a>
      </div>
      <div class="crane-card">
        <div class="crane-card__img"><img src="<?php echo get_template_directory_uri(); ?>/img/cranes/crawler-3.jpg" alt="СКГ-160"></div>
        <div class="crane-card__name">СКГ-160</div>
        <div class="crane-card__specs">
          <div class="crane-card__spec"><span class="crane-card__spec-label">Грузоподъемность:</span><span class="crane-card__spec-value">160 т</span></div>
          <div class="crane-card__spec"><span class="crane-card__spec-label">Вылет стрелы:</span><span class="crane-card__spec-value">40 м</span></div>
        </div>
        <a href="#callback" class="btn btn--outline btn--full">Подробнее</a>
      </div>
    </div>
  </div>
</section>

<!-- Cost -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title">Стоимость аренды</h2>
    <br>
    <div class="pricing-factors">
      <p class="pricing-factors__title">На стоимость аренды гусеничного крана влияют:</p>
      <div class="pricing-factors__grid">
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Грузоподъемность и технические характеристики</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Срок аренды и режим работы</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Доставка на тралах (расстояние до объекта)</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Условия площадки и сложность работ</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Необходимость дополнительного оборудования</div></div></div>
        <div class="pricing-factor"><span class="pricing-factor__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></span><div><div class="pricing-factor__title">Объем и характер выполняемых работ</div></div></div>
      </div>
    </div>
    <div class="price-highlight">
      <span class="price-highlight__amount">от 3 000 BYN/смена</span>
      <span class="price-highlight__note">+ доставка и дополнительные услуги</span>
    </div>
  </div>
</section>

<!-- Form -->
<?php get_template_part( 'template-parts/contact-form' ); ?>

<!-- SEO Text -->
<section class="seo-text"><div class="container"><p><strong>Аренда гусеничных кранов</strong> — решение для работы с тяжелыми грузами и на сложных площадках. Гусеничный ход обеспечивает устойчивость и низкое давление на грунт, что позволяет работать там, где автомобильные краны не справятся.</p></div></section>

<?php get_footer(); ?>
