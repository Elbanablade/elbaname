<?
//animenewsnetwork.com
	function getAnimeInfoANN($animeName)
	{
		$returnArray = array();
		$pageURL = getAnimePageURLANN($animeName);
		$html = new simple_html_dom();
		$html->load(file_get_contents($pageURL));
		$returnArray['imageURL'] = $returnArray[0] = getImageURLANN($html);
		$returnArray['titles'] = $returnArray[1] = getAnimeTitlesANN($html);
		$returnArray['genres'] = $returnArray[2] = getAnimeGenresANN($html);
		$returnArray['themes'] = $returnArray[3] = getAnimeThemesANN($html);
		$returnArray['summary'] = $returnArray[4] = getAnimeSummaryANN($html);
		$returnArray['numberOfEpisodes'] = $returnArray[5] = getAnimeNumberOfEpisodesANN($html);

		return $returnArray;
	}

	function getAnimePageURLANN($animeName)
	{
		$html = new simple_html_dom();
		$html->load(file_get_contents("http:/" . "/www.animenewsnetwork.com/encyclopedia/search/name?q=" . $animeName));
		$element = $html->find('a');
		foreach($element as $i=>$v)
		{
			if(strpos($v, 'anime.php?id=') !== false)
			{
				return "http:/" . "/www.animenewsnetwork.com" . $v->href;
			}
		}
	}

	function getImageURLANN($html)
	{
		$element = $html->find('img');
		foreach($element as $i=>$v)
		{
			if(strpos($v, 'thumbnails') !== false)
			{
				return $v->src;
			}
		}
	}

	function getAnimeTitlesANN($html)
	{
		$element = $html->find('div[id=infotype-2]');
		$returnArray = array();
		foreach($element[0]->children as $i=>$v)
		{
			if($i != 0)
			{
				$language = explode(')', explode('(', $v->innertext)[1])[0];
				$translation = explode('(', $v->innertext)[0];
				$returnArray[$language] = $returnArray[$i] = $translation;
			}
		}
		return $returnArray;
	}

	function getAnimeGenresANN($html)
	{
		$returnArray = array();
		$element = $html->find('div[id=infotype-30]');
		foreach($element[0]->children as $i=>$v)
		{
			if($i != 0)
			{
				array_push($returnArray, $v->children(0)->innertext);
			}
		}
		return $returnArray;
	}

	function getAnimeThemesANN($html)
	{
		$returnArray = array();
		$element = $html->find('div[id=infotype-31]');
		foreach($element[0]->children as $i=>$v)
		{
			if($i != 0)
			{
				array_push($returnArray, $v->children(0)->innertext);
			}
		}
		return $returnArray;
	}

	function getAnimeSummaryANN($html)
	{
		$element = $html->find('div[id=infotype-12]');
		return $element[0]->children(1)->innertext;
	}

	function getAnimeNumberOfEpisodesANN($html)
	{
		$element = $html->find('div[id=infotype-3]');
		return $element[0]->children(1)->innertext;
	}

//animeinfo.com
	function getAnimeInfoAI($animeName)
	{
		$returnArray = array();
		if($pageURL = getAnimePageAI($animeName))
		{
			$html = new simple_html_dom();
			$html->load(file_get_contents($pageURL));
			$returnArray['imageURL'] = $returnArray[0] = getImageURLAI($html);
			$returnArray['englishTitle'] = $returnArray[1] = getEnglishTitleAI($html);
			$returnArray['japaneseTitle'] = $returnArray[2] = getJapaneseTitleAI($html);
			$returnArray['totalEpisodes'] = $returnArray[3] = getTotalEpisodesAI($html);
			$returnArray['genres'] = $returnArray[4] = getGenresAI($html);
			$returnArray['yearPublished'] = $returnArray[5] = getyearPublishedAI($html);
			$returnArray['summary'] = $returnArray[6] = getSummaryAI($html);
		}
		return $returnArray;
	}

	function getAnimePageAI($animeName)
	{
		$html = new simple_html_dom();
		$html->load(file_get_contents("http:/" .  "/www.animenfo.com/search.php?query=" . $animeName . "&action=Go&queryin=anime_titles&option=keywords"));
		$element = $html->find('a');
		foreach($element as $i=>$v)
		{
			if(strpos($v, 'animetitle,') !== false)
			{
				return "http:/" . "/www.animenfo.com/" . $v->href;
			}
		}
	}

	function getImageURLAI($html)
	{
		$element = $html->find('img[class=float]');
		foreach($element as $i=>$v)
		{
			if(strpos($v, 'image') !== false)
			{
				return "http:/" . "/www.animenfo.com/" . $v->src;
			}
		}
	}

	function getEnglishTitleAI($html)
	{
		$element = $html->find('td[class=anime_info_top]');
		return $element[1]->innertext;
	}

	function getJapaneseTitleAI($html)
	{
		$element = $html->find('table[class=anime_info]');
		return $element[0]->children(1)->children(1)->innertext;
	}

	function getTotalEpisodesAI($html)
	{
		$element = $html->find('table[class=anime_info]');
		return explode("&", $element[0]->children(4)->children(1)->innertext)[0];

	}

	function getGenresAI($html)
	{
		$returnArray=array();
		$element = $html->find('table[class=anime_info]');
		foreach($element[0]->children(5)->children(1)->find('a') as $i=>$v)
		{
			array_push($returnArray, $v->innertext);
		}
		return $returnArray;
	}

	function getYearPublishedAI($html)
	{
		$element = $html->find('table[class=anime_info]');
		return $element[0]->children(6)->children(1)->children(0)->innertext;
	}

	function getSummaryAI($html)
	{
		$totalText = "";
		$element = $html->find('td[class=description]');
		foreach($element as $i=>$v)
		{
			if(strpos($v->innertext,"~") !== false)
			{
				return preg_replace("/<br \/>/", " ", explode("~", $v->innertext)[0]);
			}
		}
	}

//imdb.com

	function getMovieInfoIMDB($movieName)
	{
		echo $movieName . "\n";
		$returnArray = array();
		$pageURL = getPageURLIMDB($movieName);
		$html = new simple_html_dom();
		$html->load(file_get_contents($pageURL));
		$returnArray['imageURL'] = $returnArray[0] = getMoviePosterIMDB($html);
		$returnArray['yearReleased'] = $returnArray[1] = getYearReleasedIMDB($html);
		$returnArray['motionPictureRating'] = $returnArray[2] = getMotionPictureRatingIMDB($html);
		$returnArray['movieLength'] = $returnArray[3] = getMovieLengthIMDB($html);
		$returnArray['userRating'] = $returnArray[4] = getUsersRatingIMDB($html);
		$returnArray['summary'] = $returnArray[5] = getSummaryIMDB($html);
		$returnArray['genres'] = $returnArray[6] = getGenresIMDB($html);
		return $returnArray;
	}

	function getPageURLIMDB($movieName)
	{
		switch($movieName)
		{
			case "airplane":
				return "http:/" . "/www.imdb.com/title/tt0080339";
			case "bourne_identity":
				return "http:/" . "/www.imdb.com/title/tt0258463";
			case "catch_44":
				return "http:/" . "/www.imdb.com/title/tt1886493";
			case "enemies_closer":
				return "http:/" . "/www.imdb.com/title/tt2395199";
			case "freezer":
				return "http:/" . "/www.imdb.com/title/tt2325002";
			case "gi_joe_rise_of_cobra":
				return "http:/" . "/www.imdb.com/title/tt1046173";
			case "green_lantern":
				return "http:/" . "/www.imdb.com/title/tt1133985";
			case "harry_potter_(1)_and_the_philosopher's_stone":
				return "http:/" . "/www.imdb.com/title/tt0241527";
			case "harry_potter_(2)_and_the_chamber_of_secrets":
				return "http:/" . "/www.imdb.com/title/tt0295297";
			case "harry_potter_(3)_and_the_prizoner_of_askaban":
				return "http:/" . "/www.imdb.com/title/tt0304141";
			case "harry_potter_(4)_and_the_goblet_of_fire":
				return "http:/" . "/www.imdb.com/title/tt0330373";
			case "harry_potter_(5)_and_the_order_of_the_phoenix":
				return "http:/" . "/www.imdb.com/title/tt0373889";
			case "harry_potter_(6)_and_the_half_blood_prince":
				return "http:/" . "/www.imdb.com/title/tt3012102";
			case "harry_potter_(7)_and_the_deathly_hallows_part_1":
				return "http:/" . "/www.imdb.com/title/tt0926084";
			case "harry_potter_(7)_and_the_deathly_hallows_part_2":
				return "http:/" . "/www.imdb.com/title/tt1201607";
			case "indiana_jones_(1)_the_kingdom_of_the_crystal_skull":
				return "http:/" . "/www.imdb.com/title/tt0367882";
			case "indiana_jones_(2)_raiders_of_the_lost_ark":
				return "http:/" . "/www.imdb.com/title/tt0082971";
			case "indiana_jones_(3)_the_last_crusade":
				return "http:/" . "/www.imdb.com/title/tt0097576";
			case "indiana_jones_(4)_the_temple_of_doom":
				return "http:/" . "/www.imdb.com/title/tt0087469";
			case "jacki_chan_kung_fu_master":
				return "http:/" . "/www.imdb.com/title/tt2150394";
			case "james_bond_(01)_dr_no":
				return "http:/" . "/www.imdb.com/title/tt0055928";
			case "james_bond_(02)_from_russia_with_love":
				return "http:/" . "/www.imdb.com/title/tt0057076";
			case "james_bond_(03)_goldfinger":
				return "http:/" . "/www.imdb.com/title/tt0058150";
			case "james_bond_(04)_thunderball":
				return "http:/" . "/www.imdb.com/title/tt0059800";
			case "james_bond_(05)_you_only_live_twice":
				return "http:/" . "/www.imdb.com/title/tt0062512";
			case "james_bond_(06)_on_her_magesty's_secret_service":
				return "http:/" . "/www.imdb.com/title/tt0064757";
			case "james_bond_(07)_diamonds_are_forever":
				return "http:/" . "/www.imdb.com/title/tt0066995";
			case "james_bond_(08)_live_and_let_die":
				return "http:/" . "/www.imdb.com/title/tt0070328";
			case "james_bond_(09)_the_man_with_the_golden_gun":
				return "http:/" . "/www.imdb.com/title/tt0071807";
			case "james_bond_(10)_the_spy_who_loved_me":
				return "http:/" . "/www.imdb.com/title/tt0076752";
			case "james_bond_(11)_moonraker":
				return "http:/" . "/www.imdb.com/title/tt0079574";
			case "james_bond_(12)_for_your_eyes_only":
				return "http:/" . "/www.imdb.com/title/tt0082398";
			case "james_bond_(13)_octopussy":
				return "http:/" . "/www.imdb.com/title/tt0086034";
			case "james_bond_(14)_a_view_to_kill":
				return "http:/" . "/www.imdb.com/title/tt0090264";
			case "james_bond_(15)_the_living_daylights":
				return "http:/" . "/www.imdb.com/title/tt0093428";
			case "james_bond_(16)_license_to_kill":
				return "http:/" . "/www.imdb.com/title/tt0087617";
			case "james_bond_(17)_goldeneye":
				return "http:/" . "/www.imdb.com/title/tt0113189";
			case "james_bond_(18)_tomorrow_never_dies":
				return "http:/" . "/www.imdb.com/title/tt0120347";
			case "james_bond_(19)_the_world_is_not_enough":
				return "http:/" . "/www.imdb.com/title/tt0143145";
			case "james_bond_(20)_die_another_day":
				return "http:/" . "/www.imdb.com/title/tt0246460";
			case "james_bond_(21)_casino_royal":
				return "http:/" . "/www.imdb.com/title/tt0381061";
			case "james_bond_(22)_quantum_of_solace":
				return "http:/" . "/www.imdb.com/title/tt0830515";
			case "james_bond_(23)_skyfall":
				return "http:/" . "/www.imdb.com/title/tt1074638";
			case "lemony_snicket's_a_series_of_unfortunate_events_-_sd":
				return "http:/" . "/www.imdb.com/title/tt0339291";
			case "lord_of_the_rings_(1)_the_fellowship_of_the_ring":
				return "http:/" . "/www.imdb.com/title/tt0120737";
			case "lord_of_the_rings_(2)_the_two_towers":
				return "http:/" . "/www.imdb.com/title/tt0167261";
			case "lord_of_the_rings_(3)_the_return_of_the_king":
				return "http:/" . "/www.imdb.com/title/tt0167260";
			case "mission_impossible_1":
				return "http:/" . "/www.imdb.com/title/tt0117060";
			case "pain_and_gain":
				return "http:/" . "/www.imdb.com/title/tt1980209";
			case "scorpion_king_3":
				return "http:/" . "/www.imdb.com/title/tt1781896";
			case "scorpion_king":
				return "http:/" . "/www.imdb.com/title/tt0277296";
			case "scorpion_king_2":
				return "http:/" . "/www.imdb.com/title/tt1104123";
			case "the_warriors_way":
				return "http:/" . "/www.imdb.com/title/tt1032751";
			case "tomb_raider_ascension":
				return "http:/" . "/www.imdb.com/title/tt1629741";
			case "underworld_evolution":
				return "http:/" . "/www.imdb.com/title/tt0401855";
			case "x-men_origines_wolverine":
				return "http:/" . "/www.imdb.com/title/tt0458525";
			case "conan":
				return "http:/" . "/www.imdb.com/title/tt0816462";
			case "enemies_closer":
				return "http:/" . "/www.imdb.com/title/tt2395199";
			case "":
				return "http:/" . "/www.imdb.com/title/";
			case "":
				return "http:/" . "/www.imdb.com/title/";
			case "":
				return "http:/" . "/www.imdb.com/title/";
			case "":
				return "http:/" . "/www.imdb.com/title/";
			case "":
				return "http:/" . "/www.imdb.com/title/";
			default:
				$html = new simple_html_dom();
				if($html->load(file_get_contents("http:/" . "/www.imdb.com/find?q=" . preg_replace("/_/", "+", $movieName) . "&s=all")))
				{
					$element = $html->find('td[class=result_text]');
					if(isset($element[0]))
					return "http:/" . "/www.imdb.com" . $element[0]->children(0)->href;
				}
				return "";
		}
	}

	function getMoviePosterIMDB($html)
	{
		$counter = 0;
		$element = $html->find('img');
		foreach($element as $i=>$v)
		{
			if(strpos($v, 'images') !== false)
			{
				if($counter == 2)
				{
					return $v->src;
				}
				$counter++;
			}
		}
	}
	function getYearReleasedIMDB($html)
	{
		$element = $html->find('span[class=nobr]');
		if(isset($element[3]))
		{
			return explode(")", explode("(", $element[3]->innertext)[1])[0];
		}
		return "";
	}

	function getMotionPictureRatingIMDB($html)
	{
		$element = $html->find('span[itemprop=contentRating]');
		if(isset($element[0]))
		{
			return $element[0]->content;
		}
		return "";
	}

	function getMovieLengthIMDB($html)
	{
		$element = $html->find('time');
		if(isset($element[0]))
		{
			return trim($element[0]->innertext);
		}
		return "";
	}

	function getUsersRatingIMDB($html)
	{
		$element = $html->find('span[itemprop=ratingValue]');
		if(isset($element[0]))
		{
			return $element[0]->innertext;
		}
		return "";
	}

	function getSummaryIMDB($html)
	{
		$element = $html->find('div[itemprop=description]');
		if(isset($element[0]))
		{
			return trim(explode ("<em", $element[0]->children(0)->innertext)[0]);
		}
		else
		return "";
	}

	function getGenresIMDB($html)
	{
		$returnArray = array();
		$element = $html->find('div[itemprop=genre]');
		if(isset($element[0]))
		{
			$element = $element[0]->find('a');
			foreach($element as $i=>$v)
			{
				array_push($returnArray, $v->innertext);
			}
		}
		return $returnArray;
	}

	function downloadAllMovieImages()
	{
		$sql = "SELECT * FROM Movies";
		$movies = getQueryAsArray($sql);
		foreach($movies as $i=>$x)
		{
			file_put_contents("/media/data/images/movie_thumbs/$x[1].jpg", fopen($x[5], 'r'));
		}
	}
	function downloadIndividualMovieImage($movieName)
	{
		$sql = "SELECT * FROM Movies WHERE name=\"" . $movieName . "\"";
		$movies = getQueryAsArray($sql);
		foreach($movies as $i=>$x)
		{
			file_put_contents("/media/data/images/movie_thumbs/$x[1].jpg", fopen($x[5], 'r'));
		}
	}



?>
