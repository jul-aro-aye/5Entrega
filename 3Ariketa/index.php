<?php

// Datu basearekin egiteko konexioa egingo duen fitxategira deitzen du
require_once("../db.php");

// Datu-basearekin konektatzeko funtzioa exekutatzen du
$conn = konexioaSortu();

// kontsulta herrialdeen lista lortzeko
$herrialdeKontsulta = "SELECT idHerrialdeak, izena FROM herrialdeak";

// SQL kontsulta exekutatzen du
$result = $conn->query($herrialdeKontsulta);

?>
<!-- ilara saltoak egiten ditu -->
<br><br><br>
<form method="GET">
    <!-- barra desplegable bat sortzen du herrialdeen kontsultaren erantzunak erakusteko -->
    <select name="eskualdea" id="eskualdeak">
        <!-- Defektuz aukera hutsa erakusteko kodea -->
        <option value="" selected></option>
        <?php

        while ($row = $result->fetch_assoc()) { // bukle bat emaitzak dauden bitartean exekutatuko dena
            // errenkada bakoitzeko aukera bat sortzen da, bere id eta herrialdearekin
            echo "<option value ='" . $row["idHerrialdeak"] . "'>" . $row["idHerrialdeak"] . "- " . $row["izena"] . "</option>";
        } // Buklea amaitzen da
        ?> <!-- Php etiketa itxi du -->
    </select> <!-- Desplegablea amaitu da -->

    <!-- Barra desplegable hutsa herriari eragingo dioena -->
    <select name="herria" id="herriak">
        <!-- Defektuz aukera hutsa erakutsiko du -->
        <option value="" selected></option>
    </select> <!-- Desplegablea amaitu da -->

</form> <!-- formulari etiketa itxi da -->
<br> <!-- ilara saltoa -->

<?php // php etiketa irekitzen du

// Datu-basearekin konexioa ixteko
$conn->close(); // Konexio itxi da datu basearekin

?> <!-- php etiketa itxi du -->

<script src="https://code.jquery.com/jquery-3.7.1.js"></script> <!-- jquery liburutegiari dei egiten dio -->

<script> // Script etiketa ireki du

    $(document).ready(function () { // Dokumentua kargatzean egingo duen kodea

        // Eskualdearen balioa aldatzean egingo duen kodea
        $('#eskualdeak').on('change', function () {
            selectKargatu(); // selectKargatu funtzioari deitzen dio, desplegableak eguneratzen duena
        });

    });

    // Desplegablea birkargatzeko funtzioa
    function selectKargatu() {
        // Eskualdearen balioa aldagaiean gordetzeko
        var eskualdeaVal = $("#eskualdeak").val();

        // Eskualdearen desplegablea hutsik dagoen konprobatzeko kondizioa
        if (!eskualdeaVal) {
            $("#herriak").html("<option value='' selected></option>"); // Defektuz desplegable hutsa izango da
            return; // Funtzioa bukatzen da
        }

        // Ajax deia autatutako eskualdearen herriak automatikoki erasteko
        $.ajax({
            "url": "herriak.php",  // herriak.php fitxategira egiten du eskaera
            "method": "GET",  // Eskaera GET metodoarekin egiten da
            "data": {
                "akzioa": "lortuHerriak",  // 'lortuHerriak' akzioa eskatzen du
                "eskualdea": eskualdeaVal,  // Eskualdearen balioa bidaltzen da
            }
        })
            .done(function (herrienLista) { // Ongi joan bada herrienlista funtzioa egingo du
                // Eskaera amaitzen denean, herrien lista jasotzen da JSON formatuan
                var info = JSON.parse(herrienLista); // Textu formatua JSON formatura parsatzen du

                // Kontsultak erantzunak baditu herriak erakusteko kodea
                if (info.kopurua > 0) {
                    // Desplegablearen lehen aukera hutsa erakusteko kodea
                    $("#herriak").html("<option value='' selected></option>");

                    // Bukle bat erantzun kopuru bakoitzeko exekutatuko dena
                    for (var i = 0; i < info.kopurua; i++) {
                        // Aukera bakoitza herriaren izenarekin eta id-rekin gehitzen da, append erabiliz azkenaren amaieran idatziko
                        $("#herriak").append("<option>" + info[i].izena + "</option>");
                    }
                } else {
                    // Kontsultan ez badu erantzurik aurkitu erakutsiko duen mezua
                    alert("Ez da elementurik kargatu");
                }
            })
            .fail(function () {
                // AJAX errore mezua erakusteko kodea
                alert("gaizki joan da");
            });
    }
</script> <!-- Script etiketa itxi da -->