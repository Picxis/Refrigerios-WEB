<?php
    // Establece la conexión a la base de datos usando la clase mysqli
    $conexion = new mysqli("localhost", "root", "", "CONTROL_MANEJO_REFRIGERIOS");

    // Verifica si la conexión fue exitosa
    if ($conexion->connect_error) {
        die('No se ha podido conectar a la base de datos: ' . $conexion->connect_error);
    } else {
        echo 'Conectado a la base de datos';
    }
?>
