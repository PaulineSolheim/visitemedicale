<?php
  require('connect.php');
 ?>

<!DOCTYPE html>
<html>

<head>       

    <!-- HEAD AVEC LINKS -->
    <?php include('head.html'); ?>

</head>
	
<body>
  
  <div id='img_titre'> <img src="doctor.png" alt="" /> </div>
	<div id=titre> Doctor Planning </div>

  <div id="wrapper">
      <!-- MENU DE GAUCHE -->
      <?php include('aside.html'); ?>
        
        <section>
            <!-- PUT YOUR CODE THERE -->
            <div class="section-title"> Liste des médecins </div>
            <div id="part">
                
                <table>
                    <tr>
                        <th width= 25%> Nom </th>
                        <th width= 25%> Prenom </th> 
                        <th width= 25%>  </th>
                        <th width= 25%> <form action="formulaire_inscription_medecin.php" method="post"> <input id="ajout" type="submit" name="submit" value="Ajouter un médecin"></form> </th>
                    </tr>
                  <?php
                    //cherche dans la base de données tous les médecins enregistrés
                    $reqContacts = $linkpdo->prepare('SELECT * FROM medecins ORDER BY nom, prenom ');
                        $reqContacts->execute();
                        $contacts = $reqContacts->fetchAll();
                        foreach($contacts as $value) { 
                            echo '                  
                             <tr> 
                                <td width= 25%> '. $value['nom'] .' </td>
                                <td width= 25%> '. $value['prenom'] . ' </td>

                                <form action="liste_consultations.php" method="post"> 
                                 <input type="hidden" name="id_medecin" value='.$value['id_medecin'].'>
                                  <td width= 25%>
                                  <input id="profil" type="submit" name="submit" value="Voir consultations"></td>
                                 </form>

                                 <form action="formulaire_inscription_medecin.php" method="post"> 
                                  <input type="hidden" name="id" value='.$value['id_medecin'].'>
                                  <td width= 25%><input id="profil" type="submit" name="submit" value="Voir profil"></td>
                                 </form>
                                
                            </tr> ';
                }
                echo'</table>';
                ?>
            </div>
        </section>
</div>




</body>

</html>

