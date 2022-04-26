<?php

namespace FourtyTwo;

/**
 * Class User : represents a user object
 * 
 * It allows you to make all the actions related to the user really easily
 * 
 * @package User
 * @author Nathan Lafarge
 */
class User
{
	/**
	 * @var int $_id User's ID
	 */
	protected	$_id;

	/**
	 * @var string $_email User's Email
	 */
	protected	$_email;

	/**
	 * @var string $_login User's login
	 */
	protected	$_login;

	/**
	 * @var string $_displayname Display name of the user (can be different from the combination of the first name + last name)
	 */
	protected	$_displayname;

	/**
	 * @var string $_img Link to the user's image on the 42 CDN
	 */
	protected	$_img;

	/**
	 * @var int $_isConnected Is the user connected at a campus
	 */
	protected	$_isConnected;

	/**
	 * @var string $_location Where is connected the user in his campus
	 */
	protected	$_location;

	/**
	 * @var array $_groups Groups in wich belongs the user
	 */
	protected	$_groups;

	/**
	 * @var int $_week_logtime The logtime of the week
	 */
	protected	$_week_logtime;

	/**
	 * @var int $_day_logtime The logtime of the day
	 */
	protected	$_day_logtime;

	/**
	 * @var	array $_corrections_as_corrector An array containing all of the corrections as corrector for the user
	 */
	protected	$_corrections_as_corrector;

	/**
	 * @var array $_corrections_as_corrected An array containing all of the corrections as corrected for the user
	 */
	protected	$_corrections_as_corrected;

	/**
	 * @var array $events An array containing the events a user went to
	 */
	protected	$_events;

	/**
	*	The $id must be the ID of the user
	*/
	public function __construct($id)
	{
		$tmp_user = FourtyTwo::makeRequest("users/" . $id);
		$this->_id = intval($tmp_user->id);
		$this->_email = $tmp_user->email;
		$this->_login = $tmp_user->login;
		$this->_displayname = $tmp_user->displayname;
		$this->_img = $tmp_user->new_image_url;
		$this->_groups = $tmp_user->groups;

		if ($tmp_user->location != NULL)
		{
			$this->_isConnected = 1;
			$this->_location = $tmp_user->location;
		}
		else
		{
			$this->_isConnected = 0;
			$this->_location = NULL;
		}
	}

	/**
	 * Get the events that a user went to
	 * 
	 * @param array $options The options for the request
	 * @return array The events that a user went to
	 */
	public function getEvents($options = null)
	{
		if (!$this->_events)
			$this->_events = Event::getEventsofUser($this->_id, $options);
	}

	/**
	 * Get the projects of the user
	 * 
	 * @param void
	 * @return array The projects of the user
	 */
	public function getProjects()
	{
		return (Project::getUserProjects($this->_id));
	}

	/**
	 * Get the logtime of the day for the user
	 * 
	 * @param void
	 * @return int The logtime of the user for the day
	 */
	public function getLogtime()
	{
		$options = new Option;
		$options->addCustom("begin_at", date("Y-m-d"));

		if (!$this->_day_logtime)
			$this->_day_logtime = Logtime::get($this->_id, $options);

		return ($this->_day_logtime);
	}

	/**
	 * Get the logtime of the week for the user
	 * 
	 * @param void
	 * @return int The logtime of the user for the week
	 */
	public function getWeekLogtime()
	{
		$options = new Option;
		$options->addCustom("begin_at", date("Y-m-d", strtotime("monday this week")));

		if (!$this->_week_logtime)
			$this->_week_logtime = Logtime::get($this->_id, $options);
		
		return ($this->_week_logtime);
	}

	/**
	 * Get the corrections of a user where he is the corrector
	 * 
	 * @param array $options Options that will be passed to the makeRequest call
	 * @return array An array with all the last corrections of a user
	 */
	public function getCorrectionsAsCorrector($options = null)
	{
		if (!$this->_corrections_as_corrector)
			$this->_corrections_as_corrector = Correction::getCorrectionsAsCorrector($this->_id, $options);
	}

	/**
	 * Get the corrections of a user where he is the corrected
	 * 
	 * @param array $options Options that will be passed to the makeRequest call
	 * @return array An array with all the last corrections of a user
	 */
	public function getCorrectionsAsCorrected($options = null)
	{
		if (!$this->_corrections_as_corrected)
			$this->_corrections_as_corrected = Correction::getCorrectionsAsCorrected($this->_id, $options);
	}

	/**
	 * Get the email of the user
	 * 
	 * @param void
	 * @return string The e-mail of the user
	 */
	public function getEmail()
	{
		return ($this->_email);
	}

	/**
	 * Get the ID of the user
	 * 
	 * @param void
	 * @return int The id of the user
	 */
	public function getID()
	{
		return ($this->_id);
	}

	/**
	 * Get the login of the user
	 * 
	 * @param void
	 * @return string The login of the user
	 */
	public function getLogin()
	{
		return ($this->_login);
	}

	/**
	 * Get the displayname of the user
	 * 
	 * @param void
	 * @return string The displayname of the user
	 */
	public function getDisplayname()
	{
		return ($this->_displayname);
	}

	/**
	 * Get the path to the users profil image
	 * 
	 * @param void
	 * @return string The path to the image
	 */
	public function getImg()
	{
		return ($this->_img);
	}

	/**
	 * Get the groups where the user is present
	 * 
	 * @param void
	 * @return array The groups where the user is present
	 */
	public function getGroups()
	{
		return ($this->_groups);
	}

	/**
	 * Get the users connection status on a campus
	 * 
	 * @param void
	 * @return int Returns 1 or 0 depending if the user is connected or not in a campus
	 */
	public function getConnection()
	{
		return ($this->_isConnected);
	}

	/**
	 * Get the users current location in a campus
	 * 
	 * @param void
	 * @return string Returns a string representing the name of the computer on which the user is connected
	 */
	public function getLocation()
	{
		return ($this->_location);
	}	
}