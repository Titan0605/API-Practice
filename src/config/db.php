<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "videogames";

function getDBConnection() {
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