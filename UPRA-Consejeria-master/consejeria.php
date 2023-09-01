<?php
session_start();
$id = $_SESSION['stdnt_number'];
// Se asegura que el usario que no haya iniciado sesion no pueda acceder a esta pagina.
include_once 'private/dbconnect.php';
$sql = "SELECT stdnt_major FROM `student` WHERE stdnt_number = '$id'";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
  $row = mysqli_fetch_assoc($result);
  $cohort = $row['stdnt_major'];
}
if(!isset($_SESSION['stdnt_number'])){
  header("Location: index.php");
    exit();
}

$sql ="SELECT adv_comments
                      FROM record_details WHERE stdnt_number = '$id'";
                    $commentResult = mysqli_query($conn, $sql);
                    $commentCheck = mysqli_num_rows($commentResult);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CONSEJERÍA-UPRA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Aqui llamamos a los distintos css de la pagina y el font que tiene -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="css/conse.css">
    <link rel="stylesheet" href="css/notes.css">  
    <link rel="stylesheet" href="cita.css">
    <link rel="stylesheet" href="css/sugerencias.css">
    <link rel="stylesheet" href="css/sugerencias2.css">
    <link rel="stylesheet" href="jqueryui/jquery-ui.css">
    <link rel="stylesheet" href="jqueryui/jquery-ui.structure.css">
    <link rel="stylesheet" href="jqueryui/jquery-ui.theme.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminUPRA/dist/css/adminlte.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="AdminUPRA/plugins/fontawesome-free/css/all.min.css">
<!-- Culmina la parte los css y fonts. -->
      <!-- Font Awesome. -->
  <link rel="stylesheet" href="AdminUPRA/plugins/fontawesome-free/css/all.min.css">
  </head>   
    <script>
      var concentracion = [];
      var general = [];
      var huma = [];
      var ciencias_so = [];
      var libre = [];
      var departamento = [];
    </script> 
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

/* Table Styles */

.table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.list-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
    margin-bottom: 2px;
}

.list-table td, .list-table th {
    text-align: center;
    padding: 8px;
}

.list-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.list-table thead th {
    color: #ffffff;
    background: #282828;
}
/* 
.sticky {
  position: fixed;
  top: 100px;
} */

#slide {
  position: fixed;
  top: 100px;
  left: -100px;
    -webkit-animation: slide 0.5s forwards;
    -webkit-animation-delay: 2s;
    animation: slide 0.5s forwards;
    animation-delay: 2s;
}

@-webkit-keyframes slide {
    100% { left: 10px; }
}

@keyframes slide {
    100% { left: 010px; }
}

.notification {
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

.notification:hover {
  background: red;
}

.notification .badge {
  position: absolute;
  top: 0px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background: red;
  color: white;
}
      </style>
      <body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand upra-amarillo navbar-light">
<!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" role="button" onClick="appear()"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link">Inicio</a>
      </li>
    </ul>
  </nav>
  <script>
  var hover = 1; 
    function appear(){
      if (document.getElementById("sticky_table").style.visibility == "visible") {
        document.getElementById("sticky_table").style.visibility = "hidden";
        hover = 0;
      }else {
        document.getElementById("sticky_table").style.visibility = "visible";
        hover = 1;
      }
    }

    function appear_hover(){
      if(hover == 0){
      if (document.getElementById("sticky_table").style.visibility == "visible") {
        document.getElementById("sticky_table").style.visibility = "hidden";
      }else {
        document.getElementById("sticky_table").style.visibility = "visible";
      }
    }
    }
  </script>

    
<!-- /.navbar -->
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style='left: 0;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 1037;' onmouseover="appear_hover()" onmouseout="appear_hover()">
    <!-- Brand Logo -->
    <a href="inicio.html" class="brand-link">
      <img src="image/university.png" alt="UPRA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CONSEJERÍA UPRA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
<div id="sticky_table" style="visibility: visible">
      <?php
         $sql= "SELECT conducted_counseling FROM record_details WHERE stdnt_number = '$id'";
         $result_couns = mysqli_query($conn, $sql);
         $resultCheck_couns = mysqli_num_rows($result_couns);
         $counseling = mysqli_fetch_assoc($result_couns);
            if($counseling["conducted_counseling"] == 0){
              echo '<table class="list-table">
              <thead>
                <tr class="list">
                  <th>Concentración</th>
                  <th style="text-align: right" onClick="clear_list(';
                  echo "'con_table'";
                  echo ')">x</th>
                </tr>
                </thead>
                <tbody id="con_table">
                </tbody>
              </table>
              <table class="list-table">
              <thead>
                <tr class="list">
                  <th>Generales</th>
                  <th style="text-align: right" onClick="clear_list(';
                  echo "'gen_table'";
                  echo ')">x</th>
                </tr>
                </thead>
                <tbody id="gen_table">
                </tbody>
              </table>
              <table class="list-table">
              <thead>
                <tr class="list">
                  <th>Humanidades</th>
                  <th style="text-align: right" onClick="clear_list(';
                  echo "'hum_table'";
                  echo ')">x</th>
                </tr>
                </thead>
                <tbody id="hum_table">
                </tbody>
              </table>
              <table class="list-table">
              <thead>
                <tr class="list">
                  <th>Ciencias Sociales</th>
                  <th style="text-align: right" onClick="clear_list(';
                  echo "'ciso_table'";
                  echo ')">x</th>
                </tr>
                </thead>
                <tbody id="ciso_table">
                </tbody>
              </table>
              <table class="list-table">
              <thead>
                <tr class="list">
                  <th>Libres Departamental</th>
                  <th style="text-align: right" onClick="clear_list(';
                  echo "'lib_table'";
                  echo ')">x</th>
                </tr>
                </thead>
                <tbody id="lib_table">
                </tbody>
              </table>
              <table class="list-table">
              <thead>
                <tr class="list">
                  <th>Electivas Departamental</th>
                  <th style="text-align: right" onClick="clear_list(';
                  echo "'dept_table'";
                  echo ')">x</th>
                </tr>
                </thead>
                <tbody id="dept_table">
                </tbody>
              </table>';
              echo "
              <!-- Trigger the modal with a button -->
              <div class='login-btn-container' align='center' style='margin-top: 10px;'><button type='button' id='modal-btn' class='btn btn-yellow btn-pill' data-toggle='modal' data-target='#myModal'>CONFIRMAR</button></div>
              ";
            }else{
              echo "
            <div class='login-btn-container' align='center'><a class='btn btn-yellow btn-pill' href='pdf.php'>
                    <i class='fa fa-file' aria-hidden='true' style='color:white; font-size: 0.8em'>&nbsp; DESCARGUE SU EXPEDIENTE</i>
            </a></div>";
            }  
      ?>
      <a onClick="document.getElementById('id01').style.display='block'" class="nav-link" style="background-color: #494E53; border-radius: 5px; border: 0; margin-top: 250px;cursor: pointer">
              Cambiar Contraseña
            </a>
      <a href="index.php" class="nav-link" style="background-color: #494E53; border-radius: 5px; border: 0; margin-top: 10px">
              <i class="fa fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              Cerrar Sesión
            </a>
      <!-- /.sidebar-menu -->
    </div>
          </div>
   
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <div class='modal-header'>
                                          <h3>Cambiar Contraseña</h3>
                                        </div>
                                        <form id="pass_form" action="private/change_pass.php" method="POST">
                                        <div class='modal-body'>
                                        <div class='input-group mb-3'>
                          <input type='password' id='new_pass' class='form-control' placeholder='New Password'>
                          <input type='password' id='stdnt_password' name='stdnt_password' class='form-control' placeholder=' Confirm Password'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-comment-dots'></span>
                            </div>
                          </div>
                        </div>
                                       <p id="creditos"></p>
                                                        </div>
                                        <div class='modal-footer'><br>
                                          <div class='login-btn-container'><button onclick='pass()' style='float: right;' class='btn btn-yellow btn-pill'>CONFIRMAR</button></div>
                                        </form>
                                          </div>
                                      </div>
      </div>
    </div>
 <!-- Culmina la parte cerrar sesion del student. -->
    <div style="padding-top: 20px; padding-bottom: 20px; margin-left: 15%; margin-top: 0">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">   
                <div style="margin-right: 30%;"><h6>UNIVERSIDAD DE PUERTO RICO EN ARECIBO</h6>
                                    <h6>DEPARTAMENTO DE CIENCIAS DE CÓMPUTOS</h6>
                                    <h6>EVALUACIÓN BACHILLERATO EN CIENCIAS DE CÓMPUTOS</h6></div>
              </div>
                <?php 
                 $sentenciaSQL= "SELECT SUM(C)
                 FROM ((SELECT crse_credits AS C
                 FROM mandatory_courses
                 INNER JOIN  stdnt_record USING(crse_code)
                 WHERE stdnt_record.stdnt_number = '$id' AND crse_grade != '' AND crse_grade != 'W' AND crse_grade != 'F' AND crse_grade != 'ID' AND crse_grade != 'IF')
                 UNION ALL
                 (SELECT crse_credits AS C
                 FROM general_courses
                 INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_record.stdnt_number = '$id' AND crse_grade != '' AND crse_grade != 'W' AND crse_grade != 'F' AND crse_grade != 'ID' AND crse_grade != 'IF')
                 UNION ALL (SELECT crse_credits AS C
                 FROM departmental_courses
                 INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_record.stdnt_number = '$id' AND crse_grade != '' AND crse_grade != 'W' AND crse_grade != 'F' AND crse_grade != 'ID' AND crse_grade != 'IF')
                 UNION ALL (SELECT crse_credits AS C
                 FROM free_courses
                 INNER JOIN stdnt_record USING(crse_code)
                 WHERE stdnt_record.stdnt_number = '$id' AND crse_grade != '' AND crse_grade != 'W' AND crse_grade != 'F' AND crse_grade != 'ID' AND crse_grade != 'IF')) t1";
                    $resultRecom = mysqli_query($conn, $sentenciaSQL);
                    $reco=mysqli_fetch_assoc($resultRecom);

                    $year = date('Y');  
              if ($reco['SUM(C)']=== NULL){
                  $reco['SUM(C)']=0;
              }
                  $mes = date('m');
                  $sem = 'Enero-Mayo';
                      if($mes >= 6){
                      $sem = 'Agosto-Diciembre';
                    }
              
                 echo "<div class='card-header'>
                    Nombre: <b> {$_SESSION['crse_completename']} </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Correo: <b>{$_SESSION['stdnt_email']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Semestre: <b>$sem</b><br>
                    Número de Estudiante: <b>{$_SESSION['stdnt_number']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Créditos Aprobados: <b>{$reco['SUM(C)']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Año de Consejería: <b>$year</b></b>
                    <br> </div>";?>
                </div>
              </div>
            </div>
 <!-- Aqui se muestran los distinto TABS que estan en la pagina del student. -->
       <div class="container tables">
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'appointment')">Sacar Cita con su Consejero/a</button>
                    <button class="tablinks" onclick="openCity(event, 'Concentracion')">Realización de Consejería</button>
                    <button class="tablinks" onclick="openCity(event, 'Cohorte')">Verficar Cohorte</button>
                    <?php
                    echo '<button class="tablinks notification" onclick="openCity(event, ';
                    echo "'Comentario')";
                    echo '">Comentario del Consejero/a';
                    if($commentCheck > 0){
                    $comment = mysqli_fetch_assoc($commentResult);
                    if ($comment['adv_comments'] != "") 
                    echo '<span class="badge"><i class="fas fa-bell"></i></span>';
                    }
                    echo '
                    </button>';
                    ?>
                    
                  </div>
 <!-- Culmina la parte de los TABS. -->                
 <!-- Comienza el TAB de la realizacion de consejeria donde el student puede ver su file y confirmar su consejeria academica y tambien sugerir al momento de darle 'click' en consejeria 'otros cursos'. -->
            <div id="Concentracion" class="tabcontent">
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                        <!-- php
                            
                            
                             $sentenciaSQL= "SELECT SUM(C)
                             FROM ((SELECT crse_credits AS C
                             FROM mandatory_courses
                             INNER JOIN  stdnt_record USING(crse_code)
                             WHERE stdnt_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))
                             UNION ALL
                             (SELECT crse_credits AS C
                             FROM general_courses
                             INNER JOIN stdnt_record USING(crse_code)
                             WHERE stdnt_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))
                             UNION ALL
                             (SELECT crse_credits AS C
                             FROM departmental_courses
                             INNER JOIN stdnt_record USING(crse_code)
                             WHERE stdnt_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))
                             UNION ALL 
                                 (SELECT crse_credits AS C
                             FROM general_education_ciso
                             INNER JOIN stdnt_record USING(crse_code)
                             WHERE stdnt_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))
                             UNION ALL
                                 (SELECT crse_credits AS C
                             FROM general_education_huma
                             INNER JOIN stdnt_record USING(crse_code)
                             WHERE stdnt_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))
                             UNION ALL
                             (SELECT crse_credits AS C
                             FROM free_courses
                             INNER JOIN stdnt_record USING(crse_code)
                             WHERE stdnt_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))) t1";
                             $resultRecom = mysqli_query($conn, $sentenciaSQL);
                             $reco=mysqli_fetch_assoc($resultRecom);
                         
                       if ($reco['SUM(C)'] === NULL){
                           $reco['SUM(C)'] = 0;
                       } -->

                        
                                <div class='btn-group'>

                                <div class='container'>
                                <br>
                                  <!-- Modal -->
                                  <div class='modal fade' id='myModal' role='dialog'>
                                    <div class='modal-dialog'>
                      <form action='private/confirmacion.php' method='POST'>
                                      <!-- Modal content-->
                                      <div class='modal-content'>
                                        <div class='modal-header'>
                                          <h3>Próximo Semestre</h3>
                                          <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                        </div>
                                        <div class='modal-body'>
                                        <table id='example2' class='table table-bordered table-hover'>
                                      <thead>
                                      
                                      <tr width='50%'' bgcolor='yellow'>
                                        <th>Cursos</th>
                                        <th>Descripción</th>
                                        <th>Créditos</th>
                                      </tr>
                                      </thead> 
                                    <tbody id='confirm_table'>

                                    </tbody> 
                                      </table>
                                       <p id="creditos"></p>
                                                        </div>
                                        <div class='modal-footer'><br>
                                          <div class='login-btn-container'><button onclick='confirmar()' name='confirm-submit' style='float: right;' type='submit' class='btn btn-yellow btn-pill' data-toggle='modal' data-target='#myModal'>CONFIRMAR</button></div>
                                        
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                          </div>
                          </form>
                     
 <!-- Comienza el stdnt_record academico del student. -->
                <h4 style="text-align: left;">Instrucciones:Para realizar la consejería académica siga los siguientes pasos.</h4> 
                  <br>
                  <h5 style="text-align: left;"> <b style="color:red">Paso 1 ➔</b> Consulte su expediente.</h5>
                  <h5 style="text-align: left;"> <b style="color:red">Paso 2 ➔</b> Verifique el cohorte de su preferencia.</h5>
                  <h5 style="text-align: left;"> <b style="color:red">Paso 3 ➔</b> Escoja los cursos que aspira tomar el próximo semestre. </h5>
                  <h5 style="text-align: left;"> <b style="color:red">Paso 4 ➔</b> Revise su lista de cursos seleccionados y confirme su consejería. </h5>
                  <br>
                  <h4> <b style="color:red">NOTA</b> </h4>
                  <h5> <i> Para seleccionar un curso presione caja de verificación</i> “❑”</h5>
                  <h5> <i> Los cursos en color <b style="background:rgb(101, 236, 227);"> Azul</b> son recomendados por su consejero. </i></h5>
                  <br>
</div>
                            
<div class="grid-container-1">
  <div class="grid-item-1">                             
      <div class="card-body">   
         
         
                
                <div align = "center"><h3>Cursos de Concentración</h3></div>
                <table id="example2" class="table table-bordered table-hover" style="color:#000">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>&nbsp;</th>
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                  <tbody>
                <?php 
                
                      $sql = "SELECT *
                      FROM mandatory_courses INNER JOIN cohort USING (crse_code) WHERE crse_major = '$cohort'";
                      $result = mysqli_query($conn, $sql);
                      $resultCheck = mysqli_num_rows($result);
                      
                      if($resultCheck > 0){
                      while($row = mysqli_fetch_assoc($result)){
                        
                      $sql_S ="SELECT *
                      FROM mandatory_courses INNER JOIN stdnt_record USING (crse_code) 
                      WHERE stdnt_number = '$id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                      $resultCheck_S = mysqli_num_rows($result_S);
                      $row_S = mysqli_fetch_assoc($result_S);
                        
                    if($row_S['crse_status'] == 3 ) 
                    echo "<tr width='50%' style='background-color: rgb(101, 236, 227)'>";    
                    else                   
                    echo "<tr width='50%' style='background-color: #f4f9f9'>";
                  
                    echo "<td><center><input type='checkbox' id='{$row['crse_code']}' value='{$row['crse_code']}'/>&nbsp;</center></td>";
                    echo "<td>{$row['crse_code']}</td>";
                    echo "<td>{$row['crse_description']}</td>";
                    echo "<td>{$row['crse_credits']}</td>";
                    echo "<td>{$row_S['crse_grade']}</td>";
                    echo "<td>{$row_S['semester_pass']}</td>";
                    if(($row_S['crse_equivalence'] != NULL) || ($row_S['crse_recognition'] != NULL) && ($row_S['crseR_status'] != 1)){
                      echo"
                    <td><button onclick='myFunction(`{$row_S['crse_code']}`)' class='yellow-button' style='color:white; width : 100%'>Confirmar Proceso</button></td>";
                  }elseif($row_S['crse_equivalence'] != NULL || $row_S['crse_recognition'] != NULL){
                    echo"
                    <td>{$row_S['crse_equivalence']}{$row_S['crse_recognition']}</td>";
                  }else{
                    echo"
                    <td></td>";
                  }
                  echo"
                
                  
                  </tr>
                  
                  <script>
                  // Bind function to onclick event for checkbox
                  document.getElementById('{$row['crse_code']}').onclick = function() {
                    var clase = `'{$row['crse_code']}'`;
                    var clase_sin = `{$row['crse_code']}`;
                    var desc = `{$row['crse_description']}`;
                    var cred = `{$row['crse_credits']}`;
                    ";
                    
                    echo '
                      // access properties using this keyword
                      if ( this.checked ) {
                          // Returns true if checked
                          var list = document.getElementById("con_table").innerHTML;
                          var confirm_list = document.getElementById("confirm_table").innerHTML;

                          document.getElementById("con_table").innerHTML = `
                            ${list}
                            <tr class="list">
                            <td class="list">${this.value}</td>
                            <td><button onClick="con_list(${clase})">x</button></td>
                            </tr>
                          `;';
                                        echo "
                      concentracion.push([clase_sin, desc, cred]);
                      console.table(concentracion);
                      } else {
                        con_list('{$row['crse_code']}');
                      }
                  };

                  
                  </script>";}}?>  
                </tbody> 
                  </table>
                  <div align = "center"><h3>Cursos Generales Obligatorios</h3></div>
                    <table id="example2" class="table table-bordered table-hover" style="color:#000">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>&nbsp;</th>
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                  <tbody>
                
                      
                   <?php 
                   $sql ="SELECT *
                        FROM general_courses INNER JOIN cohort USING (crse_code)
                        WHERE crse_major = '$cohort'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $sql_S ="SELECT *
                      FROM general_courses INNER JOIN stdnt_record USING (crse_code) 
                      WHERE stdnt_number = '$id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                      $resultCheck_S = mysqli_num_rows($result_S);
                      $row_S = mysqli_fetch_assoc($result_S);
            
                   if($row_S['crse_status'] == 3 ) 
                    echo "<tr width='50%' style='background-color: rgb(101, 236, 227)'>";    
                    else                   
                    echo "<tr width='50%' style='background-color: #f4f9f9'>";
                  
                    echo "<td><center><input type='checkbox' id='{$row['crse_code']}' value='{$row['crse_code']}' />&nbsp;</center></td>" ;
                    echo "<td>{$row['crse_code']}</td>";
                    echo "<td>{$row['crse_description']}</td>";
                    echo "<td>{$row['crse_credits']}</td>";
                    echo "<td>{$row_S['crse_grade']}</td>";
                    echo "<td>{$row_S['semester_pass']}</td>";
                    if((($row_S['crse_equivalence'] != NULL) || ($row_S['crse_recognition'] != NULL)) && ($row_S['crseR_status'] != 1)){
                      echo"
                    <td><button onclick='myFunction(`{$row_S['crse_code']}`)' class='yellow-button' style='color:white; width : 100%'>Confirmar Proceso</button></td>";
                  }elseif($row_S['crse_equivalence'] != NULL || $row_S['crse_recognition'] != NULL){
                    echo"
                    <td>{$row_S['crse_equivalence']}{$row_S['crse_recognition']}</td>";
                  }else{
                    echo"
                    <td></td>";
                  }
                  echo"
                  </tr>
                  
                  <script>
                  // Bind function to onclick event for checkbox
                  document.getElementById('{$row['crse_code']}').onclick = function() {
                    var clase = `'{$row['crse_code']}'`;
                    var clase_sin = `{$row['crse_code']}`;
                    var desc = `{$row['crse_description']}`;
                    var cred = `{$row['crse_credits']}`;";
                    
                    echo '
                      // access properties using this keyword
                      if ( this.checked ) {
                          // Returns true if checked
                          var list = document.getElementById("gen_table").innerHTML;
                          var confirm_list = document.getElementById("confirm_table").innerHTML;

                          document.getElementById("gen_table").innerHTML = `
                            ${list}
                            <tr class="list">
                            <td class="list">${this.value}</td>
                            <td><button onClick="gen_list(${clase})">x</button></td>
                            </tr>
                          `;';
                                      echo "
                    general.push([clase_sin, desc, cred]);
                    console.table(general);
                    } else {
                      gen_list('{$row['crse_code']}');
                    }
                };

                
                </script>";}}?>
                </tbody>
                  </table>
          
          
                 <div align = "center"><h3>Humanidades</h3></div>
                    <table id="example2" class="table table-bordered table-hover" style="color:#000">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                     <th>&nbsp;</th>
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                <tbody>
                <?php 
                $sql =" SELECT * 
                    FROM general_education_huma";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                      $sql_S ="SELECT * 
                        FROM general_education_huma INNER JOIN stdnt_record USING (crse_code)
                        WHERE stdnt_number = '$id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                      $resultCheck_S = mysqli_num_rows($result_S);
                      $row_S = mysqli_fetch_assoc($result_S);
                  
                   if($row_S['crse_status'] == 3 ) 
                    echo "<tr width='50%' style='background-color: rgb(101, 236, 227)'>";    
                    else                   
                    echo "<tr width='50%' style='background-color: #f4f9f9'>";
                
                    echo "<td><center><input type='checkbox' id='{$row['crse_code']}' value='{$row['crse_code']}' />&nbsp;</center></td>" ;
                    echo "<td>{$row['crse_code']}</td>";
                    echo "<td>{$row['crse_description']}</td>";
                    echo "<td>{$row['crse_credits']}</td>";
                    echo "<td>{$row_S['crse_grade']}</td>";
                      echo "
                    <td>{$row_S['semester_pass']}</td>
                    <td></td>
                  </tr> 
                  
                  <script>
                  // Bind function to onclick event for checkbox
                  document.getElementById('{$row['crse_code']}').onclick = function() {
                    var clase = `'{$row['crse_code']}'`;
                    var clase_sin = `{$row['crse_code']}`;
                    var desc = `{$row['crse_description']}`;
                    var cred = `{$row['crse_credits']}`;";
                    echo '
                      // access properties using this keyword
                      if ( this.checked ) {
                          // Returns true if checked
                          var list = document.getElementById("hum_table").innerHTML;
                          var confirm_list = document.getElementById("confirm_table").innerHTML;

                          document.getElementById("hum_table").innerHTML = `
                            ${list}
                            <tr class="list">
                            <td class="list">${this.value}</td>
                            <td><button onClick="hum_list(${clase})">x</button></td>
                            </tr>
                          `;';
                                      echo "
                    huma.push([clase_sin, desc, cred]);
                    console.table(huma);
                    } else {
                      hum_list('{$row['crse_code']}');
                    }
                };

                
                </script>";}}?>
                </tbody> 
                  </table>
          
          
          
          <div align = "center"><h3>Ciencias Sociales</h3></div>
                    <table id="example2" class="table table-bordered table-hover" style="color:#000">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                     <th>&nbsp;</th>
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                <tbody>
                <?php 
                $sql =" SELECT * 
                    FROM general_education_CISO ";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  
                      $sql_S ="SELECT * 
                        FROM general_education_CISO INNER JOIN stdnt_record USING (crse_code)
                        WHERE stdnt_number = '$id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                      $resultCheck_S = mysqli_num_rows($result_S);
                      $row_S = mysqli_fetch_assoc($result_S);
        
                    
                     if($row_S['crse_status'] == 3 ) 
                    echo "<tr width='50%' style='background-color: rgb(101, 236, 227)'>";    
                    else                   
                    echo "<tr width='50%' style='background-color: #f4f9f9'>";
                    
                    echo "<td><center><input type='checkbox' id='{$row['crse_code']}' value='{$row['crse_code']}' />&nbsp;</center></td>" ;
                    echo "<td>{$row['crse_code']}</td>";
                    echo "<td>{$row['crse_description']}</td>";
                    echo "<td>{$row['crse_credits']}</td>";
                    echo "<td>{$row_S['crse_grade']}</td>";
                      echo "
                    <td>{$row_S['semester_pass']}</td>
                    <td></td>
                  </tr> 
                  
                  <script>
                  // Bind function to onclick event for checkbox
                  document.getElementById('{$row['crse_code']}').onclick = function() {
                    var clase = `'{$row['crse_code']}'`;
                    var clase_sin = `{$row['crse_code']}`;
                    var desc = `{$row['crse_description']}`;
                    var cred = `{$row['crse_credits']}`;";
                    echo '
                      // access properties using this keyword
                      if ( this.checked ) {
                          // Returns true if checked
                          var list = document.getElementById("ciso_table").innerHTML;
                          var confirm_list = document.getElementById("confirm_table").innerHTML;

                          document.getElementById("ciso_table").innerHTML = `
                            ${list}
                            <tr class="list">
                            <td class="list">${this.value}</td>
                            <td><button onClick="ciso_list(${clase})">x</button></td>
                            </tr>
                          `;';
                                      echo "
                    ciencias_so.push([clase_sin, desc, cred]);
                    console.table(ciencias_so);
                    } else {
                      ciso_list('{$row['crse_code']}');
                    }
                };

                
                </script>";}}?>
                </tbody> 
                  </table>
          
                   <div align = "center"><h3>Electivas Libres</h3></div>
                    <table id="example2" class="table table-bordered table-hover" style="color:#000">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                     <th>&nbsp;</th>
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                <tbody>
                <?php 
                $sql ="SELECT *
                   FROM free_courses INNER JOIN stdnt_record USING (crse_code) WHERE stdnt_number = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  
                  
                   if($row_S['crse_status'] == 3 ) 
                    echo "<tr width='50%' style='background-color: rgb(101, 236, 227)'>";    
                    else                   
                    echo "<tr width='50%' style='background-color: #f4f9f9'>";
                    
                    echo "<td><center><input type='checkbox' id='{$row['crse_code']}' value='{$row['crse_code']}' />&nbsp;</center></td>" ;
                    echo "<td>{$row['crse_code']}</td>";
                    echo "<td>{$row['crse_description']}</td>";
                    echo "<td>{$row['crse_credits']}</td>";
                    echo "<td>{$row['crse_grade']}</td>";
                      echo "
                    <td>{$row['semester_pass']}</td>
                    <td></td>
                  </tr> 
                  
                  <script>
                  // Bind function to onclick event for checkbox
                  document.getElementById('{$row['crse_code']}').onclick = function() {
                    var clase = `'{$row['crse_code']}'`;
                    var clase_sin = `{$row['crse_code']}`;
                    var desc = `{$row['crse_description']}`;
                    var cred = `{$row['crse_credits']}`;";
                    echo '
                      // access properties using this keyword
                      if ( this.checked ) {
                          // Returns true if checked
                          var list = document.getElementById("lib_table").innerHTML;
                          var confirm_list = document.getElementById("confirm_table").innerHTML;

                          document.getElementById("lib_table").innerHTML = `
                            ${list}
                            <tr class="list">
                            <td class="list">${this.value}</td>
                            <td><button onClick="lib_list(${clase})">x</button></td>
                            </tr>
                          `;';
                                      echo "
                    libre.push([clase_sin, desc, cred]);
                    console.table(libre);
                    } else {
                      lib_list('{$row['crse_code']}');
                    }
                };

                
                </script>";}}?>
                </tbody> 
                  </table>
                   <div align = "center"><h3>Electivas Departamentales</h3></div>
                    <table id="example2" class="table table-bordered table-hover" style="color:#000">
                     <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>&nbsp;</th>
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                <tbody>
               
                        <?php 
                $sql =" SELECT * 
                    FROM departmental_courses WHERE crse_major = '$cohort'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  
                      $sql_S ="SELECT * 
                        FROM departmental_courses INNER JOIN stdnt_record USING (crse_code)
                        WHERE stdnt_number = '$id' AND crse_code = '{$row['crse_code']}'";
                      $result_S = mysqli_query($conn, $sql_S);
                      $resultCheck_S = mysqli_num_rows($result_S);
                      $row_S = mysqli_fetch_assoc($result_S);
                 
                     if($row_S['crse_status'] == 3 ) 
                    echo "<tr width='50%' style='background-color: rgb(101, 236, 227)'>";    
                    else                   
                    echo "<tr width='50%' style='background-color: #f4f9f9'>";
                
                    echo "<td><center><input type='checkbox' id='{$row['crse_code']}' value='{$row['crse_code']}' />&nbsp;</center></td>" ;
                    echo "<td>{$row['crse_code']}</td>";
                    echo "<td>{$row['crse_description']}</td>";
                    echo "<td>{$row['crse_credits']}</td>";
                    echo "<td>{$row_S['crse_grade']}</td>";
                     echo "
                    <td>{$row_S['semester_pass']}</td>";
                    if(($row_S['crse_equivalence'] != NULL) || ($row_S['crse_recognition'] != NULL) && ($row_S['crseR_status'] != 1)){
                      echo"
                    <td><button onclick='myFunction(`{$row_S['crse_code']}`)' class='yellow-button' style='color:white; width : 100%'>Confirmar Proceso</button></td>";
                  }elseif($row_S['crse_equivalence'] != NULL || $row_S['crse_recognition'] != NULL){
                    echo"
                    <td>{$row_S['crse_equivalence']}{$row_S['crse_recognition']}</td>";
                  }else{
                    echo"
                    <td></td>";
                  }
                  echo"
                  </tr>              
                            <!-- Modal de Equivalencias y Convalidaciones -->
                            <!-- Convalidacion-Equivalencia -->
                  <div id='equi-conv' class='w3-modal'>
                      <div class='w3-modal-content w3-animate-zoom' style='margin-top:10%; margin-bottom'>
                        <header class='w3-container' style='padding-top:5px'>
                          <span onclick='equi_conv()'
                          class='w3-button w3-display-topright'>&times;</span>
                          <h3>Convalidación/Equivalencias</h3>
                        </header>
                        <form method='post' action='private/confirm_equi_conv.php'>
                        <div class='w3-container'>
                        <div class='grid-container' style='margin-bottom:20px; margin-top:20px;'>
                        <div class='item-1'><input type='radio' name='estatus' value='0'> No he iniciado proceso</input></div>
                        <div class='item-2'><input type='radio' name='estatus' value='2'> En Proceso: Ya envié los documentos</input></div>
                        <div class='item-3'><input type='radio' name='estatus' value='1'> Completado: Ya recibí respuesta</input></div>
                        </div>
                        </div>

                        <input type='hidden' name='stdnt_number' value='$id'>
                        <footer class='w3-container' style='padding-bottom:10px; padding-top:10px'>
                        <button id='conv_env-submit' value='' type='submit' class='btn btn-default' name='conv_env-submit' style='float:right; '>Confirmar</button>
                        </footer>
                        </form>
                      </div>
                    </div><!-- /.Convalidacion-Equivalencia -->
                <!-- /Modal -->
                
                <script>
                  // Bind function to onclick event for checkbox
                  document.getElementById('{$row['crse_code']}').onclick = function() {
                    var clase = `'{$row['crse_code']}'`;
                    var clase_sin = `{$row['crse_code']}`;
                    var desc = `{$row['crse_description']}`;
                    var cred = `{$row['crse_credits']}`;";
                    echo '
                      // access properties using this keyword
                      if ( this.checked ) {
                          // Returns true if checked
                          var list = document.getElementById("dept_table").innerHTML;
                          var confirm_list = document.getElementById("confirm_table").innerHTML;

                          document.getElementById("dept_table").innerHTML = `
                            ${list}
                            <tr class="list">
                            <td class="list">${this.value}</td>
                            <td><button onClick="dept_list(${clase})">x</button></td>
                            </tr>
                          `;
                    departamento.push([clase_sin, desc, cred]);
                    console.table(departamento);
                    } else {';
                      echo "
                      dept_list('{$row['crse_code']}');";
                      echo '
                    }
                };

                
                </script>';
                  }}?>
                    </table>
                    <div class='warning-message'><h4 style='text-align:center'>¡RECORDATORIO! Debe tomar 6 créditos en avanzada.</h4></div>
              </div> </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
           
        
<!-- Culmina la parte del stdnt_record academico. -->          
<!-- TAB para appointment. El student puede realizar una cita con la profesora. Escoge el dia y la hora, para sacar la cita. -->
    <div id="appointment" class="tabcontent active">
    <section class="appointment">
    <form action="private/process-appointment.php" method="POST" class="appointment-form">                 
    <?php 
        include 'private/appointment-status.php';
        $sql ="SELECT appt_id FROM appointment WHERE stdnt_number = '$id'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){  
                echo '<div class="success-message">La cita con el/la consejero(a) fue separada para el '.$appt_date.'.</div>';
                } else {
                    if((isset($_GET['is-date-empty']) AND boolval($_GET['is-date-empty'])) OR (isset($_GET['is-hour-chosen-empty']) AND boolval($_GET['is-hour-chosen-empty']))){
                    echo '<div class="error-message">*Escoga el día y la hora de la cita.</div>';
                        }
                    echo ' 
                    <input type="hidden" name="first-name" value="'.$_SESSION['stdnt_name'].'" placeholder="First Name" class="form-control" readonly>
                    <input type="hidden" name="last-name" value="'.$_SESSION['stdnt_lastname1'].' '.$_SESSION['stdnt_lastname2'].'" placeholder="Last Name"  class="form-control" readonly>
                           <input type="hidden" name="email"  value="'.$_SESSION['stdnt_email'].'" class="form-control" readonly> 
                                 <h3>Escoger Fecha y Hora</h3>  <div class="form-group d-flex">
                                         <div class="calendar-box">';

                                                $dateField = '<input type="text" name="date" onchange="getAvailableDates(this.value)" id="datepicker"  type="text" class="form-control"/>';
                                                if(isset($_GET['is-date-empty']) AND boolval($_GET['is-date-empty'])){
                                                    $dateField = '<input type="text" name="date" onchange="getAvailableDates(this.value)" id="datepicker"  type="text" class="invalid"/>';
                                                } 
                                                echo $dateField;
                                            
                                        echo '<div class="hour-chosen-container"></div>
                                            </div>
                                            <div class="spots-available">
                                             </div>
                                             </div>
                                             <div class="login-btn-container"><button type="submit" class="btn btn-yellow btn-pill">Confirmar Cita</button></div>';
                                }
                           ?>
                        </form>
                </section>
                  </div>
<!-- Culmina la parte de los TABS para las appointment. -->   
<!-- Este es el TAB de Comentarios que le hace el advisor/a al student. Donde podra ver que le escribe el/la consejera sobre algun comentario adiconal que tenga que decirle al student. -->           
            <div id="Comentario" class="tabcontent">
                <!-- Notes -->
             <?php
                
              
                
                 
                    echo "
            <div class='card'>
              <div class='card-header' style='background: #e0c200'>
                <h3 class='card-title' style='margin: auto'><strong>Notas</strong></h3>
              </div>
                
              <div>";
                if($commentCheck > 0){
                  echo "
		                <p id='text' name='text' rows='' style='overflow-y: auto; word-wrap: break-word; resize: none; height: 400px;'>".$comment['adv_comments']."</p>";
                }else {
                  echo "
                  <p id='text' name='text' rows='' style='overflow-y: auto; word-wrap: break-word; resize: none; height: 400px;'></p>";
                }
              
             echo "   
            </div>
            <!-- /.card -->
          </div>";
          ?>
            </div>
<!-- Este es el TAB de Sugerencias del student. Donde podra sugerir las clases de Electiva departamentales y confirmar para dejarle saber a la profesora cuales esta el student sugiriendo solo las electivas departamentales. -->
           <div id="tabla-cohorte" style="display:none"> 
             <label>Departamento :</label>
             <select id="select-dept">
                <option></option>
             </select>
             <label>Cohorte :</label>
             <select id="select-year">
                <option></option>
             </select>
             <button type='button' class='btn btn-yellow btn-pill' onclick="show_cohort()">CONFIRMAR</button>
             <div class="tab">
              <button id="primerbtn" class="tablinks" onclick="openCity(event, 'Primer')">Primer Año</button>
              <button class="tablinks" onclick="openCity(event, 'Segundo')">Segundo Año</button>
              <button class="tablinks" onclick="openCity(event, 'Tercero')">Tercer Año</button>
              <button class="tablinks" onclick="openCity(event, 'Cuarto')">Cuarto Año</button>
              <button class="tablinks" onclick="openCity(event, 'HUMA')">Humanidades </button>
              <button class="tablinks" onclick="openCity(event, 'CISO')">Ciencias Sociales</button>
              <button class="tablinks" onclick="openCity(event, 'ElectDept')">Electivas Departamentales</button>
            </div>
            <script>
               var cohorte = [];
                <?php
                $sql_cohort = "SELECT DISTINCT crse_major, cohort_year FROM `cohort`";
                $result_cohort = mysqli_query($conn, $sql_cohort);
                $resultCheck_cohort = mysqli_num_rows($result_cohort);                                
               
                if($resultCheck_cohort > 0){
                  while($row_cohort = mysqli_fetch_assoc($result_cohort)){
                    echo "dept_list = document.getElementById('select-dept').innerHTML;
                    year_list = document.getElementById('select-year').innerHTML;
                    document.getElementById('select-dept').innerHTML = `";
                    echo '
                    ${dept_list}';
                    if ($row_cohort["crse_major"] == 'CC-COMS-BCN') {
                    echo "
                    <option value='".$row_cohort["crse_major"]."'>CCOM</option>
                    `;
                    ";
                    } else if ($row_cohort["crse_major"] == 'BI-MICM-BCN') {
                      echo "
                      <option value='".$row_cohort["crse_major"]."'>BIOL</option>
                      `;
                      ";
                      }
                    echo "
                    document.getElementById('select-year').innerHTML = `";
                    echo '
                    ${year_list}';
                    echo "
                    <option>".$row_cohort["cohort_year"]."</option>
                    `;";
                      }
                  }

                  $sql = "SELECT * FROM `cohort` INNER JOIN mandatory_courses USING (crse_code)
                  UNION
                  SELECT * FROM `cohort` INNER JOIN general_courses USING (crse_code) WHERE crse_major ='$cohort'";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);                                
                 
                  if($resultCheck > 0){
                    while($row = mysqli_fetch_assoc($result)){
                      $sql_grade ="SELECT crse_grade
                                            FROM stdnt_record 
                                            WHERE crse_code = '{$row['crse_code']}' AND stdnt_number = '$id'
                                            UNION
                                            SELECT crse_grade
                                            FROM stdnt_record 
                                            WHERE crse_code = '{$row['crse_code']}' AND stdnt_number = '$id'";
                                  $result_grade = mysqli_query($conn, $sql_grade);
                                  $resultCheck_grade = mysqli_num_rows($result_grade);                                   
                                  
                                  if($resultCheck_grade > 0){
                                  $row_grade = mysqli_fetch_assoc($result_grade);
                                  echo "
                                    cohorte.push(['".$row["crse_code"]."', ".$row["cohort_year"].", ".$row["crse_year"].", ".$row["crse_semester"].", '".$row["crse_major"]."', '".$row["crse_description"]."', '".$row["crse_credits"]."', '".$row_grade["crse_grade"]."']);
                                    ";
                                }else {
                                echo "
                                    cohorte.push(['".$row["crse_code"]."', ".$row["cohort_year"].", ".$row["crse_year"].", ".$row["crse_semester"].", '".$row["crse_major"]."', '".$row["crse_description"]."', '".$row["crse_credits"]."', '']);
                                    ";
                                }
                  }
                }
                  
              ?>
              
              function show_cohort() {
                
                var dept = document.getElementById("select-dept").value;
                var year = document.getElementById("select-year").value;
                var tabla;
                tabla = document.getElementById("primer_tabla").innerHTML = '';
                tabla = document.getElementById("primer_segundo").innerHTML = '';
                tabla = document.getElementById("segundo_primero").innerHTML = '';
                tabla = document.getElementById("segundo_segundo").innerHTML = '';
                tabla = document.getElementById("tercero_primero").innerHTML = '';
                tabla = document.getElementById("tercero_segundo").innerHTML = '';
                tabla = document.getElementById("cuarto_primero").innerHTML = '';
                tabla = document.getElementById("cuarto_segundo").innerHTML = '';
                openCity(event, 'Primer');
                document.getElementById('primerbtn').classList.toggle('active');
                for (var i = 0; i < cohorte.length; i++){
                  console.log(dept + cohorte[i][4]);
                  if (cohorte[i][4] == `${dept}` && cohorte[i][1] == year){
                  if (cohorte[i][2] == 1 && (cohorte[i][3] == 1 || cohorte[i][3] == 3)){
                  tabla = document.getElementById("primer_tabla").innerHTML;
                  if (cohorte[i][7] == 'A' || cohorte[i][7] == 'B' || cohorte[i][7] == 'C' || cohorte[i][7] == 'P') {
                  document.getElementById("primer_tabla").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else if (cohorte[i][7] == 'D' || cohorte[i][7] == 'F' || cohorte[i][7] == 'NP') {
                  document.getElementById("primer_tabla").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else {
                                  document.getElementById("primer_tabla").innerHTML = `
                                ${tabla}
                                <tr class='tablaC'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                }
                  } else if (cohorte[i][2] == 1 && (cohorte[i][3] == 2 || cohorte[i][3] == 3)){
                  tabla = document.getElementById("primer_segundo").innerHTML;
                  if (cohorte[i][7] == 'A' || cohorte[i][7] == 'B' || cohorte[i][7] == 'C' || cohorte[i][7] == 'P') {
                  document.getElementById("primer_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else if (cohorte[i][7] == 'D' || cohorte[i][7] == 'F' || cohorte[i][7] == 'NP') {
                  document.getElementById("primer_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else {
                                  document.getElementById("primer_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                }
                  } else if (cohorte[i][2] == 2 && (cohorte[i][3] == 1|| cohorte[i][3] == 3)){
                  tabla = document.getElementById("segundo_primero").innerHTML;
                  if (cohorte[i][7] == 'A' || cohorte[i][7] == 'B' || cohorte[i][7] == 'C' || cohorte[i][7] == 'P') {
                  document.getElementById("segundo_primero").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else if (cohorte[i][7] == 'D' || cohorte[i][7] == 'F' || cohorte[i][7] == 'NP') {
                  document.getElementById("segundo_primero").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else {
                                  document.getElementById("segundo_primero").innerHTML = `
                                ${tabla}
                                <tr class='tablaC'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                }
                  } else if (cohorte[i][2] == 2 && (cohorte[i][3] == 2 || cohorte[i][3] == 3)){
                  tabla = document.getElementById("segundo_segundo").innerHTML;
                  if (cohorte[i][7] == 'A' || cohorte[i][7] == 'B' || cohorte[i][7] == 'C' || cohorte[i][7] == 'P') {
                  document.getElementById("segundo_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else if (cohorte[i][7] == 'D' || cohorte[i][7] == 'F' || cohorte[i][7] == 'NP') {
                  document.getElementById("segundo_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else {
                                  document.getElementById("segundo_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                }
                  } else if (cohorte[i][2] == 3 && (cohorte[i][3] == 1 || cohorte[i][3] == 3)){
                  tabla = document.getElementById("tercero_primero").innerHTML;
                  if (cohorte[i][7] == 'A' || cohorte[i][7] == 'B' || cohorte[i][7] == 'C' || cohorte[i][7] == 'P') {
                  document.getElementById("tercero_primero").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else if (cohorte[i][7] == 'D' || cohorte[i][7] == 'F' || cohorte[i][7] == 'NP') {
                  document.getElementById("tercero_primero").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else {
                                  document.getElementById("tercero_primero").innerHTML = `
                                ${tabla}
                                <tr class='tablaC'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                }
                  } else if (cohorte[i][2] == 3 && (cohorte[i][3] == 2 || cohorte[i][3] == 3)){
                  tabla = document.getElementById("tercero_segundo").innerHTML;
                  if (cohorte[i][7] == 'A' || cohorte[i][7] == 'B' || cohorte[i][7] == 'C' || cohorte[i][7] == 'P') {
                  document.getElementById("tercero_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else if (cohorte[i][7] == 'D' || cohorte[i][7] == 'F' || cohorte[i][7] == 'NP') {
                  document.getElementById("tercero_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else {
                                  document.getElementById("tercer_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                }
                  } else if (cohorte[i][2] == 4 && (cohorte[i][3] == 1 || cohorte[i][3] == 3)){
                  tabla = document.getElementById("cuarto_primero").innerHTML;
                  if (cohorte[i][7] == 'A' || cohorte[i][7] == 'B' || cohorte[i][7] == 'C' || cohorte[i][7] == 'P') {
                  document.getElementById("cuarto_primero").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else if (cohorte[i][7] == 'D' || cohorte[i][7] == 'F' || cohorte[i][7] == 'NP') {
                  document.getElementById("cuarto_primero").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else {
                                  document.getElementById("cuarto_primero").innerHTML = `
                                ${tabla}
                                <tr class='tablaC'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                }
                  } else if (cohorte[i][2] == 4 && (cohorte[i][3] == 2 || cohorte[i][3] == 3)){
                  tabla = document.getElementById("cuarto_segundo").innerHTML;
                  if (cohorte[i][7] == 'A' || cohorte[i][7] == 'B' || cohorte[i][7] == 'C' || cohorte[i][7] == 'P') {
                  document.getElementById("cuarto_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else if (cohorte[i][7] == 'D' || cohorte[i][7] == 'F' || cohorte[i][7] == 'NP') {
                  document.getElementById("cuarto_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                } else {
                                  document.getElementById("cuarto_segundo").innerHTML = `
                                ${tabla}
                                <tr class='tablaC'>
                                        <td>${cohorte[i][0]}</td>
                                        <td>${cohorte[i][5]}</td>
                                        <td>${cohorte[i][6]}</td>
                                </tr>`;
                                }
                  }
                  }
                }
                
                }
            </script>
                                    <!-- Comienza el TAB del First Year -->
<div id="Primer" class="tabcontent">
  <section>
<table>
  <tr class="bordeC size"><h3>Primer Año - Primer Semestre</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody id="primer_tabla">
                                  
</tbody>
</table>
<table>
 <tr class="bordeC size"><h3>Primer Año - Segundo Semestre</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody id="primer_segundo">
                                 
</tbody>
</table>
        </section> 
</div>
<!-- Termina el TAB del First Year -->
                                    <!-- Comienza el TAB del Second Year -->
<div id="Segundo" class="tabcontent">
    <section>
<table>
  <tr class="bordeC size"><h3>Segundo Año - Primer Semestre</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody id="segundo_primero">
                                 
</tbody>
</table>
<table>
 <tr class="bordeC size"><h3>Segundo Año - Segundo Semestre</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody id="segundo_segundo">
                                 
</tbody>
</table>
        </section>  
</div>
<!-- Termina el TAB del Second Year -->
<div id="Tercero" class="tabcontent">
    <section>
<table>
  <tr class="bordeC size"><h3>Tercer Año - Primer Semestre</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody id="tercero_primero">
                                 
</tbody>
</table>
<table>
 <tr class="bordeC size"><h3>Tercer Año - Segundo Semestre</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody id="tercero_segundo">
                                
</tbody>
</table>
        </section>  
</div>
<div id="Cuarto" class="tabcontent">
<section>
<table>
  <tr class="bordeC size"><h3>Cuarto Año - Primer Semestre</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody id="cuarto_primero">
                                  
</tbody>
</table>
<table>
 <tr class="bordeC size"><h3>Cuarto Año - Segundo Semestre</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody id="cuarto_segundo">
                                
</tbody>
</table>
        </section>  
</div>

               
               
<div id="HUMA" class="tabcontent">
<section>
<table>
  <tr class="bordeC size"><h3>Educación General Humanidades</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody>
                                  <?php
                                    
                                    $sql ="SELECT crse_code, crse_description, crse_credits
                                            FROM general_education_huma";
                                  $result = mysqli_query($conn, $sql);
                                  $resultCheck = mysqli_num_rows($result);
                            
                                    if($resultCheck > 0){
                              while($row = mysqli_fetch_assoc($result)){
                              $sql_grade =" SELECT crse_code, crse_grade
                                            FROM stdnt_record 
                                            WHERE crse_code = '{$row['crse_code']}' AND stdnt_number = '840-16-4235'
                                            UNION
                                            SELECT crse_code, crse_grade
                                            FROM stdnt_record 
                                            WHERE crse_code = '{$row['crse_code']}' AND stdnt_number = '840-16-4235'";
                                  $result_grade = mysqli_query($conn, $sql_grade);
                                  $resultCheck_grade = mysqli_num_rows($result_grade);                                   
                                  
                                  if($resultCheck_grade > 0){
                                  $row_grade = mysqli_fetch_assoc($result_grade);
                                  
                                  if(      $row_grade['crse_grade'] == 'A' OR $row_grade['crse_grade'] == 'B' OR
                                           $row_grade['crse_grade'] == 'C'){
                                       echo " <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";}
                                         else{
                                      echo " <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";}} 
                                  else {
                                        echo " <tr class='tablaC'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";}}}
?>
</tbody>
</table>
        </section>
</div>

               
<div id="CISO" class="tabcontent">
<section>
<table>
  <tr class="bordeC size"><h3>Educación General Ciencias Sociales</h3>
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody>
                                  <?php
                                    
                                    $sql ="SELECT crse_code, crse_description, crse_credits
                                            FROM general_education_ciso";
                                  $result = mysqli_query($conn, $sql);
                                  $resultCheck = mysqli_num_rows($result);
                            
                                    if($resultCheck > 0){
                              while($row = mysqli_fetch_assoc($result)){
                              $sql_grade =" SELECT crse_code, crse_grade
                                            FROM stdnt_record 
                                            WHERE crse_code = '{$row['crse_code']}' AND stdnt_number = '840-16-4235'
                                            UNION
                                            SELECT crse_code, crse_grade
                                            FROM stdnt_record 
                                            WHERE crse_code = '{$row['crse_code']}' AND stdnt_number = '840-16-4235'";
                                  $result_grade = mysqli_query($conn, $sql_grade);
                                  $resultCheck_grade = mysqli_num_rows($result_grade);                                   
                                  
                                  if($resultCheck_grade > 0){
                                  $row_grade = mysqli_fetch_assoc($result_grade);
                                  
                                  if(      $row_grade['crse_grade'] == 'A' OR $row_grade['crse_grade'] == 'B' OR
                                           $row_grade['crse_grade'] == 'C'){
                                       echo " <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";}
                                         else{
                                      echo " <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";}} 
                                  else {
                                        echo " <tr class='tablaC'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";}}}
?>
</tbody>
</table>
</section>
</div>         
               
<style>
    .tablaC {
        border: 5px solid #bda400;
        color: black;
    }
    .bordeC{
        border: 5px double #bda400;
      }
    .size {
       font-size: 21px;
        color: black;
    }
</style>
<div id="ElectDept" class="tabcontent">
  <h3>Electivas Departamentales</h3>
    <section>
<table>
  <tr class="bordeC size">
    <th>Código</th>
    <th>Descripción</th>
    <th>Créditos</th>
  </tr>
      
 <tbody>
                                  <?php
                                    
                                    //CAMBIAR PARA TODOS 
                                    $sql ="SELECT crse_code, crse_description, crse_credits
                                    FROM departmental_courses WHERE crse_major = '$cohort'";
                                  $result = mysqli_query($conn, $sql);
                                  $resultCheck = mysqli_num_rows($result);
                            
                              if($resultCheck > 0){
                              while($row = mysqli_fetch_assoc($result)){
                                 echo " <tr class='tablaC'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";
                                        if($resultCheck > 0){
                              while($row = mysqli_fetch_assoc($result)){
                              $sql_grade =" SELECT crse_code, crse_grade
                                            FROM stdnt_record 
                                            WHERE crse_code = '{$row['crse_code']}' AND stdnt_number = '840-16-4235'
                                            UNION
                                            SELECT crse_code, crse_grade
                                            FROM stdnt_record 
                                            WHERE crse_code = '{$row['crse_code']}' AND stdnt_number = '840-16-4235'";
                                  $result_grade = mysqli_query($conn, $sql_grade);
                                  $resultCheck_grade = mysqli_num_rows($result_grade);                                   
                                  
                                  if($resultCheck_grade > 0){
                                  $row_grade = mysqli_fetch_assoc($result_grade);
                                  
                                  if(      $row_grade['crse_grade'] == 'A' OR $row_grade['crse_grade'] == 'B' OR
                                           $row_grade['crse_grade'] == 'C'){
                                       echo " <tr class='tablaC' width='50%' style='background-color: rgb(0,204,0,0.3)'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";}
                                         else{
                                      echo " <tr class='tablaC' width='50%' style='background-color: rgb(255,153,51,0.3)'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";}} 
                                  else {
                                        echo " <tr class='tablaC'>
                                        <td>{$row['crse_code']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                        </tr>";}}}}}
?>
</tbody>
    
</table>
</div>
</div>
</div>
</div>

        
<!-- Culmina la parte de los TABS para los Cohortes. -->           
      </div>

      
 <!-- Este SCRIPT es para bregar con las appointment (en calendario) indicando de que fecha a que fecha estara disponible ese calendario, con las horas y dias disponibles de los advisors a cargo. -->
  <script>
        //     function delBoxes(){
        // var boxes = document.getElementsByClassName('chk');
        // var texts = document.getElementsByClassName('txt');
        // for(var i = 0; i<boxes.length; i++){
        // box = boxes[i];
        // txt = texts[i];
        // if(box.checked){
        //     box.parentNode.removeChild(box);
        //     txt.parentNode.removeChild(txt);
        // }}}
</script> 
      
      
      <script src="index.js"></script>
        <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
        <script src="jqueryui/jquery-ui.js"></script>
        <script>
            $("#datepicker").datepicker({
                changeMonth: true,
                minDate: new Date(2020, 09, 4),
                maxDate: new Date(2020, 12, 15)
            });
        </script>

        <script>
            function getAvailableDates(date){
                var xmlhttp = new XMLHttpRequest();
                 xmlhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
               document.querySelector('.spots-available').innerHTML  =  this.responseText;
             
            }
      }
      let dateFormatted = date.split('/').reverse();
      const temp = dateFormatted[1];
      dateFormatted[1] = dateFormatted[2];
      dateFormatted[2] = temp;
      dateFormatted = dateFormatted.join('-');
      
      xmlhttp.open("GET", "private/get-available-dates.php?date=" + dateFormatted, true);
      xmlhttp.send();
    };
    
       function getHourOfMeeting(hour){
        let editHour = hour.split(' ');
        editHour = editHour[0];
        
        
        let input = document.createElement("INPUT");
        input.setAttribute("type", "text");
        input.className = 'hour-chosen';
        input.name = "hour-chosen";
        input.setAttribute('value', editHour);
        input.readOnly = true;
        document.querySelector('.hour-chosen-container').innerHTML = 'Hora: ';
        document.querySelector('.hour-chosen-container').appendChild(input);
       }
        </script>
<!-- Culmina la parte del SCRIPT del calendario para sacar appointment -->
<!-- Script para seleccionar todos los checkbox -->
<script>
function toggle(source) {
              checkboxes = document.getElementsByName('crse_code[]');
              for(var i=0, n=checkboxes.length;i<n;i++) {
                  checkboxes[i].checked = source.checked;
              }
            }
</script>
<!-- Culmina scripts de checkbox -->

<!-- script de confirmacion de equivalencias y convalidaciones -->
          <script>
            function myFunction(className) {
                  console.log(className); 
                  document.getElementById("conv_env-submit").value = className;
                  document.getElementById('equi-conv').style.display='block';
            }

            function equi_conv() {
                  document.getElementById('equi-conv').style.display='none';
            }
          </script>
<!-- /script de equi_conv -->

<!-- Aqui se encuentran varios SCRIPTS que hacen el funcionamiento de la pagina. -->     
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/main.js"></script>
  <script src="js/consejeria.js">
  </script>  
  <script src="AdminUPRA//plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminUPRA//plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminUPRA/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="AdminUPRA/dist/js/demo.js"></script>
  <script>
  function toggle(source) {
              checkboxes = document.getElementsByName('crse_code[]');
              for(var i=0, n=checkboxes.length;i<n;i++) {
                  checkboxes[i].checked = source.checked;
              }
              }
  
              function con_list(clase) {
                    var str = document.getElementById("con_table").innerHTML; 
                    var list = `${clase}`;
                    const regex =  new RegExp(list,'g'); // correct way
                    var crs_var = str.replace(regex, "");
                    var res = crs_var.replace(/\W*(<tr class="list">)\s\W*(<td class="list"><.td>)\s\W*(<td><button onclick="con_list)\W*[('')">x]\W*(<.button><.td>)\s\W*(<.tr>)/g, "");
                    var res_case2 = res.replace(/\W*(<tr><td class="list"><.td>)\s\W*(<td><button onclick="con_list)\W*[('')">x]\W*(<.button><.td>)\s\W*(<.tr>)/g, "");
                    document.getElementById("con_table").innerHTML = res_case2;
                    let inputs = document.getElementById(clase);
                    inputs.checked = false;
                    for (var i = 0; i < concentracion.length; i++){
                      if (concentracion[i][0] === clase){
                        concentracion.splice(i);
                        break;
                      }
                    }
                  }
              
                  function gen_list(clase) {
                    var str = document.getElementById("gen_table").innerHTML; 
                    var list = `${clase}`;
                    const regex =  new RegExp(list,'g'); // correct way
                    var crs_var = str.replace(regex, "");
                    var res = crs_var.replace(/\W*(<tr class="list">)\W\s\W*(<td class="list"><.td>)\W\s\W*(td><button onclick="gen_list)\W['']\W*(x<.button><.td>)\s\W*(.tr>)/g, "");
                    document.getElementById("gen_table").innerHTML = res;
                    let inputs = document.getElementById(clase);
                    inputs.checked = false;
                    for (var i = 0; i < general.length; i++){
                      if (general[i][0] === clase){
                        general.splice(i);
                        break;
                      }
                    }
                  }

                  function hum_list(clase) {
                    var str = document.getElementById("hum_table").innerHTML; 
                    var list = `${clase}`;
                    const regex =  new RegExp(list,'g'); // correct way
                    var crs_var = str.replace(regex, "");
                    var res = crs_var.replace(/\W*(<tr class="list">)\W\s\W*(<td class="list"><.td>)\W\s\W*(td><button onclick="hum_list)\W['']\W*(x<.button><.td>)\s\W*(.tr>)/g, "");
                    document.getElementById("hum_table").innerHTML = res;
                    let inputs = document.getElementById(clase);
                    inputs.checked = false;
                    for (var i = 0; i < huma.length; i++){
                      if (huma[i][0] === clase){
                        huma.splice(i);
                        break;
                      }
                    }
                  }

                  function ciso_list(clase) {
                    var str = document.getElementById("ciso_table").innerHTML; 
                    var list = `${clase}`;
                    const regex =  new RegExp(list,'g'); // correct way
                    var crs_var = str.replace(regex, "");
                    var res = crs_var.replace(/\W*(<tr class="list">)\W\s\W*(<td class="list"><.td>)\W\s\W*(td><button onclick="ciso_list)\W['']\W*(x<.button><.td>)\s\W*(.tr>)/g, "");
                    document.getElementById("ciso_table").innerHTML = res;
                    let inputs = document.getElementById(clase);
                    inputs.checked = false;
                    for (var i = 0; i < ciencias_so.length; i++){
                      if (ciencias_so[i][0] === clase){
                        ciencias_so.splice(i);
                        break;
                      }
                    }
                  }

                  function lib_list(clase) {
                    var str = document.getElementById("lib_table").innerHTML; 
                    var list = `${clase}`;
                    const regex =  new RegExp(list,'g'); // correct way
                    var crs_var = str.replace(regex, "");
                    var res = crs_var.replace(/\W*(<tr class="list">)\W\s\W*(<td class="list"><.td>)\W\s\W*(td><button onclick="lib_list)\W['']\W*(x<.button><.td>)\s\W*(.tr>)/g, "");
                    document.getElementById("lib_table").innerHTML = res;
                    let inputs = document.getElementById(clase);
                    inputs.checked = false;
                    for (var i = 0; i < libre.length; i++){
                      if (libre[i][0] === clase){
                        libre.splice(i);
                        break;
                      }
                    }
                  }

                  function dept_list(clase) {
                    var str = document.getElementById("dept_table").innerHTML; 
                    var list = `${clase}`;
                    const regex =  new RegExp(list,'g'); // correct way
                    var crs_var = str.replace(regex, "");
                    var res = crs_var.replace(/\W*(<tr class="list">)\W\s\W*(<td class="list"><.td>)\W\s\W*(td><button onclick="dept_list)\W['']\W*(x<.button><.td>)\s\W*(.tr>)/g, "");
                    document.getElementById("dept_table").innerHTML = res;
                    let inputs = document.getElementById(clase);
                    inputs.checked = false;
                    for (var i = 0; i < departamento.length; i++){
                      if (departamento[i][0] === clase){
                        departamento.splice(i);
                        break;
                      }
                    }
                  }

                  function clear_list(table) {
                    document.getElementById(`${table}`).innerHTML = "";
                    
                    if (table === "con_table") {
                      for (var i = 0; i < concentracion.length; i++){
                        let inputs = document.getElementById(concentracion[i][0]);
                        inputs.checked = false;
                      }
                      concentracion = [];
                      console.table(concentracion);
                    }else if (table === "gen_table") {
                      for (var i = 0; i < general.length; i++){
                        let inputs = document.getElementById(general[i][0]);
                        inputs.checked = false;
                      } 
                      general = [];
                      console.table(general);
                    }else if (table === "hum_table") {
                      for (var i = 0; i < huma.length; i++){
                        let inputs = document.getElementById(huma[i][0]);
                        inputs.checked = false;
                      } 
                      huma = [];
                    }else if (table === "ciso_table") {
                      for (var i = 0; i < ciencias_so.length; i++){
                        let inputs = document.getElementById(ciencias_so[i][0]);
                        inputs.checked = false;
                      } 
                      ciencias_so = [];
                    }else if (table === "lib_table") {
                      for (var i = 0; i < libre.length; i++){
                        let inputs = document.getElementById(libre[i][0]);
                        inputs.checked = false;
                      } 
                      libre = [];
                    }else if (table === "dept_table") {
                      for (var i = 0; i < departamento.length; i++){
                        let inputs = document.getElementById(departamento[i][0]);
                        inputs.checked = false;
                      } 
                      departamento = [];
                    }
                  }

                  document.getElementById('modal-btn').onclick = function() {
                    document.getElementById('confirm_table').innerHTML = '';
                    for (var i = 0; i < concentracion.length; i++){
                    var table = document.getElementById('confirm_table').innerHTML;
                    document.getElementById('confirm_table').innerHTML = `
                    ${table}
                            <tr width"50%" style="background-color: rgb(155,155,155,0.3)">
                                        <input type="hidden" name="crse_code[]" value="${concentracion[i][0]}" />
                                        <td>${concentracion[i][0]}</td>
                                        <td>${concentracion[i][1]}</td>
                                        <td>${concentracion[i][2]}</td>
                                      </tr> `;
                    }
                    for (var i = 0; i < general.length; i++){
                    var table = document.getElementById('confirm_table').innerHTML;
                    document.getElementById('confirm_table').innerHTML = `
                    ${table}
                            <tr width"50%" style="background-color: rgb(155,155,155,0.3)">
                                        <input type="hidden" name="crse_code[]" value="${general[i][0]}" />
                                        <td>${general[i][0]}</td>
                                        <td>${general[i][1]}</td>
                                        <td>${general[i][2]}</td>
                                      </tr> `;
                    }
                    for (var i = 0; i < huma.length; i++){
                    var table = document.getElementById('confirm_table').innerHTML;
                    document.getElementById('confirm_table').innerHTML = `
                    ${table}
                            <tr width"50%" style="background-color: rgb(155,155,155,0.3)">
                                        <input type="hidden" name="crse_code[]" value="${huma[i][0]}" />
                                        <td>${huma[i][0]}</td>
                                        <td>${huma[i][1]}</td>
                                        <td>${huma[i][2]}</td>
                                      </tr> `;
                    }
                    for (var i = 0; i < ciencias_so.length; i++){
                    var table = document.getElementById('confirm_table').innerHTML;
                    document.getElementById('confirm_table').innerHTML = `
                    ${table}
                            <tr width"50%" style="background-color: rgb(155,155,155,0.3)">
                                        <input type="hidden" name="crse_code[]" value="${ciencias_so[i][0]}" />
                                        <td>${ciencias_so[i][0]}</td>
                                        <td>${ciencias_so[i][1]}</td>
                                        <td>${ciencias_so[i][2]}</td>
                                      </tr> `;
                    }
                    for (var i = 0; i < libre.length; i++){
                    var table = document.getElementById('confirm_table').innerHTML;
                    document.getElementById('confirm_table').innerHTML = `
                    ${table}
                            <tr width"50%" style="background-color: rgb(155,155,155,0.3)">
                                        <input type="hidden" name="crse_code[]" value="${libre[i][0]}" />
                                        <td>${libre[i][0]}</td>
                                        <td>${libre[i][1]}</td>
                                        <td>${libre[i][2]}</td>
                                      </tr> `;
                    }
                    for (var i = 0; i < departamento.length; i++){
                    var table = document.getElementById('confirm_table').innerHTML;
                    document.getElementById('confirm_table').innerHTML = `
                    ${table}
                            <tr width"50%" style="background-color: rgb(155,155,155,0.3)">
                                        <input type="hidden" name="crse_code[]" value="${departamento[i][0]}" />
                                        <td>${departamento[i][0]}</td>
                                        <td>${departamento[i][1]}</td>
                                        <td>${departamento[i][2]}</td>
                                      </tr> `;
                    }
                  }

  function pass() {
    pass1 = document.getElementById("new_pass").value;
    pass2 = document.getElementById("stdnt_password").value;

    if (pass1 == pass2) {
      document.getElementById("pass_form").submit();
    }else {
      alert("Contraseñas no son iguales!");
    }
  }
  </script>
<!-- Culmina la parte de los JS. -->
</div>
</body>
</html>