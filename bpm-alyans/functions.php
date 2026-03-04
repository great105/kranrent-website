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

// === SEO Meta Tags ===
function bpm_seo_meta_tags() {
    if ( is_front_page() ) {
        echo '<meta name="description" content="Аренда кранов с экипажем от БПМ Альянс. Опыт с 2007 года, работаем по всей Беларуси. Комплексно: управление, эксплуатация, проектирование и монтаж.">' . "\n";
        echo '<meta name="keywords" content="аренда кранов в Беларуси, аренда башенного крана Минск, аренда автокрана, гусеничный кран в аренду, кран с экипажем, БПМ Альянс, аренда техники Беларусь, услуги крана, машинист крана">' . "\n";
        echo '<meta property="og:url" content="https://bpm-alyans.by" />' . "\n";
        echo '<meta property="og:title" content="Аренда и эксплуатация кранов в Беларуси - БПМ Альянс" />' . "\n";
        echo '<meta property="og:description" content="С 2007 года оказываем услуги по аренде, управлению и эксплуатации башенных, автомобильных и гусеничных кранов по всей Беларуси. Техника с экипажем." />' . "\n";
    }
}
add_action( 'wp_head', 'bpm_seo_meta_tags', 1 );

// === Custom document title for front page ===
function bpm_custom_title( $title ) {
    if ( is_front_page() ) {
        $title['title'] = 'Аренда башенных и автомобильных кранов в Беларуси';
    }
    return $title;
}
add_filter( 'document_title_parts', 'bpm_custom_title' );

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
        'crane_capacity'     => array( 'label' => 'Грузоподъёмность', 'type' => 'text', 'placeholder' => '100 т' ),
        'crane_boom'         => array( 'label' => 'Вылет стрелы', 'type' => 'text', 'placeholder' => '60 м + гусёк 17,5 м' ),
        'crane_height'       => array( 'label' => 'Высота подъёма', 'type' => 'text', 'placeholder' => '37 м' ),
        'crane_manufacturer' => array( 'label' => 'Производитель', 'type' => 'text', 'placeholder' => 'Carlo Raimondi, Италия' ),
        'crane_description'  => array( 'label' => 'Описание крана', 'type' => 'textarea', 'placeholder' => 'Подробное описание...' ),
        'crane_price'        => array( 'label' => 'Цена', 'type' => 'text', 'placeholder' => 'от 2 360 BYN/смена' ),
        'crane_pdf'          => array( 'label' => 'PDF-спецификация (URL)', 'type' => 'file' ),
        'crane_scheme_1'     => array( 'label' => 'Изображение схемы 1 (URL)', 'type' => 'image' ),
        'crane_scheme_2'     => array( 'label' => 'Изображение схемы 2 (URL)', 'type' => 'image' ),
        'crane_is_new'       => array( 'label' => 'Бейдж «Новый»', 'type' => 'checkbox' ),
        'crane_anchor'       => array( 'label' => 'Якорь (ID для ссылки)', 'type' => 'text', 'placeholder' => 'sany-100t' ),
        'crane_sort_order'   => array( 'label' => 'Порядок сортировки', 'type' => 'number', 'placeholder' => '0' ),
    );

    echo '<table class="form-table"><tbody>';
    foreach ( $fields as $key => $field ) {
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

// === Flush rewrite rules on theme activation ===
function bpm_rewrite_flush() {
    bpm_register_news_cpt();
    bpm_register_news_taxonomy();
    bpm_register_crane_cpt();
    bpm_register_crane_type_taxonomy();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'bpm_rewrite_flush' );
