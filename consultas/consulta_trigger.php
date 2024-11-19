<?php
require('../config/conexion.php');

try {
    // Crear función y trigger en historial_academico
    $calc_cali_hist = "
    CREATE OR REPLACE FUNCTION calcular_calificacion_historial()
    RETURNS TRIGGER AS $$
    BEGIN
        -- Determinar la calificación
        IF NEW.nota_final >= 6.6 THEN
            NEW.calificacion := 'SO';
        ELSIF NEW.nota_final >= 6.0 THEN
            NEW.calificacion := 'MB';
        ELSIF NEW.nota_final >= 5.0 THEN
            NEW.calificacion := 'B';
        ELSIF NEW.nota_final >= 4.0 THEN
            NEW.calificacion := 'SU';
        ELSIF NEW.nota_final >= 3.0 THEN
            NEW.calificacion := 'I';
        ELSIF NEW.nota_final >= 2.0 THEN
            NEW.calificacion := 'M';
        ELSE
            NEW.calificacion := 'MM';
        END IF;

        IF NEW.nota_final IS == NEW.oportunidad_dic THEN
            NEW.convocatoria = 'DIC'
        ELSIF NEW.nota_final IS == NEW.oportunidad_mar THEN
            NEW.convocatoria = 'MAR'
        END IF;

        RETURN NEW;
    END;
    $$ LANGUAGE plpgsql;
    ";

    $trigger = "
    CREATE TRIGGER trigger_calcular_calificacion_historial
    BEFORE INSERT OR UPDATE ON vista
    FOR EACH ROW
    EXECUTE FUNCTION calcular_calificacion_historial();
    ";

    pg_query($db, $calc_cali_hist);
    pg_query($db, $trigger);

    echo "Función y trigger creados exitosamente.";
} catch (Exception $e) {
    echo "Error al crear la función o el trigger: " . $e->getMessage();
}
?>
