<?php 
    class loginModel extends Mysql
    {
        public function __contruct()
        {
            parent::__construct();
        }
    
        //, string $password

        public function getUser(string $email)
        {  
            $sql = "SELECT * FROM admin WHERE a_email ='".$email."' LIMIT 1";
            echo("<script>console.log('PHP from POST: " . $sql. "');</script>");
            //echo("<script>console.log('PHP from POST: " . json_encode($password) . "');</script>");
            $request = $this->select($sql);
            return $request;
        }

       

    }
?> 