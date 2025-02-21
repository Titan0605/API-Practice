<?php
$servername = "localhost"; //Save the name of the server
$username = "root"; //Save the user to the DB
$password = ""; //Save the password to the user saved before
$db_name = "videogames"; //Save the name of the DB

function getDBConnection() { //Function to try to make a connection to the database and return the object PDO to use it
  global $servername, $username, $password, $db_name;
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    return $conn;
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return null;
  }
}
?>