<?php //---------------------------------- END POINTS ----------------------------------\\

    switch ($path_components[$path_index]) {
        case 'formulario':
            require_once("./app/registro/controller/registro.controller.php");
            break;
        case 'presentacion':
            require_once("./app/presentacion/controller/presentacion.controller.php");
            break;

        case 'tareas':
            if (checkSession()) {
                require_once("./app/tareas/tareas.controller.php");
            }else 
                header("Location: /login");
            break;
        
        case 'login':
            if (!checkSession()) {
                require_once("./app/Login/Login/controller/login.controller.php");                
            }else{
                header("Location: /tareas");
            }
            break;

        case 'registro':
            if (!checkSession()) {
                require_once("./app/Login/Registro/controller/registro.controller.php");
            }else{
                header("Location: /tareas");
            }
            break;

        case 'logout':
            session_destroy();
            header("Location: /login");
            break;  

        case "paises":
            require_once("./app/paises/paises.controller.php");
            break;
        default:
            header("HTTP/1.1 404 NOT FOUND");
            break;
    }
?>