
<?php $this->load->view('includes/admin_css'); ?>


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
                        <p class="page-title-description mr-0 d-none d-md-inline-block">Information about User details</p>
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
                                            <h5>View User Members</h5>
                                        </div>
                                        <!-- /.widget-heading -->
                                        <div class="widget-body clearfix">
                                                <div class="tabs">
                                                        <ul class="nav nav-tabs">
                                                           <!--  <li class="nav-item">
                                                                <a class="nav-link active" href="#USA" data-toggle="tab" aria-expanded="true">USA</a>
                                                            </li> -->
                                                            <li class="nav-item">
                                                                <a class="nav-link active" href="#Nigeria" data-toggle="tab" aria-expanded="true">Nigeria</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#Ghana" data-toggle="tab" aria-expanded="true">Ghana</a>
                                                            </li>
                                                           <!--  <li class="nav-item">
                                                                <a class="nav-link" href="#uk" data-toggle="tab" aria-expanded="true">UK</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#Canada" data-toggle="tab" aria-expanded="true">Canada</a>
                                                            </li> -->
                                                           
                                                        </ul>
                                                        <!-- /.nav-tabs -->
                                                        <div class="tab-content">
                                                           

                                                        <!-- viwe stock from nigeria -->
                                                            <div class="tab-pane active" id="Nigeria">
                                                                    <table class="table usa_table table-responsive">
                                                                            <thead>
                                                                               <tr>
                                                                                    <th style="display: none;"></th>
                                                                                    <th data-editable>Car Image</th>
                                                                                    <th data-editable>Car Model</th>
                                                                                    <th data-editable>Order Status</th>
                                                                                    <th data-editable>Update</th>
                                                                                </tr>
                                                                            </thead>
                                                            <tbody>
                                                <?php 
                                                    foreach ($buyer_lists as  $buyer_list) {
                                                       
                                                ?>    
                                                    <tr>
                                                        <td style="display: none;"> <?php echo $user_details->user_id;?></td>                                                      
                                                        <td><img class="img-responsive" style="width: 50px; height: 50px;" src="<?php echo $buyer_list->img_url;?>" ></td>
                                                        <td><?php echo $buyer_list->car_year."".$buyer_list->car_make."".$buyer_list->car_model."".$buyer_list->car_trim."".$buyer_list->mileage_range; ?> </td>
                                                        <td><?php echo $buyer_list->phone;?></td>
                                                        <td><?php echo $buyer_list->email;?></td>
                                                        <td>
                                                          <a href="<?php echo base_url('admin/user_status_update/'.$user_details->user_id);?>">  
                                                            <input type="button" class="btn btn-info"  value="View"> 
                                                          </a>
                                                        </td>  
                                                        <td></td>                                                     
                                                    </tr>

                                                <?php }  ?>           
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                            <!-- viwe stock from ghana -->

                                                            <div class="tab-pane" id="Ghana">
                                                                    <table class="table usa_table table-responsive">
                                                                            <thead>
                                                                                <tr>
                                                                                   <th style="display: none;"></th>
                                                                                    <th data-editable>First Name</th>
                                                                                    <th data-editable>Last Name</th>
                                                                                    <th data-editable>Phone</th>
                                                                                    <th data-editable>Email</th>
                                                                                    <th data-editable>Password</th>
                                                                                    <th data-editable>Ref Code</th>
                                                                                    <th>Status</th>
                                                                                </tr>
                                                                            </thead>
                                                                <tbody>
                                                <?php 
                                                    foreach ($user as  $user_details) {
                                                     if($user_details->country == 'Ghana')
                                                        {    
                                                ?>    
                                                    <tr>
                                                        <td style="display: none;"> <?php echo $user_details->user_id;?></td>
                                                        <td><?php echo $user_details->first_name; ?> </td>
                                                        <td><?php echo $user_details->last_name; ?> </td>
                                                        <td><?php echo $user_details->phone;?></td>
                                                        <td><?php echo $user_details->email;?></td>
                                                        <td><?php echo $user_details->password;?></td>
                                                        <td><?php echo $user_details->ref_code;?></td>
                                                       
                                                        <td>
                                                           <a href="<?php echo base_url('admin/user_status_update/'.$user_details->user_id);?>">  
                                                            <input type="button" class="btn btn-info"  value="View"> 
                                                          </a>
                                                        </td>
                                                       
                                                    </tr>
                                                <?php } } ?>
                                                                            
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                     
                                                        </div>
                                                        <!-- /.tab-content -->
                                                    </div>
                                           
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

var base_url = '<?php echo base_url() ?>'; //form submited

$('.usa_table').Tabledit({
  url: base_url+'admin/update_user_details/',
  columns: {
    identifier: [0, 'id'],                    
    editable: [[1, 'fname'],[2, 'lname'], [3, 'phone'], [4, 'email'], [5, 'password'],[6, 'ref_code']]
  },
  onSuccess: function(data, textStatus, jqXHR) {
        window.setTimeout(function(){location.reload()})

    },
});

</script>

</body>



</html>