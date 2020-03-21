<?php

include('hw.php');


// setting mysql connection

	$server      = 'localhost'; 		// localhost
	$db_user     = 'admin'; 		// DB user
	$db_password = '****'; 	// DB password
	$db_name     = 'p_analytics';		// DB Name
	$con = mysqli_connect($server,$db_user,$db_password,$db_name);
 
	// Check connection
	if (mysqli_connect_errno())
    {
  		echo "Failed to connect to database: " . mysqli_connect_errno();
  	}
    //graph of departments
  	$sql = "SELECT count(predictions) as Yes from batch_2014_2016 where predictions = 'Y' group by Dept";
  	$query = mysqli_query($con,$sql);
  	$general[] = array();
  	$category = array();
    $row_no = mysqli_num_rows($query); 
  	if($row_no>0){
  		while($row = mysqli_fetch_array($query)){
  			$general['Yes'][]  = $row["Yes"];
  		}
  	}
  	$sql1 = "SELECT count(predictions) as No from batch_2014_2016 where predictions = 'N' group by Dept";
  	$query1 = mysqli_query($con,$sql1);
  	 if(mysqli_num_rows($query1)>0){
  		while($row = mysqli_fetch_array($query1)){
  			$general['No'][]  = $row["No"];
  		}
  	}
  	$sql2 = "SELECT Dept from batch_2014_2016  group by Dept";
  	$query2 = mysqli_query($con,$sql2);
	 if(mysqli_num_rows($query2)>0){
  		while($row = mysqli_fetch_array($query2)){
  			$category[]  = $row["Dept"];
  		}
  	}
  	$series_data[] = array('name'=>'Yes', 'data'=> array_map("intval",$general['Yes']));
  	$series_data[] = array('name'=>'No', 'data'=>array_map("intval",$general['No']));
  	$data =json_encode($series_data);
  	$cat  = json_encode($category);
//Graph of batch
    $sql3 = "SELECT count(predictions) as Yes from batch_2014_2016 where predictions = 'Y' group by Batch";
    $query3 = mysqli_query($con,$sql3);
    $general_1[] = array();
    $category_1 = array();
    $row_no_1 = mysqli_num_rows($query3); 
    if($row_no_1>0){
      while($row_1 = mysqli_fetch_array($query3)){
        $general_1['Yes'][]  = $row_1["Yes"];
      }
    }
    $sql4 = "SELECT count(predictions) as No from batch_2014_2016 where predictions = 'N' group by Batch";
    $query4 = mysqli_query($con,$sql4);
     if(mysqli_num_rows($query4)>0){
      while($row_1 = mysqli_fetch_array($query4)){
        $general_1['No'][]  = $row_1["No"];
      }
    }
    $sql5 = "SELECT Batch from batch_2014_2016  group by Batch";
    $query5 = mysqli_query($con,$sql5);
   if(mysqli_num_rows($query5)>0){
      while($row_1 = mysqli_fetch_array($query5)){
        $category_1[]  = $row_1["Batch"];
      }
    }
    $series_data_1[] = array('name'=>'Yes', 'data'=> array_map("intval",$general_1['Yes']));
    $series_data_1[] = array('name'=>'No', 'data'=>array_map("intval",$general_1['No']));
    $data_1 =json_encode($series_data_1);
    $cat_1  = json_encode($category_1);
// Graph of 10th board 
  $sql6 = "SELECT count(predictions) as Yes from batch_2014_2016 where predictions = 'Y' group by Board_10";
    $query6 = mysqli_query($con,$sql6);
    $general_2[] = array();
    $category_2 = array();
    $row_no_2 = mysqli_num_rows($query6); 
    if($row_no_2>0){
      while($row_2 = mysqli_fetch_array($query6)){
        $general_2['Yes'][]  = $row_2["Yes"];
      }
    }
    $sql7 = "SELECT count(predictions) as No from batch_2014_2016 where predictions = 'N' group by Board_10";
    $query7 = mysqli_query($con,$sql7);
     if(mysqli_num_rows($query7)>0){
      while($row_2 = mysqli_fetch_array($query7)){
        $general_2['No'][]  = $row_2["No"];
      }
    }
    $sql8 = "SELECT Board_10 from batch_2014_2016  group by Board_10";
    $query8 = mysqli_query($con,$sql8);
   if(mysqli_num_rows($query8)>0){
      while($row_2 = mysqli_fetch_array($query8)){
        $category_2[]  = $row_2["Board_10"];
      }
    }
    $series_data_2[] = array('name'=>'Yes', 'data'=> array_map("intval",$general_2['Yes']));
    $series_data_2[] = array('name'=>'No', 'data'=>array_map("intval",$general_2['No']));
    $data_2 =json_encode($series_data_2);
    $cat_2  = json_encode($category_2); 
//Graph of 12th board
  $sql9 = "SELECT count(predictions) as Yes from batch_2014_2016 where predictions = 'Y' group by Board_12";
    $query9 = mysqli_query($con,$sql9);
    $general_3[] = array();
    $category_3 = array();
    $row_no_3 = mysqli_num_rows($query9); 
    if($row_no_3>0){
      while($row_3 = mysqli_fetch_array($query9)){
        $general_3['Yes'][]  = $row_3["Yes"];
      }
    }
    $sql10 = "SELECT count(predictions) as No from batch_2014_2016 where predictions = 'N' group by Board_12";
    $query10 = mysqli_query($con,$sql10);
     if(mysqli_num_rows($query10)>0){
      while($row_3 = mysqli_fetch_array($query10)){
        $general_3['No'][]  = $row_3["No"];
      }
    }
    $sql11 = "SELECT Board_12 from batch_2014_2016  group by Board_12";
    $query11 = mysqli_query($con,$sql11);
   if(mysqli_num_rows($query11)>0){
      while($row_3 = mysqli_fetch_array($query11)){
        $category_3[]  = $row_3["Board_12"];
      }
    }
    $series_data_3[] = array('name'=>'Yes', 'data'=> array_map("intval",$general_3['Yes']));
    $series_data_3[] = array('name'=>'No', 'data'=>array_map("intval",$general_3['No']));
    $data_3 =json_encode($series_data_3);
    $cat_3  = json_encode($category_3);
//Graph of Fathers occupation
     $sql12 = "SELECT count(predictions) as Yes from batch_2014_2016 where predictions = 'Y' group by FatherOccup";
    $query12 = mysqli_query($con,$sql12);
    $general_4[] = array();
    $category_4 = array();
    $row_no_4 = mysqli_num_rows($query12); 
    if($row_no_4>0){
      while($row_4 = mysqli_fetch_array($query12)){
        $general_4['Yes'][]  = $row_4["Yes"];
      }
    }
    $sql13 = "SELECT count(predictions) as No from batch_2014_2016 where predictions = 'N' group by FatherOccup";
    $query13 = mysqli_query($con,$sql13);
     if(mysqli_num_rows($query13)>0){
      while($row_4 = mysqli_fetch_array($query13)){
        $general_4['No'][]  = $row_4["No"];
      }
    }
    $sql14 = "SELECT FatherOccup from batch_2014_2016  group by FatherOccup";
    $query14 = mysqli_query($con,$sql14);
   if(mysqli_num_rows($query14)>0){
      while($row_4 = mysqli_fetch_array($query14)){
        $category_4[]  = $row_4["FatherOccup"];
      }
    }
    $series_data_4[] = array('name'=>'Yes', 'data'=> array_map("intval",$general_4['Yes']));
    $series_data_4[] = array('name'=>'No', 'data'=>array_map("intval",$general_4['No']));
    $data_4 =json_encode($series_data_4);
    $cat_4 = json_encode($category_4);

//Graph of Mother's occupation
     $sql15 = "SELECT count(predictions) as Yes from batch_2014_2016 where predictions = 'Y' group by MotherOccup";
    $query15 = mysqli_query($con,$sql15);
    $general_5[] = array();
    $category_5 = array();
    $row_no_5 = mysqli_num_rows($query15); 
    if($row_no_5>0){
      while($row_5 = mysqli_fetch_array($query15)){
        $general_5['Yes'][]  = $row_5["Yes"];
      }
    }
    $sql16 = "SELECT count(predictions) as No from batch_2014_2016 where predictions = 'N' group by MotherOccup";
    $query16 = mysqli_query($con,$sql16);
     if(mysqli_num_rows($query16)>0){
      while($row_5 = mysqli_fetch_array($query16)){
        $general_5['No'][]  = $row_5["No"];
      }
    }
    $sql17 = "SELECT MotherOccup from batch_2014_2016  group by MotherOccup";
    $query17 = mysqli_query($con,$sql17);
   if(mysqli_num_rows($query17)>0){
      while($row_5 = mysqli_fetch_array($query17)){
        $category_5[]  = $row_5["MotherOccup"];
      }
    }
    $series_data_5[] = array('name'=>'Yes', 'data'=> array_map("intval",$general_5['Yes']));
    $series_data_5[] = array('name'=>'No', 'data'=>array_map("intval",$general_5['No']));
    $data_5 =json_encode($series_data_5);
    $cat_5= json_encode($category_5);
?>
