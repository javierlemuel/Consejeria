<?php

    //Devuelve la url del proyecto
    function base_url()
    {
        return BASE_URL;
    }

    //Devuelve la url de Assets
    function media()
    {
        return BASE_URL."/Assets";
    }

    function headerAdmin($data="")
    {
        $view_header = "adminViews/Layouts/header_admin.php";
        require_once($view_header);
    }

    function footerAdmin($data="")
    {
        $view_header = "adminViews/Layouts/footer_admin.php";
        require_once($view_header);
    }

    function sidemenuAdmin($data="")
    {
        $view_header = "adminViews/Layouts/sidemenu_admin.php";
        require_once($view_header);
    }

    //Muestra info formateada
    function dep($data)
    {
        $format = print_r('<pre>');
        $format .= print_r($data);
        $format = print_r('<pre>');
        return $format;
    }

    function getModal(string $nameModal, $data)
    {
        $view_modal = "adminViews/Layouts/Forms/{$nameModal}.php";
        require_once $view_modal;
    }

    function strClean($strCadena)
    {
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ', ''], $strCadena);        
        $string = trim($string);
        $string = stripslashes($string);
        return $string;
    }

    function formatMoney($cantidad)
    {
        $cantidad = number_format($cantidad,2,SPD,SPM);
        return $cantidad;
    }

    function make_seed()
    {
    list($usec, $sec) = explode(' ', microtime());
    return $sec + $usec * 1000000;
    }

    function trackingGenerator()
    {
        $pass = "94001000";
        $longitudPass = 14;
        $cadena = "1234567890";
        $longitudCadena = strlen($cadena);

        for($i=1; $i<=$longitudPass; $i++)
        {
            $pos = rand(0, $longitudCadena-1);
            $pass .= substr($cadena, $pos,1);
        }
        //14 more digits
        return $pass;
    }

    function transactionGenerator()
    {
        $pass = "";
        $longitudPass = 16;
        $cadena = "1234567890";
        $longitudCadena = strlen($cadena);

        for($i=1; $i<=$longitudPass; $i++)
        {
            $pos = rand(0, $longitudCadena-1);
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }
?>