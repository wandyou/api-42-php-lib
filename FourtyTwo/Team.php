<?php

namespace FourtyTwo;

/**
 * Class Team : represents an team object
 * 
 * @package Team
 * @author Nathan Lafarge
 */
class Team
{
	/**
	 * Method to get a team
	 * 
	 * @param int $team_id The ID of the tead to retrieve
	 * @return object A stdClass representing the team
	 */
	public static function get($team_id)
	{
		return (FourtyTwo::makeRequest("teams/" . $team_id));
	}
}