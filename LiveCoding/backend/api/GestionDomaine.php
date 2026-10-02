<?php

header("Content-Type: application/json");

require_once __DIR__ . "/../classes.php";

$file = __DIR__ . "/../database/domaines.json";

$domaines = json_decode(file_get_contents($file), true) ?: [];


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo json_encode($domaines);
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $domaines ? max(array_column($domaines, "id")) + 1 : 1;

    $domaine = new Domaine($id, $data["nom"]);

    $domaines[] = $domaine;

    file_put_contents($file, json_encode($domaines, JSON_PRETTY_PRINT));

    echo json_encode($domaine);
}
