<?php

namespace FourtyTwo;

/**
 * Class Correction : represents a correction object
 * 
 * @package Correction
 * @author Nathan Lafarge
 */
class Correction
{
	/**
	 * @var string $_correcteds Login of the corrected users
	 */
	protected 	$_correcteds;

	/**
	 * @var string $_project Name of the corrected project
	 */
	protected 	$_project;

	/**
	 * @var int $_scale Scale for the correction
	 */
	protected 	$_scale;

	/**
	 * @var string $_filled_at Date when the correction has been filled
	 */
	protected 	$_filled_at;

	/**
	 * @var string $_url Url to the feedback
	 */
	protected	$_url;

	public function cast($stdClass)
	{
		$this->_correcteds = $stdClass->correcteds;
		$this->_project = $stdClass->team->project_id;
		$this->_scale = $stdClass->final_mark;
		$this->_filled_at = $stdClass->filled_at;
		$this->_url = "https://projects.intra.42.fr/" . $this->_project . "/" . $this->_correcteds[0]->login;

		return ($this);
	}

	/**
	 * Récupère les corrections d'un utilisateur en tant que correcteur
	 * 
	 * @param int $user_id ID of the user that is the corrector
	 * @param array $options Optional array that contains the options for the request
	 * @return array Return an array containing Correction objects
	 */
	public static function getCorrectionsAsCorrector($user_id, $options = null)
	{
		$request = FourtyTwo::makeRequest("users/" . $user_id . "/scale_teams/as_corrector", false, "GET", $options);
		$return = array();
		
		foreach ($request as $key => $tmp)
		{
			$correction = new Correction;
			$return[] = $correction->cast($tmp);
		}

		return ($return);
	}

	/**
	 * This method get all of the corrections of a given user where he is the one being corrected
	 * 
	 * @param int $user_id ID of the user that is corrected
	 * @param array $options Optional array that contains the options for the request
	 * @return array Return an array containing Correction objects
	 */
	public static function getCorrectionsAsCorrected($user_id, $options = null)
	{
		$request = FourtyTwo::makeRequest("users/" . $user_id . "/scale_teams/as_corrected", false, "GET", $options);
		$return = array();
		
		foreach ($request as $key => $tmp)
		{
			$correction = new Correction;
			$return[] = $correction->cast($tmp);
		}

		return ($return);
	}

	/**
	 * Get the Login of the corrected user
	 * 
	 * @param void
	 * @return string
	 */
	public function getCorrectedLogin()
	{
		return ($this->_corrected);
	}

	/**
	 * Get the name of the corrected project
	 * 
	 * @param void
	 * @return string
	 */
	public function getProjectName()
	{
		return ($this->_project);
	}

	/**
	 * Get the final scale of the correction
	 * 
	 * @param void
	 * @return int
	 */
	public function getScale()
	{
		return ($this->_scale);
	}

	/**
	 * Get the date at which the correction has been filled
	 * 
	 * @param void
	 * @return string
	 */
	public function getFilledAtDate()
	{
		return ($this->_filled_at);
	}
}