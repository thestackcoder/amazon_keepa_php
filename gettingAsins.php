<?php

	include 'connection.php';
	$sql = "SELECT asin FROM csvdata";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		$res = '';
		while($row = $result->fetch_assoc()) {
		    $res .= $row["asin"];
		    $res .= ",";
		}

		echo $res;
	} else {
		    echo "0 results";
	}


?>
