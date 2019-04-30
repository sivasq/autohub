<?php $this->load->view('includes/headers/admin_header'); ?>
<script src="<?php echo base_url(); ?>assets/constants/product.constants.js"></script>
<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<div class="card-box">
							<h4 class="header-title m-t-0 m-b-30">Add <span class="dynamicText">Product</span></h4>

							<form id="myForm" class="form-horizontal"
							      action="<?php echo api_url("product/create"); ?>"
							      data-parsley-validate
							      novalidate method="post" onReset="updateForm(event);">
								<?php
								$error = validation_errors();
								if (!empty($error)) {
									?>
									<div class="alert alert-danger alert-dismissible">
										<a href="#" class="close" data-dismiss="alert"
										   aria-label="close">&times;</a>
										<strong>Warning!</strong> <?php echo $error ?>
									</div>
									<?php
								}
								?>
								<input type="hidden" id="prdId" name="prdId">

								<div class="form-group">
									<label for="productType" class="col-sm-4 control-label">Type
									</label>
									<div class="col-sm-7">
										<select class="form-control" name="productType"
										        id="productType" onchange="getProductUpdate()" required="">
											<option value="">Select Type</option>
											<?php
											if (isset($typeData)) {
												echo $typeData;
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group" id="productCategoryDiv">
									<label for="productCategory" class="col-sm-4 control-label">Category</label>
									<div class="col-sm-7">
										<select class="form-control" name="productCategory"
										        id="productCategory" required="">
											<option value="">Select Category</option>
											<?php
											if (isset($categoryData)) {
												echo $categoryData;
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="prdName" class="col-sm-4 control-label"><span class="dynamicText">Product</span>
										Name*</label>
									<div class="col-sm-7">
										<input type="text" required="" class="form-control"
										       id="prdName" name="prdName"
										       placeholder="Name">
									</div>
								</div>

								<div class="form-group">
									<label for="prdDescription" class="col-sm-4 control-label"><span
												class="dynamicText">Product</span>
										Description</label>
									<div class="col-sm-7">
										<input type="text" required="" class="form-control"
										       id="prdDescription" name="prdDescription"
										       placeholder="Description">
									</div>
								</div>

								<div class="form-group" hidden id="stockDiv">
									<label for="prdDescription" class="col-sm-4 control-label"><span
												class="dynamicText">Product</span>
										Current Stock</label>
									<div class="col-sm-7">
										<input type="text" required="" class="form-control"
										       id="prdCurrentStock" name="prdCurrentStock"
										       placeholder="Current Stock" value="0">
									</div>
								</div>

								<div class="form-group" hidden id="priceDiv">
									<label for="prdPrice" class="col-sm-4 control-label"><span class="dynamicText">Product</span>
										Price</label>
									<div class="col-sm-7">
										<input type="text" required="" class="form-control"
										       id="prdPrice" name="prdPrice"
										       placeholder="Product Price" value="0">
									</div>
								</div>

								<div class="form-group" hidden id="subItems">
									<label for="sub_items" class="col-sm-4 control-label">Package Items*</label>
									<div class="col-sm-7">
										<select multiple="multiple" class="multi-select" id="sub_items"
										        name="sub_item[]" data-plugin="multiselect"
										        data-selectable-optgroup="true">
											<?php
											if (isset($subItems)) {
												echo $subItems;
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group" hidden id="productImage">
									<label for="sub_items" class="col-sm-4 control-label">Product Image</label>
									<div class="col-sm-7">
										<input type="hidden" id="prdImage" name="prdImage">
										<div id="upload_widget" style="line-height: normal; padding: auto;"
										     class="btn btn-primary cloudinary-button">Select Product Image
										</div>
										<div class="preview" id="preview">
											<ul class="cloudinary-thumbnails"></ul>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-8">
										<button type="submit"
										        class="btn btn-primary waves-effect waves-light"
										        name="create_update" id="save-button" value="Create">
											Save
										</button>

										<button type="reset"
										        class="btn btn-default waves-effect waves-light m-l-5">
											Cancel
										</button>

									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
			<!-- end: panel body -->
		</div> <!-- end panel -->
	</div> <!-- end col-->
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered nowrap"
					       cellspacing="0" width="100%" id="products_datatable">
						<thead>
						<tr>
							<th>Product ID</th>
							<th>Product Name</th>
							<th>Product Description</th>
							<th>Product Type</th>
							<th>Product Category</th>
							<th>Product Image</th>
							<th>Created On</th>
							<th>Actions</th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<!-- end: panel body -->
	</div> <!-- end panel -->
</div> <!-- end col-->
</div>

<div id="dialog" class="modal-block mfp-hide">
	<section class="panel panel-info panel-color">
		<header class="panel-heading">
			<h2 class="panel-title">Are you sure?</h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-text">
					<p>Are you sure that you want to delete this row?</p>
				</div>
			</div>

			<div class="row m-t-20">
				<div class="col-md-12 text-right">
					<button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
					<button id="dialogCancel" class="btn btn-default waves-effect">Cancel</button>
				</div>
			</div>
		</div>

	</section>
</div>
<!-- end row -->

<div>
	<!--	<form class="my-form">-->
	<!--		<div class="form_line">-->
	<!--			<h4>Upload files</h4>-->
	<!--			<div class="form_controls">-->
	<!--				<div class="upload_button_holder">-->
	<!--					<input type="file" name="file" class="cloudinary_fileupload" data-cloudinary-field="image_id"-->
	<!--					       multiple>-->
	<!--					<input type="hidden" id="product_image" name="image">-->
	<!--				</div>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</form>-->

	<!--	<div class="progress">-->
	<!--		<div class="progress-bar" role="progressbar" style="background: #0e5e01; height: 10px;" aria-valuenow="0"-->
	<!--		     aria-valuemin="0" aria-valuemax="100">-->
	<!--		</div>-->
	<!--	</div>-->

	<!--	<div class="preview">-->
	<!--		<ul class="cloudinary-thumbnails"></ul>-->
	<!--	</div>-->
</div>

<?php $this->load->view('includes/footers/admin_footer'); ?>

<script>

	const cloudName = 'sqdevelop';
	const unsignedUploadPreset = 'Upload';

	$.cloudinary.config({cloud_name: cloudName, secure: true});

	function deleteImage(that) {
		$.cloudinary.delete_by_token($(that).data("token"));
		$(that).parent().remove();
	}

	// console.log($.cloudinary.url( "sample", { width: 100, crop: "fit"}));
	// console.log($.cloudinary.image("sample"));

	$('.cloudinary_fileupload')
		.unsigned_cloudinary_upload(unsignedUploadPreset,
			{
				autoUpload: true,
				cloud_name: cloudName,
				tags: 'browser_uploads',
			}
		)
		.bind('fileuploadprogress', function (e, data) {
			console.log(`fileuploadprogress data.loaded: ${data.loaded},data.total: ${data.total}`);
			// $('.progress-bar').css('width', Math.round((data.loaded * 100.0) / data.total) + '%');
			$('.progress-bar').css('width', 0);
			$('.progress').fadeIn();
			$(".progress-bar").animate({
				width: Math.round((data.loaded * 100.0) / data.total) + '%'
			}, function () {
				$(this).closest('.progress').fadeOut();
			});
		})
		.bind('cloudinaryprogress', function (e, data) {
			console.log(`cloudinaryprogress data.loaded: ${data.loaded},data.total: ${data.total}`);
		})
		.bind('cloudinarydone', function (e, data) {
			// inspect data.result for return value with link to the uploaded image and more
			console.log(`data.loaded: ${data.loaded},data.total: ${data.total}`)
			console.log('Upload result', data.result);
			// Create a thumbnail of the uploaded image, with 100px width
			var thumbImage = $.cloudinary.url(
				data.result.public_id, {
					format: data.result.format,
					version: data.result.version,
					secure: true,
					width: 90,
					height: 60,
					crop: 'limit',
				});
			$('.preview ul').html('<li class="cloudinary-thumbnail active ms-hover"> <img src="' + thumbImage + '">  <a href="javascript:void(0);" onclick="deleteImage(this)" class="cursor-pointer cloudinary-delete" data-token="' + data.result.delete_token + '">x</a></li>');

			$('#prdImage').val(data.result.url);
		});

	//================================================================

	var myWidget = cloudinary.createUploadWidget({
			cloudName: cloudName,
			uploadPreset: unsignedUploadPreset,
			sources: ['local', 'url'],
			// cropping: "server",
			showAdvanced_options: false,
			// form: '#demo',
			// fieldName: "image",
			thumbnails: '.widget-preview',
			max_image_width: 200,
		},
		(error, result) => {
			if (!error && result && result.event === "success") {
				console.log('Done! Here is the image info: ', result.info);
				var thumbImage = $.cloudinary.url(
					result.info.public_id, {
						format: result.info.format,
						version: result.info.version,
						secure: true,
						width: 90,
						height: 60,
						crop: 'limit',
					});
				$('.preview ul').html('<li class="cloudinary-thumbnail active ms-hover"> <img src="' + thumbImage + '"> <a href="javascript:void(0);" onclick="deleteImage(this)" class="cursor-pointer cloudinary-delete" data-token="' + result.info.delete_token + '">x</a></li>');

				$('#prdImage').val(result.info.url);
			}
			console.log(error);
			return true;
		}
	);

	document.getElementById("upload_widget").addEventListener("click", function () {
		myWidget.open();
	}, false);

</script>