<?php 

  require "connect.php";
  if(!isset($_SESSION['id'])){
    header('Location: index.php?connect=non');   
  }

  $rdv="";
  $lienrdv="";
  $color="";

  $dat= isset($_POST['calendrier']) ? $_POST['calendrier'] : null;
  $pat= isset($_POST['choix_patient']) ? $_POST['choix_patient'] : null;
  $med= isset ($_POST['choix_medecin']) ? $_POST['choix_medecin'] : null;
  $cre= isset ($_POST['creneau']) ? $_POST['creneau'] : null;  

  if(isset($_POST['ok'])) {

             

    $date = new DateTime('0000-00-00' . $cre);
    $date->add(new DateInterval('P0Y0M0DT0H30M0S'));
    $newdate= $date->format('H:i:s') ;   

      if ($dat!=null && $pat!=null && $med!=null && $cre!=null) {
          $ajoutrdv = $linkpdo->prepare(" 
              INSERT INTO CONSULTATIONS (date_consultation, id_medecin, id_usager, heure_debut, heure_fin)     
              values (:datec, :idmed, :idusager, :heured, :heuref)");     
          $ajoutrdv->execute(array('datec'=> $dat,'idmed'=>$med, 'idusager'=>$pat, 'heured'=>$cre, 'heuref'=>$newdate));
          #var_dump($ajoutrdv);
          $rdv="Votre rendez-vous est validé "; 
          $color="ok";
          $lienrdv= '<form name="formulaire" method="POST" action="liste_consultations.php">  
                    <input type=hidden value='.$pat.' name="id_usager">
                     <input type=submit class="boutonsvalid" value="Voir " name="voir">
                     </form>';
      } else {
          $rdv="Votre rendez-vous n'a pas été validé. Veuillez indiquer un creneau, un patient, un medecin et une date pour ajouter la consultation";
          $color="ko";
      }
  }

  $patient = $linkpdo->prepare('
        SELECT * FROM USAGERS');
  $patient->execute();
  $liste_pat = $patient->fetchAll();
  #echo '<pre>';
  #print_r($liste_pat);
  #echo '</pre>';

  $medecins = $linkpdo->prepare('
        SELECT * FROM MEDECINS');
  $medecins->execute();
  $liste_med = $medecins->fetchAll();

 ?>

<!DOCTYPE html>
<html>

<head>       

   <!-- HEAD AVEC LINKS -->
  <?php include('head.html'); ?>

</head>
	
<body>
  
  	<div id="img_titre"> <img src="doctor.png" alt="" /> </div>
	<div id=titre> Doctor Planning </div>

   <div id="wrapper">
        <!-- MENU DE GAUCHE -->
        <?php include('aside.html'); ?>
        <section>
            <div class="section-title"> Sélectionnez votre rendez-vous </div>

            <div id="part">
              <div id="confirmation">
                      <div id="msgconfirmation" class="<?php echo $color; ?>"> <?php  echo " $rdv "; ?> </div>
                      <div id="lienconsultation"> <?php echo "$lienrdv"; ?> </div>
                    </div>
                <form method="post" action="consultation.php">
                    
                    <div id="patient">  
                          <label for="choix_p" id="nom_patient"> Patient </label>
                            <select name="choix_patient" id="choix_p">
                                <?php 
                                echo '<option> Sélectionnez le patient';      
                                  foreach ($liste_pat as $ligne) {   
                                     echo '<option value="' . $ligne['id_usager'] .'" ';  
                                     if ($pat && $pat === $ligne['id_usager']) {
                                       echo "selected"; 
                                     }
                                     echo '>'.$ligne['nom']." ".$ligne['prenom']; 
                                  }
                                ?>      
                            </select>
                    </div>


                    <div id="choix_med_date">
                    
                          <div id="nom_medecin"> Médecin  </div>
                              <select name="choix_medecin" id="choix_m">
                                  <option value=""> Sélectionnez le médecin </option>
                                <?php  foreach ($liste_med as $ligne) { 
                                    echo '<option value="' . $ligne['id_medecin'] . '" '; 
                                    if ($med && $med === $ligne['id_medecin']) {
                                      echo "selected"; 
                                    }
                                    echo '>' . $ligne['nom']." ". $ligne['prenom']; 
                                  }  
                                ?>
                              </select>

                        <div id="nom_calendrier"> Date  </div>
                        <input type="date" name="calendrier" id="cal" value= "<?php if($dat) echo $dat; ?>">   
                   </div>

                   <div id="creneaux">
                       <div id=dispos> Disponibilités : </div>

                          <div id="choix_heure">

                            <div id="lematin">

                              <div id="matin"> Matin </div>

                                  <label class="container"> 09:00
                                    <input type="radio" id="radio1" value="09:00:00" name="creneau">  
                                  </label>
                                  <label class="container"> 09:30
                                    <input type="radio" id="radio2" value="09:30:00" name="creneau">
                                  </label>
                                  <label class="container"> 10:00
                                    <input type="radio" id="radio3" value="10:00:00" name="creneau">
                                  </label>
                                  <label class="container"> 10:30
                                    <input type="radio" id="radio4" value="10:30:00" name="creneau">
                                  </label> 
                                   <label class="container"> 11:00
                                    <input type="radio" id="radio5" value="11:00:00" name="creneau">
                                  </label> 
                                  <label class="container"> 11:30
                                    <input type="radio" id="radio6" value="11:30:00" name="creneau">
                                  </label> 

                            </div>

                            <div id="laprem">

                               <div id="apres_midi"> Après-midi </div>
                                   <label class="container"> 14:00
                                      <input type="radio" id="radio7" value="14:00:00" name="creneau">
                                    </label> 
                                    <label class="container"> 14:30
                                      <input type="radio" id="radio8" value="14:30:00" name="creneau">
                                    </label> 
                                     <label class="container"> 15:00
                                      <input type="radio" id="radio9" value="15:00:00" name="creneau">
                                    </label> 
                                    <label class="container"> 15:30
                                      <input type="radio" id="radio10" value="15:30:00" name="creneau">
                                    </label> 
                                    <label class="container"> 16:00
                                      <input type="radio" id="radio11" value="16:00:00" name="creneau">
                                    </label> 
                                    <label class="container"> 16:30
                                      <input type="radio" id="radio12" value="16:30:00" name="creneau">
                                    </label> 

                             </div>
                        </div>   

                   </div>

                   <input type="submit" id="validation_finale" value="Valider" name="ok">
                    
                </form>

            </div>
        </section>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script type="text/javascript">
  //console.log($("#choix_p"));
  var selectpatient=$("#choix_p"); 
  var selectmedecin=$("#choix_m"); 
  var radioconsult=$("input[name='creneau']"); 
  var selectdate=$("#cal");
  console.log(radioconsult.val()); 
  console.log(selectdate.val());  
   
  selectpatient.change(function(){ 
        $.ajax({
          url:"medecin.php?id=" + selectpatient.val(), 
          success:function(data) {
          //console.log(data);
          data=JSON.parse(data); 
          //mettre le médecin référent en premier dans le select 
          selectmedecin.val(data.id_medecin);
          }
        });
  });

  selectmedecin.change(function(){
   dispos();

  });

  selectdate.change(function(){
   dispos();

  });

  function dispos (){
    radioconsult.prop("disabled", false);
    radioconsult.parent().removeClass("disab");
      $.ajax({
        url:"creneau.php?id=" + selectmedecin.val() + "&datec=" + selectdate.val(),
        success:function(data) { 
          data=JSON.parse(data);    //console.log(data);
          //pour chaque button
          $.each (radioconsult, function(c,t) {     //console : $("#selectpatient");  selectpatient.val();
            //pour chaque consultation                   //console.log(c,t);
            $.each (data, function(k,v) {
                if ($("#"+t.id).val() === v.heure_debut) {
                  $("#"+t.id).prop("disabled", "disabled");
                  $("#"+t.id).parent().addClass("disab"); 
                }
            })     

          })

        }
      }); 
}

</script>  
</body>

</html>

