<?php
    include "../src/models/videogameModel.php";
    require_once "../src/controllers/apiController.php";

    class VideogameController {
        private $videogameModel;

        public function __construct() {
            $this -> videogameModel = new VideogameModel();
        }

        public function processRequest(string $method, ?string $id) {
            if ($id) {
                $this -> processVideogame($method, $id);
            } else {
                $this -> processVideogames($method);
            }
        }

#PRIVATE FUNCTIONS TO CALL IN THE PUBLIC FUNCTIONS
        private function processVideogame(string $method, string $id) {
            switch($method) {
                case "GET":
                    APIResponse::success($this -> videogameModel -> getVideogameWithId($id));
                    break;
            }
        }

        private function processVideogames(string $method) {
            switch($method) {
                case "GET":
                    APIResponse::success($this -> videogameModel -> getVideogames());
                    break;

                case "POST":
                    $data = json_decode(file_get_contents("php://input"), true);
        
                    if ($data) {
                        $result = $this -> videogameModel -> insertVideogame(
                            $data['tittle'],
                            $data['id_developer'],
                            $data['id_publisher'],
                            $data['release_date'],
                            $data['price'],
                            $data['time_to_finish'],
                            $data['id_difficulty'],
                            $data['genders'],
                            $data['platforms']
                        );
                        
                        $NewVideogameId['id_videogame'] = $result;

                        APIResponse::created($NewVideogameId ,'Game created successfully');
                    } else {
                        APIResponse::badRequest('Invalid data provided');
                    }
                    break;
            }
        }
    }
?>