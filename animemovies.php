<? include 'includes.php' ?>
<html>
	<head>
		<title>Anime Movies</title>
<?= printStylesheets() ?>
	</head>
	<body>
<?
	printHeader();
	printNavigation(getUserPermissionsLevel($_COOKIE['username']));
	printAnimeMovieSearchBar();
	printAnimeMovies();
?>
	</body>
</html>
