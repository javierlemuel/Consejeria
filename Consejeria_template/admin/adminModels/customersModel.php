<?php 
    class customersModel extends Mysql
    {
        public function __contruct()
        {
            parent::__construct();
        }
     
 
        public function setUser(string $name, string $lastname, string $email, string $password)
        {
            $query_insert = "INSERT INTO customer(c_first_name,c_last_name,c_email,c_password) 
                            VALUES (?,?,?,?)";
            $password = substr(hash('sha512', $password),0,12);
            $arrData = array($name,$lastname,$email,$password);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        }

        public function checkEmail(string $email)
        {
            
            $sql = "SELECT count(*) FROM customer WHERE c_email='".$email."'";
            $request = $this->select($sql);
            return $request;
        }

        public function getUser(int $id)
        {
            $sql = "SELECT * FROM customer WHERE c_id ='".$id."'";
            $request = $this->select($sql);
            return $request;
        }

        public function updateCustomer(string $param, string $att, int $cid)
        {
            $sql = "UPDATE customer SET ".$att."=? WHERE c_id='".$cid."'";
            $arrData = array($param);
            $request = $this->update($sql,$arrData);
            return $request;
        }

        public function getUsers()
        {
            $sql = "SELECT * FROM customer";
            $request = $this->select_all($sql);
            return $request;
        }
    
    }
?> 