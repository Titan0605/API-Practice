<?php
    require_once "../config/db.php";

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
                echo "Error in SELECT" . $e -> getMessage();
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
                echo "Error in INSERT: " . $e -> getMessage();
            }
        }

        public function getDeveloperWithId ($id) {
            $query = "SELECT developer_name FROM tdevelopers WHERE id_developer = :id AND active = 1";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'id' => $id
                ]);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error in SELECT" . $e -> getMessage();
            }
        }
    }
?>