<?php
	require( "init.php" );
	
	$Title = "Fibonacci";
	include( "../Common/HTMLHead.php" );
?>
	<script src="javascript.js"></script>
	
	<!-- par défaut <form> sans paramètre 'action' renvoi à la page courante -->
	<!-- par défaut <form> sans paramètre 'methode' équivaut à utiliser la méthode GET -->
	<form method='get' action='FormFibo.php'>
		<label for='iStart'>Entrer l'index de début et de fin d'itération : </label>
		<input name='iStart' id='iStart' type='number' placeholder="minimum 0" 		min='0' value='<?= $iStart ?>'/>
		<input name='iStop'  id='iStop'	 type='number' placeholder="100 par défaut" min="2" value='<?= $iStop  ?>'/>
		<br/>
		<button name='btGen' type='submit'>Générer</button>
		<button type='reset'>Réinitialiser</button>
		<button type='button' onclick='javascript: raz("#iStart"); raz("#iStop");'>Remise à zéro</button>
	</form>
	<br/>
	<pre><?php include( "ActionFibo.php" ); ?></pre>
<?php include( "../Common/HTMLEnd.php" ); ?>