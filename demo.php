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

			$sql = "SELECT color FROM `csvdata` group by color";

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
		
		<!-- <div class="table-responsive">
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
			           	
			        </tr>
			    </thead>
			    		    
			</table>
		</div> -->
		<div id="data"></div>

		<div style="overflow:scroll;height:700px;width:100%;overflow:auto" class="table-responsive main">
			<table width="100%" id='demo' class="table table-fixed table-bordered">
			    <thead>
			        <tr id='table-row'>					        		         
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
			            <th>Coupon</th>
			            <th>Size</th>
			            <th>Features</th>
			            <th>Color</th>
			           	<?php				           	
			           		for ($i=0; $i < sizeof($colors); $i++) { 
			           			echo "<th>".$colors[$i]."</th>";
			           		}
			           	?> 
			           	<th>Flat Sheet Dimensions</th>
			            <th>Fitted Sheet Dimensions</th>
			            <th>Pocket Actual Size</th>		   
			            <th>Pocket Depth Fits Upto</th>
			            <th>Pillow Case Dimensions</th>
			            <th>Elastic All Around</th>
			            <th>100% Polyester</th>
			            <th>OKEO-TEX Standard</th>
			            <th>Notes</th>
			           	
			        </tr>
			    </thead>
			    <tbody>
			    	<?php
			    		$sql = "SELECT * FROM csvdata";
						$result = mysqli_query($conn, $sql);
						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
							    echo "<tr class='data-row'>";
								    echo "<td>".$row['Product_Name']."</td>";
								    echo "<td>".$row['Brand']."</td>";
								    echo "<td>".$row['Price']."</td>";
								    echo "<td>".$row['mo_sales']."</td>";
								    echo "<td>".$row['d_sales']."</td>";
								    echo "<td>".$row['mo_revenue']."</td>";
								    echo "<td>".$row['reviews']."</td>";
								    echo "<td>".$row['rating']."</td>";
								    echo "<td>".$row['rank']."</td>";
								    echo "<td>".$row['seller_type']."</td>";
								    echo "<td>".$row['category']."</td>";
								    echo "<td>".$row['parent_asin']."</td>";
								    echo "<td><a href='".$row['link']."'>".$row['asin']."</a></td>";
								    echo "<td>".$row['coupon']."</td>";					    
								    echo "<td>".$row['size']."</td>";							    
								    echo "<td><a id='".$row['id']."' class='feature_class' >".$row['features']."</a></td>";							    
								    echo "<td>".$row['color']."</td>";	

								    for ($i=0; $i < sizeof($colors); $i++) { 
					           			if($row['color'] == $colors[$i]){
									    	echo "<td><img width='100px' src='".$row['image']."'/></td>";
									    }else{
									    	echo '<td></td>';
									    }					    

				           			}	
				           			/*$temp = explode (',', $row['feature_details']);
		 
									foreach ($temp as $pair) {
										list ($k, $v) = explode(':', $pair);
										$pairs[$k] = $v;
									}
									print_r($pairs);*/
									$fd = json_decode($row['feature_details'], true); 
				           			echo '<td>'.$fd["flat_sheet_dimension"].'</td>';
				           			echo '<td>'.$fd["fitted_sheet_dimension"].'</td>';
				           			echo '<td>'.$fd["pocket_depth_actual"].'</td>';
				           			echo '<td>'.$fd["pocket_depth_fits"].'</td>';
				           			echo '<td>'.$fd["pillow_case"].'</td>';
				           			echo '<td>'.$fd["elastic_allaround"].'</td>';	
				           			echo '<td>'.$fd["polyester"].'</td>';				           			
				           			echo '<td>'.$fd["okeo_standard"].'</td>';				           			
				           			echo '<td>'.$fd["notes"].'</td>';				           			
							    echo "</tr>";			           			

							}

																				

							//echo $res;
						} else {
							echo '<script>console.log("0 results");</script>';
						}
			    	?>
			    </tbody>
			    		    
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

	<div class="container">
		<!-- Modal -->
		  <div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog" style="margin-top: 30px; margin-bottom:50px; width: 50%;">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Feature Details</h4>
		        </div>
		        <div class="modal-body" style="overflow-y: scroll; max-height: 750px;">
		        	<div id="modal_msg" class="alert alert-info alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong id="alert"></strong>
				</div>
		        	<form id="feature_form">
		        		<div class="form-group">
			        		<label for="flat sheet">Features</label>	        			
		        			<textarea rows="8" name="features" id="features" class="form-control" ></textarea>
		        		</div><br>
		        		<div class="row">
			        		<div class="form-group col-xs-6">
			        			<label for="Flat Sheet">Flat Sheet Dimension (Inches)</label>
			        			<input class="form-control" type="text" id="flat_sheet" required>
			        		</div>
			        		<div class="form-group col-xs-6">
			        			<label for="Fitted Sheet">Fitted Sheet Dimension (Inches)</label>
			        			<input class="form-control" type="text" id="fitted_sheet" required>
			        		</div>
			        		<div class="form-group col-xs-6">
			        			<label for="Pocket Actual">Pocket Depth Actual Size (Inches)</label>
			        			<input class="form-control" type="text" id="pocket_actual" required>
			        		</div>
			        		<div class="form-group col-xs-6">
			        			<label for="Pocket Fits">Pocket Depth Fits Upto (Inches)</label>
			        			<input class="form-control" type="text" id="pocket_fits" required>
			        		</div>
			        		<div class="form-group col-xs-6">
			        			<label for="Pillow Case">Pillow Case Dimensions (Inches)</label>
			        			<input class="form-control" type="text" id="pillow_case" required>
			        		</div>
			        		<div class="form-group col-xs-6">
			        			<label for="Elastic Sheet">Elastic All Around</label>
			        			<input class="form-control" type="text" id="elastic_sheet" required>
			        		</div>
			        		<div class="form-group col-xs-6">
			        			<label for="Polyester">100% Polyester</label>
			        			<input class="form-control" type="text" id="polyester" required>
			        		</div>
			        		<div class="form-group col-xs-6">
			        			<label for="Standard">OKEO-TEX Standard 100 Factory</label>
			        			<input class="form-control" type="text" id="standard" required>
			        		</div>
			        		<div class="form-group col-xs-6">
			        			<label for="Notes">Notes</label><br>
			        			<textarea class="form-control" id="notes" required></textarea>
			        		</div>		
				        		
		        		</div>
		        		<div class="row" id="form_row">			        		
				        	<!--Dynamic Fields-->
		        		</div>
		        		<br>
		        		<div class="row" style="text-align: center;">
		        			<span><b>Add More Fields</b></span><br>
		        			<button class="btn btn-default btn-add" type="button" data-toggle="modal" data-target="#fields_modal">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
		        		</div>

		        	</form>
		        </div>
		        <div class="modal-footer">
		        	<div class="row">
			        	<div class="col-xs-3">
			        		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			        	</div>
			        	<div class="form-group col-xs-3 col-xs-offset-6">
				        	<input class="btn btn-block btn-primary pull-right" type="submit" id="save" value="Save">
				        </div>		   
			        </div>       
		        </div>
		      </div>
		      
		    </div>
		  </div>
	</div>


	<!-- Modal -->
	<div style="position: absolute; top: 200px; " id="fields_modal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Fields</h4>
	      </div>
	      <div class="modal-body">
	      	<label>Add Label For New Field</label>
	      	<input id="new_field" class="form-control" type="text" name="label">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	      	
	        <button id="add_btn" type="button" class="btn btn-primary">Add</button>	      	
	      </div>
	    </div>

	  </div>
	</div>

    <script>
    	/*$(document).ready(function(){
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
				]
			});
		});*/

		$(document).ready(function(){
			$('#message').hide();
			$(document).on('click', '.feature_class', function(){
				$('#modal_msg').hide();
				var id = $(this).attr('id');
				$.ajax({
					url: "fetch.php",
					method: 'POST',
					data: {id: id},
					dataType: 'json',
					success: function(data){
						$('#features').val(data.features);
						$('#myModal').modal('show');
					}
				});


				$('form').on('submit', function(e){
					e.preventDefault();
					var flat =  $('#flat_sheet').val();
					var fitted =  $('#fitted_sheet').val();
					var actual =  $('#pocket_actual').val();
					var fit =  $('#pocket_fits').val();
					var pillow =  $('#pillow_case').val();
					var elastic =  $('#elastic_sheet').val();
					var polyester =  $('#polyester').val();
					var standard =  $('#standard').val();
					var notes =  $('#notes').val();

					$.ajax({
						url: "storeFeatures.php",
						method: 'POST',
						data: {
							id: id,
							flat: flat,
						 	fitted: fitted,					 	
						 	actual: actual,
						 	fit: fit,
						 	pillow: pillow,  
						 	elastic: elastic, 
						 	polyester: polyester,
						 	standard: standard,
						 	notes: notes
						},
						success: function(data, response){
							console.log('Data Submitted');
							console.log(data);
							/*$('#modal_msg').text(response);
							$('#modal_msg').show();*/
							$('form').find("input[type=text], textarea").val("");	

							$('#myModal').modal('toggle'); 
    						return false;
						}
					});
				});

			});
			
		});

		// Add field function
		$(document).on('click', '#add_btn', function(e){
			e.preventDefault();

			$("#form_row").append(
				'<div class="form-group col-xs-6">'
				+'<label for="newfield">'+$('#new_field').val()+'</label>'
				+'<div class="input-group">'
				+'<input type="text" class="form-control"></input>'		
				+'<span class="input-group-btn"><button class="btn btn-danger remove_field"><span class="glyphicon glyphicon-minus"></span></button></span>'
				+'</div>'		
				+'</div>'
			);

			$('#new_field').val('');

		}).on('click', '.remove_field', function(e) {
		    e.preventDefault();

		    $(this).parent().parent().parent().remove();
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
