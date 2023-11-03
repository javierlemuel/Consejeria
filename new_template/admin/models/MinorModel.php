<?php
class MinorModel {

   public function getMinors($conn){
        $sql = "SELECT *
        FROM minor";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return $result;

   }

   public function editMinor($conn, $mID, $name, $credits)
   {
        $sql = "UPDATE minor
                SET name = '$name',
                required_credits = $credits
                WHERE ID = $mID";

        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return "edit_sucess";

   }


   public function addMinor($conn, $name, $credits)
   {
        $sql = "INSERT INTO minor (name, required_credits)
                VALUES ('$name', $credits)";
        $result = $conn->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }

        return "add_sucess";

   }
}