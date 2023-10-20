<?php

class Login extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $data['page_tag'] = "Login";
        $data['page_title'] = "Dragonfly Drones - Administration";
        $data['page_name'] = "login";
        $data['page_functions_js'] = "functions_login.js";
        $this->views->getView($this, "login", $data);
    }

    public function adminLogin()
    {
        if (isset($_POST['login_btn'])) {
            $admin_email = $_POST['admin-email'];
            $password = substr(md5($_POST['admin-password']), 0, 12);
            //$password = substr(md5($_POST['admin-password']), 0, 12);

            echo $password . "   " . $admin_email;
            if (empty($admin_email)) {
                header("Location:" . base_url() . "login?error=Email is required");
                exit();
            } else if (empty($password)) {
                header("Location:" . base_url() . "login?error=Password is required");
                exit();
            } else {
                echo "get here";
                $data = $this->model->getUser($admin_email, $password);

                //echo $data['a_password'];
                echo '\\\/';
                echo $password;
                if (!empty($data)) {
                    echo "get here 2";
                    //echo substr($password, 0, 12);

                    if ($data['a_status'] == 'inactive') {
                        header("Location:" . base_url() . "login?error=Account is inactive");
                    } else if ($data['a_password'] === $password) {
                        //dep($_SESSION);
                        //echo "get here 3";
                        if ( !isset($_SESSION) ) session_start();
                        $_SESSION['admin_id'] = $data['admin_id'];
                        $_SESSION['a_firstname'] = $data['a_firstname'];
                        $_SESSION['a_email'] = $data['a_email'];
                        $_SESSION['a_password'] = $data['a_password'];
                        $_SESSION['admin_logged_in'] = true;
                        //dep($_SESSION);
                        header("Location:" . base_url() . "products");
                        exit();
                    } else if ($data['a_password'] !== $password) {
                        header("Location:" . base_url() . "login?error=Password is incorrect");
                        exit();
                    }
                } else {
                    header("Location:" . base_url() . "login?error=Password is incorrect");
                    exit();
                }
            }
        }
    }

    public function logout()
    {
        if ( !isset($_SESSION) ) session_start();
        echo dep($_SESSION);
        if (isset($_SESSION['admin_logged_in'])) {
            unset($_SESSION['admin_id']);
            unset($_SESSION['a_firstname']);
            unset($_SESSION['a_email']);
            unset($_SESSION['a_password']);
            unset($_SESSION['admin_logged_in']);
            session_destroy();
            header("Location:" . base_url() . "login");
            exit();
        }
        header("Location:" . base_url() . "login");
        exit();
    }
}
