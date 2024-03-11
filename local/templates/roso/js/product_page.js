$( document ).ready(function() {

  // Форма "Запросить цену"

  $.ajax({
    url: '/ajax/form_get_price_korma.php',
    success: function(data) {
      $('.product_form_wrap').html(data);

      // Заполняем скрытые поля формы
      $('input[name="form_hidden_39"]').val($('h1').html()); // Название товара
      $('input[name="form_hidden_40"]').val(location.protocol + "//" + location.host + $('#product_link').val()); // Ссылка на товар

      $('.phone input').mask("+7 (000) 000-00-00");
      $('input[name="form_hidden_45"]').val('enable_get_price_#13423141');

      // Кнопка "Закрыть"
      $('.webform.get_price .close').click(function() {
      	$('.get_price_button').toggleClass('opened');
      	$('.product_form_wrap').slideToggle();
      });

    }
  });

  // Кнопка "Рассчитать дозировку" (640px, под изображениями товара)
  $('.scroll_to_calc').on('click', function () {

    if ($('.get_price_button').hasClass('opened')){
      $('html, body').animate({
        scrollTop: $('.product_form_wrap').offset().top
      }, 1000);
    } else {
      $('.get_price_button').trigger('click');
    }

  });


  // Раскрываем/скрываем форму "Запросить цену"

  $('.get_price_button').on('click', function() {

    $(this).toggleClass('opened');
    $('.product_form_wrap').slideToggle();

    if ($(this).hasClass('opened')){
			$('html, body').animate({
				scrollTop: $('.product_form_wrap').offset().top
			}, 1000);
		}

	});

  // Иконка "Увеличить изображение"

  $('.enlarge_image').click(function(){
    $('#slider .slides .flex-active-slide a').trigger('click');
  });

  // Слайдер изображений с навигацией в виде карусели

	if ($('#carousel').length){

	  // The slider being synced must be initialized first
	  $('#carousel').flexslider({
	    animation: "slide",
	    controlNav: false,
			directionNav: false,
	    animationLoop: false,
	    slideshow: false,
	    itemWidth: 54,
	    itemMargin: 0,
	    asNavFor: '#slider',
			start: function(slider) {
  			if (slider.pagingCount < 7) slider.addClass('flex-centered');
			}
	  });
	}

  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
		prevText: '',
		nextText: '',
    sync: "#carousel"
  });


  // onresize event
  var resizeTimer;

  function resizeFunction() {

    var current_width = $(window).width();

    if (current_width < 970){

      // Перемещаем заголовок страницы в контейнер для desktop
      if (!$('.catalog_element .h1_mobile').hasClass('active')){

        $('.catalog_element .h1_mobile').addClass('active');
        $('.catalog_element .h1_desktop').removeClass('active');
        $('.catalog_element .h1_mobile').html($('.catalog_element .h1_desktop').html());

      }

    } else {

      // Перемещаем заголовок страницы в контейнер для mobile
      if (!$('.catalog_element .h1_desktop').hasClass('active')) {

        $('.catalog_element .h1_mobile').removeClass('active');
        $('.catalog_element .h1_desktop').addClass('active');
        $('.catalog_element .h1_desktop').html($('.catalog_element .h1_mobile').html());

      }
    }

    if ($('.main_description .desc_text').length){

      if (current_width < 610) {
        if ($('.desc_text.preview').length){
          $('.main_description .add_info').insertBefore('.main_description .desc_text.preview');
        } else {
          $('.main_description .add_info').insertBefore('.main_description .desc_text:not(.preview)');
        }
        
      } else {
        $('.main_description .add_info').insertAfter('.main_description .desc_text:not(.preview)');
      }
    }

  };

  // On resize, run the function and reset the timeout
  // 250 is the delay in milliseconds. Change as you see fit.
  $(window).resize(function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(resizeFunction, 250);
  });

  resizeFunction();

});
