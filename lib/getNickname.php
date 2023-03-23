<?php
    include('lib/dbConnector.php');

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