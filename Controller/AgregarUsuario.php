<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "CONTROL_MANEJO_REFRIGERIOS");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Procesar el formulario de registro
if (isset($_POST['registrar'])) {
    $nombre = $conexion->real_escape_string($_POST['Usuario_Nombre']);
    $apellido = $conexion->real_escape_string($_POST['Apellido_User']);
    $correo = $conexion->real_escape_string($_POST['Corre_ele']);
    $contrasena = password_hash($_POST['Contra_User'], PASSWORD_BCRYPT); // Encriptar la contraseña
    $direccion = $conexion->real_escape_string($_POST['Direccion_User']);
    
    // Cambiar el nombre del campo de contraseña a passwordUsuario
    $query = "INSERT INTO Usuario (nombreUsuario, apellidoUsuario, correoUsuario, passwordUsuario, direccionUsuario) 
            VALUES ('$nombre', '$apellido', '$correo', '$contrasena', '$direccion')";
    
    if ($conexion->query($query)) {
        header("Location: usuarios.php?success=Usuario agregado exitosamente");
        exit; // Agregar exit después del header
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/Css/Usuarios.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Agregar Usuario</h1>
        <form action="AgregarUsuario.php" method="post"> <!-- Cambié a AgregarUsuario.php -->
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Nombre" name="Usuario_Nombre" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Apellido" name="Apellido_User" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="Correo electrónico" name="Corre_ele" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" placeholder="Contraseña" name="Contra_User" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Dirección" name="Direccion_User" required>
            </div>
            <button type="submit" name="registrar" class="btn btn-primary">Agregar Usuario</button>
            <a href="usuarios.php" class="btn btn-secondary">Volver</a> <!-- Botón para regresar a la gestión de usuarios -->
        </form>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
