<?php get_header(); ?>

<!-- Hero -->
<section class="hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/hero-bg.webp');">
  <div class="container">
    <div class="hero__content">
      <h1 class="hero__title">Аренда и эксплуатация кранов с экипажем в Беларуси</h1>
      <p class="hero__text">Грузоподъёмная строительная техника: башенные, автомобильные и гусеничные краны. Полный комплекс услуг — аренда, монтаж, обслуживание и проектные работы. Работаем с 2007 года на всей территории РБ.</p>
      <div class="hero__buttons">
        <div class="hero-dropdown">
          <button class="btn btn--primary btn--lg hero-dropdown__toggle" type="button">Свободная техника &#9662;</button>
          <div class="hero-dropdown__menu">
            <?php
            $type_page_map = array(
                'tower'   => array( 'label' => 'Башенные краны', 'page' => '/tower-cranes/' ),
                'mobile'  => array( 'label' => 'Автомобильные краны', 'page' => '/mobile-cranes/' ),
                'crawler' => array( 'label' => 'Гусеничные краны', 'page' => '/crawler-cranes/' ),
            );
            foreach ( $type_page_map as $type_slug => $type_info ) :
                $dropdown_cranes = new WP_Query( array(
                    'post_type'      => 'crane',
                    'posts_per_page' => -1,
                    'tax_query'      => array( array(
                        'taxonomy' => 'crane_type',
                        'field'    => 'slug',
                        'terms'    => $type_slug,
                    ) ),
                    'meta_key'       => 'crane_sort_order',
                    'orderby'        => 'meta_value_num',
                    'order'          => 'ASC',
                ) );
                if ( $dropdown_cranes->have_posts() ) :
            ?>
            <div class="hero-dropdown__group">
              <div class="hero-dropdown__heading"><?php echo esc_html( $type_info['label'] ); ?></div>
              <?php while ( $dropdown_cranes->have_posts() ) : $dropdown_cranes->the_post();
                  $anchor   = get_post_meta( get_the_ID(), 'crane_anchor', true );
                  $capacity = get_post_meta( get_the_ID(), 'crane_capacity', true );
                  $boom     = get_post_meta( get_the_ID(), 'crane_boom', true );
                  $is_new   = get_post_meta( get_the_ID(), 'crane_is_new', true );
                  $link     = home_url( $type_info['page'] . ( $anchor ? '#' . $anchor : '' ) );
                  $label    = get_the_title();
                  if ( $is_new === '1' ) $label .= ' (новый)';
                  if ( $capacity ) $label .= ' — ' . $capacity;
                  if ( $boom ) $label .= ', стрела ' . $boom;
              ?>
              <a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $label ); ?></a>
              <?php endwhile; ?>
            </div>
            <?php
                endif;
                wp_reset_postdata();
            endforeach;
            ?>
          </div>
        </div>
        <a href="#callback" class="btn btn--outline-dark btn--lg" style="border-color:rgba(255,255,255,0.4);color:#fff;">Форма запроса</a>
      </div>
    </div>
  </div>
</section>

<!-- Services -->
<section class="section">
  <div class="container">
    <div class="services-grid">
      <div class="service-card">
        <div class="service-card__img">
          <img src="<?php echo get_template_directory_uri(); ?>/img/cranes/tower-1.jpg" alt="Башенные краны">
        </div>
        <h3 class="service-card__title">Башенные краны до 10 тн</h3>
        <p class="service-card__text">Современные краны на анкерном основании: Zoomlion WA 6013-8, стрела 60 м, высота башни до 81 м</p>
        <a href="<?php echo esc_url( home_url( '/tower-cranes/' ) ); ?>" class="service-card__link">Подробнее &rarr;</a>
      </div>
      <div class="service-card">
        <div class="service-card__img">
          <img src="<?php echo get_template_directory_uri(); ?>/img/cranes/mobile-1.jpg" alt="Автомобильные краны">
        </div>
        <h3 class="service-card__title">Автокраны до 100 тн</h3>
        <p class="service-card__text">Sany STC1000T6 грузоподъёмностью до 100 тн, стрела 60 м + гусёк 17,5 м. Покрывает диапазон 25-60-80-100 тн</p>
        <a href="<?php echo esc_url( home_url( '/mobile-cranes/' ) ); ?>" class="service-card__link">Подробнее &rarr;</a>
      </div>
      <div class="service-card">
        <div class="service-card__img">
          <img src="<?php echo get_template_directory_uri(); ?>/img/cranes/crawler-1.jpg" alt="Гусеничные краны">
        </div>
        <h3 class="service-card__title">Гусеничные краны 25 тн</h3>
        <p class="service-card__text">ДЭК 251 и RDK-25 грузоподъёмностью 25 тн, стрела до 32 м + гусёк 5 м. Бюджетное решение для начального этапа строительства</p>
        <a href="<?php echo esc_url( home_url( '/crawler-cranes/' ) ); ?>" class="service-card__link">Подробнее &rarr;</a>
      </div>
      <div class="service-card">
        <div class="service-card__img">
          <img src="<?php echo get_template_directory_uri(); ?>/img/icons/construction.png" alt="Монтаж и проектирование">
        </div>
        <h3 class="service-card__title">Монтаж и проектирование</h3>
        <p class="service-card__text">Монтаж башенного крана за 1 день. ППРк, проектирование фундаментов, изменения в ПОС</p>
        <a href="<?php echo esc_url( home_url( '/installation/' ) ); ?>" class="service-card__link">Подробнее &rarr;</a>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title text-center">Надёжные решения для грузоподъёмных работ</h2>
    <p class="section-subtitle text-center">Мы ценим доверие клиентов</p>
    <div class="advantages-grid">
      <div class="advantage">
        <div class="advantage__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <div>
          <div class="advantage__title">Опыт с 2007 года</div>
          <div class="advantage__text">Работаем более 15 лет. Понимаем реальные риски и требования на строительных объектах</div>
        </div>
      </div>
      <div class="advantage">
        <div class="advantage__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        </div>
        <div>
          <div class="advantage__title">Полный цикл услуг</div>
          <div class="advantage__text">Аренда, монтаж, обслуживание, эксплуатация и ППРк — один подрядчик</div>
        </div>
      </div>
      <div class="advantage">
        <div class="advantage__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div>
          <div class="advantage__title">Лицензии и безопасность</div>
          <div class="advantage__text">Все необходимые разрешения и допуски. Работы выполняются строго по нормативам и утверждённым проектам</div>
        </div>
      </div>
      <div class="advantage">
        <div class="advantage__icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <div>
          <div class="advantage__title">Техника с экипажем</div>
          <div class="advantage__text">Предоставляем исправную технику с квалифицированными машинистами и стропальщиками по запросу</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- How We Work -->
<section class="section">
  <div class="container">
    <h2 class="section-title text-center">Как мы работаем</h2>
    <br>
    <div class="steps-grid">
      <div class="step">
        <div class="step__number">01</div>
        <h3 class="step__title">Заявка</h3>
        <p class="step__text">Вы оставляете заявку на сайте или звоните нам</p>
      </div>
      <div class="step">
        <div class="step__number">02</div>
        <h3 class="step__title">Консультация</h3>
        <p class="step__text">Наш специалист поможет подобрать оптимальное решение</p>
      </div>
      <div class="step">
        <div class="step__number">03</div>
        <h3 class="step__title">Расчет</h3>
        <p class="step__text">Рассчитываем стоимость и согласовываем условия</p>
      </div>
      <div class="step">
        <div class="step__number">04</div>
        <h3 class="step__title">Работа</h3>
        <p class="step__text">Доставляем технику и выполняем работы в срок</p>
      </div>
    </div>
  </div>
</section>

<!-- News -->
<section class="section section--gray">
  <div class="container">
    <h2 class="section-title text-center">Новости</h2>
    <br>
    <div class="news-grid">
      <?php
      $news_query = new WP_Query( array(
          'post_type'      => 'news',
          'posts_per_page' => 3,
          'orderby'        => 'date',
          'order'          => 'DESC',
      ) );

      if ( $news_query->have_posts() ) :
          while ( $news_query->have_posts() ) : $news_query->the_post();
      ?>
      <div class="news-card">
        <div class="news-card__img">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large' ); ?>
          <?php endif; ?>
        </div>
        <div class="news-card__body">
          <div class="news-card__meta">
            <span><?php echo get_the_date( 'j F Y' ); ?></span>
            <?php
            $tags = get_the_terms( get_the_ID(), 'news_tag' );
            if ( $tags && ! is_wp_error( $tags ) ) :
                foreach ( $tags as $tag ) :
            ?>
              <span class="news-card__tag"><?php echo esc_html( $tag->name ); ?></span>
            <?php endforeach; endif; ?>
          </div>
          <h3 class="news-card__title"><?php the_title(); ?></h3>
          <p class="news-card__text"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
          <a href="<?php the_permalink(); ?>" class="news-card__link">Читать далее &rarr;</a>
        </div>
      </div>
      <?php
          endwhile;
          wp_reset_postdata();
      else :
      ?>
      <div class="news-card">
        <div class="news-card__img"></div>
        <div class="news-card__body">
          <div class="news-card__meta"><span>15 февраля 2026</span><span class="news-card__tag">Новости</span></div>
          <h3 class="news-card__title">Пополнение парка: новые башенные краны</h3>
          <p class="news-card__text">Мы расширили наш парк современными башенными кранами европейского производства с грузоподъемностью до 12 тонн.</p>
        </div>
      </div>
      <div class="news-card">
        <div class="news-card__img"></div>
        <div class="news-card__body">
          <div class="news-card__meta"><span>8 февраля 2026</span><span class="news-card__tag">Проекты</span></div>
          <h3 class="news-card__title">Успешно завершен крупный проект</h3>
          <p class="news-card__text">Наша команда завершила монтажные работы на объекте жилого комплекса "Минск Мир" с применением башенных и автомобильных кранов.</p>
        </div>
      </div>
      <div class="news-card">
        <div class="news-card__img"></div>
        <div class="news-card__body">
          <div class="news-card__meta"><span>1 февраля 2026</span><span class="news-card__tag">Услуги</span></div>
          <h3 class="news-card__title">Новые услуги: проектирование ППР</h3>
          <p class="news-card__text">Теперь мы предлагаем полный комплекс услуг по разработке проектов производства работ и схем строповки.</p>
        </div>
      </div>
      <?php endif; ?>
    </div>
    <div style="text-align:center;margin-top:32px;">
      <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="btn btn--outline">Все новости</a>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section">
  <div class="container">
    <h2 class="section-title text-center">Частые вопросы</h2>
    <p class="section-subtitle text-center">Ответы на часто задаваемые вопросы наших клиентов</p>
    <div class="faq-list">
      <div class="faq-item">
        <button class="faq-item__question">Работаете ли вы по всей Беларуси?</button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">Да, группа компаний БПМ Альянс работает с 2007 года на всей территории Республики Беларусь. Базируемся в Минске, но обеспечиваем выезд техники на объекты по всей стране.</div>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-item__question">Техника сдаётся с экипажем?</button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">Да, техника предоставляется в аренду с экипажем и, при необходимости, со стропальщиками. Все специалисты имеют необходимые допуски и квалификацию.</div>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-item__question">Есть ли лицензии и допуски?</button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">Все предприятия группы компаний имеют требуемые лицензии и разрешения. Работы выполняются строго по нормативам и утверждённым проектам производства работ.</div>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-item__question">Кто отвечает за безопасность работ?</button>
        <div class="faq-item__answer">
          <div class="faq-item__answer-inner">Безопасность обеспечивается штатом квалифицированных специалистов, современной технической базой и необходимым оборудованием. Все работы ведутся по утверждённым ППРк и под контролем ответственных лиц.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Form -->
<?php get_template_part( 'template-parts/contact-form' ); ?>

<!-- SEO Text -->
<section class="seo-text">
  <div class="container">
    <p><strong>Предприятие «БПМ Альянс»</strong> самостоятельно и в составе группы компаний оказывает услуги по аренде, монтажу, обслуживанию и эксплуатации грузоподъёмного оборудования, а также по разработке проектов производства работ со строительными кранами. Группа компаний работает с 2007 года на всей территории Республики Беларусь. Деятельность обеспечивается штатом квалифицированных специалистов, современной технической базой и необходимым оборудованием. Все предприятия группы имеют требуемые лицензии и разрешения.</p>
  </div>
</section>

<?php get_footer(); ?>
