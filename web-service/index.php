<?php
    $env = parse_ini_file(".env");

    foreach ($env as $key => $value) { 
        $_ENV[$key] = $value;
    }
        // Configurar cabeceras para el servicio
        // Configurando el tipo de contenido para las respustas
        header("Content-Type: application/json");

        // Configurar el reesto para cualquier origen metetodos permitions 
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET,  POST, PUT, PATH, DELETE, OPTIONS");
        header("Allow: GET,  POST, PUT, PATH, DELETE, OPTIONS");

        Include_once("./constantes/constantes.php");

        $request_uri = $_SERVER['REQUEST_URI'];
        $request_method = $_SERVER['REQUEST_METHOD'];

        $url_components = parse_url($request_uri);
        $query_params = array();

        $path_url = $url_components['path'];
        $path_url = ltrim($path_url, '/');
        if(isset($url_components['query']))
        {
            parse_str($url_components['query'], $query_params);
        }

        $path_components = explode("/", $path_url);
        $api_check_index = 1;
        $version_check_index = $api_check_index + 1;
        $path_index = $version_check_index + 1;

        if(!isset($path_components[$api_check_index]) && $path_components[$api_check_index] != "api"){
            // Notificar de no existencia de url
            header(HTTP_CODE_400);
            // Romper ejecucion de php 
            exit();
        }

        if( !isset($path_components[$version_check_index]) || $path_components[$version_check_index] != "v-1"){
            //Notificar de mala petidición
            header(HTTP_CODE_400);
            // Romper ejecucioin del resto de codigo
            exit();
        }

        switch($path_components[$version_check_index]){
            case 'v-1':
                require_once("./v-1/app.controller.php");
                break;

            default:
                header(HTTP_CODE_400);
                exit();
        }

    ?>    