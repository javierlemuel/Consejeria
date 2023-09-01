<?php
session_start();
include("inc/connection.php");

if(isset($_GET["stdnt_number"])){
  $student_id = $_GET['stdnt_number'];
} else {
  $student_id = $_SESSION['stdnt_number'];
}
$advisor_id = $_SESSION['adv_email'];

if(!isset($_SESSION['adv_email'])){
  header("Location: index.php");
    exit();
}
$stdnt_number = $_GET['stdnt_number'];
$sql = "SELECT adv_major FROM `advisor` WHERE adv_email = '$advisor_id'";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
  $row = mysqli_fetch_assoc($result);
  $cohort = $row['adv_major'];
}


$query = "SELECT * FROM stdnt_record WHERE  stdnt_number = $stdnt_number";
$result = mysqli_query($conn, $query);
$resultCheck = mysqli_num_rows($result);
$query = "SELECT cohort_year FROM student WHERE  stdnt_number = '$stdnt_number'";
$result = mysqli_query($conn, $query);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
  $row = mysqli_fetch_assoc($result);
  $yearofcohort = $row['cohort_year'];
}

$isRecordPresentInDB = FALSE;

if($resultCheck > 0)
  $isRecordPresentInDB = TRUE;

    $modal = 'document.getElementById("Acomodar").style.display="block"';
?>
 <!-- script to determine equivalencia/convalidacion -->
 <script>
          function edit(){
                    document.getElementById('id01').style.display='block';
          }
          function myFunction(className) {
                    console.log(className); 
                    document.getElementById("og_crse").value = className;
                    document.getElementById('Acomodar').style.display='block';
          }
          function equi_conv(elmnt,tabla) {
            if(tabla == 'mandatory_courses'){
              var x = document.getElementById("mand");
              var y = document.getElementById("mandatory");
            if ((x.style.display === "block") && (y.style.display === "block")) {
              x.style.display = "none";
              y.style.display = "none";
            } else {
              x.style.display = "block";
              y.style.display = "block";
            }
            var x = document.getElementById("gen");
            var y = document.getElementById("general");
            if (x.style.display === "block") {
              x.style.display = "none";
            }
            if (y.style.display === "block") {
              y.style.display = "none";
            }
            var x = document.getElementById("dept");
            var y = document.getElementById("depart");
            if (x.style.display === "block") {
              x.style.display = "none";
            } 
            if (y.style.display === "block") {
              y.style.display = "none";
            }
            var y = document.getElementById("free");
            if (y.style.display === "block") {
              y.style.display = "none";
            }
          }else if(tabla == 'general_courses'){
            var x = document.getElementById("gen");
            var y = document.getElementById("general");
            if ((x.style.display === "block") && (y.style.display === "block")) {
              x.style.display = "none";
              y.style.display = "none";
            } else {
              x.style.display = "block";
              y.style.display = "block";
            }
            var x = document.getElementById("mand");
            var y = document.getElementById("mandatory");
            if (x.style.display === "block") {
              x.style.display = "none";
            }
            if (y.style.display === "block") {
              y.style.display = "none";
            }
            var x = document.getElementById("dept");
            var y = document.getElementById("depart");
            if (x.style.display === "block") {
              x.style.display = "none";
            } 
            if (y.style.display === "block") {
              y.style.display = "none";
            }
            var y = document.getElementById("free");
            if (y.style.display === "block") {
              y.style.display = "none";
            }
          }else if(tabla == 'departamental_courses'){
            var x = document.getElementById("dept");
            var y = document.getElementById("depart");
            if ((x.style.display === "block") && (y.style.display === "block")) {
              x.style.display = "none";
              y.style.display = "none";
            } else {
              x.style.display = "block";
              y.style.display = "block";
            }
            var x = document.getElementById("mand");
            var y = document.getElementById("mandatory");
            if (x.style.display === "block") {
              x.style.display = "none";
            }
            if (y.style.display === "block") {
              y.style.display = "none";
            }
            var x = document.getElementById("gen");
            var y = document.getElementById("general");
            if (x.style.display === "block") {
              x.style.display = "none";
            }
            if (y.style.display === "block") {
              y.style.display = "none";
            }
            var y = document.getElementById("general");
            if (x.style.display === "block") {
              x.style.display = "none";
            }
            if (y.style.display === "block") {
              y.style.display = "none";
            }
            var y = document.getElementById("free");
            if (y.style.display === "block") {
              y.style.display = "none";
            }
          }else{
            var y = document.getElementById("free");
            if (y.style.display === "block") {
              y.style.display = "none";
            } else {
              y.style.display = "block";
            }
            var x = document.getElementById("mand");
            var y = document.getElementById("mandatory");
            if (x.style.display === "block") {
              x.style.display = "none";
            }
            if (y.style.display === "block") {
              y.style.display = "none";
            }
            var x = document.getElementById("gen");
            var y = document.getElementById("general");
            if (x.style.display === "block") {
              x.style.display = "none";
            }
            if (y.style.display === "block") {
              y.style.display = "none";
            }
            var x = document.getElementById("dept");
            var y = document.getElementById("depart");
            if (x.style.display === "block") {
              x.style.display = "none";
            }
            if (y.style.display === "block") {
              y.style.display = "none";
            }
          }
          }
          </script>
<!--*************Agregar general_courses_major, general_education_ciso,general_education_huma****************-->


<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CONSEJERÍA-UPRA | EXP-EST</title>
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
    #drop_zone {
            background-color: #EEE;
            border: #999 5px dashed;
            width: 100%;
            height: 30rem;
            padding: 8px;
            font-size: 18px;
        }

.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
  grid-gap: 10px;
  background-color: transparent;
  padding: 10px;
}

.grid-item > div {
  background-color: transparent;
  text-align: center;
  padding: 20px 0;
  font-size: 30px;
}

@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro);

body {
  background: #ffffff; 
  color: #414141;
  font: 400 17px/2em 'Source Sans Pro', sans-serif;
}

.select-box {
  cursor: pointer;
  position : relative;
  max-width:  20em;
  margin: 1rem auto;
  width: 100%;
}


#course-list {
  background-color: #d3d3d3;
  padding: 0.5rem 1rem;
  width: 100%;
  border-radius: 0.5rem;
    font-size: 1.25rem;
}

.select,
.label {
  color: #414141;
  display: block;
  font: 400 17px/2em 'Source Sans Pro', sans-serif;
}

.select {
  width: 100%;
  position: absolute;
  top: 0;
  padding: 5px 0;
  height: 40px;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  background: none transparent;
  border: 0 none;
}
.select-box1 {
  background: #ececec;

}
.label {
  position: relative;
  padding: 5px 10px;
  cursor: pointer;
}
.open .label::after {
   content: "▲";
}
.label::after {
  content: "▼";
  font-size: 12px;
  position: absolute;
  right: 0;
  top: 0;
  padding: 5px 15px;
  border-left: 5px solid #fff;
}
.leyenda{
  border: none;
  padding: 10px 20px;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 16px;
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
<!-- Sidebar user -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">

<!--Hice Cambio de adv_id a adv_email-->
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
    </div><!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Expediente Académico del Estudiante</h1></div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Expediente Académico del Estudiante</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary" style="border-top: 3px solid #e0c200;">
              <div class="card-body box-profile">
                    <?php

          $sql_dos = "SELECT *
            FROM student INNER JOIN record_details USING (stdnt_number)
            WHERE record_status != 0 AND stdnt_major = '$cohort' AND cohort_year = '$yearofcohort' AND stdnt_number = '$student_id'";
                  $result_dos = mysqli_query($conn, $sql_dos);
                  $resultCheck_dos = mysqli_num_rows($result_dos);
                  $row_dos = mysqli_fetch_assoc($result_dos);
            
                $sum = "SELECT 131 - SUM(SUMA) AS sum FROM (
                  SELECT SUM(crse_credits) AS SUMA
                  FROM mandatory_courses INNER JOIN  stdnt_record USING(crse_code)
                  WHERE stdnt_number = '{$row_dos['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' 
                                        OR crse_grade = 'C' OR crse_grade = 'P')
    		UNION  ALL
                 SELECT SUM(crse_credits) AS SUMA
                 FROM general_courses INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row_dos['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                          OR crse_grade = 'D' OR crse_grade = 'P')
			UNION ALL
                 SELECT SUM(crse_credits) AS SUMA
                 FROM departmental_courses INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row_dos['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                        OR crse_grade = 'D' OR crse_grade = 'P')
            UNION ALL
                 SELECT SUM(crse_credits) AS SUMA
                 FROM free_courses INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row_dos['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                        OR crse_grade = 'D' OR crse_grade = 'P')
            UNION ALL
                 SELECT SUM(crse_credits) AS SUMA 
                 FROM general_education_ciso INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row_dos['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                        OR crse_grade = 'D' OR crse_grade = 'P')
            UNION ALL
                 SELECT SUM(crse_credits) AS SUMA
                 FROM general_education_huma INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_number = '{$row_dos['stdnt_number']}' AND (crse_grade = 'A' OR crse_grade = 'B' OR crse_grade = 'C'
                                        OR crse_grade = 'D' OR crse_grade = 'P')) t1";
                   
                  $sum_result = mysqli_query($conn, $sum);
                  $sum_resultCheck = mysqli_num_rows($sum_result);   
                  $sum_row = mysqli_fetch_assoc($sum_result);
                        
                        if($sum_row <= 34)
                            $A = date('Y') + 3;
                        elseif ($sum_row >= 34 && $sum_row <= 66)
                            $A = date('Y') + 2;
                        elseif ($sum_row >= 66 && $sum_row <= 98)
                            $A = date('Y') + 1;
                        else 
                            $A = date('Y');
                    $sql = "SELECT *
                    FROM student WHERE stdnt_number = '$student_id'";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);
         
                $sentenciaSQL= "SELECT SUM(C)
                FROM ((SELECT crse_credits AS C
                FROM mandatory_courses
                INNER JOIN  stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id')
                UNION ALL
                (SELECT crse_credits AS C
                FROM general_courses
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id')
                UNION ALL (SELECT crse_credits AS C
                FROM departmental_courses
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id')
                UNION ALL
                (SELECT crse_credits AS C
                FROM general_education_ciso
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id')
                UNION ALL
                (SELECT crse_credits AS C
                FROM general_education_huma
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id')
                UNION ALL (SELECT crse_credits AS C
                FROM free_courses
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id')) t1";
                $resultSUM = mysqli_query($conn, $sentenciaSQL);
                $creditos=mysqli_fetch_assoc($resultSUM);
                if ($creditos['SUM(C)'] === NULL){
                  $creditos['SUM(C)']=0;
              }
           
            
              if($resultCheck > 0){
              $row = mysqli_fetch_assoc($result);
              $año = date('Y')-(substr($row['stdnt_number'], 4,2) + 1999);
               echo "<h3 class='profile-username text-center'>{$row['stdnt_name']} {$row['stdnt_lastname1']} {$row['stdnt_lastname2']}</h3>
                <p class='text-muted text-center'>{$row['stdnt_email']}</p>
                <p class='text-muted text-center'>{$row['stdnt_number']}</p>       
               <ul class='list-group list-group-unbordered mb-3'>
                  <li class='list-group-item'>
                    <b>Créditos Aprobados</b> <a class='float-right'>{$creditos['SUM(C)']}</a>
                  </li>
                  <li class='list-group-item'>
                    <b>Año</b> <a class='float-right'>$año</a>
                  </li>
                  <li class='list-group-item'>
                    <b>Secuencia:</b> <a class='float-right'>{$row['stdnt_major']}</a>
                  </li>
                  <li class='list-group-item'>
                    <b>Posible año de Graduación:</b> <a class='float-right'>$A</a>
                  </li>
                   
                </ul>
                <button onClick='edit()' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%;'>Editar</button>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->";
            if ($row_dos['conducted_counseling'] == 1){
            echo "<form action='inc/act_cons.php' method='POST'><button type='submit' name='activate' value='$student_id' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%;'>Activar Consejería</button>
            <br><br></form>";
            }
            echo "
            <h3 style='text-align:center'>Concentración Menor: </h3>
            <div class='grid-container' style='margin-top:0px'>
            <form action='inc/minor.php' method='POST'>
            <button type='submit' value='0' name='minor-submit' class='btn btn-danger btn-sm' href='#''>
               <i class='fas fa-user-times'></i>
                NO
            </button>
          <button type='submit' value='1' name='minor-submit' class='btn btn-info btn-sm' href='#'>
          <i class='fas fa-user-plus'></i>
          SI &nbsp;&nbsp;&nbsp;
      </button></form>";
      if ($row_dos['stdnt_minor']) {
        echo "Activo";
      }else {
        echo "Inactivo";
      }
      echo "
      </div> <br>
            <!-- About Me Box -->
            <div class='card' >
              <div class='card-header' style='background: #e0c200'>
                <h3 class='card-title' >Comentarios</h3>
              </div>
              <!-- /.card-header -->
              <div>
              <form id='paper' method='POST' action='inc/notespost.php'>
           <textarea placeholder='Escribe una nota aqui.' id='text' name='text' value='' rows='' style='overflow-y: auto; word-wrap: break-word; resize: none; height: 320px;'></textarea>
           <input type='hidden' name='id' value='$student_id'>   
           </div><button type='submit' name='notes-submit' onclick='notes-submit()' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%;'> Realizar Comentario</button>
              </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>";
              }
          ?>
          <!-- /.col -->
          <div class="card" id="style-2" style="overflow-y: scroll; overflow-x: auto; height: 850px; width: 75%;border-top: 3px solid #e0c200;"> 
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div align='center'><h3>UNIVERSIDAD DE PUERTO RICO EN ARECIBO</h3>
                                    <h3>DEPARTAMENTO DE CIENCIAS DE CÓMPUTOS</h3>
                                    <h3>EVALUACIÓN BACHILLERATO EN CIENCIAS DE CÓMPUTOS</h3></div>
            </div>
                
                <!-- /.Comienzo de file del student -->
            <div class="container tables">
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'file')">Expediente del Estudiante</button>
                    <button class="tablinks" onclick="openCity(event, 'Leyendas')">Leyendas</button>
                    <button class="tablinks" onclick="openCity(event, 'Historial')">Historial</button>
                  </div>
                
                  <!-- Tab content -->
    <div id="file" class="tabcontent active">
    <section class="content">
    <?php
    $sql = "SELECT stdnt_number, stdnt_email, stdnt_lastname1, stdnt_lastname2, stdnt_name, stdnt_initial, stdnt_major,cohort_year
                    FROM student WHERE stdnt_number = '$student_id'";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);
     
                $sentenciaSQL= "SELECT SUM(C)
                FROM ((SELECT crse_credits AS C
                FROM mandatory_courses
                INNER JOIN  stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id' AND stdnt_record.crse_status = 3)
                UNION ALL
                (SELECT crse_credits AS C
                FROM general_courses
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id' AND stdnt_record.crse_status = 3)
                UNION ALL 
                (SELECT crse_credits AS C
                FROM departmental_courses
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id' AND stdnt_record.crse_status = 3)
                UNION ALL 
                (SELECT crse_credits AS C
                FROM general_education_ciso
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id' AND stdnt_record.crse_status = 3)
                UNION ALL
                (SELECT crse_credits AS C
                FROM general_education_huma
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id' AND stdnt_record.crse_status = 3)
                UNION ALL
                (SELECT crse_credits AS C
                FROM free_courses
                INNER JOIN stdnt_record USING(crse_code)
                WHERE stdnt_record.stdnt_number = '$student_id' AND stdnt_record.crse_status = 3)) t1";
                $resultSUM = mysqli_query($conn, $sentenciaSQL);
                $creditos=mysqli_fetch_assoc($resultSUM);
               if($creditos['SUM(C)'] < 1){
                  $creditos['SUM(C)'] = 0;
               }
           
              if($resultCheck > 0){
                if ($row_dos['conducted_counseling'] == 0){
                if($creditos['SUM(C)'] <= 11){
              echo "
              <div class='error-message'><h4 style='text-align:center'>¡Recomendar más créditos!&nbsp;&nbsp;&nbsp;El código recomienda : {$creditos['SUM(C)']} créditos</h4></div>";
                } else if ($creditos['SUM(C)'] > 21){
                  echo "
              <div class='error-message'><h4 style='text-align:center'>¡Recomendar menos créditos!&nbsp;&nbsp;&nbsp;El código recomienda : {$creditos['SUM(C)']} créditos</h4></div>";
                }
              }
            }
              ?> 
      <div class="card-body">
                <div align = "center"><h3>Cursos de Concentración</h3></div>
                <br>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/<br>Equivalencia</th>
                  </tr>
                  </thead>
                  <tbody>             
                      
                      
                  <?php
                  $sql = "SELECT *
                      FROM mandatory_courses INNER JOIN cohort USING (crse_code)
                      WHERE crse_major = '$cohort' AND cohort_year = '$yearofcohort'";
                      $result = mysqli_query($conn, $sql);
                      $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    
                     $sql_S ="SELECT *
                      FROM mandatory_courses INNER JOIN stdnt_record USING (crse_code) 
                      WHERE stdnt_number = '$student_id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                      $row_S = mysqli_fetch_assoc($result_S);
                    
                    
                if($row_S['crseR_status'] == 0){
                    $color = '#eeddd2';
                   }elseif($row_S['crseR_status'] == 1){
                    $color = '#995d2d';
                   }elseif($row_S['crseR_status'] == 2){
                    $color = '#c69b7c';
                  }elseif($row_S['crseR_status'] == NULL){
                    $color = '';
                  }
                  if($row_S['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: #e1e9f4'>"; 
                  }else if ($row_S['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: #a5bfde'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: #6496c8'>";
                  }
         
                 
                    echo "
                    <td> {$row['crse_code']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row_S['crse_grade']}</td>
                    ";
                    if($row_S['crse_status'] == 3){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    } else if($row_S['crse_status'] == 2){
                        echo "
                      <td><a class='w3-button w3-round-xlarge' style='color:white; background-color:#faa85f;  width : 100%'>Matriculado</a></td>
                    ";}
                    else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row_S['semester_pass']}</td>";
                    if($row_S['crse_equivalence'] != NULL || $row_S['crse_recognition'] != NULL){
                      echo"
                      <td style='background-color:$color; color: white'>{$row_S['crse_equivalence']}{$row_S['crse_recognition']}</td>";
                    }else{
                      echo" 
                      <td><button onclick='myFunction(`{$row['crse_code']}`)' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%'>Acomodar</button></td>";
                    }
                  echo "</tr> ";}}?>
                </tbody>
                  </table>
                  <br>
                 
          
          
          
          
          
          
          <div align = "center"><h3>Cursos Generales Obligatorios</h3></div>
                  <!-- <form action='inc/recommend.php' method='POST'> 
                      
                    <?php
                    // echo  "<input type='hidden' value='$student_id' name='stdnt_number'>";
                    ?>
                   <button type='submit' name='rec-adi' value='crse_suggestionCISO' onclick="" class="w3-button w3-round-xlarge" style="color:white; width : 25%; margin:10px; margin-left:24%; background-color: rgb(253, 118, 100);">Recomendación Adicional CISO</button>
                   <button type='submit' name='rec-adi' value='crse_suggestionHUMA' onclick="" class="w3-button w3-round-xlarge" style="color:white; width : 25%; margin:10px; background-color: rgb(253, 118, 100);">Recomendación Adicional HUMA</button>
                   </form> -->
                  <br>
                    <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/<br>Equivalencia</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                    
                    $sql =" SELECT *
                    FROM GENERAL_courses JOIN cohort USING (crse_code)
                    WHERE crse_major = '$cohort' AND cohort_year = '$yearofcohort'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
    
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    
                     $sql_S ="SELECT *
                      FROM general_courses  JOIN stdnt_record USING (crse_code)
                      WHERE stdnt_number = '$student_id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                      $row_S = mysqli_fetch_assoc($result_S);
                  if($row_S['crseR_status'] == 0){
                    $color = '#eeddd2';
                   }elseif($row_S['crseR_status'] == 1){
                    $color = '#995d2d';
                   }elseif($row_S['crseR_status'] == 2){
                    $color = '#c69b7c';
                  }elseif($row_S['crseR_status'] == NULL){
                    $color = '';
                  }
                  if($row_S['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: #e1e9f4'>"; 
                  }else if ($row_S['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: #a5bfde'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: #6496c8'>";
                  }
                    
                    echo "<td>{$row['crse_code']}</td> 
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row_S['crse_grade']}</td>
                    ";
                    if($row_S['crse_status'] == 3){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 2){
                      echo "
                    <td><a class='w3-button w3-round-xlarge' style='color:white; background-color:#faa85f;  width : 100%'>Matriculado</a></td>
                  ";}
                    else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row_S['semester_pass']}</td>";
                    if($row_S['crse_equivalence'] != NULL || $row_S['crse_recognition'] != NULL){
                      echo"
                      <td style='background-color:$color; color: white'>{$row_S['crse_equivalence']}{$row_S['crse_recognition']}</td>";
                    }else{
                      echo"
                      <td><button onclick='myFunction(`{$row['crse_code']}`)' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%'>Acomodar</button></td>";
                    }
                  echo "</tr> ";}}?>
                </tbody>
                  </table>
                  <br>
          <div align = "center"><h3>Electivas Libres</h3></div>
                  <!-- <form action='inc/recommend.php' method='POST'>
                   <?php
                    // echo  "<input type='hidden' value='$student_id' name='stdnt_number'>";
                    ?>
                   <button type='submit' name='rec-adi' value='crse_suggestionFREE' onclick="" class="w3-button w3-round-xlarge" style="color:white; width : 45%; margin:10px; margin-left:27%; background-color: rgb(253, 118, 100);">Recomendación Adicional</button>
                   </form> -->
                   <br>
                    <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/<br>Equivalencia</th>
                  </tr>
                  </thead>
                <tbody>
            <?php
          
                    $sql ="SELECT *
                    FROM free_courses INNER JOIN stdnt_record USING (crse_code) WHERE stdnt_number = '$student_id'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $crse = "{$row['crse_code']}";
                  if($row['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: #e1e9f4'>"; 
                  }else if ($row['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: #a5bfde'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: #6496c8'>";
                  }
                    echo "<td>{$row['crse_code']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>
                    ";
                    
                    if($row['crse_status'] == 3){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 2){
                      echo "
                    <td><a class='w3-button w3-round-xlarge' style='color:white; background-color:#faa85f;  width : 100%'>Matriculado</a></td>
                  ";}
                    else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row['semester_pass']}</td>
                    <td><button onclick='myFunction(`{$row['crse_code']}`)' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%'>Acomodar</button></td>
                  </tr>";}}?>
                </tbody>
                  </table>
                  <br>
                
          
                    <div align = "center"><h3>Electivas Departamentales</h3></div>
                   <!-- <form action='inc/recommend.php' method='POST'>
                   <?php
                    // echo  "<input type='hidden' value='$student_id' name='stdnt_number'>";
                    ?>
                   <button type='submit' name='rec-adi' value='crse_suggestionDEP' onclick="" class="w3-button w3-round-xlarge" style="color:white; width : 45%; margin:10px; margin-left:27%; background-color: rgb(253, 118, 100);">Recomendación Adicional</button>
                   </form> -->
                   <br>
                    <table id="example2" class="table table-bordered table-hover">
                     <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/<br>Equivalencia</th>
                  </tr>
                  </thead>
                <tbody>
                <?php
                
                $sql ="SELECT * 
                FROM departmental_courses WHERE crse_major = '$cohort'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $sql_S ="SELECT * 
                        FROM departmental_courses INNER JOIN stdnt_record USING (crse_code)
                        WHERE stdnt_number = '$student_id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                    
                      $row_S = mysqli_fetch_assoc($result_S);
                    
            if($row_S['crseR_status'] == 0){
                    $color = '#eeddd2';
                   }elseif($row_S['crseR_status'] == 1){
                    $color = '#995d2d';
                   }elseif($row_S['crseR_status'] == 2){
                    $color = '#c69b7c';
                  }elseif($row_S['crseR_status'] == NULL){
                    $color = '';
                  }
                  if($row_S['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: #e1e9f4'>"; 
                  }else if ($row_S['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: #a5bfde'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: #6496c8'>";
                  }
                    
                    echo "<td>{$row['crse_code']}</td> 
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row_S['crse_grade']}</td>
                    ";
                    if($row_S['crse_status'] == 3){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 2){
                      echo "
                    <td><a class='w3-button w3-round-xlarge' style='color:white; background-color:#faa85f;  width : 100%'>Matriculado</a></td>
                  ";}
                    else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row_S['semester_pass']}</td>";
                    if($row_S['crse_equivalence'] != NULL || $row_S['crse_recognition'] != NULL){
                      echo"
                      <td style='background-color:$color; color: white'>{$row_S['crse_equivalence']}{$row_S['crse_recognition']}</td>";
                    }else{
                      echo"
                      <td><button onclick='myFunction(`{$row['crse_code']}`)' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%'>Acomodar</button></td>";
                    }
                  echo "</tr> ";}}?>
                </tbody>
                  </table>
                  <br>        
          <div align = "center"><h3>Cursos Ciencias Sociales</h3></div>
                   <!-- <form action='inc/recommend.php' method='POST'>
                   <?php
                    // echo  "<input type='hidden' value='$student_id' name='stdnt_number'>";
                    ?>
                   <button type='submit' name='rec-adi' value='crse_suggestionDEP' onclick="" class="w3-button w3-round-xlarge" style="color:white; width : 45%; margin:10px; margin-left:27%; background-color: rgb(253, 118, 100);">Recomendación Adicional</button>
                   </form> -->
                   <br>
                    <table id="example2" class="table table-bordered table-hover">
                     <thead>
                  <tr width="50%"  bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/<br>Equivalencia</th>
                  </tr>
                  </thead>
                <tbody>
                <?php
                
                $sql ="SELECT * 
                    FROM general_education_CISO";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $sql_S ="SELECT * 
                        FROM general_education_CISO INNER JOIN stdnt_record USING (crse_code)
                        WHERE stdnt_number = '$student_id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                      $resultCheck_S = mysqli_num_rows($result_S);
                      $row_S = mysqli_fetch_assoc($result_S);
                    
            if($row_S['crseR_status'] == 0){
                    $color = '#eeddd2';
                   }elseif($row_S['crseR_status'] == 1){
                    $color = '#995d2d';
                   }elseif($row_S['crseR_status'] == 2){
                    $color = '#c69b7c';
                  }elseif($row_S['crseR_status'] == NULL){
                    $color = '';
                  }
                  if($row_S['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: #e1e9f4'>"; 
                  }else if ($row_S['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: #a5bfde'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: #6496c8'>";
                  }
                    
                    echo "<td>{$row['crse_code']}</td> 
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row_S['crse_grade']}</td>
                    ";
                    if($row_S['crse_status'] == 3){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 2){
                      echo "
                    <td><a class='w3-button w3-round-xlarge' style='color:white; background-color:#faa85f;  width : 100%'>Matriculado</a></td>
                  ";}
                    else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row_S['semester_pass']}</td>";
                    if($row_S['crse_equivalence'] != NULL || $row_S['crse_recognition'] != NULL){
                      echo"
                      <td style='background-color:$color; color: white'>{$row_S['crse_equivalence']}{$row_S['crse_recognition']}</td>";
                    }else{
                      echo"
                      <td><button onclick='myFunction(`{$row['crse_code']}`)' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%'>Acomodar</button></td>";
                    }
                  echo "</tr> ";}}?>
                </tbody>
                  </table>
                  <br>  
          <div align = "center"><h3>Cursos Humanidades</h3></div>
                   <!-- <form action='inc/recommend.php' method='POST'>
                   <?php
                    // echo  "<input type='hidden' value='$student_id' name='stdnt_number'>";
                    ?>
                   <button type='submit' name='rec-adi' value='crse_suggestionDEP' onclick="" class="w3-button w3-round-xlarge" style="color:white; width : 45%; margin:10px; margin-left:27%; background-color: rgb(253, 118, 100);">Recomendación Adicional</button>
                   </form> -->
                   <br>
                    <table id="example2" class="table table-bordered table-hover">
                     <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/<br>Equivalencia</th>
                  </tr>
                  </thead>
                <tbody>
                <?php
                
                $sql ="SELECT * 
                    FROM general_education_HUMA";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $sql_S ="SELECT * 
                        FROM general_education_HUMA INNER JOIN stdnt_record USING (crse_code)
                        WHERE stdnt_number = '$student_id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                     
                      $row_S = mysqli_fetch_assoc($result_S);
                    
            if($row_S['crseR_status'] == 0){
                    $color = '#eeddd2';
                   }elseif($row_S['crseR_status'] == 1){
                    $color = '#995d2d';
                   }elseif($row_S['crseR_status'] == 2){
                    $color = '#c69b7c';
                  }elseif($row_S['crseR_status'] == NULL){
                    $color = '';
                  }
                  if($row_S['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: #e1e9f4'>"; 
                  }else if ($row_S['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: #a5bfde'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: #6496c8'>";
                  }
                    
                    echo "<td>{$row['crse_code']}</td> 
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row_S['crse_grade']}</td>
                    ";
                    if($row_S['crse_status'] == 3){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$student_id'>
                      <input type='hidden' id='crse_code' name='crse_code' value='{$row['crse_code']}'>
                      <input type='hidden' id='crseR_status' name='crseR_status' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    }else if($row_S['crse_status'] == 2){
                      echo "
                    <td><a class='w3-button w3-round-xlarge' style='color:white; background-color:#faa85f;  width : 100%'>Matriculado</a></td>
                  ";}
                    else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row_S['semester_pass']}</td>";
                    if($row_S['crse_equivalence'] != NULL || $row_S['crse_recognition'] != NULL){
                      echo"
                      <td style='background-color:$color; color: white'>{$row_S['crse_equivalence']}{$row_S['crse_recognition']}</td>";
                    }else{
                      echo"
                      <td><button onclick='myFunction(`{$row['crse_code']}`)' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%'>Acomodar</button></td>";
                    }
                  echo "</tr> ";}}?>
                </tbody>
                  </table>
                  <br>  
              </div>
    </section>
    </div><!-- /.Final de file del student -->  
<!-- Comienzo de Examinar -->  
   <div id="Examinar" class="tabcontent">
            <section>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Semestre Aprobó</th>
                    <th>Acomodar</th>
                  </tr>
                  </thead>
                <tbody>
                <?php
                    //code por label/name
                $sql ="SELECT *
                   FROM free_courses INNER JOIN stdnt_record USING (crse_code) WHERE stdnt_number = '$student_id'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                  
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $crse = "{$row['crse_code']}";
                  if($row['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: rgb(100,149,237,0.3)'>";
                  }else if ($row['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: rgb(237,99,124,0.3)'>";
                  }else{
                  echo "<tr width='50%'>";}
                    echo "<td>{$row['crse_code']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>
                    <td>{$row['semester_pass']}</td>
                    <td><button onclick='myFunction(`{$row['crse_code']}`)' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%'>Acomodar</button></td>
                  </tr>";}}?>
                </tbody>
                  </table>
            </section>    
         </div>
      </div><!-- /.Final de Examinar --> 
<!-- Comienzo de Leyendas -->
        <div id="Leyendas" class="tabcontent ">
            <section>
            <h1>Leyenda Estatus del Curso</h1>
            <i>Esta leyenda está relacionada con los colores de las filas dentro de los expedientes.</i>
            <div><a class="leyenda" style="background:#e1e9f4;"></a> Ya el estudiante pasó el curso</div> 
            <div><a class="leyenda" style="background:#a5bfde;"></a> El estudiante está tomando el curso</div> 
            <div><a class="leyenda" style="background:#6496c8;"></a> El estudiante no ha tomado el curso</div> 
            
            <h1>Leyenda Botón Recomendación</h1>
            <i>Esta leyenda está relacionada con los colores de los botones de recomendación.</i>
            <div><a class="leyenda" style="background:#c72837;"></a> El sistema la recomendó automáticamente</div>
            <div><a class="leyenda" style="background:#10c13f;"></a> El sistema no la ha recomendado</div>
               <FONT COLOR="red"> <i COLOR="red"><b>Nota Aclaratoria:</b> Si desea cambiar la recomendación presione el botón y el color cambiará automáticamente junto con la recomendación.</i></FONT>
            <h1>Leyenda Convalidación/Equivalencia</h1>
            <i>Esta leyenda está relacionada con las convalidaciones y equivalencias.</i>
            <div><a class="leyenda" style="background:#eeddd2;"></a> No he realizado el proceso</div>
            <div><a class="leyenda" style="background:#c69b7c;"></a> En proceso: Ya envié los documentos</div>
            <div><a class="leyenda" style="background:#995d2d;"></a> Completado: Ya recibí respuesta</div>
            </section>
        </div><!-- /.Final de Leyendas -->

  <!-- Comienzo de Historial -->
  <div id="Historial" class="tabcontent ">
            <section>
            <h1 style='text-align:center'>Historial de Recomendaciones</h1>
            

            <style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</head>
<body>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por Año" title="Type in a name">

<table id="myTable">
  <tr class="header">
    <th style="width:40%;">Año</th>
    <th style="width:30%;">Semestre</th>
    <th style="width:30%;">Curso</th>

  </tr>
  <?php
  $date_year = "SELECT crse_code, date_R FROM stdnt_record WHERE stdnt_number = '$student_id'";
  $result_year = mysqli_query($conn, $date_year);
  $resultCheck_year = mysqli_num_rows($result_year);
  //Saca la fecha actual y nos dice el semestre que viene
  $date = array();
  
if($resultCheck_year > 0){
  while($row = mysqli_fetch_assoc($result_year)){
  if($row['date_R'] != NULL) {
  $date = explode("-",$row['date_R']);
  $year = $date[0];
  $mes = $date[1];
  if ($mes<7){
  $semestre = "Agosto-Diciembre";
  }else {
  $semestre = "Enero-Mayo";
  }
      echo " <tr>
      <td>$year</td>
      <td>$semestre</td>
      <td>{$row['crse_code']}<td>
    </tr>";
    }
  }
}
  ?>
</table>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
  </section>
      </div>
      <!----------------------------- /.Final de Historial --------------------------------->
<!-- Modals -->
<!-- Edit -->
    <div id="id01" class="w3-modal" style="padding-left:20%">
    <div class="w3-modal-content w3-animate-zoom">
      <header class="w3-container" style="padding-top:5px">
        <span onclick="document.getElementById('id01').style.display='none'"
        class="w3-button w3-display-topright">&times;</span>
        <div style="text-align: center"><h3>Editar</h3></div>
        <hr>
      </header>
      <div class="w3-container">
          <br>
      <form action='inc/edit_crse.php' method='POST'>
          <div class="grid-container">
<!-- Dos select Box --> 
          <div class="select-box">          
                  <select name="course" id="course-list">
                  <?php
                      //solo deje code y quite name/label y agregue ciso y huma
                        $sql ="SELECT crse_code FROM mandatory_courses INNER JOIN cohort USING (crse_code)WHERE crse_major = 'CC-COMS-BCN' AND cohort_year = '2017'
                              UNION ALL 
                              SELECT crse_code FROM general_courses INNER JOIN cohort USING (crse_code) WHERE crse_major = 'CC-COMS-BCN' AND cohort_year = '2017'
                              UNION ALL 
                              SELECT	crse_code FROM departmental_courses WHERE crse_major = 'CC-COMS-BCN'
                              UNION ALL 
                              SELECT crse_code FROM general_education_ciso
                              UNION ALL 
                              SELECT crse_code FROM general_education_huma";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);

                         if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            //tenia label y name los cambia ambos por code
                            echo "<option value='{$row['crse_code']}'>{$row['crse_code']}</option>";
                        }
                        } ?>
                  </select>
              </div>
                          <div class="select-box"> 
                              <select name="grade" id="course-list">
                              <option value='A'>A</option>
                              <option value='B'>B</option>
                              <option value='C'>C</option>
                              <option value='D'>D</option>
                              <option value='F'>F</option>
                              <option value='IB'>IB</option>
                              <option value='IC'>IC</option>
                              <option value='ID'>ID</option>
                              <option value='IF'>IF</option>
                              </select>
                        </div>
              </div> 
<!-- ./ termina dos select Box --> 
                          <div class='input-group mb-3'>
                          <input type='text' name='semester' class='form-control' placeholder='SEMESTRE'>
                          <input type='text' name='descripcion' class='form-control' placeholder='DESCRIPCIÓN'>
                          <input type='number' name='creditos' class='form-control' placeholder='CREDITOS'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-comment-dots'></span>
                            </div>
                          </div>
                        </div>
                        <p><FONT COLOR="red"> <i COLOR="red">Nota Aclaratoria: </i></FONT>Poner semestre por codigo "TERM" según la plataforma PuTTY.</p> 
      </div>                                                     
      <footer class="w3-container" style="padding-bottom:10px; padding-top:0px">
<!-- HAY QUE BREGARLO!  -->
          <button type='submit' class='btn btn-default' onclick='edit_crse()' name='edit_crse-submit' style='float:right;'>APLICAR</button>
      </footer>   
      </form> 
    </div>
  </div><!-- /.Edit -->
            
            <!-- /.Modals -->
             
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </section>
        <!-- /.row -->
      </div>
    </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
<script>
        function openCity(evt, clase) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(clase).style.display = "block";
          evt.currentTarget.className += " active";
        }
        </script>
<script>
    function $(el){
        return document.getElementById(el);
    }

    function uploadFile(event){
    event.preventDefault();
    var file = event.dataTransfer.files[0];
// alert(file.name+" | "+file.size+" | "+file.type);
var formdata = new FormData();
formdata.append("file1", file);
var ajax = new XMLHttpRequest();
ajax.upload.addEventListener("progress", progressHandler, false);
ajax.addEventListener("load", completeHandler, false);
ajax.addEventListener("error", errorHandler, false);
ajax.addEventListener("abort", abortHandler, false);
ajax.open("POST", "../private/file_upload_parser.php");
ajax.send(formdata);

    }

    function progressHandler(event){
$("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
var percent = (event.loaded / event.total) * 100;
$("progressBar").value = Math.round(percent);
$("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
    }

    function completeHandler(event){
$("status").innerHTML = event.target.responseText;
$("progressBar").value = 0;
    }

    function errorHandler(event){
$("status").innerHTML = "Upload Failed";
    }

    function abortHandler(event){
$("status").innerHTML = "Upload Aborted";
    }

</script> 
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a>CONSEJERÍA-UPRA</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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

          <!----------------------------------------- Editar/Crear Expediente -------------------------------------------------->
        <div id='id03' class='w3-modal' style='padding-left:20%'>
            <div class='w3-modal-content w3-animate-zoom'>
              <header class='w3-container' style='padding-top:5px'>
                <span onclick='document.getElementById("id03").style.display="none"'
                class='w3-button w3-display-topright'>&times;</span>
                <h3>Actualizar/Crear Cohorte</h3>
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
                          <button name="submit" type="submit" value="submit" class='btn btn-primary' style="width: 100%; color: white">Crear</button>
                  </div> 
                <div class='item-2'>
                          <button type="submit" name="submit" value="submit" class='btn btn-warning' style="width: 100%; color: white">Actualizar</button>
                  </div>
                  </div>
              </div>
              <footer class='w3-container' style='padding-bottom:10px; padding-top:10px'>
              </footer>
                 </form> 
            </div>
          </div><!-- /.Expediente -->
          <!-------------------------------- Cursos a Examinar ------------------------------------------->
          <div id='Acomodar' class='w3-modal' style='padding-left:20%'>
            <div class='w3-modal-content w3-animate-zoom'>
              <header class='w3-container' style='padding-top:5px'>
                <span onclick='document.getElementById("Acomodar").style.display="none"'
                class='w3-button w3-display-topright'>&times;</span>
                <h3>Acomodar</h3>
              </header>
              <div class='w3-container'>
                  <br>
                <form action="inc/conv_equi.php" method="POST">
                <div class="grid-container">
                <div class='item-1'>
                          <a onclick="equi_conv(this, 'mandatory_courses')" class='btn btn-primary' style="width: 100%; color: white">
                            <i class='fas fa-pencil-alt'></i> Concentración</a>
                  </div>
                <div class='item-2'>
                          <a onclick="equi_conv(this, 'general_courses')" class='btn btn-warning' style="width: 100%; color: white">
                              <i class='fas fa-pencil-alt'></i> General Obli.</a>
                  </div>
                          <div class='item-3'>
                          <a onclick="equi_conv(this, 'departamental_courses')" class='btn btn-danger'style="width: 100%; color: white">
                             <i class='fas fa-pencil-alt'></i> Elect. Dept.</a>
                        </div>
                        <div class='item-4'>
                          <a onclick="equi_conv(this, 'libre')" class='btn btn-info' style="width: 100%; color: white">
                              <i class='fas fa-pencil-alt'></i> Elect. Libre</a>
                        </div>
                  </div>
              </div>
              <div class="grid-container" style="margin-left:18%">
              <div class='item-1'><input type="radio" name="tipo" value="convalidacion"> Convalidación</input></div>
              <div class='item-2'><input type="radio" name="tipo" value="equivalencia"> Equivalencia</input></div>
              </div>
              
              <div id='mand' style="display: none" class="select-box">          
                  <select name="course_mand" id="course-list">
                  <?php
                        $sql ="SELECT mandatory_courses.crse_code 
                        FROM mandatory_courses INNER JOIN cohort USING(crse_code) WHERE crse_major = '$cohort'";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);

                         if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='{$row['crse_code']}'>{$row['crse_code']}</option>";
                        }
                        } ?>
                  </select>

              </div>

              <div id='gen' style="display: none" class="select-box">          
                  <select name="course_gen" id="course-list">
                  <?php
                        $sql ="SELECT general_courses.crse_code 
                        FROM general_courses INNER JOIN cohort USING(crse_code) WHERE crse_major = '$cohort'";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);

                         if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='{$row['crse_code']}'>{$row['crse_code']}</option>";
                        }
                        } ?>
                  </select>

              </div>

              <div id='dept' style="display: none" class="select-box">          
                  <select name="course_dept" id="course-list">
                  <?php
                        $sql ="SELECT departmental_courses.crse_code 
                        FROM departmental_courses INNER JOIN cohort USING(crse_major) WHERE crse_major = '$cohort'";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);

                         if($resultCheck > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='{$row['crse_code']}'>{$row['crse_code']}</option>";
                        }
                        } ?>
                  </select>

              </div>
              <input type='hidden' id='og_crse' value='' name='og_crse'>
              <footer class='w3-container' style='padding-bottom:10px; padding-top:10px'>
              <button type='submit' id="mandatory" style="display: none" class='btn btn-default' onclick='conv_env()' name='conv_env-submit' style='float:right;' value="mandatory_courses" ; ?>APLICAR</button>
              <button type='submit' id="general" style="display: none" class='btn btn-default' onclick='conv_env()' name='conv_env-submit' style='float:right;' value="general_courses" ; ?>APLICAR</button>
              <button type='submit' id="depart" style="display: none" class='btn btn-default' onclick='conv_env()' name='conv_env-submit' style='float:right;' value="departamental_courses" ; ?>APLICAR</button>
              <button type='submit' id="free" style="display: none" class='btn btn-default' onclick='conv_env()' name='conv_env-submit' style='float:right;' value="free_courses" ; ?>APLICAR</button>
              </footer>
              </form>
            </div>
          </div>
            <!-- /.Cursos a Examinar -->
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

<!-- jQuery -->
<script>
$(document).ready(function(){
    $('#text').autosize();});
</script>
<script src="../../plugins/jquery/jquery.min.js"></script>
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
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
  // REDIRECT TO PHP SCRIPT THAT WILL PUT THE STUDENT RECORD IN A TXT FILE
    function $(el){
        return document.getElementById(el);
    }

    function uploadFile(event){
    event.preventDefault();
    var file = event.dataTransfer.files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);

  let  isRecordPresentInDB = '<?php echo $isRecordPresentInDB; ?>';
   
  if(isRecordPresentInDB){
    ajax.open("POST", "inc/update_stdnt_record.php");
  } else {
    ajax.open("POST", "inc/add_stdnt_record.php");
  }
	ajax.send(formdata);
    }
</script>
</body>
</html>