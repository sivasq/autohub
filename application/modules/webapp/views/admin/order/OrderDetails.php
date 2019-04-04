<?php $this->load->view('includes/headers/admin-header'); ?>
    <script type="text/javascript">
        var orderId = <?php echo $itemData['id'] ?> ;
        var shippingCost = <?php echo isset($itemData) && !empty($itemData['shippingCost']) ? $itemData['shippingCost'] : "0"; ?></script>
    <script src="<?php echo base_url(); ?>assets/constants/order-details.constants.js"></script>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="header-title m-t-0 m-b-30">Order Information</h4>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Order ID</label>
                                <div class="col-md-8">
                                    <input type="text" id="orderId" class="form-control" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['id']) ? $itemData['id'] : '....'; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Order By</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['userName']) ? $itemData['userName'] : '....'; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Status</label>
                                <div class="col-md-8 input-group m-t-8">
                                    <select class="form-control select2 col-md-4" id="orderStatus">
                                        <?php
                                        if (isset($statusData))
                                            foreach ($statusData as $value) {
                                                $data = array_values($value);
                                                ?>
                                                <option <?php echo($data[0] == $itemData['orderStatus'] ? "selected" : ''); ?>
                                                        value="<?php echo !empty($data[1]) ? $data[1] : ''; ?>">
                                                    <?php echo !empty($data[0]) ? $data[0] : ''; ?>
                                                </option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn waves-effect waves-light btn-primary"
                                                onclick="updateStatus()">Update</i></button></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Shipping Method</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['shippingMethod']) ? $itemData['shippingMethod'] : '....'; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Shipping Cost</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="shippingCost" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['shippingCost']) ? $itemData['shippingCost'] : '....'; ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <h4 class="header-title m-t-0 m-b-30">Shipping Information</h4>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['shippingUser']) ? $itemData['shippingUser'] : '....'; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Address</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" readonly
                                              rows="3"><?php echo isset($itemData) && !empty($itemData['shippingAddress']) ? $itemData['shippingAddress'] : '....'; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">City</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['city']) ? $itemData['city'] : '....'; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">State</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['state']) ? $itemData['state'] : '....'; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Country</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['country']) ? $itemData['country'] : '....'; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">PIN Code</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['postCode']) ? $itemData['postCode'] : '....'; ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <h4 class="header-title m-t-0 m-b-30">Contact Information</h4>
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly=""
                                           value="<?php echo isset($itemData) && !empty($itemData['email']) ? $itemData['email'] : '....'; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Contact</label>
                                <div class="col-md-8">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" readonly=""
                                               value="<?php echo isset($itemData) && !empty($itemData['phone']) ? $itemData['phone'] : '....'; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="editable-responsive">
                        <table id="mainTable" class="table table-striped m-b-0">
                            <thead>
                            <tr>
                                <th hidden></th>
                                <th>Product Type</th>
                                <th>Item Name</th>
                                <th>Product Category</th>
                                <th>Vehicle</th>
                                <th>Current Mileage</th>
                                <th>Item Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($itemData)) {
                                $orderItems = $itemData['orderItems'];
                                foreach ($orderItems as $value) {
                                    ?>
                                    <tr class="gradeU">
                                    <td hidden><?php echo $value["orderDetailsId"] ?></td>
                                    <td><?php echo $value["productType"] ?></td>
                                    <td><?php echo $value["itemName"] ?></td>
                                    <td><?php echo $value["productCategory"] ?></td>
                                    <td><?php echo $value["vehicleInfo"] ?></td>
                                    <td><?php echo $value["currentMileage"] ?></td>
                                    <td><?php echo $value["itemPrice"] ?></td>
                                    <?php
                                }
                                ?>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th hidden></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><strong>TOTAL</strong></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="row" <?php echo "payment made" == $itemData['orderStatus'] ? "hidden" : ''; ?>
                             id="updatePriceDiv">
                            <div class="col-sm-6">
                                <div class="m-b-30">
                                    <button id="updateTable" class="btn btn-primary waves-effect waves-light">Update <i
                                                class="fa fa-save"></i></button>
                                </div>
                            </div>
                        </div>
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
<?php $this->load->view('includes/footers/admin-footer'); ?>