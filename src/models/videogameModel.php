<?php
    require_once "../src/config/db.php";
    require_once "../src/models/developersModel.php";
    require_once "../src/models/difficultiesModel.php";
    require_once "../src/models/gendersModel.php";
    require_once "../src/models/platformsModel.php";
    require_once "../src/models/publishersModel.php";
    require_once "../src/controllers/apiController.php";

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

        private function processGameData($game) {
            if (!$game) {
                return null;
            }
    
            try {
                $gameId = $game['id_videogame'];
                
                $developer = $this -> developerModel -> getDeveloperWithId($game['id_developer']);
                $publisher = $this -> publisherModel -> getPublisherWithId($game['id_publisher']);
                $difficulty = $this -> difficultyModel -> getDifficultyWithId($game['id_difficulty']);
                
                $genders = $this -> getGameGenders($gameId);
                $platforms = $this -> getGamePlatforms($gameId);
    
                return array_merge($game, [
                    'developer' => $developer['developer_name'],
                    'publisher' => $publisher['publisher_name'],
                    'difficulty' => $difficulty['difficult_description'],
                    'genders' => $genders,
                    'platforms' => $platforms,
                    'active' => (bool) $game['active']
                ]);
            } catch (Exception $e) {
                APIResponse::serverError("Error processing game ID {$gameId}: " . $e->getMessage());
                return null;
            }
        }
    
        private function getGameGenders($gameId) {
            $query = "SELECT id_gender FROM tgame_genders WHERE id_videogame = :id AND active = 1";
            $result = $this -> conn -> prepare($query);
            $result -> execute([
                'id' => $gameId
            ]);
            $genders = [];
    
            foreach ($result as $genderId) {
                try {
                    $gender = $this -> genderModel -> getGenderWithId($genderId['id_gender']);
                    $genders[] = $gender['gender_description'];
                } catch (Exception $e) {
                    APIResponse::serverError("Error in SELECT: " . $e->getMessage());
                }
            }
    
            return $genders;
        }
    
        private function getGamePlatforms($gameId) {
            $query = "SELECT id_platform FROM tgame_platforms WHERE id_videogame = :id AND active = 1";
            $result = $this -> conn -> prepare($query);
            $result -> execute([
                'id' => $gameId
            ]);
            $platforms = [];
    
            foreach ($result as $platformId) {
                try {
                    $platform = $this -> platformModel -> getPlatformWithId($platformId['id_platform']);
                    $platforms[] = $platform['platform_name'];
                } catch (Exception $e) {
                    APIResponse::serverError("Error in SELECT: " . $e->getMessage());
                }
            }
    
            return $platforms;
        }
    
        public function getVideogames() {
            $query = "SELECT * FROM tvideogames WHERE active = 1";
            $result = $this -> conn -> query($query);
            $games = $result -> fetchAll(PDO::FETCH_ASSOC);
            
            $gamesWithAllInfo = array_map(
                fn($game) => $this -> processGameData($game),
                $games
            );
    
            $gamesWithAllInfo = array_filter($gamesWithAllInfo);
    
            if (empty($gamesWithAllInfo)) {
                APIResponse::noContent("There is no data");
            }
    
            return $gamesWithAllInfo;
        }
    
        public function getVideogameWithId(int $id) {
            $query = "SELECT * FROM tvideogames WHERE id_videogame = :id AND active = 1";
            $result = $this -> conn -> prepare($query);
            $result -> execute([
                'id' => $id
            ]);
            $game = $result -> fetch(PDO::FETCH_ASSOC);
    
            if (!$game) {
                APIResponse::noContent(null, 'There is no videogame with the id: ' . $id);
            }
    
            $processedGame = $this -> processGameData($game);
            
            if (!$processedGame) {
                APIResponse::noContent("There is no data");
            }
    
            return [$processedGame];
        }
        
        //PENDENT FUNCTION TO INSERT A VIDEOGAME (NEED FIRST FUNCTION FORM THE OTHER TABLES)
        public function insertVideogame($tittle, $id_developer, $id_publisher, $release_date, $price, $time_to_finish, $id_difficulty, $idGenders, $idPlatforms) {
            try {
                //Saving all the querys the fucntion will use

                $insert_videogame = "INSERT INTO tvideogames (tittle, id_developer, id_publisher, release_date, price, time_to_finish, id_difficulty)
                                    VALUES (:tittle, :id_developer, :id_publisher, :release_date, :price, :time_to_finish, :id_difficulty)";

                $selct_videogame = "SELCT id_videogame FROM tvideogames ORDER BY id_videogame LIMIT 1";
                                    
                $insert_videogame_genders = "INSERT INTO tgame_genders (id_videogame, id_gender) VALUES (:id_videogame, :id_gender)";

                $insert_videogame_platforms = "INSERT INTO tgame_platforms (id_videogame, id_platform) VALUES (:id_videogame, :id_platform)";

                //Start the function

                $insertExecution = $this -> conn -> prepare($insert_videogame);
                $insertExecution -> execute([
                    'tittle' => $tittle, 
                    'id_developer' => $id_developer,
                    'id_publisher' => $id_publisher,
                    'release_date' => $release_date,
                    'price' => $price,
                    'time_to_finish' => $time_to_finish,
                    'id_difficulty' => $id_difficulty
                ]);

                $selectResult = $this -> conn -> query($selct_videogame);
                $selectResult -> fetch(PDO::FETCH_ASSOC);
                $gameId = $selectResult['id_videogame'];

                foreach($idGenders as $idGender){
                    $insertGender = $this -> conn -> prepare($insert_videogame_genders);
                    $insertGender -> execute([
                        'id_videogame' => $gameId,
                        'id_gender' => $idGender
                    ]);
                }

                foreach($idPlatforms as $idPlatform){
                    $insertPlatform = $this -> conn -> prepare($insert_videogame_platforms);
                    $insertPlatform -> execute([
                        'id_videogame' => $gameId,
                        'id_platform' => $idPlatform
                    ]);
                }

            } catch(PDOException $e) {
                APIResponse::serverError("Error inserting the game: " . $e -> getMessage());
            }
            return $gameId;
        }

        public function updateVideogame(int $id, $tittle, $id_developer, $id_publisher, $release_date, $price, $time_to_finish, $id_difficulty, $idGenders, $idPlatforms) {
            $updateVideogame = "UPDATE tvideogames SET ";
        }

        public function deleteVideogame(int $id) {
            
        }
    }
?>