<?php

	include 'connection.php';

	$sql = "SELECT * FROM csvdata";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}

		echo json_encode($data);
	} else {
		echo 'No result';
	}

?>