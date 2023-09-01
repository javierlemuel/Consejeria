<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['stdnt_number'])){
  session_destroy();
}
?>
<html lang="en">
  <head>
    <title>CONSEJERÍA-UPRA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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

    <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminUPRA/plugins/fontawesome-free/css/all.min.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="index.php"><img src="image/upraconse.png" width="280" height="60"  alt=""></a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="#home-section" class="nav-link">Inicio</a></li>
                <li><a href="#courses-section" class="nav-link">Acerca</a></li>
              </ul>
            </nav>
          </div>

      
        </div>
      </div>
      
    </header>

    <div class="intro-section" id="home-section">
      
      <div class="slide-1" style="background-image: url('images/laptop.png');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-6 mb-4 hero-text">
                  <h1  data-aos="fade-up" data-aos-delay="100">¡Bienvenidos a Consejería Académica de la Universidad de Puerto Rico Recinto de Arecibo!</h1>
                  <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">En el botón de abajo muestra cómo hacer la Consejería</p>
                  <p data-aos="fade-up" data-aos-delay="300"><button onclick="document.getElementById('id01').style.display='block'" class="btn btn-yellow py-3 px-5 btn-pill">¿Cómo hacer Consejería?</button></p>
                  <!-- modales -->
<div id="id01" class="w3-modal" style="display='none';">
    <div class="w3-modal-content" style="background-color: transparent">
      <div class="w3-container" style="margin-top:20%">
        <video width="100%" controls>
  <source src="video/2020-11-22-18-11-59.mp4" type="video/mp4">
  Your browser does not support HTML video.
</video>
      </div>
    </div>
  </div>

  <script>
      // Get the modal
      var modal = document.getElementById('id01');

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
        }
  </script>
<!-- !modales -->
                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                    
                    <form action="private/auth.php" method="post" class="form-box">
                    <h3 class="h4 text-black mb-4">Iniciar Sesión</h3>
             <?php 
                if(isset($_GET['isEmailEmpty']) || isset($_GET['isStudentNumberEmpty']) || isset($_GET['isDobEmpty'])){
                    echo '<div class="error-message">¡Por favor rellenar todos los campos!</div>';
                } 
                if(isset($_GET['isAuthFailed'])){
                    echo '<div class="error-message">¡Correo electrónico, Numero de Estudiante o Fecha de Nacimiento Incorrecta!</div>';
                }
                ?>
              <div class="form-group">
                <label for="" class="form-group-label">Correo Electrónico</label>
                 <input type="email" name="email"  class="form-control <?= isset($_GET['isEmailEmpty']) && $_GET['isEmailEmpty'] ? 'form-input-invalid' : 'form-input'?>">
                 <?php if(isset($_GET['isEmailEmpty']) && $_GET['isEmailEmpty']) echo '<p class="text-field-error">Por favor proveer Correo Electrónico</p>'?>
              </div>
              <!-- Student Number -->
                        <div class="form-group">
    <label for="stdnt_number" class="form-group-label">Numero de Estudiante</label>
    <input type="text" name="stdnt_number" id="stdnt_number" class="form-control <?= isset($_GET['isStudentNumberEmpty']) && $_GET['isStudentNumberEmpty'] ? 'form-input-invalid' : 'form-input'?>">
    <?php if(isset($_GET['isStudentNumberEmpty']) && $_GET['isStudentNumberEmpty']) echo '<p class="text-field-error">Por favor proveer Numero de Estudiante</p>'?>
                        </div>

                        <!-- Date of Birth -->
        <div class="form-group">
    <label for="dob" class="form-group-label">Fecha de Nacimiento</label>
    <input type="date" name="dob" id="dob" class="form-control">
         <?php if(isset($_GET['isDobEmpty']) && $_GET['isDobEmpty']) echo '<p class="text-field-error">Por favor proveer Fecha de Nacimiento</p>'?>
        </div>

               <div class="login-btn-container"><button type="submit" class="btn btn-yellow btn-pill">Iniciar Sesión</button></div>
         </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="site-section courses-title" id="courses-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Acerca de Nosotros</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="100">
      <div class="container">
        <div class="row">

          <div class="owl-carousel col-12 nonloop-block-14">

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a><img src="images/mision.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><b>Misión</b></h3>
                <p>Los Estudiantes de CCOM nos encargamos en utilizar las tecnologías disponibles a nuestro alcance para desarrollar y optimizar plataformas que asistan a los demás en el proceso de matrícula.</p>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a><img src="images/vision.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><b>Visión</b></h3>
                <p>Deseamos un día proveer esta plataforma a otros departamentos académicos y de esta manera todos los estudiantes de UPRA puedan beneficiarse de una consejería más eficiente y placentera.</p>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a><img src="images/proposito.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><b>Propósito</b></h3>
                <p>El propósito de un sistema de consejería es apoyar al estudiantado y ayudar en la selección de cursos.</p><br><br>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-image overlay" style="background-image: url('images/bd.jpg');">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-8 text-center testimony">
            <img src="images/profeliana.jpg" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
            <h3 class="mb-4">Dra. Eliana Valenzuela Andrade</h3>
            <h3 class="mb-4">Profesora en el Departamento de Ciencias de Cómputos</h3>
            <h3 class="mb-4">Correo Electrónico: eliana.valenzuela@upr.edu</h3>
            <blockquote>
              <p>Eliana Valenzuela Andrade tiene un doctorado en Computación, Ciencias de la Información e Ingeniería, una Maestría en Sistemas de Gestión de Ingeniería de la Universidad de Puerto Rico, Recinto de Mayagüez y una Licenciatura en Ingeniería Industrial de la Universidad de los Andes, en Bogotá, Colombia. Tiene casi quince años de experiencia docente y diez años de experiencia investigadora. Las áreas de investigación de la Dra. Valenzuela Andrade son Sistema de Gestión de Bases de Datos, Minería de Datos, Robótica Educativa, Robótica de Enjambre y Estrategias de Difusión para las carreras STEM, entre otras.</p><br>
              <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved by <a target="_blank" >CONSEJERÍA-UPRA</a><br>Página Oficial: <a href="http://upra.edu/">http://upra.edu/</a></p>
            </blockquote>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- .site-wrap -->

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
    
  </body>
</html>