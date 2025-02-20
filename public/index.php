<?php
    header("Content-Type: application/json");
    header("Accept-Charset: UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    include "../src/models/videogameModel.php";
        
        $server = $_SERVER["REQUEST_METHOD"]; // Geting the request method (GET, POST, PUT, DELETE)
        $videogameModel = new VideogameModel();
            
        // Handle different request methods
        switch($server){
            case "GET":

                $games = $videogameModel -> getVideogames();
                return json_encode($games);
 
                break;
            case "POST":
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