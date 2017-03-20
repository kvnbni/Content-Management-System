<?php
// Open a database connection
	define("DBSERVER","localhost");
	define("DB_USER","widget_cms");
	define("DB_PASS","secretpassword");
	define("DB_NAME","widget_corp");
	
	$connection=mysqli_connect(DBSERVER,DB_USER,DB_PASS,DB_NAME);  //trying to connect to our database
	if(mysqli_connect_errno())
	{
		die("Databse connection failed:".
		mysqli_connect_error().
		"(".mysqli_connect_errno().")");
	}
?>