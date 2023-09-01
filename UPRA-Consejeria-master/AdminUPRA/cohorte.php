<?php
include("inc/connection.php");
 session_start();
 $advisor_id = $_SESSION['adv_email'];
 $advisor_name = $_SESSION['adv_name'];

if(!isset($_SESSION['adv_email'])){
  header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CONSEJERÍA-UPRA | INICIO</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- page css -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <link rel="stylesheet" href="../css/conse.css">
  <link rel="stylesheet" href="login.css">

  <style>
    .grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
  grid-gap: 10px;
  background-color: transparent;
  padding: 10px;
}

.grid-item {
  background-color: transparent;
  text-align: center;
  padding: 20px 0;
  font-size: 30px;
}

h2 {
      text-align: center;
    }

    * {
      box-sizing: border-box;
    }

/* Table Styles */

.table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.fl-table thead th {
    color: #ffffff;
    background: #282828;
}


    /* Create two equal columns that floats next to each other */
    .column {
      float: left;
      width: 50%;
      padding: 10px;
      height: 840px;
      /*Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    body, h1, h3, input { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #666;
      }
      h1, h3 {
      padding: 12px 0;
      font-weight: 400;
      }
      h1 {
      font-size: 28px;
      }
      .main-block, .info {
      display: flex;
      flex-direction: column;
      }
      .main-block {
      justify-content: center;
      align-items: center;
      width: 100%;
      min-height: 100%;
      background: url("/uploads/media/default/0001/01/49bff73f282c2c21f3341f1fe457fe35337b1792.jpeg") no-repeat center;
      background-size: cover;
      }
      .form {
      width: 86%; 
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 5px; 
      border: solid 1px #ccc;
      box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
      background: #ebebeb; 
      }
      .info-item {
      width: 100%;
      }
      input {
      width: calc(100% - 57px);
      height: 36px;
      padding-left: 10px; 
      margin: 0 0 12px -5px;
      border-radius: 0 5px 5px 0;
      border: solid 1px #cbc9c9;
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #fff; 
      }
      .icon {
      padding: 9px 15px;
      margin-top: -1px;
      border-radius: 5px 0 0 5px;
      border: solid 0px #cbc9c9;
      background: #666;
      color: #fff;
      }
      input[type=radio] {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      text-indent: 32px;
      cursor: pointer;
      margin-bottom: 10px;
      }
      label.radio:before {
      content: "";
      position: absolute;
      left: 0;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      border: 0.5px solid #e0c200;
      background: #fff;
      }
      label.radio:after {
      content: "";
      position: absolute;
      width: 8px;
      height: 4px;
      top: 5px;
      left: 4px;
      border-bottom: 3px solid #e0c200;
      border-left: 3px solid #e0c200;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      textarea {
      width: 99%;
      margin-bottom: 12px;
      }
      button {
      width: 100%;
      padding: 8px;
      border-radius: 5px; 
      border: none;
      background: #e0c200; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      }
      button:hover {
      background: #e0c200;
      }
      .grade-type div {
      display: flex;
      margin: 6px 0;
      }
      @media (min-width: 568px) {
      .info {
      flex-flow: row wrap;
      justify-content: space-between;
      }
      .info-item {
      width: 48%;
      }
      }

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.grid-container {
  display: grid;
  grid-template-columns: auto auto;
  padding: 10px;
}
.grid-item {
  padding: 20px;
  font-size: 30px;
  text-align: center;
}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand upra-amarillo navbar-light">
<!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="inicio.php" class="nav-link">Inicio</a>
      </li>
    </ul>
  </nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio.html" class="brand-link">
      <img src="img/university.jpg" alt="UPRA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CONSEJERÍA UPRA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
        <?php $sql = "SELECT adv_name, adv_lastname FROM `advisor` WHERE adv_email = '$advisor_id'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                $row = mysqli_fetch_assoc($result);
                ;}
            ?>
          <?php echo "<a class='d-block'>{$row['adv_name']} {$row['adv_lastname']} </a>" ?>
        </div>
      </div>

       <!-- Sidebar Menu -->
       <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item has-treeview menu-open">
            <a href="inicio.php" class="nav-link">
               <i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Inicio</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a onclick="document.getElementById('id02').style.display='block'" href="#" class="nav-link">
               <i class="fas fa-plus-square"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Subir Expediente</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a onclick="document.getElementById('id03').style.display='block'" href="#" class="nav-link">
               <i class="fas fa-table"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Editar/Crear Cohorte</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="lista.php" class="nav-link">
               <i class="fas fa-stopwatch-20"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Lista de Conteo de Clases</p>
            </a>
          </li>
           <li class="nav-item has-treeview menu-open">
            <a href="calendar.php" class="nav-link">
               <i class="far fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Calendario</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open"><a href="inc/logout_admin.php" class="nav-link">
              <i class="fa fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Cerrar Sesión</p>
            </a></li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear Cohorte Académico</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Crear Cohorte Académico</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">  

<div class="row">
  <div class="column">
    <h2>Nuevo Curso</h2>
    <p>Instrucciones: Complete los campos requeridos y presione para crear nuevo curso.</p>

    <div class="container form">
        <div class="form-group">
          <label for="sel1">Seleccione el departamento (Concentración):</label>
          <select class="form-control" id="dept"> 
          <?php
          $sql_cohort = "SELECT DISTINCT crse_major FROM `cohort`";
          $result_cohort = mysqli_query($conn, $sql_cohort);
          $resultCheck_cohort = mysqli_num_rows($result_cohort);  
          if ($resultCheck_cohort > 0){
            while ($row_cohort = mysqli_fetch_assoc($result_cohort))
          echo "<option>{$row_cohort['crse_major']}</option>";
          }
          ?>
          </select>
          <label style="margin-left: 5px">Año</label><br>
        <input type="number" id="cohort_year" name="cohort_year" placeholder="2021" style="margin-left: 2px">
        </div>
    </div>
    
    <!-- Cambiar fname, lname, id, name  <label for="lname">Descripción del Curso:</label>-->
    <h3>Información del Curso</h3>
    <label> Código </label><br>
        <input type="text" id="crse_code" name="crse_code" placeholder="EJEM 1234">
    <label> Descripción </label>
        <input type="text" id="crse_description" name="crse_description" placeholder="Clase">
        <label> Créditos</label>
        <input type="text" id="crse_credits" name="crse_credits" placeholder="3">

        <p>Curso se clasifica como:</p>
        <input type="radio" id="concentracion" name="clasificacion" value="concentracion">
        <label for="concentracion" class="radio" style="margin-right:20px">Requisito de Concentración</label> 
        <input type="radio" id="general" name="clasificacion" value="general">
        <label for="general" class="radio">Requisito General</label><br>



        <button onclick="myFunction()">Submit</button>


  </div>
  <div class="column" style="background-color:#e0c200; overflow-y:auto">
    <h2 style="margin-top:1px">Cohorte Completo</h2>
    <p>Instrucciones: Presione el botón de confirmar para crear su nuevo cohorte.</p>
<h2>Concentración</h2>
<div class="table-wrapper">
  <table class="fl-table">
      <thead>
      <tr>
          <th>Código</th>
          <th>Descripción</th>
          <th>Créditos</th>
          <th onclick="eli_all('concentracion-table')" style="cursor: pointer">X</th>
      </tr>
      </thead>
      <tbody id="concentracion-table">
      <tbody>
  </table>
</div>
<h2>General</h2>
<div class="table-wrapper">
  <table class="fl-table">
      <thead>
      <tr>
          <th>Código</th>
          <th>Descripción</th>
          <th>Créditos</th>
          <th onclick="eli_all('general-table')" style="cursor: pointer">X</th>
      </tr>
      </thead>
      <tbody id="general-table">
      <tbody>
  </table>
</div>
        <h2>Créditos adicionales</h2>
        <p>Si el cohorte requiere créditos en: electivas departamentales, electivas libres, educación general CISO,
          educación general HUMA indique la cantidad en el espacio correspondiente. </p>

<div class="table-wrapper">
  <table class="fl-table">
      <thead>
      <tr>
          <th>Dept.</th>
          <th>Libre</th>
          <th>CISO</th>
          <th>HUMA</th>
      </tr>
      </thead>
      <tbody id="requisito">
      <td>
        <input type="number" id="cred_dept" name="departamental" style="width:100%"></td>
        <td>
        <input type="number" id="cred_free" name="free" style="width:100%"></td>
        <td>
        <input type="number" id="cred_ciso" name="ciso" style="width:100%"></td>
        <td>
        <input type="number" id="cred_huma" name="huma" style="width:100%"></td>
      <tbody>
  </table>
</div>

<button id="myBtn" style="background:white; color:#e0c200">Submit</button>
<!-- The Modal -->
<div id="myModal" class="modal" style="padding-bottom: 20px">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="close">&times;</span>
    <h2>Flujograma del Cohorte</h2>
    <div class="grid-container">
      <div class="grid-item">
    <h3 for="sel2"><b>Seleccione el Curso:</b></h3>
          <select class="form-control" id="sel2"> 
            <option></option>
          </select>
          <h3 for="sel3"><b>Seleccione el Año:</b></h3>
          <select class="form-control" id="year"> 
            <option value="1">Primer Año</option>
            <option value="2">Segundo Año</option>
            <option value="3">Tercer Año</option>
            <option value="4">Cuarto Año</option>
          </select>
      
          <h3 for="sel3"><b>Seleccione el Semestre:</b></h3>
          <select class="form-control" id="semester"> 
            <option value="1">Enero-Mayo</option>
            <option value="2">Agosto-Diciembre</option>
            <option value="3">Ambos Semestres</option>
          </select>

          <div class="grid-container">
  <div class="grid-item">
  <h3 for="sel4"><span class="close" id="clearPre">&times;</span><b>Pre-Requisito:</b></h3>
          <select class="form-control" id="sel4"> 
          <option></option>
          </select>
          <div>
            <button onclick="submitPre()" style="background:#e0c200; width: 30%; height: 35%; margin-top: 5px; margin-bottom: 5px">Add</button>
          </div>
  <div id="pre" style="overflow-y: auto;">
  </div>
  </div>
  <div class="grid-item">
  <h3 for="sel5"><span class="close" id="clearCo">&times;</span><b>Co-Requisito:</b></h3>
          <select class="form-control" id="sel5"> 
          <option></option>
          </select>
          <div>
            <button onclick="submitCo()" style="background:#e0c200; width: 30%; height: 35%; margin-top: 5px; margin-bottom: 5px">Add</button>
          </div>
  <div id="co" style="overflow-y: auto;">
  </div>
  </div>  
  </div>
  <div>
            <button onclick="submitReq()" style="background: #e0c200; width: 30%; height: 35%; margin-top: 5px; margin-bottom: 5px; margin-left: 10%">Save</button>
            </div>
          </div>
            <div class="card card-primary grid-item" style="border-top: 3px solid #e0c200;">
              <ol class="card-body box-profile" id="clases" style="overflow-y:auto; max-height: 400px">

              </ol>
            <button onclick="submitAll()" style="background:#e0c200; margin-top: 5px; margin-bottom: 5px">Submit</button>

</div>

                </div>
</div>
  
</div>
  </div>
</div>
<div id="subForm"></div>
       </section> 
     </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>              
    </div>
  </div>
  <!-- modales -->
    
     <!----------------------------------------- Actualizar Expediente -------------------------------------------------->
        <div id='id02' class='w3-modal' style='padding-left:20%'>
            <div class='w3-modal-content w3-animate-zoom'>
              <header class='w3-container' style='padding-top:5px'>
                <span onclick='document.getElementById("id02").style.display="none"'
                class='w3-button w3-display-topright'>&times;</span>
                <h3>Subir Expediente</h3>
              </header>
              <div class='w3-container'>
                  <br>
                    <!-- Este de abajo es para subir el .txt y funciona -->
                    <?php
                        if (isset($_SESSION['message']) && $_SESSION['message'])
                        {
                          printf('<b>%s</b>', $_SESSION['message']);
                          unset($_SESSION['message']);
                        }
                      ?>
                      <form method="POST" action="upload1.php" enctype="multipart/form-data">
                        <div>
                          <input type="file" name="uploadedFile" />
                        </div>

                   
              </div>
              <footer class='w3-container' style='padding-bottom:10px; padding-top:10px'>
              <button type='submit' class='btn btn-default' name="uploadBtn" value="Upload" onclick='history.go(0)' style='float:right; '>APLICAR</button>
              </footer>
                 </form> 
            </div>
          </div><!-- /.Expediente -->

          <!----------------------------------------- Editar/Crear Cohorte -------------------------------------------------->
        <div id='id03' class='w3-modal' style='padding-left:20%'>
            <div class='w3-modal-content w3-animate-zoom'>
              <header class='w3-container' style='padding-top:5px'>
                <span onclick='document.getElementById("id03").style.display="none"'
                class='w3-button w3-display-topright'>&times;</span>
                <h3>Editar/Crear Cohorte</h3>
              </header>
              <div class='w3-container'>
                  <br>
                  <form action="cohorte.php" method="POST">
                  <select name='cohort' style="width: 100%; height: 30px; background-color: #d3d3d3; border-radius: 5px">
                  <option></option>
                        <?php
                            $sql_cohort = "SELECT DISTINCT crse_major, cohort_year FROM `cohort`";
                            $result_cohort = mysqli_query($conn, $sql_cohort);
                            $resultCheck_cohort = mysqli_num_rows($result_cohort);                                
                           
                            if($resultCheck_cohort > 0){
                              while($row_cohort = mysqli_fetch_assoc($result_cohort)){
                                echo "<option value='".$row_cohort["crse_major"].",".$row_cohort["cohort_year"]."'>".$row_cohort["crse_major"]." ".$row_cohort["cohort_year"]."</option>";
                              }
                            }
                        ?>
                  </select>
                  <div class="grid-container">
                <div class='item-1'>
                          <button name="submit" type="submit" value="Crear" class='btn btn-primary' style="width: 100%; color: white">Crear</button>
                  </div> 
                <div class='item-2'>
                          <button type="submit" name="submit" value="Editar" class='btn btn-warning' style="width: 100%; color: white">Actualizar</button>
                  </div>
                  </div>
              </div>
              <footer class='w3-container' style='padding-bottom:10px; padding-top:10px'>
              </footer>
                 </form> 
            </div>
          </div><!-- /.Expediente -->
    
  </div>
    <!-- /.modales -->
  </body>
            <!-- /. crear expediente -->
    <!-- /.modales -->
    <!-- /.content -->
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a>CONSEJERÍA-UPRA</a>.</strong> All rights reserved.
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
let concentracion = [];
let general = [];

  function myFunction() {
    
  
  crse_code = document.getElementById("crse_code").value;
  crse_description = document.getElementById("crse_description").value;
  crse_credits = document.getElementById("crse_credits").value;
  table1 = document.getElementById("concentracion-table").innerHTML;
  table2 = document.getElementById("general-table").innerHTML;

  if (crse_code != crse_code.match(/[A-Z]{4}[0-9]{4}/g)) {
    alert("El Formato Es : 'ABCD1234' sin espacio y en mayuscula.");
    return false;
  }else {
                if (document.getElementById("general").checked) {
                    clasificacion = "general";
                }else {
                    clasificacion = "concentracion";
                }
                
  if (clasificacion === "concentracion"){
  document.getElementById("concentracion-table").innerHTML = `
            ${table1}
            <tr>
            <td id='con_code'>${crse_code}</td>
            <td id='con_des'>${crse_description}</td>
            <td id='con_cred'>${crse_credits}</td>
            <td onclick='eli_con("${crse_code}")' style='cursor: pointer'>X</td>
            </tr>`;
            concentracion.push([crse_code, crse_description, crse_credits]);
  }else {
    document.getElementById("general-table").innerHTML = `
            ${table2}
            <tr>
            <td id='gen_code'>${crse_code}</td>
            <td id='gen_des'>${crse_description}</td>
            <td id='gen_cred'>${crse_credits}</td>
            <td onclick='eli_gen("${crse_code}")' style='cursor: pointer'>X</td>
            </tr>`;
            general.push([crse_code, crse_description, crse_credits]);
  }
  }
}

function eli_all(tabla) {
  if (tabla == "concentracion-table"){
    document.getElementById("concentracion-table").innerHTML = '';
    concentracion = [];
  }else if (tabla == "general-table") {
    document.getElementById("general-table").innerHTML = '';
    general = [];
  }
}
function eli_con(clase) { 
  for (var i = 0; i < concentracion.length; i++){
    if (concentracion[i][0] == `${clase}`){
      var temp = i + 1;
      concentracion.splice(temp - 1,1);
      if (concentracion.length > 0){
      for (var j = 0; j < concentracion.length; j++){
        if (j > 0){
          var table = document.getElementById("concentracion-table").innerHTML;
          document.getElementById("concentracion-table").innerHTML = `
            ${table}
            <tr>
            <td id='con_code'>${concentracion[j][0]}</td>
            <td id='con_des'>${concentracion[j][1]}</td>
            <td id='con_cred'>${concentracion[j][2]}</td>
            <td onClick='eli_con("${concentracion[j][0]}")' style='cursor: pointer'>X</td>
            </tr>`;
        }else {
          document.getElementById("concentracion-table").innerHTML = `
            <tr>
            <td id='con_code'>${concentracion[j][0]}</td>
            <td id='con_des'>${concentracion[j][1]}</td>
            <td id='con_cred'>${concentracion[j][2]}</td>
            <td onClick='eli_con("${concentracion[j][0]}")' style='cursor: pointer'>X</td>
            </tr>`;
        }
        
      }
      break;
    }else {
        document.getElementById("concentracion-table").innerHTML = ``;
        break;
        }
    }
  }
}

function eli_gen(clase) { 
  for (var i = 0; i < general.length; i++){
    if (general[i][0] == `${clase}`){
      var temp = i + 1;
      general.splice(temp - 1,1);
      if (general.length > 0){
      for (var j = 0; j < general.length; j++){
        if (j > 0){
          var table = document.getElementById("general-table").innerHTML;
          document.getElementById("general-table").innerHTML = `
            ${table}
            <tr>
            <td id='con_code'>${general[j][0]}</td>
            <td id='con_des'>${general[j][1]}</td>
            <td id='con_cred'>${general[j][2]}</td>
            <td onClick='eli_con("${general[j][0]}")' style='cursor: pointer'>X</td>
            </tr>`;
        }else {
          document.getElementById("general-table").innerHTML = `
            <tr>
            <td id='con_code'>${general[j][0]}</td>
            <td id='con_des'>${general[j][1]}</td>
            <td id='con_cred'>${general[j][2]}</td>
            <td onClick='eli_gen("${general[j][0]}")' style='cursor: pointer'>X</td>
            </tr>`;
        }
        
      }
      break;
    }else {
        document.getElementById("general-table").innerHTML = ``;
        break;
        }
    }
  }
}

let pre_requisitos = [];
let co_requisitos = [];

function submitPre() {
    var pre = document.getElementById("sel4").value;
    var list = document.getElementById("pre").innerHTML;
    document.getElementById("pre").innerHTML = `
      ${list}
      <h3 name="pre-requisito">${pre}</h3>
    `;
    pre_requisitos.push(pre);
 }

 function submitCo() {
    var co = document.getElementById("sel5").value;
    var list = document.getElementById("co").innerHTML;
    document.getElementById("co").innerHTML = `
      ${list}
      <h3 id="co-requisito">${co}</h3>
    `;
    co_requisitos.push(co);
 }
var list_counter = 0;
var arr = [];
var class_arr = [];
 function submitReq(){
   var clase = document.getElementById("sel2").value;
   var list = document.getElementById("clases").innerHTML;
   var year = document.getElementById("year").value;
   var semester = document.getElementById("semester").value;
   var rep_class = 0;
   
      for (var i = 0; i < class_arr.length; i++){
        if (class_arr[i][0] == `${clase}`){
          rep_class = 1;
          var temp_var = i + 1;
          class_arr.slice(i - 1,1);
          class_arr.push([clase, year, semester]);

      for (var j = 1; j <= arr.length; j++){
        arr.slice(j - 1,1);
      }
        if (pre_requisitos.length >= co_requisitos.length){
          var temp = pre_requisitos.length;
          if (temp === 0){
            temp = 1;
          }
        }else if (co_requisitos.length > pre_requisitos.length){
          var temp = co_requisitos.length;
        }
        for (i = 0; i < temp; i++){
          if (pre_requisitos[i] != "" && co_requisitos[i] != ""){
              arr.push([clase, pre_requisitos[i], co_requisitos[i]]);
              } else if (pre_requisitos[i] != "" && co_requisitos[i] === ""){
                  arr.push([clase, pre_requisitos[i], "-"]);
                  } else if(co_requisitos[i] != "" && pre_requisitos[i] === ""){
                      arr.push([clase, "-", co_requisitos[i]]);
                      } 
        }
        break;
        }
      }   

      if (rep_class == 0) {


        class_arr.push([clase, year, semester]);
        list_counter++;

        if (pre_requisitos.length >= co_requisitos.length){
          var temp = pre_requisitos.length;
          if (temp === 0){
            temp = 1;
          }
        }else if (co_requisitos.length > pre_requisitos.length){
          var temp = co_requisitos.length;
        }
        for (i = 0; i < temp; i++){
          if (pre_requisitos[i] != "" && co_requisitos[i] != ""){
              arr.push([clase, pre_requisitos[i], co_requisitos[i]]);
              } else if (pre_requisitos[i] != "" && co_requisitos[i] === ""){
                  arr.push([clase, pre_requisitos[i], "-"]);
                  } else if(co_requisitos[i] != "" && pre_requisitos[i] === ""){
                      arr.push([clase, "-", co_requisitos[i]]);
                      } 
                          document.getElementById("clases").innerHTML = `
                            ${list}
                            <li style="margin-left:20px; font-size: 0.6em; cursor: pointer" onclick="viewClase('${clase}')">${clase}</li>
                          `;
        }
      }
 pre_requisitos = [];
 co_requisitos = [];

 document.getElementById("co").innerHTML = ``;
 document.getElementById("pre").innerHTML = ``;
 }
 
 function viewClase(clase){
  var list;
  document.getElementById("co").innerHTML = ``;
  document.getElementById("pre").innerHTML = ``;
   for (var i = 0; i < arr.length; i++){
    if (arr[i][0] === `${clase}`){
      if (arr[i][1] != null){
        list = document.getElementById("pre").innerHTML;
        document.getElementById("pre").innerHTML = `
      ${list}
      <h3 name="pre-requisito">${arr[i][1]}</h3>
    `;
      }
      if (arr[i][2] != null){
        list = document.getElementById("co").innerHTML;
        document.getElementById("co").innerHTML = `
      ${list}
      <h3 name="co-requisito">${arr[i][2]}</h3>
      `;
      }
    }
   }
   for (var i = 0; i < class_arr.length; i++){
     if(class_arr[i][0] == `${clase}`){
    document.getElementById("sel2").value = `${class_arr[i][0]}`;
    document.getElementById("year").value = `${class_arr[i][1]}`;
    document.getElementById("semester").value = `${class_arr[i][2]}`; 
     }
   }
 }

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementById("close");

// Get the <span> element that clears the co-requisitos
var clearCo = document.getElementById("clearCo");

// Get the <span> element that clears the pre-requisitos
var clearPre = document.getElementById("clearPre");

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
  var con_code = document.querySelectorAll("[id='con_code']");
  var gen_code = document.querySelectorAll("[id='gen_code']");
  
    for(var i = 0; i < con_code.length; i++){ 
      loop = document.getElementById("sel2").innerHTML;
      document.getElementById("sel2").innerHTML = `
              ${loop}
              <option>${con_code[i].innerHTML}</option>
              `; 
      document.getElementById("sel4").innerHTML = `
              ${loop}
              <option>${con_code[i].innerHTML}</option>
              `; 
      document.getElementById("sel5").innerHTML = `
              ${loop}
              <option>${con_code[i].innerHTML}</option>
              `; 
    }

      for(var i = 0; i < gen_code.length; i++){ 
        loop = document.getElementById("sel2").innerHTML;
        document.getElementById("sel2").innerHTML = `
            ${loop}
            <option>${gen_code[i].innerHTML}</option>
            `; 
        document.getElementById("sel4").innerHTML = `
            ${loop}
            <option>${gen_code[i].innerHTML}</option>
            `; 
        document.getElementById("sel5").innerHTML = `
            ${loop}
            <option>${gen_code[i].innerHTML}</option>
            `; 
          }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  document.getElementById("sel2").innerHTML = `<option></option>`;
  document.getElementById("sel4").innerHTML = `<option></option>`;
  document.getElementById("sel5").innerHTML = `<option></option>`;
  document.getElementById("pre").innerHTML = ``;
  document.getElementById("co").innerHTML = ``;
}

// When the user clicks on <span> (x), clear co-requisitos
clearCo.onclick = function() {
  document.getElementById("co").innerHTML = '';
  for (var i = 0; i < arr.length; i++){
    if (arr[i][0] === `${clase}`){
      console.log(arr[i][2]);
    }
  }
  co_requisitos = [];
}

// When the user clicks on <span> (x), clear pre-requisitos
clearPre.onclick = function() {
  document.getElementById("pre").innerHTML = '';
  pre_requisitos = [];
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    document.getElementById("sel2").innerHTML = `<option></option>`;
    document.getElementById("sel4").innerHTML = `<option></option>`;
    document.getElementById("sel5").innerHTML = `<option></option>`;
    document.getElementById("pre").innerHTML = ``;
    document.getElementById("co").innerHTML = ``;
  }
}

function submitAll() {
  dept = document.getElementById("dept").value;
  cohort_year = document.getElementById("cohort_year").value;
  cred_dept = document.getElementById("cred_dept").value;
  cred_free = document.getElementById("cred_free").value;
  cred_ciso = document.getElementById("cred_ciso").value;
  cred_huma = document.getElementById("cred_huma").value;

  console.log(dept, cohort_year, cred_dept, cred_free, cred_ciso);
  document.getElementById("subForm").innerHTML = `
  <form method="POST" action="inc/add_cohorte.php" id="form">
  <input type="hidden" name="dept" value="${dept}"></input>
  <input type="hidden" name="cohort_year" value="${cohort_year}"></input>
  <input type="hidden" name="concentracion" value="${concentracion}"></input>
  <input type="hidden" name="general" value="${general}"></input>
  <input type="hidden" name="cred_dept" value="${cred_dept}"></input>
  <input type="hidden" name="cred_free" value="${cred_free}"></input>
  <input type="hidden" name="cred_ciso" value="${cred_ciso}"></input>
  <input type="hidden" name="cred_huma" value="${cred_huma}"></input>
  <input type="hidden" name="pre_co" value="${arr}"></input>
  <input type="hidden" name="class_year" value="${class_arr}"></input>
  <input type="hidden" name="save_method" value="${save_method}"></input>
  </form>
  `;

  document.getElementById("form").submit();
} 
function validateForm() {
  var x = document.forms["myForm"]["fname"].value;
  if (x != x.match(/[A-Z]{4}[0-9]{4}/g)) {
    alert("El Formato Es : 'ABCD1234' sin espacio y en mayuscula.");
    return false;
  }
}
</script>

<?php
if (isset($_POST['submit'])) {
  $array = mysqli_real_escape_string($conn, $_POST['cohort']);
  $save_method = mysqli_real_escape_string($conn, $_POST['submit']);
  $cohort = explode(",",$array);
  echo "<script>
  var save_method = '{$save_method}';
  </script>";
  if($cohort[0] != NULL){
  $sql = "SELECT * 
  FROM cohort INNER JOIN mandatory_courses USING (crse_code)
  WHERE crse_major = '".$cohort[0]."' AND cohort_year = '".$cohort[1]."'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);   
        if($resultCheck > 0){
          $sql_cred = "SELECT * FROM `crsecredits_extra` WHERE crse_major = '{$cohort[0]}' AND cohort_year = {$cohort[1]}";
          $result_cred = mysqli_query($conn, $sql_cred);
          $resultCheck_cred = mysqli_num_rows($result_cred);
          $row_cred = mysqli_fetch_assoc($result_cred);
          echo "
          <script>
          document.getElementById('dept').value = `{$cohort[0]}`;
          if(save_method == 'Editar'){
          document.getElementById('cohort_year').value = '{$cohort[1]}';}
          document.getElementById('cred_dept').value = '{$row_cred['crseCredits_dept']}';
          document.getElementById('cred_free').value = '{$row_cred['crseCredits_free']}';
          document.getElementById('cred_ciso').value = '{$row_cred['crseCredits_ciso']}';
          document.getElementById('cred_huma').value = '{$row_cred['crseCredits_huma']}';";
          while($row = mysqli_fetch_assoc($result)){
            echo "
            concentracion.push(['".$row['crse_code']."', '".$row['crse_description']."', '".$row['crse_credits']."']);
            class_arr.push(['".$row['crse_code']."', '".$row['crse_year']."', '".$row['crse_semester']."']);
            ";
            echo "
            var table = document.getElementById('concentracion-table').innerHTML;
          document.getElementById('concentracion-table').innerHTML = `";
          echo '
            ${table}';
            echo "
            <tr>
            <td id='con_code'>".$row['crse_code']."</td>
            <td id='con_des'>".$row['crse_description']."</td>
            <td id='con_cred'>".$row['crse_credits']."</td>";
            echo '
            <td onClick=';
            echo "eli_con(";
            echo "'".$row['crse_code']."')";
            echo '" style="cursor: pointer">X</td>
            </tr>`;
            ';
            $sql_PC = "SELECT * FROM `scheme` WHERE crse_major = '{$cohort[0]}' AND cohort_year = '{$cohort[1]}' AND crse_code = '{$row['crse_code']}'";
            $result_PC = mysqli_query($conn, $sql_PC);
            $resultCheck_PC = mysqli_num_rows($result_PC);

            if ($resultCheck_PC > 0){
              $row_PC = mysqli_fetch_assoc($result_PC);
                if ($row_PC['crse_PRE'] != NULL && $row_PC['crse_CO'] != NULL){
                  echo "
                  arr.push(['{$row['crse_code']}', '{$row_PC['crse_PRE']}', '{$row_PC['crse_CO']}']);";
                  } else if ($row_PC['crse_PRE'] != NULL && $row_PC['crse_CO'] === NULL){
                    echo "
                      arr.push(['{$row['crse_code']}', '{$row_PC['crse_PRE']}', '-']);";
                      } else if($row_PC['crse_CO'] != NULL && $row_PC['crse_PRE'] === NULL){
                        echo "
                          arr.push(['{$row['crse_code']}', '-', '{$row_PC['crse_PRE']}']);";
                          } 
                  
            }
            echo "
            list = document.getElementById('clases').innerHTML;
            document.getElementById('clases').innerHTML = `";
            echo '
                            ${list}
                            <li style="margin-left:20px; font-size: 0.6em; cursor: pointer" onclick="viewClase(';
                            echo "'{$row['crse_code']}'";
                            echo ')">';
                            echo "{$row['crse_code']}</li>
                          `;";
          }
          
        }
        echo "
        </script>";

        $sql = "SELECT * 
  FROM cohort INNER JOIN general_courses USING (crse_code)
  WHERE crse_major = '".$cohort[0]."' AND cohort_year = '".$cohort[1]."'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);   
        if($resultCheck > 0){
          echo "
          <script>";
          while($row = mysqli_fetch_assoc($result)){
            echo "
            general.push(['".$row['crse_code']."', '".$row['crse_description']."', '".$row['crse_credits']."']);
            class_arr.push(['".$row['crse_code']."', '".$row['crse_year']."', '".$row['crse_semester']."']);
            ";
            echo "
            var table = document.getElementById('general-table').innerHTML;
          document.getElementById('general-table').innerHTML = `";
          echo '
            ${table}';
            echo "
            <tr>
            <td id='gen_code'>".$row['crse_code']."</td>
            <td id='gen_des'>".$row['crse_description']."</td>
            <td id='gen_cred'>".$row['crse_credits']."</td>";
            echo '
            <td onClick=';
            echo "eli_gen(";
            echo "'".$row['crse_code']."')";
            echo '" style="cursor: pointer">X</td>
            </tr>`;
            ';
            $sql_PC = "SELECT * FROM `scheme` WHERE crse_major = '{$cohort[0]}' AND cohort_year = '{$cohort[1]}' AND crse_code = '{$row['crse_code']}'";
            $result_PC = mysqli_query($conn, $sql_PC);
            $resultCheck_PC = mysqli_num_rows($result_PC);

            if ($resultCheck_PC > 0){
              $row_PC = mysqli_fetch_assoc($result_PC);
                if ($row_PC['crse_PRE'] != NULL && $row_PC['crse_CO'] != NULL){
                  echo "
                  arr.push(['{$row['crse_code']}', '{$row_PC['crse_PRE']}', '{$row_PC['crse_CO']}']);";
                  } else if ($row_PC['crse_PRE'] != NULL && $row_PC['crse_CO'] === NULL){
                    echo "
                      arr.push(['{$row['crse_code']}', '{$row_PC['crse_PRE']}', '-']);";
                      } else if($row_PC['crse_CO'] != NULL && $row_PC['crse_PRE'] === NULL){
                        echo "
                          arr.push(['{$row['crse_code']}', '-', '{$row_PC['crse_PRE']}']);";
                          } 
                  
            }
            echo "
            list = document.getElementById('clases').innerHTML;
            document.getElementById('clases').innerHTML = `";
            echo '
                            ${list}
                            <li style="margin-left:20px; font-size: 0.6em; cursor: pointer" onclick="viewClase(';
                            echo "'{$row['crse_code']}'";
                            echo ')">';
                            echo "{$row['crse_code']}</li>
                          `;";
          }
        }

        echo "
        </script>";}
}
?>
</html>