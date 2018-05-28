<?php
require('connect.php');

if (isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['civ']) && isset($_POST['datenaissance']) && isset($_POST['numeroSS']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['ville']))	{
		$nom = mb_strtoupper($_POST['nom']);
		$prenom = ucwords(mb_strtolower($_POST['prenom']));
		$datenaissance = $_POST['datenaissance'];
		$adresse = $_POST['adresse'];
		$cp = $_POST['cp'];
		$numeroSS = $_POST['numeroSS'];
		$civilite = $_POST['civ'];
		$ville = $_POST['ville'];

		if (isset($_POST['submit']) && $_POST['submit'] == "Terminer") {
			
				$req = $lindpo->prepare("INSERT INTO usagers (civilite, nom, prenom, adresse, cp, ville, date_naissance, numero_ss) VALUES(:nom, :prenom  :adresse :cp :ville :date_naissance :numero_ss)"); 
				$req->execute(array('civilite' => $civilite,
				'nom' => $nom,
				'prenom' => $prenom,
				'adresse' => $adresse,
				'cp' => $cp,
				'ville' => $ville,
				'date_naissance' => $datenaissance,
				'numero_ss' => $numeroSS
				)); 
				echo "OK";
		} 

		else if (isset($_POST['submit']) && $_POST['submit'] == "Modifier le contact") {
			$req = $linkdpo->prepare("UPDATE USAGERS SET :civilite :nom :prenom  :adresse :cp :ville :date_naissance :numero_ss WHERE id_usager = :id"); 
				$req->execute(array('civilite' => $civilite,
				'nom' => $nom,
				'prenom' => $prenom,
				'adresse' => $adresse,
				'cp' => $cp,
				'ville' => $ville,
				'date_naissance' => $datenaissance,
				'numero_ss' => $numeroSS, 
				'id' => $_POST['id']
				)); 
				echo "Modif OK";
		}

		else if(isset($_POST['submit']) &&  $_POST['submit'] == "Supprimer le contact" && isset($_POST['id'])){
			$req = $linkpdo->prepare("DELETE FROM USAGERS WHERE id_usager = :id"); 
				$req->execute(array('id' => $_POST['id']));
		}
	}

?>