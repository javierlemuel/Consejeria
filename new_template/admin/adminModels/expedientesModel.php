<?php 
    class expedientesModel extends Mysql
    {
        public function __contruct()
        {
            parent::__construct();
        }
    
        //, string $password

        public function getStudents(string $email)
        {  
            $sql = "SELECT * FROM student";
            echo("<script>console.log('PHP from POST: " . $sql. "');</script>");
            //echo("<script>console.log('PHP from POST: " . json_encode($password) . "');</script>");
            $request = $this->select($sql);
            return $request;
        }

       

    }
?> 