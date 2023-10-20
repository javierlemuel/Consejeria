<?php

class studentsModel extends Mysql
    {
        public function __contruct()
        {
            parent::__construct();
        }

        public function getAllStudents()
        {
            $sql = "SELECT * FROM students";
            $request = $this->select_all($sql);
            return $request;
        }
    }

?>