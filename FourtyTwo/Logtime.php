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
	 * This method returns the logtime for the given user
	 * 
	 * @param int $user_id The ID of the user
	 * @param object Option The options to pass to this request
	 * @return int The logtime
	 */
	public static function get($user_id, $options = null)
	{
		$request = FourtyTwo::makeRequest("users/" . $user_id . "/locations_stats", false, "GET", $options);
		$tmp_logtime = 0;

		foreach ($request as $key => $logtime)
			$tmp_logtime += self::clockToSeconds($logtime);

		return ($tmp_logtime);
	}


	/**
	 * This function takes a timer that looks like HH:MM:SS and returns the same time but only in seconds
	 * 
	 * @param void
	 * @return int The number of seconds in the timer given
	 */
	protected static function clockToSeconds($logtime)
	{
		$time = 0;
		$logtime = explode(":", $logtime);
		$time += ($logtime[0] * 60 * 60);
		$time += ($logtime[1] * 60);

		return ($time);
	}
}