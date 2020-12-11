<?php

include('mapfunctions.inc');

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($track != '') echo "Track $track on "; ?>Google Map | Kirill Aristov</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">

<meta name="robots" content="noindex, nofollow" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&#38;sensor=false"></script>
<script type="text/javascript" src="/theme/jquery/jquery.min.js"></script>

<script type="text/javascript">
//noClear 	boolean 	If true, do not clear the contents of the Map div.
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
	var map;
	var infowindow = new google.maps.InfoWindow(); //для сервиса запроса высоты/глубины

	var mapOptions = {
		zoom: 8,
		center: new google.maps.LatLng(46,0),
		mapTypeId: google.maps.MapTypeId.HYBRID,
		streetViewControl: true,
		disableDefaultUI: false,
		scaleControl: true,
		panControl: true,
		zoomControl: true,
		mapTypeControl: true,
		overviewMapControl: true,
		heading: 90, tilt: 45 //отображение аэрофотоснимков вместо спутниковых снимков (если доступно)
	}
	
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

<?php if ($track != '') { ?>
	var ctaLayer = new google.maps.KmlLayer({
		url: 'http://kirillaristov.com/kml-files/<?php echo "$track?rev".fileTime($track); ?>',
		//preserveViewport: true
		preserveViewport: false
	});
	ctaLayer.setMap(map);
<?php } ?>
	
// Сервис получения высот/глубин
// Сервис получения высот/глубин
	elevator = new google.maps.ElevationService();
	// добавление обработчика для сервиса высот/глубин
	google.maps.event.addListener(map, 'click', getElevation);
	function getElevation(event) {
		var locations = [];
		// Retrieve the clicked location and push it on the array
		var clickedLocation = event.latLng;
		locations.push(clickedLocation);

		// Create a LocationElevationRequest object using the array's one value
		var positionalRequest = {'locations': locations}

		// Initiate the location request
		elevator.getElevationForLocations(positionalRequest, function(results, status) {
			if (status == google.maps.ElevationStatus.OK) {
				// Retrieve the first result
				if (results[0]) {
					// Open an info window indicating the elevation at the clicked position
					infowindow.setContent('The elevation at this point <br>is ' + Math.round(results[0].elevation) + ' meters.');
					infowindow.setPosition(clickedLocation);
					infowindow.open(map);
				} else {
					alert('No results found');
				}
			} else {
				alert('Elevation service failed due to: ' + status);
			}
		});
	}
// END Сервис получения высот/глубин

// Сохранение состояния карты в URL
// Сохранение состояния карты в URL
	setMapStateByHash(); //отрисовка при первоначальном запуске
	$(window).on('hashchange', function() { setMapStateByHash();}); //отрисовка после изменения hash
	google.maps.event.addListener(map, 'dragend', function() {setLocationHash(); });
	google.maps.event.addListener(map, 'zoom_changed', function() {setLocationHash(); });
	google.maps.event.addListener(map, 'maptypeid_changed', function() {setLocationHash(); });

	//http://gmaps-samples-v3.googlecode.com/svn/trunk/map_events/map_events.html
	//bounds_changed center_changed click dblclick drag dragend dragstart heading_changed idle maptypeid_changed mousemove
	//mouseout mouseover projection_changed resize rightclick tilesloaded tilt_changed zoom_changed
	
	// получение параметров из hash
	function getParam (name, location) {
		location = location || window.location.hash;
		var res = location.match(new RegExp('[#/]' + name + '=([^/]*)', 'i'));
		return (res && res[1] ? res[1] : false);
	}

	// передача параметров в hash
	function setLocationHash () {
		var params = [
			'type=' + map.getMapTypeId(),
			'center=' + map.getCenter().lat().toFixed(6) + ',' + map.getCenter().lng().toFixed(6),
			'zoom=' + map.getZoom()
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
			case 'roadmap' : map.setMapTypeId(google.maps.MapTypeId.ROADMAP); break;
			case 'terrain' : map.setMapTypeId(google.maps.MapTypeId.TERRAIN); break;
			case 'hybrid' : map.setMapTypeId(google.maps.MapTypeId.HYBRID); break;
			case 'satellite' : map.setMapTypeId(google.maps.MapTypeId.SATELLITE); break;
			default : newHash = true; break;
		}
		
		if (hashCenter) {
			hashCenter = hashCenter.split(',');
			map.setCenter(new google.maps.LatLng(parseFloat(hashCenter[0]),parseFloat(hashCenter[1])));
		}
		else newHash = true;
		
		if (hashZoom) map.setZoom(hashZoom);
		else newHash = true 
		
		//если какой-либо из параметров отсутствовал, то
		//получить текущие параметры карты и передать их в hash
		if (newHash)
			setLocationHash();
	}
// END Сохранение состояния карты в URL
}
</script>

<style type="text/css">
	@media print {html, body {height:auto;}}
	*		{margin:0;padding:0;}
	body	{overflow:hidden;font-size:80%;color:#000;background-color:#fff;font-family:arial,helvetica,sans-serif;}
	#map-canvas {position:absolute;top:0;right:0;bottom:0;left:0;}
</style>
</head>

<body>
	<div id="map-canvas"></div>
</body>
</html>