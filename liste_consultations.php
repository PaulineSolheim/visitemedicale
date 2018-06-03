
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
        <?php include('aside.html'); 
          require('connect.php');
          if(isset($_POST['id_usager']))
            $id_usager = $_POST['id_usager'];

          if(isset($_POST['id_medecin']))
            $id_medecin = $_POST['id_medecin'];
        ?>
        
        <section>
            <!-- PUT YOUR CODE THERE -->
            <div id="conteneur">
              <div class="section-title"> Liste des consultations </div>
              <?php if(isset($_POST['id_usager']) || isset($_POST['id_medecin'])){
              echo ' <div> <form action="liste_consultations.php" method="post"> <input id="ajout" type="submit" name="submit" value="Voir toutes les consultations"> </form></div>';
            }
              ?>
            </div>
              <div id="part">

                  <table>
                      <tr>
                          <th width= 25%> Nom du patient</th>
                          <th width= 25%> Nom du médecin </th> 
                          <th width= 25%> Date  </th>
                          <th width= 25%> Heure </th>
                          <th width= 10%>  </th>
                      </tr>
                      <?php
                      //va chercher toutes les consultations
                      if(isset($_POST['id_usager'])){
                       $reqConsult = $linkpdo->prepare("
                          SELECT * FROM CONSULTATIONS WHERE date_consultation >= CURDATE() AND id_usager = $id_usager ORDER BY date_consultation, heure_debut ");
                      } else if(isset($id_medecin)){
                         $reqConsult = $linkpdo->prepare("
                          SELECT * FROM CONSULTATIONS WHERE date_consultation >= CURDATE() AND id_medecin = $id_medecin ORDER BY date_consultation, heure_debut ");
                      } else {
                        $reqConsult = $linkpdo->prepare('
                          SELECT * FROM CONSULTATIONS WHERE date_consultation >= CURDATE() ORDER BY date_consultation, heure_debut ');
                      }
                          $reqConsult->execute();
                          $consult = $reqConsult->fetchAll();
                          foreach($consult as $value) { 
                          $date_consultation =date("d/m/Y", strtotime($value['date_consultation']));
                         
                       //va chercher le nom de l'usager liée à l'id_usager de la consultation 
                       $reqPatient = $linkpdo->prepare('
                          SELECT * FROM USAGERS WHERE id_usager = :id_usager');
                          $reqPatient->execute(array('id_usager' => $value['id_usager']));
                          $patient = $reqPatient->fetch();

                        //va cherche le nom du médecin liée à l'id_médecin de la consultation 
                        $reqMedecin = $linkpdo->prepare('
                          SELECT * FROM MEDECINS WHERE id_medecin = :id_medecin');
                          $reqMedecin->execute(array('id_medecin' => $value['id_medecin']));
                          $medecin = $reqMedecin->fetch();
                          ?>
                        <tr>
                            <td width= 30%> <?php echo $patient['nom'] ?> </td>
                          <td width= 30%> <?php echo $medecin['nom']  ?> </td>
                          <td width= 15%> 
                            <?php echo $date_consultation;   ?> </td>
                          <td width= 15%> <?php echo $value['heure_debut'];  ?> </td>
                          <form action="supprimer_consultation.php" method="post"> 

                            <?php echo '<input type="hidden" name="id_usager" value='.$value['id_usager'].'>
                                        <input type="hidden" name="id_medecin" value='.$value['id_medecin'].'> 
                                        <input type="hidden" name="date_consultation" value='.$value['date_consultation'].'>
                                        <input type="hidden" name="heure_debut" value='.$value['heure_debut'].'>' ?>

                            <td width= 15%><input type="submit" name="supprimer" value="Supprimer"></td>
                         </form>
                      </tr> 
                  
                  <?php
                    }
                  echo'</table>';
                  ?>
              </div>
        </section>
</div>




</body>

</html>

