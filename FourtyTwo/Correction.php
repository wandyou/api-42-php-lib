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
	 * @var string $_corrected Login of the corrected user
	 */
	protected $_corrected;

	/**
	 * @var string $_project Name of the corrected project
	 */
	protected $_project;

	/**
	 * @var int $_scale Scale for the correction
	 */
	protected $_scale;

	/**
	 * @var string $_filled_at Date when the correction has been filled
	 */
	protected $_filled_at;

	public function __construct($corrected, $project, $scale, $filled_at)
	{
		$this->_corrected = $corrected;
		$this->_project = $project;
		$this->_scale = $scale;
		$this->_filled_at = $filled_at;
	}

	public static function getCorrections($user_id)
	{
		$tmp = FourtyTwo::makeRequest("users/" . $user_id . "/scale_teams/as_corrector");
		$corrections = array();
		
		foreach ($tmp as $key => $correction)
		{
			//$corrections[] = new Correction($correction->correcteds[0]->login, )
		}
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