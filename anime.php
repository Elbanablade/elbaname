<? include 'includes.php' ?>
<html>
	<head>
		<title>Anime</title>
<?= printStylesheets() ?>
	</head>
	<body>
<?
	printHeader();
	printNavigation(getUserPermissionsLevel($_COOKIE['username']));
	printSearchBar();
	printAnime();
	printSortOptions();
?>
	</body>
</html>
