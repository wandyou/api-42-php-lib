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
	 * @var class Logtime Logtime Class containing the last 4 months of logtime for the user
	 */
	protected	$_logtime;

	/**
	 * @var 
	 */
	protected	$_corrections;

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
	 * Get the logtime info of a user
	 * 
	 * @param void
	 * @return object Logtime Returns a Logtime object for the current user
	 */
	public function getLogtime()
	{
		if (!$this->_logtime)
			$this->_logtime = new Logtime($this->_id);
	}

	/**
	 * Get the corrections of a user
	 * 
	 * @param void
	 * @return array An array with all the last corrections of a user
	 */
	public function getCorrections()
	{
		if (!$this->_corrections)
			$this->_corrections = Correction::getCorrections($this->_id);
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