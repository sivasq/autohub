<?php $this->load->view('includes/headers/admin_header'); ?>
	<script type="text/javascript">var vehicleID = <?php echo $itemData['id'] ?></script>
	<script src="<?php echo base_url(); ?>assets/constants/order-details.constants.js"></script>
	<div class="row">
		<div class="col-sm-12">
			<div class="card-box">
				<div class="row">
					<div class="<?php echo isset($itemData) && !empty($itemData['businessType']) && $itemData['businessType'] == "private" ? "col-lg-6" : "col-lg-4"; ?>">
						<h4 class="header-title m-t-0 m-b-30">Vehicle Information</h4>
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label class="col-md-4 control-label">Vehicle ID</label>
								<div class="col-md-8">
									<input type="text" id="vehicleId" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['id']) ? $itemData['id'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">User Name</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['userName']) ? $itemData['userName'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Vehicle Name </label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['vehicleInfo']) ? $itemData['vehicleInfo'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Vehicle Identification Number </label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['vin']) ? $itemData['vin'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Vehicle Type</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['vehicleType']) ? $itemData['vehicleType'] : '....'; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Business Type</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['businessType']) ? $itemData['businessType'] : '....'; ?>">
								</div>
							</div>
						</form>
					</div>

					<div class="<?php echo isset($itemData) && !empty($itemData['businessType']) && $itemData['businessType'] == "private" ? "col-lg-6" : "col-lg-4"; ?>">
						<h4 class="header-title m-t-0 m-b-30">Vehicle Detail Information</h4>
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label class="col-md-4 control-label">Year</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['year']) ? $itemData['year'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Make</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['make']) ? $itemData['make'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Model</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['model']) ? $itemData['model'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Mileage Range</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['mileageRange']) ? $itemData['mileageRange'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Actual Mileage</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($itemData) && !empty($itemData['actualMileage']) ? $itemData['actualMileage'] : '....'; ?>">
								</div>
							</div>

							<?php if (isset($itemData) && !empty($itemData['image'])): ?>
								<div class="form-group">
									<label class="col-md-4 control-label">Vehicle Images</label>
									<div class="col-md-8">
										<?php
										$images = explode(",", $itemData['image']);
										foreach ($images as $image): ?>
											<a target="_blank"
											   href="<?php echo $image; ?>">
												<img style="width: 45%;"
												     src="<?php echo $image; ?>">
											</a>
										<?php
										endforeach;
										?>
									</div>
								</div>
							<?php
							endif;
							?>
						</form>
					</div>

					<div class="col-lg-4" <?php echo isset($itemData) && !empty($itemData['businessType']) && $itemData['businessType'] == "private" ? "hidden" : '....'; ?>>
						<h4 class="header-title m-t-0 m-b-30">Company Information</h4>
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label class="col-md-4 control-label">Company Name</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($companyData) && !empty($companyData['companyName']) ? $companyData['companyName'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Address</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($companyData) && !empty($companyData['address']) ? $companyData['address'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">City</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($companyData) && !empty($companyData['city']) ? $companyData['city'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($companyData) && !empty($companyData['email']) ? $companyData['email'] : '....'; ?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Contact Number</label>
								<div class="col-md-8">
									<input type="text" class="form-control" readonly=""
									       value="<?php echo isset($companyData) && !empty($companyData['phone']) ? $companyData['phone'] : '....'; ?>">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row"<?php echo isset($itemData) && !empty($itemData['businessType']) && $itemData['businessType'] == "private" ? "hidden" : '....'; ?>>
		<div class="col-sm-12">
			<div class="panel">
				<div class="panel-body">
					<div class="editable-responsive">
						<table id="driverTable" class="table table-striped m-b-0">
							<thead>
							<tr>
								<th>Driver ID</th>
								<th>Driver Name</th>
								<th>Contact Number</th>
								<th>Email</th>
								<th>City</th>
								<th>State</th>
							</tr>
							</thead>
							<tbody>
							<?php
							if (isset($driverData)) {
								foreach ($driverData as $value) {
									?>
									<tr class="gradeU">
									<td><?php echo $value["id"] ?></td>
									<td><?php echo $value["driverName"] ?></td>
									<td><?php echo $value["phone"] ?></td>
									<td><?php echo $value["email"] ?></td>
									<td><?php echo $value["city"] ?></td>
									<td><?php echo $value["state"] ?></td>
									<?php
								}
								?>
								</tr>
								<?php
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- end: panel body -->

			</div> <!-- end panel -->
		</div> <!-- end col-->
	</div>
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
<?php $this->load->view('includes/footers/admin_footer'); ?>