<?php
	include('lib/getNickname.php');
?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			
			<a href="index.php">Startseite</a>
			<a href="decks.php">Meine Kartendecks</a>
			<a href="startGame.php">Neues Spiel</a>
			<p>Hallo <b> <?php echo $nickname; ?></b>!</p>
			
		</div>
	</div>

</nav>