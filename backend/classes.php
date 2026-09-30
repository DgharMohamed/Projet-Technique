<?php
class Domaine {
    public int $id;
    public string $nom;

    public function __construct(int $id, string $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function toArray(): array {
        return ["id" => $this->id, "nom" => $this->nom];
    }
}

class Offre {
    public int $id;
    public string $titre;
    public string $description;
    public float $salaire;
    public Domaine $domaine;

    public function __construct(int $id, string $titre, string $description, float $salaire, Domaine $domaine) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->salaire = $salaire;
        $this->domaine = $domaine;
    }


    
    public function toArray(): array {
        return [
            "id" => $this->id,
            "titre" => $this->titre,
            "description" => $this->description,
            "salaire" => $this->salaire,
            "domaine_id" => $this->domaine->id
        ];
    }
}
