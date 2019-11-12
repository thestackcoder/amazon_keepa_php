$(document).ready(function(){
    //GLOBAL Variables
    var colors = [];
    var headings = '';
    var heads = [];
    var fea;
    var id;


    //Get All Distinct Colors
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


    // Table Headings (Feature Details)
    $.ajax({
        url: "getTableHeadings.php",
        method: 'POST',
        dataType: 'json',
        success: function(data){									
            headings = '';		
            heads = data;

            if(heads){
                for(var i = 0; i < heads.length; i++){
                    headings += '<th>'+heads[i]+'</th>';		
                }				

                $('#demo > thead > #table-row > #featured').after(headings);

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
    

    // Feature Form
    $(document).on('click', '.feature_class', function(){				
        $('#modal_msg').hide();
        $('#myModal').modal('show'); 

        id = $(this).attr('id');
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
    
        // GET features in input
        $.ajax({
            url: "fetch_feature.php",
            method: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function(data){
                $('#features').val(data.features);
            }
        });	

    });


    // Rendering Table
    $.ajax({
        url: "getTableData.php",
        method: 'GET',
        dataType: 'json',
        success: function(data){
            var tdHtml = '';

            data.forEach(function (dataItem) {
                var x = dataItem;

                tdHtml += '<tr class="data-row" id="'+x.id+'">' +
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
                    '<td><a id="'+x.id+'" class="feature_class">' + x.features + '</a></td>';

                    fea = x.feature_details;
                    arr = JSON.parse(fea);

                    if(arr != null){
                        if(arr.length == heads.length){
                            for(var i=0; i<arr.length; i++){
                                tdHtml += '<td class="dynamo">' + arr[i] + '</td>';								    					        	
                            }
                        }else if(arr.length < heads.length){					        		
                            for(var i=0; i<heads.length; i++){
                                if(arr[i]){
                                    tdHtml += '<td class="dynamo">' + arr[i] + '</td>';								    					   											
                                }else{
                                    tdHtml += '<td class="dynamo"></td>';					
                                }
                            }					        			
                        }					  					        	
                    }else{
                        for(var j=0; j<heads.length; j++){
                            tdHtml += '<td class="dynamo"></td>';
                        }
                    }
                    
                    tdHtml += '<td>' + x.color + '</td>';								       		
                    tdHtml += displayColors(x.color, x.image);					        		        

                tdHtml += '</tr>';

            });
            
            $('#demo > tbody').append(tdHtml);
            $('#demo').DataTable();
        },
        error: function() {
            alert('No data to render!');
        }
    });
    

    // Display Pictures in Table
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
    

    // Add and Remove New Field
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

    // Save the Feature Form data to Database
    // And Disply in Table

    $(document).on('click', '#save', function(e){
            e.preventDefault();
        
            var labels = [];
            var inputs = [];

            $('#feature_detail_form label').each(function(count) {
                labels.push($(this).text());
                inputs.push($(this).next().val());	
            });


            var doc = document.getElementById(id);
            var notes = [];
            for (var i = 0; i < doc.childNodes.length; i++) {
                if (doc.childNodes[i].className == "dynamo") {
                  notes.push(doc.childNodes[i]);
                }        
            }

            notes.forEach(function(element, index){
                element.innerText = inputs[index];
            });

            $.ajax({
                url: "getLabels.php",
                method: 'POST',
                data: {
                    "labels": labels,
                    "id": id 
                },
                dataType: 'json',						
                success: function(data){
                    $('#message').text('Data updated Successfully!');
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
                    $('#message').text('Data updated Successfully!');							
                }
            });

            $('#myModal').modal('hide');					
        });
    
});
