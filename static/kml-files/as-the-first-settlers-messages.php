<?php 
header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="utf-8"?>'."\n";
?>
<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">
  <Document>
    <Style id="line">
      <LineStyle>
        <color>ff0000ff</color>
        <width>1</width>
      </LineStyle>
    </Style>
	
	<Style id="icons">
		<IconStyle>
			<Icon>
				<href>http://kirillaristov.com/theme/map-icon.png</href>
			</Icon>
		</IconStyle>
	</Style>

    <Folder>
      <name><![CDATA[2014+:<br />As the First Russian Settlers]]></name>
      <description/>

      <Placemark>
		<name>As the first Russian Settlers Track</name>
        <date>2014+</date>
        <styleUrl>#line</styleUrl>
        <LineString>
			<tessellate>1</tessellate>
			<coordinates>
<?php
$blog_xml = simplexml_load_file ($_SERVER['DOCUMENT_ROOT'].'/2014-257/blog.xml');

$coord_array = $blog_xml->xpath("//messages/item/coord");

//создаю линию, если у сообщения есть координаты
foreach ($coord_array as $item) {
	if ($item != '') {
		echo preg_replace("/(\d{1,3}\.\d{1,6}),(\d{1,3}\.\d{1,6})/", "$2,$1", $item).",0 ";
	}
}
?>
			</coordinates>
		</LineString>
	</Placemark>
<?php
//перебираю координаты сообщений, если они есть - делаю метку
$position = 0;
foreach ($coord_array as $item) {
	if ($item != '') { ?>
		<Placemark>
			<name><![CDATA[<?php echo $blog_xml->messages->item[$position]->date; echo ". "; echo htmlspecialchars_decode($blog_xml->messages->item[$position]->title_ru, ENT_QUOTES); ?>]]></name>
			<description><![CDATA[<?php echo htmlspecialchars_decode($blog_xml->messages->item[$position]->content_ru, ENT_QUOTES); echo "<br /><br /><i>Coordinates: $item</i>"; ?>]]></description>
			<styleUrl>#icons</styleUrl>
			<Point><coordinates><?php echo preg_replace("/(\d{1,3}\.\d{1,6}),(\d{1,3}\.\d{1,6})/", "$2,$1", $item); ?></coordinates></Point>
		</Placemark>
<?php }
	$position++;
} ?>
	</Folder>
</Document>
</kml>