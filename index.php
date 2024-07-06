<?php
    session_start();
    
    include('./DBconnect.php');

    if(isset($_POST['result']))
    {
        if($_POST['result'] == "login")
        {
			$link = DBconnect();
			$sql = "select * from users where mail = :mail and password = :pass ";
			$req = $link->prepare($sql);
			$req->execute(array(':mail' => $_POST['mail'], ':pass' => $_POST['password']));
			$count = $req->rowCount();
			$row = $req->fetch(PDO::FETCH_ASSOC);
			if($count == 1 && !empty($row))
			{
				if(isset($row['surname']) && isset($row['name']))
				{
					$_SESSION['surname'] = $row['surname'];
					$_SESSION['name'] = $row['name'];
				}
				require "./logged.tpl";
			}
			else
			{
				require "./login.tpl";
				echo '<script language="javascript">';
				echo 'alert("error while trying to log in")';
				echo '</script>';
			}
        }
        else if($_POST['result'] == "forgot")
        {
            require "./forgot.tpl";
        }
		else if($_POST['result'] == "signup")
        {	
			
			$link = DBconnect();
			$sql = "insert into users(mail, password, name, surname, gender, birthday) values(:mail, :pass, :name, :surname, :gender, :bday)";
			$req = $link->prepare($sql);
			$req->execute(array(
			':mail' => $_POST['mail'],
			':pass' => $_POST['password'], 
			':name' => $_POST['name'],
			':surname' => $_POST['surname'],
			':gender' => $_POST['gender'],
			':bday' => $_POST['birthday']));
			echo '<script language="javascript">';
			echo 'alert("Sign up complete!")';
			echo '</script>';
			require "./login.tpl";
		}
		else if($_POST['result'] == "logout")
		{
			session_destroy();
			require "./login.tpl";
		}
	}
	else if(isset($_SESSION['surname']) && isset($_SESSION['name']))
	{
		require "./logged.tpl";
	}
    else
    {
        require "./login.tpl";
    }

?>