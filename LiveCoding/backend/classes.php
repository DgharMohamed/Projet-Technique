<?php

class Domaine {
    private int $id;
    private string $nom;

    public function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function toArray() {
        return ["id" => $this->id, "nom" => $this->nom];
    }
}

class Offre {
    private int $id;
    private string $titre;
    private float $salaire;
    private int $domaine_id;

    public function __construct(int $id, string $titre, float $salaire, float $domaine_id) {
        $this->id = $id;
        $this->titre = $titre;
        $this->salaire = $salaire;
        $this->domaine_id = $domaine_id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getSalaire() {
        return $this->salaire;
    }

    public function setSalaire($salaire) {
        $this->salaire = $salaire;
    }

    public function getDomaineId() {
        return $this->domaine_id;
    }

    public function setDomaineId($domaine_id) {
        $this->domaine_id = $domaine_id;
    }

    public function toArray() {
        return ["id" => $this->id, "titre" => $this->titre,
                "salaire" => $this->salaire, "domaine_id" => $this->domaine_id];
    }
}
