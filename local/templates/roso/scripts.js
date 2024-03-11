function result_korma(){
	var dose = parseFloat($('#dose').val()),
		days = parseFloat($('#days').val()),
		heads = parseFloat($('#heads').val()),
		result = false;

	result = (dose * days) * heads;
	if (result < 0){result = 0;}

	$('.res .digits').html(parseInt(result));
}

function result_semena() {
	var dose = parseFloat($('#dose').val()),
		heads = parseFloat($('#heads').val()),
		result = false;

	result = dose * heads;
	if (result < 0) { result = 0; }

	$('.res .digits').html(parseInt(result));
}

$( document ).ready(function() {

	var window_width = $(window).width(),
		sections_list = $('.bx_catalog_line .sections_list'),
		sections_parent = $('.bx_catalog_line');
		
	var solutions_semena = $('.solutions_list.semena .solutions_wrap'),
		solutions_semena_parent = $('.solutions_list.semena');

	var section_semena_bottom = $('.sections_block_wrapper.semena .sections_content'),
		section_semena_bottom_parent = $('.sections_block_wrapper.semena .sections_content');
		
	var section_semena_sol_bottom = $('.sections_bottom_wrapper.semena .solutions .sections_content'),
		section_semena_sol_bottom_parent = $('.sections_bottom_wrapper.semena .solutions');

	// Кнопка "Больше кормов и добавок"
	$('.delimiter .show_more').click(function(){
		if (!$(this).hasClass('solutions')){
			$(this).hide();
			$('.sections_block_wrapper .hide_640').addClass('show');
		}
	});

	// Кнопка "Больше решений"
	$('.delimiter .show_more.solutions').click(function () {
		$(this).hide();
		$('.sections_block_wrapper.solutions p').each(function(){
			$(this).removeClass('hidden-sm');
			$(this).removeClass('hidden-xs');
		});
	});

	$('.sections_content').on('click', '.show_more.solutions.semena', function(){
	//$('.show_more.solutions.semena').click(function () {
		$(this).hide();
		$('.sections_block_wrapper.solutions p').each(function () {
			$(this).removeClass('hidden-sm');
			$(this).removeClass('hidden-xs');
		});
		window_width = $(window).width();

		if (section_semena_sol_bottom.find('.column').length) {
			custom_uncolumnize(section_semena_sol_bottom);
		}
		section_semena_sol_bottom_parent.removeClass('columns_3 columns_2');
		section_semena_sol_bottom_parent.addClass('columns_0');
		set_columns(section_semena_sol_bottom_parent, section_semena_sol_bottom, window_width);
	});

	// Калькулятор
	$('.calc_input_wrap .control_button').click(function(){

		var operation = false,
			target = $(this).attr('data-target'),
			current_value = parseFloat($('#'+target).val()),
			new_value = false;

		if ($(this).hasClass('plus')){operation = 'addition';}
		if ($(this).hasClass('minus')){operation = 'substraction';}

		if (operation == 'addition'){
			new_value = current_value + 1;
		}

		if (operation == 'substraction'){
			new_value = current_value - 1;
		}

		if (new_value > 0){
			new_value = new_value.toFixed(1);
			if (parseInt(new_value) == new_value){new_value = parseInt(new_value);}
			$('#'+target).val(new_value);
			$('#'+target).trigger('change');
		}

	});

	// Результат вычислений на внутренней странице товара в разделе "Корма и добавки"
	if ($('#dose').length && $('#days').length && $('#heads').length){

		result_korma();
		$('#dose, #days, #heads').on('change', function(){
			result_korma();
		});
	}

	// Результат вычислений на внутренней странице товара в разделе "Семена"
	if ($('#dose').length && !$('#days').length && $('#heads').length) {

		result_semena();
		$('#dose, #heads').on('change', function () {
			result_semena();
		});
	}

	// Строка поиска
	$('.search_control').on('click', function() {

		var slide_direction = '';
		slide_direction = 'left';

		var cur_width = $(window).width();
		if (cur_width < 610){
			$('.title-search').toggleClass('opened');

			$('.mobile_logo_block').toggle();

			if ($('.header_search.header_form').hasClass('col-xs-7')){
				$('.header_search.header_form').removeClass('col-xs-7');
				$('.header_search.header_form').addClass('col-xs-12');
			} else {
				$('.header_search.header_form').removeClass('col-xs-12');	
				$('.header_search.header_form').addClass('col-xs-7');
			}
		}

		$(this).toggleClass('search_opened');
		$(this).closest('.title-search').find('form').toggle("slide", {direction: slide_direction}, 500);
		$(this).closest('.title-search').find('input[type="text"]').focus();
	});

	// Форма "Обратный звонок" (шапка)
	$('.header_back_call').on('click', '.back_call_control', function() {

		var slide_direction = 'right';

		$(this).closest('.back_call').find('form[name="back_call"]').toggle("slide", {direction: slide_direction}, 500);
		$(this).closest('.back_call').find('input[type="text"]').focus();
	});

	// Форма "Обратный звонок" (подвал)
	$('.row').on('click', '.footer_call_control', function() {

		var show_privacy = false;

		if ($(this).closest('.back_call').find('form[name="back_call_bottom"]').is(':visible')){
			$('.footer_call_control .first_digit').hide();
			show_privacy = true;
			$('.footer_call_control .underline_wrap span').html('Перезвоним');

		} else {
			if (window_width > 1269){
				$('.section_footer .privacy').hide();
			}
			if (window_width > 610){
				$('.footer_call_control .first_digit').show();
			}
			$('.footer_call_control .underline_wrap span').html('Перезвоним на');
		}

		$(this).closest('.back_call').find('form[name="back_call_bottom"]').toggle("slide", {direction: 'left'}, 500).promise().done(function(){

			if (window_width < 970){
				if ($(this).is(':visible')){$(this).css('display','inline-block');}
			}

			if (show_privacy && window_width > 1269){
				$('.section_footer .privacy').show();
			}

		});
		$(this).closest('.back_call').find('input[type="text"]').focus();
	});

	// Форма "Заявка на доставку" на главной странице
	$('.front_form_control').on('click', function() {
		$(this).toggleClass('active');
		$('.front_delivery_form').slideToggle();

		if ($('.front_delivery_form').is(':visible')){
			$('html, body').animate({
				scrollTop: $('.front_delivery_form').offset().top
			}, 1000);
		}

		// Подправляем верхний padding текстового блока
		if ($(this).hasClass('active')){
			$('.front_text_block').css('padding-top','30px');
		} else {
			$('.front_text_block').css('padding-top','60px');
		}
	});

	$('.front_delivery_form .close').on('click', function() {
		$('.front_form_control').removeClass('active');
		$('.front_delivery_form').slideToggle();
		$('.front_text_block').css('padding-top','60px');
	});

	// Псевдоселект для верхнего меню на странице "Корма и добавки"
	if($('.animals_filter_pseudo_selector').length){

		var active_item = $('.animals_filter.top .active');

		$('.animals_filter_pseudo_selector').html(active_item.html());
		$('.animals_filter_pseudo_selector').addClass(active_item.attr('data-class'));

		$('.animals_filter_pseudo_selector').click(function(){
			$(this).toggleClass('open');
			//$('.animals_filter.top').slideToggle();
			$('.animals_filter.top').toggleClass('filter_open');
		});

	}

	function custom_uncolumnize(selector){
		if (selector.find('.column').length){

			selector.find('.column').each(function (){
				selector.append($(this).html());
			});

			selector.find('.column').remove();
			selector.find('br').remove();
		}
	}

	function set_columns(parent, selector, current_width){
		
		if (current_width < 610 && !parent.hasClass('columns_0')){
			if (selector.find('.column').length){
				custom_uncolumnize(selector);
			}
			parent.removeClass('columns_3 columns_2');
			parent.addClass('columns_0');
		} 
		
		if (current_width > 610 && current_width < 970 && !parent.hasClass('columns_2')){
			if (selector.find('.column').length) {
				custom_uncolumnize(selector);
			}
			selector.columnize({
				columns: 2,
				lastNeverTallest: true,
				buildOnce: true,
				doneFunc: function () {
					console.log('made 2 columns');
				}					
			});

			parent.removeClass('columns_3 columns_0');
			parent.addClass('columns_2');

		} 
		
		if (current_width > 970 && !parent.hasClass('columns_3')) {
			if (selector.find('.column').length) {
				custom_uncolumnize(selector)
			}
			selector.columnize({
				columns: 3,
				lastNeverTallest: true,
				buildOnce: true,
				doneFunc: function(){
					console.log('made 3 columns');
				}				
			});

			parent.removeClass('columns_2 columns_0');
			parent.addClass('columns_3');			
		}
	}
	if (sections_list.length) {

		if (window_width < 970 && $('body').hasClass('semena_root')) {
			if (sections_list.find('.column').length) {
				custom_uncolumnize(sections_list);
			}
			sections_parent.removeClass('columns_3 columns_2');
			sections_parent.addClass('columns_0');
		} else {
			set_columns(sections_parent, sections_list, window_width);
		}
	}

	if (section_semena_bottom.length) {
		set_columns(section_semena_bottom_parent, section_semena_bottom, window_width);
	}

	if (section_semena_sol_bottom.length) {
		set_columns(section_semena_sol_bottom_parent, section_semena_sol_bottom, window_width);
	}

	if (solutions_semena.length){
		set_columns(solutions_semena_parent, solutions_semena, window_width);
	}

	// Global onresize function
	var resizeTimeout;
	$(window).resize(function(){

		if(!!resizeTimeout){ clearTimeout(resizeTimeout);}
		resizeTimeout = setTimeout(function(){

			// on resize actions
			window_width = $(window).width();

			if (sections_list.length){
				if (window_width < 970 && $('body').hasClass('semena_root')){
					if (sections_list.find('.column').length) {
						custom_uncolumnize(sections_list);					
					}
					sections_parent.removeClass('columns_3 columns_2');
					sections_parent.addClass('columns_0');	
				} else {
					set_columns(sections_parent, sections_list, window_width);
				}	
			}

			if (section_semena_bottom.length) {
				set_columns(section_semena_bottom_parent, section_semena_bottom, window_width);
			}

			if (section_semena_sol_bottom.length) {
				set_columns(section_semena_sol_bottom_parent, section_semena_sol_bottom, window_width);
			}

			if (solutions_semena.length){
				set_columns(solutions_semena_parent, solutions_semena, window_width);
			}

			// Действия со шапкой на главной
			if (window_width < 970 && $('.front_head_mobile').length){
				if ($('header.header').hasClass('white_text')){
					$('header.header').removeClass('white_text');
					$('header.header').removeClass('front_shadow_dark');
					$('header.header').addClass('black');
				}
			} 
			
			if (window_width >= 970 && $('.front_head_mobile').length){
				var header_type = $('.flex-active-slide').attr('data-type');

				if (header_type == 'white') {
					$('header.header').addClass('white_text');
					$('header.header').addClass('front_shadow_dark');
					$('header.header').removeClass('black');
					$('header.header').removeClass('front_shadow_white');
				} else {
					$('header.header').removeClass('white_text');
					$('header.header').removeClass('front_shadow_dark');
					$('header.header').addClass('black');
					$('header.header').addClass('front_shadow_white');
				}
			}

		}, 200);
	});

});
