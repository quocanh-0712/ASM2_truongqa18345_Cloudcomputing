<?php
	session_start();
	include("connection.php");
	include("function.php");
	$data = check_login($con);
	$work_unit = $data['work_unit'];
	try 
	{
	if($_SERVER['REQUEST_METHOD'] == "POST")	
	{
		//Something was posted
		$product_name = $_POST['product_name'];
		$price = $_POST['price'];
		$amount = $_POST['amount'];
		if(!empty($product_name) && !empty($price) && !empty($amount))
		{
			$result_check = pg_query($con, "select product_name from product where shop_name = '$work_unit' and product_name = '$product_name';");
			if (pg_num_rows($result_check) > 0) 
			{
				echo "Error: The product has already existed!";
			}
			else
			{
				pg_query($con,"insert into product(shop_name, product_name, price, amount) values ('$work_unit','$product_name','$price', '$amount');");
				echo "Database updated successfully! ";
				echo '<a href="main_page.php" title="Update database">Click here to see changes</a>';
				die;
			}
		}
		else
		{
			echo "Error: The information provided is not enough!";
		}
	}
	pg_close();
	}
	catch (Exception $e) 
	{
		echo "Error: <br/>", $e->getMessage(), "\n";
	}
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
		background-image : url("image.jpg");
	}
</style>
<body>
	<a href = "main_page.php">Return</a>
	<br>
	<center>
	<form method = "post">
			<div style = "font-size: 30px; margin: 10px;">ADD PRODUCT FORM</div><br>
			<label>Product name......................: </label><input type = "text" name = "product_name"><br><br>
			<label>Price.....................................: </label><input type = "text" name = "price"><br><br>
			<label>Amount...............................: </label><input type = "text" name = "amount"><br><br>
			<input type = "submit" value = "Update"><br><br>
	</form>
	</center>
	</div></div></div></div>
<body>
</body>
</html>
