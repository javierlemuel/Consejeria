<?php

    class Help extends Controllers{
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


        public function Help()
        {
            $data['page_tag'] = "Help";
            $data['page_title'] = "Dragonfly Drones - Administration";
            $data['page_name'] = "help";
            $this->views->getView($this, "help", $data);
        }

        
    }
?>