<?php
	require_once("../classes/sqlite.php");

	
	$db = new MyDB("../Countries.db");

	$cc = SQLite3::escapeString($_GET['country_code']);
	$c = SQLite3::escapeString($_GET['country']);
	
	$result = $db->query("select country_code from CountryRedirect where country = '$c' limit 1") or die('Query failed 1');
	while (list($iso3) = $result->fetchArray())
	{
		if ($iso3) {
			$cc = $iso3;
		}
	}
	
	$result = $db->query("select latitude,longitude from Countries where country_code = '$cc' limit 1") or die('Query failed 2');
	while (list($lat,$lon) = $result->fetchArray())
	{
	 $arr = array ('lat'=>$lat,'lon'=>$lon);	
	}
	echo json_encode($arr);


?>