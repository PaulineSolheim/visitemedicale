
<!DOCTYPE html>
<html>

<head>       

    <link rel="stylesheet" href="stylesheets/index.css"/>
    <link rel="stylesheet" href="stylesheets/liste_usagers.css"/>
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
                echo'<table>
                            <tr>
                                <th> Nom </th>
                                <th> Prenom </th> 
                                <th> N° de sécurité sociale </th>
                                <th>  </th>
                                <th>  </th>
                            </tr>';
                
                

                $reqContacts = $linkdpo->prepare('
                        SELECT * FROM USAGERS ORDER BY nom, prenom ');
                        $reqContacts->execute();
                        $contacts = $reqContacts->fetchAll();
                        foreach($contacts as $value) { 
                    echo '
                    
                  
                     <tr class = "toggle"> <form>
                        <td> '. $value['nom'] .' </td>
                        <td> '. $value['prenom'] . ' </td>
                        <td> '.$value['numero_ss']  . ' </td>

                        <form action="consultations.php" method="post"> 
                        <input type="hidden" name="id" value='.$value['id_usager'].'>
                         <td><input id="profil" type="submit" name="submit" value="Voir consultations"></td>
                         </form>

                         <form action="formulaire_inscription.php" method="post"> 
                         <input type="hidden" name="id" value='.$value['id_usager'].'>
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

