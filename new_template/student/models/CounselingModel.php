<?php
// models/StudentModel.php
class CounselingModel
{

    public function getRecommendedCourses($conn, $student_num)
    {

        $sql = "SELECT gc.crse_code, gc.name, gc.credits
                FROM recommended_courses rc
                JOIN general_courses gc ON rc.crse_code = gc.crse_code
                WHERE rc.student_num = ?
                UNION
                SELECT cc.crse_code, cc.name, cc.credits
                FROM recommended_courses rc
                JOIN ccom_courses cc ON rc.crse_code = cc.crse_code
                WHERE rc.student_num = ?
                UNION
                SELECT dc.crse_code, dc.name, dc.credits
                FROM recommended_courses rc
                JOIN dummy_courses dc ON rc.crse_code = dc.crse_code
                WHERE rc.student_num = ? ";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("sss", $student_num, $student_num, $student_num);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }

        return $courses;
    }

    public function getConcentrationCourses($conn, $student_num)
    {

        $student_num = intval($student_num);
        //selecciona las clases que estan en offer y ccom_courses pero que el estudiante no haya pasado (crse_status = 'P')
        // y ademas que los cursos no esten en recommended
        $sql = "SELECT of.crse_code, cc.type, cc.name, cc.credits
                FROM offer as of
                NATURAL JOIN ccom_courses AS cc
                WHERE of.crse_code = cc.crse_code
                AND of.crse_code NOT IN (SELECT crse_code FROM student_courses WHERE crse_status = 'P' AND student_num = ?)
                AND of.crse_code NOT IN (SELECT crse_code FROM recommended_courses WHERE student_num = ?)
                AND of.crse_code LIKE 'CCOM%'";



        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("ss", $student_num, $student_num);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }

        return $courses;
    }

    public function getStudentInfo($conn, $student_num)
    {

        $sql = "SELECT name1, name2, last_name1, last_name2, email, student_note  
                FROM student 
                WHERE student_num = ?";


        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_num);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $studentInfo = $result->fetch_assoc();
        if ($studentInfo['name2'] != null) {
            $studentName = $studentInfo['name1'] . " " . $studentInfo['name2'][0] . " " . $studentInfo['last_name1'] . " " . $studentInfo['last_name2'];
        } else
            $studentName = $studentInfo['name1'] . " " . $studentInfo['last_name1'] . " " . $studentInfo['last_name2'];

        $studentInfo['full_student_name'] = $studentName;
        $formatted_student_num = substr($student_num, 0, 3) . '-' . substr($student_num, 3, 2) . '-' . substr($student_num, 5);
        $studentInfo['formatted_student_num'] = $formatted_student_num;

        return $studentInfo;
    }

    public function getGeneralCourses($conn, $student_num)
    {

        //selecciona clases generales que estan en oferta y que el estudiante no haya pasado
        $sql = "SELECT of.crse_code, gc.type, gc.name, gc.credits
                FROM offer as of
                NATURAL JOIN general_courses AS gc
                WHERE of.crse_code = gc.crse_code
                AND of.crse_code NOT IN (SELECT crse_code FROM student_courses WHERE crse_status = 'P' AND student_num = ?)
                AND of.crse_code NOT IN (SELECT crse_code FROM recommended_courses WHERE student_num = ?)
                AND gc.type <> 'FREE'";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $student_num, $student_num);
        //ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $courses = [];
        $requisitos = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }

        foreach ($courses as $course) {
            array_push($requisitos, $course['crse_code']);
        }
        if (!empty($requisitos)) {
            $req = "'" . implode("', '", $requisitos) . "'";  // Enclose values in single quotes

            // Check if $req contains only one value
            if (count($requisitos) == 1) {
                // If there's only one value, no need for IN clause
                $sql2 = "SELECT gr.req_crse_code AS crse_code, gc.name, gc.credits
                         FROM general_courses AS gc
                         JOIN general_requirements AS gr ON gr.req_crse_code = gc.crse_code
                         WHERE gr.crse_code = $req AND gr.type = 'co'
                         AND gr.crse_code NOT IN (SELECT crse_code FROM recommended_courses)";
            } else {
                // If there are multiple values, use the IN clause
                $sql2 = "SELECT gr.req_crse_code AS crse_code, gc.name, gc.credits
                         FROM general_courses AS gc
                         JOIN general_requirements AS gr ON gr.req_crse_code = gc.crse_code
                         WHERE gr.crse_code IN ($req) AND gr.type = 'co'
                         AND gr.crse_code NOT IN (SELECT crse_code FROM recommended_courses)";
            }
            $stmt = $conn->prepare($sql2);
            //ejecuta el statement
            $stmt->execute();
            $result2 = $stmt->get_result();


            if ($result2 === false) {
                throw new Exception("Error en la consulta SQL: " . $conn->error);
            }
            while ($row = $result2->fetch_assoc()) {
                array_push($courses, $row);
            }
        }


        return $courses;
    }


    public function setCourses($conn, $student_num, $courses)
    {
        //add selected courses to will_take table
        $sql = "SELECT term
                FROM offer LIMIT 1";
        $result = $conn->query($sql);
        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        while ($row = $result->fetch_assoc()) {
            $term = $row['term'];
            break;
        }

        foreach ($courses as $course) {

            //$term = 'BB1';
            $sql = "INSERT INTO will_take (student_num, crse_code, term) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $student_num, $course, $term);
            if (!$stmt->execute()) {
                throw new Exception("Error: " . $stmt->error);
            }
        }

        //update conducted_counseling status to true (1)
        $sql = "UPDATE student
                SET conducted_counseling = 1
                WHERE student_num = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_num);
        if (!$stmt->execute()) {
            throw new Exception("Error: " . $stmt->error);
        }

        return true;
    }

    public function getCounselingStatus($conn, $student_num)
    {
        //get the student counseling status 0 == not conducted, 1 == conducted
        $sql = "SELECT conducted_counseling
                FROM student
                WHERE student_num = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_num);
        if (!$stmt->execute()) {
            throw new Exception("Error: " . $stmt->error);
        } else {
            $result = $stmt->get_result();
            $status = $result->fetch_assoc();
            return $status['conducted_counseling'];
        }
    }

    public function getCohortes($conn)
    {
        $sql = "SELECT DISTINCT cohort_year  
                FROM cohort";

        $stmt = $conn->prepare($sql);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $cohortes = [];
        while ($row = $result->fetch_assoc()) {
            //$cohortes[] = $row['cohort_year'];
            array_push($cohortes, $row['cohort_year']);
        }

        return $cohortes;
    }

    public function getStudentSelectedCourses($conn, $student_num)
    {

        $sql = "SELECT wt.student_num, wt.crse_code, wt.term
                FROM will_take as wt 
                JOIN offer as of
                ON of.term = wt.term
                WHERE of.crse_code = 'XXXX' 
                AND wt.student_num = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_num);
        if (!$stmt->execute()) {
            throw new Exception("Error: " . $stmt->error);
        } else {
            $result = $stmt->get_result();

            $courses = [];
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row['crse_code'];
            }
            return $courses;
        }
    }
}
