<?php 
  headerAdmin($data); 
  getModal('modalProducts',$data);
?>


<div class="container-fluid">
  <div class="row" style="min-height: 1000px">
  
  <?php sidemenuAdmin($data); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2"><i class="fa-solid fa-helicopter"></i> <?= $data['page_tag'] ?></h1>

        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          </div>
        </div>
      </div>

    

      <div class="container p-0">
        <div class="row g-4 align-items-center" >
            <div class="col"></div>
            <div class="col-auto d-flex">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalProducts"><i class="fa-solid fa-plus"></i> New</button>
            </div>
        </div>
    </div>

        <?php if(isset($_GET['edit_success_message'])){?>
           <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'];?></p>
        <?php } ?>

        <?php if(isset($_GET['edit_failure_message'])){?>
           <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message'];?></p>
        <?php } ?>

        <?php if(isset($_GET['deleted_successfully'])){?>
           <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'];?></p>
        <?php } ?>

        <?php if(isset($_GET['deleted_failure'])){?>
           <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'];?></p>
        <?php } ?>



        <?php if(isset($_GET['product_created'])){?>
           <p class="text-center" style="color: green;"><?php echo $_GET['product_created'];?></p>
        <?php } ?>



        <?php if(isset($_GET['product_failed'])){?>
           <p class="text-center" style="color: red;"><?php echo $_GET['product_failed'];?></p>
        <?php } ?>


        <?php if(isset($_GET['images_updated'])){?>
           <p class="text-center" style="color: green;"><?php echo $_GET['images_updated'];?></p>
        <?php } ?>


        <?php if(isset($_GET['images_failed'])){?>
           <p class="text-center" style="color: red;"><?php echo $_GET['images_failed'];?></p>
        <?php } ?>


      <p class="text-center"></p>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
        <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Image</th>
              <th scope="col">Name</th>
              <th scope="col">Brand</th>
              <!--<th scope="col">Description</th>-->
              <th scope="col">Wifi</th>
              <th scope="col">Resolution</th>
              <th scope="col">Role</th>
              <th scope="col">Provider</th>
              <th scope="col">Stock</th>
              <th scope="col">Cost</th>
              <th scope="col">Price</th>
              <th scope="col">Status</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
          <?php  
            $obj = new Products();
            $products = $obj->getProducts();
            foreach ($products as $product) { ?>
              <tr>
                <td><?php echo $product['p_id']; ?></td>
                <td><img src="<?php echo media();?>/product-images/<?=$product['p_img'];?>" style="width: 70px; height:70px"/></td>
                <td><?php echo $product['p_name']; ?></td>
                <td><?php echo $product['p_brand']; ?></td>
                <!--<td><?php //echo $product['p_desc']; ?></td>-->
                <td><?php echo $product['p_wifi']; ?></td>
                <td><?php echo $product['p_video_res']; ?></td>
                <td><?php echo $product['p_role']; ?></td>
                <td><?php echo $product['p_provider']; ?></td>
                <td><?php echo $product['stock']; ?></td>
                <td><?php echo "$".formatMoney($product['p_cost']); ?></td>
                <td><?php echo "$".formatMoney($product['p_price']); ?></td>
                <td><?php echo $product['p_status']; ?></td>
                <td><a class="btn btn-primary" href="<?= base_url(); ?>/Products/EditProduct?p_id=<?php echo $product['p_id']; ?>">Edit</a></td>
                <td><a class="btn btn-danger" href="<?= base_url(); ?>/Products/DeleteProduct?p_id=<?php echo $product['p_id']; ?>">DELETE</a></td>

              </tr>

            <?php }?>
            
          </tbody>
        </table>



        

      </div>
    </main>
  </div>




</div>

<?php footerAdmin($data); ?>
</body>
</html>
