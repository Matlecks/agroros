$(document).ready(function() {

	var myMap,
		placemarks = [];

	// Инициализируем Яндекс.Карту
	function init_map(center_coords){

		var map_center = center_coords.split(',');
			
		if (myMap){
			myMap.destroy();
			myMap = null;
		}
	
		myMap = new ymaps.Map('map', {
			center: [map_center[0],map_center[1]],
			zoom: 5,
			controls: []
		});
		
		// Создаем метки
		
		$('.contacts .address span').each(function(){
			var coords = $(this).attr('data-coords'),
				address = $(this).html(),
				mark_id = $(this).attr('data-id'),
				icon = $(this).attr('data-icon');
			
			coords = coords.split(',');
			
			placemarks[mark_id] = new ymaps.Placemark([coords[0],coords[1]], {
				balloonContent: address,
			}, {
				iconLayout: 'default#image',
				iconImageHref: icon,
				// Размеры метки.
				iconImageSize: [32, 44],
				iconImageOffset: [-16, -44]
			});
			myMap.geoObjects.add(placemarks[mark_id]);
			
		});
	}
    
	ymaps.ready(function(){
	
		if ($('#map').length){
			ymaps.ready(init_map('56.4159762165357,49.67548922717284'));
		}
	
		$('.contacts .address span').click(function(){
			var coords = $(this).attr('data-coords'),
				mark_id = $(this).attr('data-id');
			
			coords = coords.split(',');
			
			myMap.setCenter(coords, 17);
			placemarks[mark_id].balloon.open();
			
			$('html, body').animate({
				scrollTop: $('#map').offset().top
			}, 1000);
		});
	
	});
	
});