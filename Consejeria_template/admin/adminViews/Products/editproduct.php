<?php headerAdmin($data); ?>


<div class="container-fluid">
  <div class="row" style="min-height: 1000px">
    <?php sidemenuAdmin($data); ?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2"><i class="fa-solid fa-helicopter"></i> <?= $data['page_tag'] ?> </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">

          </div>

        </div>
      </div>



      <h2>Edit Product</h2>
      <div class="table-responsive">

      

      <form class="form-horizontal w-100 px-3" enctype="multipart/form-data" id="product-form" name="register-form" method="POST" action="updateProduct">
            <p style="color: red;"><?php if (isset($_GET['error'])) {
                                      echo $_GET['error'];
                                    } ?></p>
            <div class="row row-cols-lg-auto g-3"> 
                <div class="form-group col-md-6">

              <?php 
              
              // $obj = new Editproduct();
              // $data = $obj->getProduct();
               //dep($datas);
               
              // echo $_GET['p_id'];
                //  foreach ($data as $datas) { 
                //   echo("<script>console.log('PHP : " . $data['p_name'] . "');</script>");
                //    ?>
                 
                  <input type="hidden" name="product_id" value="<?php echo $data['p_id']; ?>" />

                  <label>Name</label>
                  <input type="text" class="form-control" id="product-name" value="<?php echo $data['p_name'] ?>" name="name" placeholder="Name" required />
                </div>
            </div>
            <div class="row row-cols-lg-auto g-3">
                <div class="form-group col-md-6">
                  <label>Description</label>
                  <input type="text" class="form-control" id="product-desc" value="<?php echo $data['p_desc'] ?>" name="description" placeholder="Description" />
                </div>
            </div>
            <div class="row row-cols-lg-auto g-3">
                <div class="form-group col-md-6">
                  <label>Price</label>
                  <input type="text" class="form-control" id="product-price" value="<?php echo $data['p_price'] ?>" name="price" placeholder="Price" required />
                </div>

                <div class="form-group col-md-6">
                  <label>Cost</label>
                  <input type="text" class="form-control" id="product-cost" value="<?php echo $data['p_cost'] ?>" name="cost" placeholder="Cost" required />
                </div>
            </div>

            <div style="padding-bottom: 10px" class="row row-cols-lg-auto g-3">
                <div class="form-group col-md-6">
                  <label>Brand</label>
                  <input type="text" class="form-control" value="<?php echo $data['p_brand'] ?>" name="brand" placeholder="Brand" required />
                </div>

                <div class="form-group col-md-6">
                  <label>Wifi</label>
                  <select class="form-select" required name="wifi">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
            </div>

            <div class="row row-cols-lg-auto g-3">
            <div class="form-group mt-2">
                    <label>Image</label>
                    <input type="file" class="form-control" id="image1" name="image1" placeholder="Image 1" />
                </div>

                <div class="form-group col-md-6">
                <label>Resolution</label>
                  <input type="text" class="form-control" id="product-resolution" value="<?php echo $data['p_video_res'] ?>" name="resolution" placeholder="Video Resolution" required />
                </div>
            </div>
            <div class="row row-cols-lg-auto g-3">
                <div class="form-group col-md-6">
                  <label>Products in Stock</label>
                  <input type="text" class="form-control" id="product-stock" value="<?php echo $data['stock'] ?>" name="stock" placeholder="Products in Stock" required />
                </div>

                <div class="form-group col-md-6">
                <label>Role</label>
                  <select class="form-select" required name="role">
                    <option value="Enterprise">Enterprise</option>
                    <option value="Education">Education</option>
                    <option value="Agriculture">Agriculture</option>
                  </select>
                </div>
            </div>
            
            <div class="row row-cols-lg-auto g-3 pb-2">
                <div class="form-group col-md-6">
                  <label>Provider</label>
                  <input type="text" class="form-control" id="product-provider" value="<?php echo $data['p_provider'] ?>" name="provider" placeholder="Provider" required />
                </div>
                                    
                <div class="form-group col-md-6">
                <label>Status</label>
                  <select class="form-select" required name="status">
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer pt-1">
            <a class="btn btn-secondary" href="<?= base_url(); ?>/products">Close</a>
              <input type="submit" class="btn btn-primary" name="save_changes" value="Save Changes" />
            </div>
            <?php //} ?>

          </form>
        </div>

      </div>
    </main>
  </div>
</div>



<?php footerAdmin($data); ?>
</body>

</html>