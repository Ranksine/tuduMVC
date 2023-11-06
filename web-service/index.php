<?php

    $maxlifetime=3; //Tiempo maximo de vida de la sesion en segundos
    $secure=true; //Habilitar seguridad de la sesion
    $http_only=true; //Otro tipo de peticion aparte de http es SOAP
    $samesite='lax';//lax es el valor para indicar que solo venga del propio servidor y no de un externo
    $host=$_SERVER['HTTP_HOST'];

    // session_set_cookie_params([
    //     'lifetime' => $maxlifetime,
    //     'path' => './',
    //     'domain' => $host,
    //     'secure' => $secure,
    //     'httpOnly' => $http_only,
    //     'samesite' => $samesite
    // ]);

    session_start([
        // 'cookie_lifetime' => 60*60*4
    ]);

    function checkSession():bool{
        return isset($_SESSION['usuario']) && $_SESSION['usuario']!=null;
    }

    // Chambeando con variales de entorno
    $env = parse_ini_file(".env");

    foreach ($env as $key => $value) { 
        $_ENV[$key] = $value;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./app/estilos.css">
    <link rel="stylesheet" href="./app/style-images.css">
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
</head>
<body>
    
    <?php
    
        $request_url = $_SERVER['REQUEST_URI'];
        $request_method = $_SERVER['REQUEST_METHOD'];

        $request_components = parse_url($request_url);
        if(count($request_components)> 1)
        {
            parse_str($request_components['query'], $query_params);
            $params = json_encode($query_params);
        }
        $path = ltrim($request_components['path'],"/");
        $path_components = explode("/", $path);
        $path_index = 0;
        $components = json_encode($path_components);

        /*echo"
            <h2>Recurso solicitado: {$request_components['path']} </h2>  
            <h3>query params: {$params} </h3> 
            <h3>Componentes url: {$components} </h3>   


            
            
        ";*/ 
        require_once("./app.controller.php");
    ?>    
    <?php
        if (checkSession()) {
            echo"<div class='card mt-5 bg-dark p-3 text-center'>
            <h4 class='text-white'>Correo: {$_SESSION['usuario']}</h4>
            </div>";
        }else{
            echo"<div class='card mt-5 bg-dark p-3 text-center'>
                <h4 class='text-white'>No se ha seteado la variable session</h4>
                </div>";
        }
    ?>

</body>
</html>