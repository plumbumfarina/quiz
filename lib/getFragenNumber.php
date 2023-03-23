<?php
    include('getFragendeckname.php');
    include('lib/dbConnector.php');

    if(isset($_SESSION['userid'])) {

            $statement = $conn->prepare("SELECT COUNT(*) as fragenAnzahl FROM fragen WHERE fragendeck_id = :fragendeck_id");
            $result = $statement->execute(array('fragendeck_id' => $fragendeck_id));

            $fragen = $statement->fetch();
            $fragenAnzahl = $fragen['fragenAnzahl'];

    } else {
        echo "ooops ... something went wrong ...";
    }
?>