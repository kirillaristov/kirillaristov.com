<?php

include('mapfunctions.inc');

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($kml != '') echo "KML $kml on "; ?>Yandex Map | Kirill Aristov</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">
<meta name="robots" content="noindex, nofollow" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<script src="https://api-maps.yandex.ru/2.1/?lang=en-RU"></script>

<script src="/map/functions.js"></script>

<script>
var type = '<?php echo $type; ?>',
	center = '<?php echo $center; ?>',
	zoom = <?php echo $zoom; ?>,
	kml = '<?php echo $kml; ?>',
	placemark = '<?php echo $placemark; ?>',
	bounds = '<?php echo $bounds; ?>';
	

var base = {
	messages: {buttonText: 'Messages', url: 'as-the-first-settlers-messages.php', loaded: false, collection: ''},
	camps: {buttonText: 'Camps', url: 'as-the-first-settlers-camps.kml', loaded: false, collection: ''},
	track: {buttonText: 'Track', url: 'as-the-first-settlers-track.kml', loaded: false, collection: ''}	
};
id = kml;

window.onload = function() {
	body = document.getElementsByTagName("body")[0];
	body.className += ' loaded';
};


ymaps.ready(init);

function init() {
	myMap = new ymaps.Map("map", {
		zoom: zoom,
		center: center.split(','),
		type: 'yandex#' + (type == 'roadmap' ? 'map' : type),
		controls: ['zoomControl', 'typeSelector', 'searchControl']
	}, {
		searchControlProvider: 'yandex#map' //поиск только по топонимам, без организаций
	});
	
	myMap.controls.add('rulerControl', {position: {left:15,top:50} });
	
	base.messages.button = new ymaps.control.Button({ data: {content: base.messages.buttonText} });
	base.camps.button = new ymaps.control.Button({ data: {content: base.camps.buttonText} });
	base.track.button = new ymaps.control.Button({ data: {content: base.track.buttonText} });
	
	if (kml != '') {
		base[kml].button.state.set('selected', true);
	}

	base.messages.button.events.add('click', function () { id = 'messages'; buttonClick(id); });
	base.camps.button.events.add('click', function () { id = 'camps'; buttonClick(id); });
	base.track.button.events.add('click', function () { id = 'track'; buttonClick(id); });
	
	myMap.controls.add(base.messages.button, { float: 'right', floatIndex: 100 });
	myMap.controls.add(base.camps.button, { float: 'right', floatIndex: 100 });
	myMap.controls.add(base.track.button, { float: 'right', floatIndex: 100 });		



	// Coords tooltip 
	myMap.events.add('click', function(e) {
		myMap.balloon.open(
			e.get('coords'),
			{contentBody: 'Coord: ' + e.get('coords')[0].toFixed(5) + ',' + e.get('coords')[1].toFixed(5)}
		) 
	});
	
	if (kml) {
		loadKML(base[kml].url);
		console.log(base[kml].url);
	}

	if (placemark) {
		openPlacemark (placemark);
	}


	// Сохранение состояния карты в URL
	// Сохранение состояния карты в URL
	// Сохранение состояния карты в URL
		
	var currentUrl = window.location.search.substring(1);	

	var newUrl = 'type=' + type + '&center=' + center + '&zoom=' + zoom;
	if (kml != '')  {
		newUrl += '&kml=' + kml;
	}
	if (placemark != '') {
		newUrl += '&placemark=' + placemark;
	}

	//Если карта была запущена без параметров или часть параметров отсутствовала
	if (newUrl != currentUrl) {
		history.replaceState(null, null, '?'+newUrl);
	}

	//Назад по истории (back button clicks)
	window.addEventListener("popstate", function(e) {
		setMapStateByHash();
	}, false)

	//При изменении размеров, зума или типа карты
	myMap.events.add(['boundschange', 'typechange'], setLocationHash);

}
</script>

<style>
*		{margin:0;padding:0;}
body	{overflow:hidden;font-size:80%;color:#000;background-color:#fff;font-family:arial,helvetica,sans-serif;}
#map	{position:absolute;top:0;right:0;bottom:0;left:0;}

/* loader */	
#loader-wrapper {position:fixed;top:0;left:0;width:100%;height:100%;z-index:1000;}
#loader {display:block;position:relative;left:50%;top:50%;width:150px;height:150px;margin:-75px 0 0 -75px;border-radius:50%;border:3px solid transparent;border-top-color:#3498db;}

body:not(.loaded) #loader {animation:spin 2s linear infinite;}

@keyframes spin {
	0%   {transform: rotate(0deg);}
	100% {transform: rotate(360deg);}
}

#loader-wrapper .loader-section {position:fixed;top:0;width:50%;height:100%;background:#222;z-index:1000;opacity:.8;}
#loader-wrapper .loader-section.section-left {left:0;} 
#loader-wrapper .loader-section.section-right {right:0;}

#loader {z-index: 1001; /* anything higher than z-index: 1000 of .loader-section */}

.loaded #loader-wrapper .loader-section.section-left {transform:translateX(-100%);}

.loaded #loader-wrapper .loader-section.section-right {transform: translateX(100%);}

.loaded #loader {opacity:0;}
.loaded #loader-wrapper {visibility:hidden;}

.loaded #loader {opacity:0;transition:all 0.3s ease-out;}
.loaded #loader-wrapper .loader-section.section-right,
.loaded #loader-wrapper .loader-section.section-left {transition:all 0.3s 0.3s ease-out;}

.loaded #loader-wrapper {transform:translateY(-100%);transition:all 0.3s 0.6s ease-out;}

.loaded #loader-wrapper .loader-section.section-right,
.loaded #loader-wrapper .loader-section.section-left {transition:all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);}

.loaded #loader-wrapper {transform:translateY(-100%);transition:all 0.3s 1s ease-out;}
/* end loader */
</style>
</head>

<body>
	<div id="map"></div>
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
</body>
</html>