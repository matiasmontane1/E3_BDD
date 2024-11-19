<?php
require('../config/conexion.php');

try {
    // Iniciar transacción
    pg_query($db, "BEGIN");

    // Crear la función para calcular la calificación
    $crear_funcion = "
    CREATE OR REPLACE FUNCTION calcular_calificacion()
    RETURNS TRIGGER AS $$
    BEGIN
        -- Asignar calificación según las reglas de negocio
        NEW.calificacion = CASE
            WHEN NEW.nota_final >= 6.6 THEN 'SO' -- Sobresaliente
            WHEN NEW.nota_final >= 6.0 THEN 'MB' -- Muy Bueno
            WHEN NEW.nota_final >= 5.0 THEN 'B' -- Bueno
            WHEN NEW.nota_final >= 4.0 THEN 'SU' -- Suficiente
            WHEN NEW.nota_final >= 3.0 THEN 'I' -- Insuficiente
            WHEN NEW.nota_final >= 2.0 THEN 'M' -- Malo
            WHEN NEW.nota_final >= 1.0 THEN 'MM' -- Muy Malo
            WHEN NEW.nota_final IS NULL THEN 
                CASE
                    WHEN NEW.oportunidad_dic = 'P' OR NEW.oportunidad_mar = 'P' THEN 'P' -- Nota Pendiente
                    WHEN NEW.oportunidad_dic = 'NP' OR NEW.oportunidad_mar = 'NP' THEN 'NP' -- No Presenta
                    WHEN NEW.oportunidad_dic IS NULL AND NEW.oportunidad_mar IS NULL THEN 'nulo curso vigente'
                END
            ELSE 'Valor no válido'
        END;

        RETURN NEW;
    END;
    $$ LANGUAGE plpgsql;
    ";
    pg_query($db, $crear_funcion);

    // Crear el Trigger asociado a la tabla notas
    $crear_trigger = "
    CREATE TRIGGER trigger_calcular_calificacion
    BEFORE INSERT OR UPDATE ON acta
    FOR EACH ROW
    EXECUTE FUNCTION calcular_calificacion();
    ";
    pg_query($db, $crear_trigger);

    // Confirmar transacción
    pg_query($db, "COMMIT");
    echo "Trigger y función creados exitosamente.";
} catch (Exception $e) {
    pg_query($db, "ROLLBACK");
    echo "Error al crear el Trigger o la función: " . $e->getMessage();
}
?>
