<?php include('../templates/header.html'); ?>
<body>
    <?php
        require("../config/conexion.php");

        $codigoCurso = $_POST["Curso"];

        // Consulta para obtener el número de aprobados
        $queryAprobados = "SELECT COUNT(*) AS aprobados 
                           FROM historial_academico 
                           WHERE sigla = '$codigoCurso' AND Calificacion IN ('SO', 'MB', 'B', 'SU');";
        $resultAprobados = pg_query($db, $queryAprobados);

        if (!$resultAprobados) {
            echo "Error en la consulta de aprobados.\n";
            exit;
        }

        $aprobados = pg_fetch_assoc($resultAprobados);

        // Consulta para obtener el total de estudiantes
        $queryTotales = "SELECT COUNT(*) AS totales 
                         FROM historial_academico 
                         WHERE sigla = '$codigoCurso';";
        $resultTotales = pg_query($db, $queryTotales);

        if (!$resultTotales) {
            echo "Error en la consulta de totales.\n";
            exit;
        }

        $totales = pg_fetch_assoc($resultTotales);
    ?>

    <table class="styled-table">
        <tr>
            <th>Promedio de Aprobación</th>
        </tr>
        <tr>
            <td><?php echo round(($aprobados['aprobados'] / $totales['totales']) * 100) . "%"; ?></td> 
        </tr>
    </table>
<body>
<?php include('../templates/footer.html'); ?>
