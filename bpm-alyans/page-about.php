<?php
/**
 * Template Name: О компании
 */
get_header(); ?>

<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><span>&gt;</span>О компании</div></div>

<!-- Page Hero -->
<section class="page-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/about-bg.jpg');">
  <div class="container">
    <h1 class="page-hero__title">О компании</h1>
    <p class="page-hero__text">Профессионализм, подтверждённый временем</p>
  </div>
</section>

<!-- About Text -->
<section class="section">
  <div class="container">

    <div class="about-text">
      <h2 style="font-size:24px;margin-bottom:16px;">О предприятии</h2>
      <p>Предприятие <strong>«БПМ Альянс»</strong> самостоятельно и в составе группы компаний оказывает услуги по аренде, монтажу, обслуживанию и эксплуатации грузоподъёмного оборудования, а также по разработке проектов производства работ со строительными кранами.</p>
      <p>Группа компаний работает <strong>с 2007 года</strong> на всей территории Республики Беларусь. За годы работы группа компаний расширилась и укрепила свои позиции, сформировавшись как широкопрофильное предприятие, предоставляющее заказчикам <strong>полный комплекс услуг</strong>.</p>
      <p>Деятельность обеспечивается штатом квалифицированных специалистов, современной технической базой и необходимым оборудованием. Все предприятия группы имеют требуемые лицензии и разрешения. Техника предоставляется в аренду <strong>с экипажем</strong> и, при необходимости, <strong>со стропальщиками</strong>.</p>
    </div>
  </div>
</section>

<!-- Stats -->
<section class="stats">
  <div class="container">
    <div class="stats-grid">
      <div class="stat"><div class="stat__number">15+</div><div class="stat__label">Лет на рынке</div></div>
      <div class="stat"><div class="stat__number">50+</div><div class="stat__label">Единиц техники</div></div>
      <div class="stat"><div class="stat__number">200+</div><div class="stat__label">Выполненных проектов</div></div>
      <div class="stat"><div class="stat__number">100+</div><div class="stat__label">Постоянных клиентов</div></div>
    </div>
  </div>
</section>

<!-- Fleet -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Парк техники</h2>
    <p class="section-subtitle">Современный парк крановой техники различной грузоподъемности для решения любых задач</p>
    <div class="fleet-grid">
      <?php
      $fleet_types = array(
          'tower'   => array( 'label' => 'Башенные краны', 'fallback_img' => '/img/cranes/tower-5.jpg' ),
          'mobile'  => array( 'label' => 'Автомобильные краны', 'fallback_img' => '/img/cranes/mobile-5.jpg' ),
          'crawler' => array( 'label' => 'Гусеничные краны', 'fallback_img' => '/img/cranes/crawler-5.jpg' ),
      );
      foreach ( $fleet_types as $ft_slug => $ft_info ) :
          $fleet_q = new WP_Query( array(
              'post_type'      => 'crane',
              'posts_per_page' => -1,
              'tax_query'      => array( array(
                  'taxonomy' => 'crane_type',
                  'field'    => 'slug',
                  'terms'    => $ft_slug,
              ) ),
              'meta_key'       => 'crane_sort_order',
              'orderby'        => 'meta_value_num',
              'order'          => 'ASC',
          ) );
          if ( $fleet_q->have_posts() ) :
              $names = array();
              $max_capacity = '';
              $max_boom = '';
              $first_thumb = '';
              while ( $fleet_q->have_posts() ) : $fleet_q->the_post();
                  $name = get_the_title();
                  if ( ! in_array( $name, $names ) ) $names[] = $name;
                  $cap = get_post_meta( get_the_ID(), 'crane_capacity', true );
                  if ( $cap ) $max_capacity = $cap;
                  $boom = get_post_meta( get_the_ID(), 'crane_boom', true );
                  if ( $boom ) $max_boom = $boom;
                  if ( ! $first_thumb && has_post_thumbnail() ) {
                      $first_thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                  }
              endwhile;
              wp_reset_postdata();
              $img_url = $first_thumb ? $first_thumb : get_template_directory_uri() . $ft_info['fallback_img'];
      ?>
      <div class="fleet-card">
        <div class="fleet-card__img"><img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $ft_info['label'] ); ?>"></div>
        <h3 class="fleet-card__title"><?php echo esc_html( $ft_info['label'] ); ?></h3>
        <p class="fleet-card__count"><?php echo esc_html( implode( ', ', $names ) ); ?></p>
        <p class="fleet-card__count">
          <?php if ( $max_capacity ) echo 'Грузоподъёмность до ' . esc_html( $max_capacity ); ?>
          <?php if ( $max_boom ) echo ', стрела ' . esc_html( $max_boom ); ?>
        </p>
      </div>
      <?php
          endif;
      endforeach;
      ?>
    </div>
    <div class="fleet-buttons">
      <a href="<?php echo esc_url( home_url( '/tower-cranes/' ) ); ?>" class="btn btn--outline">Башенные краны</a>
      <a href="<?php echo esc_url( home_url( '/mobile-cranes/' ) ); ?>" class="btn btn--outline">Автомобильные краны</a>
      <a href="<?php echo esc_url( home_url( '/crawler-cranes/' ) ); ?>" class="btn btn--outline">Гусеничные краны</a>
    </div>
  </div>
</section>

<!-- Principles -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title text-center">Наши принципы</h2>
    <br>
    <div class="principles-grid">
      <div class="principle">
        <h3 class="principle__title">Безопасность</h3>
        <p class="principle__text">Безопасность — наш главный приоритет. Все работы выполняются в строгом соответствии с нормативными требованиями.</p>
      </div>
      <div class="principle">
        <h3 class="principle__title">Качество</h3>
        <p class="principle__text">Мы используем только современную технику, которая регулярно проходит техническое обслуживание и диагностику.</p>
      </div>
      <div class="principle">
        <h3 class="principle__title">Надежность</h3>
        <p class="principle__text">Выполняем взятые на себя обязательства точно в срок. Наши клиенты могут рассчитывать на нас в любой ситуации.</p>
      </div>
    </div>
  </div>
</section>

<!-- Cases -->
<section class="section">
  <div class="container">
    <h2 class="section-title">Кейсы / Примеры работ</h2>
    <br>
    <div class="cases-grid">
      <div class="case-card">
        <div class="case-card__img"><img src="<?php echo get_template_directory_uri(); ?>/img/cranes/tower-6.jpg" alt="ЖК Минск Мир"></div>
        <div class="case-card__body">
          <h3 class="case-card__title">ЖК "Минск Мир"</h3>
          <p class="case-card__text">Установка и эксплуатация 3 башенных кранов КБ-503 на протяжении 18 месяцев для строительства жилого комплекса высотой 25 этажей.</p>
          <div class="case-card__tags"><span class="case-card__tag">18 месяцев</span><span class="case-card__tag">3 крана</span></div>
        </div>
      </div>
      <div class="case-card">
        <div class="case-card__img"><img src="<?php echo get_template_directory_uri(); ?>/img/cranes/mobile-6.jpg" alt="БЦ Столица"></div>
        <div class="case-card__body">
          <h3 class="case-card__title">БЦ "Столица"</h3>
          <p class="case-card__text">Монтаж башенного крана КБ-674 для строительства бизнес-центра. Работа на стесненной площадке в центре города.</p>
          <div class="case-card__tags"><span class="case-card__tag">12 месяцев</span><span class="case-card__tag">Центр города</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
