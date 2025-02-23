<?php

use LDAP\Result;

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
        public function insertVideogame($tittle, $developer, $publisher, $release_date, $price, $duration, $id_difficulty, $genders, $platforms) {
            try {
                // Queries
                $insert_videogame = "INSERT INTO tvideogames (tittle, id_developer, id_publisher, release_date, price, time_to_finish, id_difficulty)
                                    VALUES (:tittle, :id_developer, :id_publisher, :release_date, :price, :time_to_finish, :id_difficulty)";
        
                $insert_videogame_genders = "INSERT INTO tgame_genders (id_videogame, id_gender) VALUES (:id_videogame, :id_gender)";
                $insert_videogame_platforms = "INSERT INTO tgame_platforms (id_videogame, id_platform) VALUES (:id_videogame, :id_platform)";
        
                // Get existing records
                $existentDevelopers = $this -> developerModel -> getDevelopers();
                $existentPublishers = $this -> publisherModel -> getPublishers();
                $existentGenders = $this -> genderModel -> getGenders();
                $existentPlatforms = $this -> platformModel -> getPlatforms();
        
                // Find or create developer
                $id_developer = null;
                foreach($existentDevelopers as $existentDeveloper) {
                    if (strtolower($existentDeveloper['developer_name']) == strtolower($developer)) {
                        $id_developer = $existentDeveloper['id_developer'];
                        break;
                    }
                }
                if ($id_developer === null) {
                    $id_developer = $this -> developerModel -> insertDeveloper($developer);
                }
        
                // Find or create publisher
                $id_publisher = null;
                foreach($existentPublishers as $existentPublisher) {
                    if (strtolower($existentPublisher['publisher_name']) == strtolower($publisher)) {
                        $id_publisher = $existentPublisher['id_publisher'];
                        break;
                    }
                }
                if ($id_publisher === null) {
                    $id_publisher = $this -> publisherModel -> insertPublisher($publisher);
                }
        
                // Insert videogame
                $insertExecution = $this -> conn ->prepare($insert_videogame);
                $insertExecution -> execute([
                    'tittle' => $tittle, 
                    'id_developer' => $id_developer,
                    'id_publisher' => $id_publisher,
                    'release_date' => $release_date,
                    'price' => $price,
                    'time_to_finish' => $duration,
                    'id_difficulty' => $id_difficulty
                ]);
        
                // Get the last inserted ID
                $gameId = $this -> conn ->lastInsertId();
        
                // Process genders
                foreach($genders as $gender) {
                    $id_gender = null;
                    foreach($existentGenders as $existentGender) {
                        if (strtolower($existentGender['gender_description']) == strtolower($gender)) {
                            $id_gender = $existentGender['id_gender'];
                            break;
                        }
                    }
                    if ($id_gender === null) {
                        $id_gender = $this -> genderModel -> insertGender($gender);
                    }
                    
                    $insertGender = $this -> conn -> prepare($insert_videogame_genders);
                    $insertGender->execute([
                        'id_videogame' => $gameId,
                        'id_gender' => $id_gender
                    ]);
                }
        
                // Process platforms
                foreach($platforms as $platform) {
                    $id_platform = null;
                    foreach($existentPlatforms as $existentPlatform) {
                        if (strtolower($existentPlatform['platform_name']) == strtolower($platform)) {
                            $id_platform = $existentPlatform['id_platform'];
                            break;
                        }
                    }
                    if ($id_platform === null) {
                        $id_platform = $this -> platformModel -> insertPlatform($platform);
                    }
                    
                    $insertPlatform = $this -> conn -> prepare($insert_videogame_platforms);
                    $insertPlatform->execute([
                        'id_videogame' => $gameId,
                        'id_platform' => $id_platform
                    ]);
                }
        
                return $gameId;
        
            } catch(PDOException $e) {
                APIResponse::serverError("Error inserting the game: " . $e->getMessage());
            }
        }

        public function updateVideogame($id, $tittle, $developer, $publisher, $release_date, $price, $duration, $id_difficulty, $genders, $platforms) {
            try {
                $deleteVideogameGenders = "DELETE FROM tgame_genders WHERE id_videogame = :id";
                $deleteVideogamePlatforms = "DELETE FROM tgame_platforms WHERE id_videogame = :id";
                $insert_videogame_genders = "INSERT INTO tgame_genders (id_videogame, id_gender) VALUES (:id_videogame, :id_gender)";
                $insert_videogame_platforms = "INSERT INTO tgame_platforms (id_videogame, id_platform) VALUES (:id_videogame, :id_platform)";
                // Verificar si el videojuego existe
                $existingGame = $this -> getVideogameWithId($id);
                if (!$existingGame) {
                    APIResponse::notFound("Game with ID $id not found");
                    return false;
                }

                // Get existing records
                $existentDevelopers = $this -> developerModel -> getDevelopers();
                $existentPublishers = $this -> publisherModel -> getPublishers();
                $existentGenders = $this -> genderModel -> getGenders();
                $existentPlatforms = $this -> platformModel -> getPlatforms();

                // Find or create developer
                $id_developer = null;
                foreach($existentDevelopers as $existentDeveloper) {
                    if (strtolower($existentDeveloper['developer_name']) == strtolower($developer)) {
                        $id_developer = $existentDeveloper['id_developer'];
                        break;
                    }
                }
                if ($id_developer === null) {
                    $id_developer = $this -> developerModel -> insertDeveloper($developer);
                }
        
                // Find or create publisher
                $id_publisher = null;
                foreach($existentPublishers as $existentPublisher) {
                    if (strtolower($existentPublisher['publisher_name']) == strtolower($publisher)) {
                        $id_publisher = $existentPublisher['id_publisher'];
                        break;
                    }
                }
                if ($id_publisher === null) {
                    $id_publisher = $this -> publisherModel -> insertPublisher($publisher);
                }
        
                // Actualizar la tabla principal
                $updateGameQuery = "UPDATE tvideogames SET 
                    tittle = :tittle,
                    id_developer = :id_developer,
                    id_publisher = :id_publisher,
                    release_date = :release_date,
                    price = :price,
                    time_to_finish = :time_to_finish,
                    id_difficulty = :id_difficulty
                    WHERE id_videogame = :id";
        
                $updateGame = $this->conn->prepare($updateGameQuery);
                $updateGame->execute([
                    'tittle' => $tittle,
                    'id_developer' => $id_developer,
                    'id_publisher' => $id_publisher,
                    'release_date' => $release_date,
                    'price' => $price,
                    'time_to_finish' => $duration,
                    'id_difficulty' => $id_difficulty,
                    'id' => $id
                ]);
                

                foreach($genders as $gender) {
                    $id_gender = null;
                    foreach($existentGenders as $existentGender) {
                        if (strtolower($existentGender['gender_description']) == strtolower($gender)) {
                            $id_gender = $existentGender['id_gender'];
                            break;
                        }
                    }
                    if ($id_gender === null) {
                        $id_gender = $this -> genderModel -> insertGender($gender);
                    }
                    
                    $deleteGenders = $this -> conn -> prepare($deleteVideogameGenders);
                    $deleteGenders -> execute([
                        'id' => $id
                    ]);

                    $insertGender = $this -> conn -> prepare($insert_videogame_genders);
                    $insertGender->execute([
                        'id_videogame' => $id,
                        'id_gender' => $id_gender
                    ]);
                }
                
                foreach($platforms as $platform) {
                    $id_platform = null;
                    foreach($existentPlatforms as $existentPlatform) {
                        if (strtolower($existentPlatform['platform_name']) == strtolower($platform)) {
                            $id_platform = $existentPlatform['id_platform'];
                            break;
                        }
                    }
                    if ($id_platform === null) {
                        $id_platform = $this -> platformModel -> insertPlatform($platform);
                    }
                    
                    $deletePlatforms = $this -> conn -> prepare($deleteVideogamePlatforms);
                    $deletePlatforms -> execute([
                        'id' => $id
                    ]);

                    $insertPlatform = $this -> conn -> prepare($insert_videogame_platforms);
                    $insertPlatform->execute([
                        'id_videogame' => $id,
                        'id_platform' => $id_platform
                    ]);
                }

                return true;
            } catch (PDOException $e) {
                APIResponse::serverError("Error updating game: " . $e->getMessage());
                return false;
            }
        }

        public function deleteVideogame($id) {
            $query = "UPDATE tvideogames SET active = 0 WHERE id_videogame = :id";
            $stmt = $this-> conn ->prepare($query);
            return $stmt->execute([
                'id' => $id
            ]);
        }
    }
?>