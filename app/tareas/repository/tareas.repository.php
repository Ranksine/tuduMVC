<?php
    include_once("./app/tareas/model/tarea.model.php");
    include_once("./app/Login/model/login.model.php");

    class TareasRepository {
        private static $_intance = [];
        private mysqli $mysqli;

        private function __construct() {
            $host=$_ENV['DB_HOST'];
            $user=$_ENV['DB_USER'];
            $pswd=$_ENV['DB_PASSWORD'];
            $db=$_ENV['DB_DATABASE'];
            $this->mysqli = new mysqli($host,$user,$pswd,$db);
        }

        public static function getInstance(): TareasRepository {
            $class = static::class;
            if ( !isset( $_intance[ $class ] ) ){
                $_intance[ $class ] = new static();
            }

            return $_intance[ $class ];
        }

        public function getDBConex(): mysqli{
            return $this->mysqli;
        }

        public function getAllTareas(Usuario $user): array {        
            $tareas = array();
            $query = "SELECT * FROM tareas WHERE IdUsuario = ? ORDER BY status DESC, titulo ASC";

            $sentencia = $this->mysqli->prepare($query);

            $idUser = $user -> getIdUsuario();
            $sentencia ->bind_param("i", $idUser);

            $sentencia->execute();

            $sentencia->bind_result( $id, $idUsuario, $titulo, $descripcion, $status );
            while ($sentencia->fetch() ){
                $tareas[] = new Tarea( $id, $idUsuario, $titulo, $descripcion, $status );
            }
            return $tareas;
        }

        public function saveNewTarea(Tarea $tarea):bool{ 
            $this->mysqli->begin_transaction();
            $query="INSERT INTO tareas(IdUsuario, titulo, descripcion) VALUES(?,?,?)";

            $sentencia=$this->mysqli->prepare($query);

            $idUser=$tarea->getIdUsuario();
            $titulo=$tarea->getTitulo();
            $descrip=$tarea->getDescripcion();

            $sentencia->bind_param("iss",$idUser, $titulo, $descrip);

            if (!$sentencia->execute()) {
                $this->mysqli->rollback();
                return false;
            }

            $this->mysqli->commit();
            return true;
        }

        public function checkTarea($id) {
            $this->mysqli->begin_transaction();
            $status = 'Completado';

            $query = "UPDATE tareas SET status = ? WHERE id = ?";
            $sentencia = $this->mysqli->prepare($query);
        
            $sentencia->bind_param("si", $status,$id);
        
            if (!$sentencia->execute()) {
                $this->mysqli->rollback();
                return false;
            }
        
            $this->mysqli->commit();    
            return true;
        }

    }
