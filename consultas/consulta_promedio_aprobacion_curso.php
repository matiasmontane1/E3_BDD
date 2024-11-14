<?php include('../templates/header.html'); ?>
<body>
    <?php
        require("../config/conexion.php");

        $codigoCurso = $_POST["Curso"];

        $pregunta1 = $db -> prepare("SELECT COUNT(*) AS aprobados FROM historial_academico WHERE sigla = :Curso AND Calificacion IN ('SO', 'MB', 'B', 'SU');");
        $pregunta1 -> bindParam(':Curso', $codigoCurso);
        $pregunta1 -> execute();
        $aprobados = $pregunta1 -> fetch(PDO::FETCH_ASSOC); 

        $pregunta2 = $db -> prepare("SELECT COUNT(*) AS totales FROM historial_academico WHERE sigla = :Curso;");
        $pregunta2 -> bindParam(':Curso', $codigoCurso);
        $pregunta2 -> execute();
        $totales = $pregunta2 -> fetch(PDO::FETCH_ASSOC); 
    ?>

    <table class="styled-table">
        <tr>
            <th>Promedio de Aprobación</th>
        </tr>
        <tr>
            <td><?php echo round(($aprobados['aprobados']/$totales['totales'])*100) . "%"; ?></td> 
        </tr>
    </table>
<body>
<?php include('../templates/footer.html'); ?>