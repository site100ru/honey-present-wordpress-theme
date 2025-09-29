<?php

/**
 * Theme Functions
 */

/* Bootstrap 5 wp_nav_menu walker */
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
    private $current_item;
    private $dropdown_menu_alignment_values = [
        'dropdown-menu-start',
        'dropdown-menu-end',
        'dropdown-menu-sm-start',
        'dropdown-menu-sm-end',
        'dropdown-menu-md-start',
        'dropdown-menu-md-end',
        'dropdown-menu-lg-start',
        'dropdown-menu-lg-end',
        'dropdown-menu-xl-start',
        'dropdown-menu-xl-end',
        'dropdown-menu-xxl-start',
        'dropdown-menu-xxl-end'
    ];

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $dropdown_menu_class[] = '';
        foreach ($this->current_item->classes as $class) {
            if (in_array($class, $this->dropdown_menu_alignment_values)) {
                $dropdown_menu_class[] = $class;
            }
        }
        $indent = str_repeat("\t", $depth);
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ", $dropdown_menu_class)) . " depth_$depth\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {

        if (is_array($args)) {
            $args = (object) $args;
        }

        $this->current_item = $item;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        // Проверяем, что $item->classes является массивом
        $item_classes = is_array($item->classes) ? $item->classes : array();

        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if ($depth && $args->walker->has_children) {
            $classes[] = 'dropdown-menu dropdown-menu-end';
        }

        // Объединяем с классами элемента
        $classes = array_merge($classes, $item_classes);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';


        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';


        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item_classes, true) || in_array("current-post-ancestor", $item_classes, true)) ? 'active' : '';
        $nav_link_class = ($depth > 0) ? 'dropdown-item header-link ' : 'nav-link header-link ';
        $attributes .= ($args->walker->has_children) ? ' class="' . $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="' . $nav_link_class . $active_class . '"';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

        // Показываем точки в меню, первый вариант
        $item_title = $item->title;
        $dropdown = in_array('dropdown', $classes);
        if ($item_title == 'Контакты') {
            $output .= '
					<li class="nav-item d-none">
						<span class="nav-link">
							<img src="' . get_template_directory_uri() . '/img/ico/menu-decoration-point.svg" alt="">
						</span>
					</li>
				';
        } else if ($dropdown == false and $depth == 0) {
            $output .= '
					<li class="nav-item d-none d-xl-inline">
						<span class="nav-link">
							<img src="' . get_template_directory_uri() . '/img/ico/menu-decoration-point.svg" alt="">
						</span>
					</li>
				';
        }
    }
}
/* End Bootstrap 5 wp_nav_menu walker */


/* Register a new menu */
add_action('after_setup_theme', function () {
    register_nav_menus([
        'main-menu' => 'Main menu',
        'mobail-header-collapse' => 'Mobail header collapse',
        'sliding-header-collapse' => 'Sliding header collapse',
        'contacts-desktop-menu' => 'Contacts desktop menu',
        'navbarSupportedContent2' => 'navbarSupportedContent2',
        'footer-menu-1' => 'footer-menu-1',
        'footer-menu-2' => 'footer-menu-2'
    ]);
});
/* End register a new menu */

// Add theme support
add_theme_support('post-thumbnails');
add_theme_support('title-tag');

// Register Custom Post Types
add_action('init', 'register_custom_post_types');
function register_custom_post_types()
{
    // Подарки (Product Cards)
    register_post_type('product_card', [
        'label' => null,
        'labels' => [
            'name' => 'Подарки',
            'singular_name' => 'Подарок',
            'add_new' => 'Добавить подарок',
            'add_new_item' => 'Добавление подарка',
            'edit_item' => 'Редактирование подарка',
            'new_item' => 'Новый подарок',
            'view_item' => 'Смотреть подарок',
            'search_items' => 'Искать подарок',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'menu_name' => 'Подарки',
        ],
        'public' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-gifts',
        'menu_position' => 20,
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => false,
        'rewrite' => false,
        'query_var' => false,
    ]);

    // Сертификаты (Certificates)
    register_post_type('certificate', [
        'label' => null,
        'labels' => [
            'name' => 'Сертификаты',
            'singular_name' => 'Сертификат',
            'add_new' => 'Добавить сертификат',
            'add_new_item' => 'Добавление сертификата',
            'edit_item' => 'Редактирование сертификата',
            'new_item' => 'Новый сертификат',
            'view_item' => 'Смотреть сертификат',
            'search_items' => 'Искать сертификат',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'menu_name' => 'Сертификаты',
        ],
        'public' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-awards',
        'menu_position' => 21,
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => false,
        'rewrite' => false,
        'query_var' => false,
    ]);

    // Партнеры (Partners)
    register_post_type('partners', [
        'label' => null,
        'labels' => [
            'name' => 'Партнеры',
            'singular_name' => 'Партнер',
            'add_new' => 'Добавить партнера',
            'add_new_item' => 'Добавление партнера',
            'edit_item' => 'Редактирование партнера',
            'new_item' => 'Новый партнер',
            'view_item' => 'Смотреть партнера',
            'search_items' => 'Искать партнера',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'menu_name' => 'Партнеры',
        ],
        'public' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-groups',
        'menu_position' => 22,
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => false,
        'rewrite' => false,
        'query_var' => false,
    ]);
}

/*** ДОБАВЛЯЕМ ВОЗМОЖНОСТЬ В НАСТРОЙКАХ ТЕМЫ ДОБАВИТЬ КОНТАКТЫ И КОД СЧЕТЧИКА ***/
function mytheme_customize_register($wp_customize)
{
    // Добавляем секцию
    $wp_customize->add_section('mytheme_analytics', array(
        'title' => 'Аналитика и счетчики',
        'priority' => 200,
    ));

    // Поле для кода счетчика (head)
    $wp_customize->add_setting('mytheme_counter_head', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_counter_head', array(
        'label' => 'Код счетчика (в <head>)',
        'description' => 'Вставьте код, который должен быть в <head> (например, Google Analytics, Meta Pixel)',
        'section' => 'mytheme_analytics',
        'type' => 'textarea',
    ));

    // Поле для кода счетчика (body)
    $wp_customize->add_setting('mytheme_counter_body', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_counter_body', array(
        'label' => 'Код счетчика (перед </body>)',
        'description' => 'Вставьте код, который должен быть перед закрывающим тегом </body> (например, Яндекс.Метрика)',
        'section' => 'mytheme_analytics',
        'type' => 'textarea',
    ));

    /** КОНТАКТЫ **/
    $wp_customize->add_panel('contact_panel', array(
        'title' => 'Контакты',
        'description' => 'Описание контактов',
        'priority' => 205,
    ));

    // Основной номер телефона
    $wp_customize->add_section('mytheme_contacts', array(
        'title' => 'Основной номер телефона',
        'panel' => 'contact_panel',
        'priority' => 5
    ));

    $wp_customize->add_setting('mytheme_main_phone_country_code', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_main_phone_country_code', array(
        'label' => 'Код страны',
        'description' => 'Например: 8 или +7',
        'section' => 'mytheme_contacts',
        'type' => 'text',
    ));

    $wp_customize->add_setting('mytheme_main_phone_region_code', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_main_phone_region_code', array(
        'label' => 'Код региона',
        'description' => 'Например: 800',
        'section' => 'mytheme_contacts',
        'type' => 'text',
    ));

    $wp_customize->add_setting('mytheme_main_phone_number', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_main_phone_number', array(
        'label' => 'Номер телефона',
        'description' => 'Например: 880-80-88',
        'section' => 'mytheme_contacts',
        'type' => 'text',
    ));

    // Email
    $wp_customize->add_section('mytheme_contacts_email', array(
        'title' => 'Email',
        'panel' => 'contact_panel',
        'priority' => 6
    ));

    $wp_customize->add_setting('mytheme_email', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_email', array(
        'label' => 'Email',
        'section' => 'mytheme_contacts_email',
        'type' => 'email',
    ));

    // Telegram
    $wp_customize->add_section('mytheme_contacts_telegram', array(
        'title' => 'Telegram',
        'panel' => 'contact_panel',
        'priority' => 7
    ));

    $wp_customize->add_setting('mytheme_telegram', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_telegram', array(
        'label' => 'Telegram',
        'description' => 'Укажите ссылку на Telegram',
        'section' => 'mytheme_contacts_telegram',
        'type' => 'url',
    ));

    // WhatsApp
    $wp_customize->add_section('mytheme_contacts_whatsapp', array(
        'title' => 'WhatsApp',
        'panel' => 'contact_panel',
        'priority' => 8
    ));

    $wp_customize->add_setting('mytheme_whatsapp', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_whatsapp', array(
        'label' => 'WhatsApp',
        'description' => 'Укажите ссылку на WhatsApp',
        'section' => 'mytheme_contacts_whatsapp',
        'type' => 'url',
    ));

    // Адрес
    $wp_customize->add_section('mytheme_contacts_address', array(
        'title' => 'Адрес',
        'panel' => 'contact_panel',
        'priority' => 9
    ));

    $wp_customize->add_setting('mytheme_address', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_address', array(
        'label' => 'Адрес',
        'description' => 'Укажите адрес организации',
        'section' => 'mytheme_contacts_address',
        'type' => 'text',
    ));

    // Время работы
    $wp_customize->add_section('mytheme_contacts_job_time', array(
        'title' => 'Время работы',
        'panel' => 'contact_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('mytheme_job_time', array(
        'default' => '',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('mytheme_job_time', array(
        'label' => 'Время работы',
        'description' => 'Укажите время работы',
        'section' => 'mytheme_contacts_job_time',
        'type' => 'text',
    ));
}
add_action('customize_register', 'mytheme_customize_register');

// Enqueue styles and scripts
function mytheme_enqueue_assets()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/theme.css');
    wp_enqueue_style('glide', get_template_directory_uri() . '/css/glide.core.min.css');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), null, true);
    wp_enqueue_script('jquery-custom', get_template_directory_uri() . '/js/jquery-1.5.1.min.js', array(), null, true);
    wp_enqueue_script('glide', get_template_directory_uri() . '/js/glide.min.js', array(), null, true);
    wp_enqueue_script('glide-init', get_template_directory_uri() . '/js/about/glide-init.js', array('glide'), null, true);
    wp_enqueue_script('inputmask', get_template_directory_uri() . '/js/inputmask.min.js', array(), null, true);
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/js/theme.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');
