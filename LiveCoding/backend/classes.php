<?php

class Domaine
{
    public function __construct(
        public int $id,
        public string $nom
    ) {}
}

class Offre
{
    public function __construct(
        public int $id,
        public string $titre,
        public string $description,
        public float $salaire,
        public int $domaine_id
    ) {}
}
