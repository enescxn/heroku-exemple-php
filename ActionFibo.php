<?php
	require_once("FuncFibo.php");
	
	if( $OnSubmitForm )
	{
		if( session_status() === PHP_SESSION_NONE )
			session_start();	// initialiser ou récupérer les infos $_SESSION (uniquement pour la génération fibo)
		
		// récupération en SESSION si cela était fait précédement (uniquement la génération précédante)
		if( !empty($_SESSION['fibo'])
		&&( $_SESSION['last_iStart'] === $iStart)
		&&( $_SESSION['last_iStop']  === $iStop) )
		{
			echo "<b>Récupération (SESSION) de la suite de Fibonacci pour l'interval $iStart à $iStop :</b>\n";
			print_r( $_SESSION['fibo'] );
		}
		// récupération dans un fichier / BDD si présent
		else if( false )
		{
			echo "<b>Récupération (FILES / BDD) de la suite de Fibonacci pour l'interval $iStart à $iStop :</b>\n";
			// TO DO
		}
		else
		{
			// Génération de la suite + affichage
			echo "<b>Génération de la suite de Fibonacci pour l'interval $iStart à $iStop :</b>\n";
			echo "<h5>Par retour array :</h5>";
			$TabFibo = fibo($iStart, $iStop);
			print_r( $TabFibo );
			
			echo "<h5>Par variable GLOBALS :</h5>";
			fibo_global($iStart, $iStop);
			print_r( $tabFibo );
			
			echo "<h5>Par instruction global :</h5>";
			fibo_GlobalOptimise($iStart, $iStop);
			print_r( $tabFibo );
			
			echo "<h5>Par référence :</h5>";
			fibo_ref($tabFibo, $iStart, $iStop);
			print_r( $tabFibo );
			
			echo "<h5>Par concaténation et retour string :</h5>";
			print( fibo_str($iStart, $iStop) );
			
			echo "<h5>Par récursivité :</h5>";
			print_r( fibo_StartRecurse($iStart, $iStop) );
			
			echo "<h5>Par la formule de binet (sans calculer l'ensemble des éléments) :</h5>";
			print_r( fibo_StartBinet($iStart, $iStop) );
			
			// Inscription de la dernière génération en SESSION
			$_SESSION['fibo'] 		 = $TabFibo;
			$_SESSION['last_iStart'] = $iStart;
			$_SESSION['last_iStop']  = $iStop;
			
			// inscription dans un fichier par écrassement
			$FileName = "SuiteFibonacci.txt";
			$file = fopen($FileName, "w");
			if( $file )
			{
				// RAPPEL : fputs <==> fwrite
				// utiliser "strval" pour convertir un entier en chaine ou "implode" pour convertir un tableau en chaine
				fputs($file, "iStart : $iStart, iStop : $iStop\n");
				fwrite($file, "Suite de Fibonacci : ".fibo_str($iStart, $iStop));
				fclose($file);
			}
			else
				echo "EREUR lors de l'ouverture du fichier $FileName<br/>";
			
			// inscription dans la BDD (uniquement si pas déjà réalisé)
			// TO DO
			
		}
	}
?>