<?php
// models/StudentModel.php
class CounselingModel
{
    public function getRecommendedCourses($conn, $student_num)
    {

        $sql = "SELECT gc.*
                FROM recommended_courses rc
                JOIN general_courses gc ON rc.crse_code = gc.crse_code
                WHERE rc.student_num = ?
                UNION
                SELECT cc.*
                FROM recommended_courses rc
                JOIN ccom_courses cc ON rc.crse_code = cc.crse_code
                WHERE rc.student_num = ?";

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

    public function getConcentrationCourses($conn)
    {

        $sql = "SELECT DISTINCT crse_code, name, credits 
                FROM ccom_courses
                WHERE crse_code NOT IN (SELECT crse_code FROM recommended_courses)";

        $stmt = $conn->prepare($sql);

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
        WHERE crse_code NOT IN (SELECT crse_code FROM recommended_courses)";

        $stmt = $conn->prepare($sql);
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


    public function setCourses($conn, $student_num, $courses)
    {
        foreach ($courses as $course) {

            $term = 'BB1';
            $sql = "INSERT INTO takes (student_num, crse_code, term) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $student_num, $course, $term);
            if (!$stmt->execute()) {
                throw new Exception("Error: " . $stmt->error);
            }
        }

        return true;
    }
}
