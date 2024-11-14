<?php

    include('../config/conexion.php');

    $email = $_POST['email'];
    $password = $_POST['password']; // Acá deben hashear la contraseña: https://www.php.net/manual/es/function.password-hash.php 
    $role = $_POST['role'];

    $query = $db->prepare("SELECT * FROM usuario WHERE id = :id");
    $query->bindParam(':id', $email);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo "<p align='center'>El usuario ya está registrado en el sistema.</p>";
    } else {
        $query = $db->prepare("INSERT INTO usuario (id, clave, rol) VALUES (:id, :clave, :rol)");
        $query->bindParam(':id', $email);
        $query->bindParam(':clave', $password);
        $query->bindParam(':rol', $role);
        
        if ($query->execute()) {
            echo "<p align='center'>Usuario registrado con éxito.</p>";
        } else {
            echo "<p align='center'>Hubo un error al registrar el usuario. Intente nuevamente.</p>";
        }
    }
  
  ?>

<?php include('../templates/footer_admin.html'); ?>