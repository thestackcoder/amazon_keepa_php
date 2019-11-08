<?php
	include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>CSV To MYSQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>	

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
</head>
<body>

	<div class="topnav" id="myTopnav">
	  <a href="#home" class="active">Home</a>
	  <a href="temp2.php" type="submit" name="show">Show All Data</a>
	  <!--<a href="#about">Show Data</a>-->
	  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div>

	<form id="upload_csv" class="form-horizontal form-inline" method="post" name="uploadCSV"
    enctype="multipart/form-data" action="import.php">

    	<div class="form-elements">
		    <div class="form-group">
		        <input type="file" name="file" id="file" accept=".csv">
		    </div>
		    <div class="form-group">
		        <button id="upload_data" name="upload"
		            class="btn-submit btn btn-default">Upload</button>
		    </div>	    
		</div>
	    <div id="import-btn" class="form-group">
	    	<button type="submit" id="import" name="import"
	            class="btn-submit">Import</button>
		</div>
		
	    <div id="labelError"></div>
	</form>

   <div id="csv_file_data"></div>

	<!-- <form id="import_csv" class="form-horizontal form-inline" method="post" name="importCSV"
    enctype="multipart/form-data" action="import.php">
    	<div class="form-group">
	        <input type="file" name="file" id="file-x" accept=".csv">
	    </div>
		<div class="form-group">
	        <button type="submit" id="submit" name="import"
	            class="btn-submit">Import</button>
	    </div>
	</form> -->
	<div class="main">
		<h3><b>Data from CSV File:</b></h3><hr>
		<div class="table-responsive">
			<table id='data-table' class="table table-bordered">
			    <thead>
			        <tr>
			            <th>Export date: 10/7/2019, 6:22:21 PM</th>
			            <th>Empty</th>
			            <th>#</th>
			            <th>Product Name</th>
			            <th>Brand</th>
			            <th>Price</th>
			           	<th>Mo. Sales</th>
			            <th>D. Sales</th>
			            <th>Mo. Revenue</th>
			            <th>Reviews</th>
			            <th>Ratings</th>
			            <th>Rank</th>
			            <th>Seller Type</th>
			            <th>Category</th>
			            <th>ASIN</th>		   
			            <th>Link</th>
			        </tr>
			    </thead>
			    		    
			</table>
		</div>
	</div>
		

    <script>

    	/*$(document).ready(function(){
			$('#data-table').DataTable({
				'ajax':{
					"url": "getData.php",
					"dataSrc": ""
				},
				"columns": [
					{"data": "id"},
					{"data": "Export_date"},
					{"data": "Empty"},
					{"data": "Pound"},
					{"data": "Product_Name"},
					{"data": "Brand"},
					{"data": "Price"},
					{"data": "mo_sales"},
					{"data": "d_sales"},
					{"data": "mo_revenue"},
					{"data": "reviews"},
					{"data": "rating"},
					{"data": "rank"},
					{"data": "seller_type"},
					{"data": "category"},
					{"data": "asin"},					
					{"data": "link"},									
				]
			});
		});*/


		$(document).ready(function(){
			var form = document.getElementById('upload_csv');
			$('#upload_data').on('click', function(event){
				event.preventDefault();
				  $.ajax({
				   url:"import_data.php",
				   method:"POST",
				   data: new FormData(form),
				   dataType:'json',
				   contentType:false,
				   cache:false,
				   processData:false,
				   success:function(jsonData)
				   {
				   	//console.log(jsonData);
				    $('#data-table').DataTable({
				     data  :  jsonData,
				     columns :  [
						{data: "Export date: 10/7/2019, 6:22:21 PM"},
						{data: "Empty"},
						{data: "Pound"},
						{data: "Product_Name"},
						{data: "Brand"},
						{data: "Price"},
						{data: "mo_sales"},
						{data: "d_sales"},
						{data: "mo_revenue"},
						{data: "reviews"},
						{data: "rating"},
						{data: "rank"},
						{data: "seller_type"},
						{data: "category"},
						{data: "asin"},					
						{data: "link"},	
				     ]
				    });				 				  
				   }				   
				});
			 	//console.log('wow');			 					   				
			});	

		});


		function myFunction() {
		  var x = document.getElementById("myTopnav");
		  if (x.className === "topnav") {
		    x.className += " responsive";
		  } else {
		    x.className = "topnav";
		  }
		}

	</script>
</body>
</html>
