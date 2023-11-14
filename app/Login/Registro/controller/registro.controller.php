<?php

    switch ($request_method) {
        case 'GET':
            require_once("./app/Login/registro/view/formularioLoginR.php");
            break;

        case 'POST':
            include_once("./app/Login/repository/login.repository.php");

            $nombre=$_POST['nombre'];
            $correo=$_POST['email'];
            $pswd=$_POST['password'];
            $confPass=$_POST['confirmar_password'];

            if (UsuariosRepository::getInstance()->validarCorreo($correo)){
                $msjErr="Correo ya registrado putito";
            }else{
                if($pswd!==$confPass){
                    $msjErr="La contraseña no coincide, ingresala bien perro";
                }else{
                    $usuario=new Usuario(0, $nombre, $correo, $pswd);
                    $msjSuccess="Dodo creado con exito!";
                    if(!UsuariosRepository::getInstance()->registrarUsuario($usuario)){
                        $msjErr=UsuariosRepository::getInstance()->getDBConex()->error;    
                        // header("Location: /mvc/Login/Registro?error=CHALE: No_se_pudo_dar_de_alta_jovenazoooo");        
                    }          
                }
            }

            if(isset($msjErr)){
                // header("Location: /mvc/Login/Registro?error=CHALE: No_se_pudo_dar_de_alta_jovenazoooo");      
                require_once("./app/Login/registro/view/formularioLoginR.php");
            } else{
                
                header("Location: /login");
            }
            break;
            
        default:
            header("Location: /login");
            break;
    }