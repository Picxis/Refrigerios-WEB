<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "CONTROL_MANEJO_REFRIGERIOS");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Eliminar usuario
if (isset($_GET['delete'])) {
    $usuarioId = $_GET['delete'];
    $conexion->query("DELETE FROM Usuario WHERE idUsuario='$usuarioId'");
}

// Listar usuarios
$resultadoUsuarios = $conexion->query("SELECT * FROM Usuario");
if (!$resultadoUsuarios) {
    die("Error en la consulta: " . $conexion->error);  // Mostrar el error si la consulta falla
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/Css/Usuarios.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Gestión de Usuarios</h1>
        <div class="row">
            <div class="col-md-12">
                <h2>Usuarios Registrados</h2>
                
                <?php if ($resultadoUsuarios->num_rows > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($usuario = $resultadoUsuarios->fetch_assoc()): ?>
                        <tr>
                            <th scope="row"><?php echo $usuario['idUsuario']; ?></th>
                            <td><?php echo $usuario['nombreUsuario']; ?></td>
                            <td><?php echo $usuario['apellidoUsuario']; ?></td>
                            <td><?php echo $usuario['correoUsuario']; ?></td>
                            <td><?php echo $usuario['direccionUsuario']; ?></td>
                            <td>
                                <a href="./EditarUsuario.php?edit=<?php echo $usuario['idUsuario']; ?>" class="btn btn">
                                    <i class="fas fa-pencil-alt"></i> Editar
                                </a>
                                <a href="usuarios.php?delete=<?php echo $usuario['idUsuario']; ?>" class="btn" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p>No hay usuarios registrados.</p>
                <?php endif; ?>

                <!-- botones debajo de la tabla -->
                <div class="d-flex justify-content-start mt-3">
                    <a href="./AgregarUsuario.php" class="btn btn-primary me-2">Agregar Usuario</a> <!-- Botón para agregar usuario -->
                    <a href="./Reportes.php" class="btn btn-secondary">Generar Reporte</a> <!-- Botón para generar reporte -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conexion->close();
?>
