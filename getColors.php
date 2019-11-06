
<?php

	include 'connection.php';

			$colors = array();

			$sql = "SELECT color FROM `csvdata` group by color";

			$result = mysqli_query($conn, $sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
				    $colors[] = $row['color'];
				}

				echo json_encode($colors);
			} else {
				echo '0 results';
			}

				
?>