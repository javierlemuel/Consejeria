<?php
require 'connection.php';
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $cohort_year = mysqli_real_escape_string($conn, $_POST['cohort_year']);
    $concentracion = mysqli_real_escape_string($conn, $_POST['concentracion']);
    $general = mysqli_real_escape_string($conn, $_POST['general']);
    $cred_dept = mysqli_real_escape_string($conn, $_POST['cred_dept']);
    $cred_free = mysqli_real_escape_string($conn, $_POST['cred_free']);
    $cred_ciso = mysqli_real_escape_string($conn, $_POST['cred_ciso']);
    $cred_huma = mysqli_real_escape_string($conn, $_POST['cred_huma']);
    $pre_co = mysqli_real_escape_string($conn, $_POST['pre_co']);
    $class_year = mysqli_real_escape_string($conn, $_POST['class_year']);
    $save_method = mysqli_real_escape_string($conn, $_POST['save_method']);
    echo $save_method;
    echo "<br>";
    // turn variable concentracion into multidimensional array
    $con_count = 0;
    $con_temp = array();
    $con_array = array();
    $concentracion = explode(",",$concentracion);
    if(count($concentracion) > 3){
        foreach($concentracion as $con_item){
            if ($con_item != ""){
                array_push($con_temp, $con_item);
                $con_count++;
                
                if($con_count === 3){
                    array_push($con_array, [$con_temp[0], $con_temp[1], $con_temp[2]]);
                    $con_temp = array(); 
                    $con_count = 0;  
                }
            }
        }
    }else {
        array_push($con_array, [$concentracion[0], $concentracion[1], $concentracion[2]]);
    }

        // turn variable general into multidimensional array
        $gen_count = 0;
            $gen_temp = array();
            $gen_array = array();
            $general = explode(",",$general);
            if(count($general) > 3){
            foreach($general as $gen_item){
                    array_push($gen_temp, $gen_item);
                    $gen_count++;

                    if($gen_count === 3){
                        array_push($gen_array, [$gen_temp[0], $gen_temp[1], $gen_temp[2]]);
                        $gen_temp = array(); 
                        $gen_count = 0;
                    }
            }
        }else {
            array_push($gen_array, [$general[0], $general[1], $general[2]]);
        }
    // turn variable pre_co into multidimensional array
    $req_count = 0;
    $req_temp = array();
    $req_array = array();
    $pre_co = explode(",",$pre_co);
    if(count($pre_co) > 3){
        foreach($pre_co as $req_item){
            
                array_push($req_temp, $req_item);
                $req_count++;
                if($req_count === 3){
                    array_push($req_array, [$req_temp[0], $req_temp[1], $req_temp[2]]);
                    $req_temp = array(); 
                    $req_count = 0;
                }
        }
    }else {
        array_push($req_array, [$pre_co[0], $pre_co[1], $pre_co[2]]);
    }

    // turn variable class_year into multidimensional array
    $year_count = 0;
    $year_temp = array();
    $year_array = array();
    $class_year = explode(",",$class_year);
    if(count($class_year) > 3){
        foreach($class_year as $year_item){
                array_push($year_temp, $year_item);
                $year_count++;
                if($year_count === 3){
                    array_push($year_array, [$year_temp[0], $year_temp[1], $year_temp[2]]);
                    $year_temp = array(); 
                    $year_count = 0;
                }
        }
    }else {
        array_push($year_array, [$class_year[0], $class_year[1], $class_year[2]]);
    }
    
    // Subir Cohorte
            // Subir Departamentales
            for ($i = 0; $i < count($con_array); $i++){
                for ($j = 0; $j < count($year_array); $j++){
                    if($year_array[$j][0] === $con_array[$i][0]){
                        $temp = $con_array[$i][0];
                        if($save_method == 'Crear'){
                        $sql = "INSERT INTO cohort(crse_code, cohort_year, crse_year, crse_semester, crse_major) 
                        VALUES ('$temp', '$cohort_year', ".$year_array[$j][1].", ".$year_array[$j][2].", '$dept')";
                        }elseif ($save_method == 'Editar'){
                            $sql = "UPDATE cohort SET crse_code = '$temp' AND crse_year = ".$year_array[$j][1]." AND crse_semester = ".$year_array[$j][2]." 
                                    WHERE crse_major = '$dept' AND cohort_year = '$cohort_year'";
                        }
                        // Prepare statement
                        $stmt = $conn->prepare($sql);
                        // execute the query
                        $stmt->execute();
                    break;
                    }
                }
            }
            // Subir Generales
            for ($i = 0; $i < count($gen_array); $i++){
                for ($j = 0; $j < count($year_array); $j++){
                    if($year_array[$j][0] === $gen_array[$i][0]){
                        $temp = $gen_array[$i][0];
                        if($save_method == 'Crear'){
                        $sql = "INSERT INTO cohort(crse_code,cohort_year,crse_year,crse_semester,crse_major) 
                        VALUES ('$temp' , $cohort_year, ".$year_array[$j][1].", ".$year_array[$j][2].", '$dept')";
                        }elseif ($save_method == 'Editar'){
                            $sql = "UPDATE cohort SET crse_code = '$temp' AND crse_year = ".$year_array[$j][1]." AND crse_semester = ".$year_array[$j][2]." 
                                    WHERE crse_major = '$dept' AND cohort_year = '$cohort_year'";
                        }
                        // Prepare statement
                        $stmt = $conn->prepare($sql);
                        // execute the query
                        $stmt->execute();
                    break;
                    }
                }
            }
    // Descripcion & Credits of Mandatory
    for ($i = 0; $i < count($con_array); $i++){
        if($save_method == 'Crear'){
        $sql = "INSERT INTO mandatory_courses (crse_code,crse_description,crse_credits) VALUES ('".$con_array[$i][0]."','".$con_array[$i][1]."', ".$con_array[$i][2].")";
        }elseif ($save_method == 'Editar'){
            $sql = "UPDATE mandatory_courses SET crse_description = '".$con_array[$i][1]."' AND crse_credits = ".$con_array[$i][2]." 
                    WHERE crse_code = '".$con_array[$i][0]."'";
        }
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    }
    // Descripcion & Credits of General
    for ($i = 0; $i < count($gen_array); $i++){
        if($save_method == 'Crear'){
        $sql = "INSERT INTO general_courses (crse_code,crse_description,crse_credits) VALUES ('".$gen_array[$i][0]."','".$gen_array[$i][1]."', ".$gen_array[$i][2].")";
    }elseif ($save_method == 'Editar'){
        $sql = "UPDATE general_courses SET crse_description = '".$gen_array[$i][1]."' AND crse_credits = ".$gen_array[$i][2]." 
                WHERE crse_code = '".$gen_array[$i][0]."'";
    }
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    }

 
    // Pre-requisitos & Co-requisitos
    for ($i = 0; $i < count($req_array); $i++){
        if($save_method == 'Crear'){
        $sql = "INSERT INTO scheme(crse_code,crse_PRE, crse_CO, crse_major, cohort_year)
        VALUES ('".$req_array[$i][0]."', '".$req_array[$i][1]."', '".$req_array[$i][1]."', '$dept', $cohort_year)";
        }elseif ($save_method == 'Editar'){
            $sql_del = "DELETE FROM `scheme` WHERE crse_major = '$dept' AND cohort_year = $cohort_year";
            $sql = "INSERT INTO scheme(crse_code,crse_PRE, crse_CO, crse_major, cohort_year)
        VALUES ('".$req_array[$i][0]."', '".$req_array[$i][1]."', '".$req_array[$i][1]."', '$dept', $cohort_year)";
        }
        // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    }
    // Add Credits
    if($save_method == 'Crear'){
        $sql = "INSERT INTO crsecredits_extra (crseCredits_huma,crseCredits_ciso,crseCredits_dept,crseCredits_avz,crseCredits_int,crseCredits_free,crse_major,cohort_year)
        VALUES ( ".$cred_huma.", ".$cred_ciso.", ".$cred_dept.",NULL ,NULL, ".$cred_free.", '".$dept."', $cohort_year)";
        }elseif ($save_method == 'Editar'){
            $sql_del = "DELETE FROM `crse_credits_extra` WHERE crse_major = '$dept' AND cohort_year = $cohort_year";
            $sql = "INSERT INTO crsecredits_extra (crseCredits_huma,crseCredits_ciso,crseCredits_dept,crseCredits_avz,crseCredits_int,crseCredits_free,crse_major,cohort_year)
            VALUES ( ".$cred_huma.", ".$cred_ciso.", ".$cred_dept.",NULL ,NULL, ".$cred_free.", '".$dept."', $cohort_year)";
        }
    // Prepare statement
    $stmt = $conn->prepare($sql);
    // execute the query
    $stmt->execute();
    //exit
    header("Location: ../inicio.php");
    exit();
?>