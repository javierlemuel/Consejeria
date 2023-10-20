
<div class="modal fade" id="modalOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
 
              <form id="edit-order-form"  method="POST" action="editorders/updateOrder">

              <?php 
               $obj = new Editorders();
               $r = $obj->getOrder();
               //dep($r)
              //foreach($order as $r){?>

                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>

                <div class="container">
                <div class="row">
                  <div class="col-6 col-sm-3">
                  <div class="form-group my-3">
                                  <label>Order Id</label>
                                  <p class="my-4"><?php echo $r['order_id'];?></p>

                              </div>
                  </div>
                  <div class="col-6 col-sm-3">
                  <div class="form-group my-3">
                                       <label>Order Date</label>
                                  <p class="my-4"><?php echo $r['order_date'];?></p>

                                </div>
                  </div>

                </div>
                </div>
               
                <div class="container">
                  <div class="row">
                    <div class="col-6 col-sm-3">
                    <div class="form-group mt-3 ">
                        <label>OrderPrice</label>
                        
                        <input type="text" class="form-control" id="product-price" value="<?php echo $r['total_price'];?>" name="price" placeholder="Price" required />
                    
                  </div>

                    </div>
                    <div class="col-6 col-sm-3">
                    <div class="form-group my-3">
                    <label>Order Status</label>
                    <select  class="form-select" required name="order_status">
                      
                        <option value="paid" <?php if($r['order_status']=='paid'){ echo "selected";}?>>Paid</option>
                        <option value="shipped" <?php if($r['order_status']=='shipped'){ echo "selected";}?>>Shipped</option>
                        <option value="delivered" <?php if($r['order_status']=='delivered'){ echo "selected";}?>>Delivered</option>
                    </select>
                </div>

                    </div>
                    <div class="form-group mt-3 ">
                        <label>Tracking Number</label>
                        
                        <input type="text" class="form-control" id="tracking-number"  value="<?php echo $r['tracking_number'];?>" name="tracking" placeholder="Tracking Number" required />
                    
                  </div>

                    
                  </div>
                </div>
                 
                  <input type="hidden" name="order_id" value="<?php echo $r['order_id'];?>"/>
         
                <div class="modal-footer pt-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="edit_order" value="Edit"/>
                </div>
 
              </form>
   
      </div>
      
    </div>
  </div>
</div>
<?php footerAdmin($data); ?>
  