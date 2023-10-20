<div class="modal fade" id="modalProducts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form  id="product-form" enctype="multipart/form-data" name="register-form" method="POST" action="products/insertProduct">
            <p style="color: red;"><?php if (isset($_GET['error'])) {
                                      echo $_GET['error'];
                                    } ?></p>
            <div class="row row-cols-lg-auto g-3"> 
                <div class="form-group col-md-6">
                  <label>Name</label>
                  <input type="text" class="form-control" id="product-name" name="name" placeholder="Name" required />
                </div>
            </div>
            <div class="row row-cols-lg-auto g-3">
                <div class="form-group col-md-6">
                  <label>Description</label>
                  <input type="text" class="form-control" id="product-desc" name="description" placeholder="Description" />
                </div>
            </div>
            <div class="row row-cols-lg-auto g-3">
                <div class="form-group col-md-6">
                  <label>Price</label>
                  <input type="text" class="form-control" id="product-price" name="price" placeholder="Price" required />
                </div>

                <div class="form-group col-md-6">
                  <label>Cost</label>
                  <input type="text" class="form-control" id="product-cost" name="cost" placeholder="Cost" required />
                </div>
            </div>

            <div class="row row-cols-lg-auto g-3">
                <div class="form-group col-md-6">
                  <label>Brand</label>
                  <input type="text" class="form-control" name="brand" placeholder="Brand" required />
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
                <div class="form-group col-md-6">
                  <label>Image</label>
                  <input type="file" class="form-control" id="image1" name="image1" placeholder="Image" required />
                </div>

                <div class="form-group col-md-6">
                <label>Resolution</label>
                  <input type="text" class="form-control" id="product-resolution" name="resolution" placeholder="Video Resolution" required />
                </div>
            </div>
            <div class="row row-cols-lg-auto g-3">
                <div class="form-group col-md-6">
                  <label>Products in Stock</label>
                  <input type="text" class="form-control" id="product-stock" name="stock" placeholder="Products in Stock" required />
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
                  <input type="text" class="form-control" id="product-provider" name="provider" placeholder="Provider" required />
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="createproduct">Create</button>
            </div>

          </form>
    
      </div>
  
     
    </div>
  </div>
</div>
<?php footerAdmin($data); ?>
  