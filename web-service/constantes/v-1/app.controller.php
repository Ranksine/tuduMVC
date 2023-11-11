<?php
    if(isset($path_comonents[$pathIndex])){
        header(HTTP_CODE_400);
        exit();
    }

    switch($path_comonents[$pathIndex]){
        case 'tareas':
            require_once("");
            break;
        
        case 'usuario'
        require_once("");
        break;
        
        case 'auth'
        require_once("");
        break;

        default:
            header(HTTP_CODE_404);
            break;
    }