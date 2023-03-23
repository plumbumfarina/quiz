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
    
    
    
    #$servername = "localhost";
    #$username = "root";
    #$password = "toor";
    #$dbname = "ProjektQuiz";
    # $user_id = $_SESSION['userid'];

    // Create connection
    #$conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    #if ($conn->connect_error) {
    #    die("Connection failed: " . $conn->connect_error);
    #}
?>