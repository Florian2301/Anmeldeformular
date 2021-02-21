<?php
$navigation = [
    "startseite.php" => "Startseite", 
    "formular.php" => "Anmeldung", 
    "uebersicht.php" => "Übersicht"];

echo "<ul class='container' style='margin-top: 2rem'>\n";
foreach ($navigation as $nav => $titel) {
    echo "<li class='nav'><a href='$nav' class='$titel' id='nav'>$titel</a></li>";
}
echo "</ul>\n";
?>