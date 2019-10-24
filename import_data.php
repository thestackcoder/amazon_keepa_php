<?php

include 'connection.php';
//import.php

if(!empty($_FILES['file']['name']))
	{
	 $file_data = fopen($_FILES['file']['name'], 'r');
	 fgetcsv($file_data);
	 while($row = fgetcsv($file_data, 10000, ","))
	 {
		  $data[] = array(
		   'Export date: 10/7/2019, 6:22:21 PM'  => $row[0],
		   'Empty'  => $row[1],
		   'Pound'  => $row[2],
		   'Product_Name'  => $row[3],
		   'Brand'  => $row[4],
		   'Price'  => $row[5],
		   'mo_sales'  => $row[6],
		   'd_sales'  => $row[7],
		   'mo_revenue'  => $row[8],
		   'reviews'  => $row[9],
		   'rating'  => $row[10],
		   'rank'  => $row[11],
		   'seller_type'  => $row[12],
		   'category'  => $row[13],
		   'asin'  => $row[14],
		   'link'  => $row[15],

		  );
	 }

	 echo json_encode($data);            
	            
	}
/*
if (isset($_POST['import'])) {

	$fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        $message = '';

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

            $asin = $column[14];

            $prevQuery = "SELECT id from csvdata WHERE asin = '".$asin."'";
            $prevResult = mysqli_query($conn, $prevQuery);

            if($prevResult->num_rows > 0){
                $conn->query("UPDATE csvdata SET Export_date = '".$column[0]."', Empty = '".$column[1]."', Pound = '".$column[2]."', Product_Name = '".$column[3]."', Brand = '".$column[4]."',  Price = '".$column[5]."' ,  mo_sales = '".$column[6]."' ,  d_sales = '".$column[7]."' ,  mo_revenue = '".$column[8]."' , reviews = '".$column[9]."' ,  rating = '".$column[10]."', rank = '".$column[11]."' , seller_type = '".$column[12]."' , category = '".$column[13]."', asin = '".$column[14]."', link = '".$column[15]."' WHERE asin = '".$asin."'");

            }else{
                $sqlInsert = "INSERT into csvdata(Export_date, Empty, Pound, Product_Name, Brand, Price, mo_sales, d_sales, mo_revenue, reviews, rating, rank, seller_type, category, asin, link)
                   values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "', '". $column[6]."', '". $column[7]."', '". $column[8]."', '". $column[9]."', '". $column[10]."', '". $column[11]."', '". $column[12]."', '". $column[13]."', '". $column[14]."', '". $column[15]."')";

                $result = mysqli_query($conn, $sqlInsert);
                if (!empty($result)) {
                    $type = "success";
                    $message = "CSV Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing CSV Data";
                }

            }
            
            
        }

        header("Location: index.php");
        echo $message;
    }

}*/



?>