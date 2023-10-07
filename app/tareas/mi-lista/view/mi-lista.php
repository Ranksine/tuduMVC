<?php 
    if (isset($msj)) {
        echo "
            <div class='error-container'>
                <div id='alerta' class='alert alert-info fade show'>
                    <strong>Nuevo mensaje bitch: </strong>{$msj}
                </div>
            </div>
        ";
    }
?>
<h1 class="text-center text-white headers">TUDU</h1>
<hr class="margin-top:-1px; background=#fff">
<section class="row">
    <div class="col-md-4 col-lg-3 col-sm-6 col-12" >
        <div class="mocoso">
            <h3 class="text-center text-white">Menu</h3>
            <hr style="margin-top:-1px; background=#fff">
            <div class="card text-center tarjetaProfile">
                <div class="forma-cuadro">
                    <img class="card-img-top profilePicture" src="https://images.pexels.com/photos/1851164/pexels-photo-1851164.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Card image cap">
                </div>
                <div class="card-body">
                    <hr style="margin-top:-1px; background=#fff">
                    <h5 class="card-title msjUser">Hola, <?php echo $_SESSION["nombre"]; ?></h5> <!-- INCRUSTA EL NOMBRE DE USUARIO -->             
                    <a href="#" class="btn btn-primary"><i class="ri-user-fill"> </i>Perfil</a>
                    <a href="/mvc/logout" class="btn btn-outline-primary">Logout</a>
                </div>
            </div>
            <ul class="list-group mt-3 stickyMenu">
                <li class="list-group-item">
                    <a href="/mvc/tareas/registro" class="btn btn-link ">Nueva tarea</a>
                </li>
                <li class="list-group-item bg-primary">
                    <a href="/mvc/tareas" class="btn btn-link text-white">Mis tareas</a>
                </li>
            </ul>

        </div>
    </div>
    <div class="col row">
        <h3 class="text-center text-white">Tareas</h3>
        <hr>
        <?php
            include_once("./app/tareas/repository/tareas.repository.php");

            $idusuario = (int) $_SESSION["usuario"];
            $user = new Usuario($idusuario, "", "", "");

            $tareas = TareasRepository::getInstance()->getAllTareas($user);

            // print_r($tareas);
            for ($x=0; $x < count($tareas); $x++) {  
                $color="";
                $ocultarbtn="";
                
                switch ($tareas[$x]->getStatus()) {
                    case 'Pendiente':
                        $color="warning";

                        break;                    
                    case 'Completado':
                        $color="success";
                        $ocultarbtn="visually-hidden";
                        break;

                    default:
                        $color="danger";
                        break;
                }
                
                $html="
                    <div class='col-md-12 '>
                        <div class='card mt-3 border-black bg-semi-transparent-white'>
                            <div class='card-header bg-{$color}'>
                                <h4 class='card-title text-center text-white'>
                                    {$tareas[$x]->getTitulo()} 
                                </h4>
                            </div>
                    
                            <div class='card-body'>
                                <p class='card-text'>
                                    {$tareas[$x]->getDescripcion()}
                                </p>
                            </div>
                    
                            <div class='card-footer d-flex justify-content-between align-items-center'>
                                <strong class='card-text text-{$color}'>
                                    ESTADO: {$tareas[$x]->getStatus()}
                                </strong>
                                <form action='' method='POST'>
                                    <div class='check-boton'>
                                    <input type='hidden' value='{$tareas[$x]->getId()}' name='btnCompletar'>
                                    <button type='submit' class='btn btn-primary ml-auto text-white {$ocultarbtn}' id='btn-completado{$tareas[$x]->getId()}'>Completar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        function toggleCompletado(buttonId) {
                            const btnCompletado = document.getElementById(buttonId);
                            let isCompleted = false;
                    
                            btnCompletado.addEventListener('click', () => {
                                isCompleted = !isCompleted;
                                if (isCompleted) {
                                    btnCompletado.classList.add('btn-completado');
                                } else {
                                    btnCompletado.classList.remove('btn-completado');
                                }
                            });
                        }
                    
                        // Llama a la función para cada botón generado en el ciclo
                        toggleCompletado('btn-completado{$tareas[$x]->getId()}');
                    </script>                    
                    
                ";
                echo $html;
            }
        ?>
    </div>
</section>
<script>
     setTimeout(()=>{

    let alerta = document.getElementById('alerta');
    if (alerta) {
        
        alerta.remove();
    }
    },4000);

</script>
