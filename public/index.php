<?php
    header("Content-Type: application/json"); //Header to say the type of content we are using (JSON)
    header("Accept-Charset: UTF-8"); //Header to accept text in "UTF-8"
    header("Access-Control-Allow-Origin: *"); //Header to lend requests form any domain (*)
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); //Header to specify the methods which the API is using
    header("Access-Control-Allow-Headers: Content-Type"); //Header to specify the headers that can be used in a request

    require "../src/controllers/videogameController.php"; // Requiring the file videogameController to get the class VideogameController()

    // Getting the parts of the URI that is used in a request, starting in index, then dividing it for each "/" and write them in an Array
    $uriParts = explode("/", $_SERVER["REQUEST_URI"]);

    //Getting the first part after index, and checking if is like "localhost/videogames", and if not sending that the URI doesn't exist
    if ($uriParts[1] != "videogames") {
        http_response_code(404); // Sending a response (404) which means that the URI wasn't find
        exit; //Stop the code in this part
    }

    $id = $uriParts[2] ?? null; //Get and save a specific id from the URI, for example: "localhost/videogames/54", and if it isn't anything in the URI it save a null

    $controller = new VideogameController(); //Making a new object with the class VideogameController()
    $controller -> processRequest($_SERVER["REQUEST_METHOD"], $id); //We call the function of the object $controller to procces a request to the API and the id that it was saved

?>