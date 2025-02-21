<?php
    require_once "../src/config/db.php";
    require_once "../src/models/developersModel.php";
    require_once "../src/models/difficultiesModel.php";
    require_once "../src/models/gendersModel.php";
    require_once "../src/models/platformsModel.php";
    require_once "../src/models/publishersModel.php";

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
            $selectVideogames = "SELECT * FROM tvideogames WHERE active = 1";
            $result = $this -> conn -> query($selectVideogames);
            $games = $result -> fetchAll(PDO::FETCH_ASSOC);
            $gamesWithAllInfo = [];

            foreach($games as $game) {
                try {
                    $gameId = $game['id_videogame'];
                    $developer = $this -> developerModel -> getDeveloperWithId($game['id_developer']);
                    $publisher = $this -> publisherModel -> getPublisherWithId($game['id_publisher']);
                    $difficulty = $this -> difficultyModel -> getDifficultyWithId($game['id_difficulty']);
                    $genders = [];
                    $platforms = [];

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
                            $gender = $this -> genderModel -> getGenderWithId($genderId['id_gender']);
                            $genders[] = $gender['gender_description'];
                        } catch (Exception $e) {
                            return ['success' => false, 'message' => "Error in SELECT: " , $e -> getMessage()];
                        }
                    }

                    foreach($platformsIds as $platformId){
                        try {
                            $platform = $this -> platformModel -> getPlatformWithId($platformId['id_platform']);
                            $platforms[] = $platform['platform_name'];
                        } catch (Exception $e) {
                            return ['success' => false, 'message' => "Error in SELECT: " , $e -> getMessage()];
                        }
                    }

                    $game['developer'] = $developer['developer_name'];
                    $game['publisher'] = $publisher['publisher_name'];
                    $game['difficulty'] = $difficulty['difficult_description'];
                    $game['genders'] = $genders;
                    $game['platforms'] = $platforms;

                    $gamesWithAllInfo[] = $game;
                } catch (Exception $e) {
                    return ['success' => false, 'message' => "Error processing game ID {$gameId}: " . $e -> getMessage()];
                }
            }

            if($gamesWithAllInfo === []){
                return ['success' => false, 'message' => "There is no data"];
            } else {
                return $gamesWithAllInfo;
            }
            
        }

        public function getVideogameWithId(int $id) {
            $select_videogame_genders = "SELECT id_gender FROM tgame_genders WHERE id_videogame = :id AND active = 1";
            $select_videogame_platforms = "SELECT id_platform FROM tgame_platforms WHERE id_videogame = :id AND active = 1";
            $select_videogame = "SELECT * FROM tvideogames WHERE id_videogame = :id AND active = 1";

            $result = $this -> conn -> prepare($select_videogame);
            $result -> execute([
                'id' => $id
            ]);

            $game = $result -> fetch(PDO::FETCH_ASSOC);
            $gamesWithAllInfo = [];

            if ($game){
                try {
                    var_dump($game);
                    $gameId = $game['id_videogame'];
                    $developer = $this -> developerModel -> getDeveloperWithId($game['id_developer']);
                    $publisher = $this -> publisherModel -> getPublisherWithId($game['id_publisher']);
                    $difficulty = $this -> difficultyModel -> getDifficultyWithId($game['id_difficulty']);
                    $genders = [];
                    $platforms = [];

                    $gendersIds = $this -> conn -> prepare($select_videogame_genders);
                    $gendersIds -> execute([
                        'id' => $id
                    ]);

                    $platformsIds = $this -> conn -> prepare($select_videogame_platforms);
                    $platformsIds -> execute([
                        'id' => $id
                    ]);
                    
                    foreach($gendersIds as $genderId){
                        try {
                            $gender = $this -> genderModel -> getGenderWithId($genderId['id_gender']);
                            $genders[] = $gender['gender_description'];
                        } catch (Exception $e) {
                            return ['success' => false, 'message' => "Error in SELECT: " , $e -> getMessage()];
                        }
                    }

                    foreach($platformsIds as $platformId){
                        try {
                            $platform = $this -> platformModel -> getPlatformWithId($platformId['id_platform']);
                            $platforms[] = $platform['platform_name'];
                        } catch (Exception $e) {
                            return ['success' => false, 'message' => "Error in SELECT: " , $e -> getMessage()];
                        }
                    }

                    $game['developer'] = $developer['developer_name'];
                    $game['publisher'] = $publisher['publisher_name'];
                    $game['difficulty'] = $difficulty['difficult_description'];
                    $game['genders'] = $genders;
                    $game['platforms'] = $platforms;

                    $gamesWithAllInfo[] = $game;
                } catch (Exception $e) {
                    return ['success' => false, 'message' => "Error processing game ID {$gameId}: " . $e -> getMessage()];
                }

                if($gamesWithAllInfo === []){
                    return ['success' => false, 'message' => "There is no data"];
                } else {
                    return $gamesWithAllInfo;
                }

            } else {
                return ['success' => false, 'message' => "There is no videogame with the id: $id"];
            }
        }
        
        //PENDENT FUNCTION TO INSERT A VIDEOGAME (NEED FIRST FUNCTION FORM THE OTHER TABLES)
        public function insertVideogame($tittle, $id_developer, $id_publisher, $release_date, $price, $time_to_finish, $id_difficulty, $genders, $platforms) {
            try {
                $insert_videogame = "INSERT INTO tvideogames (tittle, id_developer, id_publisher, release_date, price, time_to_finish, id_difficulty)
                                    VALUES (:tittle, :id_developer, :id_publisher, :release_date, :price, :time_to_finish, :id_difficulty)";
                                    
                $insert_videogame_genders = "INSERT INTO tgame_genders (id_videogame, id_gender) VALUES (:id_videogame, :id_gender)";



                $queryExecution = $this -> conn -> prepare($insert_videogame);
                $queryExecution -> execute([
                    'tittle' => $tittle, 
                    'id_developer' => $id_developer,
                    'id_publisher' => $id_publisher,
                    'release_date' => $release_date,
                    'price' => $price,
                    'time_to_finish' => $time_to_finish,
                    'id_difficulty' => $id_difficulty
                ]);
                
                
            } catch(PDOException $e) {
                return ['success' => false, 'message' => "Error inserting the game: " . $e -> getMessage()];
            }
        }

        public function updateVideogame(int $id) {

        }

        public function deleteVideogame(int $id) {
            
        }
    }
?>