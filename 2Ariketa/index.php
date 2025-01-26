<?php // PHP etiketa ireki du

// Datu basearekin egiteko konexioa egingo duen fitxategira deitzen du
require_once("../db.php");

// Datu-basearekin konektatzeko funtzioa exekutatzen du
$conn = konexioaSortu();

?> <!-- PHP etiketa itxi du -->
<br> <!-- Ilara saltoa egiten du -->
<?php // PHP etiketa ireki du

// Kontsulta gidarien egoera lortzeko postu bidez ordenatuta
$kontsulta = "SELECT Postua, Dortsala, Izena FROM gidariak ORDER BY Postua";
// SQL kontsulta exekutatzen du
$result = $conn->query($kontsulta);
?> <!-- PHP etiketa itxi du -->

<head> <!-- Head etiketa irekitzen du -->
    <style>
        /* Style etiketa ireki du */
        /* Taula th eta td selektoreak aukeratu */
        table,
        th,
        td {
            border: 1px solid black;
            /* Bordea definitzen du */
            border-collapse: collapse;
            /* Bordeak batu egiten dira */
        }

        th,
        td {
            text-align: center;
            /* Testua erdian kokatzen dugu */
        }

        /* Aurreratuak (rojo): Posizioa galdu duen gidaria */
        .aurreratuak {
            background-color: red;
            /* Gorria, postu galdua */
        }

        /* Aurreratua (verde): Posizioa irabazi duen gidaria */
        .aurreratua {
            background-color: green;
            /* Berdea, postua irabazia */
        }
    </style> <!-- Style etiketa itxi du -->
</head> <!-- Head etiketa itxi du -->

<body> <!-- Body etiketa ireki du -->

    <table>

        <thead> <!-- Taularen head etiketa ireki du -->
            <tr> <!-- Taulako hasiera zutabeak definitzen ditugu -->
                <th>Postua</th>
                <th>Dortsala</th>
                <th>Izena</th>
            </tr>
        </thead> <!-- Taularen head etiketa itxi du -->
        <tbody> <!-- Taularen body etiketa ireki du -->
            <?php
            // SQL kontsultak emaitzarik eman duen ala ez konprobatzen dugu
            if ($result->num_rows > 0) {

                // Bukle bat emaitza guztiei eragiten diona
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Postua"] . "</td>"; // Postuaren datua sartuko dugu
                    echo "<td>" . $row["Dortsala"] . "</td>"; // Dortsalaren datua sartuko dugu
                    echo "<td>" . $row["Izena"] . "</td>"; // Izenaren datua sartuko dugu
                    echo "</tr>";
                }
            } else {
                // Kondizioa betetzen ez denean exekutatuko da
                echo "Ez dago informaziorik";
            }
            // Datu-basea konexioa itxi du
            $conn->close();

            ?>
        </tbody> <!-- Taularen body etiketa itxi du -->
    </table> <!-- Taularen etiketa itxi du -->
    <br> <!-- Ilara saltoa -->
    <!-- Eguneratzeko botoia sortu dugu -->
    <button class="eguneratu">Eguneratu</button>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script> <!-- jQuery liburutegiari dei egiten dio -->

    <script> // Script etiketa ireki du

        $(document).ready(function () { // Dokumentua kargatzean egingo duen kodea

            // Eguneratu botoia klik egitean taula kargatzeko funtzioa
            $(".eguneratu").on("click", function () {
                taulaBirkargatu(); // Taula eguneratzen du
            });

            // Taula 1 minuturo automatikoki berriz kargatzeko kodea
            setInterval(taulaBirkargatu, 60000); // 1 minuturo taula eguneratzen da
        });

        // Hemen dago posizioen jarraipena egiteko funtzioa
        var aurrekoPosizioak = {}; // Pilotoen posizioen jarraipena egiteko objektua

        // Taula birkargatzeko funtzioa
        function taulaBirkargatu() {

            // Ajax eskaera bat egiten dugu taulak automatikoki eguneratzeko
            $.ajax({
                "url": "gidariak.php", // gidariak.php fitxategira egiten du eskaera
                "method": "GET", // Eskaera GET metodoarekin egiten da
                "data": {
                    "akzioa": "lortugidariak", // Akzioa definitzen dugu
                }
            })

                .done(function (lortutakoInformazioa) { // Ongi joan bada lortutakoInformazioa funtzioa egingo du
                    var informazioa = JSON.parse(lortutakoInformazioa); // JSON formatuan jasotako datuak parseatzen ditu

                    // Erantzunik badago taula berriro beteko dugu
                    if (informazioa.kopurua > 0) {
                        $("tbody").html(""); // Taula hutsik utzi

                        // Bukle bat erantzun kopuru bakoitzeko exekutatuko dena
                        for (var i = 0; i < informazioa.kopurua; i++) {
                            var rowClass = ""; // Hasierako klasea

                            var oraingoPostua = informazioa[i].postua; // Oraingo eguneko posizioa
                            var izena = informazioa[i].izena; // Gidarien izena

                            // Aurreko posizioak badira, konparatu
                            if (aurrekoPosizioak[izena] !== undefined) {
                                var aurrekoPostua = aurrekoPosizioak[izena]; // Aurreko posizioa

                                // Posizioa igo bada (berde)
                                if (oraingoPostua < aurrekoPostua) {
                                    rowClass = "aurreratua"; // berdea erakusteko klasea aplikatzeko kodea
                                }
                                // Posizioa jaitsi bada (gorria)
                                else if (oraingoPostua > aurrekoPostua) {
                                    rowClass = "aurreratuak"; // gorria erakusteko klasea aplikatzeko kodea
                                }
                            }

                            // Gorde posizio berriaren balioa
                            aurrekoPosizioak[izena] = oraingoPostua;

                            // Taulako lerroa gehitu eta kolorea aplikatu
                            $("tbody").append("<tr class='" + rowClass + "'><td>" + informazioa[i].postua + "</td><td>" + informazioa[i].dortsala + "</td><td>" + informazioa[i].izena + "</td></tr>");
                        }
                    } else {
                        alert("Ez dago informaziorik aurkitu");
                    }

                })
                .fail(function () {
                    alert("Gaizki joan da!"); // Huts egin du
                });
        }
    </script> <!-- Script etiketa itxi du -->

</body> <!-- Body etiketa itxi du -->

</html> <!-- Html etiketa itxi du -->