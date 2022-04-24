<?php 

namespace FourtyTwo;

class Events
{
	public function __construct($id)
	{
		$tmp = FourtyTwo::makeRequest("/v2/events/" . $id);

		echo "<pre>";
		var_dump($tmp);
		echo "</pre>";
	}	
}