<style>
	html {
		background-color: black;
		color: white;
	}
</style>

<?php

use FourtyTwo\FourtyTwo;
use FourtyTwo\User;
use FourtyTwo\Option;
use FourtyTwo\Project;

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

require("FourtyTwo/Autoloader.php");
\FourtyTwo\Autoloader::register();

try {
	echo "<pre>";
	$this_week = date("Y-m-d", strtotime("monday this week"));
	$this_month = date("Y-m-d", strtotime("first day of this month"));
	$today = date("Y-m-d");

	$correction_options = new Option;
	$correction_options->addRange("filled_at", $this_month, $today);

	$event_options = new Option;
	$event_options->addRange("begin_at", $this_month, $today);

	$project_options = new Option;
	$project_options->addFilter("status", "finished");
	$project_options->addRange("updated_at", $this_month, $today);

	// $logtime_options = new Option;
	// $logtime_options->addCustom("begin_at", $this_week);

	$user = new User("nlafarge");
	//$user->getEvents($event_options);
	//$user->getLogtime();
	//$user->getWeekLogtime();
	//$user->getCorrectionsAsCorrector($correction_options);
	//$user->getCorrectionsAsCorrected($correction_options);
	$week_project = $user->getProjects($project_options);
	var_dump($week_project);
	//var_dump($user);
	echo "</pre>";
}
catch (Exception $e)
{
	echo($e);
}