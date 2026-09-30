<?php
require_once __DIR__ . "/../classes.php";
header("Content-Type: application/json");

class GestionDomaine {
    private string $path = __DIR__ . "/../database/domaines.json";

    public function afficherDomaines() {
        echo json_encode(json_decode(file_get_contents($this->path), true));
    }

    public function addDomaine() {
        $domaines = json_decode(file_get_contents($this->path), true);
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data["nom"])) {
            $this->repondre(false, "Le nom est obligatoire");
        }

        $id = $domaines ? max(array_column($domaines, "id")) + 1 : 1;
        $domaines[] = (new Domaine($id, $data["nom"]))->toArray();

        file_put_contents($this->path, json_encode($domaines, JSON_PRETTY_PRINT));
        $this->repondre(true, "Domaine ajouté avec succès");
    }

    private function repondre(bool $success, string $message) {
        echo json_encode(["success" => $success, "message" => $message]);
        exit;
    }

    public function requestTraitement() {
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method == "GET") $this->afficherDomaines();
        if ($method == "POST") $this->addDomaine();
    }
}

(new GestionDomaine())->requestTraitement();
