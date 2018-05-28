<?php

if (isset($_POST['submit'])) {

	require('connect.php');
	echo "connexion OK <br>";
  if (isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['civ']) && isset($_POST['datenaissance']) && isset($_POST['numeroSS']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['ville'])
)
	{
		$nom = mb_strtoupper($_POST['nom']);
		$prenom = ucwords(mb_strtolower($_POST['prenom']));
		$datenaissance = $_POST['datenaissance'];
		$adresse = $_POST['adresse'];
		$cp = $_POST['cp'];
		$numeroSS = $_POST['numeroSS'];
		$civilite = $_POST['civ'];
		$ville = $_POST['ville'];

		$req = $linkpdo->prepare("INSERT INTO usagers (civilite, nom, prenom, adresse, cp, ville, date_naissance, numero_ss) VALUES(:nom, :prenom  :adresse :cp :ville :date_naissance :numero_ss)"); 
		$req->execute(array('civilite' => $civilite,
		'nom' => $nom,
		'prenom' => $prenom,
		'adresse' => $adresse,
		'cp' => $cp,
		'ville' => $ville,
		'date_naissance' => $adresse,
		'numero_ss' => $cp
		)); 
		echo "OK";
	} else {
		echo "Not OK";
	}
}

	?>