<?php
	$DBHost  = "localhost";
	$DBName  = "epldt_landers_abandoned_cart";
	$charset = "utf8";

	$DSN   ="mysql: host=$DBHost; dbname=$DBName; charset=$charset";
	$DBUser="root";
	$DBPass="";
	$DBOptions = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];

	try {
		$pdo = new PDO($DSN, $DBUser, $DBPass, $DBOptions);
	}
	catch (PDOException $e) {
		die ("Could not connect to database!" . $crlf . $crlf . $e->getMessage() .  $crlf . $crlf . "Please contact the System Administrator.");
	}
?>