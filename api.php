<?php
	include 'connection.php';

	/*$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.keepa.com/product",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "cache-control: no-cache"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);	

	$response = json_decode($response, true); //because of true, it's in an array
	echo 'Size: '. $response['timestamp'];*/

	$cp = $_GET['cp'];
	$sz = $_GET['sz'];
	$co = $_GET['co'];
	$fe = $_GET['fe'];
	$imgcsv = $_GET['imgcsv'];

	$query = "UPDATE csvdata SET coupon='".$cp."', size='".$sz."', features='".$fe."', color='".$co."', image='".$imgcsv."' WHERE id = 568";

	  	$retval = mysqli_query($conn, $query);
            
        if(! $retval ) {
            die('Could not update data: ' . mysqli_error($conn));
        }
        echo "Inserted data successfully\n";
            

	echo $cp . " " . $sz . " " . $co . " " . $fe . " " . $imgcsv;

?>