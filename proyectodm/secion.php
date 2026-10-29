<?php
session_start();
include("conexion.php"); // tu conexión $conex

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Usamos consulta segura
    $sql = "SELECT * FROM usuarios WHERE email = ? AND password = MD5(?)";
    $stmt = $conex->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION["usuario"] = $user["nombre"]; // Sesión creada solo al loguearse
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Correo o contraseña incorrectos'); window.history.back();</script>";
    }
}
?>