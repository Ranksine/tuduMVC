<?php  
    if (isset($msjErr)) {
        echo "
            <div class='error-container'>
                <div id='alerta' class='alert alert-danger fade show'>
                    <strong>Alerta de pendejo: </strong>{$msjErr}
                </div>
            </div>
        ";
    }    
?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card bg-login" >
                <div class="card-header">
                    <h2>
                        Registro de Usuario
                    </h2>
                    <p><code><i>Vuelvete un Dodo</i></code></p>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <!-- Primer bloque: Nombre -->
                        <div class="mb-2">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <!-- Segundo bloque: Correo Electrónico -->
                        <div class="mb-2">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <!-- Tercer bloque: Contraseña -->
                        <div class="mb-2">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <!-- Cuarto bloque: Confirmar Contraseña -->
                        <div class="mb-3">
                            <label for="confirmar_password" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" required>
                        </div>
                        <!-- Quinto bloque: Botón de Registro -->
                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-success btnLg">Registrarse</button>
                        </div>
                        <!-- Sexto bloque: Enlace para Iniciar Sesión -->
                        <div class="text-center">
                            <div class="form-group">
                                ¿Ya tienes cuenta? <a href="/login">¡Inicia Sesión!</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(()=>{

    let alerta = document.getElementById('alerta');
    if (alerta) {
        
        alerta.remove();
    }
    },4000);
</script>
