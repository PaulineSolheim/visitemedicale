
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
                <?php
                require('connect.php');
                echo'<table>
                            <tr>
                                <th> Nom </th>
                                <th> Prenom </th> 
                                <th>  </th>
                                <th> <form action="formulaire_inscription_medecin.php" method="post"> <input id="ajout" type="submit" name="submit" value="Ajouter un médecin"></form> </th>
                            </tr>';

                $reqContacts = $linkpdo->prepare('
                        SELECT * FROM medecins ORDER BY nom, prenom ');
                        $reqContacts->execute();
                        $contacts = $reqContacts->fetchAll();
                        foreach($contacts as $value) { 
                    echo '
                    
                  
                     <tr class = "toggle"> 
                        <td> '. $value['nom'] .' </td>
                        <td> '. $value['prenom'] . ' </td>

                        <form action="consultations.php" method="post"> 
                        <input type="hidden" name="id" value='.$value['id_medecin'].'>
                         <td><input id="profil" type="submit" name="submit" value="Voir consultations"></td>
                         </form>

                         <form action="formulaire_inscription_medecin.php" method="post"> 
                         <input type="hidden" name="id" value='.$value['id_medecin'].'>
                         <td><input id="profil" type="submit" name="submit" value="Voir profil"></td>
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

