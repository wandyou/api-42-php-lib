<?php 

namespace FourtyTwo;

/**
 * Class Event : represents an event object
 * 
 * @package Event
 * @author Nathan Lafarge
 */
class Event
{
	/**
	 * @var int $_id The ID of the event
	 */
	protected	$_id;

	/**
	 * @var string $_name The name of the event
	 */
	protected	$_name;

	/**
	 * @var object Date $_begin_at The start date of the event
	 */
	protected	$_begin_at;

	/**
	 * @var object Date $_end_at The end date of the event
	 */
	protected	$_end_at;

	/**
	 * Cast from a stdClass Event object given by the Intra
	 * 
	 * @param int $_id The ID of the event
	 * @param string $_name The name of the event
	 * @param string $_begin_at The start date of the event
	 * @param string $_end_at The end date of the event
	 * @return object Event The event that has been casted
	 */
	public function cast($stdClass)
	{
		$this->_id = $stdClass->id;
		$this->_name = $stdClass->name;
		$this->_begin_at = new \DateTime($stdClass->begin_at);
		$this->_end_at = new \DateTime($stdClass->end_at);

		return ($this);
	}

	/**
	 * Get the list of all the events for a given user
	 * 
	 * @param int $user_id The ID of the user
	 * @param array The options for the request
	 * @return array The events of a user
	 */
	public static function getEventsofUser($user_id, $options = NULL)
	{
		$request = FourtyTwo::makeRequest("users/" . $user_id . "/events", false, "GET", $options);
		$return = array();

		foreach ($request as $key => $tmp)
		{
			$event = new Event;
			$return[] = $event->cast($tmp);
		}

		return ($return);
	}	
}