<?php

class Students extends Controllers
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

    public function students()
    {
        //$data['loquesea'] = $this->model->getStudents();

        
        //$data['result'] = $this->model->getOrders();
        // $data['page_tag'] = "Orders";
        // $data['page_title'] = "Dragonfly Drones - Administration";
        // $data['page_name'] = "orders";
        $data = '';
        $this->views->getView($this, "orders", $data);
    }
}