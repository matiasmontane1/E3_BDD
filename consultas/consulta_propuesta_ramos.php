<?php
    require("../config/conexion.php");

    $numeroEstudiante = $_POST["numeroEstudiante"];

    $pregunta = $db -> prepare("SELECT cursos.Sigla
        FROM cursos
        JOIN cursos_plan ON cursos.Sigla = cursos_plan.Sigla
        JOIN estudiantes_carrera_plan ON cursos_plan.CodigoPlan = estudiantes_carrera_plan.CodigoPlan
        WHERE estudiantes_carrera_plan.NumeroEstudiante = :numeroEstudiante AND NOT EXISTS (
            SELECT 1 FROM historial_academico
            WHERE historial_academico.NumeroEstudiante = :numeroEstudiante AND historial_academico.Sigla = cursos.Sigla
        );");
    $pregunta -> bindParam(':numeroEstudiante', $numeroEstudiante);
    $pregunta -> execute();
    $respuesta = $pregunta -> fetchAll();
?>

<table class="styled-table">
    <tr>
        <th>Código De Cursos Disponibles.</th>
    </tr>
    <?php
    foreach ($ramos as $codigo) {
        echo "<tr><td>$codigo[0]</td></tr>";
    }
    ?>
</table>
