<?php
require_once(__DIR__ . '/../models/MinorModel.php');
require_once(__DIR__ . '/../config/database.php');

class MinorController{

    
    public function index($message) {   
        
        global $conn;
        $minorModel = new MinorModel();
        $minors = $minorModel->getMinors($conn);

        require_once(__DIR__ . '/../views/minorView.php');

    }

    public function editMinor()
    {
        global $conn;
        $minorModel = new MinorModel();

        $mID = $_POST['mID'];
        $name = $_POST['name'];
        $credits = $_POST['credits'];

        $message = $minorModel->editMinor($conn, $mID, $name, $credits);

        $this->index($message);
    }

    public function addMinor()
    {
        echo "Test";
        try {
            global $conn;
            $minorModel = new MinorModel();

            $name = $_POST['name'];
            $credits = $_POST['credits'];

            $message = $minorModel->addMinor($conn, $name, $credits);
           

           // $this->index($message);
            // You can add logging here for successful cases.
        } catch (Exception $e) {
            // Log or display the error message.
            echo "Error: " . $e->getMessage();
        }
        
    }
}

$minorController = new MinorController();

if(isset($_GET['minor']))
{
    if(isset($_GET['mID']))
        $minorController->editMinor();
    
    if(isset($_GET['add']))
        $minorController->addMinor();

    $minorController->index('');
}
    

?>