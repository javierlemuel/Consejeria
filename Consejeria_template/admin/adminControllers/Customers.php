<?php

    class Customers extends Controllers{
        public function __construct()
    {
        parent::__construct();
        if ( !isset($_SESSION) ) session_start();
        if (!isset($_SESSION['admin_logged_in'])) {
            //dep($_SESSION);
            header('Location:'.base_url().'login');
            exit();
        }
    }


        public function Customers()
        {
            $data['result'] = $this->model->getUsers();
            $data['page_tag'] = "Customers";
            $data['page_title'] = "Dragonfly Drones - Administration";
            $data['page_name'] = "customers";
            $this->views->getView($this, "customers", $data);
        }
        
        public function EditCustomer()
        {
            //echo "GETs here";
            $c_id = $_GET['c_id'];
            $data = $this->model->getUser($c_id);
            $data['page_tag'] = "Edit Customer";
            $data['page_title'] = "Dragonfly Drones - Administration";
            $data['page_name'] = "editCustomer";
            $this->views->getView($this, "editCustomer", $data);
        }


        public function insert()
        {
            if(isset($_POST['register'])){
                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];
              
                //if passwords dont match
                if($password !== $confirmPassword){
                  header('location: Customers.php?error=passwords dont match');
                
              
                //if passwod is less than 6 char
                }else if(strlen($password) < 6){
                  header('location: Customers.php?error=password must be at least 6 charachters');

                }else{
                    $num_rows = $this->model->checkEmail($email);
                  
             
                    if($num_rows['count(*)'] != 0){
                        //header('location: customers.php?error=user with this eamil already exists');
                        
                    }else{
                        $data = $this->model->setUser($name, $lastname, $email, $password);
                        
                    }
                }
                
            } 
            header('Location:'.base_url().'customers');
            exit;
            
        }

        public function getUser($id)
        {
            $data = $this->model->getUser($id);
            return$data;
        }

        public function updateCustomer()
        {
            if(isset($_POST['save_customer'])){

                $user_id = $_POST['c_id'];
                $firstName = $_POST['FirstName'];
                $LastName = $_POST['LastName'];
                $Phone = $_POST['Phone'];
                $State = $_POST['State'];
                $City = $_POST['City'];
                $Street1 = $_POST['AddressLine1']; 
                $Street2 = $_POST['AddressLine2'];
                $Zip_Code = $_POST['Zip'];
                $Status = $_POST['Status'];

                $info = $this->model->getUser($user_id);

                if($firstName != $info['c_first_name'])
                {
                    $att = "c_first_name";
                    $data = $this->model->updateCustomer($firstName,$att,$user_id);
                }
        
                if($LastName != $info['c_last_name'])
                {
                    $att = "c_last_name";
                    $data = $this->model->updateCustomer($LastName,$att,$user_id);
                }
        
                if($Phone != $info['c_phone_number'])
                {
                    $att = "c_phone_number";
                    $data = $this->model->updateCustomer($Phone,$att,$user_id);
                }
        
                if($State != $info['c_state'])
                {
                    $att = "c_state";
                    $data = $this->model->updateCustomer($State,$att,$user_id);
                }
        
                if($City != $info['c_city'])
                {
                    $att = "c_city";
                    $data = $this->model->updateCustomer($City,$att,$user_id);
                }
        
                if($Street1 != $info['address_line_1'])
                {
                    $att = "address_line_1";
                    $data = $this->model->updateCustomer($Street1,$att,$user_id);
                }

                if($Street2 != $info['address_line_2'])
                {
                    $att = "address_line_2";
                    $data = $this->model->updateCustomer($Street2,$att,$user_id);
                }
        
                if($Zip_Code != $info['c_zipcode'])
                {
                    $att = "c_zipcode";
                    $data = $this->model->updateCustomer($Zip_Code,$att,$user_id);
                }   
                if($Status != $info['c_status'])
                {
                    $att = "c_status";
                    $data = $this->model->updateCustomer($Status,$att,$user_id);
                }     
            }
            header('Location:'.base_url().'/customers');
            exit;
        } 

        public function getUsers()
        {
            $data = $this->model->getUsers();
            return $data;
        }

    }
?>