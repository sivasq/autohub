<!-- HEADER & TOP NAVIGATION -->
<nav class="navbar">
    <!-- Logo Area -->
    <div class="navbar-header">
        <a href="#" class="navbar-brand">
            <img class="logo-expand" alt="" src="<?php echo base_url('assets/admin-assets/img/autohub-logo.png'); ?>">
            <img class="logo-collapse" alt="" src="<?php echo base_url('assets/admin-assets/img/autohub-logo.png'); ?>">
            <!-- <p>BonVue</p> -->
        </a>
    </div>
    <!-- /.navbar-header -->
    <!-- Left Menu & Sidebar Toggle -->
    <ul class="nav navbar-nav">
        <li class="sidebar-toggle dropdown">
            <a href="javascript:void(0)" class="ripple">
                <i class="feather feather-menu list-icon fs-20"></i>
            </a>
        </li>
    </ul>
    <!-- /.navbar-left -->
    <!-- Search Form -->
    <form class="navbar-search d-none d-sm-block" role="search">
        <i class="feather feather-search list-icon"></i>
        <input type="search" class="search-query" placeholder="Search anything...">
        <a href="javascript:void(0);" class="remove-focus"><i class="feather feather-x"></i></a>
    </form>
    <!-- /.navbar-search -->
    <div class="spacer"></div>
    <!-- Right Menu -->

    <!-- /.navbar-right -->
    <!-- User Image with Dropdown -->
    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle dropdown-toggle-user ripple" data-toggle="dropdown">
                        <span class="avatar thumb-xs2">
                            <img src="<?php echo base_url('assets/admin-assets/demo/users/user1.jpg'); ?>"
                                 class="rounded-circle" alt="">
                            <i class="feather feather-chevron-down list-icon"></i>
                        </span>
            </a>
            <div class="dropdown-menu dropdown-left dropdown-card dropdown-card-profile animated flipInY">
                <div class="card">

                    <ul class="list-unstyled card-body" style="font-size:12px; min-width:300px;">
                        <li><a href="#">
                                    <span><span class="align-middle">
                                    <i class="feather feather-user"></i>
                                       <?php echo $this->session->userdata('first_name') . " " . $this->session->userdata('last_name'); ?>
                                    </span></span>
                            </a>
                        </li>

                        <li><a href="#">
                                    <span><span class="align-middle">
                                        <i class="feather feather-mail"></i>
                                            <?php echo $this->session->userdata('admin_email'); ?>
                                    </span></span></a>
                        </li>

                        <li>
                            <a href="#"><span>
                                        <span class="align-middle">
                                        <i class="feather feather-phone-call"></i>
                                            <?php echo $this->session->userdata('admin_phone'); ?>
                                        </span></span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('admin_login/logout'); ?>">
                                    <span><span class="align-middle">
                                        <i class="feather feather-power"></i> Sign Out
                                    </span></span></a>
                        </li>
                    </ul>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.dropdown-card-profile -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-nav -->
</nav>