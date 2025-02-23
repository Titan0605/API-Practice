<?php
    require_once "../src/config/db.php";
    require_once "../src/controllers/apiController.php";


    class GenderModel {
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getGenders() { //getting all the genders in the database
            $query = "SELECT * FROM tgenders WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                APIResponse::serverError("Error in SELECT" . $e -> getMessage());
            }
        }

        public function getGenderWithId (int $id) { //getting only one gender in the database with the id
            $query = "SELECT gender_description FROM tgenders WHERE id_gender = :id AND active = 1";
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

        public function insertGender($genderDescription) { //inserting a new gender in the database and returning the last id
            $query = "INSERT INTO tgenders (gender_description) VALUES (:description)";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'description' => $genderDescription
                ]);

                $newGenderId = $this -> conn -> lastInsertId();
                
                if (!$newGenderId) {
                    throw new PDOException("Failed to get the new developer ID");
                }
                
                return $newGenderId;
            } catch(PDOException $e) {
                APIResponse::serverError("Error in INSERT" . $e -> getMessage());
            }
        }
    }
?>