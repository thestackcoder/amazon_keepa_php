<?php
	include 'connection.php';

	$id = $_POST['id'];
	$flat =  $_POST['flat'];
	$fitted =  $_POST['fitted'];
	$actual =  $_POST['actual'];
	$fit = $_POST['fit']; 
	$pillow = $_POST['pillow'];   
	$elastic = $_POST['elastic'];
	$polyester = $_POST['polyester']; 
	$standard = $_POST['standard']; 
	$notes = $_POST['notes']; 

	/*$combine = 'Flat sheet dim: '.$flat.',Fitted sheet dim: '.$fitted.',Pocket depth actual: '.$actual.',Pocket depth fits: '.$fit.',Pillow case dim: '.$pillow.',Elastic all around: '.$elastic.',100% Polyester: '.$polyester.',Okeo standard: '.$standard.',Notes: '.$notes.'';*/
	/*$combine;

	$combine->flat_sheet_dimension = $flat;
	$combine->fitted_sheet_dimension = $fitted;
	$combine->pocket_depth_actual = $actual;
	$combine->pocket_depth_fits = $fit;
	$combine->pillow_case = $pillow;
	$combine->elastic_allaround = $elastic;
	$combine->polyester = $polyester;
	$combine->okeo_standard = $standard;
	$combine->notes = $notes;*/

	$combine = array(
		'flat_sheet_dimension' => $flat, 
		'fitted_sheet_dimension' => $fitted, 
		'pocket_depth_actual' => $actual, 
		'pocket_depth_fits' => $fit, 
		'pillow_case' => $pillow, 
		'elastic_allaround' => $elastic, 
		'polyester' => $polyester, 
		'okeo_standard' => $standard, 	
		'notes' => $notes, 			
	);

	//$obj = serialize($combine);

	//$obj = json_encode($combine);
	$obj = json_encode($combine);

	$sql = "UPDATE csvdata SET feature_details = '".$obj."' WHERE id = '".$id."'";

	if($conn->query($sql) === TRUE){

		/*$temp = explode (',',$combine);
	 
		foreach ($temp as $pair) {
			list ($k,$v) = explode (':',$pair);
			$pairs[$k] = $v;
		}
		 
		print_r($pairs);*/

		echo "Data updated Succesfully";
	}else{
		echo "Data not updated";
	}
?>