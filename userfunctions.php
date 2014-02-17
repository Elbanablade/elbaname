<?
	function getAllUserData()
	{
		$sql = "SELECT * FROM Users ORDER BY name, permissions";
		return getQueryAsArray($sql);
	}

	function createUser($username, $password, $permissionsLevel)
	{
		$username = strtolower($username);
		$sql = "SELECT * FROM Users";
		$users = getQueryAsArray($sql);
		$userExistsFlag = 0;
		foreach ($users as $i=>$u)
		{
			if(strtolower($u[1]) == $username)
			{
				$userExistsFlag = 1;
			}
		}

		if( $userExistsFlag == 1)
		{
			echo "user exists\n";
		}
		else
		{
			$password = hash('sha512', $password);
			$sql = 'INSERT INTO Users (name, password, permissions) VALUES ("' . $username . '", "' . $password . '", ' . $permissionsLevel . ')';
			return runQuery($sql);
		}
	}

	function deleteUser($username)
	{
		$username = strtolower($username);
		$sql = "SELECT * FROM Users";
		$users = getQueryAsArray($sql);
		$deletedFlag = 0;
		foreach($users as $j=>$v)
		{
			if(strtolower($v[1]) == strtolower($username))
			{
				$sql = "DELETE FROM Users WHERE id=$v[0]";
				return runQuery($sql);
			}
		}
	}

	function updateUserPassword($username, $password)
	{
		$username = strtolower($username);
		$sql = "SELECT * FROM Users";
		$users = getQueryAsArray($sql);
		foreach($users as $j=>$v)
		{
			if(strtolower($v[1]) == strtolower($username))
			{
				$password = hash('sha512', $password);
				$sql = "UPDATE Users SET password=\"$password\" WHERE id=$v[0]";
				return runQuery($sql);
			}
		}
	}

	function updateUserPermissionsLevel($username, $permissionsLevel)
	{
		$username = strtolower($username);
		$sql = "SELECT * FROM Users";
		$users = getQueryAsArray($sql);
		foreach($users as $j=>$v)
		{
			if(strtolower($v[1]) == strtolower($username))
			{
				$sql = "UPDATE Users SET permissions=$permissionsLevel WHERE id=$v[0]";
				return runQuery($sql);
			}
		}
	}

	function checkCredentials($username, $password)
	{
		$username = strtolower($username);
		$sql = "SELECT * FROM Users";
		$users = getQueryAsArray($sql);
		foreach($users as $j=>$v)
		{
			if((strtolower($v[1]) == strtolower($username)) && ($password == $v[2]))
			{
				return 0;
			}
		}
		return 1;
	}

	function getUserPermissionsLevel($username)
	{
		$sql = "SELECT permissions FROM Users where name=\"$username\"";
		return getQueryAsArray($sql)[0][0];

	}

	function userTracking()
	{
		$pageURL = "http/" . "/";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$file = 'logs/userLocationLog.txt';
		$contents = date('m/d/y h:i:s', strtotime('+5 hours')) . "\t" . $_COOKIE["username"] . "\t" . $pageURL . "\n";
		file_put_contents($file, $contents, FILE_APPEND | LOCK_EX);
	}
?>
