<?php

namespace FourtyTwo;

/**
 * Class Project : represents an project object
 * 
 * @package Project
 * @author Nathan Lafarge
 */
class Project
{
	/**
	 * Get the projects of a user
	 * 
	 * @var int $_user_id
	 * @return array An array with the projects of the user
	 */
	public static function getUserProjects($user_id)
	{
		return (FourtyTwo::makeRequest("users/" . $user_id . "/projects_users"));
	}
}