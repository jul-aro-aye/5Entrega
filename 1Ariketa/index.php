<?php // php etiketa ireki du

// Datu basearekin egiteko konexioa egingo duen fitxategira deitzen du
require_once("../db.php");

// Datu-basearekin konektatzeko funtzioa exekutatzen du
$conn = konexioaSortu();

?> <!-- php etiketa itxi du -->
<br> <!-- Ilara saltoa egiten du -->
<?php // php etiketa ireki du

// kontsulta gidarien egoera lortzeko postu bidez ordenatuta
$kontsulta = "SELECT Postua, Dortsala, Izena FROM gidariak Order by Postua";
// SQL kontsulta exekutatzen du
$result = $conn->query($kontsulta);
?> <!-- php etiketa itxi du -->

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

                // bukle bat emaitza guztiei eragiten diona
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

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script> <!-- jquery liburutegiari dei egiten dio -->

    <script> //Script etiketa ireki du

        $(document).ready(function () { // Dokumentua kargatzean egingo duen kodea

            // Eguneratu botoia klik egitean taula kargatzeko funtzioa
            $(".eguneratu").on("click", function () {
                taulaBirkargatu(); // taulaBirkargatu funtzioari deitzen dio, taula eguneratzen duena

            });

            // Taula 1 minuturo automatikoki berriz kargatzeko kodea
            setInterval(taulaBirkargatu, 60000);

        });

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
                    // Eskaera amaitzen denean, kontsulta jasotzen da JSON formatuan
                    var informazioa = JSON.parse(lortutakoInformazioa); // Textu formatua JSON formatura parsatzen du

                    // Erantzunik badago taula berriro beteko dugu
                    if (informazioa.kopurua > 0) {
                        // Taula garbitzeko kodea
                        $("tbody").html("");

                        // Bukle bat erantzun kopuru bakoitzeko exekutatuko dena
                        for (var i = 0; i < informazioa.kopurua; i++) {
                            // Taularen ilara bakoitza betetzeko kodea, append erabiliz azkenaren amaieran idatziko
                            $("tbody").append("<tr><td>" + informazioa[i].postua + "</td><td>" + informazioa[i].dortsala + "</td><td>" + informazioa[i].izena + "</td></tr>");
                        }
                    } else {
                        // Datuak ez badira, alerta bat erakusten dugu
                        alert("Ez da informaziorik aurkitu");
                    }

                })
                .fail(function () {
                    // Ajax eskaera huts egin badu, alert bat erakusten dugu
                    alert("Gaizki joan da!");
                });

        }
    </script> <!-- Script etiketa itxi du -->

</body> <!-- Body etiketa itxi du -->

</html> <!-- Html etiketa itxi du -->