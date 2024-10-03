<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Si no está autenticado, redirigir a la página de inicio de sesión
    header("Location: ../View/login.html");
    
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Refrigerios Web</title>
    <link rel="stylesheet" href="../Assets/Css/Index.css">
</head>
<body>
    <div class="hero">
        <nav>
            <img src="../Assets/Img/Escudo HDD.png" class="logo">
            <ul>
                <li><a href="#" class="btnlogin">Ayuda</a></li>
                <li><a href="#" class="btnregister">Contacto</a></li>
                <li><a href="./cerrar_sesion.php" class="btnlogin">Cerrar sesión</a></li>
            </ul>
        </nav>
        
        <div class="container">
            <h1>Refrigerios web <br> Hernando Duran Dussan</h1>
            <div class="contenido">
                <p>
                    El siguiente proyecto tiene como finalidad resolver la problemática de la institución educativa técnica 
                    "Hernando Durán Dussán", el cual tiene inconsistencia en la toma de datos de la cantidad de estudiantes 
                    que hay en cada curso para la entrega de los refrigerios. Se tiene como idea planteada crear un sistema de 
                    información el cual facilite la toma de datos del número de estudiantes que asisten y el número de refrigerios 
                    que se van a entregar por curso, para así optimizar la entrega, toma de datos y saber con exactitud la cantidad 
                    de estudiantes que hay en cada curso.
                </p>
                <img src="../Assets/Img/Index_refri.png" class="imagen">
            </div>
        </div>
    </div>
</body>
</html>
