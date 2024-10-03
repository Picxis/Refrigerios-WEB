<?php

    session_start();

// Crear una conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "CONTROL_MANEJO_REFRIGERIOS");

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si los datos se han enviado a través del formulario
if (isset($_POST['Corre_ele']) && isset($_POST['Contra_User'])) {
    
    $correoUsuario = $_POST['Corre_ele'];
    $passwordUsuario = $_POST['Contra_User'];
    $passwordUsuario = hash('sha512', $passwordUsuario);

    // Consulta SQL con nombres de columnas correctos
    $validar_login = $conexion->query("SELECT * FROM Usuario WHERE correoUsuario='$correoUsuario' AND passwordUsuario='$passwordUsuario'");

    // Verificar si la consulta fue exitosa
    if ($validar_login) { 
        if ($validar_login->num_rows > 0) {
            $_SESSION['usuario'] = $correoUsuario;
            // Redirigir si el usuario existe
            header("Location: ./index.php");
            exit;
        } else {
            // Mostrar mensaje de error si el usuario no existe
            echo '
                <script>
                    alert("Este usuario no existe, verifique los datos nuevamente");
                    window.location = "../View/login.html";
                </script>
            ';
            exit();
        }
    } else {
        // Mostrar mensaje de error si la consulta falla
        echo "Error al realizar la consulta: " . $conexion->error;
    }
} else {
    // Manejar el caso en que los datos no se han enviado
    echo '
        <script>
            alert("Por favor, complete todos los campos del formulario.");
            window.location = "../View/login.html";
        </script>
    ';
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
