<?php 
    require_once "../classes/Domaine.php";

    class DomaineDAO{
        public static $dataFile = "../data/Domaines.json";

        public function AfficherTous(){
            $data = [];
            $domaines = json_decode(file_get_contents(self::$dataFile),true);
            foreach($domaines as $domaine){
                $d = new Domaine($domaine["id"], $domaine["nom"], $domaine["description"]);
                $data[] = $d;
            }
            return $data;

        }


        public function ajouter($nom,$description){
            $data = [];
            $domaines = $this->AfficherTous();
            $id= count($domaines) + 1 ;
            if(trim($nom) == "" || trim($description) == ""){
                throw new Error("tout les champs sont obligatoire");

            }
            else{
                $domaines[] = new Domaine($id, $nom, $description);
                foreach($domaines as $domaine){
                $data[]=[
                    "id"=>$domaine->getId(),
                    "nom"=>$domaine->getNom(),
                    "description"=>$domaine->getDescription()
                ];
                }
                file_put_contents(self::$dataFile,json_encode($data,JSON_PRETTY_PRINT));
            }
        }

    }


?>