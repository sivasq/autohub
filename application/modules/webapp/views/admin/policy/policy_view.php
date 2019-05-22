<?php $this->load->view('includes/headers/admin_header'); ?>
<script src="<?php echo base_url(); ?>assets/constants/product-category.constants.js"></script>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Product Info</h4>

                            <form id="myForm" class="form-horizontal" action="<?php echo api_url("policy/policy-update"); ?>" data-parsley-validate novalidate method="post">
                                <input type="hidden" id="policyid" name="policyid" value="<?php echo $product_poliy->id; ?>">
                                <div class="form-group">
                                    <label for="details" class="col-sm-2 control-label">Product Info</label>
                                    <div class="col-sm-7">
                                        <textarea required="" class="form-control" id="details" name="details" placeholder="Product Info"> <?php echo $product_poliy->value; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="create_update" id="save-button" value="Update">
                                            Save / Update
                                        </button>

                                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Shipping Info</h4>

                            <form id="myForm" class="form-horizontal" action="<?php echo api_url("policy/policy-update"); ?>" data-parsley-validate novalidate method="post">
                                <input type="hidden" id="policyid" name="policyid" value="<?php echo $shipping_poliy->id; ?>">
                                <div class="form-group">
                                    <label for="details" class="col-sm-2 control-label">Shipping Info</label>
                                    <div class="col-sm-7">
                                        <textarea required="" class="form-control" id="details" name="details" placeholder="Product Info"> <?php echo $shipping_poliy->value; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="create_update" id="save-button" value="Update">
                                            Save / Update
                                        </button>

                                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Return Policy</h4>

                            <form id="myForm" class="form-horizontal" action="<?php echo api_url("policy/policy-update"); ?>" data-parsley-validate novalidate method="post">
                                <input type="hidden" id="policyid" name="policyid" value="<?php echo $return_poliy->id; ?>">
                                <div class="form-group">
                                    <label for="details" class="col-sm-2 control-label">Return Policy</label>
                                    <div class="col-sm-7">
                                        <textarea required="" class="form-control" id="details" name="details" placeholder="Product Info"> <?php echo $return_poliy->value; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="create_update" id="save-button" value="Update">
                                            Save / Update
                                        </button>

                                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
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

</div>
<!-- end row -->
<?php $this->load->view('includes/footers/admin_footer'); ?>