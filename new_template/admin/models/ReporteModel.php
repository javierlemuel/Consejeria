<?php
// models/StudentModel.php
class ReporteModel {

   public function getStudentsAconsejados($conn){
        $term = $this->getTerm($conn);
        $sql = "SELECT COUNT(DISTINCT student_num) AS count
        FROM recommended_courses
        WHERE term = '$term'";

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
        $term = $this->getTerm($conn);
        $sql = "SELECT COUNT(DISTINCT student_num) AS count
        FROM recommended_courses
        WHERE student_num NOT IN (
            SELECT DISTINCT student_num
            FROM recommended_courses
            WHERE crse_code LIKE 'CCOM%'
            AND term = '$term'
            )
        AND term = '$term'";
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

   public function getStudentsInfo($conn, $type)
   {
        $term = $this->getTerm($conn);

        if ($type == 'consCCOM')
        {
            $sql = "SELECT student_num, name1, name2, last_name1, last_name2
            FROM recommended_courses NATURAL JOIN student
            WHERE term = '$term'";
        }
        else if ($type == 'consSinCCOM')
        {
            $sql = "SELECT student_num, name1, name2, last_name1, last_name2
            FROM recommended_courses NATURAL JOIN student
            WHERE student_num NOT IN (
                SELECT DISTINCT student_num
                FROM recommended_courses
                WHERE crse_code LIKE 'CCOM%'
                AND term = '$term'
                )
            AND term = '$term'";
        }

        $students = [];
        $result2 = $conn->query($sql);

            if ($result2 === false) {
                throw new Exception("Error2 en la consulta SQL: " . $conn->error);
            }
            
            $combinedData = [];

            while($row2 = $result2->fetch_assoc()) {
               $combinedData[] = $row2;
            }
            foreach ($combinedData as &$data) {
                $data['full_name'] = $data['name1']." ".$data['name2']." ".$data['last_name1']." ".$data['last_name2'];
            }
            $students = array_merge($students, $combinedData);

            return $students;
   }

   public function getRegistrados($conn){
        $term = $this->getTerm($conn);
        $sql = "SELECT COUNT(DISTINCT student_num) AS count
        FROM will_take
        WHERE term = '$term';";
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
        $term = $this->getTerm($conn);
        $sql = "SELECT crse_code, COUNT(*) AS count
        FROM ccom_courses NATURAL JOIN recommended_courses
        WHERE crse_code LIKE 'CCOM%'
        AND term = '$term'
        GROUP BY crse_code;";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;

   }

   public function getTerm($conn){
        $sql = "SELECT term
                FROM offer
                WHERE crse_code = 'XXXX'";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        foreach ($result as $res)
            $term = $res['term'];

        return $term;
        
   }
}