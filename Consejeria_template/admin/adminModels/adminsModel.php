<?php 
    class adminsModel extends Mysql
    {
        public function __contruct()
        {
            parent::__construct();
        }
    
 
        public function setAdmin(string $name, string $lastname, string $email, string $password)
        {
            $query_insert = "INSERT INTO admin(a_firstname,a_lastname,a_email,a_password) 
                            VALUES (?,?,?,?)";
            $arrData = array($name,$lastname,$email,$password);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        }

        public function checkEmail(string $email)
        {
            
            $sql = "SELECT count(*) FROM admin WHERE a_email='".$email."'";
            $request = $this->select($sql);
            return $request;
        }

        public function getAdmin(int $id)
        {
            $sql = "SELECT * FROM admin WHERE admin_id='".$id."'";
            $request = $this->select($sql);
            return $request;
        }

        public function updateAdmin($param, string $att, int $cid)
        {
            //echo $param;
            $sql = "UPDATE admin SET ".$att." =? WHERE admin_id='".$cid."'";
            $arrData = array($param);
            $request = $this->update($sql,$arrData);
            return $request;

            $sql = "UPDATE customer SET ".$att."=? WHERE c_id='".$cid."'";
            $arrData = array($param);
            $request = $this->update($sql,$arrData);
            return $request;
        }

        public function getAdmins()
        {
            $sql = "SELECT * FROM admin";
            $request = $this->select_all($sql);
            return $request;
        }

    }
?> 