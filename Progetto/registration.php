<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Nuovo Utente</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	require('db.php');
    // Inserisce i valori nel db
    if (isset($_POST['username'])){
        $username = $_POST['username'];
		$email = $_POST['email'];
        $password = $_POST['password'];
		$username = stripslashes($username);
		$username = mysql_real_escape_string($username);
		$email = stripslashes($email);
		$email = mysql_real_escape_string($email);
		$password = stripslashes($password);
		$password = mysql_real_escape_string($password);
		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysql_query($query);
        if($result){
            echo "<div class='form'><h3>Ti sei registrato correttamente.</h3><br/>Clicca qui per il <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Nuovo utente</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input type="submit" name="submit" value="Conferma" />
</form>
</div>
<?php } ?>
</body>
<li><p> Torna alla <a href="index.php">home</a></p></li>
</html>
