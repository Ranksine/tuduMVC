<?php

 include_once("./app/registro/model/Persona.php");
      $nombresini=$_POST["nombre"];
      $ano=$_POST["ano"];
      $edad=$_POST["edad"];

      $pipol=new Persona($nombresini,$ano,$edad);

      echo "
         <h1>Datos Recibidos</h1></br>
         <h2><strong>Nombre: </strong>{$pipol->nombre}</h2></br>
         <h2><strong>Edad: </strong>{$pipol->edad}</h2></br>
         <h2><strong>Año de nacimiento: </strong>{$pipol->ano}</h2></br>         
         ";


 ?>

