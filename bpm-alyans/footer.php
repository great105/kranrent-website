<!-- Footer -->
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer__logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
            <?php if ( has_custom_logo() ) : ?>
              <?php
              $logo_id  = get_theme_mod( 'custom_logo' );
              $logo_url = wp_get_attachment_image_url( $logo_id, 'full' );
              ?>
              <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height:44px;width:auto;">
            <?php else : ?>
              <img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height:44px;width:auto;">
            <?php endif; ?>
            <div class="logo__text">
              <span class="logo__name" style="color:#fff">БПМ Альянс</span>
            </div>
          </a>
        </div>
        <p class="footer__desc">Аренда, монтаж, обслуживание и эксплуатация грузоподъёмного оборудования в Минске и по всей Беларуси</p>
      </div>
      <div>
        <h4 class="footer__heading">Услуги</h4>
        <ul class="footer__links">
          <li><a href="<?php echo esc_url( home_url( '/tower-cranes/' ) ); ?>">Башенные краны</a></li>
          <li><a href="<?php echo esc_url( home_url( '/mobile-cranes/' ) ); ?>">Автомобильные краны</a></li>
          <li><a href="<?php echo esc_url( home_url( '/crawler-cranes/' ) ); ?>">Гусеничные краны</a></li>
          <li><a href="<?php echo esc_url( home_url( '/installation/' ) ); ?>">Монтаж и проектирование</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer__heading">Навигация</h4>
        <ul class="footer__links">
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">О компании</a></li>
          <li><a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>">Новости</a></li>
          <li><a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>">Контакты</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer__heading">Контакты</h4>
        <div class="footer__contact-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
          <?php echo esc_html( get_theme_mod( 'bpm_phone', '+375 (44) 584-10-91' ) ); ?>
        </div>
        <div class="footer__contact-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          <?php echo esc_html( get_theme_mod( 'bpm_email', 'info@bpm-alyans.by' ) ); ?>
        </div>
        <div class="footer__contact-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
          <?php echo esc_html( get_theme_mod( 'bpm_address', 'г. Минск, ул. Коммунистическая, д. 11, оф. 603' ) ); ?>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&copy; <?php echo date( 'Y' ); ?> БПМ Альянс. Все права защищены. УНП: <?php echo esc_html( get_theme_mod( 'bpm_unp', '193879266' ) ); ?> | <?php echo esc_html( get_theme_mod( 'bpm_legal_name', 'ООО «БПМ Альянс»' ) ); ?></span>
      <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Политика конфиденциальности</a>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
