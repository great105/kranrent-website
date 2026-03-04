<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Top Bar -->
<div class="top-bar">
  <div class="container">
    <div class="top-bar__left">
      <a href="tel:<?php echo esc_attr( get_theme_mod( 'bpm_phone_link', '+375445841091' ) ); ?>">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        <?php echo esc_html( get_theme_mod( 'bpm_phone', '+375 (44) 584-10-91' ) ); ?>
      </a>
      <span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Круглосуточно
      </span>
    </div>
    <div class="top-bar__right">
      <a href="mailto:<?php echo esc_attr( get_theme_mod( 'bpm_email', 'info@bpm-alyans.by' ) ); ?>"><?php echo esc_html( get_theme_mod( 'bpm_email', 'info@bpm-alyans.by' ) ); ?></a>
    </div>
  </div>
</div>

<!-- Header -->
<header class="header">
  <div class="container">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
      <?php if ( has_custom_logo() ) : ?>
        <?php
        $logo_id  = get_theme_mod( 'custom_logo' );
        $logo_url = wp_get_attachment_image_url( $logo_id, 'full' );
        ?>
        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo__img" style="height:44px;width:auto;">
      <?php else : ?>
        <img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo__img" style="height:44px;width:auto;">
      <?php endif; ?>
      <div class="logo__text">
        <span class="logo__name">БПМ Альянс</span>
        <span class="logo__desc">Аренда и эксплуатация кранов</span>
      </div>
    </a>
    <nav class="nav">
      <div class="nav__dropdown">
        <a href="#" class="nav__link nav__link--dropdown">Услуги</a>
        <div class="nav__dropdown-menu">
          <a href="<?php echo esc_url( home_url( '/tower-cranes/' ) ); ?>">Башенные краны</a>
          <a href="<?php echo esc_url( home_url( '/mobile-cranes/' ) ); ?>">Автомобильные краны</a>
          <a href="<?php echo esc_url( home_url( '/crawler-cranes/' ) ); ?>">Гусеничные краны</a>
          <a href="<?php echo esc_url( home_url( '/installation/' ) ); ?>">Монтаж и проектирование</a>
        </div>
      </div>
      <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="nav__link">Новости</a>
      <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="nav__link">О компании</a>
      <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="nav__link">Контакты</a>
    </nav>
    <a href="#" class="btn btn--primary header__cta" data-open-modal="calcModal">Рассчитать стоимость</a>
    <button class="burger" id="burgerBtn" aria-label="Меню">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<!-- Mobile Nav -->
<div class="mobile-overlay" id="mobileOverlay"></div>
<div class="mobile-nav" id="mobileNav">
  <button class="mobile-nav__close" id="mobileClose">&times;</button>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-nav__link">Главная</a>
  <span class="mobile-nav__link">Услуги</span>
  <div class="mobile-nav__sub">
    <a href="<?php echo esc_url( home_url( '/tower-cranes/' ) ); ?>">Башенные краны</a>
    <a href="<?php echo esc_url( home_url( '/mobile-cranes/' ) ); ?>">Автомобильные краны</a>
    <a href="<?php echo esc_url( home_url( '/crawler-cranes/' ) ); ?>">Гусеничные краны</a>
    <a href="<?php echo esc_url( home_url( '/installation/' ) ); ?>">Монтаж и проектирование</a>
  </div>
  <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="mobile-nav__link">Новости</a>
  <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="mobile-nav__link">О компании</a>
  <a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>" class="mobile-nav__link">Контакты</a>
  <br>
  <a href="#" class="btn btn--primary btn--full" data-open-modal="calcModal">Рассчитать стоимость</a>
</div>
