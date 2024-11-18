<?php
session_start();
include('../config/conexion.php'); 

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM usuario WHERE id = '$email' LIMIT 1";
$result = pg_query($db, $query);
$user = pg_fetch_assoc($result);

if ($user && $user['clave'] === $password) { 
    $_SESSION['user'] = $user['id'];
    $_SESSION['role'] = $user['rol'];

    // Redirigir según el rol
    if ($user['rol'] === 'admin') {
        header("Location: ../admin.php");
    } else {
        header("Location: ../user.php"); 
    }
    exit();
} else {
    echo "Correo electrónico o contraseña incorrectos.";
}

?>