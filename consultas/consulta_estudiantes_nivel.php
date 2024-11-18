<?php include('../templates/header.html'); ?>

<body>
    <?php
        require("../config/conexion.php");

        // Consulta SQL para PostgreSQL
        $query = "SELECT 
            COUNT(CASE WHEN (2024 - CAST(SUBSTRING(cohorte FROM 1 FOR 4) AS INTEGER)) * 2 + (2 - CAST(SUBSTRING(cohorte FROM 6 FOR 2) AS INTEGER))|| '' = logro THEN 1 END) AS dentro,
            COUNT(CASE WHEN (2024 - CAST(SUBSTRING(cohorte FROM 1 FOR 4) AS INTEGER)) * 2 + (2 - CAST(SUBSTRING(cohorte FROM 6 FOR 2) AS INTEGER))|| '' != logro THEN 1 END) AS fuera
            FROM estudiantes
            WHERE estudiantes.estamento = 'ESTUDIANTE VIGENTE';";

        // Ejecutar la consulta usando pg_query
        $result = pg_query($db, $query);

        if (!$result) {
            echo "Ocurrió un error con la consulta.\n";
            exit;
        }

        // Obtener el resultado como un arreglo asociativo
        $resultado = pg_fetch_assoc($result);
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
