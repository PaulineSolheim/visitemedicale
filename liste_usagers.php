 <?php 
      require('connect.php');
      
      if(!isset($_SESSION['id']))header('Location: index.php?connect=non');
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
            <div class="section-title"> Liste des usagers </div>
            <div id="part">
             
               <table>
                    <tr>
                        <th width= 20%> Nom </th>
                        <th width= 20%> Prenom </th> 
                        <th width= 30%> N° de sécurité sociale </th>
                        <th width= 15%> </th>
                        <th width= 15%> <form action="formulaire_inscription.php" method="post"> <input id="ajout" type="submit" name="submit" value="Ajouter un usager"></form> </th>
                    </tr>
                    <?php

                     $reqContacts = $linkpdo->prepare('
                        SELECT * FROM USAGERS ORDER BY nom, prenom ');
                        $reqContacts->execute();
                        $contacts = $reqContacts->fetchAll();
                        foreach($contacts as $value) { 
                    echo '
                    
                     <tr> 
                        <td width= 20%> '. $value['nom'] .' </td>
                        <td width= 20%> '. $value['prenom'] . ' </td>
                        <td width= 30%> '.$value['numero_ss']  . ' </td>

                        <form action="liste_consultations.php" method="post"> 
                            <input type="hidden" name="id_usager" value='.$value['id_usager'].'>
                            <td width= 15%><input id="profil" type="submit" name="submit" value="Voir consultations"></td>
                         </form>

                         <form action="formulaire_inscription.php" method="post"> 
                           <input type="hidden" name="id" value='.$value['id_usager'].'>
                           <td width= 15%><input id="profil" type="submit" name="submit" value="Voir profil"></td>
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

