
<!DOCTYPE html>
<html>

<head>       

    <link rel="stylesheet" href="stylesheets/index.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="doctor.png" />
	<title> Doctor Planning </title>

</head>
	
<body>
  
  	<div id='img_titre'> <img src="doctor.png" alt="" /> </div>
	<div id=titre> Doctor Planning </div>

   <div id="wrapper">
        <aside id="left-menu">
            <div class="head">
                <div class="head-title"> Bonjour, </div>
                <div class="head-subtitle"> </div>
            </div>
            <div class="menu">
                <ul>
                    <a href=""><li>Usagers</li></a>
                    <a href=""><li>Medecins</li></a>
                    <a href=""><li>Consultations</li></a>
                    <a href=""><li>Statistiques</li></a>
                </ul>
            </div>
        </aside>
        <section>
            <!-- PUT YOUR CODE THERE -->
            <div class="section-title"> Liste des usagers </div>
            <div id="part">
                <?php
                require('connect.php');

                $reqContacts = $linkdpo->prepare('
                        SELECT * FROM USAGERS ORDER BY nom, prenom ');
                        $reqContacts->execute();
                        while($contacts = $reqContacts->fetch()) { 
                    echo '
                    
                    <table>
                     <tr class = "toggle">
                        <td> '. $contacts->nom .' </td>
                        <td> '. $contacts->prenom. ' </td>
                        <td> '. $contacts->numero_ss . ' </td>
                        
                    </tr> </table>';
                }
                ?>
            </div>
        </section>
</div>




</body>

</html>

