<?php
    $controller = ucwords($controller);

    // if($controller == "Admins" || $controller == "Customers" || $controller == "Help" || $controller == "Login"
    // || $controller == "Orders" || $controller == "Products" || $controller == "Reports")
    // {
        $controllerFile = "adminControllers/".$controller.".php";
        if(file_exists($controllerFile))
        {
            require_once($controllerFile);
            $controller = new $controller();
            if(method_exists($controller, $method))
            {
                $controller->{$method}($params);
            }
            else{
                echo"Method not found";
                require_once("adminControllers/Error.php");
            }
        }
        else{
            echo"File not found";
            require_once("adminControllers/Error.php");
        }
    //}
    // else{
    //     $controllerFile = "userControllers/".$controller.".php";
    //     if(file_exists($controllerFile))
    //     {
    //         require_once($controllerFile);
    //         $controller = new $controller();
    //         if(method_exists($controller, $method))
    //         {
    //             $controller->{$method}($params);
    //         }
    //         else{
    //             require_once("userControllers/Error.php");
    //         }
    //     }
    //     else{
    //         require_once("userControllers/Error.php");
    //     }

    // }
    
?>