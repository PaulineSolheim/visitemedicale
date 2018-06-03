<?php

require "connect.php";

$id = (int)$_GET["id"];
$datec = $_GET["datec"];

$consultations = $linkpdo->prepare("
        SELECT * FROM CONSULTATIONS
        WHERE id_medecin=:id and date_consultation=:datec");
$consultations->execute(array("id"=>$id, "datec"=>$datec));
$liste_cons = $consultations->fetchAll();
echo json_encode($liste_cons);

?>