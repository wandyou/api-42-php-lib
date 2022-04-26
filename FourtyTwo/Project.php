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
	 * @var int $_id The ID of the project
	 */
	protected	$_id;

	/**
	 * @var string $_name The name of the project
	 */
	protected	$_name;

	/**
	 * @var int	$_final_mark The final mark of the project
	 */
	protected	$_final_mark;

	/**
	 * @var	int	$_current_team_id The Id of the current team of the project
	 */
	protected	$_current_team_id;

	/**
	 * @var bool $_corrected Bool representing if the project has been corrected or not
	 */
	protected	$_corrected;

	/**
	 * This method casts a stdClass object to a Project object
	 * 
	 * @param object $stdClass
	 * @return object Project
	 */
	public function cast($stdClass)
	{
		$this->_id = $stdClass->project->id;
		$this->_name = $stdClass->project->name;
		$this->_final_mark = $stdClass->final_mark;
		$this->_current_team_id = $stdClass->current_team_id;

		$scale_teams = Team::get($this->_current_team_id)->scale_teams;
		if (count($scale_teams) > 0)
			$this->_corrected = true;
		else
			$this->_corrected = false;

		return ($this);
	}

	/**
	 * Get the projects of a user
	 * 
	 * @var int $_user_id
	 * @return array An array with the projects of the user
	 */
	public static function getUserProjects($user_id, $options = null)
	{
		$request = FourtyTwo::makeRequest("users/" . $user_id . "/projects_users", false, "GET", $options);
		$return = array();

		foreach ($request as $key => $tmp)
		{
			$project = new Project;
			$return[] = $project->cast($tmp);
		}

		return ($return);
	}
}