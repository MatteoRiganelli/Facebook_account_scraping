<?php 
require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Visaulizza Report</title>
<link rel="stylesheet" href="css/style.css" /> 
</head>
<body>
<div class="form">
<p><b> Queste sono le operazioni eseguite:</b></p>


<table border="1" style="border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="" >
	<thead>
	<tr style="background-color:#4CAF50;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="">
      <th>ID</th>
      <th>Nome e Cognome</th>
	  <th>Data</th>
	  <th>Hash</th>
      <th>Download Link</th>
    </tr>

  <thead>
	<?php 
		$query = mysql_query("SELECT * FROM dump"); //dump nome cartella db
		while($cicle=mysql_fetch_array($query)){ 
			echo "<tr>";
				echo "<th>".$cicle['ReportID']."</th>";
				echo "<th>".$cicle['NomeCognome']."</th>"; 
				echo "<th>".$cicle['Data']."</th>"; 
				echo "<th>".$cicle['Hash']."</th>"; 
				echo "<th> <a href=".$cicle['Link']."> Clicca per scaricare</a></th>"; 
			echo "</tr>";
} 
?> 
</table>
<!-- <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="">
	
	<thead>
    <tr>
      <th>ID</th>
      <th>Nome e Cognome</th>
	  <th>Codice Utente</th>
	  <th>Data</th>
	  <th>Hash</th>
      <th>Download Linl</th>
    </tr>
  <thead>
	
	<tr> <!-- Qui in cascata tutte le entry ->
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
		<td> </td>
	</tr>
	
</table> -->

<p> <i> Torna alla <a href="index.php">home</a> oppure esegui il <a href="logout.php">logout</a> </i></p>
</div>
</body>
</html>
