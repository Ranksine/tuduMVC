<?php

switch ($request_method) {
    case 'GET':
        require_once("./app/tareas/mi-lista/view/mi-lista.php");
        break;

    case 'POST':        
        include_once("./app/tareas/repository/tareas.repository.php");

         $boton=$_POST['btnCompletar'];

         if(!TareasRepository::getInstance()->checkTarea($boton)){
            $msj=TareasRepository::getInstance()->getDBConex()->error;
         }else{
            $msj="Aperrooo ya pudiste compeltar tu tarea maldito procrastinador, sigue jalando perrita!";
         }

         if(isset($msj)) {
            require_once("./app/tareas/mi-lista/view/mi-lista.php");
        }
        
        break;

    default:
        header("Location: .");
        break;

        
}
