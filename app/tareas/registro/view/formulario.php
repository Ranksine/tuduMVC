<?php
    if (isset($query_params)){
        $error=$query_params['error'];
        echo"
            <div id='alerta'>
                <div class='alert alert-danger alert-dismissable fade show'>
                    <strong>Error: </strong>{$error}
                </div>
                <hr>
            </div>
        ";
    }
?>
<main>
<h1 class="text-center">Nueva tarea</h1>
<hr>
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
                    <a href="/logout" class="btn btn-outline-primary">Logout</a>
                </div>
            </div>
            <ul class="list-group mt-3 stickyMenu">
                <li class="list-group-item bg-primary">
                    <a href="/tareas/registro" class="btn btn-link text-white">Nueva tarea</a>
                </li>
                <li class="list-group-item ">
                    <a href="/tareas" class="btn btn-link ">Mis tareas</a>
                </li>
            </ul>

        </div>
    </div>
    <div class="col">
        <h3 class="text-center">Tarea</h3>
        <hr>
        <form action="" method="post">
            <div class="form-floating mt-3">
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="" required>
                <label for="titulo">Titulo tarea</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="descripcion" id="descripcion" placeholder="" required></textarea>
                <label for="descripcion">Descripcion</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
                Guardar
            </button>
        </form>
    </div>
</section>
</main>
<script>
    setTimeout(() => {
        let alerta=document.getElementById('alerta');
        if (alerta) {        
            alerta.remove();
        }
    }, 2000);
</script>