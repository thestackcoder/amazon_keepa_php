<?php
	$host="localhost"; // Host name.
	$db_user="root"; //mysql user
	$db_password=""; //mysql pass
	$db='csvtest'; // Database name.
	//$conn=mysql_connect($host,$db_user,$db_password) or die (mysql_error());
	//mysql_select_db($db) or die (mysql_error());
	$conn=mysqli_connect($host,$db_user,$db_password,$db);
	// Check connection
	if (!$conn)
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

?>