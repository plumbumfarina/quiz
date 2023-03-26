<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ProjektQuiz";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch(PDOException $e) {
        echo "Fehler bei der Datenbank-Verbindung: " . $e->getMessage();
    }
?>
