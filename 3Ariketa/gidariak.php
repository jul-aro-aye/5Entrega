<?php

require_once("db.php");

if ($_GET["akzioa"] == "lortuIkasleak") {

    $conn = konexioaSortu();

    $sql = "SELECT * FROM ikasleak";
    $result = $conn->query($sql);
    $ikasleak = [];

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $ikasleak[$counter] = ["izena" => $row["izena"], "id" => $row["id"]];
            $counter++;
        }
        
        $ikasleak["kopurua"] = $counter;
        echo json_encode($ikasleak);
        die;

    } else {
        $ikasleak["kopurua"] = 0;
        echo json_encode($ikasleak);
        die;
    }

}
?>
