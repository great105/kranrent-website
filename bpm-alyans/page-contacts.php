<?php
/**
 * Template Name: Контакты
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span>Контакты</div></div>

<section class="section">
  <div class="container">
    <h1 class="section-title" style="font-size:38px;">Контакты</h1>
    <p style="font-size:17px;color:var(--text-light);margin-bottom:48px;">Свяжитесь с нами удобным способом</p>

    <!-- Contact Cards -->
    <h2 style="font-size:22px;font-weight:700;margin-bottom:24px;">Как с нами связаться</h2>
    <div class="contacts-grid">
      <div class="contact-card">
        <div class="contact-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        </div>
        <h3 class="contact-card__title">Телефоны</h3>
        <div class="contact-card__text">
          <a href="tel:<?php echo esc_attr( get_theme_mod( 'bpm_phone_link', '+375445841091' ) ); ?>"><?php echo esc_html( get_theme_mod( 'bpm_phone', '+375 (44) 584-10-91' ) ); ?></a>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
        <h3 class="contact-card__title">Email</h3>
        <div class="contact-card__text">
          <a href="mailto:<?php echo esc_attr( get_theme_mod( 'bpm_email', 'info@bpm-alyans.by' ) ); ?>"><?php echo esc_html( get_theme_mod( 'bpm_email', 'info@bpm-alyans.by' ) ); ?></a>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
        </div>
        <h3 class="contact-card__title">Мессенджеры</h3>
        <div class="contact-card__text">
          <a href="<?php echo esc_url( get_theme_mod( 'bpm_telegram', 'https://t.me/375445841091' ) ); ?>">Telegram</a><br>
          <a href="<?php echo esc_attr( get_theme_mod( 'bpm_viber', 'viber://chat?number=%2B375445841091' ) ); ?>">Viber</a>
        </div>
      </div>
    </div>

    <!-- Address & Schedule -->
    <div class="contacts-grid" style="margin-bottom:48px;">
      <div class="contact-card">
        <div class="contact-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <h3 class="contact-card__title">Адрес</h3>
        <div class="contact-card__text">
          <?php echo esc_html( get_theme_mod( 'bpm_address_full', '220029, г. Минск, ул. Коммунистическая, д. 11, оф. 603' ) ); ?>
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h3 class="contact-card__title">Режим работы</h3>
        <div class="contact-card__text">
          Круглосуточно<br>
          Без выходных
        </div>
      </div>
      <div class="contact-card">
        <div class="contact-card__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
        <h3 class="contact-card__title">Реквизиты</h3>
        <div class="contact-card__text">
          <?php echo esc_html( get_theme_mod( 'bpm_legal_name', 'ООО «БПМ Альянс»' ) ); ?><br>
          УНП: <?php echo esc_html( get_theme_mod( 'bpm_unp', '193879266' ) ); ?><br>
          ОКПО: <?php echo esc_html( get_theme_mod( 'bpm_okpo', '510178295000' ) ); ?><br>
          <?php echo esc_html( get_theme_mod( 'bpm_bank_account', 'Р/с BY36ALFA30122H09980010270000' ) ); ?><br>
          <?php echo esc_html( get_theme_mod( 'bpm_bank_name', 'ЗАО «АЛЬФА-БАНК», код ALFABY2X' ) ); ?>
        </div>
      </div>
    </div>

    <!-- Map -->
    <h2 style="font-size:22px;font-weight:700;margin-bottom:24px;">Адрес и карта</h2>
    <div class="map-wrapper">
      <iframe src="https://yandex.ru/map-widget/v1/?ll=27.5533%2C53.8988&z=16&pt=27.5533%2C53.8988%2Cpm2blm~&text=%D0%91%D0%9F%D0%9C%20%D0%90%D0%BB%D1%8C%D1%8F%D0%BD%D1%81%2C%20%D1%83%D0%BB.%20%D0%9A%D0%BE%D0%BC%D0%BC%D1%83%D0%BD%D0%B8%D1%81%D1%82%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%B0%D1%8F%2011" style="width:100%;height:450px;border:0;border-radius:12px;" allowfullscreen></iframe>
    </div>
  </div>
</section>

<!-- Contact Form -->
<?php get_template_part( 'template-parts/contact-form' ); ?>

<?php get_footer(); ?>
