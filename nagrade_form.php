<?php
include("template_header.php");
include("accessibility.html");
include("pdo.php");
?>

<link href="./styles/nagrade/nagrade_form.css" rel="stylesheet" type="text/css" />
<link href="./styles/nagrade/glassmorphism.css" rel="stylesheet" type="text/css" />

<?php
if (!isset($_SESSION["username"])) {
    echo "<center><h1>You are not supposed to be here!</h1></center>";
    exit();
}

if (isset($_GET["id"])) {
    $id_nagrade = $_GET["id"];
    $upit = $db->query("SELECT * FROM nagrade WHERE id_nagrade=$id_nagrade");
    $rezultati = $upit->fetchAll();
    $naziv_nagrade = $rezultati[0]["naziv_nagrade"];
    $organizator = $rezultati[0]["organizator"];
    $ucestalost = $rezultati[0]["ucestalost"];
    $god_dodjele = $rezultati[0]["god_dodjele"];
    $vise_informacija = $rezultati[0]["vise_informacija"];
    $url_link = $rezultati[0]["url_link"];
    $gumb = "Uredi";
} else {
    $id_nagrade = "";
    $naziv_nagrade = "";
    $organizator = "";
    $god_dodjele = "";
    $vise_informacija = "";
    $ucestalost = "";
    $url_link = "";
    $gumb = "Unesi";
}
?>

<div class="glasslayout">
    <div id="wrapper" class="wrapper glassmorphism-wrapper">
        <form class="form" method="POST" action="nagrade_sql.php"><br>
            <h2 class="form__title text title-default" style="text-align: left;">&nbsp; Nova nagrada</h2>

            <div class="form__group" style="text-align: center;"> 
                <input class="text input input-default glass-input" type="text" required name="naziv_nagrade" id="naziv_nagrade"
                    placeholder="Naziv nagrade" value='<?php echo $naziv_nagrade ?>'>

                <input class="text input input-default glass-input" type="text" name="organizator" id="organizator"
                    placeholder="Organizator" value='<?php echo $organizator ?>'>

                <input class="text input input-default glass-input" type="text" name="ucestalost" id="ucestalost"
                    placeholder="Učestalost" value='<?php echo $ucestalost ?>'>

                <input class="text input input-default glass-input" id="dodjela" type="number" max="<?php echo date('Y'); ?>"
                    name="god_dodjele" placeholder="Godina dodjele" value='<?php echo $god_dodjele ?>'>
            </div>

            <div class="form__group">
                <textarea class="text input-default glass-input" rows="4" name="vise_informacija" placeholder="Više informacija"><?php echo $vise_informacija ?></textarea>

                    <input class="text input input-default glass-input" id="link" type="text" name="url_link" placeholder="URL" value='<?php echo $url_link ?>'>
            <div class="form__buttons">
                <a class="wrapper__button" href='nagrade.php'>
                    <button class="form__button form__button--secondary glass-button" type="button">Odustani</button>
                </a>
    <input class="text form__button input-default glass-button" id="gumb" type="submit" name="submit" value="<?php echo $gumb ?>">
</div>
            </div>

            <input class="text input-default" type="hidden" name="id" value='<?php echo $id_nagrade ?>'>
            <br><br><br><br><br><br><br>
        </form>
    </div>
</div>


<?php
include("template_footer.html");
?>
