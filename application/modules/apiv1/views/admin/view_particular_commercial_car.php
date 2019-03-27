
<?php $this->load->view('includes/admin_css'); ?>

<style type="text/css">
    span{
        font-weight: bold;
    }
</style>
<body class="sidebar-dark sidebar-expand navbar-brand-dark header-light">
    <div id="wrapper" class="wrapper">
        <!-- HEADER & TOP NAVIGATION -->
             <?php $this->load->view('includes/admin_top_navigation'); ?>
        <!-- /.navbar -->
        <div class="content-wrapper">
            <!-- SIDEBAR -->
            <aside class="site-sidebar scrollbar-enabled" data-suppress-scroll-x="true">
                <!-- User Details -->
                <div class="side-user d-none">
                    <div class="col-sm-12 text-center p-0 clearfix">
                        <div class="d-inline-block pos-relative mr-b-10">
                            <figure class="thumb-sm mr-b-0 user--online">
                                <img src="assets/demo/users/user1.jpg" class="rounded-circle" alt="">
                            </figure><a href="#" class="text-muted side-user-link"><i class="feather feather-settings list-icon"></i></a>
                        </div>
                        <!-- /.d-inline-block -->
                        <div class="lh-14 mr-t-5"><a href="#" class="hide-menu mt-3 mb-0 side-user-heading fw-500">Emeka
                                Daniels</a>
                            <br><small class="hide-menu">Super Admin</small>
                        </div>
                    </div>
                    <!-- /.col-sm-12 -->
                </div>
                <!-- /.side-user -->
                <!-- Call to Action -->

                <!-- Sidebar Menu -->
                    <?php $this->load->view('includes/admin_side_menu'); ?>
                <!-- /.sidebar-nav -->
            </aside>
            <!-- /.site-sidebar -->
            <main class="main-wrapper clearfix">
                <!-- Page Title Area -->
                <div class="row page-title clearfix">
                    <div class="page-title-left">
                        <h6 class="page-title-heading mr-0 mr-r-5">Admin Manager</h6>
                        <!-- <p class="page-title-description mr-0 d-none d-md-inline-block">Information about Admin details</p> -->
                    </div>
                    <!-- /.page-title-left -->
                    <div class="page-title-right d-none d-sm-inline-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Admin Manager</li>
                        </ol>
                    </div>
                    <!-- /.page-title-right -->
                </div>
                <!-- /.page-title -->
                <!-- =================================== -->
                <!-- Different data widgets ============ -->
                <!-- =================================== -->
<div class="widget-list row">

                    <!-- /.widget-holder -->
    <div class="widget-holder widget-sm col-md-12 widget-full-height">
    <div class="widget-bg">

        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                                        <div class="widget-heading clearfix">
                                            <h5>View User Details</h5>
                                        </div>
                                        <!-- /.widget-heading -->
                    <div class="widget-body clearfix">
                                               
                        <!-- <form id="edit_buyerform" action="<?php echo base_url('admin/update_buyer/'.$user_details->carstock_id); ?>"  method="POST" enctype="multipart/form-data"> -->

                                       <div class="row" style="border:1px solid #f1f1f1; border-radius:5px;">
                                          <div class="col-xs-12 col-md-12 col-lg-12">
                                             <div id="result"></div> 
                                            <div class="col-lg-12 text-center">
                                              <h3><span style="font-size:15px; font-weight:bold;"><u>User/Company Details</u></span></h3>
                                            </div>                                           
                                          
                                              <div class="col-lg-12 col-md-12">             
                                                <div class="row">
                                                  <div class="form-group col-lg-6 col-md-6">
                                                    <span>Name: </span>
                                                    <?php echo $commercial_detail->first_name." ".$commercial_detail->last_name; ?> <br>
                                                    <span>Email:  </span>
                                                    <?php echo $commercial_detail->email; ?> <br>
                                                    <span>Phone: </span>
                                                    <?php echo $commercial_detail->phone; ?> <br>
                                                    <span>Country: </span>
                                                    <?php echo $commercial_detail->country; ?> <br>
                                                    <span>Refferal Code: </span>
                                                    <?php echo $commercial_detail->ref_code; ?> <br>
                                                   
                                                  </div>

                                                  <div class="form-group col-lg-6 col-md-6">
                                                    <span>Company Name: </span>
                                                    <?php echo $commercial_detail->com_name; ?> <br>
                                                    <span>company Email: </span>
                                                    <?php echo $commercial_detail->com_email; ?> <br>
                                                     <span>company Phone: </span>
                                                    <?php echo $commercial_detail->com_phone; ?> <br>
                                                     <span>company Address: </span>
                                                    <?php echo $commercial_detail->address1; ?> <br>
                                                    <span>City: </span>
                                                    <?php echo $commercial_detail->city; ?> <br>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>


                                        <div class="row" style="border:1px solid #f1f1f1; border-radius:5px;">
                                          <div class="col-xs-12 col-md-12 col-lg-12">
                                             <div id="result"></div> 
                                            <div class="col-lg-12 text-center">
                                              <h3><span style="font-size:15px; font-weight:bold; text-transform:uppercase;"><u>Car Details</u></span></h3>
                                            </div>                                           
                                          
                                              <div class="col-lg-12 col-md-12">             
                                                <div class="row">
                                                  <div class="form-group col-lg-6 col-md-6">
                                                    <span>Car Type: </span>
                                                    <?php echo $commercial_detail->car_type; ?> <br>
                                                    <span>Car VIN:  </span>
                                                    <?php echo $commercial_detail->vin_number; ?> <br>
                                                    <span>Car Status: </span>
                                                    <?php echo $commercial_detail->car_status; ?> <br>
                                                    <span>Car Year/Model: </span>
                                                    <?php echo $commercial_detail->car_year." ".$commercial_detail->car_model; ?> 
                                                  </div>

                                                   <div class="form-group col-lg-6 col-md-6">                                                    
                                                    <span>Car Make/Trim: </span>
                                                    <?php echo $commercial_detail->car_make." ".$commercial_detail->car_trim; ?> <br>
                                                    <span>Truck Type: </span>
                                                    <?php echo $commercial_detail->truck_type; ?> <br>
                                                    <span>Mileage Range: </span>
                                                    <?php echo $commercial_detail->mileage_range; ?> <br>
                                                    <span>Actual Mileage: </span>
                                                    <?php echo $commercial_detail->actual_mileage; ?>
                                                  </div>
                                                </div>
                                              </div>
                                              </div>
                                        </div>
              
                                        <div class="row" style="border:1px solid #f1f1f1; border-radius:5px;">
                                          <div class="col-xs-12 col-md-12 col-lg-12">
                                             <div id="result"></div> 
                                            <div class="col-lg-12 text-center">
                                              <h3><span style="font-size:15px; font-weight:bold; text-transform:uppercase;"><u>Car Image</u></span></h3>
                                            </div>
                        
                                            <div class="col-lg-12 col-md-12 col-md-offset-4">             
                                                <div class="row">
                                                    <img class="img-responsive" style="width: 300px; height: 150px;" src="<?php echo $commercial_detail->img_url;?>" >
                                                </div>
                                            </div>
                                          </div>

                                        </div>
                

                           

                        <!-- </form>    -->

                    </div>
                                        <!-- /.widget-body -->
                </div>
                                    <!-- /.widget-bg -->
            </div>

                                <!-- /.widget-holder -->
        </div>
                            <!-- /.counter-w-info -->
                            <!-- /.widget-body -->
    </div>
                        <!-- /.widget-bg -->
    </div>
                    <!-- /.widget-holder -->


</div>

                <!-- /.widget-list -->

                <!-- /.widget-list -->
            </main>
            <!-- /.main-wrappper -->
            <!-- RIGHT SIDEBAR -->

            <!-- CHAT PANEL -->

            <!-- /.chat-panel -->
        </div>
        <!-- /.content-wrapper -->
        <!-- FOOTER -->
        <footer class="footer"><span class="heading-font-family">Copyright @ 2018. All rights reserved. Autolane360
                Admin</span>
        </footer>
    </div>
    <!--/ #wrapper -->
    <!-- Scripts -->
         <?php $this->load->view('includes/admin_js'); ?>

<script type="text/javascript">

//available from and to  date 
$("#shipping_date").datetimepicker({      
  format:'M-d-Y',      
  timepicker:false, 
});

$("#arrival_date").datetimepicker({      
  format:'M-d-Y',      
  timepicker:false, 
}); 
    
//update car status 

var base_url = '<?php echo base_url() ?>'; //form submited


    $(document).on("submit", "#edit_buyerform", function(e){

        e.preventDefault();

            var url = $(this).attr('action');
            var formdata = new FormData(this);
          
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
                   
                    
                    success: function(response)
                    {
                       if(response.status == 'success')
                        {
                       
                            $("#result").html('<div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>success!</strong> Your details updated... </div>');
                            window.location.href = "<?php echo base_url('admin/buyer_page'); ?>";
                        }
                       
                        else 
                        {                       
                          $("#result").html('<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Sorry!</strong> Something went wrong Try again. </div>');
                        }          
                    }

           });
      

 });




</script>
</body>



</html>