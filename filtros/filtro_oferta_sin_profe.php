<?php
require "./funciones_filtro.php";

$archivo_datos = fopen("../datos_malos/Oferta_academica_bad.csv", "r");
$array_datos = [];
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode("|", $linea);
}
fclose($archivo_datos);
$ramos = [];
$id = 0;
foreach ($array_datos as $fila) {
    $sedes = ["HOGWARTS", "BEAUXBATON", "UAGADOU"];
    $duracion = ["S", "A", "I"];
    $jornadas = ["DIURNO", "VESPERTINO"];
    $sed = strtoupper($fila[1]);
    $jorna = strtoupper($fila[5]);
    $seccion = (int)$fila[3];
    $cupos = (int)$fila[6];
    $inscritos = (int)$fila[7];
    $h_i = date('H:i', strtotime($fila[8]));
    $h_f = date('H:i', strtotime($fila[9]));
    $dia = str_replace("é", "É", $fila[10]);
    $timestamp = strtotime($fila[11]);
    $f_i = date('Y-m-d', $timestamp);
    $fecha = explode('/', $fila[12]);
    $f_t = "20" . $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
    $profesor = profesor($fila[17], $fila[18]);
    if (in_array($sed, $sedes) && in_array($fila[4], $duracion) && in_array($jorna, $jornadas)&& $profesor == "NO") {
        $id = $id + 1;
        $ramos[] = [$id, $fila[0], $sed, $fila[2], $seccion, $fila[4], $jorna, $cupos, $inscritos, $h_i, $h_f, strtoupper($dia), $f_i, $f_t, $fila[13], $fila[14], $fila[15], $fila[16], $profesor]; 
    }
}  
$archivo_datos = fopen("../datos_aceptados/Oferta_academica_SINA_gud.csv", "w");
if (!$archivo_datos) {
    die("Error: No se pudo abrir el archivo de datos.");
}
foreach ($ramos as $dato) {
    $linea = implode(";", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($ramos);
?>