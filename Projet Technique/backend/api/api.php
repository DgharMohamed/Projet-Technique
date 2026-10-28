<?php
    require_once __DIR__ . "/../controller/ControllerDomaine.php";
    header("Content-Type: application/json");
    $methode=$_SERVER["REQUEST_METHOD"];
    $controller=new ControllerDomaine();
    if($methode=="GET"){
        echo json_encode($controller->listerDomaines());
    }
    if($methode=="POST"){
        echo json_encode($controller->ajouterDomaine());
    }
?>
