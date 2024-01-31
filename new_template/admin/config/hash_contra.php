<?php 
    $titulo = "Actualizar contrasena";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $titulo; ?></title>
        <link rel="stylesheet" href="php.css">
    </head>
    
    <body>
        <div>
            <h1>Tema principal de la página</h1>
			<?php
                include_once"database.php";
                $pass = "pass1234";
                $hash = password_hash($pass, PASSWORD_DEFAULT);

                $query = "UPDATE advisor
                          SET pass='$hash';";
                if ($conn->query($query) === TRUE)
                {
                    echo"<h3>contrasena acutalizada correctamente.<h3>";
                }
                else
                {
                    echo "<h3>Query error: " . $conn->error . "</h3>";
                }
            ?>
        </div> 
    </body>
</html>