
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
            <?php 

            require("connect.php");

            //Si un ID a été passé en POST c'est que c'est une modification d'un usager
            if(isset($_POST['submit']) && isset($_POST['id']) ){

                $req = $linkpdo->prepare('SELECT * FROM USAGERS WHERE id_usager = :id'); 
                $req->execute(array("id"=> $_POST['id'])); 
                $contact = $req->fetch();

              }
            ?>
            <div class="section-title"> Ajouter/Modifier un usager </div>
                    <div id="formulaire">
           <form action="formulaire_inscriptionSQL.php" method="post" id="formu">
            <?php 
              //si le numero de SS existe déjà le contact est déjà présent dans la BDD
              if(isset($_GET['usager'])){
                echo '<span id="dejapresent"> Usager déjà présent dans la base</span>';
              }
            ?>
               <table id="table">
                  <tr>
                    <td><label for="civ">Civilite</label></td>
                    <td>
                      <select name="civ">
                      <option 
                            <?php 
                            if(isset($contact) && $contact['civilite']=="Mme")
                            { 
                               echo 'selected="selected"';  
                             }?> 
                            value="Mme"> Madame</option>
                      <option 
                          <?php 
                          if(isset($contact) && $contact['civilite']=="Mr") 
                            echo 'selected="selected"'; 
                          ?>
                        value="Mr"> Monsieur</option>
                      </select>
                    </td>
                  </tr>
                

                  <tr>
                    <td><label for="nom">Nom</label></td>
                    <td><input type="text" name="nom" required="required" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ\s-]+" title="Seuls les caractères alpha-numériques et les espaces sont acceptés" value="<?php if(isset($contact)) echo $contact['nom'] ?>"></td>
                  </tr>
                
                  <tr>
                    <td><label for="prenom">Prénom</label></td>
                    <td><input type="text" name="prenom" required="required" value ="<?php if(isset($contact)) echo $contact['prenom'] ?>" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ\s-]+" title="Seuls les caractères alpha-numériques et les espaces sont acceptés" ></td>
                  </tr>
                  <tr>
                    <td><label for="datenaissance">Date de naissance</label></td>
                    <td><input type="date" name="datenaissance" required="required" value ="<?php if(isset($contact)) echo $contact['date_naissance'] ?>"></td>
                  </tr>
                  <tr>
                    <td><label for="numeroSS">N° de sécurité sociale</label></td>
                    <td><input type="text" name="numeroSS" required="required" pattern="^[1-3][0-9]{4}(2[AB]|[0-9]{2})[0-9]{6}$" title="Numero de sécurité sociale non valide" value ="<?php if(isset($contact)) echo $contact['numero_ss'] ?>"></td>
                  </tr>
                
                        
                  <tr>
                    <td><label for="adresse">Adresse</label></td>
                    <td><input type="text" name="adresse" required="required" value ="<?php if(isset($contact)) echo $contact['adresse'] ?>"></td>
                  </tr>
                
                  <tr>
                    <td><label for="cp">Code postal</label></td>
                    <td><input type="text" name="cp" required="required" value ="<?php if(isset($contact)) echo $contact['cp'] ?>"></td>
                  </tr>
                  <tr>
                    <td><label for="ville">Ville</label></td>
                    <td><input type="text" name="ville" required="required" value ="<?php if(isset($contact)) echo $contact['ville'] ?>"></td>
                  </tr>
                  <tr>
                    <td><label for="referent">Médecin référent</label></td>
                    <td>
                      <select type="select" name="referent" form="formu">
                          <option>  </option>
                          <?php
                            
                            //afficher la liste des médecins
                            $res = $linkpdo->prepare('SELECT * FROM medecins ORDER BY nom');
                            $res->execute();
                            $medecins = $res->fetchAll();

                            foreach($medecins as $med) { 
                              echo '<option '; 
                               
                              if(isset($contact) && $med['id_medecin'] == $contact['id_medecin']){
                                echo 'selected="selected"';
                              }
                   
                              echo ' value='.$med['id_medecin'].'>'.$med['nom']. ' '.$med['prenom'].'</option>';
                                
                              }
                          ?>


                      </select>
                    </td>
                  </tr>

                
                 <tr>
                </table>
                <input type="hidden" name="id" value="<?php if(isset($contact)) echo $contact['id_usager']; ?>">

                <?php 
                //changer les boutons affichés en fonction de si c'est une modification ou un ajout d'usager
                if(!isset($contact)){
                  echo '<input id="terminer" type="submit" name="submit" value="Terminer">';
                } else {
                  echo '<input id="modifier" type="submit" name="submit" value="Modifier le contact"><br>
                  <input id="supprimer" type="submit" name="submit" value="Supprimer le contact">';
                }
                ?>
                
            </form>
          </div>
        </section>
</div>




</body>

</html>

