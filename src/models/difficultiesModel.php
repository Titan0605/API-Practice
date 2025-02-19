<?php
    include "../config/db.php";

    class DifficultyModel {
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getdifficulties() {
            $query = "SELECT difficult_description FROM tdifficulties WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error in SELECT" . $e -> getMessage();
            }
        }

        public function insertDifficulty($difficultDescription) {
            $query = "INSERT INTO tdifficulties (difficult_description) VALUES (:description)";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'description' => $difficultDescription
                ]);
            } catch(PDOException $e) {
                echo "Error in INSERT: " . $e -> getMessage();
            }
        }

        public function getDifficultyWithId ($id) {
            $query = "SELECT difficult_description FROM tdifficulties WHERE id_difficulty = :id AND active = 1";
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