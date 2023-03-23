<?php
    include('getFragendeckname.php');
    include('lib/dbConnector.php');

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