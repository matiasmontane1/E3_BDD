<?php

function eliminar_repetidos($array_repetidos) {
    $array_limpio = [];
    foreach ($array_repetidos as $linea) {
        if (!in_array($linea, $array_limpio)) {
            $array_limpio[] = $linea;
        }
    }
    return $array_limpio;
}

function limpiar_run($run) {
    $run = trim($run);
    $run = preg_replace('/\s+/', '', $run);
    if (strlen($run) <= 8 && ctype_digit($run)) {
        return $run;
    }
    return null;
}

function limpiar_dv($dv) {
    $dv = trim($dv);
    if (strlen($dv) == 1 && (ctype_digit($dv) || $dv == 'k' || $dv == 'K')) {
        return $dv;
    }
    return null;
}

function limpiar_telefono($telefono) {
    $telefono = trim($telefono);
    $telefono = preg_replace('/\s+/', '', $telefono);
    if (strlen($telefono) == 9 && ctype_digit($telefono)) {
        return $telefono;
    }
    return null;
}

function limpiar_email($email) {
    $email = trim($email);
    $email = preg_replace('/\s+/', '', $email);
    if (!preg_match('/[^a-zA-Z0-9@._-]/', $email)) {
        return $email;
    }
    return null;
}

function run_unico($array_repetidos) {
    $array_limpio = [];
    $primeras_columnas = [];

    foreach ($array_repetidos as $linea) {
        $primera_columna = $linea[0];
        if (!in_array($primera_columna, $primeras_columnas)) {
            $array_limpio[] = $linea;
            $primeras_columnas[] = $primera_columna;
        }
    }

    return $array_limpio;
}

function v_logro($logro) {
    $cadena_minuscula = strtolower($logro);
    $cadena_sin_espacios = trim($cadena_minuscula);
    $cadena_sin_espacios_dobles = preg_replace('/\s+/', ' ', $cadena_sin_espacios);
    if ((is_numeric($cadena_sin_espacios_dobles) && $cadena_sin_espacios_dobles >= 1 && $cadena_sin_espacios_dobles <= 10) || ($cadena_sin_espacios_dobles === 'ingreso' || $cadena_sin_espacios_dobles === 'licenciado')) {
        return ucfirst($cadena_sin_espacios_dobles);
    }
    return null;
}

function no_nulo($string) {
    $string_sin_espacios = trim($string);

    if (empty($string_sin_espacios)) {
        return "-";
    } else {
        return $string_sin_espacios;
    }
}

function v_numero($nro) {
    $numero = intval($nro);
    if ($numero == $nro) {
        return trim($nro);
    } else {
        return null;
    }
}

function v_jornada($diu, $ves) {
    $diu = trim($diu);
    $ves = trim($ves);

    if (($diu === "" && $ves !== "") || ($diu !== "" && $ves === "")) {
        return ucfirst($diu . $ves);
    } else {
        return null;
    }
}

function no_vacio($string) {
    if (!empty($string)) {
        return trim($string);
    }
    return null;
}

function v_nota($nota) {
    $nota = trim($nota);

    if (empty($nota) || (is_numeric($nota) && floatval($nota) >= 1.0 && floatval($nota) <= 7.0)) {
        return $nota;
    } else {
        return null;
    }
}

function max_seccion($lista) {
    $siglas = [];
    $nuevo = [];

    foreach ($lista as $curso) {
        $sigla = $curso[0];
        $seccion = intval($curso[2]);

        if (!in_array($sigla, $siglas)) {
            $siglas[] = $sigla;
            $nuevo[] = $curso;
        } else {
            $indice = array_search($sigla, $siglas);
            if (intval($nuevo[$indice][2]) < $seccion) {
                $nuevo[$indice][2] = $seccion;
            }
        }
    }

    return $nuevo;
}

function validarEmail($email) {
    if (strlen($email) > 256) {
        return false;
    }
    $parts = explode('@', $email);
    if (count($parts) != 2) {
        return false;
    }
    list($localPart, $domain) = $parts;
    if (strlen($localPart) > 64) {
        return false;
    }
    $localRegex = '/^[A-Za-z0-9!#$%&\'*+\/=?^_`{|}~.-]+$/';
    if (!preg_match($localRegex, $localPart)) {
        return false;
    }
    
    return true;
}