<?php
include("template_header.php");
include("accessibility.html");
include("pdo.php");
?>
<link href="./styles/dobitnici/dobitnici.css" rel="stylesheet" type="text/css" />
<script src="./scripts/filter.js"></script>
<script type="text/JavaScript">
    document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('pretrazi');
    const rows = document.getElementsByTagName('tr');

    searchInput.addEventListener('input', function () {
        const searchText = searchInput.value.toLowerCase();

        for (let i = 1; i < rows.length; i++) {
            const rowData = rows[i].textContent.toLowerCase();
            if (rowData.includes(searchText)) {
                rows[i].style.display = 'table-row';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
});
</script>
<?php


$upit = $db->query("
SELECT * 
FROM dobitnici 
");
$rezultati = $upit->fetchAll();

echo "<body>";
echo "<div class='menu' id='menu'>

<div class='menu__window'>

<br>
<form action='' method='post'>

<h4 class=menu__window__title>Spol autora</h4>

<input class='menu__window__radio' type='radio' id='muško' name='spol' value='M'>
<label class='menu__window__label' for='muško'>Muško</label><br>

<input class='menu__window__radio' type='radio' id='žensko' name='spol' value='Ž'>
<label class='menu__window__label' for='žensko'>Žensko</label><br>

<label class='menu__window__label menu__window__label--secondary' for='cars'>Sortiraj po</label>

<br><br>
<select name='sort' id='sort'>
<option class='menu__window__option' value='ime_autora' selected>Nema</option>
  <option class='menu__window__option' value='ime_autora'>Ime</option>
  <option class='menu__window__option' value='prezime_autora'>Prezime</option>
  <option class='menu__window__option' value='naslov_djela'>Naslov djela</option>
</select>


<div class='menu__window__wrapper'>
    <input class='menu__window__button button-style' type='submit' name='submit' value='Primjeni'>
    <br><br>
    <input class='menu__window__button button-ponisti' type='submit' name='submit' value='Poništi'>
</div>
</form>

</div>

</div>
";

if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "Poništi") {
        $upit = $db->query("
        SELECT * 
        FROM dobitnici
        ");
        $rezultati = $upit->fetchAll();
    } else if ($_POST["submit"] == "Primjeni") {
        if (!empty($_POST['spol']) && !empty($_POST['sort'])) {
            $spol = $_POST['spol'];
            $sort = $_POST["sort"];
            $upit = $db->query("
        SELECT * 
        FROM dobitnici 
        where spol_autora = '$spol'
        ORDER BY $sort
        ");
            $rezultati = $upit->fetchAll();
        } else if (!empty($_POST['spol'])) {
            $spol = $_POST['spol'];
            $upit = $db->query("
        SELECT * 
        FROM dobitnici where spol_autora = '$spol'
        ");
            $rezultati = $upit->fetchAll();
        } else if (!empty($_POST['sort'])) {
            $sort = $_POST["sort"];
            $upit = $db->query("
        SELECT * 
        FROM dobitnici ORDER BY $sort;
        ");
            $rezultati = $upit->fetchAll();
        }
    }
}

echo "
<div class='table-container'>
<div class='wrapper'>";

echo "<input class='input text-default' type='search' id='pretrazi' style='
    background-color: white;
    color: black;
    font-size: 18px;
    font-family: 'Euclid Circular A Medium';' onchange='(e) => filter(e);' name='pretrazi' placeholder='Pretraživanje'>";
echo "</div>";

echo "<div class='wrapper'>

<div class='box'>
<button onclick='openCloseMenu()' class='box__button' id='filter_button'>
<span class='box__text'>Filtriraj</span>
</button>
</div>
";

echo "<br/>";
echo isset($_SESSION["username"]) ? "<a class='table-button input-default' href='dobitnici_form.php'>Dodaj dobitnika</a>" : "";
echo "<br/>";
echo "<br/>";

echo "<table class='table'>";
echo "<tr class='table-menu'><td class='text text-default'>Ime autora</td>
<td class='text text-default'>Prezime autora</td>
<td class='text text-default'>Spol autora</td>
</td><td class='text text-default'>Naslov djela</td>";
echo isset($_SESSION["username"]) ?
    "<td class='text text-default'>
                </td><td class='text text-default'></td>" : "";
echo "</tr>";


foreach ($rezultati as $dobitnik) {
    echo "<tr class='table-row'><td><a class='link text text-default'href='dobitnik.php?id=" . $dobitnik["id_dobitnika"] . "'>
    " . $dobitnik["ime_autora"] . "</a></td>
    <td>" . "<a class='link text text-default' href='dobitnik.php?id=" . $dobitnik["id_dobitnika"] . "'>
    " . $dobitnik["prezime_autora"] . "</a>" . "</td> 
    <td class='text text-default'>" . $dobitnik["spol_autora"] . "</td> 
    <td class='text text-default'>" . $dobitnik["naslov_djela"] . "</td>";
    echo isset($_SESSION["username"]) ?
        "<td><a  class='link text text-default' href='dobitnici_form.php?id=" . $dobitnik["id_dobitnika"] . "'>Uredi</a></td>
    <td><a  class='link text text-default' href='dobitnici_sql.php?brisanje=" . $dobitnik["id_dobitnika"] . "'>Briši</a></td>
    </tr>" : "";
}
echo "</table>

</div>
</div>";



include("template_footer.html");
?>