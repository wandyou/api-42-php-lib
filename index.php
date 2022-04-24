<?php

use App\FourtyTwo;

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

require("app/Autoloader.php");
\App\Autoloader::register();

$events = array(
	5018,
	5019,
	5020,
	5021,
	5022,
	5203,
	5316,
	5318,
	5441,
	5459,
	5504,
	5608,
	5609,
	5747,
	5801,
	5720,
	5893,
	5749,
	6304,
	6929,
	6969,
	7173,
	7212,
	7262,
	7442,
	7506,
	7542,
	7530,
	8431,
	9122,
	9241,
	9242,
	9443
);

echo "<pre>";
foreach ($events as $event):
	$event = FourtyTwo::getEvent($event);
	$feedbacks = FourtyTwo::getFeedbacks($event->id);
	$total_score = 0;
	$nb_feedbacks = count($feedbacks);
	$rating = 0;

	foreach ($feedbacks as $feedback)
		$total_score += $feedback->rating;

	if ($nb_feedbacks > 0)
		$rating = $total_score / $nb_feedbacks;
	else
		$rating = "N/B";

	//var_dump($feedbacks);
	echo "Event : " . $event->name . "<br/>";
	echo "Date : " . substr($event->begin_at, 0, 10) . "<br/>";
	echo "Participants : " . $event->nbr_subscribers . "<br/>";
	echo "Feedbacks : " . $nb_feedbacks . "<br/>";
	echo "Rating : " . $rating . "<br/>";
	echo "<br/>";
endforeach;
echo "</pre>";