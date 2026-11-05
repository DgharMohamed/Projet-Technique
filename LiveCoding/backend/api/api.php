<?php
ini_set('displaye_errors', 1);
ini_set("display_startup_errors" , 1);
error_reporting(E_ALL);
require_once __DIR__ ."/../controller/ControllerDomaine.php";
header("Content-Type: application/json");
$Controller = new ControllerDomaine();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    echo json_encode($Controller->listerDomaines());
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo json_encode($Controller->ajouterDomaine());
}
?>