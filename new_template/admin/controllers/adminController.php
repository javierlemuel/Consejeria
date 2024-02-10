<?php
if(!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] !== true)
{
    header("Location: ../index.php");
    exit;
}
require_once(__DIR__ . '/../models/AdminModel.php');
require_once(__DIR__ . '/../config/database.php');

class AdminController{
    public function index($message){
        global $conn;
        $adminModel = new AdminModel();

        $admins = $adminModel->getAdmins($conn);

        require_once(__DIR__ . '/../views/adminsView.php');
    }

    public function register(){

        global $conn;
        $adminModel = new AdminModel();

        $email = $_POST['email'];
        $name = $_POST['name'];
        $lname = $_POST['lname'];
        $pass = $_POST['password'];
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $privileges = $_POST['privileges'];

        $result = $adminModel->registerAdmin($conn, $email, $name, $lname, $pass, $privileges);

        $this->index($result);

    }
}


$adminController = new AdminController();

if(isset($_GET['register']))
    $adminController->register();
else
    $adminController->index('');

?>