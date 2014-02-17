<?
// functions acting on all anime
	function getAllMovies()
	{
		$sql = "SELECT * FROM Movies ORDER BY name";
		return getQueryAsArray($sql);
	}

	function getAllMovieNames()
	{
		$anime = getAllMovies();
		$previousName = "";
		$returnArray = array();
		foreach ($anime as $i=>$v)
		{
			if($v[1] != $previousName)
			{
				array_push($returnArray, $v[1]);
			}
			$previousName = $v[1];
		}
		return $returnArray;
	}
?>
