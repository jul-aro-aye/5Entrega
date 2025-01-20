<?php

require_once("db.php");

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

                ?>
            </tbody>
        </table>
        <br>
        <button class="eguneratu">Eguneratu</button>
        <?php

            } else {
                echo "Ez dago informaziorik";
            }
            $conn->close();

            ?>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>

        $(document).ready(function () {

            $(".eguneratu").on("click", function () {
                taulaBirkargatu();
            });

        }

        function taulaBirkargatu() {

                $.ajax({
                    "url": "gidariak.php",
                    "method": "GET",
                    "data": {
                        "akzioa": "lortugidariak",
                    }
                });
                .done function(lortutakoInformazioa) {
                    var informazioa = JSON.parse(lortutakoInformazioa);
                    if (informazioa.kopurua >0) {
                        $("table").html("");
                       
                       
                       
                       
                        for (var i; i<informazioa.kopurua;i++) {
                            //.html izan behar da, seguro?
                            $("table").html("<tr><td>"+ )
                        }
                    } else {
                        alert("Ez da informaziorik aurkitu");
                    }
                }
                .fail function() {
                    alert("Konexio arazoak");
                }

            }
    </script>

</body>

</html>