<?php
    include "../config/db.php";

    class PublisherModel {
        private $conn;

        public function __construct() {
            $this -> conn = getDBConnection();
        }

        public function getPublishers() {
            $query = "SELECT publisher_name FROM tpublishers WHERE active = 1";
            try {
                $result = $this -> conn -> query($query);
                return $result -> fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error in SELECT" . $e -> getMessage();
            }
        }

        public function insertPublisher($publisherName) {
            $query = "INSERT INTO tpublishers (publisher_name) VALUES (:name)";
            try {
                $result = $this -> conn -> prepare($query);
                $result -> execute([
                    'name' => $publisherName
                ]);
            } catch(PDOException $e) {
                echo "Error in INSERT: " . $e -> getMessage();
            }
        }

        public function getPublisherWithId ($id) {
            $query = "SELECT publisher_name FROM tpublishers WHERE id_publisher = :id AND active = 1";
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