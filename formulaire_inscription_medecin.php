
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

              //si l'id du médecin a été passée en POST c'est que c'est une modification du profil du médecin
              if(isset($_POST['submit']) && isset($_POST['id']) ){
                $req = $linkpdo->prepare("SELECT * FROM MEDECINS WHERE id_medecin = :id"); 
                $req->execute(array("id"=> $_POST['id'])); 
                $contact = $req->fetch();
              }
            ?>

            <div class="section-title"> Ajouter/Modifier un médecin </div>
            <div id="formulaire">
              <form action="formulaire_inscriptionSQL_medecin" method="post" id="formu">
                <?php 
                if(isset($_GET['medecin'])){
                  echo '<span id="dejapresent"> Medecin déjà présent dans la base</span>';
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
                          echo 'selected="selected"';  
                        ?> 
                        value="Mme"> Madame
                      </option>
                      <option 
                        <?php 
                        if(isset($contact) && $contact['civilite']=="Mr")  
                          echo 'selected="selected"';
                        ?>
                        value="Mr"> Monsieur
                      </option>
                      </select>
                  </td>
                </tr>

                <tr>
                  <td><label for="nom">Nom</label></td>
                  <td><input type="text" name="nom" required="required" value="<?php if(isset($contact)) echo $contact['nom'] ?>"></td>
                </tr>

                <tr>
                  <td><label for="prenom">Prénom</label></td>
                  <td><input type="text" name="prenom" required="required" value ="<?php if(isset($contact)) echo $contact['prenom'] ?>"></td>
                </tr>
              </table>

                <input type="hidden" name="id_medecin" value="<?php if(isset($contact)) echo $contact['id_medecin']; ?>">
                <?php 
                if(!isset($contact)){
                  echo '<input id="terminer" type="submit" name="submit" value="Terminer">';
                } else {
                  echo '<input id="modifier" type="submit" name="submit" value="Modifier les données"><br>
                  <input id="supprimer" type="submit" name="submit" value="Supprimer le médecin">';
                }
                ?>

                <input id="annuler" type="reset" name="annuler" value="Annuler">
              </form>
            </div>
        </section>
</div>




</body>

</html>

