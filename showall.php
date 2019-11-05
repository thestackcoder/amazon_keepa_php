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

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

	<div class="topnav" id="myTopnav">
	  <a href="index.php">Home</a>
	  <a style="cursor: pointer;" type="submit" class="active" name="show">Show All Data</a>
	  <a id="call_api" onclick = "sendData()" style="float:right; cursor: pointer;" type="submit" class="active" name="show">Fetch Products</a>

	  <!--<a href="#about">Show Data</a>-->
	  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
	    <i class="fa fa-bars"></i>
	  </a>
	</div>

	<div class="main">
		<div id="message" class="alert alert-info alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong id="alert"></strong>
		</div>

		<?php
			$colors = array();

			$sql = "SELECT color FROM csvdata";
			$result = mysqli_query($conn, $sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
				    $colors[] = $row['color'];
				}
			} else {
				echo '<script>console.log("0 results");</script>';
			}

			
		?>

		<h2>All Data from DB</h2>
		
		<div class="table-responsive">
			<table id='myTable' class="table table-bordered">
			    <thead>
			        <tr>
			        	<th>id</th>		
			            <th>Image</th>			        		          
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
			            <th>Parent ASIN</th>
			            <th>ASIN</th>		   
			            <th>Link</th>
			            <th>Coupon</th>
			            <th>Size</th>
			            <th>Features</th>
			            <th>Color</th>
			            <th>Navy Blue</th>
			           	<!-- <?php				           	
			           		/*for ($i=0; $i < sizeof($colors); $i++) { 
			           			echo "<th>'".$colors[$i]."'</th>";
			           		}*/
			           	?>  -->           			            
			        </tr>
			    </thead>
			    		    
			</table>
		</div>
	</div>

	<?php
		$res = '';

		$sql = "SELECT asin FROM csvdata";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
			    $res .= $row["asin"];
			    $res .= ",";
			}

			//echo $res;
		} else {
			echo '<script>console.log("0 results");</script>';
		}

		
	?>
    <script>
    	$(document).ready(function(){
    		$('#message').hide();

			$('#myTable').DataTable({
				'ajax':{
					"url": "getData.php",
					"dataSrc": "",
				},	
				"scrollY": 650,
				"scrollX": true,
				"columns": [
					{"data": "id"},
					{
						"data": "image", 
						"render": function(data, type, full, meta){
							return '<img src="'+data+'" width="100" />';
						}
					},									
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
					{"data": "parent_asin"},				
					{"data": "asin"},					
					{"data": "link"},		
					{"data": "coupon"},									
					{"data": "size"},									
					{"data": "features"},									
					{"data": "color"},			
					{"data": "color"},									
				]
			});
		});

		function getImg(data, type, full, meta) {
	        return '<img src="'+data+'" width="100" />';
	    }

		function myFunction() {
		  var x = document.getElementById("myTopnav");
		  if (x.className === "topnav") {
		    x.className += " responsive";
		  } else {
		    x.className = "topnav";
		  }
		}


		function sendData(){
			var asin = "<?php echo $res ?>";
			console.log(asin);

			if(asin){

				fetch('https://api.keepa.com/product?key=3a2iq6ba7tjnin8ss488tt7c7feir40i4pndjfqtbgnhm478uh652vknqupceo7b&domain=1&asin='+asin)
					.then(res => res.json())
					.then(function(data){						
						//console.log(data);
						var cp = [];
						var sz = [];
						var fe = [];
						var co = [];
						var img = [];
						var pasins = [];
						var asins = [];

						for (var i = 0; i < data.products.length; i++) {
							console.log(data.products[i]);

							asins.push(data.products[i].asin);
							pasins.push(data.products[i].parentAsin);						
							cp.push(data.products[i].coupon);
							sz.push(data.products[i].size);
							fe.push(data.products[i].features);
							co.push(data.products[i].color);
							img.push(data.products[i].imagesCSV);						
						}

						console.log(cp);
						console.log(sz);
						console.log(fe);
						console.log(co);
						console.log(img);
						console.log(pasins);

						console.log(asins);			

						$.post('testapi.php', {
							coupons: cp,
						    sizes: sz,
						    features: fe,
						    colors: co,
						    images: img,
						    pasins: pasins,
						    asins: asins,					   
						}, function(response) {
	    					$('#message').show();
							console.log(response);
						    $('#alert').text(response);
						});	

						/*if (window.XMLHttpRequest) {
				            // code for IE7+, Firefox, Chrome, Opera, Safari
				            xmlhttp = new XMLHttpRequest();
				        } else {
				            // code for IE6, IE5
				            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				        }

				        xmlhttp.open("POST","testapi.php?cp="+cp+"&sz="+sz+"&fe="+fe+"&co="+co+"&img="+img+"&asins="+asins, true);
						xmlhttp.send();*/


						/*var cp = data.products[0].coupon;
						console.log(cp);
						var sz = data.products[0].size;
						console.log(sz);

						var fe = data.products[0].features;
						console.log(fe);

						var co = data.products[0].color;	
						console.log(co);

						var imgcsv = data.products[0].imagesCSV;	

						var img = 'https://images-na.ssl-images-amazon.com/images/I/';					

						var new_img = img + data.products[0].imagesCSV.split(",")[0];
						console.log(new_img);					

						if (window.XMLHttpRequest) {
				            // code for IE7+, Firefox, Chrome, Opera, Safari
				            xmlhttp = new XMLHttpRequest();
				        } else {
				            // code for IE6, IE5
				            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				        }

						xmlhttp.open("POST","api.php?cp="+cp+"&sz="+sz+"&fe="+fe+"&co="+co+"&imgcsv="+imgcsv,true);
						xmlhttp.send();*/
							
					})
					.catch((error) => console.log(error));
			}else{
	    		$('#message').show();				
				$('#alert').text("No ASINS Found.");
			}

		}
		
	</script>
</body>
</html>
