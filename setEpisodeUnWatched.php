<?
	$username = $_COOKIE['username'];
	$password = $_COOKIE['password'];
	$animeName = htmlspecialchars($_GET["name"]);
	$season = htmlspecialchars($_GET["season"]);
	$episode = htmlspecialchars($_GET["episode"]);
	$language = htmlspecialchars($_GET["language"]);
	if(isset($username) && isset($animeName))
	{
		$con = mysqli_connect("localhost", "webadmin", "password", "Main");
		$sql = "SELECT * FROM WatchedAnimeEpisodes WHERE username='$username' AND animeName='$animeName' AND season='$season' AND episode='$episode' AND language='$language'";
		$result = mysqli_query($con, $sql);
		if( mysqli_num_rows($result) >= 1)
		{
			$sql = "DELETE FROM WatchedAnimeEpisodes WHERE username='$username' AND animeName='$animeName' AND season='$season' AND episode='$episode' AND language='$language'";
			mysqli_query($con, $sql);
			echo "Episode has been removed from your watched list";
		}
	}
	header("Location: animepage.php?name=" . urlencode($animeName));
	exit;
?>
