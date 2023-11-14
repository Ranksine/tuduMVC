<?php 
    if (isset($msjErr)) {
        echo "
            <div class='error-container'>
                <div id='alerta' class='alert alert-danger fade show'>
                    <strong>Alerta de cabeza de chorlito: </strong>{$msjErr}
                </div>
            </div>
        ";
    }
?>

<div class='bg-login'>
    <div class="imgProfile">
        <img src="https://i.pinimg.com/564x/34/0d/51/340d5178faa93d68af2cc1da8b184c27.jpg" alt="Profile Default">
    </div>
    <div class="card-header">
        <h1>Log in</h1>
        <h5><i>Inicia sesi&oacute;n en <code>TUDU</code></i></h5>
    </div>
    <form action="" method="POST">
        <!-- Primer bloque -->
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu correo electrónico" required>
                    <div class="valid-feedback">
                        Campo válido.
                    </div>
                    <div class="invalid-feedback">
                        Por favor, completa este campo.
                    </div>
                </div>
            </div>
        </div>

        <!-- Segundo bloque -->
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Ingresa tu contraseña" required>
                </div>
            </div>
        </div>

        <!-- Tercer bloque (botón) -->
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                <button type="submit" class="btn btn-primary btn-submit btnLg">Ingresar</button>
                </div>
            </div>
        </div>
    </form>


    <!-- (enlace "Olvidaste tu contraseña?") -->
    <div class="row mb-3">
        <div class="col text-right">
            <div class="form-group">
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>

    <!-- (enlace "Regístrate") -->
    <div class="row mb-3">
        <div class="col">
            <div class="form-group">
                ¿Aún no tienes cuenta? <a href="/registro" class="register-link">¡Regístrate!</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    var emailInput = document.getElementById("correo");

    // Agrega un evento de escucha al campo de entrada
    emailInput.addEventListener("input", function () {
        var isValid = emailInput.checkValidity(); // Verifica si el campo es válido

        if (isValid) {
            emailInput.classList.add("is-valid"); // Agrega la clase is-valid si es válido
        } else {
            emailInput.classList.remove("is-valid"); // Elimina la clase is-valid si no es válido
        }
        });
    });

    setTimeout(()=>{

    let alerta = document.getElementById('alerta');
    if (alerta) {
        
        alerta.remove();
    }
    },4000);

</script>