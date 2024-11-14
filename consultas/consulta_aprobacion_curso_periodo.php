<?php include('../templates/header.html'); ?>

<body>    
    <?php
        require("../config/conexion.php");
        $periodo = $_POST["periodo"];
        $pregunta = $db -> prepare("SELECT c.sigla, c.nombrecurso, (COUNT(CASE WHEN a.calificacion IN ('SO', 'MB', 'B', 'SU') THEN 1 END)/ COUNT(*) * 100.0)  AS aprobacion
                FROM historial_academico a
                JOIN cursos c ON a.sigla = c.sigla
                WHERE a.periodo_nota = :periodo
                GROUP BY c.sigla;");
        $pregunta -> bindParam(':periodo', $periodo);
        $pregunta -> execute();
        $respuesta = $pregunta -> fetch(PDO::FETCH_ASSOC);
    ?>
    <table class="styled-table">
        <tr>
            <th>Código Curso</th>
            <th>Nombre Curso</th>
            <th>Porcentaje de Aprobación</th>
        </tr>
        <?php
        foreach ($respuesta as $curso) {
            echo "<tr><td>$curso[0]</td><td>$curso[1]</td><td>$curso[2]</td></tr>";
        }
        ?>
    </table>
</body>

<?php include('../templates/footer.html'); ?>