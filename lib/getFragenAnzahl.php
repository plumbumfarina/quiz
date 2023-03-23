<?php

include("lib/dbConnector.php");

function getFragenAnzahl($kartendeck_id){

    if(isset($kartendeck_id)) {

        $result = mysqli_query($conn, "SELECT * FROM fragen WHERE kartendeck_id = $kartendeck_id");

        $num_rows = mysqli_num_rows($result);

        mysqli_close($conn);

    } else {
        $num_rows = 'ERROR';
    }

    return $num_rows;
}

?>
