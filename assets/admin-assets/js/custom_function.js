
var base_url = '<?php echo base_url();?>';
//available from and to  date 
$("#available_from").datetimepicker({      
  format:'M-d-Y',      
  timepicker:false, 
});

$("#available_to").datetimepicker({      
  format:'M-d-Y',      
  timepicker:false, 
});
$("#available_partfrom").datetimepicker({      
  format:'M-d-Y',      
  timepicker:false, 
});

$("#available_partto").datetimepicker({      
  format:'M-d-Y',      
  timepicker:false, 
});

$("#dealer_available_from").datetimepicker({      
  format:'M-d-Y',      
  timepicker:false, 
});

$("#dealer_available_to").datetimepicker({      
  format:'M-d-Y',      
  timepicker:false, 
});

// $("#price").click(function () {
 function Validate(event) {
        var regex = new RegExp("^[0-9-!@#$%*?]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }  

function yourfunction(category_id)
        {
            if(category_id == Luxury)
            { 
              $("#showing_form_details").show(); 
              $("#demage_details").hide(); 
              $("#show_repair_cost").hide();
              $("#text_show").html('Luxury/ Premium Collections');
              $("#category_val").val('Luxury');
              $("#show_Splash_Text").hide();  
              $("#showing_parts").hide();     
            }
            else if(category_id == Dealership)
            {    
               $("#showing_form_details").show();
               $("#demage_details").hide();
               $("#show_repair_cost").hide();
               $("#text_show").html('Dealership Consignment');
               $("#category_val").val('Dealership');
               $("#show_Splash_Text").hide();
               $("#showing_parts").hide(); 
            }
            else if(category_id == Used_Cars)
            {    
              $("#showing_form_details").show();
              $("#demage_details").show();
              $("#show_repair_cost").show();
              $("#text_show").html('Used Cars- Minor Dents');
              $("#category_val").val('Used_Cars');
              $("#show_Splash_Text").hide();
              $("#showing_parts").hide();
            }
            else if(category_id == Uber_Taxi)
            {    
               $("#showing_form_details").show();
               $("#demage_details").show();
               $("#show_repair_cost").show();
               $("#text_show").html('Uber Taxi Ready Cars');
               $("#category_val").val('Uber_Taxi');
               $("#show_Splash_Text").hide();
               $("#showing_parts").hide(); 
            }

            else if(category_id == Commercial_car)
            {    
               $("#showing_form_details").show();
               $("#demage_details").show();
               $("#show_repair_cost").show();
               $("#text_show").html('Commercial Cars-Trucks');
               $("#category_val").val('Commercial_car');
               $("#show_Splash_Text").hide();
                $("#showing_parts").hide(); 
            }
            else if(category_id == Hot_Deals)
            {    
               $("#showing_form_details").show();
               $("#demage_details").show();
               $("#show_repair_cost").show();
               $("#text_show").html('Hot Deals');
               $("#category_val").val('Hot_Deals');
               $("#show_Splash_Text").show();
               $("#showing_parts").hide(); 
            }
            else if(category_id == Autoparts)
            {    
               $("#showing_form_details").hide();
               $("#demage_details").show();
               $("#show_repair_cost").show();
               $("#text_show").html('Autoparts');
               $("#category_val").val('Autoparts');
               $("#show_Splash_Text").hide();
               $("#showing_parts").show();
            }

        }    

 
//admin stock form submit

var base_url = '<?php echo base_url() ?>'; //form submited


    $(document).on("submit", "#admin_stockform", function(e){

        e.preventDefault();

        $(this).validate({ 
                         rules: {                             
                                  car_type:"required",                  
                                  car_model: "required",
                                  price: "required",
                                  engine_type: "required",
                                  buyer_code: "required",               
                                },

                          messages: 
                                {                           
                                  car_type: {
                                      required: "Required", 
                                  }, 
                                  car_model: {
                                      required: "Required ", 
                                  }, 
                                  price: {
                                      required: "Required",
                                      digits: true
                                  }, 
                                  engine_type: {
                                      required: "Required", 
                                  }, 

                                  buyer_code: {
                                      required: "Required", 
                                  },       
                                },

                        }); 

    if($(this).valid())
        {     
            var url = $(this).attr('action');
            var formdata = new FormData(this);

            var optionText = $("#car-model-trims option:selected").text();
            formdata.append('car-model-trims',optionText);
          
            $.ajax({
                    url : url,
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    error: function(xhr,status,error)
                    {   
                        alert(xhr.responseText);
                    },                   
                   
                    beforeSend: function()
                    {

                      swal({
                          title: 'Please Wait...',
                          text: 'Submitting...',
                          toast: true,
                          target: '.swal',              
                         
                          onOpen: () => {
                            swal.showLoading()
                         }
                      }); 
          
                    },
                    success: function(response)
                    {
                       if(response.status == 'success')
                       {
                       
                         document.getElementById("admin_stockform").reset();
                        swal({
                                title: "Success!",
                                text: "Your Details Updated Successfully...",
                                type: "success",
                                timer: 2000
                            }).then(() => {                     
                                  window.location.href ='get_car_infomation';
                                });;  
                       
                        }                      
                       
                        else 
                        {                       
                          $("#result").html('<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Sorry!</strong> Something went wrong Try again. </div>');
                        }          
                    }

           });
    }     

 });


// Autoparts form submit

 $(document).on("submit", "#addparts_form", function(e){

        e.preventDefault();

        $(this).validate({ 
                         rules: {                             
                                  carpart_type:"required",                  
                                  part_years: "required",
                                  price: "required",
                                  part_Message: "required",
                                  part_price: "required",               
                                },

                          messages: 
                                {                           
                                  carpart_type: {
                                      required: "Required", 
                                  }, 
                                  part_years: {
                                      required: "Required ", 
                                  }, 
                                  price: {
                                      required: "Required",
                                      digits: true
                                  }, 
                                  part_Message: {
                                      required: "Required", 
                                  }, 

                                  part_price: {
                                      required: "Required", 
                                  },       
                                },

                        }); 

    if($(this).valid())
        {     
            var url = $(this).attr('action');
            var formdata = new FormData(this);

            // var optionText = $("#car-model-trims option:selected").text();
            // formdata.append('car-model-trims',optionText);
          
            $.ajax({
                    url : url,
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    error: function(xhr,status,error)
                    {   
                        alert(xhr.responseText);
                    },                   
                   
                    beforeSend: function()
                    {

                      swal({
                          title: 'Please Wait...',
                          text: 'Submitting...',
                          toast: true,
                          target: '.swal',              
                         
                          onOpen: () => {
                            swal.showLoading()
                         }
                      }); 
          
                    },
                    success: function(response)
                    {
                       if(response.status == 'success')
                       {
                       
                         document.getElementById("addparts_form").reset();
                        swal({
                                title: "Success!",
                                text: "Your Details Updated Successfully...",
                                type: "success",
                                timer: 2000
                            }).then(() => {                     
                                  window.location.href ='get_car_infomation';
                                });;  
                       
                        }                      
                       
                        else 
                        {                       
                          $("#result").html('<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Sorry!</strong> Something went wrong Try again. </div>');
                        }          
                    }

           });
    }     

 });


//Dealership_stockform stock form submit

var base_url = '<?php echo base_url() ?>'; //form submited


    $(document).on("submit", "#Dealership_stockform", function(e){

        e.preventDefault();

        $(this).validate({ 
                         rules: {                             
                                  car_type:"required",                  
                                  car_model: "required",
                                  price: "required",
                                  engine_type: "required",
                                  buyer_code: "required",               
                                },

                          messages: 
                                {                           
                                  car_type: {
                                      required: "Required", 
                                  }, 
                                  car_model: {
                                      required: "Required ", 
                                  }, 
                                  price: {
                                      required: "Required",
                                      digits: true
                                  }, 
                                  engine_type: {
                                      required: "Required", 
                                  }, 

                                  buyer_code: {
                                      required: "Required", 
                                  },       
                                },

                        }); 

    if($(this).valid())
        {     
            var url = $(this).attr('action');
            var formdata = new FormData(this);

            var optionText = $("#car-model-trims option:selected").text();
            formdata.append('car-model-trims',optionText);
          
            $.ajax({
                    url : url,
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    error: function(xhr,status,error)
                    {   
                        alert(xhr.responseText);
                    },                   
                   
                    beforeSend: function()
                    {

                      swal({
                          title: 'Please Wait...',
                          text: 'Submitting...',
                          toast: true,
                          target: '.swal',              
                         
                          onOpen: () => {
                            swal.showLoading()
                         }
                      }); 
          
                    },
                    success: function(response)
                    {
                       if(response.status == 'success')
                       {
                       
                         document.getElementById("admin_stockform").reset();
                        swal({
                                title: "Success!",
                                text: "Your Details Updated Successfully...",
                                type: "success",
                                timer: 2000
                            }).then(() => {                     
                                  window.location.href ='get_car_infomation';
                                });;  
                       
                        }                      
                       
                        else 
                        {                       
                          $("#result").html('<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Sorry!</strong> Something went wrong Try again. </div>');
                        }          
                    }

           });
    }     

 });



// car model pick from library

$(document).ready(
function()
{
     //Create a variable for the CarQuery object.  You can call it whatever you like.
      var carquery = new CarQuery();

      var cq2 = new CarQuery();

     //Run the carquery init function to get things started:
      carquery.init();

      cq2.init();
     
     //Optionally, you can pre-select a vehicle by passing year / make / model / trim to the init function:
     //carquery.init('2000', 'dodge', 'Viper', 11636);

     //Optional: Pass sold_in_us:true to the setFilters method to show only US models. 
      carquery.setFilters( {sold_in_us:true} );

      cq2.setFilters( {sold_in_us:true} );

     //Optional: initialize the year, make, model, and trim drop downs by providing their element IDs
      carquery.initYearMakeModelTrim('car-years-1', 'car-makes-1', 'car-models-1', 'car-model-trims-1');
    
      cq2.initYearMakeModelTrim('car-years-2', 'car-makes-2', 'car-models-2', 'car-model-trims-2');
     //Optional: set the onclick event for a button to show car data.
     $('#cq-show-data').click(  function(){ carquery.populateCarData('car-model-data'); } );

     //Optional: initialize the make, model, trim lists by providing their element IDs.
     carquery.initMakeModelTrimList('make-list', 'model-list', 'trim-list', 'trim-data-list');

     //Optional: set minimum and/or maximum year options.
     cq2.year_select_min=1990;
     cq2.year_select_max=2018;

     cq2.year_select_min=1990;
     cq2.year_select_max=2018;
 
     //Optional: initialize search interface elements.
     //The IDs provided below are the IDs of the text and select inputs that will be used to set the search criteria.
     //All values are optional, and will be set to the default values provided below if not specified.
     var searchArgs =
     ({
         body_id:                       "cq-body"
        ,default_search_text:           "Keyword Search"
        ,doors_id:                      "cq-doors"
        ,drive_id:                      "cq-drive"
        ,engine_position_id:            "cq-engine-position"
        ,engine_type_id:                "cq-engine-type"
        ,fuel_type_id:                  "cq-fuel-type"
        ,min_cylinders_id:              "cq-min-cylinders"
        ,min_mpg_hwy_id:                "cq-min-mpg-hwy"
        ,min_power_id:                  "cq-min-power"
        ,min_top_speed_id:              "cq-min-top-speed"
        ,min_torque_id:                 "cq-min-torque"
        ,min_weight_id:                 "cq-min-weight"
        ,min_year_id:                   "cq-min-year"
        ,max_cylinders_id:              "cq-max-cylinders"
        ,max_mpg_hwy_id:                "cq-max-mpg-hwy"
        ,max_power_id:                  "cq-max-power"
        ,max_top_speed_id:              "cq-max-top-speed"
        ,max_weight_id:                 "cq-max-weight"
        ,max_year_id:                   "cq-max-year"
        ,search_controls_id:            "cq-search-controls"
        ,search_input_id:               "cq-search-input"
        ,search_results_id:             "cq-search-results"
        ,search_result_id:              "cq-search-result"
        ,seats_id:                      "cq-seats"
        ,sold_in_us_id:                 "cq-sold-in-us"
     }); 
      carquery.initSearchInterface(searchArgs);

      cq2.initSearchInterface(searchArgs);

     //If creating a search interface, set onclick event for the search button.  Make sure the ID used matches your search button ID.
     $('#cq-search-btn').click( function(){ carquery.search(); } );
});
