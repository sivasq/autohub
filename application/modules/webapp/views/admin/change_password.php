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
			<h4 class="text-uppercase font-bold m-b-0">Change Password</h4>
<!--			<p class="text-muted m-b-0 font-13 m-t-20">Enter your email address and we'll send you an email with-->
<!--				instructions to reset your password. </p>-->
		</div>
		<div class="p-20">
			<?php
			if (false !== ctype_xdigit($selector) && false !== ctype_xdigit($validator)) :
				?>
				<form class="form-horizontal m-t-20" id="login_form"
				      action="<?php echo base_url('index.php/admin/auth/fp/reset_process'); ?>" method="POST"
				      enctype="multipart/form-data">

					<div id="result"></div>

					<input type="hidden" name="selector" value="<?php echo $selector; ?>">
					<input type="hidden" name="validator" value="<?php echo $validator; ?>">

					<div class="form-group">
						<div class="col-xs-12">
							<span style="font-weight: bold;">Password</span>
						</div>
						<div class="col-xs-12">
							<input class="form-control" type="text" id="password" name="password" placeholder="Password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12">
							<span style="font-weight: bold;">Confirm Password</span>
						</div>
						<div class="col-xs-12">
							<input class="form-control" type="text" name="confirm_password" placeholder="Confirm Password">
						</div>
					</div>

					<div class="form-group text-center m-t-30">
						<div class="col-xs-12">
							<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">
								Update Password
							</button>
						</div>
					</div>
				</form>
			<?php
			endif;
			?>

		</div>
	</div>
	<!-- end card-box-->

	<div class="row">
		<div class="col-sm-12 text-center">
			<p class="text-muted">Remembered Password?<a href="<?php echo base_url('index.php/admin/auth'); ?>"
			                                             class="text-primary m-l-5"><b>Sign In</b></a></p>
		</div>
	</div>
</div>
<!-- end wrapper page -->

<!-- Scripts -->
<?php $this->load->view('includes/admin_js'); ?>

<script>
	var base_url = '<?php echo base_url() ?>'; //form submited

	$(document).on("submit", "#login_form", function (e) {
		e.preventDefault();

		$(this).validate({
			rules: {
				password: {
					required: true,
					minlength : 5
				},
				confirm_password : {
					required: true,
					minlength : 5,
					equalTo : "#password"
				}
			},
			messages: {
				password: {
					required: "Please Enter a Password",
					minLength: "password contains min 5 chars"
				},
				confirm_password: {
					required: "Please Enter a Confirm Password",
					minLength: "password contains min 5 chars",
					equalTo: "Password does't match"
				}
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
				error: function (xhr, status, error) {
					alert(xhr.responseText);
				},
				success: function (response) {
					if (response.status) {
						window.location.href = "<?php echo base_url('index.php/admin/auth/'); ?>" ;
						console.log(response);
					} else {
						$("#result").html('<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> <strong>Try again!</strong> Unknown Error. </div>');
					}
				}
			});
		}
	});
</script>
</body>

</html> 