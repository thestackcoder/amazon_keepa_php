<?php

	include 'connection.php';
	if(isset($_POST)){

		$coupons = $_POST['coupons'];
		#$new_coupons = explode(",", $coupons);
		//print_r($coupons);

		$sizes = $_POST['sizes'];
		#$new_sizes = explode(",", $sizes);
		//print_r($sizes);

		$features = $_POST['features'];
		#$new_features = explode(",", $features);
		//print_r($features);

		$colors = $_POST['colors'];
		#$new_colors = explode(",", $colors);
		//print_r($colors);

		$images = $_POST['images'];
		#$new_images = explode(",", $images);
		//print_r($images);

		$pasins = $_POST['pasins'];

		$asins = $_POST['asins'];
		#$string = $asins;
		#$new_asins = explode(",", $string);
		//print_r($asins);

		$imgurl = 'https://images-na.ssl-images-amazon.com/images/I/';	

		if (sizeof($asins) > 0) {
			# code...
			for ($i=0; $i < sizeof($asins); $i++) { 
			
				$comma_separated = implode(",", $features[$i]);														
				$final_features = mysqli_real_escape_string($conn, $comma_separated);
			
				$imgx = $images[$i];
				$img = explode(",", $imgx);
			

				$query = "UPDATE csvdata SET parent_asin='".$pasins[$i]."', coupon='".$coupons[$i]."', size='".$sizes[$i]."', features='".$final_features.error_reporting(E_ERROR | E_PARSE)."', 
					color='".$colors[$i]."', image='".$imgurl.$img[0]."' WHERE asin = '".$asins[$i]."'";

				$store = mysqli_query($conn, $query);
		            
		        if(!$store) {
		            die('Could not update data.');
		        }
			}
		} else{
			echo "No ASINS found.";
		}
		
	   	echo "Updated data successfully\n";
	}



	
?>