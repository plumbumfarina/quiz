<?php
    $servername = "localhost";
    $username = "root";
    $password = "toor";
    $dbname = "ProjektQuiz";
    $user_id = $_SESSION['userid'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>