<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Bing Map | Kirill Aristov</title>
<script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
<script type="text/javascript" src="/theme/jquery/jquery.min.js"></script>

<script type="text/javascript">
var map = null;

Microsoft.Maps.loadModule('Microsoft.Maps.Overlays.Style', { callback: GetMap });

function GetMap() {
	var options = {
		credentials: "AiZFyLLjG6DoJAF_l4PcxWeKI2NijX6zM1UNA6vyMo0ZCBd5Z4DqIEjaPyJeDrtI",
		center: new Microsoft.Maps.Location(46,0),
		mapTypeId: Microsoft.Maps.MapTypeId.aerial, //aerial = спутник; birdseye = под углом
		zoom: 2,
		customizeOverlays: true
	}
	map = new Microsoft.Maps.Map(document.getElementById("mapDiv"), options);

	//Координаты при клике
	Microsoft.Maps.Events.addHandler(map, 'click', displayLatLong);
	function displayLatLong(e) {
	if (e.targetType == "map") {
		var point = new Microsoft.Maps.Point(e.getX(), e.getY());
		var loc = e.target.tryPixelToLocation(point);
		document.getElementById("textBox").value= loc.latitude.toFixed(6) + ", " + loc.longitude.toFixed(6);
	}
}
	
// Сохранение состояния карты в URL
// Сохранение состояния карты в URL
	setMapStateByHash(); //отрисовка при первоначальном запуске
	$(window).on('hashchange', function() { setMapStateByHash();}); //отрисовка после изменения hash
	Microsoft.Maps.Events.addHandler(map, 'viewchangeend', setLocationHash);
	

	// получение параметров из hash
	function getParam (name, location) {
		location = location || window.location.hash;
		var res = location.match(new RegExp('[#/]' + name + '=([^/]*)', 'i'));
		return (res && res[1] ? res[1] : false);
	}

	// передача параметров в hash
	function setLocationHash () {
		var mapType;
		switch (map.getMapTypeId()) {
			case 'r': mapType = 'roadmap'; break;
			case 'a': mapType = 'satellite'; break;
			default: mapType = 'roadmap'; break;
		}
		var params = [
			'type=' + mapType,
			'center=' + map.getCenter().latitude.toFixed(6) + ',' + map.getCenter().longitude.toFixed(6),
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
			case 'roadmap' : map.setView({mapTypeId: Microsoft.Maps.MapTypeId.road}); break;
			case 'satellite' : case 'hybrid' : map.setView({mapTypeId: Microsoft.Maps.MapTypeId.aerial}); break;
			default : newHash = true; break;
		}
		
		if (hashCenter) {
			hashCenter = hashCenter.split(',');
			map.setView({center: new Microsoft.Maps.Location(parseFloat(hashCenter[0]), parseFloat(hashCenter[1]) )} );
		}
		else newHash = true;
		
		if (hashZoom) map.setView({zoom: hashZoom});
		else newHash = true;
		
		//если какой-либо из параметров отсутствовал, то
		//получить текущие параметры карты и передать их в hash
		if (newHash)
			setLocationHash();
	}
// END Сохранение состояния карты в URL
}
</script>
<style type="text/css">
	*		{margin:0;padding:0;}
	body	{overflow:hidden;font-size:80%;color:#000;background-color:#fff;font-family:arial,helvetica,sans-serif;}
	.map	{position:absolute;top:0;right:0;bottom:0;left:0;}
	input#textBox	{position:absolute;top:0;left:150px;z-index:100;line-height:30px;height:30px;padding:0 5px;border:none;}
</style>
</head>

<body> 
	<div id="mapDiv" class="map"></div>
	<input id="textBox" type="text" />
</body>
</html>