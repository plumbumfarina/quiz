<?php

/*
function getFragenAnzahl($kartendeck_id){

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

*/
?>


<?php

function getFragenAnzahl($kartendeck_id){

    if(isset($kartendeck_id)) {
        include_once('lib/dbConnectorMYSQLI.php');
        $statement = $conn->prepare("SELECT COUNT(*) as fragenAnzahl FROM fragen WHERE kartendeck_id = ?");
        $statement->bind_param("i", $kartendeck_id);
        $statement->execute();
        $result = $statement->get_result();

        $fragen = $result->fetch_assoc();
        $fragenAnzahl = $fragen['fragenAnzahl'];
        return $fragenAnzahl;
    } else {
       echo "ooops ... something went wrong ...";
    }
}

?>
