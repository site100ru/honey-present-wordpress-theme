<!-- CONTACTS SECTION -->
<div id="sp-contacts" class="scroll-points"></div>
<section class="section text-dark bg-light section-about section-grid">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="text-dark">Как с нами связаться</h2>
        </div>

        <div class="row mb-3 section-contacts contacts">
            <!-- Адрес и время работы -->
            <div class="col-12 col-md-6 col-xl-4 mb-0 mb-md-4">
                <?php if (get_theme_mod('mytheme_address')) : ?>
                    <div class="d-flex align-items-center mb-4 pb-md-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/location-ico.svg" alt="Адрес" class="me-3 img-fluid" />
                        <p class="mb-0 text-min-text"><?php echo esc_html(get_theme_mod('mytheme_address')); ?></p>
                    </div>
                <?php endif; ?>

                <?php if (get_theme_mod('mytheme_job_time')) : ?>
                    <div class="d-flex align-items-center mb-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/clock-ico.svg" alt="Время работы" class="me-3 img-fluid" />
                        <p class="mb-0 text-min-text"><?php echo esc_html(get_theme_mod('mytheme_job_time')); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Телефон и Email -->
            <div class="col-12 col-md-6 col-xl-4 mb-0 mb-md-4">
                <?php
                $phone_country = get_theme_mod('mytheme_main_phone_country_code');
                $phone_region = get_theme_mod('mytheme_main_phone_region_code');
                $phone_number = get_theme_mod('mytheme_main_phone_number');
                if ($phone_country && $phone_region && $phone_number) :
                    $phone_full = $phone_country . ' (' . $phone_region . ') ' . $phone_number;
                    $phone_link = preg_replace('/[^0-9+]/', '', $phone_country . $phone_region . $phone_number);
                ?>
                    <div class="d-flex align-items-center mb-4 pb-md-3 flex-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/mobile-phone-ico.svg" alt="Телефон" class="me-3 img-fluid" />
                        <a href="tel:<?php echo esc_attr($phone_link); ?>" class="text-decoration-none"><?php echo esc_html($phone_full); ?></a>
                    </div>
                <?php endif; ?>

                <?php if (get_theme_mod('mytheme_email')) : ?>
                    <div class="d-flex align-items-center mb-4 flex-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/email-ico.svg" alt="Email" class="me-3 img-fluid" />
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('mytheme_email')); ?>" class="text-decoration-none"><?php echo esc_html(get_theme_mod('mytheme_email')); ?></a>
                    </div>
                <?php endif; ?>
            </div>

           <!-- Кнопки обратного звонка -->
            <div class="col-12 col-md-6 col-xl-4 mb-0 mb-md-4">
                <div class="d-flex align-items-center mb-4 pb-md-3">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/ico/callback-ico.svg" alt="Обратный звонок" class="me-3 img-fluid" />
                    <button class="nav-link d-flex align-items-center gap-3 gap-md-2 gap-xl-3 lh-1" data-bs-toggle="modal" data-bs-target="#callbackModal">
                        Обратный звонок
                    </button>
                </div>

                <!-- Кнопки обратного звонка -->
                <div class="d-flex align-items-center mb-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/ico/calculator-ico.svg" alt="Адрес" class="me-3 img-fluid" />

                    <button
                        class="nav-link d-flex align-items-center gap-3 gap-md-2 gap-xl-3 lh-1"
                        data-bs-toggle="modal"
                        data-bs-target="#calculatePriceWithDownloadModal">
                        Рассчитать стоимость
                    </button>
                </div>
            </div>
        </div>

        <!-- Социальные сети -->
        <div class="d-flex justify-content-center gap-4 flex-wrap social mt-3 pt-4">
            <?php if (get_theme_mod('mytheme_whatsapp')) : ?>
                <a class="ico-button" href="<?php echo esc_url(get_theme_mod('mytheme_whatsapp')); ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/ico/whatsapp-ico.svg" alt="WhatsApp" style="width: 40px" />
                </a>
            <?php endif; ?>

            <?php if (get_theme_mod('mytheme_telegram')) : ?>
                <a class="ico-button" href="<?php echo esc_url(get_theme_mod('mytheme_telegram')); ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/ico/telegram-ico.svg" alt="Telegram" style="width: 40px" />
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FOOTER NAVIGATION -->
<section class="contacts-section-4">
    <div class="container py-5 d-none d-xl-block">
        <div class="row align-items-center">
            <div class="col-xl-2">
                <a href="<?php echo home_url('/'); ?>">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/ico/logo-light.svg" class="img-fluid" alt="<?php bloginfo('name'); ?>" />
                    <?php endif; ?>
                </a>
            </div>
            <div class="col-xl-10">
                <?php
                wp_nav_menu([
                    'theme_location' => 'contacts-desktop-menu',
                    'container' => false,
                    'menu_class' => 'nav justify-content-end',
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                ]);
                ?>
            </div>
        </div>
    </div>
	
	<!-- Mobile version -->
	<div class="container d-xl-none">
		<div class="row">
			<div class="col py-5">
				<a href="<?php echo home_url('/'); ?>" class="mx-auto">
					<?php if (has_custom_logo()) : ?>
					<?php the_custom_logo(); ?>
					<?php else : ?>
					<img id="navbar-brand-img" src="<?php echo get_template_directory_uri(); ?>/img/ico/logo-light.svg" class="img-fluid" />
					<?php endif; ?>
				</a>
				<?php
				wp_nav_menu([
					'theme_location' => 'contacts-desktop-menu',
					'container' => false,
					'menu_class' => 'nav nav-mobile justify-content-end flex-column align-content-center pt-5',
					'walker' => new bootstrap_5_wp_nav_menu_walker()
				]);
				?>
			</div>
		</div>
	</div>
	<!-- /Mobile version -->

    <!-- Footer Copyright -->
    <footer style="padding: 29px 0">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div id="im-in-footer">
                        Создание и продвижение сайтов:
                        <a href="https://site100.ru" class="text-light">site100.ru</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</section>

<!-- Callback Modal -->
<div class="modal fade" id="callbackModal" tabindex="-1" aria-labelledby="callbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="post" action="<?php echo get_template_directory_uri(); ?>/mails/callback-mail.php" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="callbackModalLabel">Обратный звонок</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <p><small>Мы свяжемся с Вами в течение 10 минут и ответим на все вопросы!</small></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <input type="text" name="name" class="form-control" placeholder="Ваше имя" required />
                    </div>
                    <div class="col-md-6">
                        <input type="tel" name="tel" class="form-control telMask" placeholder="Ваш телефон*" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-lg btn btn-corporate-color-1 mx-auto">
                    Жду звонка
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Callback Modal -->
<div class="modal fade" id="calculatePriceWithDownloadModal" tabindex="-1" aria-labelledby="calculatePriceWithDownloadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="post" action="<?php echo get_template_directory_uri(); ?>/mails/order.php" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calculatePriceWithDownloadModalLabel">Рассчитать стоимость</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <p><small>Мы свяжемся с Вами в течение 10 минут и ответим на все вопросы!</small></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <input type="text" name="name" class="form-control" placeholder="Ваше имя" required />
                    </div>
                    <div class="col-md-6">
                        <input type="tel" name="tel" class="form-control telMask" placeholder="Ваш телефон*" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-lg btn btn-corporate-color-1 mx-auto">
                    Жду звонка
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Download Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="post" action="<?php echo get_template_directory_uri(); ?>/mails/download-mail.php" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Скачать презентацию</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <p><small>Заполните форму для скачивания файла</small></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Ваше имя*" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <input type="tel" name="tel" class="form-control telMask" placeholder="Ваш телефон*" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="email" name="email" class="form-control" placeholder="Email" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-lg btn btn-corporate-color-1 mx-auto">
                    Скачать
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelector('#downloadModal form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Сначала скачиваем файл
    var link = document.createElement('a');
    link.setAttribute('href', '<?php echo get_template_directory_uri(); ?>/pdf/catalog_new_compressed.pdf');
    link.setAttribute('download', 'catalog_new_compressed.pdf');
    link.click();
    
    // Потом отправляем форму
    this.submit();
});
</script>

<script>
    // Функции для модальных окон подарков
    function giftsSectionGalleryOn(gal, img) {
        document.getElementById('giftsSectionGalleryWrapper').style.display = 'block';
        if (gal == 'giftsSectionGallery') {
            document.getElementById('giftsSectionGallery').style.display = 'block';
        }
        var imgId = img.replace('img', 'ind');
        document.getElementById(img).classList.add('active');
        document.getElementById(imgId).classList.add('active');
    }

    function giftsSectionGalleryClose() {
        document.getElementById('giftsSectionGalleryWrapper').style.display = 'none';
        document.getElementById('giftsSectionGallery').style.display = 'none';
        document.querySelectorAll('#giftsSectionGallery .carousel-item').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('#giftsSectionGallery .carousel-indicators button').forEach(el => el.classList.remove('active'));
    }

    // Функции для модальных окон сертификатов
    function certificatesSectionGalleryOn(gal, img) {
        document.getElementById('certificatesSectionGalleryWrapper').style.display = 'block';
        if (gal == 'certificatesSectionGallery') {
            document.getElementById('certificatesSectionGallery').style.display = 'block';
        }
        var imgId = img.replace('img', 'ind');
        document.getElementById(img).classList.add('active');
        document.getElementById(imgId).classList.add('active');
    }

    function certificatesSectionGalleryClose() {
        document.getElementById('certificatesSectionGalleryWrapper').style.display = 'none';
        document.getElementById('certificatesSectionGallery').style.display = 'none';
        document.querySelectorAll('#certificatesSectionGallery .carousel-item').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('#certificatesSectionGallery .carousel-indicators button').forEach(el => el.classList.remove('active'));
    }

    // Маска для телефона
    document.addEventListener('DOMContentLoaded', function() {
        var telMask = document.getElementsByClassName('telMask');
        if (typeof Inputmask !== 'undefined') {
            var im = new Inputmask('+7(999)999-99-99');
            im.mask(telMask);
        }
    });
</script>


<?php
$display = isset($_SESSION['display']) ? $_SESSION['display'] : 'none';
$message = isset($_SESSION['recaptcha']) ? $_SESSION['recaptcha'] : '';
?>



<!-- Показываем сообщение об успешной отправки -->
<div style="display: <?php echo $display; ?>;" onclick="modalClose();">
    <div id="background-msg" style="display: <?php echo $display; ?>;"></div>
    <button id="btn-close" type="button" class="btn-close btn-close-white" onclick="modalClose();"
        style="position: absolute; z-index: 9999; top: 15px; right: 15px;"></button>
    <div id="message">
        <?php 
        echo $message;
        // Очищаем переменные после показа
        if (isset($_SESSION['recaptcha'])) {
            unset($_SESSION['recaptcha']);
        }
        if (isset($_SESSION['display'])) {
            $_SESSION['display'] = 'none';
        }
        ?>
    </div>
</div>

