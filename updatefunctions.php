<?
	function updateAnime($verbose)
	{
		$animeLocation = "/media/data/videos/anime/series";
		$anime = scandir( $animeLocation );
		unset( $anime[0] );
		unset( $anime[1] );
		$sql = "DROP TABLE Anime";

		if(runQuery($sql) == 1)
		{
			echo "failed to drop table";
			exit;
		}

		$sql = "CREATE TABLE Anime (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(200), season VARCHAR(60), episode VARCHAR(60), quality VARCHAR(60), language VARCHAR(60), fileType VARCHAR(60), fileLocation VARCHAR(500) )";

		if(runQuery($sql) == 1)
		{
			echo "failed to create table";
			exit;
		}
		if($verbose == 1)
		{
			echo "Updating tables\n\t";
			$bar = new Console_ProgressBar('[%bar%] %percent%', '=>', ' ', 80, (count($anime)));
			$barProgress=0;
			$bar->update($barProgress);
			foreach ( $anime as $i=>$value )
			{
				$animeDirectory = $animeLocation . "/" . $value;
				$animeEpisodes = scandir( $animeDirectory );
				unset( $animeEpisodes[0] );
				unset( $animeEpisodes[1] );
				foreach( $animeEpisodes as $j=>$episode )
				{
					$parts = explode( "_-_", $episode );
					$name = $parts[0];
					$language = $parts[1];
					$seasonNum = trim( explode("e", $parts[2] )[0], "s" );
					$episodeNum = trim( explode("e", $parts[2] )[1], "e" );
					$quality = explode( ".", $parts[3] )[0];
					$fileType = explode( ".", $parts[3] )[1];
					$fileLocation="media/data/videos/anime/series/" . $name . "/" . $episode;
					$sql = "INSERT INTO Anime (name, season, episode, quality, language, fileType, fileLocation) VALUES (\"$name\", \"$seasonNum\", \"$episodeNum\", \"$quality\", \"$language\", \"$fileType\", \"$fileLocation\" )";
					if(runQuery($sql) == 1)
					{
						echo "Failed\t$sql\n";
					}
				}
				$bar->update($i);
			}
			echo "\nUpdating Info\n\t";
			$sql = "DROP TABLE AnimeInformation";
			runQuery($sql);
			$sql = "CREATE TABLE AnimeInformation (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, animeName VARCHAR(100), numberOfEpisodes INT)";
			runQuery($sql);
			$allAnimeNames = getAllAnimeNames();
			$bar = new Console_ProgressBar('[%bar%] %percent%', '=>', ' ', 80, count($allAnimeNames));
			$bar->update(0);
			foreach($allAnimeNames as $i=>$v)
			{
				$sql = "select * from Anime where name='" . $v . "'";
				$result = getQueryAsArray($sql);
				$numEpisodes = count($result);
				$sql = "INSERT INTO AnimeInformation(animeName, numberOfEpisodes) VALUES ('" . $v . "', $numEpisodes)";
				runQuery($sql);
				$bar->update($i+1);
			}
		}
		else
		{
			foreach ( $anime as $i=>$value )
			{
				$animeDirectory = $animeLocation . "/" . $value;
				$animeEpisodes = scandir( $animeDirectory );
				unset( $animeEpisodes[0] );
				unset( $animeEpisodes[1] );
				foreach( $animeEpisodes as $j=>$episode )
				{
					$parts = explode( "_-_", $episode );
					$name = $parts[0];
					$language = $parts[1];
					$seasonNum = trim( explode("e", $parts[2] )[0], "s" );
					$episodeNum = trim( explode("e", $parts[2] )[1], "e" );
					$quality = explode( ".", $parts[3] )[0];
					$fileType = explode( ".", $parts[3] )[1];
					$fileLocation="media/data/videos/anime/series/" . $name . "/" . $episode;
					$sql = "INSERT INTO Anime (name, season, episode, quality, language, fileType, fileLocation) VALUES (\"$name\", \"$seasonNum\", \"$episodeNum\", \"$quality\", \"$language\", \"$fileType\", \"$fileLocation\" )";
					if(runQuery($sql) == 1)
					{
						echo "Failed\t$sql\n";
					}
				}
			}
			$sql = "DROP TABLE AnimeInformation";
			runQuery($sql);
			$sql = "CREATE TABLE AnimeInformation (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, animeName VARCHAR(100), numberOfEpisodes INT)";
			runQuery($sql);
			$allAnimeNames = getAllAnimeNames();
			foreach($allAnimeNames as $i=>$v)
			{
				$sql = "select * from Anime where name='" . $v . "'";
				$result = getQueryAsArray($sql);
				$numEpisodes = count($result);
				$sql = "INSERT INTO AnimeInformation(animeName, numberOfEpisodes) VALUES ('" . $v . "', $numEpisodes)";
				runQuery($sql);
			}
		}

	}

	function updateAnimeInfo()
	{
		$sql = "DROP TABLE AnimeInfo";
		echo runQuery($sql) . "\n";
		$sql = "CREATE TABLE AnimeInfo ";
		$sql .= "(";
		$sql .= "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
		$sql .= ", imageURL VARCHAR(200)";
		$sql .= ", englishTitle VARCHAR(100)";
		$sql .= ", japaneseTitle VARCHAR(100)";
		$sql .= ", totalEpisodes INT";
		$sql .= ", genres VARCHAR(200)";
		$sql .= ", yearPublished INT";
		$sql .= ", summary VARCHAR(500)";
		$sql .= ")";
		echo runQuery($sql) . "\n";
		$allAnimeData = array();
		$allAnimeNames = getAllAnimeNames();
		foreach($allAnimeNames as $i=>$v)
		{
			echo $v . "\n";
			if($animeInfo = getAnimeInfoAI($v))
			{
			echo $animeInfo[0] . "\n";
			echo $animeInfo[1] . "\n";
			echo $animeInfo[2] . "\n";
			echo $animeInfo[3] . "\n";
			print_r($animeInfo[4]);
			echo "\n";
			echo $animeInfo[5] . "\n";
			echo $animeInfo[6] . "\n";
			}
			else
			{
				echo "$v failed\n\n\n\n\n";
			}
//			echo "Press enter to continue\n>";
//			$line = fgets(fopen("php://stdin", "r"));
//			echo "\n";
		}
	}

	function updateAnimeMovies()
	{
		$animeLocation = "/media/data/videos/anime/Movies";
		$anime = scandir($animeLocation);
		unset($anime[0]);
		unset($anime[1]);
		$sql = "DROP TABLE AnimeMovies";
		runQuery($sql);
		$sql = "CREATE TABLE AnimeMovies (id INT NOT NULL AUTO_INCREMENT, name VARCHAR(100), quality VARCHAR(60), language VARCHAR(60), filetype VARCHAR(60), filelocation VARCHAR(256), PRIMARY KEY (id))";
		runQuery($sql);
		foreach ($anime as &$value)
		{

			$parts = explode ("_-_", $value);
			if(count($parts) != 3){echo "not enough parts\n$value\n";exit;}
			$name = $parts[0];
			$quality = $parts[1];
			$language = explode(".", $parts[2])[0];
			$filetype = explode(".", $parts[2])[1];
			$filelocation = $animeLocation . "/" . $value;
			$sql = 'INSERT INTO AnimeMovies (name, quality, language, filetype, filelocation) VALUES ("' . $name . '", "' . $quality. '", "' . $language . '", "' . $filetype . '", "' . $filelocation . '")';
			//insert if existing check
			runQuery($sql);
		}
	}

/*	function updateMovies()
	{
		$location = "/media/data/videos/Movies";
		$movies = scandir($location);
		unset($movies[0]);
		unset($movies[1]);
		$sql= "DROP TABLE Movies";
		runQuery($sql);
		$sql = "CREATE TABLE Movies (id INT NOT NULL AUTO_INCREMENT, name VARCHAR(100), filetype VARCHAR(60), quality VARCHAR(60), filelocation VARCHAR(256), PRIMARY KEY (id))";
		runQuery($sql);
		foreach ($movies as $i=>$value)
		{
			$filelocation = $location . "/" . $value;
			$name = explode("_-_", $value)[0];
			$quality = explode(".", explode("_-_", $value)[1])[0];
			$filetype = explode(".", $value)[1];
			$sql = 'INSERT INTO Movies (name, filetype, quality, filelocation) VALUES ("' . $name . '", "' . $filetype . '", "' . $quality  . '", "' . $filelocation . '")';
			runQuery($sql);
		}
	}
*/

	function updateMovies()
	{
		$existingMovies = array();
		$newMovies = array();

		$location = "/media/data/videos/Movies";
		$movies = scandir($location);
		unset($movies[0]);
		unset($movies[1]);
		$sql = "SELECT * FROM Movies";
		$databaseMovies = getQueryAsArray($sql);

		foreach($movies  as $i=>$x)
		{
			$exists = 0;
			foreach($databaseMovies as $j=>$y)
			{
				if(explode("_-_", $x)[0] == $y[1])
				{
					array_push($existingMovies, $y[1]);
					$exists = 1;
				}
			}
			if($exists == 0)
			{
				array_push($newMovies, $x);
			}
		}
		$moviesToDelete = array();
		foreach($databaseMovies as $i=>$x)
		{
			$delete = 0;
			foreach($movies as $j=>$y)
			{
				if(explode("_-_", $y)[0] == $x[1])
				{
					$delete = 1;
				}
			}
			if($delete == 0)
			{
				array_push($moviesToDelete, $x);
			}
		}
		foreach($moviesToDelete as $i=>$x)
		{
			$sql = "DELETE FROM Movies WHERE id=$x[0]";
			runQuery($sql);
		}
		foreach($newMovies as $i=>$x)
		{
			if($movieInfo = getMovieInfoIMDB(explode("_-_", $x)[0]))
			{
				$sql = "INSERT INTO Movies (name, filetype, quality, filelocation, imageUrl, imageLocation, year, mpaaRating, length, userRating, description, genres) VALUES (";
				$sql .= "\"" . explode("_-_", $x)[0] . "\",";
				$sql .= "\"" . explode(".", $x)[1] . "\",";
				$sql .= "\"" . explode(".", explode("_-_", $x)[1])[0] . "\",";
				$sql .= "\"/media/data/videos/Movies/$x\",";
				$sql .= "\"" . $movieInfo[0]  . "\",";
				$sql .= "\"/media/data/images/movie_thumbs/" . explode("_-_", $x)[0]  . ".jpg\",";
				$sql .= "\"" . $movieInfo[1]  . "\",";
				$sql .= "\"" . $movieInfo[2]  . "\",";
				$sql .= "\"" . $movieInfo[3]  . "\",";
				$sql .= "\"" . $movieInfo[4]  . "\",";
				$sql .= "\"" . preg_replace('/"/', "", $movieInfo[5])  . "\",";
				$sql .= "\"";
				foreach($movieInfo[6] as $j=>$k)
				{
					if($j < count($movieInfo[6])-1)
					{
						$sql .= $k  . ", ";
					}
					else
					{
						$sql .= $k  . " \"";
					}
				}
				$sql .= "\"" . date('y-m-d h:i:s', strtotime('+5 hours')) . "\"";
				$sql .= ")";
				runQuery($sql);
				downloadIndividualMovieImage(explode("_-_", $x)[0]);
				echo "done\t$x\n";
			}
			else
			{
				echo "failed\t$x\n";
			}
		}

	}
	function updateAllMovieInformation()
	{
		$sql = "select * from Movies";
		$movies = getQueryAsArray($sql);
		$bar = new Console_ProgressBar('[%bar%] %percent%', '=>', ' ', 80, (count($movies)));
		$barProgress=1;
		$bar->update($barProgress);
		foreach($movies as $i=>$x)
		{
			if($movieInfo = getMovieInfoIMDB($x[1]))
			{
				$sql = "UPDATE Movies SET ";
				$sql .= "imageUrl=\"" . $movieInfo[0]  . "\",";
				$sql .= "imageLocation=\"/media/data/images/movie_thumbs/" . $x[1]  . ".jpg\",";
				$sql .= "year=\"" . $movieInfo[1]  . "\",";
				$sql .= "mpaaRating=\"" . $movieInfo[2]  . "\",";
				$sql .= "length=\"" . $movieInfo[3]  . "\",";
				$sql .= "userRating=\"" . $movieInfo[4]  . "\",";
				$sql .= "description=\"" . trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags( preg_replace('/"/', "", $movieInfo[5])))))))  . "\",";
				$sql .= "genres=\"";
				foreach($movieInfo[6] as $j=>$k)
				{
					if($j < count($movieInfo[6])-1)
					{
						$sql .= $k  . ", ";
					}
					else
					{
						$sql .= $k  . " \"";
					}
				}
				$sql .= " where id=$x[0]";
				runQuery($sql);
			}
			downloadIndividualMovieImage($x[1]);
			$bar->update($i);
		}
	}




?>
