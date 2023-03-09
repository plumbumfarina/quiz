<?php
    if(isset($_SESSION['userid'])) {
            $user_id = $_SESSION['userid'];
            $dbconnector = new PDO('mysql:host=localhost;dbname=quiz', 'root', 'toor');
            $statement = $dbconnector->prepare("SELECT fragendeck_name, modul_id, fragendeck_id FROM fragendeck WHERE user_id = :user_id");
            $result = $statement->execute(array('user_id' => $user_id));

            $user = $statement->fetch();
            $fragendeck_name = $user['fragendeck_name'];
            $modul_id = $user['modul_id'];
            $fragendeck_id = $user['fragendeck_id'];
    } else {
        echo "ooops ... somthing went wrong ...";
    }
?>