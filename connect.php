<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	try{
		$linkdpo = new PDO("mysql:host=localhost;dbname=mcm0239a", "root", "");
	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}
?>
