<?php
include 'dbconnect.php';
session_start();
/* ============ MAKE SURE TO SANTITIZE AND VALIDATE USER INPUT ======================
      =============REMEMBER TO USE PASSWORD ENCRYPTION ====================
========= EL ERROR SURGE PORQUE LA BASE DE DATOS NO ACEPTA LA TILDE.========*/

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( empty($_POST['email']) &&  empty($_POST['stdnt_number']) && empty($_POST['dob'])) {
    // Could not get the data that should have been sent.
    header('Location: ../index.php?isEmailEmpty=true&isStudentNumberEmpty=true&isDobEmpty=true');
	exit();
} elseif(empty($_POST['email'])) {
    header('Location: ../index.php?isEmailEmpty=true');
	exit();
} elseif(empty($_POST['stdnt_number'])){
    header('Location: ../index.php?isStudentNumberEmpty=true');
	exit();
}elseif(empty($_POST['dob'])){
    header('Location: ../index.php?isDobEmpty=true');
	exit();
}

echo "<h1>".$_POST['email']."</h1>";
echo "<h1>".$_POST['stdnt_number']."</h1>";
echo "<h1>".$_POST['dob']."</h1>";

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if($stmt = $conn->prepare("SELECT stdnt_number, stdnt_email, stdnt_password, stdnt_lastname1, stdnt_lastname2, stdnt_name, stdnt_initial, stdnt_dob FROM student WHERE stdnt_email = ?")){
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['email']);

	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
    $stmt->store_result();
  
    echo "Verification success! User has loggedin!";
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stdnt_number, $stdnt_email, $stdnt_password,  $stdnt_lastname1, $stdnt_lastname2, $stdnt_name, $stdnt_initial, $stdnt_dob);
        $stmt->fetch();

   
        if ($_POST['stdnt_number'] == $stdnt_number) {
            echo "Verification success! User has loggedin!";
            
            if ($_POST['dob'] == $stdnt_dob) {
            
            // Verification success! User has loggedin!
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['stdnt_number'] = $stdnt_number;
            $_SESSION['stdnt_name'] = $stdnt_name;
            $_SESSION['stdnt_initial'] = $stdnt_initial;
            $_SESSION['stdnt_lastname1'] = $stdnt_lastname1;
            $_SESSION['stdnt_lastname2'] = $stdnt_lastname2; 
            $_SESSION['crse_completename'] = $stdnt_name.'  '.$stdnt_initial.'  '.$stdnt_lastname1.' '.$stdnt_lastname2;
            $_SESSION['stdnt_email'] = $stdnt_email;
            header('Location: ../consejeria.php');
           
        } else {
            // Incorrect Birthday
            header('Location:  ../index.php?isDobEmpty=true');

	        exit();
        
          echo '¡Correo electrónico, Numero de Estudiante o Fecha de Nacimiento Incorrecta!';
        }
        } else {
            // Incorrect Student Number
            header('Location:  ../index.php?isStudentNumberEmpty=true');

	        exit();
        
          echo '¡Correo electrónico, Numero de Estudiante o Fecha de Nacimiento Incorrecta!';
        }
    } else {
        // Incorrect username
        header('Location:  ../index.php?isAuthFailed=true');
	    exit();
        echo '¡Correo electrónico, Numero de Estudiante o Fecha de Nacimiento Incorrecta!';
    }




    $stmt->close();
} else {
    echo $stmt->error();
}
?>