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
                            <img src="<?php echo base_url('assets/admin-assets/demo/users/user1.jpg'); ?>"
                                 class="rounded-circle" alt="">
                        </figure>
                        <a href="#" class="text-muted side-user-link"><i class="feather feather-settings list-icon"></i></a>
                    </div>
                    <div class="lh-14 mr-t-5"><a href="#" class="hide-menu mt-3 mb-0 side-user-heading fw-500">Emeka
                            Daniels</a>
                        <br>
                        <small class="hide-menu">Super Admin</small>
                    </div>
                </div>

            </div>
            <?php $this->load->view('includes/admin_side_menu'); ?>
            <!-- /.sidebar-nav -->
        </aside>
