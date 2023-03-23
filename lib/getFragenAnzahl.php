<?php

function getFragenAnzahl($kartendeck_id){
   global $conn;
   if(isset($kartendeck_id)) {
        include_once('lib/dbConnectorPDO.php');
        $statement = $conn->prepare("SELECT COUNT(*) as fragenAnzahl FROM fragen WHERE kartendeck_id = :kartendeck_id");
        $result = $statement->execute(array('kartendeck_id' => $kartendeck_id));

        $fragen = $statement->fetch();
        $fragenAnzahl = $fragen['fragenAnzahl'];
        return $fragenAnzahl;
    } else {
       echo "ooops ... something went wrong ...";
    }
}

?>