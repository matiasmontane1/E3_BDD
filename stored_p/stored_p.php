<?php
require('../config/conexion.php');

$crear_funcion = "
CREATE OR REPLACE FUNCTION crearVistaActa()
RETURNS VOID AS $$
BEGIN

    CREATE OR REPLACE VIEW vista AS
    SELECT 
        numero_alumno,
        asignatura,
        periodo,
        nombre_alumno,
        nombre_profe,
        nota_final
    FROM acta;
    
END;
$$ LANGUAGE plpgsql;
";

$result = pg_query($db, $crear_funcion);

if ($result) {
    echo "Stored Procedure creado";
} else {
    echo "Error al crear el Stored Procedure.";
}
?>