<?php
// models/StudentModel.php
class CounselingModel
{
    public function getRecommendedCourses($conn, $student_num)
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

        $sql = "SELECT gc.crse_code, gc.name, gc.credits
                FROM recommended_courses rc
                JOIN general_courses gc ON rc.crse_code = gc.crse_code
                WHERE rc.student_num = ? AND rc.term = ?
                UNION
                SELECT cc.crse_code, cc.name, cc.credits
                FROM recommended_courses rc
                JOIN ccom_courses cc ON rc.crse_code = cc.crse_code
                WHERE rc.student_num = ? AND rc.term = ?
                UNION
                SELECT dc.crse_code, dc.name, dc.credits
                FROM recommended_courses rc
                JOIN dummy_courses dc ON rc.crse_code = dc.crse_code
                WHERE rc.student_num = ? AND rc.term = ?";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("ssssss", $student_num, $term, $student_num, $term, $student_num, $term);

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

        // $sql = "SELECT DISTINCT crse_code, name, credits 
        //         FROM ccom_courses
        //         WHERE crse_code NOT IN (SELECT crse_code FROM recommended_courses)";

        // $sql = "SELECT cr.req_crse_code, cr.type, cr.crse_code, sc_student.crse_code AS student_crse_code
        // FROM ccom_requirements AS cr
        // LEFT JOIN student_courses AS sc_student ON cr.req_crse_code = sc_student.crse_code AND sc_student.student_num = ?
        // LEFT JOIN student_courses AS sc_course ON cr.crse_code = sc_course.crse_code AND sc_course.student_num = ?
        // WHERE cr.crse_code IS NOT NULL AND sc_student.crse_code IS NOT NULL AND sc_course.crse_code IS NULL";

        // /segundoo intento
        // $sql = "SELECT cr.req_crse_code,cr.type,cc.name,cc.credits,sc_student.crse_code
        //         FROM ccom_requirements AS cr
        //         LEFT JOIN student_courses AS sc_student ON cr.req_crse_code = sc_student.crse_code AND sc_student.student_num = ?
        //         LEFT JOIN student_courses AS sc_course ON cr.crse_code = sc_course.crse_code AND sc_course.student_num = ?
        //         LEFT JOIN ccom_courses AS cc ON cr.req_crse_code = cc.crse_code
        //         WHERE  cr.crse_code IS NOT NULL AND sc_student.crse_code IS NOT NULL AND sc_course.crse_code IS NULL 
        //         AND cc.crse_code NOT IN (SELECT crse_code FROM recommended_courses)";

        // $sql = "SELECT cr.crse_code, cr.req_crse_code, cr.type, cc.name, cc.credits
        // FROM ccom_requirements AS cr
        // LEFT JOIN student_courses AS sc_student ON cr.req_crse_code = sc_student.crse_code AND sc_student.student_num = ?
        // LEFT JOIN ccom_courses AS cc ON cr.crse_code = cc.crse_code
        // WHERE sc_student.crse_code IS NOT NULL 
        //   AND cr.crse_code NOT IN (SELECT crse_code FROM student_courses WHERE student_num = ?)
        //   AND cr.crse_code LIKE 'CCOM%'";

        $student_num = intval($student_num);

        $sql = "SELECT of.crse_code, cc.type, cc.name, cc.credits
                FROM offer as of
                NATURAL JOIN ccom_courses AS cc
                WHERE of.crse_code = cc.crse_code
                AND of.crse_code NOT IN (SELECT crse_code FROM student_courses WHERE crse_status = 'P' AND student_num = $student_num)
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
            $studentName = $studentInfo['name1'] . " " . $studentInfo['name2'] . " " . $studentInfo['last_name1'] . " " . $studentInfo['last_name2'];
        } else
            $studentName = $studentInfo['name1'] . " " . $studentInfo['last_name1'] . " " . $studentInfo['last_name2'];

        $studentInfo['full_student_name'] = $studentName;
        $formatted_student_num = substr($student_num, 0, 3) . '-' . substr($student_num, 3, 2) . '-' . substr($student_num, 5);
        $studentInfo['formatted_student_num'] = $formatted_student_num;

        return $studentInfo;
    }

    public function getGeneralCourses($conn)
    {

        $sql = "SELECT DISTINCT crse_code, name, credits 
        FROM general_courses
        WHERE crse_code NOT IN (SELECT crse_code FROM recommended_courses)
        AND type <> 'FREE'";
        //los cuross que me faltan 
        // $sql = "SELECT gr.req_crse_code,gr.type,gr.crse_code,gc.name,gc.credits,sc_student.crse_code AS student_crse_code
        //         FROM general_requirements AS gr
        //         LEFT JOIN student_courses AS sc_student ON gr.req_crse_code = sc_student.crse_code AND sc_student.student_num = ?
        //         LEFT JOIN student_courses AS sc_course ON gr.crse_code = sc_course.crse_code AND sc_course.student_num = ?
        //         LEFT JOIN general_courses AS gc ON gr.req_crse_code = gc.crse_code
        //         WHERE  gr.crse_code IS NOT NULL AND sc_student.crse_code IS NOT NULL AND sc_course.crse_code IS NULL";

        $stmt = $conn->prepare($sql);
        //$stmt->bind_param("ss", $student_num, $student_num);
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
        
        foreach ($courses as $course) {

            //$term = 'BB1';
            $sql = "INSERT INTO will_take (student_num, crse_code, term) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $student_num, $course, $term);
            if (!$stmt->execute()) {
                throw new Exception("Error: " . $stmt->error);
            }
        }

        return true;
    }
}
