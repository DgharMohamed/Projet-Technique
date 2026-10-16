<?php
header("Content-Type: application/json; charset=utf-8");
require_once __DIR__ . "/../classes.php";
$file = __DIR__ . "/../database/offres.json";
$offres = json_decode(file_get_contents($file), true) ?: [];

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    echo json_encode($offres);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $offres ? max(array_column($offres, "id")) + 1 : 1;

    $offre = new Offre($id, $data["titre"], $data['salaire'], $data['domaine_id']);
    $offre = $offre->toArray();
    $offres[] = $offre;

    file_put_contents(
        $file,
        json_encode($offres, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
    echo json_encode($offre);
}
