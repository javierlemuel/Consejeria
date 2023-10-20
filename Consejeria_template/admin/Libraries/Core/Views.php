<?php

    class Views{
        // function getUserView($controller, $view, $data="")
        // {
        //     $controller = get_class($controller);
        //     if($controller == "Home" || $controller == "Shop" || $controller == "Cart" 
        //     || $controller == "Login2" || $controller == "Single" || $controller == "Register" || $controller == "Index"
        //     || $controller == "Account" || $controller == "Checkout" || $controller == "Order" || $controller == "Invoice"
        //     || $controller == "Allorders" || $controller == "Changepass" || $controller == "Contact")
        //     {
        //         $view = "userViews/".$view.".php";
        //     }
        //     else if($controller == "Testing")
        //     {
        //         $view = "userViews/yes/".$view.".php";
        //     }
        //     else{
        //         $view = "userViews/".$controller."/".$view.".php";
        //     }
        //     require_once($view);
        // }

        function getView($controller, $view, $data="")
        {
            $controller = get_class($controller);
            if($controller == "")
            {
                $view = "adminViews/Orders/".$view.".php";
            }
            // else if($controller == "Login")
            // {
            //     $view = "Views/Login/".$view.".php";
            // }
            else{
                $view = "adminViews/".$controller."/".$view.".php";
            }
            require_once($view);
        }
        

    }
?>