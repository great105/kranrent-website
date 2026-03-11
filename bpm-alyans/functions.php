<?php
/**
 * БПМ Альянс Theme Functions
 */

// === Fix site name if it's still default "My blog" ===
add_action( 'init', function() {
    if ( get_option( 'blogname' ) === 'My blog' || get_option( 'blogname' ) === '' ) {
        update_option( 'blogname', 'БПМ Альянс — Аренда и эксплуатация кранов' );
    }
    if ( get_option( 'blogdescription' ) === 'Just another WordPress site' || get_option( 'blogdescription' ) === '' ) {
        update_option( 'blogdescription', 'Аренда башенных, автомобильных и гусеничных кранов в Минске' );
    }
});

// === Restrict Editor role: no export, no import, no theme/plugin editing ===
add_action( 'admin_init', function() {
    $role = get_role( 'editor' );
    if ( $role ) {
        $role->remove_cap( 'export' );
        $role->remove_cap( 'import' );
    }
});

// Hide Theme/Plugin Editor & Export/Import menus from non-admins
add_action( 'admin_menu', function() {
    if ( ! current_user_can( 'manage_options' ) ) {
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'themes.php' );
        remove_menu_page( 'plugins.php' );
        remove_menu_page( 'options-general.php' );
        remove_menu_page( 'users.php' );
    }
}, 999 );

// === Theme Setup ===
function bpm_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 44,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'bpm_theme_setup' );

// === Enqueue Styles & Scripts ===
function bpm_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style( 'google-fonts-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(), null
    );

    // Theme stylesheet
    wp_enqueue_style( 'bpm-style', get_stylesheet_uri(), array( 'google-fonts-inter' ), wp_get_theme()->get( 'Version' ) );

    // Main JS
    wp_enqueue_script( 'bpm-main', get_template_directory_uri() . '/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'bpm_enqueue_assets' );

// === Clean up wp_head ===
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

// Remove block library CSS on front-end
function bpm_remove_block_css() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'bpm_remove_block_css', 100 );

// === Custom Post Type: News ===
function bpm_register_news_cpt() {
    $labels = array(
        'name'               => 'Новости',
        'singular_name'      => 'Новость',
        'menu_name'          => 'Новости',
        'add_new'            => 'Добавить новость',
        'add_new_item'       => 'Добавить новую новость',
        'edit_item'          => 'Редактировать новость',
        'new_item'           => 'Новая новость',
        'view_item'          => 'Просмотр новости',
        'search_items'       => 'Поиск новостей',
        'not_found'          => 'Новостей не найдено',
        'not_found_in_trash' => 'В корзине новостей нет',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'news', 'with_front' => false ),
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'news', $args );
}
add_action( 'init', 'bpm_register_news_cpt' );

// === Taxonomy: News Tags ===
function bpm_register_news_taxonomy() {
    $labels = array(
        'name'          => 'Теги новостей',
        'singular_name' => 'Тег',
        'search_items'  => 'Поиск тегов',
        'all_items'     => 'Все теги',
        'edit_item'     => 'Редактировать тег',
        'add_new_item'  => 'Добавить тег',
        'new_item_name' => 'Название нового тега',
        'menu_name'     => 'Теги',
    );

    register_taxonomy( 'news_tag', 'news', array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'news-tag' ),
    ) );
}
add_action( 'init', 'bpm_register_news_taxonomy' );

// === Customizer Settings ===
function bpm_customize_register( $wp_customize ) {
    // Section: Company Contacts
    $wp_customize->add_section( 'bpm_contacts', array(
        'title'    => 'Контакты компании',
        'priority' => 30,
    ) );

    // Phone
    $wp_customize->add_setting( 'bpm_phone', array(
        'default'           => '+375 (44) 584-10-91',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_phone', array(
        'label'   => 'Телефон',
        'section' => 'bpm_contacts',
        'type'    => 'text',
    ) );

    // Phone link (for href)
    $wp_customize->add_setting( 'bpm_phone_link', array(
        'default'           => '+375445841091',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_phone_link', array(
        'label'   => 'Телефон (для ссылки, без пробелов)',
        'section' => 'bpm_contacts',
        'type'    => 'text',
    ) );

    // Email
    $wp_customize->add_setting( 'bpm_email', array(
        'default'           => 'info@bpm-alyans.by',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'bpm_email', array(
        'label'   => 'Email',
        'section' => 'bpm_contacts',
        'type'    => 'email',
    ) );

    // Address
    $wp_customize->add_setting( 'bpm_address', array(
        'default'           => 'г. Минск, ул. Коммунистическая, д. 11, оф. 603',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_address', array(
        'label'   => 'Адрес',
        'section' => 'bpm_contacts',
        'type'    => 'text',
    ) );

    // Full address with index
    $wp_customize->add_setting( 'bpm_address_full', array(
        'default'           => '220029, г. Минск, ул. Коммунистическая, д. 11, оф. 603',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_address_full', array(
        'label'   => 'Полный адрес (с индексом)',
        'section' => 'bpm_contacts',
        'type'    => 'text',
    ) );

    // Telegram
    $wp_customize->add_setting( 'bpm_telegram', array(
        'default'           => 'https://t.me/375445841091',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'bpm_telegram', array(
        'label'   => 'Telegram ссылка',
        'section' => 'bpm_contacts',
        'type'    => 'url',
    ) );

    // Viber
    $wp_customize->add_setting( 'bpm_viber', array(
        'default'           => 'viber://chat?number=%2B375445841091',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_viber', array(
        'label'   => 'Viber ссылка',
        'section' => 'bpm_contacts',
        'type'    => 'text',
    ) );

    // Section: Company Details
    $wp_customize->add_section( 'bpm_company', array(
        'title'    => 'Реквизиты компании',
        'priority' => 31,
    ) );

    // UNP
    $wp_customize->add_setting( 'bpm_unp', array(
        'default'           => '193879266',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_unp', array(
        'label'   => 'УНП',
        'section' => 'bpm_company',
        'type'    => 'text',
    ) );

    // Legal name
    $wp_customize->add_setting( 'bpm_legal_name', array(
        'default'           => 'ООО «БПМ Альянс»',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_legal_name', array(
        'label'   => 'Юридическое название',
        'section' => 'bpm_company',
        'type'    => 'text',
    ) );

    // OKPO
    $wp_customize->add_setting( 'bpm_okpo', array(
        'default'           => '510178295000',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_okpo', array(
        'label'   => 'ОКПО',
        'section' => 'bpm_company',
        'type'    => 'text',
    ) );

    // Bank account
    $wp_customize->add_setting( 'bpm_bank_account', array(
        'default'           => 'Р/с BY36ALFA30122H09980010270000',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_bank_account', array(
        'label'   => 'Расчетный счет',
        'section' => 'bpm_company',
        'type'    => 'text',
    ) );

    // Bank name
    $wp_customize->add_setting( 'bpm_bank_name', array(
        'default'           => 'ЗАО «АЛЬФА-БАНК», код ALFABY2X',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_bank_name', array(
        'label'   => 'Банк',
        'section' => 'bpm_company',
        'type'    => 'text',
    ) );
}
add_action( 'customize_register', 'bpm_customize_register' );

// === SEO: Default meta per page slug ===
function bpm_get_seo_defaults() {
    return array(
        'front-page' => array(
            'title' => 'Аренда башенных и автомобильных кранов в Минске и Беларуси | БПМ Альянс',
            'description' => 'Аренда кранов с экипажем от БПМ Альянс. Башенные, автомобильные и гусеничные краны. Монтаж, обслуживание, проектирование. Опыт с 2007 года, работаем по всей Беларуси.',
            'keywords' => 'аренда кранов Минск, аренда башенного крана, аренда автокрана Беларусь, гусеничный кран аренда, кран с экипажем, БПМ Альянс, монтаж крана',
        ),
        'tower-cranes' => array(
            'title' => 'Аренда башенных кранов в Минске и Беларуси | БПМ Альянс',
            'description' => 'Аренда башенных кранов с экипажем от БПМ Альянс. Raimondi MRT 180, Zoomlion WA 6013-8. Грузоподъёмность до 10 т, вылет стрелы до 60 м. Монтаж, обслуживание, ППРк.',
            'keywords' => 'аренда башенного крана Минск, башенный кран аренда, Raimondi MRT 180, Zoomlion WA 6013, башенный кран с экипажем',
        ),
        'mobile-cranes' => array(
            'title' => 'Аренда автомобильных кранов (автокранов) в Минске | БПМ Альянс',
            'description' => 'Аренда автокранов от 25 до 100 тонн с опытными операторами. Быстрая подача на объект, работа по всей Беларуси. Цены от 800 BYN/смена.',
            'keywords' => 'аренда автокрана Минск, автомобильный кран аренда, автокран 100 тонн, автокран 25 тонн, аренда автокрана цена',
        ),
        'crawler-cranes' => array(
            'title' => 'Аренда гусеничных кранов в Минске и Беларуси | БПМ Альянс',
            'description' => 'Аренда гусеничных кранов ДЭК 251 и RDK-25 грузоподъёмностью 25 тонн. Низкое давление на грунт, работа на сложных площадках. Доставка по Беларуси.',
            'keywords' => 'аренда гусеничного крана Минск, гусеничный кран аренда, ДЭК 251, RDK-25, кран на гусеничном ходу',
        ),
        'installation' => array(
            'title' => 'Монтаж башенных кранов и проектирование ППРк | БПМ Альянс',
            'description' => 'Монтаж башенного крана за 1 день. Разработка ППРк, проектирование фундаментов, корректировка ПОС. Полный комплекс инженерных услуг в Минске и Беларуси.',
            'keywords' => 'монтаж башенного крана, ППРк разработка, проектирование крана, монтаж крана Минск, демонтаж крана',
        ),
        'about' => array(
            'title' => 'О компании БПМ Альянс | Аренда кранов с 2007 года',
            'description' => 'ООО «БПМ Альянс» — аренда и эксплуатация кранов в Беларуси с 2007 года. Собственный парк техники, квалифицированные операторы, все лицензии и допуски.',
            'keywords' => 'БПМ Альянс, аренда кранов Беларусь, компания аренда техники, о компании',
        ),
        'contacts' => array(
            'title' => 'Контакты БПМ Альянс | Аренда кранов Минск',
            'description' => 'Контакты ООО «БПМ Альянс»: +375 (44) 584-10-91, info@bpm-alyans.by. Минск, ул. Коммунистическая, д. 11, оф. 603. Работаем круглосуточно.',
            'keywords' => 'БПМ Альянс контакты, аренда крана телефон, кран Минск контакты',
        ),
        'news' => array(
            'title' => 'Новости компании БПМ Альянс | Аренда кранов',
            'description' => 'Новости и события компании БПМ Альянс — аренда и эксплуатация кранов в Беларуси. Новая техника, проекты, отраслевые новости.',
            'keywords' => 'БПМ Альянс новости, аренда кранов Беларусь новости',
        ),
    );
}

// === SEO Meta Tags (all pages) ===
function bpm_seo_meta_tags() {
    $defaults = bpm_get_seo_defaults();
    $slug = '';
    $description = '';
    $keywords = '';
    $og_title = '';
    $og_description = '';
    $canonical = '';

    if ( is_front_page() ) {
        $slug = 'front-page';
        $canonical = home_url( '/' );
    } elseif ( is_page() ) {
        $slug = get_post_field( 'post_name', get_the_ID() );
        $canonical = get_permalink();
    } elseif ( is_post_type_archive( 'news' ) ) {
        $slug = 'news';
        $canonical = get_post_type_archive_link( 'news' );
    } elseif ( is_singular( 'news' ) ) {
        $description = get_the_excerpt() ?: wp_trim_words( get_the_content(), 25, '...' );
        $og_title = get_the_title() . ' | БПМ Альянс';
        $og_description = $description;
        $canonical = get_permalink();
        echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url( $canonical ) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr( $og_description ) . '" />' . "\n";
        echo '<meta property="og:site_name" content="БПМ Альянс" />' . "\n";
        echo '<link rel="canonical" href="' . esc_url( $canonical ) . '" />' . "\n";
        return;
    } else {
        return;
    }

    // Get defaults for this slug
    $def = isset( $defaults[ $slug ] ) ? $defaults[ $slug ] : array(
        'title' => '',
        'description' => '',
        'keywords' => '',
    );

    // Check for admin-set overrides (page meta fields)
    if ( is_page() || is_front_page() ) {
        $custom_desc = get_post_meta( get_the_ID(), 'page_seo_description', true );
        if ( $custom_desc ) {
            $description = $custom_desc;
        } else {
            $description = $def['description'];
        }
    } else {
        $description = $def['description'];
    }

    $keywords = $def['keywords'];
    $og_title = ( is_page() || is_front_page() ) ? bpm_meta( 'page_seo_title', $def['title'] ) : $def['title'];
    $og_description = $description;

    if ( $description ) {
        echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
    }
    if ( $keywords ) {
        echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '">' . "\n";
    }

    // Open Graph
    echo '<meta property="og:type" content="website" />' . "\n";
    if ( $canonical ) {
        echo '<meta property="og:url" content="' . esc_url( $canonical ) . '" />' . "\n";
    }
    if ( $og_title ) {
        echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '" />' . "\n";
    }
    if ( $og_description ) {
        echo '<meta property="og:description" content="' . esc_attr( $og_description ) . '" />' . "\n";
    }
    echo '<meta property="og:site_name" content="БПМ Альянс" />' . "\n";
    echo '<meta property="og:locale" content="ru_RU" />' . "\n";

    // Canonical
    if ( $canonical ) {
        echo '<link rel="canonical" href="' . esc_url( $canonical ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'bpm_seo_meta_tags', 1 );

// === Custom document title (all pages) ===
function bpm_custom_title( $title ) {
    $defaults = bpm_get_seo_defaults();

    if ( is_front_page() ) {
        $custom = get_post_meta( get_the_ID(), 'page_seo_title', true );
        $title['title'] = $custom ?: $defaults['front-page']['title'];
        unset( $title['site'] );
        unset( $title['tagline'] );
        return $title;
    }

    if ( is_page() ) {
        $slug = get_post_field( 'post_name', get_the_ID() );
        $custom = get_post_meta( get_the_ID(), 'page_seo_title', true );
        if ( $custom ) {
            $title['title'] = $custom;
            unset( $title['site'] );
            return $title;
        }
        if ( isset( $defaults[ $slug ] ) ) {
            $title['title'] = $defaults[ $slug ]['title'];
            unset( $title['site'] );
            return $title;
        }
    }

    if ( is_post_type_archive( 'news' ) ) {
        $title['title'] = $defaults['news']['title'];
        unset( $title['site'] );
        return $title;
    }

    return $title;
}
add_filter( 'document_title_parts', 'bpm_custom_title' );

// Remove WP default separator
function bpm_title_separator( $sep ) {
    return '|';
}
add_filter( 'document_title_separator', 'bpm_title_separator' );

// === Disable Contact Form 7 CSS ===
add_filter( 'wpcf7_load_css', '__return_false' );

// === News posts per page ===
function bpm_news_posts_per_page( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'news' ) ) {
        $query->set( 'posts_per_page', 9 );
    }
}
add_action( 'pre_get_posts', 'bpm_news_posts_per_page' );

// === Custom Post Type: Cranes ===
function bpm_register_crane_cpt() {
    $labels = array(
        'name'               => 'Краны',
        'singular_name'      => 'Кран',
        'menu_name'          => 'Краны',
        'add_new'            => 'Добавить кран',
        'add_new_item'       => 'Добавить новый кран',
        'edit_item'          => 'Редактировать кран',
        'new_item'           => 'Новый кран',
        'view_item'          => 'Просмотр крана',
        'search_items'       => 'Поиск кранов',
        'not_found'          => 'Кранов не найдено',
        'not_found_in_trash' => 'В корзине кранов нет',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'cranes', 'with_front' => false ),
        'menu_icon'          => 'dashicons-hammer',
        'supports'           => array( 'title', 'thumbnail' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'crane', $args );
}
add_action( 'init', 'bpm_register_crane_cpt' );

// === Taxonomy: Crane Type ===
function bpm_register_crane_type_taxonomy() {
    $labels = array(
        'name'          => 'Типы кранов',
        'singular_name' => 'Тип крана',
        'search_items'  => 'Поиск типов',
        'all_items'     => 'Все типы',
        'edit_item'     => 'Редактировать тип',
        'add_new_item'  => 'Добавить тип',
        'new_item_name' => 'Название нового типа',
        'menu_name'     => 'Типы кранов',
    );

    register_taxonomy( 'crane_type', 'crane', array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'crane-type' ),
    ) );
}
add_action( 'init', 'bpm_register_crane_type_taxonomy' );

// === Crane Meta Box ===
function bpm_crane_meta_boxes() {
    add_meta_box(
        'crane_details',
        'Характеристики крана',
        'bpm_crane_meta_box_html',
        'crane',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'bpm_crane_meta_boxes' );

function bpm_crane_meta_box_html( $post ) {
    wp_nonce_field( 'bpm_crane_meta', 'bpm_crane_meta_nonce' );

    $fields = array(
        '_section_photo'     => array( 'type' => 'section', 'label' => 'Фото крана', 'desc' => 'Основное фото крана задаётся через блок <strong>«Изображение записи»</strong> справа. Оно отображается в карточке крана и в подробном описании.' ),
        '_section_specs'     => array( 'type' => 'section', 'label' => 'Технические характеристики' ),
        'crane_capacity'     => array( 'label' => 'Грузоподъёмность', 'type' => 'text', 'placeholder' => '100 т', 'desc' => 'Отображается в карточке и в подробном описании' ),
        'crane_boom'         => array( 'label' => 'Вылет стрелы', 'type' => 'text', 'placeholder' => '60 м + гусёк 17,5 м' ),
        'crane_height'       => array( 'label' => 'Высота подъёма', 'type' => 'text', 'placeholder' => '37 м' ),
        'crane_manufacturer' => array( 'label' => 'Производитель', 'type' => 'text', 'placeholder' => 'Carlo Raimondi, Италия' ),
        '_section_content'   => array( 'type' => 'section', 'label' => 'Описание и цена' ),
        'crane_description'  => array( 'label' => 'Описание крана', 'type' => 'textarea', 'placeholder' => 'Подробное описание...' ),
        'crane_price'        => array( 'label' => 'Цена', 'type' => 'text', 'placeholder' => 'от 2 360 BYN/смена', 'desc' => 'Показывается в подробном описании крана' ),
        '_section_media'     => array( 'type' => 'section', 'label' => 'Документы и схемы' ),
        'crane_pdf'          => array( 'label' => 'PDF-спецификация', 'type' => 'file', 'desc' => 'Кнопка «Скачать PDF спецификацию» рядом с описанием крана' ),
        'crane_scheme_1'     => array( 'label' => 'Схема грузоподъёмности 1', 'type' => 'image', 'desc' => 'Отображается как превью под описанием крана. По клику открывается в полном размере.' ),
        'crane_scheme_2'     => array( 'label' => 'Схема грузоподъёмности 2', 'type' => 'image', 'desc' => 'Вторая схема (необязательно)' ),
        '_section_settings'  => array( 'type' => 'section', 'label' => 'Настройки отображения' ),
        'crane_is_new'       => array( 'label' => 'Бейдж «Новый»', 'type' => 'checkbox', 'desc' => 'Зелёный бейдж в карточке и заголовке' ),
        'crane_anchor'       => array( 'label' => 'Якорь (ID для ссылки)', 'type' => 'text', 'placeholder' => 'sany-100t', 'desc' => 'Латиница, без пробелов. Используется для навигации: кнопка «Подробнее» ведёт к этому блоку' ),
        'crane_sort_order'   => array( 'label' => 'Порядок сортировки', 'type' => 'number', 'placeholder' => '0', 'desc' => 'Чем меньше число, тем выше кран в списке' ),
    );

    echo '<table class="form-table"><tbody>';
    foreach ( $fields as $key => $field ) {
        // Section header
        if ( $field['type'] === 'section' ) {
            echo '<tr><td colspan="2" style="padding: 12px 0 4px;">';
            echo '<h3 style="margin:0; padding:8px 0; border-bottom:1px solid #ccd0d4; font-size:14px;">' . esc_html( $field['label'] ) . '</h3>';
            if ( ! empty( $field['desc'] ) ) {
                echo '<p class="description" style="margin-top:6px;">' . wp_kses_post( $field['desc'] ) . '</p>';
            }
            echo '</td></tr>';
            continue;
        }

        $value = get_post_meta( $post->ID, $key, true );
        echo '<tr><th><label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';

        if ( $field['type'] === 'textarea' ) {
            echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="5" style="width:100%;" placeholder="' . esc_attr( $field['placeholder'] ?? '' ) . '">' . esc_textarea( $value ) . '</textarea>';
        } elseif ( $field['type'] === 'checkbox' ) {
            echo '<input type="checkbox" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="1"' . checked( $value, '1', false ) . '>';
        } elseif ( $field['type'] === 'file' || $field['type'] === 'image' ) {
            echo '<input type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" style="width:70%;">';
            echo ' <button type="button" class="button bpm-media-upload" data-target="' . esc_attr( $key ) . '">' . ( $field['type'] === 'image' ? 'Выбрать изображение' : 'Выбрать файл' ) . '</button>';
            if ( $field['type'] === 'image' && $value ) {
                echo '<br><img src="' . esc_url( $value ) . '" style="max-width:200px;margin-top:8px;">';
            }
        } else {
            echo '<input type="' . esc_attr( $field['type'] ) . '" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" style="width:100%;" placeholder="' . esc_attr( $field['placeholder'] ?? '' ) . '">';
        }

        if ( ! empty( $field['desc'] ) ) {
            echo '<p class="description">' . esc_html( $field['desc'] ) . '</p>';
        }

        echo '</td></tr>';
    }
    echo '</tbody></table>';
}

// === Save Crane Meta ===
function bpm_save_crane_meta( $post_id ) {
    if ( ! isset( $_POST['bpm_crane_meta_nonce'] ) || ! wp_verify_nonce( $_POST['bpm_crane_meta_nonce'], 'bpm_crane_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $text_fields = array(
        'crane_capacity', 'crane_boom', 'crane_height', 'crane_manufacturer',
        'crane_price', 'crane_anchor',
    );
    foreach ( $text_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }

    if ( isset( $_POST['crane_description'] ) ) {
        update_post_meta( $post_id, 'crane_description', sanitize_textarea_field( $_POST['crane_description'] ) );
    }

    $url_fields = array( 'crane_pdf', 'crane_scheme_1', 'crane_scheme_2' );
    foreach ( $url_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, esc_url_raw( $_POST[ $key ] ) );
        }
    }

    update_post_meta( $post_id, 'crane_is_new', isset( $_POST['crane_is_new'] ) ? '1' : '0' );

    if ( isset( $_POST['crane_sort_order'] ) ) {
        update_post_meta( $post_id, 'crane_sort_order', intval( $_POST['crane_sort_order'] ) );
    }
}
add_action( 'save_post_crane', 'bpm_save_crane_meta' );

// === Media Uploader JS for Crane Meta Box ===
function bpm_crane_admin_scripts( $hook ) {
    global $post_type;
    if ( $post_type !== 'crane' || ! in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
        return;
    }
    wp_enqueue_media();
    wp_add_inline_script( 'jquery-core', "
        jQuery(document).ready(function($){
            $('.bpm-media-upload').on('click', function(e){
                e.preventDefault();
                var button = $(this);
                var targetId = button.data('target');
                var frame = wp.media({ multiple: false });
                frame.on('select', function(){
                    var attachment = frame.state().get('selection').first().toJSON();
                    $('#' + targetId).val(attachment.url);
                    button.siblings('img').remove();
                    if (attachment.type === 'image') {
                        button.after('<br><img src=\"' + attachment.url + '\" style=\"max-width:200px;margin-top:8px;\">');
                    }
                });
                frame.open();
            });
        });
    " );
}
add_action( 'admin_enqueue_scripts', 'bpm_crane_admin_scripts' );

// === Admin Columns for Crane List ===
function bpm_crane_admin_columns( $columns ) {
    $new = array();
    $new['cb']             = $columns['cb'];
    $new['crane_thumb']    = 'Фото';
    $new['title']          = $columns['title'];
    $new['crane_type_col'] = 'Тип';
    $new['crane_capacity'] = 'Грузоподъёмность';
    $new['crane_new']      = 'Новый';
    $new['crane_sort']     = 'Порядок';
    $new['date']           = $columns['date'];
    return $new;
}
add_filter( 'manage_crane_posts_columns', 'bpm_crane_admin_columns' );

function bpm_crane_admin_column_data( $column, $post_id ) {
    switch ( $column ) {
        case 'crane_thumb':
            if ( has_post_thumbnail( $post_id ) ) {
                echo get_the_post_thumbnail( $post_id, array( 50, 50 ), array( 'style' => 'border-radius:4px;' ) );
            } else {
                echo '<span style="color:#999;">—</span>';
            }
            break;
        case 'crane_type_col':
            $terms = get_the_terms( $post_id, 'crane_type' );
            echo $terms ? esc_html( implode( ', ', wp_list_pluck( $terms, 'name' ) ) ) : '—';
            break;
        case 'crane_capacity':
            $v = get_post_meta( $post_id, 'crane_capacity', true );
            echo $v ? esc_html( $v ) : '—';
            break;
        case 'crane_new':
            echo get_post_meta( $post_id, 'crane_is_new', true ) === '1' ? '<span style="color:#22c55e;font-weight:600;">Да</span>' : '—';
            break;
        case 'crane_sort':
            echo esc_html( get_post_meta( $post_id, 'crane_sort_order', true ) ?: '0' );
            break;
    }
}
add_action( 'manage_crane_posts_custom_column', 'bpm_crane_admin_column_data', 10, 2 );

function bpm_crane_sortable_columns( $columns ) {
    $columns['crane_sort']     = 'crane_sort_order';
    $columns['crane_capacity'] = 'crane_capacity';
    return $columns;
}
add_filter( 'manage_edit-crane_sortable_columns', 'bpm_crane_sortable_columns' );

function bpm_crane_orderby( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() || $query->get( 'post_type' ) !== 'crane' ) {
        return;
    }
    $orderby = $query->get( 'orderby' );
    if ( $orderby === 'crane_sort_order' ) {
        $query->set( 'meta_key', 'crane_sort_order' );
        $query->set( 'orderby', 'meta_value_num' );
    }
}
add_action( 'pre_get_posts', 'bpm_crane_orderby' );

// === Flush rewrite rules on theme activation ===
function bpm_rewrite_flush() {
    bpm_register_news_cpt();
    bpm_register_news_taxonomy();
    bpm_register_crane_cpt();
    bpm_register_crane_type_taxonomy();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'bpm_rewrite_flush' );

// === Disable WP default sitemap (we have our own) ===
add_filter( 'wp_sitemaps_enabled', '__return_false' );

// === XML Sitemap ===
function bpm_sitemap_rewrite_rules( $rules ) {
    $new_rules = array( 'sitemap\.xml$' => 'index.php?bpm_sitemap=1' );
    return $new_rules + $rules;
}
add_filter( 'rewrite_rules_array', 'bpm_sitemap_rewrite_rules' );

function bpm_sitemap_query_vars( $vars ) {
    $vars[] = 'bpm_sitemap';
    return $vars;
}
add_filter( 'query_vars', 'bpm_sitemap_query_vars' );

function bpm_sitemap_template() {
    if ( ! get_query_var( 'bpm_sitemap' ) ) {
        return;
    }

    header( 'Content-Type: application/xml; charset=UTF-8' );
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // Front page
    echo '<url><loc>' . esc_url( home_url( '/' ) ) . '</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>' . "\n";

    // Static pages
    $pages = get_posts( array(
        'post_type'   => 'page',
        'post_status' => 'publish',
        'numberposts' => -1,
    ) );
    foreach ( $pages as $page ) {
        if ( $page->ID == get_option( 'page_on_front' ) ) continue;
        if ( $page->post_name === 'news' ) continue; // skip — handled as CPT archive
        $mod = get_the_modified_date( 'Y-m-d', $page );
        echo '<url><loc>' . esc_url( get_permalink( $page ) ) . '</loc><lastmod>' . $mod . '</lastmod><changefreq>monthly</changefreq><priority>0.8</priority></url>' . "\n";
    }

    // News archive
    echo '<url><loc>' . esc_url( get_post_type_archive_link( 'news' ) ) . '</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>' . "\n";

    // News posts
    $news = get_posts( array(
        'post_type'   => 'news',
        'post_status' => 'publish',
        'numberposts' => 100,
    ) );
    foreach ( $news as $post ) {
        $mod = get_the_modified_date( 'Y-m-d', $post );
        echo '<url><loc>' . esc_url( get_permalink( $post ) ) . '</loc><lastmod>' . $mod . '</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>' . "\n";
    }

    echo '</urlset>';
    exit;
}
add_action( 'template_redirect', 'bpm_sitemap_template' );

// === Robots.txt — add sitemap ===
function bpm_robots_txt( $output, $public ) {
    if ( $public ) {
        $output .= "\nSitemap: " . home_url( '/sitemap.xml' ) . "\n";
    }
    return $output;
}
add_filter( 'robots_txt', 'bpm_robots_txt', 10, 2 );

// === Schema.org LocalBusiness JSON-LD ===
function bpm_schema_jsonld() {
    if ( is_admin() ) return;

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'БПМ Альянс',
        'description' => 'Аренда и эксплуатация башенных, автомобильных и гусеничных кранов в Минске и по всей Беларуси с 2007 года.',
        'url' => home_url( '/' ),
        'telephone' => get_theme_mod( 'bpm_phone', '+375 (44) 584-10-91' ),
        'email' => get_theme_mod( 'bpm_email', 'info@bpm-alyans.by' ),
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => 'ул. Коммунистическая, д. 11, оф. 603',
            'addressLocality' => 'Минск',
            'postalCode' => '220029',
            'addressCountry' => 'BY',
        ),
        'geo' => array(
            '@type' => 'GeoCoordinates',
            'latitude' => '53.9006',
            'longitude' => '27.5590',
        ),
        'openingHours' => 'Mo-Su 00:00-23:59',
        'priceRange' => 'от 800 BYN',
        'areaServed' => array(
            '@type' => 'Country',
            'name' => 'Беларусь',
        ),
        'serviceType' => array(
            'Аренда башенных кранов',
            'Аренда автомобильных кранов',
            'Аренда гусеничных кранов',
            'Монтаж и демонтаж кранов',
            'Проектирование ППРк',
        ),
    );

    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
    echo "\n</script>\n";
}
add_action( 'wp_head', 'bpm_schema_jsonld', 99 );

// === Page Content Meta Fields ===

/**
 * Helper: get meta field with fallback default.
 */
function bpm_meta( $key, $default = '', $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    $value = get_post_meta( $post_id, $key, true );
    return ( $value !== '' && $value !== false ) ? $value : $default;
}

/**
 * Helper: parse textarea into array of lines (trimmed, empty removed).
 * Format "Title|Description" for paired data.
 */
function bpm_parse_lines( $text ) {
    if ( empty( $text ) ) {
        return array();
    }
    $lines = explode( "\n", $text );
    $result = array();
    foreach ( $lines as $line ) {
        $line = trim( $line );
        if ( $line !== '' ) {
            $result[] = $line;
        }
    }
    return $result;
}

/**
 * Register meta box for all pages.
 */
function bpm_page_content_meta_boxes() {
    add_meta_box(
        'bpm_page_content',
        'Содержимое страницы',
        'bpm_page_content_meta_box_html',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'bpm_page_content_meta_boxes' );

/**
 * Render page content meta box.
 */
function bpm_page_content_meta_box_html( $post ) {
    wp_nonce_field( 'bpm_page_content_meta', 'bpm_page_content_nonce' );

    $sections = array(
        // Hero
        array( 'type' => 'section', 'label' => 'Hero-секция' ),
        'page_hero_title' => array( 'label' => 'Заголовок Hero', 'type' => 'text', 'placeholder' => 'Главный заголовок страницы' ),
        'page_hero_text'  => array( 'label' => 'Текст Hero', 'type' => 'textarea', 'placeholder' => 'Подзаголовок / описание' ),
        'page_hero_bg'    => array( 'label' => 'Фон Hero (URL изображения)', 'type' => 'image', 'placeholder' => '' ),

        // Pricing
        array( 'type' => 'section', 'label' => 'Цены' ),
        'page_pricing_intro'   => array( 'label' => 'Вводный текст цен', 'type' => 'text', 'placeholder' => 'Стоимость аренды рассчитывается индивидуально...' ),
        'page_pricing_factors' => array( 'label' => 'Ценовые факторы', 'type' => 'textarea', 'placeholder' => "Заголовок|Описание\nЗаголовок|Описание", 'desc' => 'По одному на строку. Формат: Заголовок|Описание (описание необязательно)' ),
        'page_price_amount'    => array( 'label' => 'Цена (крупно)', 'type' => 'text', 'placeholder' => 'от 15 000 BYN/мес' ),
        'page_price_note'      => array( 'label' => 'Примечание к цене', 'type' => 'text', 'placeholder' => '+ монтаж/демонтаж' ),
        'page_pricing_table'   => array( 'label' => 'Таблица цен', 'type' => 'textarea', 'placeholder' => "Модель|Смена|Час\n100 тонн|от 2 360 BYN|от 295 BYN", 'desc' => 'По одной строке на ряд. Формат: Модель|Смена|Час' ),

        // Conditions
        array( 'type' => 'section', 'label' => 'Условия аренды' ),
        'page_conditions' => array( 'label' => 'Условия', 'type' => 'textarea', 'placeholder' => "Минимальный срок аренды — 1 месяц\nВ стоимость входит: кран, оператор", 'desc' => 'По одному пункту на строку' ),

        // Steps
        array( 'type' => 'section', 'label' => 'Этапы работы' ),
        'page_step_1_title' => array( 'label' => 'Шаг 1 — заголовок', 'type' => 'text', 'placeholder' => 'Заявка' ),
        'page_step_1_text'  => array( 'label' => 'Шаг 1 — текст', 'type' => 'text', 'placeholder' => 'Вы оставляете заявку...' ),
        'page_step_2_title' => array( 'label' => 'Шаг 2 — заголовок', 'type' => 'text', 'placeholder' => 'Консультация' ),
        'page_step_2_text'  => array( 'label' => 'Шаг 2 — текст', 'type' => 'text', 'placeholder' => 'Наш специалист поможет...' ),
        'page_step_3_title' => array( 'label' => 'Шаг 3 — заголовок', 'type' => 'text', 'placeholder' => 'Расчет' ),
        'page_step_3_text'  => array( 'label' => 'Шаг 3 — текст', 'type' => 'text', 'placeholder' => 'Рассчитываем стоимость...' ),
        'page_step_4_title' => array( 'label' => 'Шаг 4 — заголовок', 'type' => 'text', 'placeholder' => 'Работа' ),
        'page_step_4_text'  => array( 'label' => 'Шаг 4 — текст', 'type' => 'text', 'placeholder' => 'Доставляем технику...' ),

        // Requirements
        array( 'type' => 'section', 'label' => 'Требования к площадке' ),
        'page_req_col1_title' => array( 'label' => 'Колонка 1 — заголовок', 'type' => 'text', 'placeholder' => 'Подготовка площадки:' ),
        'page_req_col1_items' => array( 'label' => 'Колонка 1 — пункты', 'type' => 'textarea', 'placeholder' => "Подготовленный фундамент\nГрунт с несущей способностью", 'desc' => 'По одному пункту на строку' ),
        'page_req_col2_title' => array( 'label' => 'Колонка 2 — заголовок', 'type' => 'text', 'placeholder' => 'Безопасность:' ),
        'page_req_col2_items' => array( 'label' => 'Колонка 2 — пункты', 'type' => 'textarea', 'placeholder' => "Отсутствие ЛЭП\nОграждение опасной зоны", 'desc' => 'По одному пункту на строку' ),

        // FAQ
        array( 'type' => 'section', 'label' => 'FAQ (вопросы и ответы)' ),
        'page_faq_q_1' => array( 'label' => 'Вопрос 1', 'type' => 'text', 'placeholder' => '' ),
        'page_faq_a_1' => array( 'label' => 'Ответ 1', 'type' => 'textarea', 'placeholder' => '' ),
        'page_faq_q_2' => array( 'label' => 'Вопрос 2', 'type' => 'text', 'placeholder' => '' ),
        'page_faq_a_2' => array( 'label' => 'Ответ 2', 'type' => 'textarea', 'placeholder' => '' ),
        'page_faq_q_3' => array( 'label' => 'Вопрос 3', 'type' => 'text', 'placeholder' => '' ),
        'page_faq_a_3' => array( 'label' => 'Ответ 3', 'type' => 'textarea', 'placeholder' => '' ),
        'page_faq_q_4' => array( 'label' => 'Вопрос 4', 'type' => 'text', 'placeholder' => '' ),
        'page_faq_a_4' => array( 'label' => 'Ответ 4', 'type' => 'textarea', 'placeholder' => '' ),
        'page_faq_q_5' => array( 'label' => 'Вопрос 5', 'type' => 'text', 'placeholder' => '' ),
        'page_faq_a_5' => array( 'label' => 'Ответ 5', 'type' => 'textarea', 'placeholder' => '' ),
        'page_faq_q_6' => array( 'label' => 'Вопрос 6', 'type' => 'text', 'placeholder' => '' ),
        'page_faq_a_6' => array( 'label' => 'Ответ 6', 'type' => 'textarea', 'placeholder' => '' ),

        // SEO
        array( 'type' => 'section', 'label' => 'SEO' ),
        'page_seo_title'       => array( 'label' => 'SEO Title (тег &lt;title&gt;)', 'type' => 'text', 'placeholder' => 'Аренда башенных кранов в Минске | БПМ Альянс', 'desc' => 'Заголовок вкладки браузера и поисковой выдачи. До 60 символов. Если пусто — генерируется автоматически.' ),
        'page_seo_description' => array( 'label' => 'Meta Description', 'type' => 'textarea', 'placeholder' => 'Аренда башенных кранов с экипажем в Минске и Беларуси...', 'desc' => 'Описание для поисковых систем. До 160 символов. Если пусто — генерируется автоматически.' ),
        'page_seo_text' => array( 'label' => 'SEO-текст на странице (HTML допустим)', 'type' => 'textarea', 'placeholder' => '', 'desc' => 'Текст в подвале страницы. Можно использовать &lt;strong&gt; для выделения.' ),

        // Extra content (for installation page etc.)
        array( 'type' => 'section', 'label' => 'Дополнительный контент' ),
        'page_extra_text_1'     => array( 'label' => 'Доп. текстовый блок 1', 'type' => 'textarea', 'placeholder' => '', 'desc' => 'Используется на странице монтажа (раздел «Монтаж и эксплуатация»)' ),
        'page_extra_text_2'     => array( 'label' => 'Доп. текстовый блок 2', 'type' => 'textarea', 'placeholder' => '', 'desc' => 'Используется на странице монтажа (раздел «Проектные работы»)' ),
        'page_extra_highlight'  => array( 'label' => 'Выделенный блок', 'type' => 'textarea', 'placeholder' => '', 'desc' => 'Ключевое отличие / важная информация' ),
    );

    echo '<table class="form-table"><tbody>';
    foreach ( $sections as $key => $field ) {
        // Section header
        if ( isset( $field['type'] ) && $field['type'] === 'section' ) {
            echo '<tr><td colspan="2" style="padding: 12px 0 4px;">';
            echo '<h3 style="margin:0; padding:8px 0; border-bottom:1px solid #ccd0d4; font-size:14px;">' . esc_html( $field['label'] ) . '</h3>';
            echo '</td></tr>';
            continue;
        }

        $value = get_post_meta( $post->ID, $key, true );
        echo '<tr><th><label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';

        if ( $field['type'] === 'textarea' ) {
            echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="4" style="width:100%;" placeholder="' . esc_attr( $field['placeholder'] ?? '' ) . '">' . esc_textarea( $value ) . '</textarea>';
        } elseif ( $field['type'] === 'image' ) {
            echo '<input type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" style="width:70%;" placeholder="' . esc_attr( $field['placeholder'] ?? '' ) . '">';
            echo ' <button type="button" class="button bpm-media-upload" data-target="' . esc_attr( $key ) . '">Выбрать изображение</button>';
            if ( $value ) {
                echo '<br><img src="' . esc_url( $value ) . '" style="max-width:200px;margin-top:8px;">';
            }
        } else {
            echo '<input type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" style="width:100%;" placeholder="' . esc_attr( $field['placeholder'] ?? '' ) . '">';
        }

        if ( ! empty( $field['desc'] ) ) {
            echo '<p class="description">' . wp_kses_post( $field['desc'] ) . '</p>';
        }

        echo '</td></tr>';
    }
    echo '</tbody></table>';
}

/**
 * Save page content meta fields.
 */
function bpm_save_page_content_meta( $post_id ) {
    if ( ! isset( $_POST['bpm_page_content_nonce'] ) || ! wp_verify_nonce( $_POST['bpm_page_content_nonce'], 'bpm_page_content_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $text_fields = array(
        'page_hero_title',
        'page_pricing_intro', 'page_price_amount', 'page_price_note',
        'page_step_1_title', 'page_step_1_text',
        'page_step_2_title', 'page_step_2_text',
        'page_step_3_title', 'page_step_3_text',
        'page_step_4_title', 'page_step_4_text',
        'page_req_col1_title', 'page_req_col2_title',
        'page_faq_q_1', 'page_faq_q_2', 'page_faq_q_3',
        'page_faq_q_4', 'page_faq_q_5', 'page_faq_q_6',
        'page_seo_title',
    );

    $textarea_fields = array(
        'page_hero_text',
        'page_pricing_factors', 'page_pricing_table',
        'page_conditions',
        'page_req_col1_items', 'page_req_col2_items',
        'page_faq_a_1', 'page_faq_a_2', 'page_faq_a_3',
        'page_faq_a_4', 'page_faq_a_5', 'page_faq_a_6',
        'page_seo_description', 'page_seo_text',
        'page_extra_text_1', 'page_extra_text_2', 'page_extra_highlight',
    );

    $url_fields = array( 'page_hero_bg' );

    foreach ( $text_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }

    foreach ( $textarea_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }

    foreach ( $url_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, esc_url_raw( $_POST[ $key ] ) );
        }
    }
}
add_action( 'save_post_page', 'bpm_save_page_content_meta' );

/**
 * Enqueue media uploader for page meta box.
 */
function bpm_page_admin_scripts( $hook ) {
    global $post_type;
    if ( $post_type !== 'page' || ! in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
        return;
    }
    wp_enqueue_media();
    wp_add_inline_script( 'jquery-core', "
        jQuery(document).ready(function($){
            $('#bpm_page_content').on('click', '.bpm-media-upload', function(e){
                e.preventDefault();
                var button = $(this);
                var targetId = button.data('target');
                var frame = wp.media({ multiple: false });
                frame.on('select', function(){
                    var attachment = frame.state().get('selection').first().toJSON();
                    $('#' + targetId).val(attachment.url);
                    button.siblings('img').remove();
                    if (attachment.type === 'image') {
                        button.after('<br><img src=\"' + attachment.url + '\" style=\"max-width:200px;margin-top:8px;\">');
                    }
                });
                frame.open();
            });
        });
    " );
}
add_action( 'admin_enqueue_scripts', 'bpm_page_admin_scripts' );
