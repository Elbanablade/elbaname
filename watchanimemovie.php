<? include 'includes.php' ?>
<html>
	<head>
		<title>Watch</title>
<?= printStylesheets() ?>
	</head>
	<body>
<?
	printHeader();
	printNavigation(getUserPermissionsLevel($_COOKIE['username']));
	printWatchAnimeMovie(htmlspecialchars($_GET["id"]));
?>
	</body>
</html>
