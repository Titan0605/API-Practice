<?php
    require_once "../src/config/db.php";
    require_once "../src/controllers/apiController.php";


    class DeveloperModel {
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getDevelopers() {
            $query = "SELECT developer_name FROM tdevelopers WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                APIResponse::serverError("Error in SELECT" . $e -> getMessage());
            }
        }

        public function getDeveloperWithId (int $id) {
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

        public function insertDeveloper($developerName) {
            $query = "INSERT INTO tdevelopers (developer_name) VALUES (:name)";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'name' => $developerName
                ]);
            } catch(PDOException $e) {
                APIResponse::serverError("Error in INSERT" . $e -> getMessage());
            }
        }
    }
?>