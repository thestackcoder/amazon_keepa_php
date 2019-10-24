<?php

include 'connection.php';

if(isset($_POST["Pound"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=csvtest", "root", "");

 $export_date = $_POST["Export date: 10/7/2019, 6:22:21 PM"];
 $empty = $_POST["Empty"];
 $pound = $_POST["Pound"];
 $product_name = $_POST["Product_Name"];
 $brand = $_POST["Brand"];
 $price = $_POST["Price"];
 $mo_sales = $_POST["mo_sales"];
 $d_sales = $_POST["d_sales"];
 $mo_revenue = $_POST["mo_revenue"];
 $reviews = $_POST["reviews"];
 $rating = $_POST["rating"];
 $rank = $_POST["rank"];
 $seller_type = $_POST["seller_type"];
 $category = $_POST["category"];
 $asin = $_POST["asin"];
 $link = $_POST["link"];



 for($count = 0; $count < count($pound); $count++)
 {
  $query .= "
  INSERT into csvdata(Export_date, Empty, Pound, Product_Name, Brand, Price, mo_sales, d_sales, mo_revenue, reviews, rating, rank, seller_type, category, asin, link)
                   values ('" . $export_date . "','" . $empty . "','" . $pound . "','" . $product_name . "','" . $brand . "','" . $price . "', '". $mo_sales."', '". $d_sales."', '". $mo_revenue ."', '". $reviews ."', '". $rating ."', '". $rank ."', '". $seller_type ."', '". $category ."', '". $asin ."', '". $link ."')
  
  ";
 }
 $statement = $connect->prepare($query);
 $statement->execute();
}

/*if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        $message = '';
        $row = 1;

        if($file !== FASLE){

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

            if($row == 1){ $row++; continue;}

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
    }

        header("Location: index.php");
        echo $message;
    }
}*/

?>