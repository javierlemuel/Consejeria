<?php
// models/LoginModel.php
class StudentModel
{
    public function getStudentInfo($conn, $student_num)
    {
        $sql = "SELECT email, name1, name2, last_name1, last_name2
                FROM student
                WHERE student.student_num = ?";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
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

    public function getStudentCourses($conn, $student_num)
    {
        $sql = "SELECT merged.crse_code, merged.name, merged.credits, student_courses.crse_grade, student_courses.crse_status, student_courses.convalidacion, student_courses.equivalencia
        FROM (
            SELECT *
            FROM ccom_courses
            UNION
            SELECT *
            FROM general_courses
        ) AS merged
        LEFT JOIN student_courses ON merged.crse_code = student_courses.crse_code
        AND student_courses.student_num = ?";

        $stmt = $conn->prepare($sql);

        // sustituye el ? por el valor de $student_num
        $stmt->bind_param("s", $student_num);

        // ejecuta el statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        $studentRecord = $result->fetch_assoc();

        return $studentRecord;
    }
}
