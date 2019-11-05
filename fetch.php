<?php
	include 'connection.php';

	if(isset($_POST['id']))	{

		$sql = "SELECT features FROM csvdata WHERE id = '".$_POST['id']."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}
?>