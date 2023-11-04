<?php

class CreateClassModel {
    public function createCcomCourse($conn, $crse_code, $crse_name, $cred,
    $type, $level)
    {
        $sql = "SELECT *
                FROM ccom_courses
                WHERE crse_code = '$crse_code'";
            
        $result = $conn->query($sql);

        //Find if the course already exits
        if($result)
        {
            //If it doesn't exist, create new course
            if ($result->num_rows == 0)
            {
                $sql = "INSERT INTO ccom_courses
                        VALUES('$crse_code', '$crse_name', $cred, '$type', '$level')";
                
                $result = $conn->query($sql);
                if ($result === false) {
                    throw new Exception("Error en la consulta SQL: " . $conn->error);
                }
            }
            else //return false if course exists
            {
                return false;
            }
        }
        return $result;
    }

    public function createGeneralCourse($conn, $crse_code, $crse_name, $cred,
    $type, $required)
    {
        $sql = "SELECT *
                FROM general_courses
                WHERE crse_code = '$crse_code'";
            
        $result = $conn->query($sql);

        //Find if the course already exits
        if($result)
        {
            //If it doesn't exist, create new course
            if ($result->num_rows == 0)
            {
                $sql = "INSERT INTO general_courses
                        VALUES('$crse_code', '$crse_name', $cred, '$type', '$required')";
                
                $result = $conn->query($sql);
                if ($result === false) {
                    throw new Exception("Error en la consulta SQL: " . $conn->error);
                }
            }
            else //return false if course exists
            {
                return false;
            }
        }
        return $result;
    }
}