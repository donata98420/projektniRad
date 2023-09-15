<?php
include("template_header.php");
include("accessibility.html");
include("pdo.php");
?>

<link href="./styles/nagrade/nagrada.css" rel="stylesheet" type="text/css" />

<?php

$id = isset($_GET["id"]) ? $_GET["id"] : 0;
$upit = $db->query("
SELECT * 
FROM nagrade
WHERE id_nagrade = $id
");
$rezultati = $upit->fetchAll();

echo "<br><br><button class='pink-button' style='margin-left: 70px;' onclick=\"location.href='nagrade.php'\">Natrag</button>";

echo "<div class='layout'>";
echo "<div class='container'>";

echo "<h2 class='title' style='margin-left: -53vh;'>Detalji o nagradi</h2>";

echo "<div class='nagrada-details'>";
echo "<p class='nagrada-detail'><span class='detail-label'>Naziv nagrade:</span> " . $rezultati[0]["naziv_nagrade"] . "</p>";
echo "<p class='nagrada-detail'><span class='detail-label'>Organizator:</span> " . $rezultati[0]["organizator"] . "</p>";
echo "<p class='nagrada-detail'><span class='detail-label'>Učestalost:</span> " . $rezultati[0]["ucestalost"] . "</p>";
echo "<p class='nagrada-detail'><span class='detail-label'>Godina prve dodjele:</span> " . $rezultati[0]["god_dodjele"] . "</p>";
echo "<p class='nagrada-detail'><span class='detail-label'>Više informacija:</span> " . $rezultati[0]["vise_informacija"] . "</p>";
echo "<p class='nagrada-detail'><span class='detail-label'>Link na stranicu:</span> <a class='link' href='" . $rezultati[0]["url_link"] . "'>" . $rezultati[0]["url_link"] . "</a></p>";
echo "</div>";


echo "</div>";

echo "<img class='image image-right' src='./media/img/celebrate.svg' alt='bg'/>";

echo "</div>";

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


include("template_footer.html");
?>
