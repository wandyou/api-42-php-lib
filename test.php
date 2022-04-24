<style>
	html {
		background-color: black;
		color: white;
	}
</style>

<?php

use FourtyTwo\FourtyTwo;
use FourtyTwo\User;

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

require("FourtyTwo/Autoloader.php");
\FourtyTwo\Autoloader::register();

try {
	$user = new User("nlafarge");
	$user->getLogtime();
	sleep(2);
	$user->getCorrections();
}
catch (Exception $e)
{
	echo($e);
}

echo "<pre>";
//var_dump($user);
echo "</pre>";