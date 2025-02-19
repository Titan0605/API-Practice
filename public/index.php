<main>
    <?php
        // header("Content-Type: application/json");
        // header("Accept-Charset: UTF-8");
        // header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        include "../src/models/videogameModel.php";
        
            // $data = "videogames.json"; // JSON file containing videogames data
            $server = $_SERVER["REQUEST_METHOD"]; // Get the request method (GET, POST, PUT, DELETE)
            $videogameModel = new VideogameModel();
            
            // Handle different request methods
            switch($server){
                case "GET":

                    $games = $videogameModel -> getVideogames();
                    echo json_encode($games);
 
                    break;
                case "POST":
                    // Handle POST request
                    // $nombre = $_POST['tittle'];
                    // $developer = $_POST['developer'];
                    // $precio = $_POST['price'];

                    // $insert = "INSERT INTO videojuegos (titulo, desarrollador, precio_valor) VALUES (:name , :developer, :price)";
                    // $respuest = $conn -> prepare($insert);
                    // $respuest -> execute([
                    //     'name' => $nombre,    
                    //     'developer' => $developer,
                    //     'price' => $precio,
                    // ]); // Execute the query
                    
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