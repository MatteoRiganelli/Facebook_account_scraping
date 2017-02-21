<?php  include("../auth.php"); ?>
<html>
<link rel="stylesheet" href="../css/style.css" />
<!-- prendo in input l'user e la password dell'utente da esaminare ed eseguo lo script action.php-->

<p> <i>Benvenuto  <b><u><?php echo $_SESSION['username']; ?></b></u>, sono le <?php echo date("H:i:s");?> del <?php echo date("d/m/Y");?> </i></p>
<hr> <!-- linea separatoria-->

<p> <b><i>Inserisci le credenziali d'accesso: </i></b></p>

<form action="action.php" method="POST">
<div class="form_wrapper">
 	<label>Email/Telefono:</label> <input type="text" name="user" value="" placeholder="inserisci nome" /> </br>
 	<label>Password: </label><input type="password" name="pass" value ="" placeholder="inserisci password"  />
</div>

<hr> <!-- linea separatoria-->

<p> <b><i>Seleziona cosa vuoi memorizzare nel file zip:</i></b></p>

<ul class="lista">
	<li> <input type="checkbox" name="check_list[]" value="immagine_profilo"> Immagine Profilo</li>
	<li> <input type="checkbox" name="check_list[]" value="panoramica_utente"> Panoramica Utente</li>
	<li> <input type="checkbox" name="check_list[]" value="lavoro_e_istruzione"> Lavoro e Istruzione</li>
	<li> <input type="checkbox" name="check_list[]" value="luoghi"> Luoghi</li>
	<li> <input type="checkbox" name="check_list[]" value="informazioni_contatto"> Informazioni Contatto</li>
	<li> <input type="checkbox" name="check_list[]" value="familiari_relazioni"> Familiari e Relazioni</li>
	<li> <input type="checkbox" name="check_list[]" value="tue_informazioni"> Le tue informazioni</li>
	<li> <input type="checkbox" name="check_list[]" value="avvenimenti_importanti"> Avvenimenti Importanti</li>
	<li> <input type="checkbox" name="check_list[]" value="amici"> Amici</li>
	<li>  <input type="checkbox" name="check_list[]" value="foto"> Foto</li>
	<li>  <input type="checkbox" name="check_list[]" value="post_bacheca"> Post Bacheca</li>
	<li>  <input type="checkbox" name="check_list[]" value="post_personali"> Post Personali</li>
	<li> <input type="submit" /> </li>

</ul>
<!--
<table border="0">
	<tr border = "0">
		<td>Immagine Profilo </td> <td> <input type="checkbox" name="check_list[]" value="immagine_profilo"> </td> 
	</tr>
	<tr>
		<td>Panoramica Utente </td> <td> <input type="checkbox" name="check_list[]" value="panoramica_utente"> </td> 
	</tr>
	<tr>
		<td>Lavoro e Istruzione </td> <td> <input type="checkbox" name="check_list[]" value="lavoro_e_istruzione"> </td>
	</tr>
	<tr>
		<td>Luoghi </td> <td>  <input type="checkbox" name="check_list[]" value="luoghi"> </td> 
	</tr>
	<tr>
		<td>Informazioni Contatto  </td> <td>  <input type="checkbox" name="check_list[]" value="informazioni_contatto"> </td>
	</tr>
	<tr>
		<td>Familiari e Relazioni  </td> <td>  <input type="checkbox" name="check_list[]" value="familiari_relazioni"> </td> 
	</tr>
	<tr>
		<td>Le tue informazioni  </td> <td>  <input type="checkbox" name="check_list[]" value="tue_informazioni"> </td>
	</tr>
	<tr>
		<td>Avvenimenti Importanti  </td> <td>  <input type="checkbox" name="check_list[]" value="avvenimenti_importanti"> </td>
	</tr>
	<tr>
		<td>Amici  </td> <td>  <input type="checkbox" name="check_list[]" value="amici"> </td>
	</tr>
	<tr>
		<td>Foto  </td> <td>  <input type="checkbox" name="check_list[]" value="foto"> </td>
	</tr>
	<tr>
		<td> <input type="submit" /> </td>
	</tr>

</table>
-->
<hr>
<p> <i> Torna alla <a href="../index.php">home</a> </i></p>

</form>

</html>