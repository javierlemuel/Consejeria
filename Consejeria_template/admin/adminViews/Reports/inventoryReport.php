<?php headerAdmin($data); ?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px">
        <?php sidemenuAdmin($data); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><i class="fa-solid fa-calendar"></i> Stock Report </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>

                </div>
            </div>

            <?php if (isset($_GET['order_updated'])) { ?>
                <p class="text-center" style="color: green;"><?php echo $_GET['order_updated']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['order_failed'])) { ?>
                <p class="text-center" style="color: red;"><?php echo $_GET['order_failed']; ?></p>
            <?php } ?>



            <div class="container">

                <div class="table-responsive pt-2">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Stock</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data['productIn'] as $product) { ?>
                                <tr>
                                    <td><?php echo $product['p_id']; ?></td>
                                    <td><?php echo $product['p_name']; ?></td>
                                    <td><?php echo $product['stock']; ?></td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                </div>
        </main>
    </div>

</div>

<script>
    function GetReports() {
        alert("The form was submitted");
    }
</script>


<?php footerAdmin($data); ?>


</body>

</html>