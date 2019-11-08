<?php


	include 'connection.php';

	$id = $_POST['id'];


	$data = json_encode($_POST['inputs']);


	$sql = "UPDATE csvdata SET feature_details = '".$data."' WHERE id = '".$id."'" ;

	if($conn->query($sql) === TRUE){

			$sql = "SELECT feature_details FROM csvdata WHERE id = '".$id."'";
			$result = mysqli_query($conn, $sql);
			$row = $result->fetch_assoc();
			$fd = json_decode($row['feature_details'], true);
			echo json_encode($fd);
	}else{
		echo "Data not updated";
	}

?>