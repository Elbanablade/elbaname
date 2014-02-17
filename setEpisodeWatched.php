<?
	$username = $_COOKIE["username"];
	$password = $_COOKIE["password"];
	$animeName = htmlspecialchars($_GET["name"]);
	$season = htmlspecialchars($_GET["season"]);
	$episode = htmlspecialchars($_GET["episode"]);
	$language = htmlspecialchars($_GET["language"]);
	$animeID = htmlspecialchars($_GET["id"]);
	$skip = htmlspecialchars($_GET["skip"]);
	if(isset($username) && isset($animeName))
	{
		$con = mysqli_connect("localhost", "webadmin", "password", "Main");
		$sql = "SELECT * FROM WatchedAnimeEpisodes WHERE username='$username' AND animeName='$animeName' AND season='$season' AND episode='$episode' AND language='$language'";
		$result = mysqli_query($con, $sql);
		if( mysqli_num_rows($result) == 0)
		{
			$sql = "INSERT INTO WatchedAnimeEpisodes (username, animeName, season, episode, language) VALUES ('$username', '$animeName', '$season', '$episode', '$language')";
			mysqli_query($con, $sql) or die(mysqli_error($con));
		}
	}

	if( $animeID )
	{
		if($skip==0)
		{
				header("Location: watchanime.php?id=" . ($animeID+1));
		}
		else
		{
				header("Location: watchanime.php?id=" . ($animeID+2));
		}
		exit;
	}
	else
	{

		header("Location: animepage.php?name=" . urlencode($animeName));
		exit;
	}
?>
