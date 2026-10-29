<?php
// Datos de conexión para XAMPP local
$servername = "localhost";
$username   = "root";     // usuario por defecto en XAMPP
$password   = "";         // sin contraseña por defecto
$database   = "proyectodm2"; // cambia esto por el nombre real de tu base de datos

// Crear conexión
$conex = mysqli_connect($servername, $username, $password, $database);

// Verificar conexión
if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Opcional: establecer codificación UTF-8
mysqli_set_charset($conex, "utf8");
?>