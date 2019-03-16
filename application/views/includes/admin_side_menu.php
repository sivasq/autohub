<nav class="sidebar-nav">

    <ul class="nav in side-menu">

        <li class="<?php if ($page_name == 'index') {
            echo 'active';
        } ?>">
            <a href="<?php echo base_url('Admin/index'); ?>">
                <i class="list-icon feather feather-command"></i>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>

        <li>
            <a href="<?php echo api_url('admin/products'); ?>">
                <i class="list-icon feather feather-user"></i>
                <span class="hide-menu">Products</span>
            </a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">

                <li class="active">
                    <a href="<?php echo api_url('admin/products'); ?>">Product</a>
                </li>
                <li class="active">
                    <a href="<?php echo api_url('product/category'); ?>">Category</a>
                </li>
                <li class="active">
                    <a href="<?php echo api_url('product/condition'); ?>">Condition</a>
                </li>
                <li class="active">
                    <a href="<?php echo api_url('product/type'); ?>">Type</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?php echo base_url('admin/payment'); ?>">
                <i class="list-icon feather feather-user"></i>
                <span class="hide-menu">Payment</span>
            </a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">

                <li class="active">
                    <a href="<?php echo api_url('payment/bank'); ?>">Banks</a>
                </li>
                <li class="active">
                    <a href="<?php echo api_url('payment/methods'); ?>">Methods</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?php echo api_url('admin/vehicle'); ?>">
                <i class="list-icon feather feather-user"></i>
                <span class="hide-menu">Vehicle</span>
            </a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">

                <li class="active">
                    <a href="<?php echo api_url('vehicle/business-type'); ?>">Business Type</a>
                </li>
                <li class="active">
                    <a href="<?php echo api_url('vehicle/type'); ?>">Type</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?php echo api_url('admin/shipping'); ?>">
                <i class="list-icon feather feather-user"></i>
                <span class="hide-menu">Shipping</span>
            </a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">

                <li class="active">
                    <a href="<?php echo api_url('admin/shipping/methods'); ?>">Methods</a>
                </li>
            </ul>
        </li>

        <li class="<?php if ($page_name == 'view_all_user') {
            echo 'active';
        } ?>">
            <a href="<?php echo base_url('Admin/view_all_user'); ?>">
                <i class="list-icon feather feather-user"></i>
                <span class="hide-menu">Buyer List</span>
            </a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">

                <li class="<?php if ($page_name == 'add_agent_manager') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/add_agent_manager'); ?>">Nigeria</a>
                </li>
                <li class="<?php if ($page_name == 'view_agent_manager') {
                    echo 'active';
                } ?>"
                ">
                <a href="<?php echo base_url('Admin/view_agent_manager'); ?>">Ghana</a>
                </li>
            </ul>
        </li>

        <li class="<?php if ($page_name == 'add_agent_manager') {
            echo 'active';
        } else if ($page_name == 'view_agent_manager') {
            echo 'active';
        } ?>">
            <a href="#">
                <i class="list-icon feather feather-user"></i>
                <span class="hide-menu">View Orders</span>
            </a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">

                <li class="<?php if ($page_name == 'add_agent_manager') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/add_agent_manager'); ?>">Today</a>
                </li>
                <li class="<?php if ($page_name == 'view_agent_manager') {
                    echo 'active';
                } ?>"
                ">
                <a href="<?php echo base_url('Admin/view_agent_manager'); ?>">This Week</a>
                </li>
                <li class="<?php if ($page_name == 'view_agent_manager') {
                    echo 'active';
                } ?>"
                ">
                <a href="<?php echo base_url('Admin/view_agent_manager'); ?>">Completed</a>
                </li>
                <li class="<?php if ($page_name == 'view_agent_manager') {
                    echo 'active';
                } ?>"
                ">
                <a href="<?php echo base_url('Admin/view_agent_manager'); ?>">Pending</a>
                </li>
            </ul>
        </li>

        <li class="<?php if ($page_name == 'add_seller_manager') {
            echo 'active';
        } else if ($page_name == 'view_seller_manager') {
            echo 'active';
        } ?>">
            <a href="index.html"><i class="list-icon feather feather-user"></i>
                <span class="hide-menu">Add Stock</span></a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                <li class="<?php if ($page_name == 'add_seller_manager') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/add_seller_manager'); ?>">Shop(Add stock)</a>
                </li>
                <li class="<?php if ($page_name == 'view_seller_manager') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/view_seller_manager'); ?>">View Stock</a>
                </li>
            </ul>
        </li>

        <li class="<?php if ($page_name == 'add_stock_page') {
            echo 'active';
        } else if ($page_name == 'view_stock_page') {
            echo 'active';
        } else if ($page_name == 'View_Parts') {
            echo 'active';
        } ?>">
            <a href="#">
                <i class="list-icon feather feather-feather"></i>
                <span class="hide-menu">Notification</span>
            </a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                <li class="<?php if ($page_name == 'add_stock_page') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/add_stock_page'); ?>">Send Notification</a>
                </li>

            </ul>
        </li>

        <li class="<?php if ($page_name == 'about_us') {
            echo 'active';
        } else if ($page_name == 'News_Feeds') {
            echo 'active';
        } ?>">
            <a href="#">
                <i class="list-icon feather feather-folder"></i>
                <span class="hide-menu">Messages</span>
            </a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                <li class="<?php if ($page_name == 'about_us') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/about_us'); ?>">View Message</a>
                </li>
                <li class="<?php if ($page_name == 'News_Feeds') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/News_Feeds'); ?>">Replies</a>
                </li>
                <li class="<?php if ($page_name == 'News_Feeds') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/News_Feeds'); ?>">pending</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#">
                <i class="list-icon feather feather-layout"></i>Payments</a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                <li class="<?php if ($page_name == 'News_Feeds') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/News_Feeds'); ?>">View Payment</a>
                </li>
                <li class="<?php if ($page_name == 'News_Feeds') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/News_Feeds'); ?>">Send Invoice</a>
                </li>
            </ul>

        </li>

        <li class="<?php if ($page_name == 'buyer_page') {
            echo 'active';
        } ?>">
            <a href="<?php echo base_url('Admin/buyer_page'); ?>">
                <i class="list-icon feather feather-user-plus"></i>Diagnotics
            </a>
            <ul class="list-unstyled sub-menu collapse" aria-expanded="false">
                <li class="<?php if ($page_name == 'News_Feeds') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/News_Feeds'); ?>">Update Info</a>
                </li>
                <li class="<?php if ($page_name == 'News_Feeds') {
                    echo 'active';
                } ?>">
                    <a href="<?php echo base_url('Admin/News_Feeds'); ?>">View Listed Car</a>
                </li>
            </ul>
        </li>

    </ul>
    <!-- /.side-menu -->
</nav>