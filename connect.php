<?php
	try{
		$linkdpo = new PDO("mysql:host=localhost;dbname=mcm0239a", "root", "");
	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}	
?>
