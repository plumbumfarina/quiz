<?php


function getFragenAnzahl($kartendeck_id){

   if(isset($kartendeck_id)) {
      include_once('lib/dbConnectorPDO.php');
        $sql = "SELECT COUNT(*) as fragenAnzahl FROM fragen WHERE kartendeck_id = :kartendeck_id";
        
        $result = $conn->query($sql);

        $fragen = $statement->fetch();
        $fragenAnzahl = $fragen['fragenAnzahl'];
        return $fragenAnzahl;
    } else {
       echo "ooops ... something went wrong ...";
    }
}


?>