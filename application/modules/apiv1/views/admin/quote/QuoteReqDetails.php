<?php $this->load->view('includes/headers/admin-header'); ?>
<script type="text/javascript">
    var orderId = <?php echo $itemData['id'] ?>;
    var shippingCost = ;
    <?php echo isset($itemData) && !empty($itemData['shippingCost']) ? $itemData['shippingCost'] : "0"; ?>
</script>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-4">
                    <h4 class="header-title m-t-0 m-b-30">Req Item Information</h4>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-5 control-label">Req Created At</label>
                            <div class="col-md-7">
                                <input type="text" id="orderId" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['createdAt']) ? $itemData['createdAt'] : '....'; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label">Requested By</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['userName']) ? $itemData['userName'] : '....'; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label">Qty Required</label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['quantity']) ? $itemData['quantity'] : '....'; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label">Current Millage</label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" id="shippingCost" readonly="" value="<?php echo isset($itemData) && !empty($itemData['currentMileage']) ? $itemData['currentMileage'] : '....'; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label">Business Type</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['businessType']) ? $itemData['businessType'] : '....'; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label">Company Name</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['companyName']) ? $itemData['companyName'] : '....'; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label">Driver Name</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['driverName']) ? $itemData['driverName'] : '....'; ?>">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <h4 class="header-title m-t-0 m-b-30">Product Information</h4>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-5 control-label">Product Name</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['productName']) ? $itemData['productName'] : '....'; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Product Type</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly value="<?php echo isset($itemData) && !empty($itemData['productType']) ? $itemData['productType'] : '....'; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Product Condition</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['productCondition']) ? $itemData['productCondition'] : '....'; ?>">
                            </div>
                        </div>

                        <div style="text-align:center">
                            <h4>Sample Images</h4>
                            <img src="<?php echo isset($itemData) && !empty($itemData['itemImages']) ? $itemData['itemImages'] : '....'; ?>" alt="">
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <h4 class="header-title m-t-0 m-b-30">Vehicle Information</h4>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-5 control-label">Vehicle Vin</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['vehicleVin']) ? $itemData['vehicleVin'] : '....'; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Vehicle Make</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['vehicleMake']) ? $itemData['vehicleMake'] : '....'; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Vehicle Model</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['vehicleModel']) ? $itemData['vehicleModel'] : '....'; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Vehicle Year</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['vehicleYear']) ? $itemData['vehicleYear'] : '....'; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Vehicle Trim</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['vehicleTrim']) ? $itemData['vehicleTrim'] : '....'; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Vehicle Actual Mileage</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['vehicleActualMileage']) ? $itemData['vehicleActualMileage'] : '....'; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label">Vehicle Type</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" readonly="" value="<?php echo isset($itemData) && !empty($itemData['vehicleType']) ? $itemData['vehicleType'] : '....'; ?>">
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- end row -->
<?php $this->load->view('includes/footers/admin-footer'); ?> 