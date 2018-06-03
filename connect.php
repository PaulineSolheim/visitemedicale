<?php
	session_start();
	

	try{
		$linkpdo = new PDO("mysql:host=localhost;dbname=mcm0239a", "root", "");
	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}
?>
