

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DoctorPlanning</title>
    <link rel="stylesheet" href="index.css"/>
    <title> Doctor Planning </title>
    <link rel="shortcut icon" type="image/x-icon" href="doctor.png" />
    <link rel="stylesheet" href="stylesheets/formulaire_inscription.css">
    <link rel="stylesheet" href="stylesheets/index.css">
    <?php 
      if(isset($_POST['submit']) ){

        $req = $linkpdo->prepare("SELECT * FROM USAGERS WHERE id = :id"); 
        $req->execute(); 
        $contact = $req -> fetchAll();



      }
    ?>
    
</head>
<body>
       
    <div id='img_titre'> <img src="doctor.png" alt="" /> </div>
    <div id="titre"> Doctor Planning </div>

    <section>
        <div id="formulaire">
           <form action="formulaire_inscriptionSQL.php" method="post">
            
               <table id="table">
              <tr>
                    <td><label for="civ">Civilite</label></td>
                <td>
                    <select name="civ">
                    <option value="madame">Madame</option>
                    <option value="monsieur">Monsieur</option>
                    </select></td>
                   </tr>
                
                <tr>
               <tr>
                <td><label for="nom">Nom</label></td>
                <td><input type="text" name="nom" required="required" value="<?php if(isset($contact)) echo $contact->nom ?>"></td>
               </tr>
                
                <tr>
                    <td><label for="prenom">Prénom</label></td>
                    <td><input type="text" name="prenom" required="required" value ="<?php if(isset($contact)) echo $contact->prenom ?>"></td>
                   </tr>
                 <tr>
                    <td><label for="datenaissance">Date de naissance</label></td>
                    <td><input type="date" name="datenaissance" required="required" value ="<?php if(isset($contact)) echo $contact->date_naissance ?>"></td>
                </tr>
                 <tr>
                    <td><label for="numeroSS">N° de sécurité sociale</label></td>
                    <td><input type="text" name="numeroSS" required="required" value ="<?php if(isset($contact)) echo $contact->numero_ss ?>"></td>
                </tr>
                
                        
                <tr>
                    <td><label for="adresse">Adresse</label></td>
                    <td><input type="text" name="adresse" required="required" value ="<?php if(isset($contact)) echo $contact->adresse ?>"></td>
                   </tr>
                
                <tr>
                    <td><label for="cp">Code postal</label></td>
                    <td><input type="text" name="cp" required="required" value ="<?php if(isset($contact)) echo $contact->cp ?>"></td>
                </tr>
                <tr>
                    <td><label for="ville">Ville</label></td>
                    <td><input type="text" name="ville" required="required" value ="<?php if(isset($contact)) echo $contact->ville ?>"></td>
                   </tr>
                
                <tr>
               </table>
                <input type="hidden" name="id" value="<?php if(isset($contact)) echo $contact->id_usager ?>">
                
                <input id="terminer" type="submit" name="submit" value="Terminer">
                <input id="modifier" type="submit" name="submit" value="Modifier le contact"><br>
                <input id="supprimer" type="submit" name="submit" value="Supprimer le contact">

            </form>
        </div>

        

    </section>
</div>




</body>

</html>