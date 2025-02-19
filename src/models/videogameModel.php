<?php
    include "../src/config/db.php";
    require_once "../src/models";

    class VideogameModel {
        private $conn;
        private $developerModel;
        private $publisherModel;
        private $difficultyModel;
        private $genderModel;
        private $platformModel;

        public function __construct() {
            $this -> conn = getDBConnection();
            $this -> developerModel = new DeveloperModel();
            $this -> publisherModel = new PublisherModel();
            $this -> difficultyModel = new DifficultyModel();
            $this -> genderModel = new GenderModel();
            $this -> platformModel = new PlatformModel();
        }

        public function getVideogames() {
            $selectVideogameGenders = "SELECT id_gender FROM tgame_genders WHERE id_videogame = :id AND active = 1";
            $selectVideogamePlatforms = "SELECT id_platform FROM tgame_platforms WHERE id_videogame = :id AND active = 1";
            $selectVideogames = "SELECT * FROM tvideogames";
            $result = $this -> conn -> query($selectVideogames);
            $games = $result -> fetchAll(PDO::FETCH_ASSOC);

            foreach($games as $game) {
                try {
                    $gameId = $game['id_videogame'];
                    $developer = $this -> developerModel -> getDeveloperWithId($game['id_developer']);
                    $publisher = $this -> publisherModel -> getPublisherWithId($game['id_publisher']);
                    $difficulty = $this -> difficultyModel -> getDifficultyWithId($game['id_difficulty']);
                    $genders = [];
                    $platforms = [];

                    $gamesWithAllInfo = [];

                    $gendersIds = $this -> conn -> prepare($selectVideogameGenders);
                    $gendersIds -> execute([
                        'id' => $gameId
                    ]);

                    $platformsIds = $this -> conn -> prepare($selectVideogamePlatforms);
                    $platformsIds -> execute([
                        'id' => $gameId
                    ]);
                    
                    foreach($gendersIds as $genderId){
                        try {
                            $gender = $this -> genderModel -> getGenderWithId($genderId);
                            $genders[] = $gender['gender_description'];
                        } catch (Exception $e) {
                            echo "Error in SELECT: " , $e -> getMessage();
                        }
                    }

                    foreach($platformsIds as $platformId){
                        try {
                            $platform = $this -> platformModel -> getPlatformWithId($platformId);
                            $platforms[] = $platform['platform_name'];
                        } catch (Exception $e) {
                            echo "Error in SELECT: " , $e -> getMessage();
                        }
                    }

                    $game['developer'] = $developer['developer_name'];
                    $game['publisher'] = $publisher['publisher_name'];
                    $game['difficulty'] = $difficulty['difficult_description'];
                    $game['genders'] = $genders;
                    $game['platforms'] = $platforms;

                    $gamesWithAllInfo[] = $game;
                } catch (Exception $e) {
                    echo "Error processing game ID {$gameId}: " . $e -> getMessage();
                }
            }
            if($gamesWithAllInfo === []){
                echo "There are not Data";
            } else {
                return $gamesWithAllInfo;
            }
        }

        public function insertVideogame() {

        }
    }
?>