<main>
    <?php
        // header("Content-Type: application/json");
        // header("Accept-Charset: UTF-8");
        // header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

        require_once '../src/config/db.php'; // Include the database connection file
        include "../src/models/videogameModel.php";
        
        // Function to handle videogames data
        function getVideogames(){
            // $data = "videogames.json"; // JSON file containing videogames data
            $conn = getDBConnection(); // Get the database connection
            $server = $_SERVER["REQUEST_METHOD"]; // Get the request method (GET, POST, PUT, DELETE)
            $videogameModel = new VideogameModel();
            
            // Handle different request methods
            switch($server){
                case "GET":
                    // // Handle GET request
                    // $videogames = []; // Array to store videogames data
                    // $query = "SELECT * FROM tvideogames"; // SQL query to get all videogames

                    // try {
                    //     $result = $conn -> query($query); // Execute the query
                    //     foreach($result as $row){
                    //         $videogames[] = $row;
                    //     } // Fetch all rows as an associative array

                    //     if ($videogames === []){ //Return a message if there are not data
                    //         echo json_encode("There are not data");
                    //         break;
                    //     } 

                    //     echo json_encode($videogames); // Return videogames data as JSON
                    //     break;

                    // } catch(PDOException $e) {
                    //     echo "Fetch failed" . $e -> getMessage();
                    // }

                    $games = $videogameModel -> getVideogames();
                    echo json_encode($games);
                    
                case "POST":
                    // Handle POST request
                    $nombre = $_POST['tittle'];
                    $developer = $_POST['developer'];
                    $precio = $_POST['price'];

                    $insert = "INSERT INTO videojuegos (titulo, desarrollador, precio_valor) VALUES (:name , :developer, :price)";
                    $respuest = $conn -> prepare($insert);
                    $respuest -> execute([
                        'name' => $nombre,    
                        'developer' => $developer,
                        'price' => $precio,
                    ]); // Execute the query
                    
                    echo "<p>Request POST</p>";
                    break;
                case "PUT":
                    // Handle PUT request
                    echo "<p>Request PUT</p>";
                    break;
                case "DELETE":
                    // Handle DELETE request
                    echo "<p>Request DELETE</p>";
                    break;
                default:
                    // Handle unknown request method
                    echo "<p>Unknown request method</p>";
                    break;
            }
        }
    
        // Call the function to handle videogames data
        getVideogames();
    ?>
</main>
<!-- <h1>
    < echo "Hello World";?>
</h1> --TESTING-- -->

<style>
    body{
        display: grid;
        place-content: center;
    }
</style>