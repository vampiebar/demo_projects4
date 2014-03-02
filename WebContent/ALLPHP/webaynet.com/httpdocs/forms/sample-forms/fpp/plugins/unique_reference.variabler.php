<?php
	function unique_reference_variabler(){
		$guid 		= strtoupper(uniqid(mt_rand()));
		$guid[6]	= '-';
		$guid		= substr($guid, 0, 12);
	
		return $guid;
	}
?>