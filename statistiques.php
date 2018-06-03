
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
            <div class="section-title"> Statistiques </div>
            <div id="part">
            <!-- PUT YOUR CODE THERE -->
            <?php 
            require('connect.php');


                $nbUsagers = $linkpdo->query("SELECT COUNT(*) FROM USAGERS")->fetchColumn();
                //hommes de moins de 25 ans
                $reqMoinsDe25H = $linkpdo->query('SELECT COUNT(*) as TOTAL FROM usagers WHERE date_naissance > DATE_SUB(curdate(), INTERVAL 25 YEAR) AND civilite ="Mr"')->fetchColumn();
                $moinsDe25H = round($reqMoinsDe25H / $nbUsagers*100, 2);

                //femmes de moins de 25 ans
                $reqMoinsDe25F = $linkpdo->query('
                        SELECT COUNT(*) as TOTAL FROM usagers WHERE date_naissance > DATE_SUB(curdate(), INTERVAL 25 YEAR) AND civilite ="Mme"')->fetchColumn();
                $moinsDe25F = round($reqMoinsDe25F/ $nbUsagers*100,2);

                //femmes de plus de 50 ans
                $reqPlusDe50F = $linkpdo->query('
                        SELECT COUNT(*) as TOTAL FROM usagers WHERE date_naissance < DATE_SUB(curdate(), INTERVAL 50 YEAR) AND civilite ="Mme"')->fetchColumn();
                $plusDe50F = round($reqPlusDe50F/ $nbUsagers*100,2);

                //hommes de plus de 50 ans
                $reqPlusDe50H= $linkpdo->query('
                        SELECT COUNT(*) as TOTAL FROM usagers WHERE date_naissance < DATE_SUB(curdate(), INTERVAL 50 YEAR) AND civilite ="Mr"')->fetchColumn();
                $plusDe50H = round($reqPlusDe50H/ $nbUsagers*100,2);

                //femmes entre 50 et 25 ans
                $reqEntre25Et50F = $linkpdo->query('
                        SELECT COUNT(*) as TOTAL FROM usagers WHERE date_naissance < DATE_SUB(curdate(), INTERVAL 25 YEAR) AND  date_naissance > DATE_SUB(curdate(), INTERVAL 50 YEAR) AND civilite ="Mme"')->fetchColumn();
                $entre25Et50F = round($reqEntre25Et50F/ $nbUsagers*100,2);

                //hommes entre 25 et 50 ans
                 $reqEntre25Et50H = $linkpdo->query('
                        SELECT COUNT(*) as TOTAL FROM usagers WHERE date_naissance < DATE_SUB(curdate(), INTERVAL 25 YEAR) AND  date_naissance > DATE_SUB(curdate(), INTERVAL 50 YEAR) AND civilite ="Mr"')->fetchColumn();
                $entre25Et50H = round($reqEntre25Et50H/ $nbUsagers*100,2);

            ?>




                <h4> Répartition des usagers </h4>
                <table>
                            <tr>
                                <th> Tranche d'âge </th>
                                <th> Nb Hommes </th> 
                                <th> Nb femmes </th>
                            </tr>
                            <tr>
                                <td> Moins de 25 ans </td>
                                <td class="valeur"> <?php echo $moinsDe25H.' %'; ?></td> 
                                <td class="valeur"> <?php echo $moinsDe25F.' %'; ?></td>
                            </tr>
                            <tr>
                                <td> Entre 25 et 50 ans </td>
                                <td class="valeur"> <?php echo $entre25Et50H.' %'; ?> </td> 
                                <td class="valeur"> <?php echo $entre25Et50F.' %'; ?> </td>
                            </tr>
                            <tr>
                                <td> Plus de 50 ans </td>
                                <td class="valeur"> <?php echo $plusDe50H.' %'; ?> </td> 
                                <td class="valeur"> <?php echo  $plusDe50F.' %'; ?> </td>
                            </tr>
                </table> <br>               

                 <h4> Durée totale des consultations effectuées par chaque médecin  </h4>
                <table>
                    <tr>
                        <th> Nom du médecin </th>
                        <th> Durée de ses consultations</th>
                    </tr>

                <?php

                    $reqMed = $linkpdo->prepare('SELECT DISTINCT id_medecin FROM CONSULTATIONS');
                    $reqMed->execute();
                    while($consultations = $reqMed->fetch()){
                        echo '<tr>';

                        $reqH = $linkpdo->prepare('SELECT * FROM CONSULTATIONS where id_medecin = :id_medecin');
                        $reqH->execute(array('id_medecin'=>$consultations['id_medecin'] ));
                        $nb = 0;
                        while($heuresConsult = $reqH->fetch()){

                            $heure_debut = strtotime($heuresConsult['heure_debut']) ;
                            $heure_fin = strtotime($heuresConsult['heure_fin']);
                            
                            $interval = $heure_fin - $heure_debut;
                            $nb+=$interval;

                            
                        }
                        $reqMedNomMedecin= $linkpdo->prepare('SELECT * FROM MEDECINS WHERE id_medecin = :id_medecin');
                        $reqMedNomMedecin->execute(array('id_medecin'=>$consultations['id_medecin'] ));
                        $nomMedecin = $reqMedNomMedecin->fetch();

                        echo '<td>'. $nomMedecin['nom'].' '.$nomMedecin['prenom'].'</td>';
                        echo '<td> '.date('H:i:s', $nb).'</td>';
                        echo '<tr>';
                    }
                 ?>
                 </table>
            </div>

        </section>
</div>




</body>

</html>

