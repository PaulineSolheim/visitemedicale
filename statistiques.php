
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




            <div class="section-title"> Statistiques </div>
            <div id="part">
                <table>
                            <tr>
                                <th> Tranche d'âge </th>
                                <th> Nb Hommes </th> 
                                <th> Nb femmes </th>
                            </tr>
                            <tr>
                                <td> Moins de 25 ans </td>
                                <td> <?php echo $moinsDe25H.' %'; ?></td> 
                                <td> <?php echo $moinsDe25F.' %'; ?></td>
                            </tr>
                            <tr>
                                <td> Entre 25 et 50 ans </td>
                                <td> <?php echo $entre25Et50H.' %'; ?> </td> 
                                <td> <?php echo $entre25Et50F.' %'; ?> </td>
                            </tr>
                            <tr>
                                <td> Plus de 50 ans </td>
                                <td> <?php echo $plusDe50H.' %'; ?> </td> 
                                <td>   <?php echo  $plusDe50F.' %'; ?> </td>
                            </tr>
                </table>                




            </div>






        </section>
</div>




</body>

</html>

