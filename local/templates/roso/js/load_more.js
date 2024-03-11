(function($) {
	$(document).ready(function() {
		
		// Инициализируем masonry в разделе "Пресс-центр"
		if ($('.main_news_list').length && !$('.detail_news_bottom').length){		
			var news_grid = $('.main_news_list').masonry({
				itemSelector: '.main_news_list > div',
				columnWidth: '.main_news_list > div',
				// percentPosition: true,
				horizontalOrder: true,
			});
		}
	
		$.each($('*[data-js="load-more-area"]'), function(index, area) {
			
			var triggers = $('*[data-js="load-more-trigger"]', area);
			var content = $('*[data-js="load-more-content"]', area).get(0);
			
			var pagerId = $(content).attr('data-pager-id');
			var numberOfPages = $(content).attr('data-number-of-pages');
			
			if (!numberOfPages) {
				//console.error('Load-more: content has no data-number-of-pages attribute');
				return true;
			}
			
			if (!pagerId) {
				//console.error('Load-more: content has no data-pager-id attribute');
				return true;
			}
			
			var currentPage = 1;
			
			$(triggers).click(function(event) {
				
				event.preventDefault();
				
				if (!$(this).hasClass('bisy')) {
					
					$('*[data-js="load-more-trigger"]', area).addClass('bisy');
					
					var loadUrl = location.href + (location.search == '' ? '?' : '&') + 'PAGEN_'+ pagerId +'=' + (++currentPage);
					
					$.ajax({
						url: loadUrl,
						type: 'POST',
						data: {
							AJAX: 'Y',
						}
					}).done(function(answer) {
						
						var items = $('*[data-js="load-more-content"][data-pager-id="' + pagerId + '"] > *', answer);
						
						if (!answer || !items.length) {
							console.error('Load-more: wrong answer');
							return;
						} else {
							$(content).append(items);
							
							// Добавляем новые блоки в сетку masonry
							if ($('.main_news_list').length){
								news_grid.masonry('appended', items);
							}
						}
						
					}).fail(function() {
						console.error('Load-more: connection issue');
					}).always(function() {
						
						if (currentPage == numberOfPages) {
							$(triggers).hide();
						}
						
						$(triggers).removeClass('bisy');
						$('body').trigger('load-more-complete');
						
						// Обновляем сетку masonry
						
						/*
						if ($('.main_news_list').length){
							
							//$(this).masonry('reloadItems');
							
							$('.main_news_list').masonry('destroy');
							$('.main_news_list').masonry({
								itemSelector: '.main_news_list > div',
								columnWidth: '.main_news_list > div',
								// percentPosition: true,
								horizontalOrder: true,
							});

						}
						*/
						
					});
					
				}
				
			});
			
		});
		
		
	});
}(jQuery));

