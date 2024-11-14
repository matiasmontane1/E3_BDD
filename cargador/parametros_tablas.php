<?php

$path_tablas = array(
    'Personas' => '../datos_aceptados/Personas_gud.csv',
    'Estudiantes' => '../datos_aceptados/Estudiantes_gud.csv',
    'Administrativos' => '../datos_aceptados/Administrativos_gud.csv',
    'Departamentos' => '../datos_aceptados/Departamentos_gud.csv',
    'Facultades' => '../datos_aceptados/Facultades_gud.csv',
    'Depa_facu' => '../datos_aceptados/Departamentos_facu_gud.csv',
    'Carreras' => '../datos_aceptados/Carreras_gud.csv',
    'Planes' => '../datos_aceptados/Planes_gud.csv',
    'Planes_facu' => '../datos_aceptados/Planes_facu_gud.csv',
    'Planes_carreras' => '../datos_aceptados/Planes_carreras_gud.csv',
    'Estudiantes_carrera_plan' => '../datos_aceptados/Estudiantes_carrera_plan_gud.csv',
    'Cursos' => '../datos_aceptados/Cursos_gud.csv',
    "Cursos_depa_facu" => '../datos_aceptados/Cursos_depa_facu_gud.csv',
    "Cursos_plan" => '../datos_aceptados/Cursos_plan_gud.csv',
    'Prerequisitos' => '../datos_aceptados/Prerequisitos_gud.csv',
    'Historial_Academico' => '../datos_aceptados/Historial_academico_gud.csv',
    'Oferta_academica' => '../datos_aceptados/Oferta_academica_gud.csv',
    'Oferta_academica_SINA' => '../datos_aceptados/Oferta_academica_SINA_gud.csv',
    'usuario' => '../datos_aceptados/usuarios.csv' 
);

$tablas_iniciales = array(
    'Facultades' => 'NombreFacultad VARCHAR(255) PRIMARY KEY',
    'Carreras' => 'NombreCarrera VARCHAR(255) PRIMARY KEY',
    'Planes' => 'CodigoPlan VARCHAR(10) PRIMARY KEY, NombrePlan VARCHAR(255), InicioVigencia VARCHAR(50), Jornada VARCHAR(50), Modalidad VARCHAR(50), Sede VARCHAR(100), Grado VARCHAR(50)',
    'Planes_facu' => 'ConexionID INT PRIMARY KEY, CodigoPlan VARCHAR(10) REFERENCES planes(codigoplan), NombreFacultad VARCHAR(225) REFERENCES Facultades(NombreFacultad)',
    'Planes_carreras' => 'ConexionID INT PRIMARY KEY, CodigoPlan VARCHAR(10) REFERENCES Planes(CodigoPlan), NombreCarrera VARCHAR(255) REFERENCES Carreras(NombreCarrera)',
    'Departamentos' => 'CodigoDepartamento INT PRIMARY KEY, NombreDepartamento VARCHAR(255)',
    'Depa_facu' => 'ConexionID INT PRIMARY KEY, NombreFacultad VARCHAR(255) REFERENCES Facultades(NombreFacultad), CodigoDepartamento INT REFERENCES Departamentos(CodigoDepartamento)',
    'Personas' => 'RUN INT PRIMARY KEY, DV VARCHAR(10), Nombres VARCHAR(255), ApellidoPaterno VARCHAR(255), ApellidoMaterno VARCHAR(255), MailInstitucional VARCHAR(255), MailPersonal VARCHAR(255), Telefono INT',
    'Estudiantes' => 'NumeroEstudiante INT PRIMARY KEY, RUN INT REFERENCES Personas(RUN), Cohorte CHAR(7), Bloqueo VARCHAR(50), Causal_Bloqueo VARCHAR(255), Ultima_carga CHAR(7), Fecha_logro CHAR(7), Logro VARCHAR(255), Estamento VARCHAR(45)',
    'Estudiantes_carrera_plan' => 'ConexionID INT PRIMARY KEY, NumeroEstudiante INT REFERENCES Estudiantes(NumeroEstudiante), NombreCarrera VARCHAR(255) REFERENCES Carreras(NombreCarrera), CodigoPlan VARCHAR(10) REFERENCES planes(codigoplan)',
    
    'Administrativos' => 'RUN INT PRIMARY KEY REFERENCES Personas(RUN), GradoAcademico VARCHAR(255), Cargo VARCHAR(50), JerarquiaAcademica VARCHAR(50), Contrato VARCHAR(50), Dedicacion INT',
    'Cursos' => 'Sigla VARCHAR(255) PRIMARY KEY, NombreCurso VARCHAR(255), Nivel INT',
    'Cursos_plan' => 'ConexionID INT PRIMARY KEY, CodigoPlan VARCHAR(10) REFERENCES Planes(CodigoPlan), Sigla VARCHAR(255) REFERENCES Cursos(Sigla)',
    'Cursos_depa_facu' => 'ConexionID INT PRIMARY KEY, Sigla VARCHAR(255) REFERENCES Cursos(Sigla), CodigoDepartamento INT REFERENCES Departamentos(CodigoDepartamento), NombreFacultad VARCHAR(255) REFERENCES Facultades(NombreFacultad)',
    'Historial_academico' => 'NotaID INT PRIMARY KEY, NumeroEstudiante INT REFERENCES Estudiantes(NumeroEstudiante), Sigla VARCHAR(255) REFERENCES Cursos(Sigla), Periodo_nota VARCHAR(12), NotaFinal FLOAT, Calificacion VARCHAR(50), Convocatoria VARCHAR(50)',
    'Oferta_academica' => 'OfertaID INT PRIMARY KEY, Periodo VARCHAR(12), Sede VARCHAR(100), Sigla VARCHAR(255) REFERENCES Cursos(Sigla), Seccion INT, Duracion VARCHAR(50), Jornada VARCHAR(30), Cupos INT, Inscritos INT, Hora_de_inicio VARCHAR(50), Hora_de_fin VARCHAR(50), Dia VARCHAR(50), Fecha_Inicio DATE, Fecha_Fin DATE, Lugar VARCHAR(255), Edificio VARCHAR(255),ProfeUnico CHAR(1), RUN INT REFERENCES Personas(RUN), ProfeDesignado Varchar(4)',
    'Oferta_academica_SINA' => 'OfertaID INT PRIMARY KEY, Periodo VARCHAR(12), Sede VARCHAR(100), Sigla VARCHAR(255) REFERENCES Cursos(Sigla), Seccion INT, Duracion VARCHAR(50), Jornada VARCHAR(30), Cupos INT, Inscritos INT, Hora_de_inicio VARCHAR(50), Hora_de_fin VARCHAR(50), Dia VARCHAR(50), Fecha_Inicio DATE, Fecha_Fin DATE, Lugar VARCHAR(255), Edificio VARCHAR(255),ProfeUnico CHAR(1), CodigoDepartamento INT REFERENCES Departamentos(CodigoDepartamento), ProfeDesignado Varchar(4)',
    'Prerequisitos' => 'PrerequisitosID INT PRIMARY KEY, Sigla VARCHAR(255) REFERENCES Cursos(Sigla), Requisito1 VARCHAR(255), Requisito2 VARCHAR(255)',
    'usuario' => 'ID VARCHAR(250) PRIMARY KEY, Clave CHAR(8), Rol VARCHAR(10)'
);

?>