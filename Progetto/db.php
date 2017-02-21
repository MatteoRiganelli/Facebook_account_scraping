<?php
$connection = mysql_connect('localhost', 'root', 'root');
if (!$connection){
    die("Database Connection Failed" . mysql_error());
}
$select_db = mysql_select_db('register'); //se cambia il db cambia il nome
if (!$select_db){
    die("Database Selection Failed" . mysql_error());
}
?>