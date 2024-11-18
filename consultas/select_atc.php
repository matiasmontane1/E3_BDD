<?php include('../templates/header.html'); ?>

<body>
    <?php
    require("../config/conexion.php");

    function obtenerTiposColumnas($db, $tabla) {
        $tipos = [];
        try {
            $query = "SELECT column_name, data_type 
                      FROM information_schema.columns 
                      WHERE table_name = $1";
            $result = pg_query_params($db, $query, [$tabla]);

            if (!$result) {
                throw new Exception("Error al obtener los tipos de las columnas: " . pg_last_error($db));
            }

            while ($row = pg_fetch_assoc($result)) {
                $tipos[$row['column_name']] = $row['data_type'];
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $tipos;
    }

    function ajustarCondicionConCast($condicion, $tipos) {
        foreach ($tipos as $columna => $tipo) {
            if (strpos($condicion, $columna) !== false) {
                if ($tipo === 'character varying' && preg_match('/\b' . $columna . '\s*[<>=!]+\s*\d+/', $condicion)) {
                    $condicion = preg_replace('/\b' . $columna . '\b/', "$columna ~ '^\d+$' AND CAST($columna AS INTEGER)", $condicion);
                }
            }
        }
        return $condicion;
    }

    $atributos = $_POST["A"] ?? '';
    $tabla = $_POST["T"] ?? '';
    $condicion = $_POST["C"] ?? '';
    $error = null;
    $datos = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $tiposColumnas = obtenerTiposColumnas($db, $tabla);
            $condicionAjustada = ajustarCondicionConCast($condicion, $tiposColumnas);

            $consulta = "SELECT $atributos FROM $tabla WHERE $condicionAjustada";
            $result = pg_query($db, $consulta);

            if (!$result) {
                throw new Exception("Error al ejecutar la consulta: " . pg_last_error($db));
            }

            $datos = pg_fetch_all($result);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
    ?>

    <h2 class="subtitle">Resultados de la Consulta Personalizada</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php elseif ($datos): ?>
        <table class="styled-table">
            <tr>
                <?php foreach (array_keys($datos[0]) as $columna): ?>
                    <th><?php echo htmlspecialchars($columna); ?></th>
                <?php endforeach; ?>
            </tr>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <?php foreach ($fila as $valor): ?>
                        <td><?php echo htmlspecialchars($valor); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No se encontraron resultados o la consulta es inválida.</p>
    <?php endif; ?>
</body>

<?php include('../templates/footer.html'); ?>
