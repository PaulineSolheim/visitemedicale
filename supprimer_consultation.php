 
<?php


  require('connect.php');
  
  if(!isset($_SESSION['id']))header('Location: index.php?connect=non');



 //stockage des valeurs passées dans le formulaire
if (isset($_POST['id_medecin']) && isset($_POST['id_usager'])  && isset($_POST['date_consultation']) && isset($_POST['heure_debut']) ){
		
		echo "YES";
		$req = $linkpdo->prepare("DELETE FROM CONSULTATIONS WHERE id_medecin = :id_medecin AND id_usager = :id_usager AND date_consultation = :date_consultation AND heure_debut = :heure_debut;"); 
		$req->execute(array('id_medecin' => $_POST['id_medecin'], 
			'id_usager' => $_POST['id_usager'],
			'date_consultation' => $_POST['date_consultation'],
			'heure_debut' => $_POST['heure_debut']
	));
		 		echo "consultation supp";

		header('Location: liste_consultations.php');
	}

?>