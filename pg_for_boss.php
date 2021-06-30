<?php
	session_start();
	include("connection.php");
	include("function.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="20">
	<title>ATN's website</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<style>
	body 
	{
		background-image : url("pg_for_boss.jpg");
	}
</style>
<body>
	<marquee bgcolor = "#ffff00"> ----- This page is set to auto refresh after 20 seconds. ----- </marquee>
	<center>
	<div class="div1">
	<a href = "logout.php">Logout</a>
	<div class="div2">
	<br>
	<div class="title">
	<div style = "font-size: 20px; margin: 10px;">PAGE FOR BOSS OF ATN STORE</div></div>
	<form 
	<form action="" method="post">
         <select name = "db_selection">
            <option value = "Shop_A" >Shop A</option>
            <option value = "Shop_B">Shop B</option>
            <option value = "ALL" selected>All shops</option>
         </select>
		<input type="submit" name="submitButton" value="Submit"/>
    </form>  
	<?php
		$input = "ALL";
		if(isset($_POST['submitButton'])) 
		{ 
			$input = $_POST['db_selection'];
		}
			echo "<p> THIS DATABASE IS FROM ".strtoupper($input)."</p>"; 											
			if ($input == "ALL")
			{
				$result = pg_query($con,"select * from product;"); 
			}
			else 
			{
				$result = pg_query($con,"select * from product where shop_name = '$input';"); 
			}
			display_table($result);
			pg_close();
		echo '<br><br>';
	?>	
	</center>
<body>
</body>
</html>

