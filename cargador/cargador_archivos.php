<?php
// oferta academica
$archivo_datos = fopen("../datos/Planeación.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$oferta = [];
foreach ($array_datos as $fila) {
    if ($fila[0]!= ""){
        if (!in_array([$fila[0],$fila[1], $fila[5], $fila[7],$fila[8],$fila[9], $fila[10], $fila[11],$fila[13], $fila[14], $fila[12],$fila[15], $fila[16], $fila[17],$fila[18], $fila[19], $fila[20]] , $oferta)){
            $oferta[] = [$fila[0],$fila[1], $fila[5], $fila[7],$fila[8],$fila[9], $fila[10], $fila[11],$fila[13], $fila[14], $fila[12],$fila[15], $fila[16], $fila[17],$fila[18], $fila[19], $fila[20], $fila[3]];
        }
    }
}
foreach($oferta as &$ramo){
    if ($ramo[16] == "#N/D" || $ramo[16] == 100 || $ramo[16] == "100"){
        $ramo[16] = $ramo[17];
    }
    array_pop($ramo);
}
$archivo_datos = fopen("../datos_malos/Oferta_academica_bad.csv", "w");
foreach ($oferta as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($oferta);
?>
