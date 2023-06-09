<?php
$host     = 'localhost';
$user     = 'root'; // diisi dengan user database kalian biasanya 
$password = '';  //diisi dengan password database kalian biasanya 
$db       = 'tugas_jmpl_1'; //diisi dengan nama database kalian
 
$db = mysqli_connect($host, $user, $password, $db) or die(mysqli_error());
?>