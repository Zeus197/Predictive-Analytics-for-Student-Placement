<?php
include "connectd.php";

	$id=$_POST['StudentID'];
	echo $id;
	$sql33= "SELECT * from batch_2014_2016 where StudentID='$id'";
	$disp = mysqli_query($con,$sql33);
	if (!$disp) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
	while($result = mysqli_fetch_assoc($disp))
	{
	echo"<br/> Placement prediction:", $result['predictions'];
    echo"<br/> Prediction probability:", $result['PredictedProb'];	

	}
	?>