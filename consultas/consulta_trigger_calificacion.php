<?php
require_once('../config/conexion.php');

try {
    $calc_calificacion = "
        CREATE FUNCTION calcular_calificacion()
        RETURNS TRIGGER AS $$
        BEGIN
            IF NEW.nota >= 6.6 THEN
                NEW.calificacion := 'SO';
            ELSIF NEW.nota >= 6.0 THEN
                NEW.calificacion := 'MB';
            ELSIF NEW.nota >= 5.0 THEN
                NEW.calificacion := 'B';
            ELSIF NEW.nota >= 4.0 THEN
                NEW.calificacion := 'SU';
            ELSIF NEW.nota >= 3.0 THEN
                NEW.calificacion := 'I';
            ELSIF NEW.nota >= 2.0 THEN
                NEW.calificacion := 'M';
            ELSE
                NEW.calificacion := 'MM';
            END IF;
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;
    ";

    $trigger = "
        CREATE TRIGGER trigger_calcular_calificacion
        BEFORE INSERT OR UPDATE ON historial_academico
        FOR EACH ROW
        EXECUTE FUNCTION calcular_calificacion();
    ";

    $db->exec($calc_calificacion);
    $db->exec($trigger);

    echo "Función y trigger creados exitosamente.";

} catch (Exception $e) {
    echo "Error al crear la función o el trigger: " . $e->getMessage();
}

require_once('../config/conexion.php');
