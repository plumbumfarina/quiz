<?php
// session starten
session_start();

// alle session variablen löschen
$_SESSION = array();

// session zerstören
session_destroy();

// redirect auf die Loginseite nach 10 sec
header("Refresh: 5; URL=login.php");
echo "Logout erfolgreich. In 5 Sekunden wird die Login-Seite wieder angezeigt.";

?>