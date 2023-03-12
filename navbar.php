<?php
	include('lib/getNickname.php');
?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			
			<a href="index.php">Startseite</a>
			<a href="decks.php">Meine Kartendecks</a>
			<a href="startGame.php">Neues Spiel</a>
			<a href="lib/logout.php">LOGOUT</a>
			<a href="neuesDeck.html">Neues Deck</a>
			<a href="newDeck.php">Neues Deck php</a>
			<a href="createFragendeck.html">Neues Deck create.html</a>
			<a href="fragenUebersicht.php">fragenUebersicht.php</a>
			<p>Hallo <b> <?php echo $nickname; ?></b>!</p>

		</div>
	</div>

</nav>