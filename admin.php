<? include 'includes.php' ?>
<html>
	<head>
		<title>Admin</title>
<?= printStylesheets() ?>
	</head>
	<body>
<?
	printHeader();
	printNavigation(getUserPermissionsLevel($_COOKIE['username']));
	runUpdates();
	printAllUserInfo();
	printAllUpdateOptions();
	printDownloadList();
	printBugList();
?>
	</body>
</html>
