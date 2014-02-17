<? include 'includes.php' ?>
<html>
	<head>
		<title>Movies</title>
<?= printStylesheets() ?>
	</head>
	<body>
<?
	printHeader();
	printNavigation(getUserPermissionsLevel($_COOKIE['username']));
	printMovieSearchBar();
	printMovies();
	printMovieSortOptions();
?>
	</body>
</html>
