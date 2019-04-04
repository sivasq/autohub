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
                <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
            </div>
            <div class="p-20">
                <form class="form-horizontal m-t-20" id="login_form" action="<?php echo base_url('index.php/admin/auth/login'); ?>" method="POST" enctype="multipart/form-data">

                    <div id="result"></div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <span style="font-weight: bold;">Email</span>
                        </div>
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="email" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <span style="font-weight: bold;">Password</span>
                        </div>
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">LogIn
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12">
                            <a href="<?php echo base_url('index.php/admin/auth/fp'); ?>" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- end card-box-->
    </div>
    <!-- end wrapper page -->

    <!-- Scripts -->
    <?php $this->load->view('includes/admin_js'); ?>

    <script>
        var base_url = '<?php echo base_url() ?>'; //form submited

        $(document).on("submit", "#login_form", function(e) {
            console.log("welcome");
            e.preventDefault();

            $(this).validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: "required",
                },
                messages: {
                    email: {
                        required: "Please Enter a Valid Email Address",
                    },
                    password: {
                        required: "Password Required",
                    },
                },
            });

            if ($(this).valid()) {
                var url = $(this).attr('action');
                var formdata = new FormData(this);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    },
                    success: function(response) {
                        if (response.status) {
                            window.location.href = "<?php echo base_url('index.php/admin/dashboard'); ?>";
                        } else {
                            $("#result").html('<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Try again!</strong> Invalid Login Credentials. </div>');
                        }
                    }
                });
            }
        });
    </script>
</body>

</html> 