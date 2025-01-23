<?php

require_once("../db.php");

if ($_GET["akzioa"] == "lortugidariak") {

    $conn = konexioaSortu();

    $sql = "SELECT Postua, Dortsala, Izena FROM 8ataza Order by Postua";
    $result = $conn->query($sql);
    $gidariak = [];

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $gidariak[$counter] = ["postua" => $row["Postua"], "dortsala" => $row["Dortsala"], "izena" => $row["Izena"]];
            $counter++;
        }

        $gidariak["kopurua"] = $counter;
        echo json_encode($gidariak);
        die;
    } else {
        $gidariak["kopurua"] = 0;
        echo json_encode($gidariak);
        die;
    }

}
?>