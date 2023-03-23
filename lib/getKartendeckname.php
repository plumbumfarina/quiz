<?php

include('lib/dbConnector.php');

    if(isset($_SESSION['userid'])) {
            $user_id = $_SESSION['userid'];
            
            $statement = $conn->prepare("SELECT kartendeck_name, modul_id, kartendeck_id FROM kartendeck WHERE user_id = :user_id");
            $result = $statement->execute(array('user_id' => $user_id));

            $user = $statement->fetch();
            $fragendeck_name = $user['kartendeck_name'];
            $modul_id = $user['modul_id'];
            $fragendeck_id = $user['kartendeck_id'];
    } else {
        echo "ooops ... somthing went wrong ...";
    }
?>