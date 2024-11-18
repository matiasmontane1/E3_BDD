<?php

    include('../config/conexion.php');

    $email = $_POST['email'];
    $password = $_POST['password']; // Acá deben hashear la contraseña: https://www.php.net/manual/es/function.password-hash.php 
    $role = $_POST['role'];

    $query = "SELECT * FROM usuario WHERE id = '$email'";  // Usamos la variable directamente en la consulta (ten cuidado con la inyección SQL)
    $result = pg_query($db, $query);

    if (pg_num_rows($result) > 0) {
        echo "<p align='center'>El usuario ya está registrado en el sistema.</p>";
    } else {
        $insert_query = "INSERT INTO usuario (id, clave, rol) VALUES ('$email', '$password', '$role')";
        
        if (pg_query($db, $insert_query)) {
            echo "<p align='center'>Usuario registrado con éxito.</p>";
        } else {
            echo "<p align='center'>Hubo un error al registrar el usuario. Intente nuevamente.</p>";
        }
    }
?>
<?php include('../templates/footer_admin.html'); ?>