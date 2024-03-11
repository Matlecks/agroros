function urldecode(url) {
    return decodeURIComponent(url.replace(/\+/g, ' '));
}

$(document).ready(function () {

    // Форма "Запросить цену"
    $.ajax({
        url: '/ajax/form_get_price_korma.php',
        success: function (data) {
            $('.product_form_wrap').html(data);

            $('.phone input').mask("+7 (000) 000-00-00");
            $('input[name="form_hidden_45"]').val('enable_get_price_#13423141');

            // Кнопка "Закрыть"
            $('.webform.get_price .close').click(function () {
                $('.get_price_button').toggleClass('opened');
                $('.product_form_wrap').slideToggle();
            });

        }
    });

    // Возвращаемся к списку разделов
    $('.calc_content').on('click', '#animal_click', function () {

        $('.loading').show();
        $('.calculator_wrap .calculator').hide();
        $('.product_form_wrap').hide();
        $('.calc_content').removeClass('section_selected');
        if ($('.bread_line').lenght) {
            $('.bread_line').removeClass('calc_shown');
        }

        setTimeout(function () {
            $.ajax({
                type: 'POST',
                data: {},
                url: '/ajax/calc/get_sections_semena.php',
                success: function (data) {
                    $('.calc_content').html(data);
                    $('.loading').hide();
                    $('#animal_click b').remove();
                }
            });
        }, 500);

    });

    // Выбор раздела
    $('.calc_content').on('click', '#catalog_sections p', function () {
        var section_id = $(this).attr('data-id'),
            section_name = $(this).html();

        $('.loading').show();
        $('.calculator_wrap .calculator').hide();
        $('.product_form_wrap').hide();
        $('.calc_content').addClass('section_selected');
        $('#animal_click b').remove();

        if ($('.bread_line').lenght) {
            $('.bread_line').removeClass('calc_shown');
        }

        setTimeout(function () {
            $.ajax({
                type: 'POST',
                data: {
                    section_name: section_name,
                    section_id: section_id,
                },
                url: '/ajax/calc/get_products_semena.php',
                success: function (data) {
                    $('.calc_content').html(data);
                    $('.loading').hide();
                    $('#animal_click b').remove();
                }
            });
        }, 500);
    });

    // Клик по товару (передача данных калькулятору)
    $('.calc_content').on('click', '#catalog_products p', function () {
        var product_id = $(this).attr('data-id'),
            product_title = $(this).html().trim(),
            product_link = $(this).attr('data-url'),
            product_image = $(this).attr('data-image'),
            product_measure = $(this).attr('data-calc-measure'),
            product_calc_input = $(this).attr('data-calc-input'),
            product_calc_result = urldecode($(this).attr('data-calc-result'));

        $('.loading').show();
        setTimeout(function () {

            $('#dose').val(product_calc_input);
            $('#dose').trigger('change');

            $('.calc_block.image img').attr('src', product_image);
            $('.calc_measure').html(product_measure);
            $('.calc_footer .text a').html(product_title);
            $('.calc_footer .text a').attr('href', product_link);

            if (product_calc_result != ''){
                $('.potencial_results').show();
                $('.potencial_results .res_content').html(product_calc_result);
            } else {
                $('.potencial_results').hide();
            }

            $('.calc_content .bread_line').append(' <b>&rsaquo;</b> <span id="product_bread" data-id="' + product_id + '">' + product_title + '</span>')

            $('.calculator_wrap .calculator').show();
            $('.bread_line').addClass('calc_shown');
            $('.calc_content').removeClass('section_selected');
            $('#catalog_products').hide();

            // Заполняем скрытые поля формы
            $('input[name="form_hidden_39"]').val(product_title); // Название товара
            $('input[name="form_hidden_40"]').val(location.protocol + "//" + location.host + product_link); // Ссылка на товар

            $('.loading').hide();

            // Если мы на мобильном устройстве, добавляем слово "Препарат"
            // if ($(window).width() < 640) {
            //     $('#animal_click').html('<b>Препарат<br /></b>' + $('#animal_click').html());
            // }

        }, 500);
    });

    // Возвращаемся к списку товаров
    $('.calc_content').on('click', '#product_bread', function () {
        var section_id = $('#animal_click').attr('data-section-id'),
            section_name = $('#animal_click').html();

        $('.loading').show();
        $('.calculator_wrap .calculator').hide();
        $('.product_form_wrap').hide();
        $('.calc_content').addClass('section_selected');
        $('#animal_click b').remove();

        if ($('.bread_line').lenght) {
            $('.bread_line').removeClass('calc_shown');
        }

        setTimeout(function () {
            $.ajax({
                type: 'POST',
                data: {
                    section_name: section_name,
                    section_id: section_id,
                },
                url: '/ajax/calc/get_products_semena.php',
                success: function (data) {
                    $('.calc_content').html(data);
                    $('.loading').hide();
                    $('#animal_click b').remove();
                }
            });
        }, 500);
    });

    // Раскрываем/скрываем форму "Запросить цену"
    $('.get_price_button').on('click', function () {

        $(this).toggleClass('opened');
        $('.product_form_wrap').slideToggle();

        if ($(this).hasClass('opened')) {
            $('html, body').animate({
                scrollTop: $('.product_form_wrap').offset().top
            }, 1000);
        }

    });

});