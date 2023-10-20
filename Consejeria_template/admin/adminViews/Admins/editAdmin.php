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


    <div class="table-responsive">

      <form class="form-horizontal w-100 px-3" id="product-form" name="register-form" method="POST" action="updateAdmin">
            <p style="color: red;"><?php if (isset($_GET['error'])) {
                                      echo $_GET['error'];
                                    } ?></p>
            <div class="row row-cols-lg-auto g-3">

            <input type="hidden" name="a_id" value="<?php echo $data['admin_id']; ?>" />

                <div class="form-group col-md-6">
                  <label>Name</label>
                  <p class="my-4"><?php echo $data['a_firstname']; ?></p>                
                </div>

                <div class="form-group col-md-6">
                  <label>Last Name</label>
                  <p class="my-4"><?php echo $data['a_lastname']; ?></p>                </div>
            </div>
            
            <div class="form-group mt-3">
              <label>Email</label>
              <p class="my-4"><?php echo $data['a_email']; ?></p>
            </div>
                      
            <div class="form-group col-md-6">
              <label>Status</label>
              <select class="form-select"  name="Status">
                <option value="active">active</option>
                <option value="inactive">inactive</option>
              </select>
            </div>
            <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" id="phone-number" name="Phone" value="<?php echo $data['a_phone_number'] ?>" placeholder="Phone Number" />
          </div>
            <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="register-password" name="password" placeholder="Password"  />
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password"  />
          </div>
          
        </div>
            <div class="modal-footer pt-1">
            <a class="btn btn-secondary" href="<?= base_url(); ?>admins">Close</a>
              <input type="submit" class="btn btn-primary" name="save_admin" value="Save Changes" />
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