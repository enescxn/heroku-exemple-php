<?php
	// Rappel : $_REQUEST = $_GET, $_POST et $_COOKIE - récupération des infos dans quel ordre ??
	// ==> explication plausible : $_COOKIE Set d'abord $_REQUEST puis $_GET étant vide, il va vider la variable $_REQUEST associé
	// ==> La doc PHP et fausse ou altéré selon la version PHP, après changement du nom du formulaire (iStart devient iStarted) $_REQUEST['iStart'] devrait retourner $_COOKIE['iStart'] or ce n'est pas le cas
	// ==> explication dans la doc (user contribution), REQUEST et set par une seul méthode ($_GET OU $_POST OU $_COOKIE)
	// ==> comme on est dans un envoi de formulaire, c'est la méthode du formulaire ($_GET dans notre cas) qui serra utiliser
	// ==> utiliser $_SERVER['REQUEST_METHOD'] pour le savoir
	//$iStart = ( !empty($_REQUEST['iStart']) ? $_REQUEST['iStart'] : null );	// ne prend pas en compte $_COOKIE
	//$iStop  = ( !empty($_REQUEST['iStop'])  ? $_REQUEST['iStop']  : null );	// ne prend pas en compte $_COOKIE
		
	$iStart = ( !empty($_COOKIE['iStart']) ? $_COOKIE['iStart'] : null );
	$iStop  = ( !empty($_COOKIE['iStop'])  ? $_COOKIE['iStop']  : null );
	
	$OnSubmitForm = isset($_REQUEST['btGen']);
	if( $OnSubmitForm )
	{
		// les infos envoyées par formunaires prime sur les Cookies qui n'ont surement plus la même valeur
		$iStart = ( !empty($_REQUEST['iStart']) ? $_REQUEST['iStart'] : null );
		$iStop  = ( !empty($_REQUEST['iStop'])  ? $_REQUEST['iStop']  : null );
		
		// on génère les cookies seulement au premier envoi du formulaire
		// autrement dit, au premier clique sur Générer
		echo "<i>setcookie (iStart = $iStart, iStop = $iStop) !!</i><br/><br/>";
		
		// if( !isset($_COOKIE['iStart']) )		// on veut mettre à jours l'info à chaque envoi
			setcookie('iStart', $iStart, time() + 3600*12);	// conserver l'info pour 12h
		// if( !isset($_COOKIE['iStop']) )		// on veut mettre à jours l'info à chaque envoi
			setcookie('iStop',  $iStop,  time() + 3600*12);	// conserver l'info pour 12h
	}
	/******************************************/
	/************    LOG DEBUG  ***************/
	else if( !empty($_REQUEST['iStart']) )
	{
		// jamais ici sauf si on enlève le param 'btSend' de l'URL
		
		echo  "<i>\$_REQUEST['iStart']			= ".$_REQUEST['iStart']."<br/>"
				."\$_GET['iStart']				= ".$_GET['iStart']."<br/>"
				."\$_COOKIE['iStart']			= ".$_COOKIE['iStart']."<br/>"
				."\$_SERVER['REQUEST_METHOD']	= ".$_SERVER['REQUEST_METHOD']."</i><br/><br/>";
	}
	else if( !empty($_COOKIE['iStart']) )
	{
		echo "<i>\$_REQUEST['iStart'] vide mais \$_COOKIE['iStart'] = ".$_COOKIE['iStart']."!</i><br/><br/>";
	}
	else
		echo  "<i>\$_REQUEST['iStart'] ET \$_COOKIE['iStart'] vide !</i><br/><br/>";
	/******************************************/

?>