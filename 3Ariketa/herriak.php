<?php

require_once("../db.php"); // Datu basearekin egiteko konexioa egingo duen fitxategira deitzen du

if (isset($_GET["eskualdea"]) && !empty($_GET["eskualdea"])) { // eskualdea parametroa dagoela eta hutsa ez dela konprobatzen du
    $eskualdea = $_GET["eskualdea"]; // balioa aldagaiean gordetzen du
}

if ($_GET["akzioa"] == "lortuHerriak") { // akzioa lortuHerriak balioa badu exekutatzen den kodea

    $conn = konexioaSortu(); // Datu-basearekin konektatzeko funtzioa exekutatzen du

    $sql = "SELECT He.idHerriak, He.izena, He.herrialdeKodea FROM herriak He inner join herrialdeak H on H.idHerrialdeak = He.herrialdeKodea WHERE He.herrialdeKodea = $eskualdea"; // SQL kontsulta aukeratutako eskualdearen herriak erakusteko

    $result = $conn->query($sql); // SQL kontsulta exekutatzen du

    if ($result === false) { // Kontsultak errore bat duen konprobatzen du
        echo "Error en la consulta: " . $conn->error; // Errorearen mezua erakusten da.ç
        die(); // Prozesua amaitzen du
    }

    $herriak = []; // herriak izeneko array bat sortu da datuak gordetzeko

    if ($result->num_rows > 0) { // Kontsultak emaitzak baditu exekutatzen den kodea
        $counter = 0; // Kontagailu bat sortzen da defektuz 0 balioarekin

        while ($row = $result->fetch_assoc()) { // Bukle bat erantzunak dauden bitartean exekutatuko dena
            $herriak[$counter] = ["id" => $row["idHerriak"], "izena" => $row["izena"], "herrialdeKodea" => $row["herrialdeKodea"]]; // Herriaren datuak array batean gordetzen ditu
            $counter++; // Kontagailuari gehitzen joaten da emaitza bakoitzeko
        }

        $herriak["kopurua"] = $counter; // Erantzuk kopurua herriaren arrayaren atributu batean gordetzen du
        echo json_encode($herriak); // herriak arraya JSON formatuan bidaltzen du
        die; // Prozesua amaitzen du

    } else { // Kondizioa betetzen ez denean exekutatuko den kodea
        $herriak["kopurua"] = 0; // herriak arrayan kopurua 0 izango da
        echo json_encode($herriak); // herriak arraya JSON formatuan bidaltzen du
        die; // Prozesua amaitzen du
    }
}
?>