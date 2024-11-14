<?php
session_start();
include('../config/conexion.php'); 

$email = $_POST['email'];
$password = $_POST['password'];

$query = $db->prepare("SELECT * FROM usuario WHERE id = :id LIMIT 1");
$query->bindParam(':id', $email);
$query->execute();
$user = $query->fetch();

if ($user && $user['clave'] === $password) { // Esta comparación debe ser con password_verify() si la contraseña está hasheada
    // Iniciar sesión y establecer el rol
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