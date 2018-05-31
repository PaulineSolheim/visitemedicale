<?php
require('connect.php');
 
 //stockage des valeurs passées dans le formulaire
if (isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['civ']) && isset($_POST['datenaissance']) && isset($_POST['numeroSS']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['ville'])){
		$nom = mb_strtoupper($_POST['nom']);
		$prenom = ucwords(mb_strtolower($_POST['prenom']));
		$datenaissance = $_POST['datenaissance'];
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
		

		//vérifier que l'usager/patient n'a pas déjà été rentré
		$reqExist = $linkpdo->prepare("SELECT nom FROM usagers WHERE numero_ss = :numero_ss"); 
		$reqExist->execute(array('numero_ss' => $numeroSS));

		$nbLignes=$reqExist->rowCount();
		if($nbLignes != 0)
			header('Location: formulaire_inscription.php?usager=dejaexistant');


		

		if (isset($_POST['submit']) && $_POST['submit'] == "Terminer") {
			//	if(isset($_POST['referent'])){
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

		else if(isset($_POST['submit']) &&  $_POST['submit'] == "Supprimer le contact" && isset($_POST['id'])){
			$req = $linkpdo->prepare("DELETE FROM USAGERS WHERE id_usager = :id"); 
				$req->execute(array('id' => $_POST['id']));
				echo "contact supp";
		}

		header('Location: liste_usagers.php');
	}

?>