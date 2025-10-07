<?php

/**
 * Template Name: Главная страница с картинкой
 */
?>
<!-- HEADER -->
<?php get_header(); ?>

<!-- ABOUT SECTION -->
<?php get_template_part('template-parts/about-section/about-section'); ?>

<!-- SECTION: ПОДАРКИ -->
<div id="sp-gifts" class="scroll-points"></div>
<section class="section bg-light section-gifts">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Наши душевные подарки</h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/section-title-dec.svg" alt="Декор" class="img-fluid section-decor">
            </div>
        </div>

        <div class="text-md-center gifts-description">
            <p>Укрепите имидж вашей компании с помощью душевных и статусных подарков от пасеки «Мёд от деда Димы».</p>

            <p>
                Мы создадим для вас уникальные подарочные бочонки из цельного ствола дерева (липа) с нанесением вашего логотипа или фирменной символики
                и наполним их душистым медом сорта «Лесное разнотравье».
            </p>

            <p>Это не просто сувенир, а выражение заботы о партнерах и сотрудниках.</p>
        </div>

        <?php
        $gifts = new WP_Query([
            'post_type' => 'product_card',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ]);

        if ($gifts->have_posts()) : ?>
            <div class="glide" id="section-gifts">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <?php $index = 0;
                        while ($gifts->have_posts()) : $gifts->the_post();
                            $index++; ?>
                            <li class="glide__slide text-center">
                                <a onclick="giftsSectionGalleryOn('giftsSectionGallery','imgGiftsSectionGallery-<?php echo $index; ?>');" style="cursor: pointer">
                                    <div class="single-product-img approximation">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" class="img-fluid" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                        <div class="magnifier"></div>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left btn-carousel-left" data-glide-dir="<">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/arrow-left.svg" alt="">
                    </button>
                    <button class="glide__arrow glide__arrow--right btn-carousel-right" data-glide-dir=">">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/arrow-right.svg" alt="">
                    </button>
                </div>
            </div>

            <!-- Модальное окно для подарков -->
            <div id="giftsSectionGalleryWrapper" style="display: none">
                <div id="giftsSectionGallery" class="carousel slide" data-bs-ride="false" data-bs-interval="false" style="display: none; position: fixed; top: 0; left: 0; height: 100%; width: 100%; z-index: 99999; background: rgba(0, 0, 0, 0.9)">
                    <div class="carousel-indicators">
                        <?php $index = 0;
                        while ($gifts->have_posts()) : $gifts->the_post();
                            $index++; ?>
                            <button id="indGiftsSectionGallery-<?php echo $index; ?>" type="button" data-bs-target="#giftsSectionGallery" data-bs-slide-to="<?php echo $index - 1; ?>" aria-label="Slide <?php echo $index; ?>"></button>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                    <div class="carousel-inner h-100">
                        <?php $index = 0;
                        while ($gifts->have_posts()) : $gifts->the_post();
                            $index++; ?>
                            <div id="imgGiftsSectionGallery-<?php echo $index; ?>" class="carousel-item h-100">
                                <div class="row align-items-center h-100">
                                    <div class="col text-center">
                                        <?php the_post_thumbnail('full', ['class' => 'img-fluid lazyload', 'style' => 'max-width: 90vw; max-height: 90vh']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#giftsSectionGallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#giftsSectionGallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
                <button type="button" onclick="giftsSectionGalleryClose();" class="btn-close btn-close-white" style="position: fixed; top: 25px; right: 25px; z-index: 99999"></button>
            </div>
        <?php endif;
        wp_reset_postdata(); ?>
    </div>
</section>

<section id="video" class="bg-white">
    <div id="video-container" class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Медовые истории</h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/section-title-dec.svg" alt="Пчелки между секциями" class="img-fluid section-decor" />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Контейнер с фиксированной высотой -->
                <div class="video-wrapper" style="position: relative; height: 480px; overflow: hidden; border-radius: 8px">
                    <video
                        id="video-player"
                        class="rounded"
                        style="width: 100%; height: 100%; object-fit: cover"
                        playsinline="playsinline"
                        loop="loop"
                        poster="<?php echo get_template_directory_uri(); ?>/img/video-poster.jpg">
                        <source src="<?php echo get_template_directory_uri(); ?>/video/plot.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                    </video>
                    <div id="play-circle" onclick="play();">
                        <div id="play" onclick="play();"></div>
                    </div>
                    <div id="stop-circle" onclick="pause();">
                        <div>
                            <i class="far fa-stop-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function play() {
        document.getElementById('video-player').play();
        document.getElementById('play-circle').style.display = 'none';
        document.getElementById('stop-circle').style.display = 'block';
    }

    function pause() {
        document.getElementById('video-player').pause();
        document.getElementById('stop-circle').style.display = 'none';
        document.getElementById('play-circle').style.display = 'block';
    }
</script>

<!-- По семейному: честно и душевно -->
<section class="hexagon-section section bg-light">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>По семейному: честно и душевно</h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/section-title-dec.svg" alt="Пчелки между секциями" class="img-fluid section-decor" />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="honeycomb-text-section">
                    <!-- ПК и мобильная версия -->
                    <div class="honeycomb-text-container">
                        <div class="hexagon-item">
                            <div class="hexagon">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-1.png" alt="Соты 1" />
                            </div>
                            <h3 class="hexagon-text">
                                Собственная пасека<br />
                                с 1880 года
                            </h3>
                        </div>
                        <div class="hexagon-item">
                            <div class="hexagon">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-2.png" alt="Соты 2" />
                            </div>
                            <h3 class="hexagon-text">Срок поставки <br />от 3 дней</h3>
                        </div>
                        <div class="hexagon-item">
                            <div class="hexagon">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-3.png" alt="Соты 3" />
                            </div>
                            <h3 class="hexagon-text">100+ реализованных <br />проектов</h3>
                        </div>
                        <div class="hexagon-item">
                            <div class="hexagon">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-4.png" alt="Соты 4" />
                            </div>
                            <h3 class="hexagon-text">
                                Удобные способы <br />
                                оплаты
                            </h3>
                        </div>
                        <div class="hexagon-item">
                            <div class="hexagon">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-5.png" alt="Соты 5" />
                            </div>
                            <h3 class="hexagon-text">Доставка и разгрузка</h3>
                        </div>
                    </div>

                    <!-- Планшетная версия -->
                    <div class="tablet-layout">
                        <div class="tablet-column">
                            <div class="hexagon-item">
                                <div class="hexagon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-1.png" alt="Соты 1" />
                                </div>
                                <h3 class="hexagon-text">
                                    Собственная пасека <br />
                                    с 1880 года
                                </h3>
                            </div>
                            <div class="hexagon-item">
                                <div class="hexagon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-2.png" alt="Соты 2" />
                                </div>
                                <h3 class="hexagon-text">Срок поставки <br />от 3 дней</h3>
                            </div>
                            <div class="hexagon-item">
                                <div class="hexagon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-3.png" alt="Соты 3" />
                                </div>
                                <h3 class="hexagon-text">100+ реализованных <br />проектов</h3>
                            </div>
                        </div>
                        <div class="tablet-column">
                            <div class="hexagon-item">
                                <div class="hexagon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-4.png" alt="Соты 4" />
                                </div>
                                <h3 class="hexagon-text">Удобные способы <br />оплаты</h3>
                            </div>
                            <div class="hexagon-item">
                                <div class="hexagon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-img-5.png" alt="Соты 5" />
                                </div>
                                <h3 class="hexagon-text">Доставка и разгрузка</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /По семейному: честно и душевно -->

<section class="section order-left-gradient-section bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2>Загляните в нашу мастерскую подарков</h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/section-title-dec.svg" alt="Пчелки между секциями" class="img-fluid section-decor" />

                <p class="order-description">
                    Познакомьтесь с нашим ассортиментом в новом каталоге. Мы постоянно придумываем новые и индивидуальные решения решения, чтобы дарить
                    вам радость. Чтобы получить каталог и узнать обо всех идеях для сладких подарков, просто напишите нам.
                </p>

                <a href="<?php echo get_template_directory_uri(); ?>/pdf/catalog_new_compressed.pdf" class="btn btn-lg btn-corporate-color-1 mb-4 mb-lg-0" download> Скачать каталог </a>
            </div>
            <div class="col-lg-6"></div>
        </div>
    </div>
    <img src="<?php echo get_template_directory_uri(); ?>/img/gradient-order-section-bg-1.jpg" class="w-100 d-lg-none" />
</section>

<section class="hexagon-section section bg-light">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Лучший подарок, конечно же, - мед!</h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/section-title-dec.svg" alt="Пчелки между секциями" class="img-fluid section-decor" />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="honeycomb-container">
                    <div class="row">
                        <div class="hexagon">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-1.png" alt="Соты 1" />
                        </div>
                        <div class="hexagon">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-2.png" alt="Соты 2" />
                        </div>
                        <div class="hexagon">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-3.png" alt="Соты 3" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="hexagon">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-4.png" alt="Соты 4" />
                        </div>
                        <div class="hexagon">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-5.png" alt="Соты 5" />
                        </div>
                        <div class="hexagon">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/sot/sot-6.png" alt="Соты 6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="reviews-section section">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Отзывы о нас в независимых источниках</h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/section-title-dec.svg" alt="Пчелки между секциями" class="img-fluid section-decor" />
            </div>
        </div>

        <div class="row">
            <div class="col text-center mb-3 pb-4">
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/yandex-logo.svg" class="mb-3" />
                <div class="review-rating mb-3 d-flex align-items-md-end justify-content-center gap-4">
                    <div>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                    </div>
                    <p class="mb-0" style="font-size: 18px; line-height: 1">4,9 из 5</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Отзыв 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="review-card rounded h-100">
                    <div class="review-header d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                        <div class="review-photo me-3">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/avatar.svg" alt="ООО «ВекторТех»" class="rounded-circle" width="50" height="50" />
                        </div>
                        <div class="review-info">
                            <p class="review-title mb-0">ООО «ВекторТех»</p>
                            <p class="review-date text-muted small mb-0">24 декабря 2024</p>
                        </div>
                    </div>

                    <div class="review-rating mb-3 text-center text-md-start">
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                    </div>

                    <div class="review-text">
                        <p class="mb-0">
                            «В этом году решили отойти от стандартных новогодних наборов и заказали для нашего дружного коллектива вот такие душевные
                            бочонки с мёдом.
                        </p>
                        <div class="collapse" id="review1">
                            <p class="mb-0">
                                Мёд — просто наивкуснейший, настоящий, чувствуется, что продукт высшего качества. Отдельно хотим отметить скорость:
                                заказ был крупным, а бочонки пришли очень быстро, упакованные с заботой, мы успели всё подготовить к праздникам.
                                Сотрудники были в полном восторге, многие сказали, что это лучший и самый экологичный подарок! Обязательно обратимся к
                                вам ещё в следующем году.»
                            </p>
                        </div>
                        <a class="btn btn-link btn-link-review p-0 text-decoration-none" data-bs-toggle="collapse" href="#review1">Читать далее</a>
                    </div>
                </div>
            </div>

            <!-- Отзыв 2 -->
            <div class="col-lg-4 col-md-6  mt-4 mt-md-0">
                <div class="review-card rounded h-100">
                    <div class="review-header d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                        <div class="review-photo me-3">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/avatar.svg" alt="Иван Петров" class="rounded-circle" width="50" height="50" />
                        </div>
                        <div class="review-info">
                            <p class="review-title mb-0">Иван Петров</p>
                            <p class="review-date text-muted small mb-0">20 декабря 2024</p>
                        </div>
                    </div>

                    <div class="review-rating mb-3 text-center text-md-start">
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                    </div>

                    <div class="review-text">
                        <p class="mb-0">
                            «Искали статусный и запоминающийся подарок нашим ключевым партнёрам по случаю 15-летия компании. Остановились на бочонках с
                            гравировкой нашего логотипа. Результат превзошёл все ожидания! Бочонки смотрятся солидно, гравировка выполнена
                        </p>
                        <div class="collapse" id="review2">
                            <p class="mb-0">Искали статусный и запоминающийся подарок нашим ключевым партнёрам по случаю 15-летия компании.»</p>
                        </div>
                        <a class="btn btn-link btn-link-review p-0 text-decoration-none" data-bs-toggle="collapse" href="#review2">Читать далее</a>
                    </div>
                </div>
            </div>

            <!-- Отзыв 3 -->
            <div class="col-lg-4 col-md-6  mt-4 mt-md-0">
                <div class="review-card rounded h-100">
                    <div class="review-header d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                        <div class="review-photo me-3">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/ico/avatar.svg" alt="Иван Петров" class="rounded-circle" width="50" height="50" />
                        </div>
                        <div class="review-info">
                            <p class="review-title mb-0">Иван Петров</p>
                            <p class="review-date text-muted small mb-0">20 декабря 2024</p>
                        </div>
                    </div>

                    <div class="review-rating mb-3 text-center text-md-start">
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                        <i class="star-filled"><img src="<?php echo get_template_directory_uri(); ?>/img/ico/stars.svg" alt="stars" /></i>
                    </div>

                    <div class="review-text">
                        <p class="mb-0">
                            «Хотели поздравить наших прекрасных сотрудниц с 8 Марта чем-то тёплым, натуральным и полезным. Ваши медовые наборы в
                            маленьких бочонках стали идеальным решением! Девушки были безумно рады, особенно оценили качество
                        </p>
                        <div class="collapse" id="review3">
                            <p class="mb-0">
                                Хотели поздравить наших прекрасных сотрудниц с 8 Марта чем-то тёплым, натуральным и полезным. Ваши медовые наборы в
                                маленьких бочонках стали идеальным решением!»
                            </p>
                        </div>
                        <a class="btn btn-link btn-link-review p-0 text-decoration-none" data-bs-toggle="collapse" href="#review3">Читать далее</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Кнопка "Показать все отзывы" -->
<!--         <div class="row text-center mt-3 pt-4">
            <div class="col">
                <a href="https://yandex.ru/" target="_blank" class="btn btn-corporate-color-1">Все отзывы</a>
            </div>
        </div> -->
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Для каждого collapse элемента
        document.querySelectorAll('.collapse').forEach(function(collapseElement) {
            const toggleBtn = document.querySelector('[href="#' + collapseElement.id + '"]');

            if (toggleBtn) {
                collapseElement.addEventListener('show.bs.collapse', function() {
                    toggleBtn.textContent = 'Скрыть';
                });

                collapseElement.addEventListener('hide.bs.collapse', function() {
                    toggleBtn.textContent = 'Читать далее';
                });
            }
        });
    });
</script>


<!-- SECTION: БЛАГОДАРНОСТИ (СЕРТИФИКАТЫ) -->
<div id="sp-clients" class="scroll-points"></div>
<section class="section bg-image bg-light section-certificates">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Благодарности наших клиентов</h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/section-title-dec.svg" alt="Декор" class="img-fluid section-decor">
            </div>
        </div>

        <?php
        $certificates = new WP_Query([
            'post_type' => 'certificate',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ]);

        if ($certificates->have_posts()) : ?>
            <div class="glide" id="certificates-glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <?php $index = 0;
                        while ($certificates->have_posts()) : $certificates->the_post();
                            $index++; ?>
                            <li class="glide__slide text-center">
                                <a onclick="certificatesSectionGalleryOn('certificatesSectionGallery','imgCertificatesSectionGallery-<?php echo $index; ?>');" style="cursor: pointer">
                                    <div class="single-product-img approximation">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
                                        <?php endif; ?>
                                        <div class="magnifier"></div>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left btn-carousel-left" data-glide-dir="<">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/arrow-left.svg" alt="">
                    </button>
                    <button class="glide__arrow glide__arrow--right btn-carousel-right" data-glide-dir=">">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/arrow-right.svg" alt="">
                    </button>
                </div>
            </div>

            <!-- Модальное окно для сертификатов -->
            <div id="certificatesSectionGalleryWrapper" style="display: none">
                <div id="certificatesSectionGallery" class="carousel slide" data-bs-ride="false" data-bs-interval="false" style="display: none; position: fixed; top: 0; left: 0; height: 100%; width: 100%; z-index: 99999; background: rgba(0, 0, 0, 0.9)">
                    <div class="carousel-indicators">
                        <?php $index = 0;
                        while ($certificates->have_posts()) : $certificates->the_post();
                            $index++; ?>
                            <button id="indCertificatesSectionGallery-<?php echo $index; ?>" type="button" data-bs-target="#certificatesSectionGallery" data-bs-slide-to="<?php echo $index - 1; ?>"></button>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                    <div class="carousel-inner h-100">
                        <?php $index = 0;
                        while ($certificates->have_posts()) : $certificates->the_post();
                            $index++; ?>
                            <div id="imgCertificatesSectionGallery-<?php echo $index; ?>" class="carousel-item h-100">
                                <div class="row align-items-center h-100">
                                    <div class="col text-center">
                                        <?php the_post_thumbnail('full', ['class' => 'img-fluid lazyload', 'style' => 'max-width: 90vw; max-height: 90vh']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#certificatesSectionGallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#certificatesSectionGallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
                <button type="button" onclick="certificatesSectionGalleryClose();" class="btn-close btn-close-white" style="position: fixed; top: 25px; right: 25px; z-index: 99999"></button>
            </div>
        <?php endif;
        wp_reset_postdata(); ?>
    </div>
</section>

<!-- SECTION: ПАРТНЕРЫ -->
<section class="section section-glide text-dark">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Наши партнеры</h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/section-title-dec.svg" alt="Декор" class="img-fluid section-decor">
            </div>
        </div>

        <?php
        $partners = new WP_Query([
            'post_type' => 'partners',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ]);

        if ($partners->have_posts()) : ?>
            <div class="glide" id="partners-glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <?php while ($partners->have_posts()) : $partners->the_post(); ?>
                            <li class="glide__slide text-center">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
                                <?php endif; ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left btn-carousel-left" data-glide-dir="<">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/arrow-left.svg" alt="">
                    </button>
                    <button class="glide__arrow glide__arrow--right btn-carousel-right" data-glide-dir=">">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/arrow-right.svg" alt="">
                    </button>
                </div>
            </div>
        <?php endif;
        wp_reset_postdata(); ?>
    </div>
</section>

<!-- FOOTER -->
<?php get_footer(); ?>

<?php wp_footer(); ?>
<?php echo get_theme_mod('mytheme_counter_body', ''); ?>

<script>
    vyezjalo();
</script>
</body>

</html>