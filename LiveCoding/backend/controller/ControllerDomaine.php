<?php
    require_once __DIR__ . "/../classes/GestionDomaine.php";
    class ControllerDomaine{
        private GestionDomaine $gestion;
        public function __construct(){
            $this->gestion= new GestionDomaine();
        }

        public function listerDomaines(){
            $domaines=$this->gestion->AfficherTous();
            $data=[];
            foreach($domaines as $domaine){
                $data[]=[
                    "id"=>$domaine->getId(),
                    "nom"=>$domaine->getNom(),
                    "description"=>$domaine->getDescription(),
                ];
            }
            return $data;
        }

        public function ajouterDomaine(){
            $input=json_decode(file_get_contents("php://input"),true);
            $this->gestion->ajouter($input["nom"],$input["description"]);
            return ["message"=>"Domaine ajouté avec succès"];
        }
    }
?>
