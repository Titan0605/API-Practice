<?php
    require_once "../src/config/db.php";
    require_once "../src/controllers/apiController.php";


    class PlatformModel {
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getPlatforms() { //getting all the platforms in the database
            $query = "SELECT * FROM tplatforms WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                APIResponse::serverError("Error in SELECT" . $e -> getMessage());
            }
        }

        public function getPlatformWithId (int $id) { //getting only one platform in the database with the id
            $query = "SELECT platform_name FROM tplatforms WHERE id_platform = :id AND active = 1";
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

        public function insertPlatform($platformName) { //inserting a new platform in the database and returning the last id
            $query = "INSERT INTO tplatforms (platform_name) VALUES (:name)";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'name' => $platformName
                ]);

                $newPlatformId = $this -> conn -> lastInsertId();
                
                if (!$newPlatformId) {
                    throw new PDOException("Failed to get the new developer ID");
                }
                
                return $newPlatformId;
            } catch(PDOException $e) {
                APIResponse::serverError("Error in INSERT" . $e -> getMessage());
            }
        }
    }
?>