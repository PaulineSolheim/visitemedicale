<?php
require('connect.php');
 
 //stockage des valeurs passées dans le formulaire
if (isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['civ']) && isset($_POST['id_medecin']) ){
		$nom = mb_strtoupper($_POST['nom']);
		$prenom = ucwords(mb_strtolower($_POST['prenom']));
		$civilite = $_POST['civ'];
		$id_medecin = $_POST['id_medecin'];

		echo $nom.$prenom.$civilite.$id_medecin;

		echo $_POST['submit'];

		

		if (isset($_POST['submit']) && $_POST['submit'] == "Terminer") {
			
			//vérifier que l'usager/patient n'a pas déjà été rentré
			$reqExist = $linkpdo->prepare("SELECT nom FROM medecins WHERE nom = :nom AND prenom = :prenom"); 
			$reqExist->execute(array('nom' => $nom,
					'prenom' => $prenom));

			$nbLignes=$reqExist->rowCount();
			if($nbLignes != 0)
				header('Location: formulaire_inscription_medecin?medecin=dejaexistant');

			$req = $linkpdo->prepare("INSERT INTO medecins (civilite, nom, prenom) VALUES(:civilite, :nom, :prenom)"); 
			$req->execute(array('civilite' => $civilite,
			'nom' => $nom,
			'prenom' => $prenom
			)); 
			echo "insertion OK";
		} 

		else if (isset($_POST['submit']) && $_POST['submit'] == "Modifier les données") {
			$req = $linkpdo->prepare("UPDATE MEDECINS SET civilite = :civilite, nom = :nom, prenom = :prenom WHERE id_medecin = :id_medecin"); 
				$req->execute(array('civilite' => $civilite,
				'nom' => $nom,
				'prenom' => $prenom,
				'id_medecin' => $id_medecin
				)); 
				echo "Modif OK";
		}

		else if(isset($_POST['submit']) &&  $_POST['submit'] == "Supprimer le médecin" && isset($_POST['id_medecin'])){
			$req = $linkpdo->prepare("DELETE FROM MEDECINS WHERE id_medecin = :id"); 
				$req->execute(array('id' => $_POST['id_medecin']));
				echo "contact supp";
		}
		//header('Location: liste_usagers.php');
	}

?>