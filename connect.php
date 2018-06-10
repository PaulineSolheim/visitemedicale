<?php
	
	

	try{
		$linkpdo = new PDO("mysql:host=localhost;dbname=mcm0239a", "root", "");
		 if(!isset($_SESSION)) { 
	        session_start(); 
	    } 
	}catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}
?>
