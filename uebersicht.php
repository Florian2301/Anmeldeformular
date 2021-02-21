<?php
    include "./components/htmlelemente.php";
    htmlanfang("Übersicht Teilnehmer WTC 2021");
    include "./components/navigation.php";
    
    echo "<h3 class='container'>Übersicht der angemeldeten Teilnehmer zur webconia Technology Conference 2021</h3>";
    
    $mysqli = new mysqli('localhost', 'root', '', 'wtc2021');
        if ($mysqli->connect_error) {
            echo 'Fehler bei der Verbindung: ' . mysqli_connect_error();
            exit();
        }
        if (!$mysqli->set_charset('utf8')) {
            echo 'Fehler beim Laden von UTF-8: ' . mysqli_error();
        }
    
    $sql = 'SELECT * FROM Anmeldungen';
    $response = $mysqli->query($sql);
?>
<div class="container">
    <table class="table table-striped">
        <tr style="border-bottom: solid black 1px">
            <td>Nr.</td>
            <td>Anrede</td>
            <td>Vorname</td>
            <td>Nachname</td>
            <td>Email</td>
            <td>Firma</td>
            <td>Auto</td>
            <td>Panele</td>
            <td>Anmerkung</td>
        </tr>
        <?php
        while ($data = $response->fetch_array(MYSQLI_ASSOC)) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($data['id']); ?></td>
                <td><?php echo htmlspecialchars($data['Anrede']); ?></td>
                <td><?php echo htmlspecialchars($data['Vorname']); ?></td>
                <td><?php echo htmlspecialchars($data['Nachname']); ?></td>
                <td><?php echo htmlspecialchars($data['Email']); ?></td>
                <td><?php echo htmlspecialchars($data['Firma']); ?></td>
                <td><?php echo htmlspecialchars($data['Anreise']); ?></td>
                <td><?php echo htmlspecialchars($data['Panele']); ?></td>
                <td><?php echo htmlspecialchars($data['Anmerkung']); ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<?php
$mysqli->close();
include "./components/anzahlTN.php";
htmlende();
?>