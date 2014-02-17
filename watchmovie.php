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
	printWatchMovie(htmlspecialchars($_GET["name"]));
?>
	</body>
</html>
