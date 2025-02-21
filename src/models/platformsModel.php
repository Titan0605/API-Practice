<?php
    require_once "../src/config/db.php";

    class PlatformModel {
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getPlatforms() {
            $query = "SELECT platform_name FROM tplatforms WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error in SELECT" . $e -> getMessage();
            }
        }

        public function insertPlatform($platformName) {
            $query = "INSERT INTO tplatforms (platform_name) VALUES (:name)";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'name' => $platformName
                ]);
            } catch(PDOException $e) {
                echo "Error in INSERT: " . $e -> getMessage();
            }
        }

        public function getPlatformWithId (int $id) {
            $query = "SELECT platform_name FROM tplatforms WHERE id_platform = :id AND active = 1";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'id' => $id
                ]);
                return $result -> fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error in SELECT" . $e -> getMessage();
            }
        }
    }
?>