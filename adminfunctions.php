<?
	function runUpdates()
	{
	        echo htmlspecialchars($_POST["name"]) . "\t" .  htmlspecialchars($_POST["password"]) . "\t" . htmlspecialchars($_POST["permissions"]);
		if( htmlspecialchars($_POST["name"]) &&  htmlspecialchars($_POST["password"]) && htmlspecialchars($_POST["permissions"]))
		{
			echo "creating";
//			createUser(htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["password"]), htmlspecialchars($_POST["permissions"]));
		}
		elseif( htmlspecialchars($_POST["name"]) &&  !htmlspecialchars($_POST["password"]) && !htmlspecialchars($_POST["permissions"]))
		{
			echo "deleting";
//			deleteUser($_POST["name"]);
		}
		else
		{
			echo "nothing";
		}

		switch (htmlspecialchars($_POST["update"]))
		{
			case "anime":
				updateAnime();
				break;

			case "animemovies":
				updateAnimeMovies();
				break;
			case "movies":
				updateMovies();
				break;
		}

		switch (htmlspecialchars($_POST["downloadlist"]))
		{
			case "add":
				$sql = "INSERT INTO DownloadList (title, type, priority) VALUES (\"" . htmlspecialchars($_POST['title']) . "\", \"" . htmlspecialchars($_POST['type']) . "\"," .  htmlspecialchars($_POST['priority']) . ")";
				runQuery($sql);
				break;
			case "delete":
				$sql = "DELETE FROM DownloadList where id=" . htmlspecialchars($_POST["id"]);
				runQuery($sql);
				break;
		}

		switch (htmlspecialchars($_POST["buglist"]))
		{
			case "add":
				$sql = "INSERT INTO Bugs (priority, description) VALUES (" . htmlspecialchars($_POST['priority']) . ", \"" . htmlspecialchars($_POST['description']) . "\")";
				runQuery($sql);
				break;
			case "delete":
				$sql = "DELETE FROM Bugs where id=" . htmlspecialchars($_POST["id"]);
				runQuery($sql);
				break;
		}


	}




?>
