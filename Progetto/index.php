<?php include("auth.php"); //auth.php previene l'accesso non autorizzato ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Pannello Admin</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<div class="form">
<p> <i>Benvenuto  <b><u><?php echo $_SESSION['username']; ?></b></u>, sono le <?php echo date("H:i:s");?> del <?php echo date("d/m/Y");?> </i></p>
<br>
<p>Scegli l'operazione da effettaure tra le seguenti:</p>
<ul> <b>
	<li><a href="master/index.php">Effettua un nuovo report</a></li></br>
  <li><a href="dashboard.php">Visualizza Report Memorizzati</a></li></br>
  <li><a href="registration.php">Registra un nuovo utente</a></li></br>
  <li><a href="logout.php">Logout</a></li></br>
</ul> </b>

</div>
</body>
</html>
