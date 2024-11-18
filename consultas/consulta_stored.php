<?php include('../templates/header.html'); ?>
<body>
    <?php
        require("../temp_notas/transaccion.php");

        
        $query = "SELECT * FROM vista"; 
        $resultado = pg_query($db, $query);

        if (!$resultado) {
            echo "<p>Error al consultar la vista: " . pg_last_error($db) . "</p>";
            exit;
        }
    ?>

    <h2>Resultados de la Vista</h2>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Número Alumno</th>
                <th>Asignatura</th>
                <th>Periodo</th>
                <th>Nombre Profesor</th>
                <th>Nombre Alumno</th>
                <th>Nota Final</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (pg_num_rows($resultado) > 0) {
                    while ($fila = pg_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($fila['numero_alumno']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['asignatura']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['periodo']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nombre_profe']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nombre_alumno']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nota_final']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td>dNo se encontraron datos en la vista.</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <?php include('../templates/footer.html'); ?>
</body>