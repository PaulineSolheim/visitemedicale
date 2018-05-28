

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
                <td><input type="text" name="nom" required="required"></td>
               </tr>
                
                <tr>
                    <td><label for="prenom">Prénom</label></td>
                    <td><input type="text" name="prenom" required="required"></td>
                   </tr>
                 <tr>
                    <td><label for="datenaissance">Date de naissance</label></td>
                    <td><input type="date" name="datenaissance" required="required"></td>
                </tr>
                 <tr>
                    <td><label for="numeroSS">N° de sécurité sociale</label></td>
                    <td><input type="text" name="numeroSS" required="required"></td>
                </tr>
                
                        
                <tr>
                    <td><label for="adresse">Adresse</label></td>
                    <td><input type="text" name="adresse" required="required"></td>
                   </tr>
                
                <tr>
                    <td><label for="cp">Code postal</label></td>
                    <td><input type="text" name="cp" required="required"></td>
                </tr>
                <tr>
                    <td><label for="ville">Ville</label></td>
                    <td><input type="text" name="ville" required="required"></td>
                   </tr>
                
                <tr>
               </table>
                
                <input id="terminer" type="submit" name="submit" value="Terminer">

            </form>
        </div>

        

    </section>
</div>




</body>

</html>