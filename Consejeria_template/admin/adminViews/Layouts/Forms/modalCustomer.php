
<div class="modal fade" id="modalCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">New Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> 
      <div class="modal-body">
      <form class="w-100 px-3" id="register-form" name="register-form" method="POST"  action="customers/insert">
         <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
         <div class="form-group">
             <label>First Name</label>
             <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
         </div>
         <div class="form-group">
             <label>Last Name</label>
             <input type="text" class="form-control" id="last-name" name="lastname" placeholder="Last Name" required/>
         </div>
           <div class="form-group">
               <label>Email</label>
               <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
           </div>
           <div class="form-group">
             <label>Password</label>
             <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
         </div>
         <div class="form-group">
             <label>Confirm Password</label>
             <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required/>
     </div>
     <div class="modal-footer pt-1">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="register">Create</button>
          </div>
    </form>
      </div>
      
    </div>
  </div>
</div>
<?php footerAdmin($data); ?>
  