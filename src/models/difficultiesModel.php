<?php
    require_once "../src/config/db.php";
    require_once "../src/controllers/apiController.php";


    class DifficultyModel {
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getdifficulties() { //getting all the difficulties in the database
            $query = "SELECT difficult_description FROM tdifficulties WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                APIResponse::serverError("Error in SELECT" . $e -> getMessage());
            }
        }

        public function getDifficultyWithId (int $id) { //getting only one difficulty in the database with the id
            $query = "SELECT difficult_description FROM tdifficulties WHERE id_difficulty = :id AND active = 1";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'id' => $id
                ]);
                return $result -> fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                APIResponse::serverError("Error in SELECT" . $e -> getMessage());
            }
        }

        public function insertDifficulty($difficultDescription) { //inserting a new difficulty in the database and returning the last id
            $query = "INSERT INTO tdifficulties (difficult_description) VALUES (:description)";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'description' => $difficultDescription
                ]);
            } catch(PDOException $e) {
                APIResponse::serverError("Error in INSERT" . $e -> getMessage());
            }
        }
    }
?>