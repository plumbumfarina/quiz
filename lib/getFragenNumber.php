<?php
    include_once('getKartendeckname.php');
    
    include_once('lib/dbConnectorMYSQLI.php');

    if(isset($_SESSION['userid'])) {

            $statement = $conn->prepare("SELECT COUNT(*) as fragenAnzahl FROM fragen WHERE kartendeck_id = :kartendeck_id");
            $result = $statement->execute(array('kartendeck_id' => $kartendeck_id));

            $fragen = $statement->fetch();
            $fragenAnzahl = $fragen['fragenAnzahl'];

    } else {
        echo "ooops ... something went wrong ...";
    }
?>