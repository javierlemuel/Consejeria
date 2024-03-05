<?php
// models/StudentModel.php
class ReporteModel {

   public function getStudentsAconsejados($conn){
        $sql = "SELECT COUNT(DISTINCT student_num) AS count
        FROM recommended_courses";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        
        if ($result->num_rows > 0)
            foreach($result as $res)
                return $res['count'];
        else    
            return 0;

   }

   public function getStudentsSinCCOM($conn)
   {
        $sql = "SELECT COUNT(DISTINCT student_num) AS count
        FROM recommended_courses
        WHERE student_num NOT IN (
            SELECT DISTINCT student_num
            FROM recommended_courses
            WHERE crse_code LIKE 'CCOM%'
            )";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        if ($result->num_rows > 0)
            foreach($result as $res)
                return $res['count'];
        else    
            return 0;
   }

   public function getRegistrados($conn){
        $sql = "SELECT COUNT(DISTINCT student_num) AS count
        FROM will_take;";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        if ($result->num_rows > 0)
            foreach($result as $res)
                return $res['count'];
        else    
            return 0;

   }

   public function getEditados($conn)
   {
        $sql = "SELECT COUNT(edited_date) AS count
                FROM student
                WHERE edited_date != NULL";
        $result = $conn->query($sql);
        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        if ($result->num_rows > 0)
            foreach($result as $res)
                return $res['count'];
        else    
            return 0;
   }


   public function getStudentsPerClass($conn){
        $sql = "SELECT crse_code, COUNT(*) AS count
        FROM ccom_courses NATURAL JOIN recommended_courses
        WHERE crse_code LIKE 'CCOM%'
        GROUP BY crse_code;";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;

   }

   public function getTerm($conn){
        $sql = "SELECT DISTINCT term
                FROM offer";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        foreach ($result as $res)
            $term = $res['term'];

        return $term;
        
   }
}