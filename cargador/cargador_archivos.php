<?php
//PERSONAS
$archivo_datos = fopen("../datos/Estudiantes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);

$personas = [];
foreach ($array_datos as $fila) {
    $run = $fila[6];

    if (!array_key_exists($run, $personas)) {
        $personas[$run] = [
            'RUN' => $fila[6],
            'DV' => $fila[7],
            'Nombres' => $fila[8] . " " . $fila[9],
            'Apellido Paterno' => $fila[10],
            'Apellido Materno' => $fila[11],
            'Email Personal' => "",
            'Email Institucional' => "",
            'Telefono' => ""
        ];
    }
}

$archivo_datos = fopen("../datos/docentes_planificados.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}

fclose($archivo_datos);

foreach ($array_datos as $fila) {
    $run = $fila[0];

    if (!array_key_exists($run, $personas)) {
        $personas[$run] = [
            'RUN' => $fila[0],
            'DV' => "",
            'Nombres' => $fila[1],
            'Apellido Paterno' => $fila[2],
            'Apelllido Materno' => "",
            'Email Personal' => $fila[4],
            'Email Institucional' => $fila[5],
            'Telefono' => $fila[3]
        ];
    }
}

$archivo_datos = fopen("../datos/Notas.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);

while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);

foreach ($array_datos as $fila) {
    $run = $fila[0];

    if (!array_key_exists($run, $personas)) {
        $personas[$run] = [
            'RUN' => $fila[4],
            'DV' => $fila[5],
            'Nombres' => $fila[6],
            'Apellido Paterno' => $fila[7],
            'Apellido Materno' => $fila[8],
            'Email Personal' => "",
            'Email Institucional' => "",
            'Telefono' => ""
        ];
    }
}

$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);

while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);

foreach ($array_datos as $fila) {
    $run = $fila[20];
    if ($fila[23] == 0 || $fila[23]== "0"){
        $apellidoM = "";
    }
    else {
        $apellidoM = $fila[23];
    }

    if (!array_key_exists($run, $personas) && $run != "#N/D") {
        $personas[$run] = [
            'RUN' => (int)$fila[20],
            'DV' => "",
            'Nombres' => trim(str_replace(".", "", $fila[21])),
            'Apellido Paterno' => str_replace(".", "", $fila[22]),
            'Apellido Materno' => $apellidoM,
            'Email Personal' => "",
            'Email Institucional' => "",
            'Telefono' => ""
        ];
    }
}

$real_personas = array_values($personas);

$archivo_datos = fopen("../datos_malos/Personas_bad.csv", "w");
foreach ($real_personas as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);

// ADMINISTRATIVOS

$archivo_datos = fopen("../datos/docentes_planificados.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);

#$ultimoRUN = '';
    #foreach ($array_datos as &$fila) {
        #if (!empty($fila[0])) {
            #$ultimoRUN = $fila[0];
        #} else {
            #$fila[0] = $ultimoRUN;
        #}
    #}

$administrativos = [];
foreach ($array_datos as $fila) {
    if ($fila[0] != "" and ($fila[15] == "Administrativo" or $fila[14] != "")) {
        $run = $fila[0];

        if (!array_key_exists($run, $administrativos)) {
            $administrativos[$run] = [
                'RUN' => $fila[0],
                'Grado Academico' => $fila[12],
                'Cargo' => $fila[14],
                'JerarquiaAcademica' => $fila[13],
                'Contrato' => $fila[7],
                'Dedicacion' => $fila[6]
            ];
        }
    }
}

$archivo_datos = fopen("../datos_malos/Administrativos_bad.csv", "w");
foreach ($administrativos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);

//PLANES
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$datos_planes = [];
foreach ($array_datos as $fila) {
    $datos_planes[] = [
        'CodigoPlan' => $fila[0],
        'NombrePlan' => $fila[3],
        'InicioVigencia' => $fila[8],
        'Jornada' => $fila[4],
        'Modalidad' => $fila[7],
        'Sede' => $fila[5],
        'Grado' => $fila[6],
    ];  
}
$archivo_datos = fopen("../datos_malos/Planes_bad.csv", "w");
foreach ($datos_planes as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($datos_planes);
//Facultades
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$facus = [];
foreach ($array_datos as $fila) {
    if (!in_array($fila[1], $facus)){
         $facus[] = $fila[1];
    }   
}
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
foreach ($array_datos as $fila) {
    if (!in_array($fila[2], $facus)){
         $facus[] = $fila[2];
    }   
}
$real_facus = [];
foreach ($facus as $f){
    if ($f != ""){
        $real_facus[] = $f;
    }
}
$id = 0;
$datos_facu = [];
foreach ($real_facus as $fila) {
    $id = $id + 1;
    $datos_facu[] = [
        'FacultadID' => $id,
        'NombreFacultad' => $fila
    ];  
}
$archivo_datos = fopen("../datos_malos/Facultades_bad.csv", "w");
foreach ($datos_facu as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($datos_facu);

//Carreras
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$carreras = [];
foreach ($array_datos as $fila) {
   if (!in_array($fila[2], $carreras)){
        $carreras[] = $fila[2];
   }
}
$real_carreras = [];
foreach($carreras as $carrera){
    $real_carreras[] = [$carrera];
}
$archivo_datos = fopen("../datos_malos/Carreras_bad.csv", "w");
foreach ($real_carreras as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);
// planes facu
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$carreras = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[0],$fila[1]] , $carreras)){
        $carreras[] = [$fila[0],$fila[1]];
   }
}
$real_carreras = [];
foreach($carreras as $carrera){
    if ($carrera[0] != ""){
        $real_carreras[] = $carrera;
    }
}
$archivo_datos = fopen("../datos_malos/Planes_facu_bad.csv", "w");
foreach ($real_carreras as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);

// planes carrera
$archivo_datos = fopen("../datos/Planes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$carreras = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[0],$fila[2]] , $carreras)){
        $carreras[] = [$fila[0],$fila[2]];
   }
}
$real_carreras = [];
foreach($carreras as $carrera){
    if ($carrera[0] != ""){
        $real_carreras[] = $carrera;
    }
}
$archivo_datos = fopen("../datos_malos/Planes_carreras_bad.csv", "w");
foreach ($real_carreras as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);
// Departamentos
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$departamentos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[3],$fila[4]] , $departamentos)){
        $departamentos[] = [$fila[3],$fila[4]];
   }
}
$real_deptos = [];
foreach($departamentos as $deptos){
    if ($deptos[0] != "" && $deptos[1] != ""){
        $real_deptos[] = $deptos;
    }
}
$archivo_datos = fopen("../datos_malos/Departamentos_bad.csv", "w");
foreach ($real_deptos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);

//departamento con facultades
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$departamentos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[2],$fila[3]] , $departamentos)){
        $departamentos[] = [$fila[2],$fila[3]];
   }
}
$real_deptos = [];
foreach($departamentos as $deptos){
    if ($deptos[0] != "" && $deptos[1] != ""){
        $real_deptos[] = $deptos;
    }
}
$archivo_datos = fopen("../datos_malos/Departamentos_facu_bad.csv", "w");
foreach ($real_deptos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($carreras);
unset($real_carreras);

// Cursos
$archivo_datos = fopen("../datos/Asignaturas.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$cursos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[1],$fila[2], $fila[3]] , $cursos)){
        $cursos[] = [$fila[1], $fila[2], $fila[3]];
   }
}
$real_cursos = [];
$falso = [];
foreach($cursos as $c){
    if ($c[0] != "" && $c[1] != "" && $c[2] != ""){
        $falso[] = [$c[0], $c[1]];
        $real_cursos[] = $c;
    }
}
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
foreach($array_datos as $r){
    if (!in_array([$r[5], $r[6]], $falso)){
        $falso[] = [$r[5], $r[6]];
        $real_curso[] = [$r[5], $r[6], ""];
    }
}
$archivo_datos = fopen("../datos_malos/Cursos_bad.csv", "w");
foreach ($real_cursos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($cursos);
unset($real_cursos);

// Cursos plan
$archivo_datos = fopen("../datos/Asignaturas.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$cursos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[0],$fila[1]] , $cursos)){
        $cursos[] = [$fila[0], $fila[1]];
   }
}
$real_cursos = [];
foreach($cursos as $c){
    if ($c[0] != "" && $c[1] != ""){
        $real_cursos[] = $c;
    }
}
$archivo_datos = fopen("../datos_malos/Cursos_plan_bad.csv", "w");
foreach ($real_cursos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($cursos);
unset($real_cursos);

// cursos facultades departamentos
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$cursos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[2],$fila[3], $fila[5]] , $cursos)){
        $cursos[] = [$fila[2], $fila[3], $fila[5]];
   }
}
$real_cursos = [];
foreach($cursos as $c){
    if ($c[0] != "" && $c[1] != ""){
        $real_cursos[] = $c;
    }
}
$archivo_datos = fopen("../datos_malos/Cursos_depa_facu_bad.csv", "w");
foreach ($real_cursos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($cursos);
unset($real_cursos);

// Historial academico
$archivo_datos = fopen("../datos/Notas.csv", "r");
$archivo_salida = fopen("../datos_malos/Historial_academico_bad.csv", "w");
$headers = fgetcsv($archivo_datos, 0, ";");
$notas = [];
while (($fila = fgetcsv($archivo_datos, 0, ";")) !== false) {
    $nota = $fila[9] . "|" . $fila[11] . "|" . $fila[10] . "|" . $fila[13] . "|" . $fila[14] . "|" . $fila[15];
    if (!isset($notas[$nota])) {
        $notas[$nota] = true;
        $linea = implode("|", [$fila[9], $fila[11], $fila[10], $fila[13], $fila[14], $fila[15]]) . "\n";
        fwrite($archivo_salida, $linea);
    }
}
fclose($archivo_datos);
fclose($archivo_salida);
unset($notas);
// oferta academica
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
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
        if (!in_array([$fila[0],$fila[1], $fila[5], $fila[7],$fila[8],$fila[9], $fila[10], $fila[11],$fila[13], $fila[14], $fila[12],$fila[15], $fila[16], $fila[17],$fila[18], $fila[19], $fila[20], $fila[21], $fila[22]] , $oferta)){
            $oferta[] = [$fila[0],$fila[1], $fila[5], $fila[7],$fila[8],$fila[9], $fila[10], $fila[11],$fila[13], $fila[14], $fila[12],$fila[15], $fila[16], $fila[17],$fila[18], $fila[19], $fila[20], $fila[21], $fila[22], $fila[3]];
        }
    }
}
foreach($oferta as &$ramo){
    if ($ramo[18] == "POR" && $ramo[17] == "DESIGNAR"  && $ramo[16] != $ramo[19]){
        $ramo[17] = "";
        $ramo[18] = "";
    }
    if ($ramo[18] == "DESIGNAR" && $ramo[17] == "POR"  && $ramo[16] != $ramo[19]){
        $ramo[17] = "";
        $ramo[18] = "";
    }
    if ($ramo[16] == "#N/D" || $ramo[16] == 100 || $ramo[16] == "100"){
        $ramo[16] = $ramo[19];
        $ramo[17] = "POR";
        $ramo[18] = "DESIGNAR";
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

//prerequisitos 
$archivo_datos = fopen("../datos/Prerequisitos.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$requisitos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[1],$fila[4], $fila[5]] , $requisitos)){
        $requisitos[] = [$fila[1], $fila[4], $fila[5]];
   }
}

$archivo_datos = fopen("../datos_malos/Prerequisitos_bad.csv", "w");
foreach ($requisitos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($requisitos);

// Estudiantes
$archivo_datos = fopen("../datos/Estudiantes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$alumnos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[3],$fila[6], $fila[2], $fila[4],$fila[5], $fila[14], $fila[13],$fila[12]] , $alumnos)){
        $alumnos[] = [$fila[3],$fila[6], $fila[2], $fila[4],$fila[5], $fila[14], $fila[13],$fila[12], ""];
   }
}
foreach($alumnos as &$alumno){
    if ($alumno[5] == "2024-02"){
        $alumno[8] = "ESTUDIANTE VIGENTE";
    }
    if ($alumno[5] != "2024-02"){
        $alumno[8] = "ESTUDIANTE NO VIGENTE";
    }
    if (str_contains($alumno[7], "LICENCIATURA")){
        $alumno[8] = "EXALUMNO";
    }
}
foreach($alumnos as &$alumno){
    $a = 0;
    if (str_contains($alumno[7], "TITULO")){
        $alumno[7] = "TITULO";
    }
    if (str_contains($alumno[7], "LICENCIATURA")){
        $alumno[7] = "LICENCIATURA";
    }
    if (str_contains($alumno[7], "PRIMER AÑO") && $a == 0){
        $alumno[7] = "2 SEMESTRE";
    }
    if (str_contains($alumno[7], "1 AÑO") && $a == 0){
        $alumno[7] = "2 SEMESTRE";
    }
    if (str_contains($alumno[7], "SEGUNDO AÑO") && $a == 0){
        $alumno[7] = "4 SEMESTRE";
    }
    if (str_contains($alumno[7], "2 AÑO") && $a == 0){
        $alumno[7] = "4 SEMESTRE";
    }
    if (str_contains($alumno[7], "TERCER AÑO") && $a == 0){
        $alumno[7] = "6 SEMESTRE";
    }
    if (str_contains($alumno[7], "3 AÑO") && $a == 0){
        $alumno[7] = "6 SEMESTRE";
    }
    if (str_contains($alumno[7], "CUARTO AÑO") && $a == 0){
        $alumno[7] = "8 SEMESTRE";
    }
    if (str_contains($alumno[7], "4 AÑO") && $a == 0){
        $alumno[7] = "8 SEMESTRE";
    }
    if (str_contains($alumno[7], "QUINTO AÑO") && $a == 0){
        $alumno[7] = str_replace("QUINTO AÑO", "10 SEMESTRE", $alumno[7]);
    }
    if (str_contains($alumno[7], "5 AÑO") && $a == 0){
        $alumno[7] = str_replace("5 AÑO", "10 SEMESTRE", $alumno[7]);
    }
    if (str_contains($alumno[7], "SEMESTRE")){
        $alumno[7] = str_replace("SEMESTRE", "", $alumno[7]);
    }
    if (str_contains($alumno[7], "- EGRESO")){
        $alumno[7] = str_replace("- EGRESO", "", $alumno[7]);
    }
    if (str_contains($alumno[7], "- BACHILLER")){
        $alumno[7] = str_replace("- BACHILLER", "", $alumno[7]);
    }
    $alumno[7] = trim($alumno[7]);
}
$archivo_datos = fopen("../datos_malos/Estudiantes_bad.csv", "w");
foreach ($alumnos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($alumnos);

// estudiantes carrera plan
$archivo_datos = fopen("../datos/Estudiantes.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$alumnos = [];
foreach ($array_datos as $fila) {
   if (!in_array([$fila[3],$fila[0], $fila[1]] , $alumnos)){
        $alumnos[] = [$fila[3],$fila[0], $fila[1]];
   }
}
$archivo_datos = fopen("../datos_malos/Estudiantes_carrera_plan_bad.csv", "w");
foreach ($alumnos as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($alumnos);

// Academicos
$archivo_datos = fopen("../datos/docentes_planificados.csv", "r");
$array_datos = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos[] = explode(";", $linea);
}
fclose($archivo_datos);
$profes = [];
$ruts = [];
$jerarquias_academicas = array("ASISTENTE DOCENTE","ASISTENTE REGULAR","ASISTENTA DOCENTE","ASISTENTA REGULAR","ASOCIADO DOCENTE","ASOCIADO REGULAR","ASOCIADA DOCENTE","ASOCIADA REGULAR","INSTRUCTOR DOCENTE","INSTRUCTOR REGULAR","INSTRUCTORA DOCENTE","INSTRUCTORA REGULAR","TITULAR DOCENTE","TITULAR REGULAR","SIN JERARQUIZAR","COMISION SUPERIOR","PROFESOR ASISTENTE DOCENTE","PROFESOR ASISTENTE REGULAR","PROFESORA ASISTENTA DOCENTE","PROFESORA ASISTENTA REGULAR","PROFESOR ASOCIADO DOCENTE","PROFESOR ASOCIADO REGULAR","PROFESORA ASOCIADA DOCENTE","PROFESORA ASOCIADA REGULAR","PROFESOR INSTRUCTOR DOCENTE","PROFESOR INSTRUCTOR REGULAR","PROFESORA INSTRUCTORA DOCENTE","PROFESORA INSTRUCTORA REGULAR","PROFESOR TITULAR DOCENTE","PROFESOR TITULAR REGULAR");
foreach ($array_datos as $fila) {
    if ($fila[0] != ""){
        if (strlen($fila[12])>0 && strlen($fila[13]) > 0){
            if (!in_array([$fila[0],$fila[12], $fila[8], $fila[9], $fila[13], $fila[7]] , $profes)){
                $profes[] = [$fila[0],$fila[12], $fila[8], $fila[9], $fila[13], $fila[7], $fila[6]];
                $ruts[] = $fila[0];
            }
        }
        if ($fila[15] == "Académico"){
            if (!in_array([$fila[0],$fila[12], $fila[8], $fila[9], $fila[13], $fila[7]] , $profes)){
                $profes[] = [$fila[0],$fila[12], $fila[8], $fila[9], $fila[13], $fila[7], $fila[6]];
                $ruts[] = $fila[0];
            }
        }
        
    }
} 
$archivo_datos = fopen("../datos/Planeacion.csv", "r");
$array_datos_p = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $array_datos_p[] = explode(";", $linea);
}
fclose($archivo_datos);
foreach($array_datos_p as $p){
    if (!in_array($p[20], $ruts) && !in_array($p[20], ["#N/D", ""])){
        $ruts[] = $p[20];
        $profes[] = [$p[20],"", "", "", "", "", ""];
    }
}
$archivo_datos = fopen("../datos_malos/Academicos_bad.csv", "w");
foreach ($profes as $dato) {
    $linea = implode("|", $dato) . "\n";
    fwrite($archivo_datos, $linea);
}
fclose($archivo_datos);
unset($array_datos);
unset($profes);

?>
