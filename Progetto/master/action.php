<?php  include("../auth.php"); ?>
<html>
<link rel="stylesheet" href="../css/style.css" />
<!-- action.php stampa lo user e la password da esaminare e password-->
<?php
require ('../db.php');
//echo"Prendo i dati di ".  $_POST['user'] . "</br>";
//echo "avente password ". $_POST['pass'];

$user = $_POST['user'];
$pass = $_POST['pass'];

echo "</br>";
// test.php esegue un controllo sui checkbox selezionati ed eseguirà i vari script
// ogni script php avrà il codice per eseguire ognuno un casperjs
// ed infine verrà creato il file zip con tutti i dati
//$user = 'matteoriganelli@gmail.com';
//$pass = 'dududu';


if(!empty($_POST['check_list'])) {

	if(isset($_POST['user'])) $username=$_POST['user'];
	echo"Prendo i dati dell'account ".  $_POST['user'] . "</br>";
	if(isset($_POST['pass'])) $password=$_POST['pass'];
	echo "avente password ". $_POST['pass'];

	putenv("PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs");
    echo "Running PhantomJS version: ";
    echo exec('/usr/local/bin/phantomjs --version 2>&1');
    echo "<br />";
    echo "Running CasperJS version: ";
    echo exec('/usr/local/bin/casperjs --version 2>&1');
    echo "<br />";
    echo "Running Command: ";
    echo "...";
    echo "<br />";
    
    //genera 2 file loggato.png e name.txt, avente il nome dell'utente facebook
    $ex = '/usr/local/bin/casperjs verifica_profilo.js '.$username.' '.$password;
	echo exec($ex);
    if(file_exists("name.txt")){

    	$stack = array("loggato.png", "name.txt");
		

	    foreach($_POST['check_list'] as $check) {
	    		if($check=="immagine_profilo")	 
	            {          	
	            	$esegui = '/usr/local/bin/casperjs immagine_profilo.js '.$username.' '.$password;
				    echo exec($esegui);
				    //echo exec('/usr/local/bin/casperjs scrape_post_info.js');
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>immagine_profilo</b>";
				    echo "<br />";
				    array_push($stack, "immagine_profilo.png");
			    }
	            if($check=="panoramica_utente")	 
	            {          	
	            	$esegui = '/usr/local/bin/casperjs panoramica_utente.js '.$username.' '.$password;
				    echo exec($esegui);
				    //echo exec('/usr/local/bin/casperjs scrape_post_info.js');
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>panoramica_utente</b>";
				    echo "<br />";
				    array_push($stack, "panoramica_utente.png");
			    }
	            if($check=="lavoro_e_istruzione")
	        	{ 	   		
	        		$esegui = '/usr/local/bin/casperjs lavoro_e_istruzione.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>lavoro_e_istruzione</b>";
				    echo "<br />";
				    array_push($stack, "lavoro_e_istruzione.png");
	            }
	            if($check=="luoghi")
	            {
	            	$esegui = '/usr/local/bin/casperjs luoghi.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>luoghi</b>";
				    echo "<br />";
				    array_push($stack, "luoghi.png");
				}
	            if($check=="informazioni_contatto")
	            {
	            	$esegui = '/usr/local/bin/casperjs informazioni_contatto.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>informazioni contatto</b>";
				    echo "<br />";
				    array_push($stack, "informazioni_contatto.png");
				}
	            if($check=="familiari_relazioni")
	            {
	            	$esegui = '/usr/local/bin/casperjs familiari_relazioni.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>familiari_relazioni</b>";
				    echo "<br />";
				    array_push($stack, "familiari_relazioni.png");
				}
	            if($check=="tue_informazioni")
	            {
	            	$esegui = '/usr/local/bin/casperjs tue_informazioni.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>tue_informazioni</b>";
				    echo "<br />";
				    array_push($stack, "tue_informazioni.png");
				}
	            if($check=="avvenimenti_importanti")
	            {
	            	$esegui = '/usr/local/bin/casperjs avvenimenti_importanti.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>avvenimenti_importanti</b>";
				    echo "<br />";
				    array_push($stack, "avvenimenti_importanti.png");
				}
				if($check=="amici")
	            {
	            	$esegui = '/usr/local/bin/casperjs amici.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>amici</b>";
				    echo "<br />";
				    array_push($stack, "amici.png", "amici.txt");
				}
				if($check=="foto")
	            {
	            	$esegui = '/usr/local/bin/casperjs foto.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>foto</b>";
				    echo "<br />";
				    array_push($stack, "foto.png");
				}
				if($check=="post_bacheca")
	            {
	            	$esegui = '/usr/local/bin/casperjs post_bacheca.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>post_bacheca</b>";
				    echo "<br />";
				    array_push($stack, "post_bacheca.png");
				}
				if($check=="post_personali")
	            {
	            	$esegui = '/usr/local/bin/casperjs post_personali.js '.$username.' '.$password;
				    echo exec($esegui);
				    echo "...";
				    echo "<br />";
				    echo "ESEGUITO <b>post_personali</b>";
				    echo "<br />";
				    array_push($stack, "post_personali.png");
				}
	    }
	    //echo "TIME:". time(); // es: 1466437139  -- probabile id unico ok ? 
	    					  // Returns the current time measured in the number of seconds since the Unix Epoch
 		echo "<br />";


 		//leggo il nome dell'utente dal file name.txt creato con verifica_profilo.js
 		$nome_utente = file_get_contents('name.txt');
 		echo "NOME_UTENTE: " . $nome_utente;

 		echo "<br />";
 		$today = getdate(); 
 		$month_num = $today['mon']; //numerico
		$month = $today['month']; //testuale
		$day = $today['mday']; 
		$year = $today['year']; 
		$hours = $today['hours'];
		$minutes = $today['minutes'];
		$seconds = $today['seconds'];
		echo "DATE: $month $day, $year - $hours : $minutes, $seconds";
		echo "<br />";
		$dataDB = strval($day.'/'.$month_num.'/'.$year . ' - ' .$hours . ':' . $minutes . ':' . $seconds ); // per inserimento DB

		$nome_zip = "report_" . $nome_utente . "_" . $day . $month_num . $year . "_" . $hours . $minutes . $seconds ;
		$nome_zip = str_replace(" ", "_", $nome_zip);
		$nome_zip = $nome_zip . ".zip";
		echo "NOME_ZIP: " . $nome_zip;
		echo "<br />";

		//CREAZIONE ZIP
		//if true, good; if false, zip creation failed
 		require_once 'create_zip.php';

		$result = create_zip($stack, $nome_zip);
		echo 'CREATO_ZIP';
		echo "<br />";


		$hash_file = "";
		if (file_exists($nome_zip)) 
			$hash_file = hash_file('md5', $nome_zip);
		echo "HASH_FILE: " . $hash_file;
		echo "<br />";

	    //DELETE FILE
	    //quelli .png
	    $mask = "*.png";
   		array_map( "unlink", glob( $mask ) );

   		//cancella lista amici.txt
		if(is_file("amici.txt")) 
			unlink("amici.txt");
		
		//cancella file name.txt
		if(is_file("name.txt")) 
			unlink("name.txt");
		
		echo "</br></br>";
		echo "<b>";

		$link = "http://localhost:8888/Progetto/master/$nome_zip";
		echo "<a href='$link'>SCARICA REPORT</a>";
		echo "</b>";

		$query = "INSERT INTO `dump`(`NomeCognome`, `Data`, `Hash`, `Link`) VALUES ('$nome_utente','$dataDB','$hash_file','$link')";
		$result = mysql_query($query) or die(mysql_error());

		
	}
	else
	{	
		if(is_file("loggato.png")) 
			unlink("loggato.png");
		echo " : PROFILO ERROR!". "</br>";
		echo " : Dati inseriti non corretti!". "</br>";
	}
}
else{
	echo "</br>";
	echo "NON HAI SELEZIONATO NIENTE DA SCARICARE";
}

?>


<p> <i> Torna alla <a href="../index.php"><b><i>home</i></b></a>, accedi alla <a href="../dashboard.php"><b><i> lista dei report</i></b> </a> o esegui una <a href="index.php"><b><i>nuova analisi</i></b></a> </i></p>


</html>