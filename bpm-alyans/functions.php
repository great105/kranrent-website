<?php
/**
 * БПМ Альянс Theme Functions
 */

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
        'default'           => 'г. Минск, ул. Красноармейская, д. 20А, офис 21',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bpm_address', array(
        'label'   => 'Адрес',
        'section' => 'bpm_contacts',
        'type'    => 'text',
    ) );

    // Full address with index
    $wp_customize->add_setting( 'bpm_address_full', array(
        'default'           => '220030, г. Минск, ул. Красноармейская, д. 20А, офис 21',
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

// === Disable Contact Form 7 CSS ===
add_filter( 'wpcf7_load_css', '__return_false' );

// === News posts per page ===
function bpm_news_posts_per_page( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'news' ) ) {
        $query->set( 'posts_per_page', 9 );
    }
}
add_action( 'pre_get_posts', 'bpm_news_posts_per_page' );

// === Flush rewrite rules on theme activation ===
function bpm_rewrite_flush() {
    bpm_register_news_cpt();
    bpm_register_news_taxonomy();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'bpm_rewrite_flush' );
