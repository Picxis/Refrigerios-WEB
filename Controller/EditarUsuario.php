<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "CONTROL_MANEJO_REFRIGERIOS");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Editar usuario
if (isset($_POST['editar'])) {
    $usuarioId = $_POST['idUsuario'];
    $nombre = $conexion->real_escape_string($_POST['Usuario_Nombre']);
    $apellido = $conexion->real_escape_string($_POST['Apellido_User']);
    $correo = $conexion->real_escape_string($_POST['Corre_ele']);
    $direccion = $conexion->real_escape_string($_POST['Direccion_User']);
    
    $conexion->query("UPDATE Usuario SET nombreUsuario='$nombre', apellidoUsuario='$apellido', correoUsuario='$correo', direccionUsuario='$direccion' WHERE idUsuario='$usuarioId'");
    header("Location: usuarios.php"); // Redirigir a la página principal después de editar
    exit();
}

// Obtener datos del usuario para editar
$usuarioDatos = null;
if (isset($_GET['edit'])) {
    $usuarioId = $_GET['edit'];
    $usuarioDatos = $conexion->query("SELECT * FROM Usuario WHERE idUsuario='$usuarioId'")->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Editar Usuario</h1>
        <form method="POST">
            <input type="hidden" name="idUsuario" value="<?php echo $usuarioDatos['idUsuario'] ?? ''; ?>">
            <div class="mb-3">
                <input type="text" class="form-control" name="Usuario_Nombre" value="<?php echo $usuarioDatos['nombreUsuario'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="Apellido_User" value="<?php echo $usuarioDatos['apellidoUsuario'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="Corre_ele" value="<?php echo $usuarioDatos['correoUsuario'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="Direccion_User" value="<?php echo $usuarioDatos['direccionUsuario'] ?? ''; ?>" required>
            </div>
            <button type="submit" name="editar" class="btn btn-warning">Actualizar</button>
            <a href="usuarios.php" class="btn btn-secondary">Cancelar</a> <!-- Botón para cancelar -->
        </form>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
