<?php
require('../config/conexion.php');
// leer datos de las notas
$archivo_datos = fopen("../datos/notas_adivinacion |.csv", "r");
$notas = [];
$headers = fgets($archivo_datos);
while (($linea = fgets($archivo_datos)) !== false) {
    $linea = trim($linea);
    $notas[] = explode(";", $linea);
}
fclose($archivo_datos);
try {
     pg_query($db, "BEGIN");

     $crear_acta = "CREATE TEMP TABLE acta (
     numero_alumno INT PRIMARY KEY REFERENCES Estudiantes(NumeroEstudiante),
     asignatura VARCHAR(255) REFERENCES Cursos(Sigla),
     periodo VARCHAR(12),
     nombre_alumno VARCHAR(225),
     nombre_profe VARCHAR(225),
     nota_final FLOAT
     );";
}



?>