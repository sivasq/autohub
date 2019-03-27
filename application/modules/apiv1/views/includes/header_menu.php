<!-- top-bar -->
<div class="top-bar">

    <div class="flex-row flex-justify flex-center">

        <div class="slash-list" style="font-size: 16px;">
            <span style="color:#fff;font-weight: bold;">PH: +1-832-716-3892 &nbsp;<span style="font-weight: bold;">Email: auto.sales@autolane360.com</span></span>
        </div>
        <div class="slash-list text-right">
            <span style="color:#fff;"></span>
        </div>

        <div class="contact-info-menu type-2">

            <div class="contact-info-item lang-button">

                <div class="flex-row flex-center">

                    <i class="licon-earth"></i>

                    <?php
                    if ($this->session->has_userdata('user_id')) {
                        ?>
                        <div class="item-inner">
                            <a href="#"><?php echo $this->session->userdata('user_fname') . " " . $this->session->userdata('user_lname'); ?></a>
                            <ul class="dropdown-list">
                                <li>
                                    <a href="<?php echo base_url('login/register'); ?>"><?php echo $this->session->userdata('user_fname') . " " . $this->session->userdata('user_lname'); ?></a>
                                </li>
                                <li><a href="<?php echo base_url('home/logout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <div class="item-inner">

                            <a href="#">Register</a>
                            <ul class="dropdown-list">
                                <li><a onclick="register()" href="<?php echo base_url('login/register'); ?>">MyLane</a>
                                </li>
                                <li><a onclick="login()" href="<?php echo base_url('login/login'); ?>">Login</a></li>
                            </ul>
                        </div>
                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- top-header -->

<div class="top-header flex-row flex-justify flex-center">

    <!-- logo -->

    <div class="logo-wrap">

        <a href="<?php echo base_url('home/index'); ?>" class="logo"><img
                    src="<?php echo base_url('assets/images/logo.png'); ?>" alt=""></a>

    </div>

    <!--main menu-->

    <div class="menu-holder">

        <div class="menu-wrap flex-row">

            <div class="nav-item">

                <!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->

                <nav id="main-navigation" class="main-navigation">
                    <ul id="menu" class="clearfix">
                        <li class="<?php if ($page_name == 'home') {
                            echo 'current';
                        } ?>"><a href="<?php echo base_url('home/index'); ?>">Home</a></li>
                        <li class="<?php if ($page_name == 'about_us') {
                            echo 'current';
                        } ?>"><a href="<?php echo base_url('home/about_us'); ?>">About Us</a></li>
                        <li class="<?php if ($page_name == 'how_it_works') {
                            echo 'current';
                        } ?>">
                            <a href="<?php echo base_url('home/how_it_works'); ?>">How It Works</a>
                        </li>
                        <li class="<?php if ($page_name == 'direct_buylane') {
                            echo 'current';
                        } ?>"><a href="<?php echo base_url('home/direct_buylane'); ?>">Direct Buy Lane</a></li>
                        <li class=""><a href="#">Car Parts</a></li>
                        <li class="<?php if ($page_name == 'agent_list') {
                            echo 'current';
                        } ?>"><a href="<?php echo base_url('home/agent_list'); ?>">Agent List</a></li>
                    </ul>
                </nav>

                <!-- - - - - - - - - - - - - end Navigation - - - - - - - - - - - - - - - -->

            </div>

            <a href="#" class="login-btn"></a>

        </div>

    </div>

</div>

