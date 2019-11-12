<?php

include 'connection.php';

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        $message = '';
        $row = 1;
        $result;

        if($file !== FALSE){

            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

                if($row == 1){ $row++; continue;}

                $asin = $column[14];

                $prevQuery = "SELECT id from csvdata WHERE asin = '".$asin."'";
                $prevResult = mysqli_query($conn, $prevQuery);

                if($prevResult->num_rows > 0){
                    $conn->query("UPDATE csvdata SET Product_Name = '".$column[3]."', Brand = '".$column[4]."',  Price = '".$column[5]."' ,  mo_sales = '".$column[6]."' ,  d_sales = '".$column[7]."' ,  mo_revenue = '".$column[8]."' , reviews = '".$column[9]."' ,  rating = '".$column[10]."', rank = '".$column[11]."' , seller_type = '".$column[12]."' , category = '".$column[13]."', asin = '".$column[14]."', link = '".$column[15]."' WHERE asin = '".$asin."'");

                }else{
                    $sqlInsert = "INSERT into csvdata(Product_Name, Brand, Price, mo_sales, d_sales, mo_revenue, reviews, rating, rank, seller_type, category, asin, link)
                       values ('" . $column[3] . "','" . $column[4] . "','" . $column[5] . "', '". $column[6]."', '". $column[7]."', '". $column[8]."', '". $column[9]."', '". $column[10]."', '". $column[11]."', '". $column[12]."', '". $column[13]."', '". $column[14]."', '". $column[15]."')";

                    $result = mysqli_query($conn, $sqlInsert);                    
                }                
                
            }

            if (!empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }

        }
        echo '<script language="javascript">';
        echo 'location.href="index.php"; alert("'.$message.'");';
        echo '</script>';
        //echo "Response: " . $message ;
    }
}

?>