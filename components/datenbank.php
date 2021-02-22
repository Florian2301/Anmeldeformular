<?php

function createdatabase() {
    $mysqli = new mysqli('localhost', 'root', '', 'wtc2021');
        if($mysqli->connect_error) {
            echo 'Fehler bei der Verbindung: ' . mysqli_connect_error();
            exit();
        }
        if(!$mysqli->set_charset('utf8')) {
            echo 'Fehler beim Laden von UTF-8: ' . mysqli_error();
        }

    $sql = 'CREATE TABLE IF NOT EXISTS Anmeldungen  (
            id INT(11) NOT NULL AUTO_INCREMENT,
            Anrede VARCHAR(4) NOT NULL,
            Vorname VARCHAR(255) NOT NULL,
            Nachname VARCHAR(255) NOT NULL,
            Email VARCHAR(255) NOT NULL,
            Firma VARCHAR(255) NOT NULL,
            Anreise VARCHAR(4),
            Panele VARCHAR(255),
            Anmerkung VARCHAR(255),
            PRIMARY KEY (id)
            )';

    $mysqli->query($sql);
    $mysqli->close();
};


function insertdata($anrede, $vorname, $nachname, $email, $firma, $selected, $checked, $anmerkung) {
    
    $panels = implode(",", $checked);

    $mysqli = new mysqli('localhost', 'root', '', 'wtc2021');
        if($mysqli->connect_error) {
            echo 'Fehler bei der Verbindung: ' . mysqli_connect_error();
            exit();
        }
        if(!$mysqli->set_charset('utf8')) {
            echo 'Fehler beim Laden von UTF-8: ' . mysqli_error();
        }

    $stmt = $mysqli->prepare('INSERT INTO Anmeldungen 
            (Anrede, Vorname, Nachname, Email, Firma, Anreise, Panele, Anmerkung)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt -> bind_param('ssssssss', $anrede, $vorname, $nachname, $email, $firma, $selected, $panels, $anmerkung);
    $stmt -> execute();
    
    $stmt -> close();
    $mysqli -> close();
}

?>