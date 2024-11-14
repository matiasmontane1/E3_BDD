<?php include('../templates/header.html'); ?>

<body>
    <?php
        require("../config/conexion.php");

        $query = $db->prepare("SELECT 
            COUNT(CASE WHEN (2024 - CAST(SUBSTRING(cohorte FROM 1 FOR 4) AS INTEGER)) * 2 + (2 - CAST(SUBSTRING(cohorte FROM 6 FOR 2) AS INTEGER))|| '' = logro THEN 1 END) AS dentro,
            COUNT(CASE WHEN (2024 - CAST(SUBSTRING(cohorte FROM 1 FOR 4) AS INTEGER)) * 2 + (2 - CAST(SUBSTRING(cohorte FROM 6 FOR 2) AS INTEGER))|| '' != logro THEN 1 END) AS fuera
            FROM estudiantes
            WHERE estudiantes.estamento = 'ESTUDIANTE VIGENTE';");
        $query->execute();
        

        $resultado = $query -> fetch(PDO::FETCH_ASSOC); 
    ?>

    <table class="styled-table">
        <tr>
            <th>Dentro de Nivel</th>
            <th>Fuera de Nivel</th>
            <th>Vigentes Totales</th>
        </tr>
        <tr>
            <td><?php echo $resultado['dentro']; ?></td> 
            <td><?php echo $resultado['fuera']; ?></td> 
            <td><?php echo $resultado['fuera'] + $resultado['dentro']; ?></td>
        </tr>
    </table>
</body>

<?php include('../templates/footer.html'); ?>
