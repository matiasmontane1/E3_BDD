<?php
  try {
    #Pide las variables para conectarse a la base de datos.
    require('data.php'); 
    # Se crea la instancia de PDO
    $db_profes = pg_connect("host=localhost  port=5432 dbname=e3profesores user=grupo61e3 password=darwin");
    $db = pg_connect("host=localhost  port=5432 dbname=grupo61e3 user=grupo61e3 password=darwin");
    
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>