<?php 

    require_once "../dao/DomaineDAO.php";
    require_once "BaseService.php";


    class DomaineService extends BaseService {
        public DomaineDAO $domaineDAO;

        public function __construct(){
            $this->domaineDAO = new DomaineDAO();

        }

        public function listerDomaines(){
            $domaines=$this->domaineDAO->AfficherTous();
            $data = [];
            foreach($domaines as $domaine){
                $data[]=[
                    "id"=>$domaine->getId(),
                    "nom"=>$domaine->getNom(),
                    "description"=>$domaine->getDescription()
                ];
            }
            return $data;
            
        }


        public function ajouterDomaine(){
            $input =json_decode(file_get_contents("php://input"),true);
            try{
                http_response_code(200);
                $this->domaineDAO->ajouter($input["nom"], $input["description"]);
                return ["success"=>true,"message"=>"Domaine ajouté avec success"];

            }catch(Error $e){
                http_response_code(200);
                return ["success"=>false,"message"=>$e->getMessage()];
            }
        }
    }

?>