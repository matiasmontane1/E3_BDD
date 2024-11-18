<?php
require('../config/conexion.php');

// Leer datos de las notas
$archivo_datos = fopen("../datos/notas_adivinacion I.csv", "r");
$notas = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    if (!empty($linea)) { 
        $tupla = explode(";", $linea);
        $notas[] = $tupla;
    }
}
fclose($archivo_datos);

try {
    pg_query($db, "BEGIN");

    $crear_acta = "CREATE TEMP TABLE acta (
        numero_alumno INT PRIMARY KEY,
        run INT,
        asignatura VARCHAR(255),
        seccion INT,
        periodo VARCHAR(12),
        oportunidad_dic VARCHAR(3),
        oportunidad_mar VARCHAR(3),
        nombre_profe VARCHAR(100),
        nombre_alumno VARCHAR(100),
        nota_final VARCHAR(3) 
    );";
    pg_query($db, $crear_acta);

    $alumnos_encontrados=0;
    foreach ($notas as $fila) {
        if ($fila[0]!= ""){
            $numero_alumno = (int)$fila[0];
            $curso = $fila[2];
            $periodo = $fila[4];
            $o_dic = $fila[5];
            $o_mar = $fila[6];
            $seccion = $fila[3];
            $run_a = $fila[1];
        
            //tenemos que arreglar la variable periodo debido a que el semestre esta como 2 cuando deberia ser 02
            list($año, $semestre) = explode('-', $periodo);
            $periodo = $año . "-0" . $semestre;
            // vamos a obtener mediante una consulta el nombre del alumno
            $nombrealumno = "SELECT nombres FROM personas WHERE '$run_a' = run;";
            $nombre_a = pg_query($db, $nombrealumno);
            $nombre_alumno = pg_fetch_result($nombre_a, "nombres");
            if ($nombre_alumno === false) {
                throw new Exception("No se encontró el rut del alumno en la tabla personas");
            }
            //vamos a obtener el run del profesor apartir del ramo y la seccion y el perido
            $run_profe = "SELECT run FROM oferta_academica WHERE '$periodo' = periodo AND '$seccion' = seccion AND '$curso' = sigla;";
            $run_p = pg_query($db, $run_profe);
            $run_pr = pg_fetch_result($run_p, "run");
            if ($run_pr === false) {
                throw new Exception("No se encontró un run para los parámetros especificados.");
            }
            // vamos a obtener el nombre del profesor apartir de su run en la tabla personas
            $nombre_p = "SELECT nombres FROM personas WHERE '$run_pr' = run;";
            $nombre_p = pg_query($db, $nombre_p);
            $nombre_profe = pg_fetch_result($nombre_p, "nombres");
            $error = FALSE;
            $nota_final = 0;
            if ($o_dic != "NP"){
                if ((float)$o_dic < 1 && (float)$o_dic > 7 && (float)$o_mar < 1 && (float)$o_mar > 7) {
                    $error= TRUE;
                }
                if ((float)$o_dic >= 4){
                    if ($o_mar == ""){
                        $nota_final = $o_dic;
                    }
                    else {
                        $error = TRUE;
                    }
                }
                if ((float)$o_dic < 4 && (float)$o_mar < 4){
                    $nota_final = $o_mar;
                }
                if ((float)$o_dic < 4 && $o_mar == ""){
                    $nota_final = $o_dic;
                }
                if ((float)$o_dic < 4 && (float)$o_mar >= 4){
                    $nota_final = $o_mar;
                }
            }
            else {
                if ($o_mar == "" || is_null($o_mar)){
                    $nota_final = "";
                }
                else {
                    $nota_final = $o_mar;
                }
            }
            
            if($error == FALSE){
                $valores_acta = "INSERT INTO acta (numero_alumno, run, asignatura, seccion, periodo, oportunidad_dic, oportunidad_mar, nombre_profe, nombre_alumno, nota_final)
                    VALUES ($numero_alumno, $run_a, '$curso', $seccion, '$periodo', '$o_dic', '$o_mar', '$nombre_profe', '$nombre_alumno', '$nota_final');";
                $insertar = pg_query($db, $valores_acta);
            }
            else {
                throw new Exception("nota de {$numero_alumno} contiene un valor erroneo, corrijalo manualmente en el archivo de origen y vuelva a cargar"); 
            }
        
        }
        
    }
    $query = "SELECT crearvistaacta();";
    $result = pg_query($db, $query);
    pg_query($db, "COMMIT");
    echo "Todas las notas se metieron en la tabla temporal acta";
    
} catch (Exception $e) {
    pg_query($db, "ROLLBACK");
    echo "Error: " . $e->getMessage();
}
?>
