<?php

$path_tablas = array(
    'Oferta_academica' => '../datos_aceptados/Oferta_academica_gud.csv',
    'Oferta_academica_SINA' => '../datos_aceptados/Oferta_academica_SINA_gud.csv',
);

$tablas_iniciales = array(
    'Oferta_academica' => 'OfertaID INT PRIMARY KEY, Periodo VARCHAR(12), Sede VARCHAR(100), Sigla VARCHAR(255) REFERENCES Cursos(Sigla), Seccion INT, Duracion VARCHAR(50), Jornada VARCHAR(30), Cupos INT, Inscritos INT, Hora_de_inicio VARCHAR(50), Hora_de_fin VARCHAR(50), Dia VARCHAR(50), Fecha_Inicio DATE, Fecha_Fin DATE, Lugar VARCHAR(255), Edificio VARCHAR(255),ProfeUnico CHAR(1), RUN INT REFERENCES Personas(RUN), ProfeDesignado Varchar(4)',
    'Oferta_academica_SINA' => 'OfertaID INT PRIMARY KEY, Periodo VARCHAR(12), Sede VARCHAR(100), Sigla VARCHAR(255) REFERENCES Cursos(Sigla), Seccion INT, Duracion VARCHAR(50), Jornada VARCHAR(30), Cupos INT, Inscritos INT, Hora_de_inicio VARCHAR(50), Hora_de_fin VARCHAR(50), Dia VARCHAR(50), Fecha_Inicio DATE, Fecha_Fin DATE, Lugar VARCHAR(255), Edificio VARCHAR(255),ProfeUnico CHAR(1), CodigoDepartamento INT REFERENCES Departamentos(CodigoDepartamento), ProfeDesignado Varchar(4)',
);

?>