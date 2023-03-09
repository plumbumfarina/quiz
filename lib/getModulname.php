<?php
    include('getFragendeckname.php');

    if(isset($_SESSION['userid'])) {

            $dbconnector = new PDO('mysql:host=localhost;dbname=quiz', 'root', 'toor');
            $statement = $dbconnector->prepare("SELECT modulname, modulkuerzel FROM modul WHERE modul_id = :modul_id");
            $result = $statement->execute(array('modul_id' => $modul_id));

            $modul = $statement->fetch();
            $modulname = $modul['modulname'];
            $modulkuerzel = $modul['modulkuerzel'];
    } else {
        echo "ooops ... somthing went wrong ...";
    }
?>