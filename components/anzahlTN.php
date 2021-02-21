<?php
    $mysqli = new mysqli('localhost', 'root', '', 'wtc2021');
        if ($mysqli->connect_error) {
            echo 'Fehler bei der Verbindung: ' . mysqli_connect_error();
            exit();
        }
        if (!$mysqli->set_charset('utf8')) {
            echo 'Fehler beim Laden von UTF8 ' . $mysqli->error;
        }
        if ($result = $mysqli->query('SELECT id FROM Anmeldungen')) {
            $row_cnt = $result->num_rows;
            printf("<div class='container'>Es haben sich bereits %d Teilnehmer angemeldet.</div>", $row_cnt);
            $result->close();
        };
    $mysqli->close();
?>