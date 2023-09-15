<?php
include("template_header.php");
include("accessibility.html");
include("pdo.php");
?>

<link href="./styles/dobitnici/dobitnici_form.css" rel="stylesheet" type="text/css" />

<?php
if (!isset($_SESSION["username"])) {
    echo "<center><h1>You are not supposed to be here!</h1><center>";
    exit();
}

if (isset($_GET["id"])) {
    $id_dobitnika = $_GET["id"];
    $upit = $db->query("SELECT * FROM dobitnici WHERE id_dobitnika=$id_dobitnika");
    $rezultati = $upit->fetchAll();
    $ime = $rezultati[0]["ime_autora"];
    $prezime = $rezultati[0]["prezime_autora"];
    $spol_autora = $rezultati[0]["spol_autora"];
    $naslov_djela = $rezultati[0]["naslov_djela"];
    $gumb = "Uredi";
    $selected_nagrade = array(); // Create an array to store selected nagrade
    $upit_nagrade_dobitnici = $db->query("SELECT id_nagrade FROM dobitnici_nagrade WHERE id_dobitnika = " . $id_dobitnika);
    $rezultati_nagrade_dobitnici = $upit_nagrade_dobitnici->fetchAll();
    foreach ($rezultati_nagrade_dobitnici as $nagrada_dobitnik) {
        $selected_nagrade[] = $nagrada_dobitnik["id_nagrade"];
    }
} else {
    $id_dobitnika = "";
    $ime = "";
    $prezime = "";
    $spol_autora = "";
    $naslov_djela = "";
    $gumb = "Unesi";
    $selected_nagrade = array(); // Initialize an empty array for selected nagrade
}
?>

<div class="glasslayout">
    <div class="form-container">

        <div id="wrapper" class="wrapper wrapperform">
            <div class="form__container" style="padding-bottom: 50px;">
                <form method="post" action="dobitnici_sql.php">
                    <h2 class="form__title text title-default">Novi dobitnik</h2><br>
                    <input class="text input input-default glass-input" type="text" required placeholder="Naziv djela" name="naslov_djela" id="naslov_djela" value='<?php echo $naslov_djela ?>'>

                    <input class="text input input-default glass-input" placeholder="Ime autora" required type="text" name="ime_autora" id="ime_autora" value='<?php echo $ime ?>'>

                    <input class="text input input-default glass-input" placeholder="Prezime autora" required type="text" name="prezime_autora" id="prezime_autora" value='<?php echo $prezime ?>'>

                    <select class="input glass-input" name="spol_autora" required>
                        <option value="M" <?php if ($spol_autora == "M") echo "selected"; ?>>Muško</option>
                        <option value="Ž" <?php if ($spol_autora == "Ž") echo "selected"; ?>>Žensko</option>
                    </select>

                    <label class="text label list__item-default" id="nagrada" for="naziv_nagrada[]">&nbsp; &nbsp;Nagrada</label><br /><br />
                    <select class="select" name="naziv_nagrada[]" multiple>
                        <?php
                        $upit_nagrade = $db->query("SELECT * FROM nagrade");
                        $rezultati_nagrade = $upit_nagrade->fetchAll();
                        foreach ($rezultati_nagrade as $nagrada) {
                            $selected = in_array($nagrada["id_nagrade"], $selected_nagrade) ? "selected" : "";
                            echo "<option value='" . $nagrada["id_nagrade"] . "'$selected>
                                " . $nagrada["naziv_nagrade"]  . "
                                </option>";
                        }
                        ?>
                    </select>

                    <input type="hidden" name="id" value='<?php echo $id_dobitnika ?>'>
                    <input class="text pink-button input-default glass-button" id="button" type="submit" name="submit" style="float: right; background: #B509AE;padding: 10px 15px; border: none; color: white; text-decoration: none; font-size: 18px; cursor: pointer; font-family: 'Euclid Circular A Medium'; transition: background 0.3s ease;" value="<?php echo $gumb?>">
                </form>
                <a class="wrapper__button" href='dobitnici.php'>
                    <button class="pink-button form__button form__button--secondary glass-button" style="float: left; border: 1px solid #B509AE; background-color: transparent; font-size: 18px; ">Odustani</button>
                </a>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
include("template_footer.html");
?>