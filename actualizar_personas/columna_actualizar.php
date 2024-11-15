<?php
  require('../config/conexion.php');
  $query = "
        ALTER TABLE personas
        ADD COLUMN actualizado VARCHAR(3) DEFAULT 'no';
    ";

    $cambio = pg_query($db, $query);
    if($cambio) {
        echo "se añadio columna de actualizacion a personas";
    }
    if(!$cambio){
        echo "hubo un error al añadir la columna actualizado a personas";
    }
    
    pg_close($db);
?>