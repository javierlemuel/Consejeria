<?php
include_once 'connection.php';
session_start();
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( empty($_POST['email']) &&  empty($_POST['password'])) {
    // Could not get the data that should have been sent.
    header('Location: ../index.php?isEmailEmpty=true&isPasswordEmpty=true');
	exit();
} elseif(empty($_POST['email'])) {
    header('Location:  ../index.php?isEmailEmpty=true');
	exit();
} elseif(empty($_POST['password'])){
    header('Location:  ../index.php?isPasswordEmpty=true');
	exit();
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT adv_password, adv_name FROM advisor WHERE adv_email= ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($password, $name);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        // =============REMEMBER TO USE PASSWORD ENCRYPTION ====================
        $pass = urlencode($password);
        $pass_crypt = crypt($pass);
        
   
        if ($pass_crypt == crypt($pass, $pass_crypt)) {
            // Verification success! User has loggedin!
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['adv_name'] = $name;
            $_SESSION['adv_email'] = $_POST['email'];
            
             header('Location: ../inicio.php');
            
        } else {
            // Incorrect password
            header('Location:  ../index.php?isAuthFailed=true');
	          exit();
            echo 'Incorrect username and/or password!';
        }
    } else {
        // Incorrect username
        header('Location:  ../index.php?isAuthFailed=true');
	    exit();
        echo 'Incorrect username and/or password!';
    }




	$stmt->close();
}
?>