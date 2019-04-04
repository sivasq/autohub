<?php $this->load->view('includes/headers/admin-header'); ?>
    <script src="<?php echo base_url(); ?>assets/constants/product.constants.js"></script>
    <main class="main-wrapper clearfix">
        <!-- Page Title Area -->
        <div class="row page-title clearfix">
            <div class="page-title-left">
                <h6 class="page-title-heading mr-0 mr-r-5">Product Dashboard</h6>
                <p class="page-title-description mr-0 d-none d-md-inline-block"></p>
            </div>
            <!-- /.page-title-left -->
            <div class="page-title-right d-none d-sm-inline-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </div>
            <!-- /.page-title-right -->
        </div>
        <!-- /.page-title -->
        <!-- =================================== -->
        <!-- Different data widgets ============ -->
        <!-- =================================== -->
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-30">Add Product</h4>

                                    <form class="form-horizontal"
                                          action="<?php echo api_url("product/create"); ?>"
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
                                        <input type="hidden" name="product_id">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Product
                                                Name*</label>
                                            <div class="col-sm-7">
                                                <input type="text" required="" class="form-control"
                                                       id="userName" name="productName"
                                                       placeholder="Product Name">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Product
                                                Description</label>
                                            <div class="col-sm-7">
                                                <input type="text" required="" class="form-control"
                                                       id="userName" name="productDescription"
                                                       placeholder="Product Description">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Category</label>
                                            <div class="col-sm-7">
                                                <select class="form-control" name="productCategory"
                                                        id="productCategory">
                                                    <option>Select Category</option>
                                                    <?php
                                                    if (isset($instdata)) {
                                                    foreach ($instdata

                                                    as $value) {
                                                    foreach ($value

                                                    as $key => $val) {
                                                    ?>
                                                    <optgroup label="<?php echo $key ?>">
                                                        <?php
                                                        foreach ($val as $option) {
                                                            ?>
                                                            <option value="<?php echo $option['id'] ?>"
                                                                    id="<?php echo $option['id'] ?>"><?php echo $option['name'] ?></option>

                                                            <?php
                                                        }
                                                        }
                                                        }
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Product Type
                                            </label>
                                            <div class="col-sm-7">
                                                <select class="form-control" name="productCategory"
                                                        id="productCategory">
                                                    <option>Select Type</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Product
                                                Price*</label>
                                            <div class="col-sm-7">
                                                <input type="text" required="" class="form-control"
                                                       id="userName" name="productPrice"
                                                       placeholder="Product Price">
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="card-box">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap"
                                   cellspacing="0" width="100%" id="products_datatable">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Type</th>
                                    <th>Product Category</th>
                                    <th>Product Price</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                <!-- end: panel body -->
            </div> <!-- end panel -->
        </div> <!-- end col-->

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
    </main>
<?php $this->load->view('includes/footers/admin-footer'); ?>