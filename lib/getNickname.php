<?php
session_start();
    #include('lib/dbConnector.php');

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
            
            $statement = $conn->prepare("SELECT nickname FROM user WHERE user_id = :user_id");
            $result = $statement->execute(array('user_id' => $user_id));

            $user = $statement->fetch();
            $nickname = $user['nickname'];
            $_SESSION['nickname'] = $user['nickname'];
    } else {
        echo "ooops ... something went wrong ...";
    }
?>