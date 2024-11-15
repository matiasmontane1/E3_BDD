<?php
  require('../config/conexion.php');
  $a = "SELECT COUNT(*) as actualizado FROM personas WHERE actualizado = 'si';";
  $ar = pg_query($db, $a);
  $arr = pg_fetch_assoc($ar);
  echo "Número de personas actualizadas " . $arr['actualizado'];
  // vamos a contar cuantos profes son los que tenemos que editar en la tabla personas este numero tiene que calzar con la cantidad de actualizados en la tabla personas al final
  $p = "SELECT COUNT(*) as run FROM profesores WHERE run > 100000;";
  $pr = pg_query($db_profes, $p);
  $r = pg_fetch_assoc($pr);
  echo "\nNúmero de profes que hay que actualizar " . $r['run'];
  // extraer datos para actualizar en personas
  $datosp = "SELECT run, nombre, apellido1, apellido2, email_institucional, email_personal, telefono FROM profesores";
  $datospr = pg_query($db_profes, $datosp);
  while ($profe = pg_fetch_assoc($datospr)) {
    if($profe['telefono'] === '' || $profe['telefono'] === "" || is_null($profe['telefono'])){
        $telefono = 0;
    }
    else {
        $telefono = $profe['telefono'];
    }
    $actualizar = "
        UPDATE personas
        SET nombres = '{$profe['nombre']}',
            apellidopaterno = '{$profe['apellido1']}',
            apellidomaterno = '{$profe['apellido2']}',
            mailinstitucional = '{$profe['email_institucional']}',
            mailpersonal = '{$profe['email_personal']}',
            telefono = '{$telefono}',
            actualizado = 'si'
        WHERE run = '{$profe['run']}' AND actualizado = 'no';
    ";
    $actualizarr = pg_query($db, $actualizar);
    if (!$actualizarr) {
        throw new Exception("no se pudo actualizar el profe: " . $profe['run'] . " " . pg_last_error($db));
    }
}
  $a = "SELECT COUNT(*) as actualizado FROM personas WHERE actualizado = 'si';";
  $ar = pg_query($db, $a);
  $arr = pg_fetch_assoc($ar);
  echo "\nNúmero de personas actualizadas " . $arr['actualizado'];
?>