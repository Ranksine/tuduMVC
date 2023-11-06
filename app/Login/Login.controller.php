<?php
    if ( !isset($path_components[$path_index + 1]) )
        $path_components[$path_index + 1] = '';
        
    switch ($path_components[$path_index + 1]) {
        case '':

        case 'login':
            if (!checkSession()) {
                require_once("./app/Login/Login/controller/Login.controller.php");
            }else{
                header("Location: /mvc/tareas");
            }
            break;

        case 'registro':
            if (checkSession()) {
                require_once("./app/Login/Registro/controller/registro.controller.php");
            }
            header("Location /mvc/tareas/mi-lista");
            break;
        
        default:
            header("Location: /mvc/Login");
            break;
    }