<?php

require_once("db.php");

$conn = konexioaSortu();


$bilaketa = "";
if (isset($_GET["bilaketa"])) {
    $bilaketa = $_GET["bilaketa"];
}

?>

<form method="GET" action="index.php">
    <label for="bilaketa">Filtratu </label>
    <input type="text" name="bilaketa" value="<?= $bilaketa ?>" id="bilaketa" placeholder="Sartu izena" />
    <button>Bilatu</button>
</form>

<button class="taulaReload">Taula birkargatu</button>
<br>


<?php

$bilaketa = "";
$kontsulta = "SELECT Postua, Dortsala, Izena FROM 8ataza WHERE izena LIKE \"%$bilaketa%\"";
$result = $conn->query($kontsulta);
?>
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
                
                echo "<td> $row[\"Postua\"] . </td>";
                echo "<td> $row["Dortsala"] . </td>";
                echo "<td> $row["Izena"] . </td>";
            }
            }
            ?>
        </tbody>
    </table>
    <?php
    echo "</div>";

        } else {
            echo "Ez dago informaziorik";
        }
        $conn->close();

        ?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    $(document).ready(function () {

        $(".taulaReload").on("click", function () {
            taulaBirkargatu();
        });

        // setInterval(taulaBirkargatu, 1000);

    });

    function taulaBirkargatu() {

        $.ajax({
            "url": "lortuIkasleak.php",
            "method": "GET",
            "data": {
                "akzioa": "lortuIkasleak",
            }
        })
            .done(function (bueltanDatorrenInformazioa) {

                var info = JSON.parse(bueltanDatorrenInformazioa);
                if (info.kopurua > 0) {
                    $(".zerrenda").html("");
                    for (var i = 0; i < info.kopurua; i++) {
                        $(".zerrenda").html("<span>id: " + info[i].id + " - Izena: " + info[i].izena + "</span><br>");
                    }
                } else {
                    alert("Ez da elementurik kargatu");
                }

            })
            .fail(function () {
                alert("gaizki joan da");
            })
            .always(function () {
                // alert("aa");
            });
    }
</script>