<?php
// setting mysql connection

	$server      = 'localhost'; 		// localhost
	$db_user     = 'admin'; 		// DB user
	$db_password = 'test123'; 	// DB password
	$db_name     = 'p_analytics';		// DB Name
	$con = mysqli_connect($server,$db_user,$db_password,$db_name);
 
	// Check connection
	if (mysqli_connect_errno())
    {
  		echo "Failed to connect to database: " . mysqli_connect_errno();
  	}
	
	?>