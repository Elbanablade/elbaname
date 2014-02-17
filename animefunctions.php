<?
// functions acting on all anime
	function getAllAnime()
	{
		$sql = "SELECT * FROM Anime ORDER BY name, language, quality, season, episode";
		return getQueryAsArray($sql);
	}

	function getAllAnimeNames()
	{
		$anime = getAllAnime();
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

	function getAllAnimeDataNames()
	{
		$anime = getAllAnime();
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

	function getAllAnimeEnglish()
	{
		$anime = getAllAnime();
		$returnArray = array();
		foreach ($anime as $i=>$v)
		{
			if($v[5] == "English")
			{
				array_push($returnArray, $v);
			}
		}
		return $returnArray;
	}

	function getAllAnimeEnglishNames()
	{
		$anime = getAllAnimeEnglish();
		$previousName = "";
		$returnArray = array();
		foreach ($anime as $i=>$v)
		{
			if($v[2] != $previousName)
			{
				array_push($returnArray, $v);
			}
			$previousName = $v[2];
		}
		return $returnArray;
	}

	function getAllAnimeJapanese()
	{
		$anime = getAllAnime();
		$returnArray = array();
		foreach ($anime as $i=>$v)
		{
			if($v[5] == "Japanese")
			{
				array_push($returnArray, $v);
			}
		}
		return $returnArray;
	}

	function getAllAnimeJapaneseNames()
	{
		$anime = getAllAnimeJapanese();
		$previousName = "";
		$returnArray = array();
		foreach ($anime as $i=>$v)
		{
			if($v[2] != $previousName)
			{
				array_push($returnArray, $v);
			}
			$previousName = $v[2];
		}
		return $returnArray;
	}

//functions for watched Information
	function getAllAnimeInProgress($username)
	{
		$animeStatus = getAllAnimeWatchedStatus($username);
		$returnArray = array();
		foreach($animeStatus as $i=>$v)
		{
			if($v[1] == 2 || $v[2] == 2)
			{
				array_push($returnArray, $v[0]);
			}
		}
		return $returnArray;
	}

	function getAllAnimeUnWatched($username)
	{
		$allAnime = getAllAnimeNames();
		$animeStatus = getAllAnimeWatchedStatus($username);
		$returnArray = array();
		foreach($allAnime as $i=>$v)
		{
			$watchedFlag = 0;
			foreach($animeStatus as $j=>$w)
			{
				if($v == $w[0])
				{
					$watchedFlag = 1;
				}
			}
			if($watchedFlag == 1)
			{
			}
			else
			{
				array_push($returnArray, $v);
			}
		}
		return $returnArray;
	}

	function getAllAnimeWatched($username)
	{
		$animeStatus = getAllAnimeWatchedStatus($username);
		$returnArray = array();
		foreach($animeStatus as $i=>$v)
		{
			if($v[1] == 1 || $v[2] == 1)
			{
				array_push($returnArray, $v[0]);
			}
		}
		return $returnArray;
	}

	function getAllAnimeWatchedStatus($username)
	{
		$sql = "SELECT * FROM WatchedAnimeEpisodes WHERE username=\"$username\"ORDER BY username, animeName, language, season, episode";
		$watchedAnime = getQueryAsArray($sql);
		$animeInfo = array();
		$previousAnimeName = "";
		$japaneseWatched = 0;
		$englishWatched = 0;
		foreach($watchedAnime as $i=>$v)
		{

			if($previousAnimeName != $v[2])
			{
				array_push($animeInfo, array($previousAnimeName, $englishWatched, $japaneseWatched));
				$englishWatched = 0;
				$japaneseWatched = 0;
			}
			else
			{
				if($v[5] == "Japanese")
				{
					$japaneseWatched++;
				}
				else
				{
					$englishWatched++;
				}
			}
			$previousAnimeName = $v[2];
		}
		array_push($animeInfo, array($previousAnimeName, $englishWatched, $japaneseWatched));
		$animeWatchedResults = array();
		foreach($animeInfo as $i=>$v)
		{
			$englishWatched = 0;
			$japaneseWatched = 0;
			$englishEpisodes = getIndividualAnimeNumberOfEpisodesEnglish($v[0]);
			$japaneseEpisodes = getIndividualAnimeNumberOfEpisodesJapanese($v[0])-1;
			if($englishEpisodes > 0 && $v[1] <= $englishEpisodes)
			{
				$englishWatched = 1;
			}
			elseif($v[1] > 0)
			{
				$englishWatched = 2;
			}
			if($japaneseEpisodes > 0 && $v[2] == $japaneseEpisodes)
			{
				$japaneseWatched = 1;
			}
			elseif($v[2] > 0)
			{
				$japaneseWatched = 2;
			}
			array_push($animeWatchedResults, array($v[0], $englishWatched, $japaneseWatched));
		}
		return $animeWatchedResults;
	}

//functions for individual anime
	function getIndividualAnime($name)
	{
		$sql = "SELECT * FROM Anime where name=\"$name\" ORDER BY name, language, quality, season, episode";
		return getQueryAsArray($sql);
	}

	function getIndividualAnimeEnglish($name)
	{
		$sql = "SELECT * FROM Anime where name=\"$name\" AND language=\"English\"";
		return getQueryAsArray($sql);
	}

	function getIndividualAnimeJapanese($name)
	{
		$sql = "SELECT * FROM Anime where name=\"$name\" AND language=\"Japanese\"";
		return getQueryAsArray($sql);
	}

	function getIndividualAnimeNumberOfEpisodesEnglish($name)
	{
		$anime = getIndividualAnimeEnglish($name);
		return count($anime);
	}

	function getIndividualAnimeNumberOfEpisodesJapanese($name)
	{
		$anime = getIndividualAnimeJapanese($name);
		return count($anime);
	}

	function getIndividualAnimeNumberOfEpisodesWatchedEnglish($username, $name)
	{
		$sql = "SELECT * FROM WatchedAnimeEpisodes where username=\"$username\" AND animeName=\"$name\" AND language=\"English\"";
		return count(getQueryAsArray($sql));
	}

	function getIndividualAnimeNumberOfEpisodesWatchedJapanese($username, $name)
	{
		$sql = "SELECT * FROM WatchedAnimeEpisodes where username=\"$username\" AND animeName=\"$name\" AND language=\"Japanese\"";
		return count(getQueryAsArray($sql));
	}

	function getIndividualAnimeWatchedStatus($username, $name)
	{
		$sql = "SELECT * FROM WatchedAnimeEpisodes where username=\"$username\" AND animeName=\"$name\"";
		return getQueryAsArray($sql);
	}

	function getEpisodeWatchedStatus($username, $name, $season, $episode, $language)
	{
		$sql = "SELECT * FROM WatchedAnimeEpisodes where username=\"$username\" AND animeName=\"$name\" AND language=\"$language\" AND season=\"$season\" AND episode=\"$episode\"";
		return count(getQueryAsArray($sql));
	}
?>
