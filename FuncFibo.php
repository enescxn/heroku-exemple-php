<?php
	define("FN2", 0);
	define("FN1", 1);
	$tabFibo = null;	// $tabFibo peut être un array ou autre
	
	function fibo(?int $iStart = 0, ?int $iStop = 100) : array
	{
		$fn = [FN2, FN1];
		for($n = 2; $n <= $iStop; ++$n)
			$fn[] = $fn[$n-1] + $fn[$n-2];
		
		return array_slice($fn, $iStart);	//return un sous tableau
	}
	
	function fibo_global(?int $iStart = 0, ?int $iStop = 100) : void
	{
		$fn = [FN2, FN1];
		for($n = 1; $n < $iStop; ++$n)
			$fn[] = $fn[$n] + $fn[$n-1];
		
		$GLOBALS['tabFibo'] = array_slice($fn, $iStart);
	}
	
	function fibo_GlobalOptimise(?int $iStart = 0, ?int $iStop = 100) : void
	{
		global $tabFibo;
		
			 if( $iStart == 0 )	$tabFibo = [FN2, FN1];
		else if( $iStart == 1 )	$tabFibo = [FN1];
		else					$tabFibo = [];
		
		$fn2 = FN2;
		$fn1 = FN1;
		$i = 2;
		while( $i <= $iStop )
		{
			$fn = $fn1 + $fn2;
			if( ++$i > $iStart )
				$tabFibo[] = $fn;
			
			$fn2 = $fn1;
			$fn1 = $fn;
		}
	}
	
	function fibo_ref(?array &$tabRef, ?int $iStart = 0, ?int $iStop = 100) : void
	{
			 if( $iStart == 0 )	$tabRef = [FN2, FN1];
		else if( $iStart == 1 )	$tabRef = [FN1];
		else					$tabRef = [];
		
		$fn2 = FN2;
		$fn1 = FN1;
		$i = 2;
		while( $i <= $iStop )
		{
			$fn = $fn1 + $fn2;
			if( ++$i > $iStart )
				$tabRef[] = $fn;
			
			$fn2 = $fn1;
			$fn1 = $fn;
		}
	}
	
	function fibo_str(?int $iStart = 0, ?int $iStop = 100) : string
	{
		$fn2 = FN2;
		$fn1 = FN1;
		$SuiteFibo = "";
		
			 if( $iStart == 0 )	$SuiteFibo = "$fn2 $fn1 ";
		else if( $iStart == 1 )	$SuiteFibo = "$fn1 ";
		
		$i = 2;
		while( $i <= $iStop )
		{
			$fn = $fn1 + $fn2;
			if( ++$i > $iStart )
				$SuiteFibo .= "$fn ";
			
			$fn2 = $fn1;
			$fn1 = $fn;
		}
		
		return $SuiteFibo;
	}
	
	function fibo_recurse(?int $n)
	{
		if( $n == 0 )	return FN2;
		if( $n == 1 )	return FN1;
		
		return fibo_recurse(--$n) + fibo_recurse(--$n);
	}
	
	function fibo_StartRecurse(?int $iStart = 0, ?int $iStop = 100) : array
	{
			 if( $iStart == 0 ){	$tabFibo = [FN2, FN1];	$iStart = 2; }
		else if( $iStart == 1 ){	$tabFibo = [FN1];		$iStart = 2; }
		else						$tabFibo = [];
		
		while( $iStart <= $iStop )
			array_push($tabFibo, fibo_recurse($iStart++));
		
		return $tabFibo;
	}
	
	// retrouver une valeur un élément N de fibonacci sans calculer l'ensemble des éléments
	// ==> formule de binet
	function fibo_binet(?int $n) : int
	{
		$R5 = sqrt(5);
		return (1/$R5) * ( pow(((1+$R5)/2),$n) - pow(((1-$R5)/2),$n) );
	}
	
	function fibo_StartBinet(?int $iStart = 0, ?int $iStop = 100) : array
	{
			 if( $iStart == 0 ){	$tabFibo = ["f0" => FN2, "f1" => FN1];	$iStart = 2; }
		else if( $iStart == 1 ){	$tabFibo = ["f1" => FN1];				$iStart = 2; }
		else						$tabFibo = [];
		
		while( $iStart <= $iStop )
			$tabFibo["f$iStart"] = fibo_binet($iStart++);
		
		return $tabFibo;
	}
?>