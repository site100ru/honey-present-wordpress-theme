<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900">
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <meta name="keywords" content="<?php bloginfo('name'); ?>" />
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
    <meta property="og:title" content="<?php bloginfo('name'); ?>" />

    <?php wp_head(); ?>
    <?php if ($counter_head = get_theme_mod('mytheme_counter_head')): ?>
        <!-- Код счетчика в (head) -->
        <?php echo $counter_head; ?>
    <?php endif; ?>
</head>

<body <?php body_class(); ?>>
    <!-- Home section -->
    <div id="sp-home" class="scroll-points"></div>
    <section class="main-home-section min-home">
        <section class="d-none d-lg-block">
            <!-- Header nav top -->
            <header class="d-block header-top py-0">
                <nav class="header-nav-top navbar navbar-expand-lg navbar-light d-none d-lg-block py-1 py-lg-0">
                    <div class="container">
                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav ms-auto align-items-center">
                                <?php if (get_theme_mod('mytheme_address')) : ?>
                                    <li class="nav-item menu-item-1">
                                        <div class="nav-link d-flex align-items-center gap-3 gap-md-2 gap-xl-3 lh-1 nav-link-text">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/location-ico.svg" />
                                            <?php echo esc_html(get_theme_mod('mytheme_address')); ?>
                                        </div>
                                    </li>
                                <?php endif; ?>

                                <?php if (get_theme_mod('mytheme_job_time')) : ?>
                                    <li class="nav-item menu-item-2">
                                        <div class="nav-link d-flex align-items-center gap-3 gap-md-2 gap-xl-3 lh-1 nav-link-text">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/clock-ico.svg" />
                                            <?php echo nl2br(esc_html(get_theme_mod('mytheme_job_time'))); ?>
                                        </div>
                                    </li>
                                <?php endif; ?>

                                <li class="nav-item menu-item-3">
                                    <button class="nav-link d-flex align-items-center gap-3 gap-md-2 gap-xl-3 lh-1" data-bs-toggle="modal" data-bs-target="#callbackModal">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/callback-ico.svg" />
                                        Обратный звонок
                                    </button>
                                </li>

                                <li class="nav-item menu-item-3">
                                    <button class="nav-link d-flex align-items-center gap-3 gap-md-2 gap-xl-3 lh-1" data-bs-toggle="modal" data-bs-target="#calculatePriceWithDownloadModal">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/calculator-ico.svg" />
                                        Рассчитать стоимость
                                    </button>
                                </li>

                                <?php
                                $phone_country = get_theme_mod('mytheme_main_phone_country_code');
                                $phone_region = get_theme_mod('mytheme_main_phone_region_code');
                                $phone_number = get_theme_mod('mytheme_main_phone_number');
                                if ($phone_country && $phone_region && $phone_number) :
                                    $phone_full = $phone_country . ' (' . $phone_region . ') ' . $phone_number;
                                    $phone_link = preg_replace('/[^0-9+]/', '', $phone_country . $phone_region . $phone_number);
                                ?>
                                    <li class="nav-item me-3 me-md-1 me-xl-5">
                                        <a class="top-menu-tel nav-link d-flex gap-3 gap-md-2 gap-xl-3" href="tel:<?php echo esc_attr($phone_link); ?>">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/mobile-phone-ico.svg" />
                                            <?php echo esc_html($phone_full); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (get_theme_mod('mytheme_telegram')) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link ico-button" href="<?php echo esc_url(get_theme_mod('mytheme_telegram')); ?>" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/telegram-ico.svg" />
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (get_theme_mod('mytheme_whatsapp')) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link ico-button" href="<?php echo esc_url(get_theme_mod('mytheme_whatsapp')); ?>" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/whatsapp-ico.svg" />
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </nav>

                <hr class="hr-top" />

                <nav class="header-nav-bottom navbar navbar-expand-lg navbar-light py-1 py-lg-0">
                    <div class="container">
                        <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/logo-light.svg" />
                        </a>

                        <button class="navbar-toggler mx-3 me-0 mx-lg-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mobail-header-collapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="mobail-header-collapse">
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'mobail-header-collapse',
                                'container' => false,
                                'menu_class' => 'navbar-nav align-items-start align-items-lg-center ms-auto mb-2 mb-lg-0',
                                'walker' => new bootstrap_5_wp_nav_menu_walker()
                            ]);
                            ?>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Sliding Header -->
            <header id="sliding-header" class="shadow">
                <nav class="header-nav-bottom navbar navbar-expand-lg navbar-light py-lg-0">
                    <div class="container">
                        <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/logo-dark.svg" />
                        </a>

                        <div class="d-lg-none">
                            <div class="d-none d-sm-block d-lg-none flex-column top-menu-tel-wrapper gap-1 my-2">
                                <?php if ($phone_country && $phone_region && $phone_number) : ?>
                                    <a class="top-menu-tel nav-link" href="tel:<?php echo esc_attr($phone_link); ?>">
                                        <?php echo esc_html($phone_full); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if (get_theme_mod('mytheme_job_time')) : ?>
                                    <p class="nav-link d-flex align-items-center gap-3 lh-1 mb-0" style="font-size: 14px">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/clock-ico.svg" />
                                        <?php echo nl2br(esc_html(get_theme_mod('mytheme_job_time'))); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <button class="navbar-toggler mx-3 me-0 mx-lg-auto" type="button" data-bs-toggle="collapse" data-bs-target="#sliding-header-collapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="sliding-header-collapse">
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'sliding-header-collapse',
                                'container' => false,
                                'menu_class' => 'navbar-nav align-items-start align-items-lg-center ms-auto mb-2 mb-lg-0',
                                'walker' => new bootstrap_5_wp_nav_menu_walker()
                            ]);
                            ?>
                        </div>
                    </div>
                </nav>
            </header>
        </section>

        <!-- Mobile Header (third one) -->
        <header id="sliding-header" class="shadow d-lg-none">
            <nav class="header-nav-bottom navbar navbar-expand-lg navbar-light py-lg-0">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/logo-dark.svg" />
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sliding-header-collapse-mobile">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="sliding-header-collapse-mobile">
                        <?php
                        ob_start();

                        wp_nav_menu([
                            'theme_location' => 'main-menu',
                            'container' => false,
                            'menu_id' => 'menu-main-menu',
                            'menu_class' => 'navbar-nav ms-auto mb-2 mb-lg-0',
                            'walker' => new bootstrap_5_wp_nav_menu_walker()
                        ]);

                        $menu_output = ob_get_clean();

                        // Добавляем дополнительные элементы ВНУТРЬ <ul> перед закрывающим </ul>
                        $additional_items = '
        <li class="nav-item d-lg-none">
            <button class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#callbackModal">Обратный звонок</button>
        </li>
        <li class="nav-item d-lg-none">
            <button class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#calculatePriceWithDownloadModal">Рассчитать стоимость</button>
        </li>';

                        if ($phone_country && $phone_region && $phone_number) :
                            $additional_items .= '
        <li class="nav-item d-lg-none me-2 mb-2">
            <a class="nav-link top-menu-tel" href="tel:' . esc_attr($phone_link) . '">
                ' . esc_html($phone_full) . '
            </a>
        </li>';
                        endif;

                        $additional_items .= '<li class="nav-item d-lg-none pb-4">';

                        if (get_theme_mod('mytheme_telegram')) :
                            $additional_items .= '
            <a class="ico-button pe-3 me-1" href="' . esc_url(get_theme_mod('mytheme_telegram')) . '">
                <img src="' . get_template_directory_uri() . '/img/ico/telegram-ico.svg" />
            </a>';
                        endif;

                        if (get_theme_mod('mytheme_whatsapp')) :
                            $additional_items .= '
            <a class="ico-button pe-2" href="' . esc_url(get_theme_mod('mytheme_whatsapp')) . '">
                <img src="' . get_template_directory_uri() . '/img/ico/whatsapp-ico.svg" />
            </a>';
                        endif;

                        $additional_items .= '</li>';

                        echo str_replace('</ul>', $additional_items . '</ul>', $menu_output);
                        ?>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Mobile Menu Extra Info -->
        <ul id="menu-main-menu-mobile" class="home-section-height-menu navbar-nav ms-auto mb-2 mb-lg-0 d-block d-lg-none">
            <div class="container home-section-height-menu-ul ps-2">
                <?php if (get_theme_mod('mytheme_address')) : ?>
                    <li class="nav-item d-lg-none" style="color: #c8c8c8">
                        <div class="mb-2" style="font-size: 14px; font-family: HelveticaNeueCyr; text-transform: none; font-weight: 300">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/location-ico.svg" style="width: 24px" class="me-2 mb-2" />
                            <span><?php echo esc_html(get_theme_mod('mytheme_address')); ?></span>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (get_theme_mod('mytheme_job_time')) : ?>
                    <li class="nav-item d-lg-none" style="color: #c8c8c8">
                        <div class="mb-2" style="font-size: 14px; font-family: HelveticaNeueCyr; text-transform: none; font-weight: 300">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/clock-ico.svg" style="width: 24px; position: relative; top: 2px" class="me-2 mb-2" />
                            <?php echo esc_html(get_theme_mod('mytheme_job_time')); ?>
                        </div>
                    </li>
                <?php endif; ?>

                <li class="nav-item d-lg-none d-flex me-2 mb-2">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/ico/callback-ico.svg" class="me-2" />
                    <button class="nav-link" style="color: #c8c8c8" data-bs-toggle="modal" data-bs-target="#callbackModal">Обратный звонок</button>
                </li>

                <li class="nav-item d-lg-none d-flex me-2 mb-2">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/ico/calculator-ico.svg" class="me-2" />
                    <button class="nav-link" style="color: #c8c8c8" data-bs-toggle="modal" data-bs-target="#calculatePriceWithDownloadModal">Рассчитать стоимость</button>
                </li>

                <?php if ($phone_country && $phone_region && $phone_number) : ?>
                    <li class="nav-item d-lg-none d-flex me-2 mb-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/mobile-phone-ico.svg" class="me-2" />
                        <a class="nav-link top-menu-tel pt-1 pb-1" style="color: #c8c8c8" href="tel:<?php echo esc_attr($phone_link); ?>">
                            <?php echo esc_html($phone_full); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item d-lg-none pb-4" style="color: #c8c8c8">
                    <?php if (get_theme_mod('mytheme_telegram')) : ?>
                        <a class="ico-button pe-3 me-1" href="<?php echo esc_url(get_theme_mod('mytheme_telegram')); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/telegram-ico.svg" />
                        </a>
                    <?php endif; ?>

                    <?php if (get_theme_mod('mytheme_whatsapp')) : ?>
                        <a class="ico-button pe-2" href="<?php echo esc_url(get_theme_mod('mytheme_whatsapp')); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/whatsapp-ico.svg" />
                        </a>
                    <?php endif; ?>
                </li>
            </div>
        </ul>

        <div class="container">
            <div class="row align-items-center home-section-height">
                <div class="col">
                    <div class="site-blocks-cover home-video-section">
                        <div class="video-wrapper">
                            <video autoplay="" loop="" playsinline="" muted="">
                                <source src="<?php echo get_template_directory_uri(); ?>/video/plot.mp4" />
                            </video>
                        </div>
                        <div
                            class="overlay"
                            style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.15) 35%, rgba(0, 0, 0, 0.15) 100%)"></div>
                    </div>
                    <h1 class="home-title home-title-main text-center text-lg-start mb-3 mb-xl-4 pb-0 pb-xl-3">
                        <?php echo get_the_title(); ?>
                    </h1>

                    <button class="btn btn-corporate-color-1 mb-4 text-center text-md-start home-download" data-bs-toggle="modal" data-bs-target="#downloadModal">Скачать каталог</button>


                    <!--                     <a href="<?php echo get_template_directory_uri(); ?>/pdf/catalog_new_compressed.pdf" class="btn btn-corporate-color-1 mb-4 text-center text-md-start home-download" download="">
                        Скачать каталог
                    </a> -->
                </div>
            </div>
        </div>
    </section>