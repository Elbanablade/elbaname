<? include 'includes.php' ?>
<html class="index">
	<head>
		<title>Elbaname</title>
<?= printStylesheets() ?>
	</head>
	<body>
<?
	printHeader();
	printNavigation(getUserPermissionsLevel($_COOKIE['username']));
	printWelcome();
	printAnouncements();
	printUpdates();
?>
	</body>
</html>
