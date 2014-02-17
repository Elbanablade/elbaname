<? include 'includes.php' ?>
<html>
	<head>
		<title>Anime Page</title>
<?= printStylesheets() ?>
	</head>
	<body>
<?
	printHeader();
	printNavigation(getUserPermissionsLevel($_COOKIE['username']));
	printAnimePage(htmlspecialchars($_GET["name"]));
?>
	</body>
</html>
