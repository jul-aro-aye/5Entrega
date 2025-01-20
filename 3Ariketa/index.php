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


$kontsulta = "SELECT Postua, Dortsala, Izena FROM froga WHERE izena LIKE \"%$bilaketa%\"";
$result = $conn->query($kontsulta);

if ($result->num_rows > 0) {
    echo "<div class='zerrenda'>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        // if (str_contains($row["izena"], $bilaketa)) {
        echo "Postua: " . $row["Postua"] . " - Dortsala: " . $row["Dortsala"] . " - Izena: " . $row["Izena"] . "<br>";
        // }
    }
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