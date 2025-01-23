<?php

require_once("../db.php");

$conn = konexioaSortu();

?>

<br>

<?php

$kontsulta = "SELECT Postua, Dortsala, Izena FROM 8ataza Order by Postua";
$result = $conn->query($kontsulta);
?>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
        }
    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>Postua</th>
                <th>Dortsala</th>
                <th>Izena</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Postua"] . "</td>";
                    echo "<td>" . $row["Dortsala"] . "</td>";
                    echo "<td>" . $row["Izena"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "Ez dago informaziorik";
            }
            $conn->close();

            ?>
        </tbody>
    </table>
    <br>
    <button class="eguneratu">Eguneratu</button>
    <?php



    ?>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>

        $(document).ready(function () {

            $(".eguneratu").on("click", function () {
                taulaBirkargatu();

            });
            
            setInterval(taulaBirkargatu, 1000);

        });

        function taulaBirkargatu() {

            $.ajax({
                "url": "gidariak.php",
                "method": "GET",
                "data": {
                    "akzioa": "lortugidariak",
                }
            })

                .done(function (lortutakoInformazioa) {

                    var informazioa = JSON.parse(lortutakoInformazioa);
                    if (informazioa.kopurua > 0) {
                        $("tbody").html("");

                        for (var i = 0; i < informazioa.kopurua; i++) {

                            $("tbody").append("<tr><td>" + informazioa[i].postua + "</td><td>" + informazioa[i].dortsala + "</td><td>" + informazioa[i].izena + "</td></tr>");

                        }
                    } else {

                        alert("Ez da informaziorik aurkitu");

                    }

                })
                .fail(function () {
                    alert("Gaizki joan da!");
                });

        }
    </script>

</body>

</html>