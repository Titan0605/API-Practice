<?php
    include "../src/models/videogameModel.php";
    require_once "../src/controllers/apiController.php";

    class VideogameController { //controller to se if the user wants to manipulate all the data or only one register
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

#PRIVATE FUNCTIONS TO CALL IN THE PUBLIC FUNCTION
        private function processVideogame(string $method, string $id) { // private function to proccess only one register with the id, it will do GET, PUT and DELETE
            switch($method) {
                case "GET":
                    APIResponse::success($this -> videogameModel -> getVideogameWithId($id));
                    break;

                case "PUT":
                    $data = json_decode(file_get_contents("php://input"), true);
                        
                    if ($data) {
                        $updated = $this -> videogameModel -> updateVideogame(
                            $id,
                            $data['tittle'],
                            $data['developer'],
                            $data['publisher'],
                            $data['release_date'],
                            $data['price'],
                            $data['duration'],
                            $data['difficulty'],
                            $data['genders'],
                            $data['platforms']
                        );
            
                        if ($updated) {
                            APIResponse::success(['message' => 'Game updated successfully']);
                        } else {
                            APIResponse::badRequest('Game update failed or no changes were made');
                        }
                    } else {
                        APIResponse::badRequest('Invalid data provided');
                    }
                break;

                case "DELETE":
                    $deleted = $this -> videogameModel -> deleteVideogame($id);
        
                    if ($deleted) {
                        APIResponse::success(['message' => 'Game deleted successfully']);
                    } else {
                        APIResponse::badRequest('Game deletion failed or not found');
                    }
                    break;
            }
        }

        private function processVideogames(string $method) { //private function to proceess al the data in the database, and it can do a GET and a POST
            switch($method) {
                case "GET":
                    APIResponse::success($this -> videogameModel -> getVideogames());
                    break;

                case "POST":
                    $data = json_decode(file_get_contents("php://input"), true);
        
                    if ($data) {
                        $result = $this -> videogameModel -> insertVideogame(
                            $data['tittle'], //String
                            $data['developer'], //String
                            $data['publisher'], //String
                            $data['release_date'], //String
                            $data['price'], //Float
                            $data['duration'], //Int
                            $data['difficulty'], //Int
                            $data['genders'], //Array
                            $data['platforms'] //Array
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