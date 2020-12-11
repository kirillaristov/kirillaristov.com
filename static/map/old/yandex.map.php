<?php

include('mapfunctions.inc');

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($track != '') echo "Track $track on "; ?>Yandex Map | Kirill Aristov</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">
<meta name="robots" content="noindex, nofollow" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<script src="https://api-maps.yandex.ru/2.1/?lang=en-RU"></script>
<script src="/theme/jquery/jquery.min.js"></script>

<script>
$(function() {
	$(window).load(function() {
			$('body').addClass('loaded');
	});
});

ymaps.ready(init);

function init() {
	var myMap = new ymaps.Map("map", {
		zoom: 13,
		center: [57.53157,57.22842],
		type: 'yandex#hybrid',
		controls: ['zoomControl', 'typeSelector', 'searchControl']
	}, {
		searchControlProvider: 'yandex#map' //поиск только по топонимам, без организаций
	});
	
	myMap.controls.add('rulerControl', {
		position: {
		   left: 15,
		   top: 50
		}
	});

//Adding buttons
	var collection = {
		mess: {loaded:false},
		camps: {loaded:false},
		track: {loaded:false}
	};
	id = 'fromUrl';
	
	var messButton = new ymaps.control.Button({	data: {content: 'Messages'} });
	var campsButton = new ymaps.control.Button({ data: {content: 'Camps'} });
	var trackButton = new ymaps.control.Button({ data: {content: 'Track'} });
			 
	messButton.events.add('click', function () { id = 'mess'; buttonClick('2014+-messages.php?rev<?php echo fileTime('2014+-messages.php'); ?>', id); });
	myMap.controls.add(messButton, { float: 'right', floatIndex: 100 });

	campsButton.events.add('click', function () { id = 'camps'; buttonClick('2014+-camps.kml?rev<?php echo fileTime('2014+-camps.kml'); ?>', id); });
	myMap.controls.add(campsButton, { float: 'right', floatIndex: 100 });

	trackButton.events.add('click', function () { id = 'track'; buttonClick('2014+-track.kml?rev<?php echo fileTime('2014+-track.kml'); ?>', id); });
	myMap.controls.add(trackButton, { float: 'right', floatIndex: 100 });		

	function buttonClick (file, type) {
		if (!collection[type].loaded) {
			$('body').removeClass('loaded');
			ymaps.geoXml.load('http://kirillaristov.com/kml-files/' + file).then(onGeoXmlLoad);			
		}
		else {		
			collection[type].loaded = false;
			myMap.geoObjects.remove(collection[type]);
		}
	}

// Coords tooltip 
	myMap.events.add('click', function(e) {
		myMap.balloon.open(
			e.get('coords'),
			{contentBody: 'Coord: ' + e.get('coords')[0].toFixed(5) + ',' + e.get('coords')[1].toFixed(5)}
		) 
	});
	
<?php if ($track != '') { ?>
	ymaps.geoXml.load('http://kirillaristov.com/kml-files/<?php echo "$track?rev".fileTime($track); ?>').then(onGeoXmlLoad);
<?php } ?>

// Обработчик загрузки XML-файлов.
    function onGeoXmlLoad (res) {
		collection[id] = new ymaps.GeoObjectCollection();
		collection[id].add(res.geoObjects);
				
		myMap.geoObjects.add(collection[id]);
		myMap.setBounds(collection[id].getBounds());		
		
		//исправление ошибки перестановки ширина-высота в api
		ymaps.geoQuery(myMap.geoObjects).setOptions({iconImageSize: [32, 37]});
		
		collection[id].loaded = true;
		$('body').addClass('loaded');
    }
	
<?php if ($placemark != 0) { ?>
	myPlacemark = new ymaps.Placemark([<?php echo $placemark; ?>], {
		balloonContentHeader: "Coordinates",
		iconContent: "<?php echo $placemark; ?>",
		balloonContentBody: "<?php echo $placemark; ?>",
		balloonContentFooter: "",
		hintContent: ""
	}, {
		preset: "twirl#yellowStretchyIcon",
		balloonCloseButton: true
	});
		
	myMap.geoObjects.add(myPlacemark);
	
<?php } ?>

// Сохранение состояния карты в URL
// Сохранение состояния карты в URL
	setMapStateByHash();
	$(window).on('hashchange', function() { setMapStateByHash(); }); 
	myMap.events.add(['boundschange', 'typechange'], setLocationHash);

	// получение параметров из hash
	function getParam (name, location) {
		location = location || window.location.hash;
		var res = location.match(new RegExp('[#/]' + name + '=([^/]*)', 'i'));
		return (res && res[1] ? res[1] : false);
	}

	// передача параметров в hash
	function setLocationHash () {
		var mapType;
		switch (myMap.getType().split('#')[1]) {
			case 'map': mapType = 'roadmap'; break;
			case 'satellite': mapType = 'satellite'; break;
			case 'hybrid': mapType = 'hybrid'; break;
			default: mapType = 'roadmap'; break;
		}
		
		var params = [
			'type=' + mapType,
			'center=' + myMap.getCenter()[0].toFixed(5) + ',' + myMap.getCenter()[1].toFixed(5),
			'zoom=' + myMap.getZoom()
		];
		window.location.hash = params.join('/');
	}

	// установка состояния карты из hash
	function setMapStateByHash () {
		var hashType = getParam('type'),
			hashCenter = getParam('center'),
			hashZoom = parseInt(getParam('zoom')),
			newHash = false;

		switch (hashType) {
			case 'roadmap' : case 'terrain' : myMap.setType('yandex#map'); break;
			case 'satellite' : myMap.setType('yandex#satellite'); break;
			case 'hybrid' : myMap.setType('yandex#hybrid'); break;
			default : newHash = true; break;
		}
		
		if (hashCenter) myMap.setCenter(hashCenter.split(','));
		else newHash = true;
		
		if (hashZoom) myMap.setZoom(hashZoom);
		else newHash = true;
		
		//если какой-либо из параметров отсутствовал, то
		//получить текущие параметры карты и передать их в hash
		if (newHash)
			setLocationHash();
	}
// END Сохранение состояния карты в URL
}
</script>

<style>
	*		{margin:0;padding:0;}
	body	{overflow:hidden;font-size:80%;color:#000;background-color:#fff;font-family:arial,helvetica,sans-serif;}
	#map	{position:absolute;top:0;right:0;bottom:0;left:0;}

/* loader */	
	#loader-wrapper {position:fixed;top:0;left:0;width:100%;height:100%;z-index:1000;}
	#loader {display:block;position:relative;left:50%;top:50%;width:150px;height:150px;margin:-75px 0 0 -75px;
		border-radius:50%;border:3px solid transparent;border-top-color:#3498db;
	}
	
	body:not(.loaded) #loader {animation:spin 2s linear infinite;}
 
	#loader:before {content:'';position:absolute;top:5px;left:5px;right:5px;bottom:5px;border-radius:50%;border:3px solid transparent;border-top-color:#e74c3c;}
	
	body:not(.loaded) #loader:before {animation:spin 3s linear infinite;}
 
	#loader:after {content:'';position:absolute;top:15px;left:15px;right:15px;bottom:15px;border-radius:50%;border:3px solid transparent;border-top-color:#f9c922;}
	
	body:not(.loaded) #loader:after {animation: spin 1.5s linear infinite;}
 
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