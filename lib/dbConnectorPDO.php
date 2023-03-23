<?php
    $servername = "localhost";
    $username = "root";
    $password = "toor";
    $dbname = "ProjektQuiz";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch(PDOException $e) {
        echo "Fehler bei der Datenbank-Verbindung: " . $e->getMessage();
    }
?>