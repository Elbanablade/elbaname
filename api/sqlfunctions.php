<?
	$con = mysqli_connect("localhost", "webadmin", "password", "Main");

	function getQueryAsArray($query)
	{
		$returnArray = array();
		$result = mysqli_query($GLOBALS['con'], $query);
		while($r = mysqli_fetch_row($result))
		{
			$row = array();
			foreach($r as $i=>$v)
			{
				array_push($row, $v);
			}
			array_push($returnArray, $row);
			unset($row);
		}
		return $returnArray;
	}

	function runQuery($query)
	{
		$result = mysqli_query($GLOBALS['con'], $query);
		if(mysqli_error($GLOBALS['con']))
		{
			echo mysqli_error($GLOBALS['con']) . "\n";
			return 1;
		}
		return 0;
	}
?>
