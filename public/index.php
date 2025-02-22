<?php
    header("Content-Type: application/json"); //Header to say the type of content we are using (JSON)
    header("Accept-Charset: UTF-8"); //Header to accept text in "UTF-8"
    header("Access-Control-Allow-Origin: *"); //Header to lend requests form any domain (*)
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); //Header to specify the methods which the API is using
    header("Access-Control-Allow-Headers: Content-Type"); //Header to specify the headers that can be used in a request

    require_once "../src/controllers/videogameController.php"; // Requiring the file videogameController to get the class VideogameController()
    require_once "../src/controllers/apiController.php";

    // Getting the parts of the URI that is used in a request, starting in index, then dividing it for each "/" and write them in an Array
    $uriParts = explode("/", $_SERVER["REQUEST_URI"]);

    try {
        switch($uriParts[1]) {
            case '': //Checking if it's the root of the API
                APIResponse::success(null, 'Welcome to the API'); // Sending a response (200) which means that the URI was find, and welcome the user
                break;

            case 'videogames': //Checking if the endpoint is /videogames
                $id = is_numeric($uriParts[2]) ? $uriParts[2] : null; //Get and save a specific id from the URI, for example: "localhost/videogames/54", and if it isn't anything in the URI it save a null

                $videogame = new VideogameController(); //Making a new object with the class VideogameController()
                $videogame -> processRequest($_SERVER["REQUEST_METHOD"], $id); //We call the function of the object $controller to procces a request to the API and the id that it was saved
                break;

            default:
                APIResponse::notFound('Invalid API endpoint');
                break;
        }

    } catch (Exception $e) {
        APIResponse::serverError($e -> getMessage());
    }
?>