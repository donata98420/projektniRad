<?php
include("template_header.php");
include("accessibility.html");
include("pdo.php");
?>
<link href="./styles/nagrade/nagrada.css" rel="stylesheet" type="text/css" />

<?php

$id = isset($_GET["id"]) ? $_GET["id"] : 0;

$upit = $db->query("SELECT id_nagrade FROM dobitnici_nagrade WHERE id_dobitnika = $id");
$id_nagrada = $upit->fetchAll();

$upit = $db->query("SELECT * FROM dobitnici WHERE id_dobitnika = $id");
$dobitnik = $upit->fetchAll();

echo "<br><br><button class='pink-button' style='margin-left: 70px;' onclick=\"location.href='dobitnici.php'\">Natrag</button>";


echo "<div class='layout'>";
echo "<div class='container'>";
echo "<h2 class='title' style='margin-left: 4%';>Detalji o dobitniku</h2>";

echo "<table>";
echo "<tr><td class='text text-default'><strong>Naslov djela:</strong></td><td class='text text-default'>" . $dobitnik[0]["naslov_djela"] ."</td></tr>" .
"<tr><td class='text text-default'><strong>Ime autora:</strong></td><td class='text text-default'>" . $dobitnik[0]["ime_autora"] . "</td></tr>" .
"<tr><td class='text text-default'><strong>Prezime autora:</strong></td><td class='text text-default'>" . $dobitnik[0]["prezime_autora"] . "</td></tr>" .
"<tr><td class='text text-default'><strong>Spol autora:</strong></td><td class='text text-default'>" . ($dobitnik[0]["spol_autora"]=="M" ? "Muško" : "Žensko") . "</td></tr>";
echo "</table>";

echo "<p class='text text-default' style='text-align: left;'>Dobivene nagrade:</p>";
foreach($id_nagrada as $id_nagrade) {
    $upit = $db->query("SELECT id_nagrade, naziv_nagrade FROM nagrade WHERE id_nagrade = ". $id_nagrade["id_nagrade"]);
    $nagrada = $upit->fetchAll();
    if($nagrada == null) {
        echo "Trenutno nema dobivenih nagrada.";
        break;
    }
    echo "<h4><a id='nagrada' style='color: #b509ae; class='text link list__item-default' href='nagrada.php?id=" . $id_nagrade["id_nagrade"] . "'><strong>" . $nagrada[0]["naziv_nagrade"] . "</strong></a></h4>";
}

echo "</div>";

// Decrease the image size by setting the width
echo "<img class='image image-right' style='margin-top: -40px; width: 600px;' src='./media/img/writer.svg' alt='bg'/>";

echo "</div>";

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

include("template_footer.html");
?>
