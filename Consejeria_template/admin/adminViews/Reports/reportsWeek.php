<?php headerAdmin($data); ?>

<div class="container-fluid">
  <div class="row" style="min-height: 1000px">
    <?php sidemenuAdmin($data); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2"><i class="fa-solid fa-calendar"></i> <?= $data['page_tag'] ?> </h1>
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

        <form class="form-horizontal w-100 px-3" id="report-form" name="report-form" method="POST" action="reports">
          <div class="row align-items-start">
            <div class="col">
              <label for="startsdate">Start Date:</label>
              <input class="form-control" type="date" id="startdate" name="startdate" placeholder="dd-mm-yyyy" value="<?php echo $data['startdate']; ?>" required>
            </div>
            <div class="col">
              <div class="col">
                <label for="enddate">End Date: </label>
                <input class="form-control" type="date" id="enddate" name="enddate" placeholder="dd-mm-yyyy" value="<?php echo $data['enddate']; ?>" required>
              </div>
            </div>

            <div class="col">
              <label for="product">Group by:</label>
              <select class="form-select" aria-label="Default select example" required name="group">
                <option value="day" <?php if ($data['group'] == "day") echo ' selected="selected"'; ?>>Day</option>
                <option value="week" <?php if ($data['group'] == "week") echo ' selected="selected"'; ?>>Week</option>
                <option value="month" <?php if ($data['group'] == "month") echo ' selected="selected"'; ?>>Month</option>
              </select>
            </div>
            <div class="col">
              <label for="product">Select Product:</label>
              <select class="form-select" aria-label="Default select example" name="product" value="4">
                <option value="0" >None</option>
                <?php
                foreach ($data['productList'] as $product) { ?>
                  <option value="<?php echo $product['p_id']; ?>" <?php if ($product['p_id'] == $data['product']) echo ' selected="selected"'; ?>><?php echo $product['p_name']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col pt-4 align-middle">
              <input type="submit" class="btn btn-primary " name="report" value="Get Report" />
            </div>


          </div>
        </form>


        <div class="table-responsive pt-2">
        <table class="table table-striped table-sm">
        <thead>
            <tr>
              <th scope="col">Week</th>
              <th scope="col">Year</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
              
            </tr>
          </thead>
          <tbody>
          <?php  
            // $obj = new Reports();
            // $reportData = $data['reportData'];
            foreach ($data['reportData'] as $report) { ?>
              <tr>
                <td><?php echo $report['Week']; ?></td>
                <td><?php echo $report['Year']; ?></td>
                <td><?php echo $report['Quantity']; ?></td>
                <td>$<?php echo $report['Total']; ?></td>
              </tr>

            <?php }?>
            <tr>
                <td><b>Grand Total:</b></td>
                <td></td>
                <td></td>
                <td><b>$<?php echo number_format((float)$data['grandTotal'], 2, '.', '');?></b></td>
              
              </tr>
            
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