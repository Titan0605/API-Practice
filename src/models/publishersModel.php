<?php
    require_once "../src/config/db.php";
    require_once "../src/controllers/apiController.php";


    class PublisherModel {
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getPublishers() { //getting all the publishers in the database
            $query = "SELECT * FROM tpublishers WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                APIResponse::serverError("Error in SELECT" . $e -> getMessage());
            }
        }

        public function getPublisherWithId (int $id) { //getting only one publisher in the database with the id
            $query = "SELECT publisher_name FROM tpublishers WHERE id_publisher = :id AND active = 1";
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

        public function insertPublisher($publisherName) { //inserting a new publisher en the database and returning the last id
            $query = "INSERT INTO tpublishers (publisher_name) VALUES (:name)";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'name' => $publisherName
                ]);

                $newpublisherId = $this -> conn -> lastInsertId();
                
                if (!$newpublisherId) {
                    throw new PDOException("Failed to get the new developer ID");
                }
                
                return $newpublisherId;
            } catch(PDOException $e) {
                APIResponse::serverError("Error in INSERT" . $e -> getMessage());
            }
        }
    }
?>