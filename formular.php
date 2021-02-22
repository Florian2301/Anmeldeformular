<?php
include "./components/htmlelemente.php";
include "./components/navigation.php";
include "./components/datenbank.php";

htmlanfang("Anmeldung zur WTC 2021");

echo "<h2 class='container'>Anmeldung zur webconia Technology Conference 2021</h2>";

$geschlecht = ["Frau", "Herr"];
$anreise = [" ", "Ja", "Nein"];
$panels = ["Technologien", "Innovation", "Trends", "Produkte", "Business", "Unternehmen"];

if (isset($_POST["gesendet"])) {
    absenden();
} else {
    anmeldeformular();
}

function anmeldeformular($anrede = "", $vorname = "", $nachname = "", $email = "", $firma = "", $selected = "", $checked = [], $anmerkung = "", $fehler = "") {
    global $geschlecht;
    global $anreise;
    global $panels;
    if (!empty($fehler)) {
        echo "<div class='container'>";
        echo "<ul class='fehler'>";
        foreach($fehler as $f) {
            echo "<li class='fehler'>$f</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
?>

    <div class="container">
        <form class="col-md-7" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >              

            <label style="margin-top: 0.5rem" for="anrede">Anrede:*<label>
                <?php
                    foreach ($geschlecht as $g) {
                        if ($g == $anrede) {
                            $check = "checked";
                        }
                        else {
                            $check = "";
                        }
                        echo "<input class='form-check-input' style='margin-left: 10px' type='radio' name='anrede' value='$g' $check > $g";
                    }
                ?>
            <div class="row" style="margin-top: 0.5rem">
                <div class="col">
                    <label for="vorname">Vorname:*</label>
                    <input class="form-control" type="text" name="vorname" size="30" maxlength="40" value="<?php echo htmlspecialchars($vorname); ?>">
                </div>
                <div class="col">
                    <label for="nachname">Nachname:*</label>
                    <input class="form-control" type="text" name="nachname" size="30" maxlength="40" value="<?php echo htmlspecialchars($nachname); ?>">
                </div>
            </div>
                
            <div class="row" style="margin-top: 0.5rem">
                <div class="col">
                    <label for="email">Email:*</label>
                    <input class="form-control" type="email" name="email" size="30" maxlength="40" value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="col">
                    <label for="firma">Firma:*</label>
                    <input class="form-control" type="text" name="firma" size="30" maxlength="40" value="<?php echo htmlspecialchars($firma); ?>">
                </div>
            </div>
                
            <div class="row" style="margin-top: 0.5rem">
                <div class="col">
                    <label for="anreise">Anreise mit dem Auto?</label>
                    <select name="anreise">
                        <?php
                            foreach ($anreise as $car) {
                                if ($car == $selected) {
                                    $sel = "selected";
                                }
                                else {
                                    $sel = "";
                                }
                                echo "<option class='form-select' style='width: 9rem' value='$car' $sel>$car</option>\n";
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label class="form-check-label" for="panel">Panels:</label>
                    <div name="panel" >
                            <?php
                            foreach($panels as $panel) {
                                if(in_array($panel, $checked)) {
                                    $checkbox = "checked";
                                }
                                else {
                                    $checkbox = "";
                                }
                                echo "<input class='form-check-input' style='margin-left: 1rem; margin-right: 0.5rem' type='checkbox' name='panel[]' value='$panel' $checkbox>$panel";
                            }
                            ?>
                    </div>
                </div>
            </div>
                        
            <label style="margin-top: 0.5rem" for="anmerkung">Anmerkung:</label>
            <textarea class="form-control" type="text" name="anmerkung" rows="3" placeholder="Wenn Sie Anmerkungen oder weitere Themenwünsche haben, tragen Sie diese bitte hier ein."><?php echo htmlspecialchars($anmerkung)?></textarea>
            <input type="submit" style="margin-top: 1rem" name="gesendet" value="Anmelden">
                    
        </form>
    </div>
    <?php
}

function absenden() {
    
    isset($_POST["anrede"]) ? $anrede = $_POST["anrede"] : $anrede = "";
    isset($_POST["vorname"]) && is_string($_POST["vorname"]) ? $vorname = trim($_POST["vorname"]) : $vorname = "";
    isset($_POST["nachname"]) && is_string($_POST["nachname"]) ? $nachname = trim($_POST["nachname"]) : $nachname = "";
    isset($_POST["email"]) && is_string($_POST["email"]) ? $email = trim($_POST["email"]) : $email = "";
    isset($_POST["firma"]) && is_string($_POST["firma"]) ? $firma = trim($_POST["firma"]) : $firma = "";
    isset($_POST["anreise"]) ? $selected = $_POST["anreise"] : $selected = "";
    isset($_POST["panel"]) ? $checked = $_POST["panel"] : $checked = [];
    isset($_POST["anmerkung"]) && is_string($_POST["anmerkung"])? $anmerkung = trim($_POST["anmerkung"]) : $anmerkung = "";

    $fehler = [];
    if (empty($anrede)) {
        $fehler[] = "Bitte wählen Sie eine Anrede aus. ";
    }
    if (empty($vorname)) {
        $fehler[] = "Bitte geben Sie Ihren Vornamen an. ";
    }
    if (empty($nachname)) {
        $fehler[] = "Bitte geben Sie Ihren Nachnamen an. ";
    }
    if (empty($email)) {
        $fehler[] = "Bitte geben Sie Ihre Email an. ";
    }
    if (empty($firma)) {
        $fehler[] = "Bitte geben Sie Ihre Firma an. ";
    }

    if (count($fehler) > 0) {
        anmeldeformular($anrede, $vorname, $nachname, $email, $firma, $selected, $checked, $anmerkung, $fehler);
    } else {
        echo "<div class='container'>";
        echo "<p>Vielen Dank $anrede $nachname für Ihre Anmeldung zur WTC 2021!</p>";
        echo "<p>Wir werden Ihnen in Kürze weitere Infos an Ihre Email-Adresse $email zusenden.</p>";
        echo "<p>Möchten Sie noch einen weiteren Teilnehmer anmelden? Dann klicken Sie bitte <a href='formular.php' class='teilnehmer'>hier</a></p>";
        echo "</div>";
        createdatabase();
        insertdata($anrede, $vorname, $nachname, $email, $firma, $selected, $checked, $anmerkung);
    }
}

htmlende()
?>