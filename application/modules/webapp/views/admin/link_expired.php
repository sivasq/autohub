<?php $this->load->view('includes/admin_css'); ?>

<body>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="text-center">
            <a href="#" class="logo">
                <!-- <span>Admin<span>to</span></span> -->
                <!-- <h5 class="text-muted m-t-0 font-600">Responsive Admin Dashboard</h5> -->
                <img alt="" style="width:250px;" src="<?php echo base_url('assets/admin-assets/img/logo.png'); ?>">
            </a>
        </div>

	    <div class="m-t-40 card-box">
		    <div class="text-center">
			    <h4 class="text-uppercase font-bold m-b-0">Validation</h4>
		    </div>
		    <div class="panel-body text-center">
			    <img src="<?php echo base_url('assets/images/mail_confirm.png'); ?>" alt="img" class="thumb-lg m-t-20 center-block" />
			    <p class="text-muted font-13 m-t-20"> Hi, This Link Expired. </p>
		    </div>
	    </div>
        <!-- end card-box-->

	    <div class="row">
		    <div class="col-sm-12 text-center">
			    <p class="text-muted">Return to <a href="<?php echo base_url('index.php/admin/auth/fp'); ?>" class="text-primary m-l-5"><b>Reset Password</b></a></p>
		    </div>
	    </div>
    </div>
    <!-- end wrapper page -->

    <!-- Scripts -->
    <?php $this->load->view('includes/admin_js'); ?>
</body>

</html> 