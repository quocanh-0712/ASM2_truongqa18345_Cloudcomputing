<?php
	#DATABASE CREDENTIAL
	$db_host = "ec2-52-23-45-36.compute-1.amazonaws.com";
	$db_name = "dad36q99j930n6";
	$db_user = "uwewypgzbkknym";
	$db_password = "8b15b8a61c0f109b4d6b64270f3ab439af8e719f9f6e857ed922ccc449ec18c9";
	$conn_string = "host = $db_host port = 5432 dbname = $db_name user = $db_user password = $db_password";
	$con = pg_connect($conn_string);
	if(!$con)
	{
		die("Failed to connect database");
	}
?>
