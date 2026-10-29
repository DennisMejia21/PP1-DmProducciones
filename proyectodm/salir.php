<?php
session_start();
session_destroy(); // destruye la sesión
header("Location: index.php"); // redirige al inicio
exit();
?>