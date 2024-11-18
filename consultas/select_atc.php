<?php include('../templates/header.html'); ?>

<body>
    <?php
    require("../config/conexion.php");

    // Obtener tablas y columnas válidas desde el esquema de la base de datos
    function obtenerEsquema($db) {
        $esquema = [];
        try {
            $result = $db->query("SELECT TABLE_NAME, COLUMN_NAME 
                                  FROM INFORMATION_SCHEMA.COLUMNS 
                                  WHERE TABLE_SCHEMA = DATABASE()");
            foreach ($result as $row) {
                $tabla = $row['TABLE_NAME'];
                $columna = $row['COLUMN_NAME'];
                $esquema[$tabla][] = $columna;
            }
        } catch (PDOException $e) {
            die("Error al obtener el esquema: " . $e->getMessage());
        }
        return $esquema;
    }

    // Validar tabla y columnas contra el esquema
    function validarTablaYColumnas($tabla, $atributos, $esquema) {
        if (!isset($esquema[$tabla])) {
            return false;
        }
        $atributosArray = explode(',', $atributos);
        foreach ($atributosArray as $atributo) {
            if (!in_array(trim($atributo), $esquema[$tabla])) {
                return false;
            }
        }
        return true;
    }

    $atributos = $_POST["A"] ?? '';
    $tabla = $_POST["T"] ?? '';
    $condicion = $_POST["C"] ?? '';
    $error = null;
    $datos = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $esquema = obtenerEsquema($db);

        // Validar entrada
        if (empty($atributos) || empty($tabla) || empty($condicion)) {
            $error = "Todos los campos son obligatorios.";
        } elseif (!validarTablaYColumnas($tabla, $atributos, $esquema)) {
            $error = "Tabla o columnas no válidas. Verifica los nombres ingresados.";
        } else {
            try {
                // Construir y ejecutar la consulta
                $consulta = "SELECT $atributos FROM $tabla WHERE $condicion";
                $result = $db->prepare($consulta);
                $result->execute();
                $datos = $result->fetchAll();
            } catch (PDOException $e) {
                $error = "Error al ejecutar la consulta: " . htmlspecialchars($e->getMessage());
            }
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
