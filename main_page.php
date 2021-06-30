<?php
	session_start();
	include("connection.php");
	include("function.php");
	$user_data = check_login($con);
	$work_unit = $user_data['work_unit'];
	#Get data for each shop
	$result = pg_query($con,"select * from product where shop_name = '$work_unit';");
?>

<!DOCTYPE html>
<html>
<head>
	<title>ATN's website</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<style>
	body 
	{
		background-image : url("pg_for_shop.jpg");
	}
</style>
<body>
	<div class="div1">
	<a href = "logout.php">Logout</a>
	<center>
	<div class="div2">
	<br>
	<center>
	<div class="title">
	<div style = "font-size: 20px; margin: 10px;">THIS IS PAGE FOR <?php echo strtoupper($work_unit) ?></div><br><br>
	</div>
	<?php display_table($result);?>
	<a href="change_info.php"><br> Update data here</a>
	<a href="add_product.php"><br><br> Add product here</a>
	<a href="delete_product.php"><br><br> Remove product here</a>
	</center>
	</center>
<body>
</body>
</html>

