<?php


$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "db_froga";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if($_POST["izena"] != ""){
    $izena = $_POST["izena"];
    $kontsulta = "INSERT INTO ikasleak (izena) VALUES ('$izena')";
    $conn->query($kontsulta);
    echo "Datuak gorde dira";
}

?>
