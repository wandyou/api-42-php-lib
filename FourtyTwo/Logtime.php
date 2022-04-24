<?php

namespace FourtyTwo;

/**
 * Class Logtime : represents the logtime of a user object
 * 
 * It allows you to access specific logtimes when needed and make logtime calculations easily
 * 
 * @package Logtime
 * @author Nathan Lafarge
 */
class Logtime
{
	/**
	 * @var int $_weekLogtime Logtime for the week
	 */
	protected	$_weekLogtime = 0;

	/**
	 * @var int $_dayLogTime Logtime for the day
	 */
	protected	$_dayLogtime = 0;

	/**
	 * The ID must be a valid 42 user ID
	 */
	public function __construct($user_id)
	{
		$this_week = strtotime("this week");
		$week = date("Y-m-d", $this_week);

		$tmp = FourtyTwo::makeRequest("users/" . $user_id . "/locations_stats?begin_at=" . $week);
		foreach ($tmp as $key => $logtime)
		{
			if ($key == date("Y-m-d"))
				$this->_dayLogtime = $this->clockToSeconds($logtime);

			$this->_weekLogtime += $this->clockToSeconds($logtime);
		}
	}

	/**
	 * This function takes a timer that looks like HH:MM:SS and returns the same time but only in seconds
	 * 
	 * @param void
	 * @return int The number of seconds in the timer given
	 */
	protected function clockToSeconds($logtime)
	{
		$time = 0;
		$logtime = explode(":", $logtime);
		$time += ($logtime[0] * 60 * 60);
		$time += ($logtime[1] * 60);

		return ($time);
	}
}