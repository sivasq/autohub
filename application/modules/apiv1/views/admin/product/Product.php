<?php $this->load->view('includes/headers/admin-header'); ?>
	<script src="<?php echo base_url(); ?>assets/constants/product.constants.js"></script>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-8">
							<div class="card-box">
								<h4 class="header-title m-t-0 m-b-30">Add Product</h4>

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
										<label for="prdName" class="col-sm-4 control-label">Product
											Name*</label>
										<div class="col-sm-7">
											<input type="text" required="" class="form-control"
											       id="prdName" name="prdName"
											       placeholder="Product Name">
										</div>
									</div>

									<div class="form-group">
										<label for="prdDescription" class="col-sm-4 control-label">Product
											Description</label>
										<div class="col-sm-7">
											<input type="text" required="" class="form-control"
											       id="prdDescription" name="prdDescription"
											       placeholder="Product Description">
										</div>
									</div>

									<div class="form-group">
										<label for="productType" class="col-sm-4 control-label">Type
										</label>
										<div class="col-sm-7">
											<select class="form-control" name="productType"
											        id="productType" onchange="getProductUpdate()">
												<option>Select Type</option>
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
											        id="productCategory">
												<option>Select Category</option>
												<?php
												if (isset($categoryData)) {
													echo $categoryData;
												}
												?>
											</select>
										</div>
									</div>

									<div class="form-group" hidden id="subItems">
										<label for="sub_items" class="col-sm-4 control-label">Sub Items*</label>
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
<?php $this->load->view('includes/footers/admin-footer'); ?>