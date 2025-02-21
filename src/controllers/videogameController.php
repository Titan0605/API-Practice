<?php
    include "../src/models/videogameModel.php";

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
                    echo json_encode($this -> videogameModel -> getVideogameWithId($id));
                    break;
            }
        }

        private function processVideogames(string $method) {
            switch($method) {
                case "GET":
                    echo json_encode($this -> videogameModel -> getVideogames());
                    break;

                case "POST":
                    $data = json_decode(file_get_contents("php://input"), true);
            }
        }
    }
?>