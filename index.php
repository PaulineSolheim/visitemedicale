

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DoctorPlanning</title>
    <link rel="stylesheet" href="index.css"/>
    <title> Doctor Planning </title>
    <link rel="shortcut icon" type="image/x-icon" href="doctor.png" />
    <link rel="stylesheet" href="stylesheets/ecran_connexion.css">
    
</head>
<body>
       
    <div id='img_titre'> <img src="doctor.png" alt="" /> </div>
    <div id=titre> Doctor Planning </div>

    <section>
        <div id="inscription">
	    <h4>Connexion à votre compte</h4>

		     <form action="formulaire_connexion.php" method="post">
                <label for="identifiant">Identifiant</label>
                <input type="text" name="identifiant" required="required"><br>
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" required><br>
                <input type="submit" name="submit" value="Se connecter"><br>

                <?php
                    if(isset($_GET['motdepasse'])){
                        echo "Mot de passe invalide";
                    } 
                    if(isset($_GET['connect'])){
                        echo "Veuillez vous connecter";
                    }
                ?>
   
              
            </form>
        </div>
    </section>

    <footer>
        
    </footer>
</body>
</html>
