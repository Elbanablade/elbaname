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
	printWatchAnime(htmlspecialchars($_GET["id"]));
?>
	</body>
</html>
