<?php
	include 'connection.php';
	/*$id = $_POST['id'];
	
	$sql = "SELECT feature_details FROM csvdata WHERE id = '".$id."'";
		$result = mysqli_query($conn, $sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
			    $features = json_encode($row['feature_details'], true);
			    print_r($features);
			}

			//echo $res;
		} else {
			echo '<script>console.log("0 results");</script>';
		}*/

	if(isset($_POST['id']))	{
		$sql = "SELECT feature_details FROM csvdata WHERE id = '".$_POST['id']."'";
		$result = mysqli_query($conn, $sql);
		$row = $result->fetch_assoc();
		$fd = json_decode($row['feature_details']);
		echo json_encode($fd);
	}

?>