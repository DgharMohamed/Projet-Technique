<?php
require_once __DIR__ . "/../classes.php";
header("Content-Type: application/json");

class GestionOffre {
    private string $pathOffres = __DIR__ . "/../database/offres.json";
    private string $pathDomaines = __DIR__ . "/../database/domaines.json";

    public function afficherOffres() {
        echo json_encode(json_decode(file_get_contents($this->pathOffres), true));
    }

    public function addOffre() {
        $offres = json_decode(file_get_contents($this->pathOffres), true);
        $data = json_decode(file_get_contents("php://input"), true);
        $domaine = $this->trouverDomaine($data["domaine_id"] ?? 0);

        if (empty($data["titre"])) {
            $this->repondre(false, "Le titre est obligatoire");
        }
        if ($domaine == null) {
            $this->repondre(false, "Le domaine n'existe pas");
        }

        $id = $offres ? max(array_column($offres, "id")) + 1 : 1;
        $offres[] = (new Offre($id, $data["titre"], $data["description"], (float) $data["salaire"], $domaine))->toArray();

        file_put_contents($this->pathOffres, json_encode($offres, JSON_PRETTY_PRINT));
        $this->repondre(true, "Offre ajoutée avec succès");
    }

    public function deleteOffre() {
        $offres = json_decode(file_get_contents($this->pathOffres), true);

        foreach ($offres as $i => $offre) {
            if ($offre["id"] == $_GET["id"]) {
                unset($offres[$i]);
                file_put_contents($this->pathOffres, json_encode(array_values($offres), JSON_PRETTY_PRINT));
                $this->repondre(true, "Offre supprimée avec succès");
            }
        }

        $this->repondre(false, "Offre introuvable");
    }

    private function trouverDomaine($id): ?Domaine {
        foreach (json_decode(file_get_contents($this->pathDomaines), true) as $d) {
            if ($d["id"] == $id) return new Domaine($d["id"], $d["nom"]);
        }
        return null;
    }

    private function repondre(bool $success, string $message) {
        echo json_encode(["success" => $success, "message" => $message]);
        exit;
    }

    public function requestTraitement() {
        $method = $_SERVER["REQUEST_METHOD"];
        if ($method == "GET") $this->afficherOffres();
        if ($method == "POST") $this->addOffre();
        if ($method == "DELETE") $this->deleteOffre();
    }
}

(new GestionOffre())->requestTraitement();
