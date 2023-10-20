



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Drones Virtual Store">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title><?= $data['page_tag'] ?></title>


  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  
  <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="shortcut icon" href="<?= media();?> /imgs/favicon.ico">
  <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
  <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
  <meta name="theme-color" content="#7952b3">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }
    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap py-0 shadow" >
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="<?= base_url(); ?>/dashboard"><?= $data['page_title'] ?></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  </header>


<div class="container-fluid">
  <div class=""  style="min-height: 1000px">
   

    <main class="col-md-6 mx-auto col-lg-6 px-md-4 text-center">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          
          </div>
     
        </div>
      </div>

      <h2><?= $data['page_tag'] ?></h2>
      <div class="table-responsive">
      


          <div class="mx-auto container">
              <form id="login-form" name="login-form" class="w-100 px-3" enctype="multipart/form-data" method="POST" action="login/adminLogin">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group mt-2">
                    <label>Email</label>
                    <input type="email" class="form-control" id="admin-email" name="admin-email" placeholder="Email" required/>
                </div>
                  <div class="form-group mt-2">
                      <label>Password</label>
                      <input type="password" class="form-control" id="admin-password" name="admin-password" placeholder="Password" required/>
                  </div>
      
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="login_btn"/>
                </div>
 
              </form>
          </div>

      </div>
    </main>
  </div>
</div>




<footer>
        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
    <script src="<?=media(); ?>/js/fontawesome.js"></script>
    <script src="<?=media(); ?>/js/functions_admin.js"></script>
    <script src="<?=media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>

    
</footer>
 </body>
</html>
