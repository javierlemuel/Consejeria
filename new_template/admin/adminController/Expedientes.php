<?php

class Expedientes extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $data['page_tag'] = "Expeientes";
        $data['page_title'] = "Expedientes - Admin";
        $data['page_name'] = "Expedientes";
        //$data['page_functions_js'] = "functions_login.js";
        $this->views->getView($this, "expedientes", $data);
    }
}
