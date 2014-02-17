<?php
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $passwordhash = hash('sha512', $password);

        mysql_connect("127.0.0.1:3306", "webadmin", "password");
        mysql_select_db("Main");

        $result = mysql_query("select * from Users");
        if ($result)
        {
                while ($row = mysql_fetch_row($result))
                {
                        if(strtolower ($row[1]) == strtolower ($username) && $row[2] == $passwordhash)
                        {
                                $loggedin = 1;
                        }
                }
        }

        if($loggedin == 0)
        {
                header("Location: index.php");
                exit;
        }
        else
        {
                header("Location: index.php");
                setcookie("username", $username);
                setcookie("password", $passwordhash);
                exit;
        }
?>


