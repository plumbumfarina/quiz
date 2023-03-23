<?php

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
            $user_id = $_SESSION['userid'];
            
            $statement = $conn->prepare("SELECT fragendeck_name, modul_id, fragendeck_id FROM fragendeck WHERE user_id = :user_id");
            $result = $statement->execute(array('user_id' => $user_id));

            $user = $statement->fetch();
            $fragendeck_name = $user['fragendeck_name'];
            $modul_id = $user['modul_id'];
            $fragendeck_id = $user['fragendeck_id'];
    } else {
        echo "ooops ... somthing went wrong ...";
    }
?>