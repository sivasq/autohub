
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
                                <img src="<?php echo base_url('assets/admin-assets/demo/users/user1.jpg');?>" class="rounded-circle" alt="">
                            </figure><a href="#" class="text-muted side-user-link"><i class="feather feather-settings list-icon"></i></a>
                        </div>
                        <div class="lh-14 mr-t-5"><a href="#" class="hide-menu mt-3 mb-0 side-user-heading fw-500">Emeka
                                Daniels</a>
                            <br><small class="hide-menu">Super Admin</small>
                        </div>
                    </div>

                </div>
                     <?php $this->load->view('includes/admin_side_menu'); ?>
                <!-- /.sidebar-nav -->
            </aside>
            <!-- /.site-sidebar -->
            <main class="main-wrapper clearfix">
                <!-- Page Title Area -->
                <div class="row page-title clearfix">
                    <div class="page-title-left">
                        <h6 class="page-title-heading mr-0 mr-r-5">Dashboard</h6>
                        <p class="page-title-description mr-0 d-none d-md-inline-block">statistics, charts and Updates</p>
                    </div>
                    <!-- /.page-title-left -->
                    <div class="page-title-right d-none d-sm-inline-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>
                    <!-- /.page-title-right -->
                </div>
                <!-- /.page-title -->
                <!-- =================================== -->
                <!-- Different data widgets ============ -->
                <!-- =================================== -->
                <div class="widget-list row">
                    <div class="widget-holder widget-sm col-md-3 widget-full-height">
                        <div class="widget-bg" style="background-color:#f7e3d6;">
                            <div class="widget-body" style="background-color:#f7e3d6;">
                                <div class="counter-w-info media">
                                    <div class="media-body">
                                        <p class="mr-b-5 font-weight-bold">MESSAGES</p><span class="counter-title color-primary"><span
                                                class="counter" style="color:#333;">122 </span></span>
                                        <div class="mt-3"><span style="padding-right:15px;"><a href="#" class="font-weight-normal"
                                                    style="color:#333; font-size:18px;"><i class="list-icon feather feather-inbox"
                                                        style="line-height:0; height:0; width:25px; color:#3b3c3d;"></i> 17 Read</a></span>
                                            <span><a href="#" class="font-weight-normal" style="color:#333; font-size:18px;"><i
                                                        class="list-icon feather feather-mail" style="line-height:0; height:0; width:25px; color: #3b3c3d"></i>
                                                    117 Unread</a></span></div>
                                    </div>
                                    <!-- /.media-body -->
                                    <div class="pull-right align-self-center"><i class="list-icon feather feather-mail bg-primary"></i>
                                    </div>
                                </div>
                                <!-- /.counter-w-info -->
                            </div>
                            <!-- /.widget-body -->
                        </div>
                        <!-- /.widget-bg -->
                    </div>
                    <!-- /.widget-holder -->
                    <div class="widget-holder widget-sm col-md-9 widget-full-height">
                        <div class="widget-bg" style="background-color:#f7e3d6;">
                            <div class="widget-body" style="background-color:#f7e3d6;">
                                <div class="counter-w-info media">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md mr-3">
                                                <p class="mr-b-5 font-weight-bold">TOTAL VISITS</p><span class="counter-title color-info"><span
                                                        class="counter" style="color:#333;">6000</span><br> <span><a
                                                            href="#" class="font-weight-bold" style="color:#f60; font-size:13px;">Click
                                                            to View</a></span></span>
                                            </div>

                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                        <p class="mr-b-5">Nigeria</p>
                                                        <div class="mt-0 pt-0"><img src="<?php echo base_url('assets/admin-assets/img/flags/nigeria-flag.jpg');?>">
                                                            <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                            <span style="font-size:20px; color:#333;">3000</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                        <p class="mr-b-5">Ghana</p>
                                                        <div><img src="<?php echo base_url('assets/admin-assets/img/flags/ghana-flag.jpg');?>">
                                                            <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                            <span style="font-size:20px; color:#333;">3000</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                        <p class="mr-b-5">USA</p>
                                                        <div><img src="<?php echo base_url('assets/admin-assets/img/flags/usa-flag.jpg');?>">
                                                            <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                            <span style="font-size:20px; color:#333;">3000</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                        <p class="mr-b-5">Others</p>
                                                        <div><img src="<?php echo base_url('assets/admin-assets/img/flags/others.png');?>">
                                                            <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                            <span style="font-size:20px; color:#333;">3000</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- /.media-body -->

                                </div>
                                <!-- /.counter-w-info -->
                            </div>
                            <!-- /.widget-body -->
                        </div>
                        <!-- /.widget-bg -->
                    </div>
                    <!-- /.widget-holder -->

                    <!-- /.widget-holder -->

                    <!-- /.widget-holder -->

                    <!-- /.widget-holder -->
                </div>
                <div class="widget-list row">
                        <div class="widget-holder widget-sm col-md-3 widget-full-height">
                            <div class="widget-bg" style="background-color:#fff;">
                                <div class="widget-body" style="background-color:#fff;">
                                    <div class="counter-w-info media">
                                        <div class="media-body">
                                            <p class="mr-b-5 font-weight-bold">INTERESTED BUYERS</p><span class="counter-title color-primary"><span
                                                    class="counter" style="color:#333;">50 </span></span>
                                            <div class="mt-3"><span><a
                                                href="#" class="font-weight-bold" style="color:#f60; font-size:13px;">Click
                                                to View</a></span></div>
                                        </div>
                                        <!-- /.media-body -->
                                        <div class="pull-right align-self-center"><i class="list-icon feather feather-feather bg-info"></i>
                                        </div>
                                    </div>
                                    <!-- /.counter-w-info -->
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
                        <div class="widget-holder widget-sm col-md-9 widget-full-height">
                            <div class="widget-bg" style="background-color:#fff;">
                                <div class="widget-body" style="background-color:#fff;">
                                    <div class="counter-w-info media">
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-md mr-3">
                                                    <p class="mr-b-5 font-weight-bold">TOTAL VISITS</p><span class="counter-title color-info"><span
                                                            class="counter" style="color:#333;">200</span><br> </span>
                                                </div>
    
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                            <p class="mr-b-5">Nigeria</p>
                                                            <div class="mt-0 pt-0"><img src="<?php echo base_url('assets/admin-assets/img/flags/nigeria-flag.jpg');?>">
                                                                <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                                <span style="font-size:20px; color:#333;">20</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                            <p class="mr-b-5">Ghana</p>
                                                            <div><img src="<?php echo base_url('assets/admin-assets/img/flags/ghana-flag.jpg');?>">
                                                                <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                                <span style="font-size:20px; color:#333;">10</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                            <p class="mr-b-5">USA</p>
                                                            <div><img src="<?php echo base_url('assets/admin-assets/img/flags/usa-flag.jpg');?>">
                                                                <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                                <span style="font-size:20px; color:#333;">150</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                            <p class="mr-b-5">Others</p>
                                                            <div><img src="<?php echo base_url('assets/admin-assets/img/flags/others.png');?>">
                                                                <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                                <span style="font-size:20px; color:#333;">20</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
    
    
                                            </div>
                                        </div>
                                        <!-- /.media-body -->
    
                                    </div>
                                    <!-- /.counter-w-info -->
                                </div>
                                <!-- /.widget-body -->
                            </div>
                            <!-- /.widget-bg -->
                        </div>
                        <!-- /.widget-holder -->
    
                        <!-- /.widget-holder -->
    
                        <!-- /.widget-holder -->
    
                        <!-- /.widget-holder -->
                    </div>
                    <div class="widget-list row">
                            <div class="widget-holder widget-sm col-md-3 widget-full-height">
                                <div class="widget-bg" style="background-color:#ffe5ef;">
                                    <div class="widget-body" style="background-color:#ffe5ef;">
                                        <div class="counter-w-info media">
                                            <div class="media-body">
                                                <p class="mr-b-5 font-weight-bold">OUR AGENTS</p><span class="counter-title color-primary"><span
                                                        class="counter" style="color:#333;">19 </span></span>
                                                <div class="mt-3"><span><a
                                                    href="#" class="font-weight-bold" style="color:#f60; font-size:13px;">Click
                                                    to View</a></span></div>
                                            </div>
                                            <!-- /.media-body -->
                                            <div class="pull-right align-self-center"><i class="list-icon feather feather-user bg-pink"></i>
                                            </div>
                                        </div>
                                        <!-- /.counter-w-info -->
                                    </div>
                                    <!-- /.widget-body -->
                                </div>
                                <!-- /.widget-bg -->
                            </div>
                            <!-- /.widget-holder -->
                            <div class="widget-holder widget-sm col-md-9 widget-full-height">
                                <div class="widget-bg" style="background-color:#ffe5ef;">
                                    <div class="widget-body" style="background-color:#ffe5ef;">
                                        <div class="counter-w-info media">
                                            <div class="media-body">
                                                <div class="row">
                                                    <div class="col-md mr-3">
                                                        <p class="mr-b-5 font-weight-bold">TOTAL VISITS</p><span class="counter-title color-info"><span
                                                                class="counter" style="color:#333;">19</span><br></span>
                                                    </div>
        
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                                <p class="mr-b-5">Nigeria</p>
                                                                <div class="mt-0 pt-0"><img src="<?php echo base_url('assets/admin-assets/img/flags/nigeria-flag.jpg');?>">
                                                                    <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                                    <span style="font-size:20px; color:#333;">10</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                                <p class="mr-b-5">Ghana</p>
                                                                <div><img src="<?php echo base_url('assets/admin-assets/img/flags/ghana-flag.jpg');?>">
                                                                    <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                                    <span style="font-size:20px; color:#333;">1</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                                <p class="mr-b-5">USA</p>
                                                                <div><img src="<?php echo base_url('assets/admin-assets/img/flags/usa-flag.jpg');?>">
                                                                    <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                                    <span style="font-size:20px; color:#333;">3</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md mr-3 px-3 pt-1 pb-4 brdr" style="background-color:#fff;">
                                                                <p class="mr-b-5">Others</p>
                                                                <div><img src="<?php echo base_url('assets/admin-assets/img/flags/others.png');?>">
                                                                    <i class="list-icon feather feather-eye" style="line-height:0; height:0;"></i>
                                                                    <span style="font-size:20px; color:#333;">4</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
        
        
                                                </div>
                                            </div>
                                            <!-- /.media-body -->
        
                                        </div>
                                        <!-- /.counter-w-info -->
                                    </div>
                                    <!-- /.widget-body -->
                                </div>
                                <!-- /.widget-bg -->
                            </div>
                            <!-- /.widget-holder -->
        
                            <!-- /.widget-holder -->
        
                            <!-- /.widget-holder -->
        
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
</body>

</html>