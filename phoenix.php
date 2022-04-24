<style>
	html {
		background-color: black;
		color: white;
	}
</style>

<?php

use FourtyTwo\FourtyTwo;
use FourtyTwo\User;
use FourtyTwo\Events;

const PHOENIX_GROUP_ID = 47;

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

require("FourtyTwo/Autoloader.php");
\FourtyTwo\Autoloader::register();

echo "<pre>";
//$event = new Events(9739);
echo "</pre>";