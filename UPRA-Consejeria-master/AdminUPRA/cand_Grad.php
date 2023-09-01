<?php
session_start();
include("inc/connection.php");
$advisor_id= $_SESSION['adv_email'];
$advisor_name = $_SESSION['adv_name'];

$sql = "SELECT adv_major FROM `advisor` WHERE adv_email = '$advisor_id'";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
  $row = mysqli_fetch_assoc($result);
  $cohort = $row['adv_major'];
}
if(!isset($advisor_id)){
  header("Location: index.php");
    exit();
}
$i = 0;
$sql = "SELECT stdnt_number, stdnt_email 
FROM student INNER JOIN record_details USING (stdnt_number)
WHERE record_status != 0 AND stdnt_major = '$cohort'";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);
                  if($resultCheck > 0){
                    while($row = mysqli_fetch_assoc($result)){
            
                $sum = "SELECT 131 - SUM(SUMA) AS sum FROM (
                  SELECT SUM(crse_credits) AS SUMA
                  FROM mandatory_courses INNER JOIN  stdnt_record USING(crse_code)
                  WHERE stdnt_number = '{$row['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' 
                                        OR crse_grade = 'C' OR crse_grade = 'P')
    		UNION  ALL
                 SELECT SUM(crse_credits) AS SUMA
                 FROM general_courses INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                          OR crse_grade = 'D' OR crse_grade = 'P')
			UNION ALL
                 SELECT SUM(crse_credits) AS SUMA
                 FROM departmental_courses INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                        OR crse_grade = 'D' OR crse_grade = 'P')
            UNION ALL
                 SELECT SUM(crse_credits) AS SUMA
                 FROM free_courses INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                        OR crse_grade = 'D' OR crse_grade = 'P')
            UNION ALL
                 SELECT SUM(crse_credits) AS SUMA 
                 FROM general_education_ciso INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                        OR crse_grade = 'D' OR crse_grade = 'P')
            UNION ALL
                 SELECT SUM(crse_credits) AS SUMA
                 FROM general_education_huma INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                        OR crse_grade = 'D' OR crse_grade = 'P')) t1";
                   
                  $sum_result = mysqli_query($conn, $sum);
                  $sum_resultCheck = mysqli_num_rows($sum_result);
                  
                  if($sum_resultCheck > 0){
                    $creditos = mysqli_fetch_assoc($sum_result);
                    if(($creditos['sum'] <= 21) && ($creditos['sum'] != NULL)){
                      $grad_stdnts[$i] = $row['stdnt_email'];
                      $i++;
                    }
                  }else{
                      $resultado = 0;
                    }
                }
              }
              
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CONSEJERÍA-UPRA | NO-REALIZAR</title>

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

  <style>
    #drop_zone {
            background-color: #EEE;
            border: #999 5px dashed;
            width: 100%;
            height: 30rem;
            padding: 8px;
            font-size: 18px;
        }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
    <a href="inicio.php" class="brand-link">
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
          <?php echo "<a class='d-block'>{$row['adv_name']} {$row['adv_lastname']}</a>" ?>
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
            <a onclick="document.getElementById('id04').style.display='block'" href="#" class="nav-link">
               <i class="fas fa-table"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Editar/Crear Estudiante</p>
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
            <h1>Estudiantes Candidatos a Graduación:</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Candidatos a Graduación</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
            <div align='center'><h3>CORREOS ELECTRÓNICOS</h3></div>
            <?php
            $count = 0;
            if (isset($grad_stdnts)) {
            foreach($grad_stdnts as $grad_stdnt){
            $count++;
            echo "
                &nbsp;&nbsp;&nbsp;&nbsp;<th>$grad_stdnt</th><br>";
                
        }
      }
        if($count == 0){
                echo "
              <div class='error-message'><h4 style='text-align:center'>¡No hay candidatos a graduación!</h4></div>";
        }
      ?>
            <br>
        </div>
      </div>
    </section>
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
    <!----------------------------------------- Editar/Crear Estudiante -------------------------------------------------->
    <div id='id04' class='w3-modal' style='padding-left:20%'>
            <div class='w3-modal-content w3-animate-zoom'>
              <header class='w3-container' style='padding-top:5px'>
                <span onclick='document.getElementById("id04").style.display="none"'
                class='w3-button w3-display-topright'>&times;</span>
                <h3>Editar/Crear Estudiante</h3>
              </header>
              <div class='w3-container'>
                  <br>
                  <div class="grid-container" style="margin-left: auto; margin-right: auto">
                <div class='item-1'>
                          <button name="submit" onClick="subir_est('Automatico')" class='btn btn-primary' style="width: 100%; color: white">Automatico</button>
                  </div> 
                <div class='item-2'>
                          <button onClick="subir_est('Manual')" name="submit" class='btn btn-warning' style="width: 100%; color: white">Manual</button>
                  </div>
                  </div>
                  <div id="editar_est">
                  
                  </div>
            </div>
          </div><!-- /.Estudiante -->
  </div>
    <!-- /.modales -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a>CONSEJERÍA-UPRA</a>.</strong> All rights reserved.
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!--SCRIPT DE Editar/Crear Estudiante  -->
<script>
function subir_est(subida) {
    if (subida == "Automatico"){
      document.getElementById('editar_est').innerHTML = `<form action="" method="POST">
                  <div>
                          <input type="file" name="uploadedFile" />
                  </div>
                  </form>`;
                  document.getElementById("est_submit").innerHTML = ``;
    }else if(subida == "Manual") {
      document.getElementById('editar_est').innerHTML = `<form action="inc/manual_stdnt.php" method="POST"> <div class='input-group mb-3'>
                  <select name='inicio' style="width: 100%; height: 30px; border-color: #d3d3d3; border-style:solid; border-width: 1px; border-radius: 5px">
                  <option>Regular</option>
                  <option>Traslado</option>
                  <option>Transferencia</option>
                  <option>Readmision</option>
                  <option>Reclasificación</option>
                  </select>
                  <br>
                          <input type='text' name='stdnt_email' class='form-control' placeholder='Student Email'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-comment-dots'></span>
                            </div>
                          </div>
                        </div>
                  <div class='input-group mb-3'>
                          <input type='text' name='stdnt_number' class='form-control' placeholder='Student Number'>
                          <input type='text' name='stdnt_password' class='form-control' placeholder='Password'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-comment-dots'></span>
                            </div>
                          </div>
                        </div>
                  <div class='input-group mb-3'>
                          <input type='text' name='stdnt_name' class='form-control' placeholder='First Name'>
                          <input type='text' name='stdnt_initial' class='form-control' placeholder='Initial'>
                          <input type='text' name='stdnt_lastname1' class='form-control' placeholder='Last Name'>
                          <input type='text' name='stdnt_lastname2' class='form-control' placeholder='Maiden Name'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-comment-dots'></span>
                            </div>
                          </div>
                        </div>
                        <select name='cohort_year' style="width: 100%; height: 30px; border-color: #d3d3d3; border-style:solid; border-width: 1px; border-radius: 5px">
                        <?php
                        $sql = "SELECT DISTINCT cohort_year FROM `cohort` WHERE crse_major = '$cohort'";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0) {
                          $row = mysqli_fetch_assoc($result);
                          echo "<option value='{$row['cohort_year']}'>{$row['cohort_year']}</option>";
                        }
                        ?>
                          </select>
              </div>
              <footer class='w3-container' style='padding-bottom:10px; padding-top:10px'>
      <button type='submit' class='btn btn-default' name="Manual" value="Upload" onclick='history.go(0)' style='float:right; '>APLICAR</button>
              </footer></form>`;
    }
  }
</script>
<!-- END SCRIPT DE Editar/Crear Estudiante  -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>