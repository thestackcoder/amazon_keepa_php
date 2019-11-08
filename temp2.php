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

<style type="text/css">


</style>
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
		
		<div id="data"></div>

		<div style="overflow:scroll;height:700px;width:100%;overflow:auto; border: 1px solid silver; background-color: #fdfdfd;" class="table-responsive main">
			<div class="col-md-4 col-lg-4 pull-right">
				<input class="form-control" id="search" type="text" placeholder="Search..">
			</div><br>
			<table style="margin-top: 30px;" width="100%" id='demo' class="table table-fixed table-bordered">
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
			            <th id="featured">Features</th>
			            <th>Color</th>
			           	<?php				           	
			           		for ($i=0; $i < sizeof($colors); $i++) { 
			           			echo "<th class='color_head'>".$colors[$i]."</th>";
			           		}
			           	?> 	
			         	

			        </tr>
			    </thead>
			    <tbody id="table-body">
			    	
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
		    <div class="modal-dialog" style="margin-top: 30px; margin-bottom:50px; width: 70%;">
		    
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
		        		</div>
		        	</form>
		        	<form id="feature_detail_form">
		        		<div class="row" id="formHead">
		        			<p class="text-muted col-xs-6">Click on the label to change it. Then Press Enter.</p>
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
  
		$(document).ready(function(){

			$('#message').hide();

			var colors = [];
			var headings = '';
			var heads = [];
			var fea;
			var obj;

			$("#search").on("keyup", function() {
			    var value = $(this).val().toLowerCase();
			    $("#table-body tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });
			  });


			$.ajax({
				url: "getColors.php",
				method: 'GET',
				dataType: 'json',
				success: function(data){	
					for (var x in data){
						if (data.hasOwnProperty(x)){
							colors.push(data[x]);
						}
					}
				}
			});


			/**/
			$.ajax({
					url: "getTableHeadings.php",
					method: 'POST',
					dataType: 'json',
					success: function(data){									
						headings = '';		
						heads = data;

						if(data){
							for(var i = 0; i < data.length; i++){
								headings += '<th>'+data[i]+'</th>';		
							}				

							$('#demo > thead > #table-row').append(headings);

							for(var i =0; i < data.length; i++){
								var inputs = '<div class="form-group col-xs-6">'
								+'<label for="newfield"><a class="editable" data-toggle="modal" data-target="#edit_modal">'+data[i]+'</a></label>'					
								+'<input type="text" class="form-control newfields" name="newfield[]" />'						
								+'</div>';

								$("#form_row").append(
									inputs
								);
							}			


						}else{
							console.log('No data');
						}


					}	
				});

			/**/


			$(document).on('click', '.feature_class', function(){
				var id = $(this).attr('id');
				$.ajax({
					url: "getInputValues.php",
					method: 'POST',
					data: {id: id},
					dataType: 'json',
					success: function(data){
						if(data == null){
							$(".newfields").each(function(index){
								$(this).val('');
							});
						}else{
							$(".newfields").each(function(index){
								if($(this).prev().text() == heads[index]){
									$(this).val(data[index]);								
								}else{
									$(this).val('');
								}
							});
						}
																							
					}
				});
			});

		

			var featuresx = [];


			$.ajax({
				url: "gettabledata.php",
				method: 'GET',
				dataType: 'json',
				success: function(data){
					var tdHtml = '';


						$.ajax({
							url: "getTableHeadings.php",
							method: 'POST',
							dataType: 'json',
							success: function(data){	
								for (var x in data){
									if (data.hasOwnProperty(x)){
										featuresx.push(data[x]);
									}
								}

							}
						});

					data.forEach(function (dataItem) {
						var x = dataItem;
						
						tdHtml += '<tr class="data-row">' +
					        '<td>' + x.Product_Name + '</td>' +
					        '<td>' + x.Brand + '</td>' +
					        '<td>' + x.Price + '</td>' +
					        '<td>' + x.mo_sales + '</td>' +
					        '<td>' + x.d_sales + '</td>' +
					        '<td>' + x.mo_revenue + '</td>' +
					        '<td>' + x.reviews + '</td>' +
					        '<td>' + x.rating + '</td>' +
					        '<td>' + x.rank + '</td>' +
					        '<td>' + x.seller_type + '</td>' +
					        '<td>' + x.category + '</td>' +
					        '<td>' + x.parent_asin + '</td>' +
					        '<td><a href="'+x.link+'">' + x.asin + '</a></td>' +
					        '<td>' + x.coupon + '</td>' +
					        '<td>' + x.size + '</td>' +
					        '<td><a id="'+x.id+'" class="feature_class">' + x.features + '</a></td>'+
					        '<td>' + x.color + '</td>';				

					        tdHtml += displayColors(x.color, x.image);
				       		

					        fea = x.feature_details;
					        obj = JSON.parse(fea);

					        if(obj != null && headings != null){
					        	for (var key in obj) {
								    if (obj.hasOwnProperty(key)) {
								        tdHtml += '<td>' + obj[key] + '</td>';
								    }
								}	
					        }

					        /*for(var i = 0; i < featuresx.length; i++) {
					        	tdHtml += '<td>'+featuresx[i]+'</td>';				        	
					        }	*/			        

					    tdHtml += '</tr>';

					});
					
					$('#demo > tbody').append(tdHtml);

				},
				 error: function() {
			        alert('No data to render!');
			    }
			});
			


			function displayColors(color, image){
				var cohtml = '';
				 for(var i = 0; i < colors.length; i++) {
					if (color == colors[i]) {
					    cohtml += '<td><img width="100px" src=' + image + ' /></td>';				        	
					}else{
						cohtml += '<td></td>';
					}
				}

				return cohtml;
			}
			

			// Add field function
			$(document).on('click', '#add_btn', function(e){
				e.preventDefault();
				var inputs = '<div class="form-group col-xs-6">'
					+'<div class="input-group">'
					+'<label for="newfield"><a class="editable" data-toggle="modal" data-target="#edit_modal">'+$('#new_field').val()+'</a></label>'					
					+'<input type="text" class="form-control newfields" name="newfield[]" />'		
					+'<span class="input-group-btn"><button class="btn btn-danger remove_field" style="margin-top:25px;"><span class="glyphicon glyphicon-minus"></span></button></span>'
					+'</div>'		
					+'</div>';

				$("#form_row").append(
					inputs
				);

				$('#new_field').val('');

			}).on('click', '.remove_field', function(e) {
			    e.preventDefault();

			    $(this).parent().parent().parent().remove();

			}).on('click', '.editable', function(e){
				var $lbl = $(this), o = $lbl.text(),
		    	$txt = $('<input type="text" class="editable-label-text form-control" value="'+o+'" />');
			    $lbl.replaceWith($txt);
			    $txt.focus();
			    
			    $txt.blur(function() {
			    	$txt.replaceWith($lbl);
			    })
			    .keydown(function(evt){
			    	if(evt.keyCode == 13) {
			      	var no = $(this).val();
			      	$lbl.text(no);
			        $txt.replaceWith($lbl);
			      }
			    });

			});


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

				
				$(document).on('click', '#save', function(e){
					e.preventDefault();
				/*	var flat =  $('#flat_sheet').val();
					var fitted =  $('#fitted_sheet').val();
					var actual =  $('#pocket_actual').val();
					var fit =  $('#pocket_fits').val();
					var pillow =  $('#pillow_case').val();
					var elastic =  $('#elastic_sheet').val();
					var polyester =  $('#polyester').val();
					var standard =  $('#standard').val();
					var notes =  $('#notes').val();*/
					var labels = [];
					var inputs = [];
					var count = 0;
					$('#feature_detail_form label').each(function(count) {
						labels.push($(this).text());
						inputs.push($(this).next().val());						
						count++;
					});
					//console.log(dataToServer);

					/*var keys = Object.keys(dataToServer);
					var vals = Object.values(dataToServer);*/

					$.ajax({
						url: "getLabels.php",
						method: 'POST',
						data: {
							"labels": labels,
							"id": id 
						},
						dataType: 'json',						
						success: function(data){
							//console.log('Data Submitted');
							$('#message').text('Data updated Successfully!');
							$('message').show();
							/*for (var key in data) {
							    if (data.hasOwnProperty(key)) {
							        console.log(key + " -> " + data[key]);
							    }					
							}	*/
				
						}
					});

					$.ajax({
						url: "getInputs.php",
						method: 'POST',
						data: {
							"inputs": inputs,					
							"id": id 
						},
						dataType: 'json',						
						success: function(data){
							//console.log('Data Submitted');
							$('#message').text('Data updated Successfully!');
							/*for (var key in data) {
							    if (data.hasOwnProperty(key)) {
							        console.log(key + " -> " + data[key]);
							    }					
							}*/
				
						}
					});
					$('#myModal').modal('toggle'); 
				});

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

			var sp = asin.split(',');
			console.log(sp);
			var count = 22;

			if(asin){
				alert("Fetching Data from API");				
				while(sp.length) {
					var arr = sp.splice(0, count)
				    //console.log(arr);
				    var str = arr.toString();
				    //console.log(str);

				    if(str){
						fetch('https://api.keepa.com/product?key=9b9vdvv8l59t9ccc4a9l8ncajn9bm3ag2ae7h0fogsf9i3ihbpigsa6jrpcme4tb&domain=1&asin='+str)
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
									//console.log(data.products[i]);

									asins.push(data.products[i].asin);
									pasins.push(data.products[i].parentAsin);						
									cp.push(data.products[i].coupon);
									sz.push(data.products[i].size);
									fe.push(data.products[i].features);
									co.push(data.products[i].color);
									img.push(data.products[i].imagesCSV);						
								}		

								$.post('testapi.php', {
									coupons: cp,
								    sizes: sz,
								    features: fe,
								    colors: co,
								    images: img,
								    pasins: pasins,
								    asins: asins,					   
								}, function(response) {
			    					//$('#message').show();
								    $('#alert').text(response);
								    location.reload();
								});	
									
							})
							.catch((error) => {
								console.log(error);
								alert("Failed to load resources! Fetch again!");
							});
					}
				}
			}else{
				$('#alert').text("No ASINS Found.");
			}

		}
		
	</script>
</body>
</html>
