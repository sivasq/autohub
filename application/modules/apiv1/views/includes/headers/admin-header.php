<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AutoHubb-Admin">
    <meta name="author" content="">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

    <!-- App title -->
    <title>::AutoHubb-Admin::</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">

    <!-- form Uploads -->
    <link href="<?php echo base_url(); ?>assets/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" />

    <!-- Editatable  Css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/magnific-popup/dist/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jquery-datatables-editable/datatables.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/rowGroup.dataTables.min.css" />
    <!-- Sweet Alert css -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" />

    <!-- App CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/select2/dist/css/select2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/select2/dist/css/select2-bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/pages.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/menu.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" />

    <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/constants/constants.js"></script>
</head>

<body class="fixed-left">
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="<?php echo base_url(); ?>index.php/admin/index" class="logo"><span>AutoHubb-Admin</span></a>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">

                    <!-- Page title -->
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <button class="button-menu-mobile open-left">
                                <i class="zmdi zmdi-menu"></i>
                            </button>
                        </li>
                        <li>
                            <h4 class="page-title"><?php echo exists($page_name); ?></h4>
                        </li>
                    </ul>

                    <!-- Right(Notification and Searchbox -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <!-- Notification -->
                            <div class="notification-box">
                                <ul class="list-inline m-b-0">
                                    <li>
                                        <a href="javascript:void(0);" class="right-bar-toggle">
                                            <i class="zmdi zmdi-notifications-none"></i>
                                        </a>
                                        <div class="noti-dot">
                                            <span class="dot"></span>
                                            <span class="pulse"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Notification bar -->
                        </li>
                        <li class="hidden-xs">
                            <form role="search" class="app-search">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                    </ul>

                </div><!-- end container -->
            </div><!-- end navbar -->
        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!-- User -->
                <div class="user-box">
                    <div class="user-img">
                        <img src="<?php echo base_url(); ?>assets/images/users/avatar-1.jpg" alt="user-img" title="Admin" class="img-circle img-thumbnail img-responsive">
                        <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                    </div>
                    <h5><a href="#"><?php echo $this->session->userdata('username'); ?></h5>
                    <ul class="list-inline">
                        <li>
                            <a href="#">
                                <i class="zmdi zmdi-settings"></i>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/user/logout" class="text-custom" id="logout">
                                <i class="zmdi zmdi-power"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End User -->

                <div id="sidebar-menu">
                    <ul>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-list"></i>
                                <span> Products </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo api_url("product/category"); ?>">Category</a></li>
                                <li><a href="<?php echo api_url("product/type"); ?>">Type</a></li>
                                <li><a href="<?php echo api_url("product/condition"); ?>">Condition</a></li>
                                <li><a href="<?php echo api_url("product/index"); ?>">Product</a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-list"></i>
                                <span> Payment </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="<?php echo api_url('payment/bank'); ?>">Banks</a>
                                </li>
                                <li>
                                    <a href="<?php echo api_url('payment/method'); ?>">Methods</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-list"></i>
                                <span> Vehicle </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="<?php echo api_url('vehicle/index'); ?>">Vehicle Information</a>
                                </li>
                                <li>
                                    <a href="<?php echo api_url('vehicle/type'); ?>">Vehicle Type</a>
                                </li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-list"></i>
                                <span> Shipping </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="<?php echo api_url('shipping-method'); ?>">Methods</a>
                                </li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-list"></i>
                                <span> Orders </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="<?php echo api_url('orders/index'); ?>">Orders</a>
                                </li>
                                <li>
                                    <a href="<?php echo api_url('admin/shipping/methods'); ?>">Methods</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="content-page">
            <div class="content">
                <div class="container"> 