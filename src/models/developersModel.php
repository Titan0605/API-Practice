<?php
    require_once "../src/config/db.php";
    require_once "../src/controllers/apiController.php";


    class DeveloperModel { // class model to interact with the database
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getDevelopers() { //getting all the developers in the database
            $query = "SELECT * FROM tdevelopers WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                APIResponse::serverError("Error in SELECT" . $e -> getMessage());
            }
        }

        public function getDeveloperWithId (int $id) { //getting only one developer in the database with the id
            $query = "SELECT developer_name FROM tdevelopers WHERE id_developer = :id AND active = 1";
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

        public function insertDeveloper($developerName) { //inserting a new developer in the database and returning the last id
            try {
                $query = "INSERT INTO tdevelopers (developer_name) VALUES (:name)";
                
                $result = $this->conn->prepare($query);
                $result->execute([
                    'name' => $developerName
                ]);
                
                // get the last id of the previuous insert with lastInsertId()
                $newDeveloperId = $this -> conn -> lastInsertId();
                
                if (!$newDeveloperId) {
                    throw new PDOException("Failed to get the new developer ID");
                }
                
                return $newDeveloperId;
                
            } catch(PDOException $e) {
                throw new PDOException("Error inserting developer: " . $e->getMessage());
            }
        }
    }
?>