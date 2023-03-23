<?php

$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "quiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getFragenAnzahl($kartendeck_id){

    if(isset($kartendeck_id)) {

        $result = mysqli_query($conn, "SELECT * FROM fragen WHERE kartendeck_id = $kartendeck_id");

        $num_rows = mysqli_num_rows($result);

        mysqli_close($conn);

    } else {
        $num_rows = 'ERROR';
    }

    return $num_rows;
}

?>
