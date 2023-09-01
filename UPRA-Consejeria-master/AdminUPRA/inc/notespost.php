<?php
if (isset($_POST['notes-submit'])) {
require '../../private/dbconnect.php';
    $note = mysqli_real_escape_string($conn, $_POST['text']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "SELECT adv_comments FROM record_details WHERE stdnt_number = '$id'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $sql = "UPDATE record_details SET adv_comments = '$note' WHERE stdnt_number = '$id'";    
                }
    
            
            // Prepare statement
            $stmt = $conn->prepare($sql);
            // execute the query
            if($stmt->execute()){
            //exit
            header("Location: ../est_profile.php");
            exit();
            }
        }
        }else {
   header("Location: ../est_profile.php");
   exit();
}
?>