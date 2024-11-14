<?php 
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php"); 
    exit(); 
}

include('templates/header.html'); 
?>

<body>
  <div class="user">
  <h1 class="title">Bananer</h1>
  <p class="description">Aquí podrás encontrar información sobre la universidad.</p>


 <h2 class="subtitle">Consulta porcentaje de aprobacion todos los cursos realizados en un periodo especifico.</h2>
  <p class="prompt">Ingresa un periodo con el formato AÑO-SEMESTRE un ejemplo seria "2023-02".</p>
  <form class="form" action="consultas/consulta_aprobacion_curso_periodo.php" method="post">
    <input class = "form-input" type = "text" required placeholder = "Ingrese periodo (AÑO-SEMESTRE)" name = "periodo"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <h2 class="subtitle">Consulta propuesta de toma de ramos 2025-1.</h2>
  <p class="prompt">Ingresa el numero de estudiante para revisar tus ramos para el proximo semestre.</p>
  <form class="form" action="consultas/consulta_propuesta_ramos.php" method="post">
    <input class = "form-input" type = "text" required placeholder = "ingrese numero de estudiante" name = "numeroEstudiante"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <h2 class="subtitle">consulta cantidad de estudiantes vigentes</h2>
  <form class="form" action="consultas/consulta_estudiantes_nivel.php" method="post">
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>
 <h1 class="subtitle">Consulta aprobacion curso periodo</h1>
  <p class="prompt">Ingresa el largo del top de canciones:</p>

  <form class="form" action="consultas/consulta_aprobacion_curso_periodo.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingresa el periodo" name="periodo" title="Debe ser en formato AÑO-SEMESTRE"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>

 


  <h2 class="subtitle">Consulta promedio de porcentaje de aprobacion historico agrupado por profesor.</h2>
  <p class="prompt">Ingresa la sigla de un curso pra revisar el porcentaje de aprobacion historico.</p>
    <form class="form" action="consultas/consulta_promedio_aprobacion_curso.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingrese sigla de curso" name="Curso"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>


  

  <h2 class="subtitle">Consulta Historial Academico.</h2>
  <p class="prompt">Ingresa tu numero de estudiante apara ver tu ficha academica acumulada( la puedes ver mas de una vez no te vamos a cobrar por el documento :).</p>
  <form class="form" action="consultas/consulta_historial_academico.php" method="post">
    <input class="form-input" type="text" required placeholder="numero de estudiante" name="numeroEstudiante"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>


 
  <form method="POST" action="consultas/logout.php">
    <button type="submit" class="form-button">Volver a Iniciar Sesión</button>
  </form>
  </div>
</body>
</html>