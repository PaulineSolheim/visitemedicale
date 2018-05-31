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
    <div id="titre"> Doctor Planning </div>
    <?php
            if(isset($_POST['submit']) &&isset($_POST['mdp'])&& isset($_POST['identifiant'])){

            }

    ?>

    <section>
        <div id="formulaire">
            <h3> Identifiez-vous </h3> 
                <form action="page_connexion.php" method="post">
                            
                    <table id="table">
                         
                        <tr>
                            <td><label for="identifiant">Identifiant</label></td>
                            <td><input type="text" name="identifiant" required="required"></td>
                        </tr>
                            
                        <tr>
                            <td><label for="mdp">Mot de passe </label></td>
                            <td><input type="password" name="mdp" required="required"></td>
                        </tr>
                             
                    </table>
                            
                    <input id="terminer" type="submit" name="submit" value="Connexion">

                 </form>
        </div>

        

    </section>
</div>




</body>

