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

      

      <form class="form-horizontal w-100 px-3" id="product-form" name="register-form" method="POST" action="updateCustomer">
            <p style="color: red;"><?php if (isset($_GET['error'])) {
                                      echo $_GET['error'];
                                    } ?></p>
            <div class="row row-cols-lg-auto g-3">

            <input type="hidden" name="c_id" value="<?php echo $data['c_id']; ?>" />

                <div class="form-group col-md-6">
                  <label>Name</label>
                  <input type="text" class="form-control" id="name" value="<?php echo $data['c_first_name'] ?>" name="FirstName" placeholder="Name"  />
                </div>

                <div class="form-group col-md-6">
                  <label>Last Name</label>
                  <input type="text" class="form-control" id="last-name" value="<?php echo $data['c_last_name'] ?>" name="LastName" placeholder="Last Name"  />
                </div>
            </div>
            
            <div class="form-group mt-3">
              <label>Email</label>
              <p class="my-4"><?php echo $data['c_email']; ?></p>
            </div>

            <div class="form-group mt-3 ">
                <label>Address Line 1</label>
                    <input type="text" class="form-control" id="address-line-1" value="<?php echo $data['address_line_1']; ?>" name="AddressLine1" placeholder="Address Line 1"  />
             </div>
             <div class="form-group mt-3 ">
                <label>Address Line 2</label>
                    <input type="text" class="form-control" id="address-line-2" value="<?php echo $data['address_line_2']; ?>" name="AddressLine2" placeholder="Address Line 1"  />
             </div>

             <div class="form-group mt-3 ">
                <label>City</label>
                    <input type="text" class="form-control" id="city" value="<?php echo $data['c_city']; ?>" name="City" placeholder="City"  />
             </div>

             <div class="form-group mt-3 ">
                <label>State</label>
                    <input type="text" class="form-control" id="state" value="<?php echo $data['c_state']; ?>" name="State" placeholder="State"  />
             </div>

             <div class="form-group mt-3 ">
                <label>ZIP Code</label>
                    <input type="text" class="form-control" id="zip" value="<?php echo $data['c_zipcode']; ?>" name="Zip" placeholder="ZIP Code"  />
             </div>
             <div class="form-group mt-3 ">
                <label>Phone Number</label>
                    <input type="text" class="form-control" id="phone" value="<?php echo $data['c_phone_number']; ?>" name="Phone" placeholder="Phone Number"  />
             </div>
                      
            <div class="form-group col-md-6">
              <label>Status</label>
              <select class="form-select"  name="Status">
                <option value="active">active</option>
                <option value="inactive">inactive</option>
              </select>
            </div>
        </div>
            <div class="modal-footer pt-1">
            <a class="btn btn-secondary" href="<?= base_url(); ?>/customers">Close</a>
              <input type="submit" class="btn btn-primary" name="save_customer" value="Save Changes" />
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