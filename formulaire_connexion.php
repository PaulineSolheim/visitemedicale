<?php
 require('connect.php');

	if(isset($_POST['submit']) && isset($_POST['identifiant']) && isset($_POST['mdp']))	{
		$identifiant = $_POST['identifiant'];
		$mdp = md5($_POST['mdp']);

		//va chercher le mot de passe associé à l'identifiant tapé
	$connexion = $linkpdo->prepare("SELECT * FROM admin WHERE identifiant = :identifiant");     
    $connexion->execute(array('identifiant'=> $identifiant));
    $m = $connexion->fetchObject();

    if($m->mdp == $mdp){
    	$_SESSION['id']="OK";
    	
    	header('Location: liste_consultations.php');
    } else {
    	header('Location: index.php?motdepasse=invalide');
    }


    } else {
		header('Location: index.php?erreur=erreur');
	}

?>