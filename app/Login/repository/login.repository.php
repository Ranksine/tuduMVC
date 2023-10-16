<?php
    include_once("./app/Login/model/login.model.php");

    class UsuariosRepository {
        private static $_intance = [];
        
        private mysqli $mysqli;

        private function __construct() {
            $host=$_ENV['DB_HOST'];
            $user=$_ENV['DB_USER'];
            $pswd=$_ENV['DB_PASSWORD'];
            $db=$_ENV['DB_DATABASE'];
            $this->mysqli = new mysqli($host,$user,$pswd,$db);
        }
        
        public static function getInstance(): UsuariosRepository {
            $class = static::class;
            if ( !isset( $_intance[ $class ] ) ){
                $_intance[ $class ] = new static();
            }

            return $_intance[ $class ];
        }

        public function getDBConex(): mysqli{
            return $this->mysqli;
        }

        public function getAllUsuarios(): array {
            $usuarios = array();
            $query = "SELECT * FROM usuarios ORDER BY Nombre";

            $sentencia = $this->mysqli->prepare($query);

            $sentencia->execute();

            $sentencia->bind_result( $id, $nombre, $correo, $pswd);
            while ($sentencia->fetch() ){
                $usuarios[] = new Usuario( $id, $nombre, $correo, $pswd);
            }
            return $usuarios;
        }

        public function buscarUsuario(Usuario $user): array{
            $wey;
            $query="SELECT IdUsuario, Nombre FROM usuarios WHERE Correo= ? AND Password= ?";

            $sentencia=$this->mysqli->prepare($query);

            $correo=$user->getCorreo();
            $pswd=$user->getPassword();

            $sentencia->bind_param("ss",$correo,$pswd);

            $sentencia->execute();
            $sentencia->bind_result($id,$nombre);//Me asigna los valores extraidos a las variables $id y $nombre jeje

            while ($sentencia->fetch()) {
                $wey=array('idusuario'=>$id,'nombre'=>$nombre);//Me asigna a la variable idusuario el valor de $id y $nombre a nombre
            }
            return $wey;
        }

        public function registrarUsuario(Usuario $usuario):bool{
            $this->mysqli->begin_transaction();

            $query="INSERT INTO usuarios(Nombre, Correo, Password) VALUES(?,?,?)";
            $sentencia=$this->mysqli->prepare($query);

            $nombre=$usuario->getNombre();
            $correo=$usuario->getCorreo();
            $pswd=$usuario->getPassword();

            $sentencia->bind_param("sss",$nombre,$correo,$pswd);

            if (!$sentencia->execute()) {
                $this->mysqli->rollback();
                return false;
            }

            $this->mysqli->commit();
            return true;
        }

        public function validarCorreo($correo): bool {
            $query = "SELECT COUNT(*) FROM usuarios WHERE Correo = ?";
            $sentencia = $this->mysqli->prepare($query);
            $sentencia->bind_param("s", $correo);
            $sentencia->execute();
            $sentencia->bind_result($count);
            $sentencia->fetch(); 
            $sentencia->close();
        
            return $count>0;
        }

        public function validarPassword($correo, $pwsd): bool {
            $query = "SELECT Password FROM usuarios WHERE Correo = ?";
            $sentencia = $this->mysqli->prepare($query);
            $sentencia->bind_param("s", $correo);
            $sentencia->execute();
            $sentencia->bind_result($pswd_Tududb);
            $sentencia->fetch();
            $sentencia->close();
        
            return $pwsd === $pswd_Tududb;
        }
        
    }