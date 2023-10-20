<?php

class Admins extends Controllers
{
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


    public function Admins()
    {
        $data['page_tag'] = "Admins";
        $data['page_title'] = "Dragonfly Drones - Administration";
        $data['page_name'] = "admins";
        $this->views->getView($this, "admins", $data);
    }

    public function EditAdmin()
    {
        $admin_id = $_GET['admin_id'];
        $data = $this->model->getAdmin($admin_id);
        $data['page_tag'] = "Edit Admin";
        $data['page_title'] = "Dragonfly Drones - Administration";
        $data['page_name'] = "editAdmin";
        $this->views->getView($this, "editAdmin", $data);
    }

    public function insert()
    {
        if (isset($_POST['registeradmin'])) {
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            //if passwords dont match
            if ($password !== $confirmPassword) {
                header('location: Customers.php?error=passwords dont match');


                //if passwod is less than 6 char
            } else if (strlen($password) < 6) {
                header('location: Customers.php?error=password must be at least 6 charachters');
            } else {
                $num_rows = $this->model->checkEmail($email);


                if ($num_rows['count(*)'] != 0) {
                    header('location: customers.php?error=user with this eamil already exists');

                } else {
                    $password = md5($password);
                    echo $password;
                    $data = $this->model->setAdmin($name, $lastname, $email, $password);
                }
            }
        }
        header('Location:' . base_url() . 'admins');
        exit;
    }

    public function updateAdmin()
    {
        if (isset($_POST['save_admin'])) {

            $admin_id = $_POST['a_id'];
            $Status = $_POST['Status'];
            $Phone = $_POST['Phone'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            $info = $this->model->getAdmin($admin_id);
            echo $Phone;


            if ($Status != $info['a_status']) {
                $att = "a_status";
                $data = $this->model->updateUser($Status, $att, $admin_id);
            }


            if ($Phone != $info['a_phone_number']) {
                //echo $info['a_phone_number'];
                $att = "a_phone_number";
                $data = $this->model->updateAdmin($Phone, $att, $admin_id);
            }

            if ($password !== $confirmPassword) {
                header('location: Customers.php?error=passwords dont match');


                //if passwod is less than 6 char
            } else if (strlen($password) < 6) {
                header('location: Customers.php?error=password must be at least 6 charachters');
            } else {
                $att = "a_password";
                $data = $this->model->updateAdmin(md5($password), $att, $admin_id);
            }
        }
        header('Location:' . base_url() . 'admins');
        exit;
    }

    public function getAdmin($admin_id)
    {
        $data = $this->model->getAdmin($admin_id);
        return $data;
    }

    public function getAdmins()
    {
        $data = $this->model->getAdmins();
        return $data;
    }
}
