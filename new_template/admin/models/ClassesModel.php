<?php
// models/StudentModel.php
class ClassesModel {

    public function getCcomCourses($conn)
    {
        $sql = "SELECT crse_code, name, credits
                FROM ccom_courses 
                WHERE type = 'mandatory' 
                ORDER BY crse_code ASC";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        // $students = [];
        // while ($row = $result->fetch_assoc()) {
        //     $student_num = $row['student_num'];
        //     $formatted_student_num = substr($student_num, 0, 3) . '-' . substr($student_num, 3, 2) . '-' . substr($student_num, 5);
        //     $row['formatted_student_num'] = $formatted_student_num;
        //     $students[] = $row;
        // }

        return $result;
    }

    public function getCcomElectives($conn)
    {
        $sql = "SELECT *
                FROM ccom_courses
                WHERE type != 'mandatory'
                ORDER BY crse_code ASC";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function getGeneralCourses($conn)
    {
        $sql = "SELECT *
                FROM general_courses
                ORDER BY crse_code ASC";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function getDummyCourses($conn)
    {
        $sql = "SELECT *
                FROM dummy_courses
                ORDER BY crse_code ASC";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function getCohortCoursesWgradesCCOM($conn, $studentCohort, $student_num)
    {
        $sql = "SELECT cohort.crse_code, ccom_courses.name, ccom_courses.credits, student_courses.crse_grade,
                        student_courses.equivalencia, student_courses.convalidacion
                FROM cohort
                JOIN ccom_courses ON cohort.crse_code = ccom_courses.crse_code
                LEFT JOIN student_courses ON cohort.crse_code = student_courses.crse_code
                    AND cohort.cohort_year = $studentCohort
                    AND student_courses.student_num = $student_num
                WHERE cohort.cohort_year = $studentCohort
                ORDER BY cohort.crse_code ASC;";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function getCohortCoursesWgradesCCOMfree($conn, $studentCohort, $student_num)
    {
        $sql = "SELECT c.crse_code, c.name, c.credits, sc.crse_grade, sc.equivalencia, sc.convalidacion
                FROM ccom_courses c
                JOIN student_courses sc ON c.crse_code = sc.crse_code
                WHERE sc.student_num = $student_num
                AND c.crse_code NOT IN (
                    SELECT co.crse_code
                    FROM cohort co
                    WHERE co.cohort_year = $studentCohort
                )
                ORDER BY c.crse_code ASC;
                ";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function getCohortCoursesWgradesNotCCOMfree($conn, $studentCohort, $student_num)
    {
        $sql = "SELECT c.crse_code, c.name, c.credits, sc.crse_grade, sc.equivalencia, sc.convalidacion
                FROM general_courses c
                JOIN student_courses sc ON c.crse_code = sc.crse_code
                WHERE sc.student_num = $student_num
                AND c.crse_code NOT IN (
                    SELECT co.crse_code
                    FROM cohort co
                    WHERE co.cohort_year = $studentCohort
                )
                ORDER BY c.crse_code ASC;
                ";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function getCohortCoursesWgradesNotCCOM($conn, $studentCohort, $student_num)
    {
        $sql = "SELECT cohort.crse_code, general_courses.name, general_courses.credits, student_courses.crse_grade,
                        student_courses.equivalencia, student_courses.convalidacion
                FROM cohort
                JOIN general_courses ON cohort.crse_code = general_courses.crse_code
                LEFT JOIN student_courses ON cohort.crse_code = student_courses.crse_code
                    AND cohort.cohort_year = $studentCohort
                    AND student_courses.student_num = $student_num
                WHERE cohort.cohort_year = $studentCohort
                ORDER BY cohort.crse_code ASC;";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function getAllOtherCoursesWgrades($conn, $student_num)
    {
        $sql = "SELECT *
                FROM student_courses
                WHERE crse_code NOT IN (
                    SELECT crse_code
                    FROM ccom_courses
                    UNION
                    SELECT crse_code
                    FROM general_courses
                )
                AND student_num = $student_num;
                ";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function getOfferCourses($conn)
    {
        $termA = $this->getTerm($conn);
        $sql = "SELECT *
                FROM offer
                WHERE crse_code != 'XXXX'
                AND term = '$termA'
                ORDER BY crse_code ASC";

        $result = $conn->query($sql);
        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $courses = [];

        while ($row = $result->fetch_assoc()) {
            $code = $row['crse_code'];
            $term = $row['term'];
            $sql2 = "SELECT *
                    FROM ccom_courses
                    WHERE crse_code = '$code'
                    UNION ALL
                    SELECT *
                    FROM general_courses
                    WHERE crse_code = '$code'";
            $result2 = $conn->query($sql2);

            if ($result2 === false) {
                throw new Exception("Error2 en la consulta SQL: " . $conn->error);
            }
            
            $combinedData = [];

            while($row2 = $result2->fetch_assoc()) {
               $combinedData[] = $row2;
            }
            foreach ($combinedData as &$data) {
                $data['term'] = $term;
            }
            $courses = array_merge($courses, $combinedData);
        }

        // foreach ($courses as $course) {
        //     echo $course['name'];
        // }

        // echo "hey";

        return $courses;

    }

    public function addToOffer($conn,$courseID)
    {
        //Verifica que el curso no exista ya en la oferta
        $sql = "SELECT term
                FROM offer
                WHERE crse_code = '$courseID'";
        $result = $conn->query($sql);   

        if ($result->num_rows == 0)
        {
            $sql = "SELECT term
                    FROM offer
                    WHERE crse_code = 'XXXX'";

            $res = $conn->query($sql);
            if ($res === false) {
                throw new Exception("Error en la consulta SQL: " . $conn->error);
            }
            else{
                foreach($res as $r)
                    $term = $r['term'];
            
                $sql2 = "INSERT INTO offer
                        VALUES('$courseID', '$term')";
                
                $result = $conn->query($sql2);
                if ($result === false) {
                    throw new Exception("Error en la consulta SQL: " . $conn->error);
                }

                return 'success';
            }
        }

        return 'failure';
    }

    public function removeFromOffer($conn,$courseID){
        $sql = "DELETE FROM offer
                WHERE crse_code = '$courseID'";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;
    }

    public function setNewTerm($conn, $term)
    {
        //Estamos seteando un nuevo semestre de consejeria

        //Borramos los cursos en oferta del semestre pasado
        // $sql = "DELETE FROM offer
        //         WHERE term != ''";
        // $result = $conn->query($sql);
        // if ($result === false) {
        //     throw new Exception("Error en la consulta SQL: " . $conn->error);
        // }

        //Borramos los edit flags de los estudiantes
        $sql2 = "UPDATE student
                SET edited_date = NULL
                WHERE edited_date != NULL";
        $result2 = $conn->query($sql2);
        if ($result2 === false) {
            throw new Exception("Error en la consulta SQL KHE: " . $conn->error);
        }

        //Borramos los cursos que los estudiantes escogieron en sus consejerias
        // $sql4 = "DELETE FROM will_take
        //         WHERE crse_code != ''";
        // $result4 = $conn->query($sql4);
        // if ($result4 === false) {
        //     throw new Exception("Error en la consulta SQL: " . $conn->error);
        // }     

        //Insertamos el nuevo term/semestre con el curso 'dummy' XXXX, como row de titulo del term
        $sql5 = "UPDATE offer
                SET term = '$term'
                WHERE crse_code = 'XXXX'";
        $result5 = $conn->query($sql5);
        if ($result5 === false) {   
            throw new Exception("Error2 en la consulta SQL:". $conn->error);
        }

        $sqli = "INSERT INTO OFFER
                VALUES('CCOM3001', '$term'), ('CCOM3002', '$term')";

        $resulti = $conn->query($sqli);
        if($resulti === false)
            throw new Exception("Error Insert Term en la consulta SQL: " . $conn->error);

        return $resulti;
    }

    public function getTerm($conn)
    {
        $sql = "SELECT term
                FROM offer
                WHERE crse_code = 'XXXX'";
        $result = $conn->query($sql);
        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }
        
        while ($row = $result->fetch_assoc()) {
            $term = $row['term'];
            break;
        }

        return $term;

    }

    public function getMatriculadosModel($conn, $course)
    {
        $term = $this->getTerm($conn);
        $sql = "SELECT count(student_num) AS count
                FROM will_take
                WHERE crse_code = '$course'
                AND term = '$term'";
        $result = $conn->query($sql);
        if ($result === false) {
            throw new Exception("Error en la consulta SQL HELLO: " . $conn->error);
        }


        if ($result->num_rows == 0)
            return 0;

        while ($row = $result->fetch_assoc()) {
            $count = $row['count'];
            break;
        }

        return $count;

    }


    public function getStudentsMatriculadosModel($conn, $course)
    {
        $term = $this->getTerm($conn);
        $sql = "SELECT *
                FROM will_take NATURAL JOIN student
                WHERE will_take.student_num = student.student_num AND
                crse_code = '$course'
                AND term = '$term'";
        $result = $conn->query($sql);
        if ($result === false) {
            throw new Exception("Error en la consulta SQL HELLO: " . $conn->error);
        }


        return $result;

    }
}
