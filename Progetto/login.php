<?php
ob_start(); //Server per il redirect.
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Facebook Data Dump</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
ini_set('display_errors','On');
error_reporting(E_ALL ^ E_DEPRECATED);
require('db.php');
    if (isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
		$username = stripslashes($username);
		$username = mysql_real_escape_string($username);
		$password = stripslashes($password);
		$password = mysql_real_escape_string($password);
	//Verifica se l'utente esiste
        $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
		$result = mysql_query($query) or die(mysql_error());
		$rows = mysql_num_rows($result); 
        if($rows==1){
			$_SESSION['username'] = $username;
			header ("Location: index.php"); // Redirect a index.php
			exit;
            }else{
				echo "<div class='form'><h3>Username/password non corretti.</h3><br/>Clicca per riprovare il <a href='login.php'>Login</a></div>"; //Redirect a login
				}
    }else{
?>
<div class="form">
<h1>Facebook Data Dump, Accedi per iniziare</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />
</form>
<p><b><i>Non sei ancora registrato? <a href="mailto:admin@admin.it">Contatta </a> l'amministratore inserendo Username, Email e Password.</i></b></p>
<!-- <p>Non sei ancora registrato? <a href='registration.php'>Clicca qui!</a></p> -->
</div>
<?php } ?>
</body>
</html>
