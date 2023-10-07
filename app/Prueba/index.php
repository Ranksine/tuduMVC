<?php
// Incluye el archivo de configuración de la base de datos
require_once 'db_config.php';

// Crea una función para conectar a la base de datos
function conectarDB() {
    global $db_host, $db_user, $db_password, $db_name;
    
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Verificar la conexión
    if ($mysqli->connect_errno) {
        die("Error al conectar a la base de datos: " . $mysqli->connect_error);
    }

    return $mysqli;
}

// Ejemplo de uso
$conexion = conectarDB();

// Verificar si la conexión se realizó con éxito
if ($conexion) {
    echo '<h1>Conexión exitosa a la base de datos</h1>';
    
    // Consulta SQL para obtener todos los registros de la tabla 'tareas'
    $query = "SELECT * FROM tareas";
    $resultado = $conexion->query($query);

    // Verificar si se obtuvieron resultados
    if ($resultado->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Título</th><th>Descripción</th><th>Status</th></tr>';
        
        // Iterar sobre los resultados y mostrarlos en la tabla
        while ($fila = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $fila['id'] . '</td>';
            echo '<td>' . $fila['titulo'] . '</td>';
            echo '<td>' . $fila['descripcion'] . '</td>';
            echo '<td>' . $fila['status'] . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
    } else {
        echo 'No se encontraron registros en la tabla.';
    }

    // Cerrar la conexión al finalizar
    $conexion->close();
} else {
    echo '<h1>Error al conectar a la base de datos</h1>';
}
?>
