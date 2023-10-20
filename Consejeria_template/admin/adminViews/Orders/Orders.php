<?php 
  headerAdmin($data); 
  //getModal('modalOrder',$data);
  $obje = new Orders();
  $obje->updateStatus();
?>


<div class="container-fluid">
  <div class="row" style="min-height: 1000px">
    <?php sidemenuAdmin($data); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-bag-shopping"></i> <?= $data['page_tag'] ?></h1>
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


      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Order Id</th>
              <th scope="col">Customer Id</th>
              <th scope="col">Transaction Number</th>
              <th scope="col">Order Date</th>
              <th scope="col">Total Price</th>
              <th scope="col">Order Status</th>
              <th scope="col">Ship Date</th>
              <th scope="col">Arrival Date</th>
              <th scope="col">Tracking Number</th>
              <th scope="col">Edit</th>
            </tr>
          </thead>
          <tbody>
          <?php  
            //$obj = new Orders();
            //$orders = $obj->getOrders();
            foreach ($data['result']  as $order) { ?>
              <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['c_id']; ?></td>
                <td><?php echo $order['transaction_number']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo "$".formatMoney($order['total_price']); ?></td>
                <td><?php echo $order['order_status']; ?></td>
                <td><?php echo $order['ship_date']; ?></td>
                <td><?php echo $order['arrival_date']; ?></td>
                <td><?php echo $order['tracking_number']; ?></td>
                <td><a class="btn btn-primary" href="<?= base_url(); ?>/Orders/EditOrder?order_id=<?php echo $order['order_id']; ?>">Edit</a></td>               

              </tr>

            <?php } ?>

          </tbody>
        </table>

      </div>
    </main>
  </div>




</div>

  <?php footerAdmin($data); ?>
</body>

</html>