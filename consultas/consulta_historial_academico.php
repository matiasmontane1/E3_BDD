<?php include('../templates/header.html');   ?>

<body>
    <?php
    require("../config/conexion.php");

    $numeroEstudiante = $_POST["numeroEstudiante"];


    $result = $db -> prepare("SELECT historial_academico.Periodo_nota, cursos.Sigla, cursos.NombreCurso, historial_academico.NotaFinal, historial_academico.Calificacion
        FROM historial_academico
        JOIN cursos ON historial_academico.Sigla = cursos.Sigla
        WHERE historial_academico.NumeroEstudiante = :numeroEstudiante
        ORDER BY historial_academico.Periodo_nota ASC;
        ");
    $result -> bindParam(':numeroEstudiante', $numeroEstudiante);
    $result -> execute();
    $historial = $result -> fetchAll();

    ?>

    <table class="styled-table">
        <tr>
            <th>Periodo</th>
            <th>Sigla Curso</th>
            <th>Nombre Curso</th>
            <th>Nota Final</th>
            <th>Calificación</th>
        </tr>
        <?php
        foreach ($historial as $nota) {
            echo "<tr><td>$nota[0]</td><td>$nota[1]</td><td>$nota[2]</td><td>$nota[3]</td><td>$nota[4]</td></tr>";
        }
        ?>
    </table>
<body>

<?php include('../templates/footer.html'); ?>