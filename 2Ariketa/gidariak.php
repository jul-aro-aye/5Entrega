<?php

// Datu basearekin egiteko konexioa egingo duen fitxategira deitzen du
require_once("../db.php");

// akzioa lortugidariak balioa badu exekutatzen den kodea
if ($_GET["akzioa"] == "lortugidariak") {

    // Datu-basearekin konektatzeko funtzioa exekutatzen du
    $conn = konexioaSortu();

    // kontsulta gidarien egoera lortzeko postu bidez ordenatuta
    $sql = "SELECT Postua, Dortsala, Izena FROM gidariak ORDER BY Postua";
    // SQL kontsulta exekutatzen du
    $result = $conn->query($sql);

    // Gidariak izeneko array bat sortu da datuak gordetzeko
    $gidariak = [];

    // Kontsultak emaitzak baditu exekutatzen den kodea
    if ($result->num_rows > 0) {
        // Kontagailu bat sortzen da defektuz 0 balioarekin
        $counter = 0;
        // Bukle bat erantzunak dauden bitartean exekutatuko dena
        while ($row = $result->fetch_assoc()) {
            // gidariaren datuak array batean gordetzen ditu
            $gidariak[$counter] = ["postua" => $row["Postua"], "dortsala" => $row["Dortsala"], "izena" => $row["Izena"]];
            // Kontagailuari gehitzen joaten da emaitza bakoitzeko
            $counter++;
        }

        // Erantzuk kopurua herriaren arrayaren atributu batean gordetzen du
        $gidariak["kopurua"] = $counter;
        // gidariak arraya JSON formatuan bidaltzen du
        echo json_encode($gidariak);
        // Prozesua amaitzen du
        die;
    } else { // Kondizioa betetzen ez denean exekutatuko den kodea
        // Ez badago gidaririk, kopurua 0 da.
        $gidariak["kopurua"] = 0;
        // gidariak arraya JSON formatuan bidaltzen du
        echo json_encode($gidariak);
        // Prozesua amaitzen du
        die;
    }

}
?>