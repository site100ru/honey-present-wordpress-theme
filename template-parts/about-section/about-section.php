<?php
/**
 * Template Part: About Section
 * Путь: template-parts/about-section/about-section.php
 */

// Получаем данные из ACF Options
$about_title = get_field('about_title', 'option');
$about_blocks = get_field('about_blocks', 'option');

// Если нет блоков, не выводим секцию
if (!$about_blocks) {
    return;
}

// Разделяем блоки на видимые и скрытые
$visible_blocks = array();
$collapsed_blocks = array();

foreach ($about_blocks as $block) {
    if (isset($block['block_visible']) && $block['block_visible'] === 'collapsed') {
        $collapsed_blocks[] = $block;
    } else {
        $visible_blocks[] = $block;
    }
}

// Функция для вывода одного блока с автоматическим чередованием
function render_about_block($block, $block_id, $total_index) {
    $image = $block['block_image'];
    $content = $block['block_content'];
    
    // Автоматическое чередование: нечетные - картинка слева, четные - картинка справа
    $is_image_left = ($total_index % 2 === 1);
    ?>
    <div class="row justify-content-between about_box">
        <?php if ($is_image_left): ?>
            <!-- Картинка слева на desktop, снизу на mobile -->
            <div class="col-12 col-md-6 col-xl-6 text-center order-2 order-md-1">
                <a onclick="aboutSectionGalleryOn_<?php echo $block_id; ?>('aboutSectionGallery_<?php echo $block_id; ?>','imgAboutSectionGallery_<?php echo $block_id; ?>-1');">
                    <div class="single-product-img approximation">
                        <img src="<?php echo esc_url($image['url']); ?>" 
                             class="img-fluid rounded" 
                             alt="<?php echo esc_attr($image['alt'] ?: 'О нас'); ?>" />
                        <div class="magnifier"></div>
                    </div>
                </a>
            </div>

            <div class="d-none d-xl-block col-xl-1 order-md-2"></div>

            <!-- Контент справа на desktop, сверху на mobile -->
            <div class="col-12 col-md-6 col-xl-5 description_about align-content-center order-1 order-md-3">
                <?php echo $content; ?>
            </div>
        <?php else: ?>
            <!-- Контент слева на desktop, сверху на mobile -->
            <div class="col-12 col-md-6 col-xl-5 description_about align-content-center order-1">
                <?php echo $content; ?>
            </div>

            <div class="d-none d-xl-block col-xl-1"></div>

            <!-- Картинка справа на desktop, снизу на mobile -->
            <div class="col-12 col-md-6 col-xl-6 text-center order-2">
                <a onclick="aboutSectionGalleryOn_<?php echo $block_id; ?>('aboutSectionGallery_<?php echo $block_id; ?>','imgAboutSectionGallery_<?php echo $block_id; ?>-1');">
                    <div class="single-product-img approximation">
                        <img src="<?php echo esc_url($image['url']); ?>" 
                             class="img-fluid rounded" 
                             alt="<?php echo esc_attr($image['alt'] ?: 'О нас'); ?>" />
                        <div class="magnifier"></div>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
?>

<div id="sp-about" class="scroll-points"></div>
<section class="about-section section">
    <div class="container">
        
        <!-- Заголовок секции -->
        <div class="row">
            <div class="col text-center">
                <h2><?php echo esc_html($about_title); ?></h2>
                <img src="<?php echo get_template_directory_uri(); ?>/img/ico/section-title-dec.svg" 
                     alt="Пчелки между секциями" 
                     class="img-fluid section-decor" />
            </div>
        </div>

        <!-- Видимые блоки -->
        <?php 
        foreach ($visible_blocks as $index => $block) {
            $block_id = $index + 1;
            $total_index = $index + 1; // Для чередования
            render_about_block($block, $block_id, $total_index);
        }
        ?>

        <!-- Скрытые блоки (коллапс) -->
        <?php if (!empty($collapsed_blocks)): ?>
        <div class="collapse" id="aboutCollapse">
            <?php 
            foreach ($collapsed_blocks as $index => $block) {
                $block_id = count($visible_blocks) + $index + 1;
                $total_index = count($visible_blocks) + $index + 1; // Продолжаем чередование
                render_about_block($block, $block_id, $total_index);
            }
            ?>
        </div>

        <!-- Кнопка -->
        <div class="row my-4">
            <div class="col text-center">
                <button
                    class="btn btn-corporate-color-1 btn-arrow"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#aboutCollapse"
                    aria-expanded="false"
                    aria-controls="aboutCollapse"
                    id="aboutToggleBtn">
                    Читать дальше
                    <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-bottom.svg" alt="" id="arrowIcon" />
                </button>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- Модальные окна для галереи -->
<?php 
$all_blocks = array_merge($visible_blocks, $collapsed_blocks);
foreach ($all_blocks as $index => $block): 
    $image = $block['block_image'];
    $modal_index = $index + 1;
?>
<div id="aboutSectionGalleryWrapper_<?php echo $modal_index; ?>" style="display: none">
    <div
        id="aboutSectionGallery_<?php echo $modal_index; ?>"
        class="carousel slide"
        data-bs-ride="false"
        data-bs-interval="false"
        style="display: none; position: fixed; top: 0; left: 0; height: 100%; width: 100%; z-index: 99999; background: rgba(0, 0, 0, 0.9)">
        <div class="carousel-inner h-100">
            <div id="imgAboutSectionGallery_<?php echo $modal_index; ?>-1" class="carousel-item h-100">
                <div class="row align-items-center h-100">
                    <div class="col text-center">
                        <img src="<?php echo esc_url($image['url']); ?>" 
                             class="img-fluid lazyload" 
                             loading="lazy" 
                             style="max-width: 90vw; max-height: 90vh" 
                             alt="<?php echo esc_attr($image['alt'] ?: 'О нас'); ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button
        type="button"
        onclick="aboutSectionGalleryClose_<?php echo $modal_index; ?>();"
        class="btn-close btn-close-white"
        style="position: fixed; top: 25px; right: 25px; z-index: 999999"
        aria-label="Закрыть"></button>
</div>
<?php endforeach; ?>

<script>
<?php foreach ($all_blocks as $index => $block): 
    $modal_index = $index + 1;
?>
function aboutSectionGalleryOn_<?php echo $modal_index; ?>(gal, img) {
    document.getElementById('aboutSectionGalleryWrapper_<?php echo $modal_index; ?>').style.display = 'block';
    if (gal === 'aboutSectionGallery_<?php echo $modal_index; ?>') {
        document.getElementById('aboutSectionGallery_<?php echo $modal_index; ?>').style.display = 'block';
    }
    if (img === 'imgAboutSectionGallery_<?php echo $modal_index; ?>-1') {
        document.getElementById('imgAboutSectionGallery_<?php echo $modal_index; ?>-1').classList.add('active');
    }
    document.body.style.overflow = 'hidden';
}

function aboutSectionGalleryClose_<?php echo $modal_index; ?>() {
    document.getElementById('aboutSectionGalleryWrapper_<?php echo $modal_index; ?>').style.display = 'none';
    document.getElementById('aboutSectionGallery_<?php echo $modal_index; ?>').style.display = 'none';
    document.getElementById('imgAboutSectionGallery_<?php echo $modal_index; ?>-1').classList.remove('active');
    document.body.style.overflow = '';
}
<?php endforeach; ?>

<?php if (!empty($collapsed_blocks)): ?>
document.addEventListener('DOMContentLoaded', function() {
    const collapseElement = document.getElementById('aboutCollapse');
    const toggleBtn = document.getElementById('aboutToggleBtn');
    const aboutSection = document.getElementById('sp-about');

    if (!collapseElement || !toggleBtn || !aboutSection) return;

    collapseElement.addEventListener('show.bs.collapse', function() {
        toggleBtn.innerHTML = 'Скрыть <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-top.svg" alt="" id="arrowIcon" />';
    });

    collapseElement.addEventListener('hide.bs.collapse', function() {
        aboutSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        setTimeout(function() {
            toggleBtn.innerHTML = 'Читать дальше <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-bottom.svg" alt="" id="arrowIcon" />';
        }, 500);
    });
});
<?php endif; ?>
</script>