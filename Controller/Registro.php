<?php
    // Conectar a la base de datos
    $conexion = new mysqli("localhost", "root", "", "CONTROL_MANEJO_REFRIGERIOS");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Verificar que los datos del formulario estén presentes
    if (isset($_POST['Usuario_Nombre'], $_POST['Apellido_User'], $_POST['Corre_ele'], $_POST['Contra_User'], $_POST['Direccion_User'])) {
        // Obtener datos del formulario
        $nombreUsuario = $conexion->real_escape_string($_POST['Usuario_Nombre']);
        $apellidoUsuario = $conexion->real_escape_string($_POST['Apellido_User']);
        $correoUsuario = $conexion->real_escape_string($_POST['Corre_ele']);
        $passwordUsuario = $conexion->real_escape_string($_POST['Contra_User']);
        $direccionUsuario = $conexion->real_escape_string($_POST['Direccion_User']);
        $rolUsuario = 'Usuario';
        $estadoUsuario = 'Activo';

        // Encriptar contraseña
        $passwordUsuario = hash('sha512', $passwordUsuario);

        // Verificar que el correo no se repita en la base de datos
        $verificar_correo = mysqli_query($conexion, "SELECT * FROM Usuario WHERE correoUsuario = '$correoUsuario'");

        if (mysqli_num_rows($verificar_correo) > 0) {
            echo '
                <script>
                    alert("Este correo ya está en uso, inténtalo de nuevo.");
                    window.location = "../View/Registro.html";
                </script>
            ';
            exit();
        } else {
            // Insertar los datos en la base de datos
            $query = "INSERT INTO Usuario (nombreUsuario, apellidoUsuario, correoUsuario, passwordUsuario, direccionUsuario, rolUsuario, estadoUsuario) 
                    VALUES ('$nombreUsuario', '$apellidoUsuario', '$correoUsuario', '$passwordUsuario', '$direccionUsuario', '$rolUsuario', '$estadoUsuario')";

            $ejecutar = mysqli_query($conexion, $query);

            if ($ejecutar) {
                echo '<script>
                        alert("Usuario registrado correctamente.");
                        window.location.href="./index.php";
                    </script>';
            } else {
                echo '<script>
                        alert("Error al registrar usuario.");
                        window.location.href="../View/Registro.html";
                    </script>';
            }
        }
    } else {
        echo '<script>
                alert("Por favor, completa todos los campos.");
                window.location.href="../View/Registro.html";
            </script>';
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
?>
