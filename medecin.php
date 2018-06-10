<?php


require('connect.php');

if(!isset($_SESSION['id']))header('Location: index.php?connect=non');


$id = (int)$_GET["id"];

$medecins = $linkpdo->prepare("
        SELECT * FROM MEDECINS
        INNER JOIN USAGERS on USAGERS.id_medecin = MEDECINS.id_medecin       
        where id_usager=:id");
$medecins->execute(array('id'=>$id));
$med_ref = $medecins->fetchObject();
echo json_encode($med_ref);

?>