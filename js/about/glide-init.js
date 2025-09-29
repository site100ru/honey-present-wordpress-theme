/**
 * Инициализация слайдера (Glide.js)
 *
 * Этот скрипт запускает слайдер на элементе с id="partners-glide",
 * если такой элемент присутствует в DOM.
 *
 * Используется библиотека Glide.js.
 * 
 * В ШАПКЕ 
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css"/>
 * 
 * В ПОДВАЛЕ 
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
 * 
 * Слайдер настроен как карусель:
 *  - Показывает 6 элементов по умолчанию
 *  - Промежуток между слайдами — 24px
 *  - На экранах шириной до 992px — 4 элемента
 *  - До 768px — 2 элемента
 *
 * Скрипт выполняется после полной загрузки DOM.
 */


document.addEventListener('DOMContentLoaded', function () {
    const partnersGlide = document.querySelector('#partners-glide');
    if (partnersGlide) {
        new Glide(partnersGlide, {
            type: 'carousel',
            perView: 6,
            gap: 24,
            breakpoints: {
                992: {
                    perView: 3,
                },
                768: {
                    perView: 1,
                },
            },
        }).mount();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const partnersGlide = document.querySelector('#certificates-glide');
    if (partnersGlide) {
        new Glide(partnersGlide, {
            type: 'carousel',
            perView: 4,
            gap: 24,
            breakpoints: {
                992: {
                    perView: 2,
                },
                768: {
                    perView: 1,
                },
            },
        }).mount();
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const partnersGlide = document.querySelector('#section-gifts');
    if (partnersGlide) {
        new Glide(partnersGlide, {
            type: 'carousel',
            perView: 3,
            gap: 24,
            breakpoints: {
                992: {
                    perView: 2,
                },
                768: {
                    perView: 1,
                },
            },
        }).mount();
    }
});



