<?php

header("Content-Type: application/json");

require_once __DIR__ . "/../classes.php";

$offresFile = __DIR__ . "/../database/offres.json";

$offres = json_decode(file_get_contents($offresFile), true) ?: [];


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo json_encode($offres);
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $offres ? max(array_column($offres, "id")) + 1 : 1;

    $offre = new Offre(
        $id,
        $data["titre"],
        $data["description"] ?? "",
        (float) ($data["salaire"] ?? 0),
        (int) $data["domaine_id"]
    );

    $offres[] = $offre;

    file_put_contents($offresFile, json_encode($offres, JSON_PRETTY_PRINT));

    echo json_encode($offre);
}
