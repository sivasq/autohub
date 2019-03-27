<?php $this->load->view('includes/headers/admin-header'); ?>
    <script src="<?php echo base_url(); ?>assets/constants/payment-banks.constants.js"></script>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card-box">
                                <h4 class="header-title m-t-0 m-b-30">Add Bank</h4>

                                <form class="form-horizontal"
                                      action="<?php echo api_url("payment/bank/create"); ?>"
                                      data-parsley-validate
                                      novalidate method="post" onReset="updateForm();">
                                    <?php
                                    $error = validation_errors();
                                    if (!empty($error)) {
                                        ?>
                                        <div class="alert alert-danger">
                                            <strong>Warning!</strong> <?php echo $error ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Bank
                                            Name*</label>
                                        <div class="col-sm-7">
                                            <input type="text" required="" class="form-control"
                                                   id="name" name="name"
                                                   placeholder="Bank Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Account Holder
                                            Name*</label>
                                        <div class="col-sm-7">
                                            <input type="text" required="" class="form-control"
                                                   id="accountName" name="accountName"
                                                   placeholder="Account Holder Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Account Number*</label>
                                        <div class="col-sm-7">
                                            <input type="number" required="" class="form-control"
                                                   id="accountNumber" name="accountNumber"
                                                   placeholder="Account Number">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Sort
                                            Code</label>
                                        <div class="col-sm-7">
                                            <input type="text" required="" class="form-control"
                                                   id="sortCode" name="sortCode"
                                                   placeholder="Sort Code">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label">Branch
                                            </label>
                                        <div class="col-sm-7">
                                            <input type="text" required="" class="form-control"
                                                   id="branch" name="branch"
                                                   placeholder="Branch">
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
                               cellspacing="0" width="100%" id="banks_datatable">
                            <thead>
                            <tr>
                                <th>Bank ID</th>
                                <th>Bank Name</th>
                                <th>Account Holder Name</th>
                                <th>Account Number</th>
                                <th>Sort Code</th>
                                <th>Branch</th>
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