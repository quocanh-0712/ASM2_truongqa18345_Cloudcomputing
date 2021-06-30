<?php
session_start();
include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(!empty($username) && !empty($password))
	{
		$query = "select * from accounts where username = '$username'";
		$result = pg_query($con, $query);
		if($result)
		{
			if($result && pg_num_rows($result) === 1)
			{
				$data = pg_fetch_assoc($result);
				if($data['password'] === $password)
				{
					$work_unit = $data['work_unit'];
					switch ($work_unit)
					{
						case 'Director_Board':
						//
							header("Location: pg_for_boss.php");
							die;
							break;
						default:
						//
							$_SESSION['user_id'] = $data['user_id'];
							header("Location: main_page.php");
							die;
							break;
					}
				}
			}
			echo ">>> The account does not exist!";
		}
	}
	else
	{
		echo ">>> Information provided is not enough!";
	}
	pg_close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN PAGE</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<style>
	body 
	{
		background-image : url("login.jpg");
	}
</style>
<body>
	<div id = "box">
		<center>
		<form method = "post">
			<div class="div1">
			<div class="div2">
			<div style = "font-size: 40px; margin: 15px;">--- LOGIN FORM OF ATN ---</div><br>
			<label>Username: </label><input type = "text" name = "username"><br><br>
			<label>Password: </label><input type = "password" name = "password"><br><br>
			<input type = "submit" value = "Login"><br><br>
		</form>
		</center>
	</div>
</body>
</html>