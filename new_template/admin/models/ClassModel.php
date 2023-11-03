<?php
// models/StudentModel.php
class ClassModel {

    public function getCourse($conn, $course)
    {
        $table = 'general_courses';

        if((strpos($course, 'CCOM') !== false))
            $table = 'ccom_courses';

        $sql = "SELECT *
                FROM $table 
                WHERE crse_code = '$course'";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function updateCourse($conn, $oldcourse, $course_id, $course_name, $credits,
    $type, $level)
    {
        $sql = "UPDATE ccom_courses
                SET crse_code = '$course_id',
                name = '$course_name',
                credits = '$credits',
                type = '$type',
                level = '$level'
                WHERE crse_code = '$oldcourse'
                ";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function updateGeneralCourse($conn, $old_course_id, $course_id, 
    $course_name, $credits, $type, $required)
    {
        $sql = "UPDATE general_courses
                SET crse_code = '$course_id',
                name = '$course_name',
                credits = '$credits',
                type = '$type',
                required = '$required'
                WHERE crse_code = '$old_course_id'
                ";
        
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function getRequisitosModel($conn, $table, $course)
    {
        $sql = "SELECT * 
                FROM $table
                WHERE crse_code = '$course'";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function editRequisites($conn, $course, $table, $prereq, $coreq, $oldprereq, $oldcoreq)
    {
        //Verificar que exista el prequisito en cursos y que no exista en nuestros requisitos
        if($prereq != 'none')
        {
            $sql = "SELECT *
                FROM ccom_courses
                WHERE crse_code = '$prereq'
                UNION ALL
                SELECT *
                FROM general_courses
                WHERE crse_code = '$prereq'";
            $result = $conn->query($sql);  

            if ($result === false) {
                throw new Exception("Error en la consulta SQL: " . $conn->error);
            }

            if ($result->num_rows == 0)
                return "no prereq";


            if($prereq != $oldprereq)
            {
                $sql = "SELECT * 
                FROM $table
                WHERE crse_code = '$course'
                AND prerequisite = '$prereq'";
                $result = $conn->query($sql);
                if ($result === false) {
                    throw new Exception("Error en la consulta SQL: " . $conn->error);
                }
    
                if ($result->num_rows > 0)
                    return 'prereq exists';
            }
           
        }
        

        //Verificar que exista el corequisito en cursos y no exista en nuestros requisitos
        if($coreq != 'none')
        {
            $sql2 = "SELECT *
            FROM ccom_courses
            WHERE crse_code = '$coreq'
            UNION ALL
            SELECT *
            FROM general_courses
            WHERE crse_code = '$coreq'";

            $result2 = $conn->query($sql2);  

            if ($result2 === false) {
                throw new Exception("Error2 en la consulta SQL2: " . $conn->error);
            }

            
            if ($result2->num_rows == 0)
                return "no coreq";


            if($coreq != $oldcoreq){
                $sql2 = "SELECT *
                FROM $table
                WHERE crse_code = '$course'
                AND corequisite = '$coreq'";
                $result2 = $conn->query($sql2);

                if ($result2 === false) {
                    throw new Exception("Error2 en la consulta SQL2: " . $conn->error);
                }

                if ($result2->num_rows > 0)
                    return 'coreq exists';
            }
            
        }


        //Editar los requisitos del curso entonces

        $sql3 = "UPDATE $table
                SET prerequisite = '$prereq',
                corequisite = '$coreq'
                WHERE crse_code = '$course'
                AND prerequisite = '$oldprereq'
                AND corequisite = '$oldcoreq'";
        $result3 = $conn->query($sql3); 

        if ($result3 === false) {
            throw new Exception("Error3 en la consulta SQL3: " . $conn->error);
        }

        return 'success';
    }


    public function deleteReq($conn, $course, $prereq, $coreq, $table)
    {
        $sql = "DELETE FROM $table
                WHERE crse_code = '$course'
                AND prerequisite = '$prereq'
                AND corequisite = '$coreq'";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return 'deleted';

    }

    public function addReq($conn, $course, $prereq, $coreq, $table)
    {
        //Verificar que el prerequisito no exista ya para este curso.
        if($prereq != 'none')
        {
            $sql = "SELECT * 
                FROM $table
                WHERE crse_code = '$course'
                AND prerequisite = '$prereq'";
            $result = $conn->query($sql);
            if ($result === false) {
                throw new Exception("Error en la consulta SQL: " . $conn->error);
            }

            if ($result->num_rows > 0)
                return 'prereq exists';
        }
        

        //Verificar que el corequisito no exista ya para este curso.
        if($coreq != 'none')
        {
            $sql2 = "SELECT *
                FROM $table
                WHERE crse_code = '$course'
                AND corequisite = '$coreq'";
            $result2 = $conn->query($sql2);

            if ($result2 === false) {
                throw new Exception("Error2 en la consulta SQL2: " . $conn->error);
            }

            if ($result2->num_rows > 0)
                return 'coreq exists';
        }
        

        //Verificar que no hayas enviado form sin data.
        if($prereq == 'none' && $coreq == 'none')
            return 'empty';
        
        //Si no existen, insertamos esta fila nueva.

        $sql3 = "INSERT INTO $table
                VALUES('$course', '$prereq', '$coreq')";
        $result3 = $conn->query($sql3);

        if ($result3 === false)
            throw new Exception("Error3 en la consulta SQL3: " . $conn->error);

        return 'insert success';

    }
}