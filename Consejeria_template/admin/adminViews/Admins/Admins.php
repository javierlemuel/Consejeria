<?php 
  headerAdmin($data); 
  getModal('modalAdmin',$data);
?>


<div class="container-fluid">
  <div class="row" style="min-height: 1000px">
  
  <?php sidemenuAdmin($data); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-user-check"></i> <?= $data['page_tag'] ?> </h1>
            
        <div class="btn-toolbar mb-2 mb-md-0"> 
          <div class="btn-group me-2">
          </div>
        </div>
      </div>

    

      <div class="container p-0">
        <div class="row g-4 align-items-center" >
            <div class="col">
                
            </div>
            <div class="col-auto pe-0  d-flex">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalCustomer"><i class="fa-solid fa-plus"></i> New</button>
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
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Status</th>
              <th scope="col">Edit</th>
            </tr>
          </thead>
          <tbody>
          <?php  
            $obj = new Admins();
            $admins = $obj->getAdmins();

            foreach($admins as $admin){?>
            <tr>
              <td><?php echo $admin['admin_id'];?></td>
              <td><?php echo $admin['a_firstname'];?></td>
              <td><?php echo $admin['a_lastname'];?></td>
              <td><?php echo $admin['a_email'];?></td>
              <td><?php echo $admin['a_phone_number'];?></td>
              <td><?php echo $admin['a_status'];?></td>
              <td><a class="btn btn-primary" href="<?= base_url(); ?>/Admins/EditAdmin?admin_id=<?php echo $admin['admin_id']; ?>">Edit</a></td>
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
