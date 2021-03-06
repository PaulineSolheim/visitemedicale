<?php

require('connect.php');
      
if(!isset($_SESSION['id']))header('Location: index.php?connect=non');

 
 //stockage des valeurs passées dans le formulaire
if (isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['civ']) && isset($_POST['id_medecin']) ){
		$nom = mb_strtoupper($_POST['nom']);
		$prenom = ucwords(mb_strtolower($_POST['prenom']));
		$civilite = $_POST['civ'];
		$id_medecin = $_POST['id_medecin'];


		
		//si c'est l'ajout d'un médecin 
		if (isset($_POST['submit']) && $_POST['submit'] == "Terminer") {
			
			//vérifier que l'usager/patient n'a pas déjà été rentré
			$reqExist = $linkpdo->prepare("SELECT nom FROM medecins WHERE nom = :nom AND prenom = :prenom"); 
			$reqExist->execute(array('nom' => $nom,'prenom' => $prenom));

			$nbLignes=$reqExist->rowCount();
			if($nbLignes != 0)
				header('Location: formulaire_inscription_medecin?medecin=dejaexistant');

			$req = $linkpdo->prepare("INSERT INTO medecins (civilite, nom, prenom) VALUES(:civilite, :nom, :prenom)"); 
			$req->execute(array('civilite' => $civilite,'nom' => $nom,'prenom' => $prenom)); 
			echo "insertion OK";
		} 

		//Si c'est la modification du profil d'un médecin 
		else if (isset($_POST['submit']) && $_POST['submit'] == "Modifier les données") {
			$req = $linkpdo->prepare("UPDATE MEDECINS SET civilite = :civilite, nom = :nom, prenom = :prenom WHERE id_medecin = :id_medecin"); 
				$req->execute(array('civilite' => $civilite,
				'nom' => $nom,
				'prenom' => $prenom,
				'id_medecin' => $id_medecin
				)); 
				echo "Modif OK";
		}

		//Si c'est la suppression d'un profil de médecin de la BDD
		else if(isset($_POST['submit']) &&  $_POST['submit'] == "Supprimer le médecin" && isset($_POST['id_medecin'])){
			$reqDelete = $linkpdo->prepare("DELETE FROM CONSULTATIONS WHERE id_medecin = :id"); 
				$reqDelete->execute(array('id' => $_POST['id_medecin']));
				echo "contact supp";

			$reqDelMedRef = $linkpdo->prepare("UPDATE USAGERS SET id_medecin = null WHERE id_medecin = :id"); 
				$reqDelMedRef->execute(array('id' => $_POST['id_medecin']));
				echo "contact supp";

			$req = $linkpdo->prepare("DELETE FROM MEDECINS WHERE id_medecin = :id"); 
				$req->execute(array('id' => $_POST['id_medecin']));
				echo "contact supp";
		}
		header('Location: liste_medecins.php');
	}

?>