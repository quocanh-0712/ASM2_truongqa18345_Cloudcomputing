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
		$product_name = $_POST['product_name'];
		$added_num = $_POST['added_num'];
		$sell_num = $_POST['sell_num'];
		if(!empty($product_name))
		{
			if(empty($added_num) && empty($sell_num))
			{
				echo ">>> No input for the number of the added or sold products!";
			}
			else
			{
				$result = pg_query($con, "select amount from product where shop_name = '$work_unit' and product_name = '$product_name';");
				if(pg_num_rows($result) > 0) 
				{
					while($row = pg_fetch_assoc($result)) 
					{
						$current_num = $row["amount"];
					}
					$update_number = $current_num + $added_num - $sell_num;
					if($update_number < 0)
					{
						echo ">>> The amount of '$product_name's is not enough!";
					}
					else
					{
						pg_query($con, "update product set amount = $update_number where shop_name = '$work_unit' and product_name = '$product_name';");
						echo "Database updated successfully! ";
						echo '<a href="main_page.php" title="Update database">Click here to see changes</a>';
						die;
					}

				}
				else
				{
					echo "Error: There is no product name '$product_name' in the database! ";
				}
			}
		}
		else
		{
			echo ">>> No product name '$product_name!";
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
			<div style = "font-size: 30px; margin: 10px;">UPDATE DATABASE FORM</div><br>
			<label>Product name.........................: </label><input type = "text" name = "product_name"><br><br>
			<label>Number of added product(s).: </label><input type = "text" name = "added_num"><br><br>
			<label>Number of sold product(s)......: </label><input type = "text" name = "sell_num"><br><br>
			<input type = "submit" value = "Update"><br><br>
	</form>
	</center>
	</div>
<body>
</body>
</html>
