<?php
    include('getFragendeckname.php');

    if(isset($_SESSION['userid'])) {

            $dbconnector = new PDO('mysql:host=localhost;dbname=quiz', 'root', 'toor');
            $statement = $dbconnector->prepare("SELECT COUNT(*) as fragenAnzahl FROM fragen WHERE fragendeck_id = :fragendeck_id");
            $result = $statement->execute(array('fragendeck_id' => $fragendeck_id));

            $fragen = $statement->fetch();
            $fragenAnzahl = $fragen['fragenAnzahl'];

    } else {
        echo "ooops ... somthing went wrong ...";
    }
?>