<?
	function printNavigation($permissionsLevel)
	{
?>
		<div class="navigation_hover">
			<div class="navigation">
<?
		if($permissionsLevel >= 1)
		{
?>
				<a href="movies.php">Movies</a>
				<a href="animemovies.php">Anime Movies</a>
				<a href="anime.php">Anime</a>
<?
		}

		if($permissionsLevel >= 6)
		{
?>
				<a href="admin.php">Admin</a>
<?
		}
?>
			</div>
		</div>
<?
	}

	function printHeader()
	{
		userTracking();
?>
		<header>
			<div class="m1 user_info">
<?
		if(checkCredentials($_COOKIE['username'], $_COOKIE['password']) == 1)
		{
			if($_SERVER["REQUEST_URI"] != "/index.php" && $_SERVER["REQUEST_URI"] != "/dev/index.php"  )
			{
				header("Location: index.php");
				exit;
			}
			else
			{
				printLoginBar();
			}
		}
		else
		{
			$permissionsLevel = getUserPermissionsLevel($_COOKIE['username']);
			if($_SERVER["REQUEST_URI"] != "/index.php" && $_SERVER["REQUEST_URI"] != "/dev/index.php"  && pageCheck($_SERVER["REQUEST_URI"], $permissionsLevel) == 0 )
			{
				header("Location: index.php");
				exit;
			}
?>
				<span class="username"><?= $_COOKIE['username']; ?></span>
				<a class="logout" href="logout.php">Logout</a>
<?
		}
?>
			</div>
			<div class="m2 site_name"><a class="site_name" href="index.php">Elbaname</a></div>
			<div class="m3 site_info">Alpha</div>
		</header>
		<div class="heading_block"></div>
<?
	}


	function printStylesheets()
	{
?>
		<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="default.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="javascript.js"></script>
<?
	}

	function printLoginBar()
	{
?>
		<form action="validation.php" method="post">
			<input type="text"
				value="username"
				name="username"
				onfocus="if(this.value == 'username') {this.value=''}"
				onblur="if(this.value == '') {this.value='username'}"
			/>
			<input type="password" name="password"/>
			<input type="submit" value="login"/>
		</form>
<?
	}

	function printWelcome()
	{
?>
		<div class="m4 welcome">
			<h3>Welcome</h3>
			<p><?= preg_replace("/\n/", "<br>", file_get_contents('welcome.txt')) ?></p>
		</div>
<?
	}

	function printAnouncements()
	{
?>
		<div class="m5 anouncements">
			<h3>Announcements</h3>
			<p><?= preg_replace("/\n/", "<br>", file_get_contents('anouncements.txt')) ?></p>
		</div>
<?
	}

	function printUpdates()
	{
?>
		<div class="m6 updates">
			<h3>Updates</h3>
			<table>
				<tr>
					<th class="date">Date</th>
					<th class="updates">Update</th>
				</tr>
				<tr>
					<td>
						<?= preg_replace("/\t/", "</td><td>", preg_replace("/\n/", "</td></tr><tr><td>", file_get_contents('updates.txt'))); ?>
					</td>
				</tr>
			</table>
		</div>
<?
	}

	function printAnime($view, $sort)
	{
		$watchedStatus = getAllAnimeWatchedStatus($_COOKIE["username"]);
		if($view == "grid")
		{
?>
		<div class="m6 anime grid">
<?
		}
		else
		{
?>
		<div class="m7 anime list">
<?
			switch($sort)
			{
				default:
					$animeNames = getAllAnimeDataNames();
					foreach($animeNames as $i=>$v)
					{
						$watched = "0";
						foreach($watchedStatus as $j=>$x)
						{
							if($x[0] == $v[1])
							{
								if($x[1] == 1 || $x[2] == 1)
								{
									$watched="1";
								}
								else if($x[1] == 2 || $x[2] == 2)
								{
									$watched="2";
								}
								break;
							}
						}
						switch($watched)
						{
							case 0:
								$watchedText = "unwatched";
								break;
							case 1:
								$watchedText = "watched";
								break;
							case 2:
								$watchedText = "inprogress";
								break;
						}
?>
			<a class="anime_link <?= $v[1] . " " . $v[4] . " " . $v[5] . " " . $watchedText ?>" href="animepage.php?name=<?= urlencode($v[1]) ?>" class="<?= $v[1] ?>"
				onmouseover="this.childNodes[1].style.display='block'"
				onmouseleave="this.childNodes[1].style.display='none'"
				onmouseover="$(this).animate({opacity: 1}, 1000, function(){this.childNodes[1].style.display='block'});"
				onmouseleave="$(this).animate({opacity: 1}, 200, function(){this.childNodes[1].style.display='none'});"
			>
				<?= preg_replace("/_/", " ", $v[1]) ?>
				<div class="quickview_anime" id="quickview<?= $v[1] ?>">
<?
						if($watched == 1)
						{
?>
							<img class="watched_banner" src="/media/data/images/watched.png"/>
<?
						}
						else if($watched == 2)
						{
?>
							<img class="watched_banner" src="/media/data/images/inprogress.png"/>
<?
						}
?>
					<img class="poster" src="/media/data/images/<?= $v[1] ?>.jpg" onerror="this.src='/media/data/images/404_not_found.gif'"/>
					<div class="info">
						<p>Name: <?= preg_replace("/_/", " ", $v[1]) ?></p>
<!--						<p>Season: <?= $v[2] ?></p>
						<p>Episode: <?= $v[3] ?></p>
-->						<p>Quality: <?= $v[4] ?></p>
						<p>Language: <?= $v[5] ?></p>
					</div>
				</div>
			</a>
<?
					}
					break;
			}
		}
?>
		</div>
<?
	}

	function printAnimeMovies($view, $sort)
	{
		if($view == "grid")
		{
?>
		<div class="m6 anime grid">
<?
		}
		else
		{
?>
		<div class="m7 anime list">
<?
			switch($sort)
			{
				case "UnWatched":
					echo "unWatched";
					break;
				default:
					$animeNames = getAllAnimeMovies();
					foreach($animeNames as $i=>$v)
					{
?>
			<a href="watchanimemovie.php?name=<?= urlencode($v[1]) ?>&id=<?= $v[0] ?>" class="anime_movie_link <?= $v[1] ?>"><?= preg_replace("/_/", " ", $v[1]) ?></a>
<?
					}
					break;
			}
		}
?>
		</div>
<?
	}

	function printMovies($view, $sort)
	{
		if($view == "grid")
		{
?>
		<div class="m6 grid">
<?
		}
		else
		{
?>
		<div class="m7 list">
<?
			switch($sort)
			{
				case "UnWatched":
					echo "unWatched";
					break;
				default:
					$movieNames = getAllMovies();
					foreach($movieNames as $i=>$v)
					{
?>
			<a class="movie_link <?= $v[1] . ' ' . $v[3] . ' ' . $v[7] . ' ' . $v[8] . ' ' . $v[9] . ' ' . $v[10] . ' ' . $v[12] . ' ' . $v[13] ?>" href="watchmovie.php?name=<?= urlencode($v[1]) ?>" class="<?= $v[1] ?>"
				onmouseover="this.childNodes[1].style.display='block'"
				onmouseleave="this.childNodes[1].style.display='none'"
			>
				<?= preg_replace("/_/", " ", $v[1]) ?>
			<div class="quickview_anime" id="quickview<?= $v[1] ?>">
				<img class="poster" src="/media/data/images/movie_thumbs/<?= $v[1] ?>.jpg" onerror="this.src='/media/data/images/404_not_found.gif'"/>
				<div class="info">
					<p>Name: <?= preg_replace("/_/", " ", $v[1]) ?></p>
					<p>Quality: <?= $v[3] ?></p>
					<p>Year: <?= $v[7] ?></p>
					<p>MPAA Rating: <?= $v[8] ?></p>
					<p>Length: <?= $v[9] ?></p>
					<p>Rating: <?= $v[10] ?></p>
					<p>Description: <?= substr($v[11], 0, 100) ?></p>
					<p>Genres: <?= $v[12] ?></p>
					<p>Date Added: <?= $v[13] ?></p>
				</div>
			</div>
			</a>
<?
					}
					break;
			}
		}
?>
		</div>
<?
	}

	function printSortOptions()
	{
?>
		<div class="m8 sort_options">
			<p>Sort</p>
			<div class="language sort">
				<span>Language</span>
				<a onclick="showAll();">All</a>
				<a onclick="showEnglishOnly();">English</a>
				<a onclick="showJapaneseOnly();">Japanese</a>
			</div>
			<div class="watched sort">
				<span>Watched Status</span>
				<a onclick="showAll();">All</a>
				<a onclick="showWatchedOnly();">Watched</a>
				<a onclick="showInProgressOnly();">In Progress</a>
				<a onclick="showUnWatchedOnly();">UnWatched</a>
			</div>
		</div>
<?
	}

	function printMovieSortOptions()
	{
?>
		<div class="m8 sort_options movie">
			<p>Refine</p>
			<div class="quality sort">
				<span onclick="togleVisible">Quality</span>
				<div class="options">
					<a onclick="showMovieAll();">All</a>
					<a onclick="showMovieQualityHd();">HD</a>
					<a onclick="showMovieQualitySd();">SD</a>
				</div>
			</div>
			<div class="mpaarating sort">
				<span onclick="togleVisible">MPAA Rating</span>
				<div class="options">
					<a onclick="showMovieAll();">All</a>
					<a onclick="showMovieMpaaRatingG();">G</a>
					<a onclick="showMovieMpaaRatingPg();">PG</a>
					<a onclick="showMovieMpaaRatingPg13();">PG-13</a>
					<a onclick="showMovieMpaaRatingR();">R</a>
					<a onclick="showMovieMpaaRatingUnrated();">UNRATED</a>
				</div>
			</div>
			<div class="rating sort">
				<span onclick="togleVisible">Rating</span>
				<div class="options">
					<a onclick="showMovieAll();">All</a>
					<a onclick="showMovieRating('10');">10+</a>
					<a onclick="showMovieRating('9');">9+</a>
					<a onclick="showMovieRating('8');">8+</a>
					<a onclick="showMovieRating('7');">7+</a>
					<a onclick="showMovieRating('6');">6+</a>
					<a onclick="showMovieRating('5');">5+</a>
					<a onclick="showMovieRating('4');">4+</a>
					<a onclick="showMovieRating('3');">3+</a>
					<a onclick="showMovieRating('2');">2+</a>
					<a onclick="showMovieRating('1');">1+</a>
				</div>
			</div>
			<div class="genre sort">
				<span onclick="togleVisible">Genres</span>
				<div class="options">
					<a onclick="showMovieAll();">All</a>
					<a onclick="showMovieGenre('Adventure');">Adventure</a>
					<a onclick="showMovieGenre('Action');">Action</a>
					<a onclick="showMovieGenre('Biography');">Biography</a>
					<a onclick="showMovieGenre('Crime');">Crime</a>
					<a onclick="showMovieGenre('Drama');">Drama</a>
					<a onclick="showMovieGenre('Mystery');">Mystery</a>
					<a onclick="showMovieGenre('Fantasy');">Fantasy</a>
					<a onclick="showMovieGenre('History');">History</a>
					<a onclick="showMovieGenre('Reality-TV');">Reality-TV</a>
					<a onclick="showMovieGenre('Romance');">Romance</a>
					<a onclick="showMovieGenre('Sci-Fi');">Sci-Fi</a>
					<a onclick="showMovieGenre('Sport');">Sport</a>
					<a onclick="showMovieGenre('Thriller');">Thriller</a>
					<a onclick="showMovieGenre('War');">War</a>
				</div>
			</div>
		</div>
<?
	}

	function printAnimePage($name)
	{
		$animeInfo = getIndividualAnime($name);
		$watchedEpisodes = getIndividualAnimeWatchedStatus($_COOKIE["username"], $animeInfo[0][1]);
?>
			<div class="m9 animeInfo">
				<table>
					<tr>
						<th>Name</th>
						<th>Season</th>
						<th>Episode</th>
						<th>Quality</th>
						<th>Language</th>
					</tr>
					<tr>
<?
		foreach($animeInfo as $i=>$v)
		{
?>
					</tr>
						<td><a href="watchanime.php?id=<?= $v[0] ?>"><?= preg_replace("/_/", " ", $v[1]) ?></a></td>
						<td><?= $v[2] ?></td>
						<td><?= $v[3] ?></td>
						<td><?= $v[4] ?></td>
						<td><?= $v[5] ?></td>
<?
			$watched = 0;
			foreach($watchedEpisodes as $j=>$x)
			{
				if($x[4] == $v[2] && $x[3] == $v[3])
				{
?>
						<td><a href="setEpisodeUnWatched.php?name=<?= $v[1] ?>&season=<?= $v[2] ?>&episode=<?= $v[3] ?>&language=<?= $v[5] ?>">Set UnWatched</a></td>
						<td style="color: green">Watched</td>
<?
						$watched = 1;
				}
			}
			if($watched == 0)
			{
?>
						<td><a href="setEpisodeWatched.php?name=<?= urlencode($v[1]) ?>&season=<?= $v[2] ?>&episode=<?= $v[3] ?>&language=<?= $v[5] ?>" class="next_mark_watched">set Watched</a></td>
<?
			}
?>
					<td>
<?
		}
?>
					</tr>
				</table>
			</div>
			<div class="m10 animeImage">
				<img src="/media/data/images/<?= $animeInfo[0][1] ?>.jpg"  onerror="this.src='/media/data/images/404_not_found.gif'"/>
			</div>
<?
	}

	function printWatchAnime($id)
	{
		$allAnime = getAllAnime();
?>
		<div class="m12 animeInfo">
<?
		foreach($allAnime as $i=>$v)
		{
			if($v[0] == $id)
			{
				$episodeInfo = $v;
?>
			<a href="animepage.php?name=<?= urlencode($v[1]) ?>"><?= preg_replace("/_/", " ", $v[1]) ?></a>
			<span>Season: <?= $v[2] ?></span>
			<span>Episode: <?= $v[3] ?></span>
			<span>Language: <?= $v[5] ?></span>
<?
				if($allAnime[$i+1][1] == $v[1] && $allAnime[$i+1][5] == $v[5])
				{
?>
			<a href="setEpisodeWatched.php?name=<?= urlencode($v[1]) ?>&season=<?= $v[2] ?>&episode=<?= $v[3] ?>&language=<?= $v[5] ?>&id=<?= $v[0] ?>&skip=0" class="next_mark_watched">Next & Mark Watched</a>
<?
				}
				else if($allAnime[$i+2][1] == $v[1] && $allAnime[$i+2][5] == $v[5])
				{
?>
			<a href="setEpisodeWatched.php?name=<?= urlencode($v[1]) ?>&season=<?= $v[2] ?>&episode=<?= $v[3] ?>&language=<?= $v[5] ?>&id=<?= $v[0] ?>&skip=1" class="next_mark_watched">Next & Mark Watched</a>
<?
				}
				else
				{
?>
			<a href="setEpisodeWatched.php?name=<?= urlencode($v[1]) ?>&season=<?= $v[2] ?>&episode=<?= $v[3] ?>&language=<?= $v[5] ?>" class="next_mark_watched">Mark Watched</a>
<?
				}
			}

		}
?>
		</div>
		<div class="m11 animeVideo">
			<div class='videowrapper'>
				<video width='1026' height='577' controls>
					<source src='/<?= $episodeInfo[7] ?>' type="video/mp4">
					Your browser does not support the video tag
				</video>
			</div>
		</div>
		<div class="m13 episode_menu">
<?
		foreach ($allAnime as $i=>$v)
		{
			if($v[1] == $episodeInfo[1] && $v[5] == $episodeInfo[5])
			{
				$watchedStatus = getEpisodeWatchedStatus($_COOKIE["username"], $v[1], $v[2], $v[3], $v[5]);
				if($v[0] == $episodeInfo[0])
				{
					if($watchedStatus == 0)
					{
?>
						<a id="<?=$v[2] ?><?= $v[3] ?>" class="current" href="watchanime.php?id=<?= $v[0] ?>#<?= $v[2] ?><?= ($v[3]-2) ?>">Season <?= $v[2] ?> Episode <?= $v[3] ?></a>
<?
					}
					else
					{
?>
						<a id="<?=$v[2] ?><?= $v[3] ?>" class="current" href="watchanime.php?id=<?= $v[0] ?>#<?= $v[2] ?><?= ($v[3]-2) ?>">Season <?= $v[2] ?> Episode <?= $v[3] ?></a>
						<span>Watched</span>
<?
					}
				}
				else
				{
					if($watchedStatus == 0)
					{
?>
						<a id="<?=$v[2] ?><?= $v[3] ?>" href="watchanime.php?id=<?= $v[0] ?>#<?= $v[2] ?><?= ($v[3]-2) ?>">Season <?= $v[2] ?> Episode <?= $v[3] ?></a>
<?
					}
					else
					{
?>
						<a id="<?=$v[2] ?><?= $v[3] ?>" href="watchanime.php?id=<?= $v[0] ?>#<?= $v[2] ?><?= ($v[3]-2) ?>">Season <?= $v[2] ?> Episode <?= $v[3] ?></a>
						<span>Watched</span>
<?
					}
				}
			}
		}
	}


	function printWatchAnimeMovie($id)
	{
		$allAnime = getAllAnimeMovies();
?>
		<div class="m12 animeInfo">
<?
		foreach($allAnime as $i=>$v)
		{
			if($v[0] == $id)
			{
				$episodeInfo = $v;
?>
			<span class="title"><?= preg_replace("/_/", " ", $v[1]) ?></span>
			<span>Quality: <?= $v[2] ?></span>
			<span>Language: <?= $v[3] ?></span>
<?
			}
		}
?>
		</div>
		<div class="m11 animeMovieVideo">
			<div class='videowrapper'>
				<video width='1026' height='577' controls>
					<source src='<?= $episodeInfo[5] ?>' type="video/mp4">
					Your browser does not support the video tag
				</video>
			</div>
		</div>
<?
	}

	function printWatchMovie($name)
	{
		$allMovies = getAllMovies();
?>
		<div class="m12 movieInfo">
<?
		foreach($allMovies as $i=>$v)
		{
			if($v[1] == $name)
			{
				$movieInfo = $v;
?>
			<span class="title"><?= preg_replace("/_/", " ", $v[1]) ?></span>
			<span>Quality: <?= $v[3] ?></span>
			<span>Year: <?= $v[7] ?></span>
			<span>Rating: <?= $v[8] ?></span>
			<span>MPAA Rating: <?= $v[10] ?></span>
			<span>Description: <?= $v[11] ?></span>
			<span>Genres: <?= $v[12] ?></span>
<?
			}
		}
?>
		</div>
		<div class="m11 movieVideo">
			<div class='videowrapper'>
				<video width='1026' height='577' controls>
					<source src='<?= $movieInfo[4] ?>' type="video/mp4">
					Your browser does not support the video tag
				</video>
			</div>
		</div>
		</div>
<?
	}

	function printSearchBar()
	{
?>

		<div class="m14 search">
			<input id="search_input" type="text" placeholder="Search by name" autofocus="" onkeypress="search();"></input>
		</div>
<?
	}

	function printmovieSearchBar()
	{
?>
		<div class="m14 search">
			<input id="search_input" type="text" placeholder="Search by name" autofocus="" onkeypress="moviesearch();"></input>
		</div>
<?
	}

	function printAnimeMovieSearchBar()
	{
?>
		<div class="m14 search">
			<input id="search_input" type="text" placeholder="Search by name" autofocus="" onkeypress="animemoviesearch();"></input>
		</div>
<?
	}

	function pageCheck($pageName, $permissionsLevel)
	{

		$pageName = explode("?", $pageName)[0];
		switch($pageName)
		{
			case "/dev/animepage.php":
			case "/animepage.php":
			case "/dev/animemovies.php":
			case "/animemovies.php":
			case "/dev/anime.php":
			case "/anime.php":
			case "/dev/movies.php":
			case "/movies.php":
			case "/dev/watchanime.php":
			case "/watchanime.php":
			case "/dev/watchmovie.php":
			case "/watchmovie.php":
			case "/dev/watchanimemovie.php":
			case "/watchanimemovie.php":
				if($permissionsLevel >= 1)
				{
					return 1;
				}
				else
				{
					return 0;
				}
				break;
			case "/dev/admin.php":
			case "/admin.php":
				if($permissionsLevel >= 6)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			default:
				return 0;
				break;

		}
	}

	function printAllUserInfo()
	{
?>
		<div class="m15 userInfo" id="update_options">
			<h3 onclick="visibilityTogleUsersAdmin();">Users</h3>
			<form action='#' method='post'>
			<table id="users_admin"">
				<tr>
					<th>Username</th>
					<th>Permissions Level</th>
				</tr>
				<tr id="new_user_button">
					<td id="new_user_button">
						<button id="new_user_button" onclick="new_user_button_toggle()">Create User</button>
					</td>
				</tr>
<?
			$userInfo = getAllUserData();
			foreach($userInfo as $i=>$v)
			{
?>
				<tr class="user_info">
					<td><?= $v[1] ?></td>
					<td><a id="change_user_permissions" onclick="changeUserPermissionsClick();"><?= $v[3] ?></a></td>
					<td><button id="change_user_password" onclick="changeUserPasswordClick()">Change Password</button></td>
					<? if(strtolower($v[1]) != "elbanablade"): ?>
					<td><form action="#" method="post"><input type="hidden" name="name" value="<?= $v[1] ?>"><input type="submit" value="Delete" ></input></form></td>
					<? endif ?>
				</tr>
<?
			}
?>
			</table>
			</form>
		</div>
<?
	}

	function printAllUpdateOptions()
	{
?>
		<div class="m15 update_options">
			<h3 onclick="visibilityTogleUpdateAdmin();">Updates</h3>
			<table id="updates_admin">
				<tr>
					<td>
						<form action="#" method="post">
							<input type="hidden" name="update" value="anime"/>
							<input type="submit" value="Update Anime"/>
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<form action="#" method="post">
							<input type="hidden" name="update" value="animemovies"/>
							<input type="submit" value="Update Anime Movies"/>
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<form action="#" method="post">
							<input type="hidden" name="update" value="movies"/>
							<input type="submit" value="Update Movies"/>
						</form>
					</td>
				</tr>
			</table>
		</div>
<?
	}

	function printDownloadList()
	{
		$sql = "SELECT id, title, type, priority FROM DownloadList ORDER BY priority DESC, title";
		$downloadList = getQueryAsArray($sql);
?>
		<div class="m15 downloadList">
			<h3 onclick="visibilityTogleDownloadListAdmin();">Download List</h3>
			<div class="downloadList wrapper">
			<table id="downloadsList">
				<tr>
					<th>Title</th>
					<th>Type</th>
					<th>Priority</th>
				</tr>
<?
		foreach($downloadList as $i=>$x)
		{
?>
				<tr>
					<td><?= $x[1] ?></td>
					<td><?= $x[2] ?></td>
					<td><?= $x[3] ?></td>
					<td>
						<form action="#" method="POST">
							<input type="hidden" name="downloadlist" value="delete">
							<input type="hidden" name="id" value="<?= $x[0] ?>">
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>
<?
		}
?>
			</table>
			<form action="#" method="POST" id="downloadListAddForm">
				<input type="hidden" name="downloadlist" value="add">
				<input type="text" name="title">
				<select name="type">
					<option value="movie">Movie</option>
					<option value="animemovie">Anime Movie</option>
					<option value="anime">Anime</option>
				</select>
				<input type="text" name="priority">
				<input type="submit" value="Add">
			</form>
			</div>
		</div>
<?
	}

	function printBugList()
	{
		$sql = "SELECT * FROM Bugs ORDER BY priority DESC, description";
		$bugList = getQueryAsArray($sql);
?>
		<div class="m15 bugList">
			<h3 onclick="visibilityTogleBugListAdmin();">Bugs</h3>
			<div class="bugList wrapper">
			<table id="bugList">
				<tr>
					<th></th>
					<th>Priority</th>
					<th>Description</th>
				</tr>
<?
		foreach($bugList as $i=>$x)
		{
?>
				<tr>
					<td>
						<form action="#" method="POST">
							<input type="hidden" name="buglist" value="delete">
							<input type="hidden" name="id" value="<?= $x[0] ?>">
							<input type="submit" value="Delete">
						</form>
					</td>
					<td><?= $x[2] ?></td>
					<td><?= $x[1] ?></td>
				</tr>
<?
		}
?>
			</table>
			<form action="#" method="POST" id="bugListAddForm">
				<input type="submit" value="Add">
				<input type="hidden" name="buglist" value="add">
				<select name="priority">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
				<input type="text" name="description" size=125>
			</form>
			</div>
		</div>
<?
	}




?>
