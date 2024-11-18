<?php 
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php"); 
    exit(); 
}

include('templates/header.html'); 
?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles/mystyles.css">
</head>

<body>
  <div class="user">
  <h1 class="title">Bananer</h1>
  <p class="description">Aquí podrás encontrar información sobre la universidad.</p>

  <h2 class="subtitle">consulta cantidad de estudiantes vigentes</h2>
  <form class="form" action="consultas/consulta_estudiantes_nivel.php" method="post">
    <input class="form-button" type="submit" value="Buscar">
  </form>

  <h2 class="subtitle">Consulta aprobacion curso periodo</h2>
  <p class="prompt">Ingresa el largo del top de canciones:</p>
  <form class="form" action="consultas/consulta_aprobacion_curso_periodo.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingresa el periodo" name="periodo" title="Debe ser en formato AÑO-SEMESTRE"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>

  <h2 class="subtitle">Consulta promedio de porcentaje de aprobacion historico agrupado por profesor.</h2>
  <p class="prompt">Ingresa la sigla de un curso pra revisar el porcentaje de aprobacion historico.</p>
  <form class="form" action="consultas/consulta_promedio_aprobacion_curso.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingrese sigla de curso" name="Curso"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>

  <h2 class="subtitle">Cargar tabla temporal acta.</h2>
  <form class="form" action="temp_notas/transaccion.php" method="post"> 
    <input class="form-button" type="submit" value="Cargar">
  </form>

  <form method="POST" action="consultas/logout.php">
    <button type="submit" class="form-button">Volver a Iniciar Sesión</button>
  </form>
  </div>
</body>
</html>