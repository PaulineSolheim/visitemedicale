<?php

require('connect.php');

if(!isset($_SESSION['id']))header('Location: index.php?connect=non');

 
 //stockage des valeurs passées dans le formulaire
if (isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['civ']) && isset($_POST['datenaissance']) && isset($_POST['numeroSS']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['ville'])){
		$nom = mb_strtoupper($_POST['nom']);
		$prenom = ucwords(mb_strtolower($_POST['prenom']));
		$current_date=date("Y-m-d");
		if( date("Y", strtotime($_POST['datenaissance'])) > 1900 && checkdate(date("m", strtotime($_POST['datenaissance'])) , date("m", strtotime($_POST['datenaissance'])) ,  date("Y", strtotime($_POST['datenaissance']))) && new DateTime() > new DateTime($_POST['datenaissance'])){
			$datenaissance = $_POST['datenaissance'];
			echo "OK";}
		else
			header('Location:formulaire_inscription.php?date=invalide');




		$adresse = $_POST['adresse'];
		$cp = $_POST['cp'];
		$numeroSS = $_POST['numeroSS'];
		$civilite = $_POST['civ'];
		$ville = mb_strtoupper($_POST['ville']);
		if($_POST['referent']!=""){
			$id_medecin = $_POST['referent'];
		} else{
			$id_medecin= null;
		}
		

		
		//si c'est l'ajout d'un usager
		if (isset($_POST['submit']) && $_POST['submit'] == "Terminer") {
			//vérifier que l'usager/patient n'a pas déjà été rentré
			$reqExist = $linkpdo->prepare("SELECT nom FROM usagers WHERE numero_ss = :numero_ss"); 
			$reqExist->execute(array('numero_ss' => $numeroSS));
			$nbLignes=$reqExist->rowCount();
			if($nbLignes != 0){}
				header('Location: formulaire_inscription.php?usager=dejaexistant');

				$req = $linkpdo->prepare("INSERT INTO usagers (civilite, nom, prenom, adresse, cp, ville, date_naissance, numero_ss, id_medecin) VALUES(:civilite, :nom, :prenom, :adresse, :cp, :ville, :date_naissance, :numero_ss, :id_medecin)"); 
				$req->execute(array('civilite' => $civilite,
				'nom' => $nom,
				'prenom' => $prenom,
				'adresse' => $adresse,
				'cp' => $cp,
				'ville' => $ville,
				'date_naissance' => $datenaissance,
				'numero_ss' => $numeroSS,
				'id_medecin' => $id_medecin
				)); 
				echo "insertion OK";
			} 

		//si c'est la modif d'un usager
		else if (isset($_POST['submit']) && $_POST['submit'] == "Modifier le contact") {
			$req = $linkpdo->prepare("UPDATE USAGERS SET civilite = :civilite, nom = :nom, prenom = :prenom, adresse=  :adresse, cp= :cp, ville= :ville, date_naissance= :date_naissance, numero_ss = :numero_ss, id_medecin = :id_medecin WHERE id_usager = :id"); 
				$req->execute(array('civilite' => $civilite,
				'nom' => $nom,
				'prenom' => $prenom,
				'adresse' => $adresse,
				'cp' => $cp,
				'ville' => $ville,
				'date_naissance' => $datenaissance,
				'numero_ss' => $numeroSS, 
				'id' => $_POST['id'], 
				'id_medecin' => $id_medecin
				)); 
				echo "Modif OK";
		}
		
		//si c'est la suppression d'un usager
		else if(isset($_POST['submit']) &&  $_POST['submit'] == "Supprimer le contact" && isset($_POST['id'])){

			$reqDel = $linkpdo->prepare("DELETE FROM CONSULTATIONS WHERE id_usager = :id"); 
				$reqDel->execute(array('id' => $_POST['id']));
			$req = $linkpdo->prepare("DELETE FROM USAGERS WHERE id_usager = :id"); 
				$req->execute(array('id' => $_POST['id']));
				echo $_POST['id'];
				echo "contact supp";
		}

		header('Location: liste_usagers.php');
	}

?>