<?
	include '../sqlfunctions.php';
	$sql = "SELECT DISTINCT name FROM Anime";
	$sqlArray = getQueryAsArray($sql);
	$returnXML = "<?xml version='1.0' encoding='UTF-8'>\n";
	foreach($sqlArray as $i=>$x)
	{
		$returnXML .= "\t<title>\n\t\t$x[0]\n\t</title>\n";
	}
	echo $returnXML;
?>
