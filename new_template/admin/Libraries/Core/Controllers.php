<?php

    class Controllers{
        public function __construct()
        {
            $this->views = new Views();
            $this->loadModel();
        }

        public function loadModel()
        {
            //HomeModel
            $name = strtolower(get_class($this));
            $model = $name."Model";
            //echo "hi";
            //echo $model;

            // if($model == "adminsModel" || $model == "customersModel" || $model == "loginModel" || $model == "ordersModel" ||
            // $model == "productsModel" || $model == "reportsModel")
            // {
                //echo "hey";
                $routeClass = "adminModels/".$model.".php";
            //}
            // else{
            //     //echo "userhey";
            //     $routeClass = "userModels/".$model.".php";
            // }
            
            if(file_exists($routeClass))
            {
                //echo $routeClass;
                require_once($routeClass);
                $this->model = new $model();
            }
        }
    }
?>