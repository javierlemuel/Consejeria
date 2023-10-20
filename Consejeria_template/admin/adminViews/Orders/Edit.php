<?php headerAdmin($data); ?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px">

        <?php sidemenuAdmin($data); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                <h2>Edit Order</h2>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>

                </div>
            </div>
            <div class="table-responsive">

                <div class="mx-auto container">
                    <form id="edit-order-form" method="POST" action="updateOrder">

                        <p style="color: red;"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                } ?></p>

                        <div class="container">
                            <div class="row">
                                <div class="col-6 col-sm-3">
                                    <div class="form-group my-3">
                                        <label>Order Id</label>
                                        <p class="my-4"><?php echo $data['order_id']; ?></p>

                                    </div>
                                </div>
                                <div class="col-6 col-sm-3">
                                    <div class="form-group my-3">
                                        <label>Order Date</label>
                                        <p class="my-4"><?php echo $data['order_date']; ?></p>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-6 col-sm-3">
                                    <div class="form-group mt-3 ">
                                        <label>OrderPrice</label>

                                        <input type="text" class="form-control" id="product-price" value="<?php echo $data['total_price']; ?>" name="price" placeholder="Price" required />

                                    </div>

                                </div>
                                <div class="col-6 col-sm-3">
                                    <div class="form-group my-3">
                                        <label>Order Status</label>
                                        <select class="form-select" required name="order_status">

                                            <option value="cancelled" <?php if ($data['order_status'] == 'cancelled') {
                                                                        echo "selected";
                                                                    } ?>>Cancelled</option>
                                            <option value="processed" <?php if ($data['order_status'] == 'processed') {
                                                                        echo "selected";
                                                                    } ?>>Processed</option>
                                            <option value="shipped" <?php if ($data['order_status'] == 'shipped') {
                                                                        echo "selected";
                                                                    } ?>>Shipped</option>
                                            <option value="arrived" <?php if ($data['order_status'] == 'arrived') {
                                                                            echo "selected";
                                                                        } ?>>Arrived</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group mt-3 ">
                                    <label>Tracking Number</label>

                                    <input type="text" class="form-control" id="tracking-number" value="<?php echo $data['tracking_number']; ?>" name="tracking" placeholder="Tracking Number"  />

                                </div>


                            </div>
                        </div>

                        <input type="hidden" name="order_id" value="<?php echo $data['order_id']; ?>" />


                        <div class="form-group mt-3">
                            <a class="btn btn-secondary" href="<?= base_url(); ?>/orders">Close</a>
                            <input type="submit" class="btn btn-primary" name="edit_order" value="Edit" />
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>




<?php footerAdmin($data); ?>
</body>

</html>