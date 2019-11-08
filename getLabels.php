<?php


	include 'connection.php';

	$id = $_POST['id'];


	$data = json_encode($_POST['labels']);


	$sql = "UPDATE heading SET headings = '".$data."'";

	if($conn->query($sql) === TRUE){

			$sql = "SELECT headings FROM heading";
			$result = mysqli_query($conn, $sql);
			$row = $result->fetch_assoc();
			$fd = json_decode($row['headings'], true);
			echo json_encode($fd);
	}else{
		echo "Data not updated";
	}

?>