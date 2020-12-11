<html>
<head>
	<title>My KML Files | Kirill Aristov</title>
</head>
<body>
<h3>My KML Files. Kirill Aristov</h3>
<h4><a href="/en/">Home Page</a></h4>
<table>
<?php
$files = array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/kml-files'), array('.','..','.htaccess','files'));
arsort($files);
foreach ($files as $item) {
	if (preg_match("/(\.kml|\.php)/", $item)) {
		if ($item != 'index.php') {
			$filesize = round(filesize("$_SERVER[DOCUMENT_ROOT]/kml-files/$item")/1024);
			echo <<<EOT
<tr>
<td><a href="$item">$item</a></td>
<td>($filesize Kbytes)</td>
</tr>
EOT;
		}
	}
}
?>
</table>
</body>
</html>