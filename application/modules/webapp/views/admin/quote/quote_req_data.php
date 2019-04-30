<?php $this->load->view('includes/headers/admin_header'); ?>
<script src="<?php echo base_url(); ?>assets/constants/quote-req.constants.js"></script>
<div class="row">
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%"
					       id="quotereq_datatable">
						<thead>
						<tr>
							<th>Req ID</th>
							<th>User</th>
							<th>Product Name</th>
							<th>Qty Req.</th>
							<th>Comment</th>
							<th>Created Date</th>
						</tr>
						</thead>
					</table>
				</div>
			</div> <!-- end: panel body -->
		</div> <!-- end panel -->
	</div> <!-- end col-->
</div> <!-- end row-->
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