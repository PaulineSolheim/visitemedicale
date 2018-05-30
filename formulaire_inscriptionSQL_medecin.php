<?php
require('connect.php');
 
 //stockage des valeurs passées dans le formulaire
if (isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['civ'])){
		$nom = mb_strtoupper($_POST['nom']);
		$prenom = ucwords(mb_strtolower($_POST['prenom']));
		$civilite = $_POST['civ'];

		echo "stock OK";

		//vérifier que l'usager/patient n'a pas déjà été rentré
		$reqExist = $linkpdo->prepare("SELECT nom FROM medecins WHERE nom = :nom AND prenom = :prenom"); 
		$reqExist->execute(array('nom' => $nom,
				'prenom' => $prenom));

		$nbLignes=$reqExist->rowCount();
		if($nbLignes != 0)
			header('Location: formulaire_inscription_medecin?medecin=dejaexistant');


		

		if (isset($_POST['submit']) && $_POST['submit'] == "Terminer") {
			
				$req = $linkpdo->prepare("INSERT INTO medecins (civilite, nom, prenom) VALUES(:civilite, :nom, :prenom)"); 
				$req->execute(array('civilite' => $civilite,
				'nom' => $nom,
				'prenom' => $prenom
				)); 
				echo "insertion OK";
			} 

		else if (isset($_POST['submit']) && $_POST['submit'] == "Modifier les données") {
			$req = $linkpdo->prepare("UPDATE USAGERS SET civilite = :civilite, nom = :nom, prenom = :prenom WHERE id_medecin = :id"); 
				$req->execute(array('civilite' => $civilite,
				'nom' => $nom,
				'prenom' => $prenom,

				'id_medecin' => $id_medecin
				)); 
				echo "Modif OK";
		}

		else if(isset($_POST['submit']) &&  $_POST['submit'] == "Supprimer le contact" && isset($_POST['id'])){
			$req = $linkpdo->prepare("DELETE FROM USAGERS WHERE id_usager = :id"); 
				$req->execute(array('id' => $_POST['id']));
				echo "contact supp";
		}
		//header('Location: liste_usagers.php');
	}

?>