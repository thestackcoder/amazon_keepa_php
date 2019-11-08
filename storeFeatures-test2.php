<?php
	include 'connection.php';

	$id = $_POST['id'];
	/*$flat =  $_POST['flat'];
	$fitted =  $_POST['fit'];
	$actual =  $_POST['pocket'];
	$fit = $_POST['depth']; 
	$pillow = $_POST['pillow'];   
	$elastic = $_POST['elastic'];
	$polyester = $_POST['polyester']; 
	$standard = $_POST['standard']; 
	$notes = $_POST['notes']; 
	$new = $_POST['newfield'];*/

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

	$data = json_encode($_POST['labels']);
	$data2 = json_encode($_POST['inputs']);

	echo $data;

	//print_r(json_decode($data));

	/*$combine = array(
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

	$obj = json_encode($combine);*/

/*	$sql = "UPDATE csvdata SET feature_details = '".$data."' WHERE id = '".$id."'";

	if($conn->query($sql) === TRUE && isset($_POST['id'])){

			$sql = "SELECT feature_details FROM csvdata WHERE id = '".$id."'";
			$result = mysqli_query($conn, $sql);
			$row = $result->fetch_assoc();
			$fd = json_decode($row['feature_details'], true);
			echo json_encode($fd);
	}else{
		echo "Data not updated";
	}*/

	
?>