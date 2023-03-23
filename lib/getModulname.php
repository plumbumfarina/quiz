<?php
    include('getFragendeckname.php');
    
    $servername = "localhost";
    $username = "root";
    $password = "toor";
    $dbname = "quiz";
    $user_id = $_SESSION['userid'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_SESSION['userid'])) {

            $statement = $conn->prepare("SELECT modulname, modulkuerzel FROM modul WHERE modul_id = :modul_id");
            $result = $statement->execute(array('modul_id' => $modul_id));

            $modul = $statement->fetch();
            $modulname = $modul['modulname'];
            $modulkuerzel = $modul['modulkuerzel'];
    } else {
        echo "ooops ... somthing went wrong ...";
    }
?>