<?php

switch ($request_method) {
    case 'GET':
        require_once("./app/Login/Login/view/login.php");
        break;

    case 'POST':
        include_once("./app/Login/repository/login.repository.php");

        $correo = $_POST['correo'];
        $pswd = $_POST['pswd'];


        // Verificar si el correo está registrado
        if (!UsuariosRepository::getInstance()->validarCorreo($correo)) {
            $msjErr = "El correo no está registrado. Intenta nuevamente.";
            include_once("./app/Login/Login/view/login.php");
            exit(); // Salir para evitar redirección
        }

        // Validar la contraseña
        if (!UsuariosRepository::getInstance()->validarPassword($correo, $pswd)) {
            $msjErr = "La contraseña es incorrecta. Intenta nuevamente.";
            include_once("./app/Login/Login/view/login.php");
            exit(); 
        }

        $usuario=new Usuario (0, '', $correo, $pswd);

        $userInfo=usuariosRepository::getInstance()->buscarUsuario($usuario);
        $_SESSION["usuario"]=$userInfo["idusuario"];
        $_SESSION["nombre"]=$userInfo["nombre"];
        header("Location: /tareas");

        // Contraseña válida, redirigir al usuario a la página de tareas
        header("Location: /tareas");
        exit(); // Salir después de la redirección

    default:
        header("Location: .");
        break;
}
