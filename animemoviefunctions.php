<?
// functions acting on all anime
	function getAllAnimeMovies()
	{
		$sql = "SELECT * FROM AnimeMovies ORDER BY name";
		return getQueryAsArray($sql);
	}

	function getAllAnimeMovieNames()
	{
		$anime = getAllAnimeMovies();
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

	function getAllAnimeMoviesEnglish()
	{
		$anime = getAllAnimeMovies();
		$returnArray = array();
		foreach ($anime as $i=>$v)
		{
			if($v[3] == "English")
			{
				array_push($returnArray, $v);
			}
		}
		return $returnArray;
	}

	function getAllAnimeMoviesEnglishNames()
	{
		$anime = getAllAnimeEnglish();
		$previousName = "";
		$returnArray = array();
		foreach ($anime as $i=>$v)
		{
			if($v[1] != $previousName)
			{
				array_push($returnArray, $v);
			}
			$previousName = $v[1];
		}
		return $returnArray;
	}

	function getAllAnimeMoviesJapanese()
	{
		$anime = getAllAnimeMovies();
		$returnArray = array();
		foreach ($anime as $i=>$v)
		{
			if($v[3] == "Japanese")
			{
				array_push($returnArray, $v);
			}
		}
		return $returnArray;
	}

	function getAllAnimeMoviesJapaneseNames()
	{
		$anime = getAllAnimeJapanese();
		$previousName = "";
		$returnArray = array();
		foreach ($anime as $i=>$v)
		{
			if($v[1] != $previousName)
			{
				array_push($returnArray, $v);
			}
			$previousName = $v[1];
		}
		return $returnArray;
	}

?>
