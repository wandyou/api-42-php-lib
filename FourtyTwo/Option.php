<?php

namespace FourtyTwo;

/**
 * Class Option : represents an option object that can be passed to the makeRequest method
 * 
 * @package Option
 * @author Nathan Lafarge
 */
class Option
{
	/**
	 * @var array $_sort An array containing the sorting rules
	 */
	protected	$_sort;

	/**
	 * @var array $_range An array containing the range rules
	 */
	protected	$_range;

	/**
	 * @var array $_filter An array containing the filter rules
	 */
	protected	$_filter;

	/**
	 * @var array $_custom An array containing the custom rules
	 */
	protected	$_custom;

	/**
	 * This method generates a url friendly string that can be appended on a request route
	 * 
	 * @param void
	 * @return string The url friendly string that can be appended
	 */
	public function generate()
	{
		$url = "";
		if ($this->_sort != NULL):
			$sort_option = "sort=";
			foreach ($this->_sort as $sort)
			{
				$sort_option .= $sort . ",";
			}
			$url .= $sort_option;
			$url = substr($url, 0, -1);
			$url .= "&";
		endif;
		if ($this->_range != NULL):
			$range_option = "";
			foreach ($this->_range as $key => $range)
			{
				$range_option .= "range[" . $key . "]=" . $range["min"] . "," . $range["max"] . "&";
			}
			$url .= $range_option;
		endif;
		if ($this->_filter != NULL):
			$filter_option = "";
			foreach ($this->_filter as $key => $filter)
			{
				$tmp_filter_option = "";
				foreach ($filter as $cle => $fil)
					$tmp_filter_option .= $fil . ",";
				$tmp_filter_option = substr($tmp_filter_option, 0, -1);
				$filter_option .= "filter[" . $key . "]=" . $tmp_filter_option . "&";
			}
			$url .= $filter_option;
		endif;
		if ($this->_custom != NULL):
			foreach ($this->_custom as $key => $custom)
				$url .= $key . "=" . $custom . "&";
		endif;

		return (substr($url, 0, -1)); // Remove the trailing &
	}

	/**
	 * This method adds a custom rule
	 * 
	 * @param string $custom_key The key of the custom rule
	 * @param string $custom_value The value of the custom rule
	 * @return array The custom rules
	 */
	public function addCustom($custom_key, $custom_value)
	{
		$this->_custom[$custom_key] = $custom_value;
		
		return ($this->_custom);
	}

	/**
	 * This method adds a sorting rule.
	 * 
	 * @param string $sorting_key The key on which we sould sort
	 * @param string $sorting_way The way the sort should be done (asc, or desc)
	 * @return array The sorting rules
	 */
	public function addSort($sorting_key, $sorting_way = "desc")
	{
		if ($sorting_way == "desc")
			$sorting_value = "-" . $sorting_key;
		else if ($sorting_way == "asc")
			$sorting_value = $sorting_key;
		else
			throw new \Exception("The sorting way \"" . $sorting_way . "\" is not valid");

		$this->_sort[$sorting_key] = $sorting_value;
		return ($this->_sort);
	}

	/**
	 * This method adds a range rule
	 * 
	 * @param string $range_key The key on which the range will be applied
	 * @param string $range_min The minimum of the range
	 * @param string $range_max The maximum of the range
	 * @return array The range rules
	*/
	public function addRange($range_key, $range_min, $range_max)
	{
		$this->_range[$range_key] = ["min" => $range_min, "max" => $range_max];

		return ($this->_range);
	}

	/**
	 * This method adds a filter rule
	 * 
	 * @param string $filter_key The key on which the filter will be applied
	 * @param string $filter_values The values for the filter
	 * @return array The filter rules
	 */
	public function addFilter($filter_key, ...$filter_values)
	{
		if (!$filter_values)
			return ($this->_filter);

		foreach ($filter_values as $filter_value)
			$filters[] = $filter_value;

		$this->_filter[$filter_key] = $filters;
		return ($this->_filter);
	}
}