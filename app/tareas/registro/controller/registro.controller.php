<?php

    switch ($request_method) {
        case 'GET':
            require_once("./app/tareas/registro/view/formulario.php");
            break;

        case 'POST':
            include_once("./app/tareas/repository/tareas.repository.php");

            $titulo=$_POST['titulo'];
            $descrip=$_POST['descripcion'];

            $idusuario = (int) $_SESSION["usuario"];
            $tarea=new Tarea(0, $idusuario, $titulo, $descrip, "");
            
            if(!TareasRepository::getInstance()->saveNewTarea($tarea)){
                $error=TareasRepository::getInstance()->getDBConex()->error;
                // header("Location: /mvc/tareas/registro?error=CHALE: {$error}");      
                header("Location: /tareas/registro?error=CHALE: {$error}");      
                break;      
            }
        default:
            header("Location: /tareas");
            break;
    }