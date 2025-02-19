<?php
    include "../config/db.php";

    class GenderModel {
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getGenders() {
            $query = "SELECT gender_description FROM tgenders WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error in SELECT" . $e -> getMessage();
            }
        }

        public function insertGender($genderDescription) {
            $query = "INSERT INTO tgenders (gender_description) VALUES (:description)";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'description' => $genderDescription
                ]);
            } catch(PDOException $e) {
                echo "Error in INSERT: " . $e -> getMessage();
            }
        }

        public function getGenderWithId ($id) {
            $query = "SELECT gender_description FROM tgenders WHERE id_developer = :id AND active = 1";
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