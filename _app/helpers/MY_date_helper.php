<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');





// 2010-08-13 at 4:34 PM
function dateAndTimeFormattedForDisplayShortVersion($date) {

	if (($date == '0000-00-00') || ($date == '')) {
		
		$return_value = '';
		
	} else {
		
		$return_value = date("Y-m-d", strtotime($date)) . ' at ' . date("g:i A", strtotime($date));
		
	}

	return $return_value;

} // end of - function dateFormattedForDisplayLongVersion



// August 13, 2010
function dateFormattedForDisplayLongVersion($date) {

	if (($date == '0000-00-00') || ($date == '')) {
		
		$return_value = '';
		
	} else {
		
		$return_value = date("F d, Y", strtotime($date));
		
	}

	return $return_value;

} // end of - function dateFormattedForDisplayLongVersion



// Friday August 13, 2010
function dateFormattedForDisplayLongVersionWithDayName($date) {

	if (($date == '0000-00-00') || ($date == '')) {
		
		$return_value = '';
		
	} else {
		
		$return_value = date("l F d, Y", strtotime($date));
		
	}

	return $return_value;

} // end of - function dateFormattedForDisplayLongVersionWithDayName


// August 13, 2010 at 4:34 PM
function dateAndTimeFormattedForDisplayLongVersion($date) {

	if (($date == '0000-00-00') || ($date == '')) {
		
		$return_value = '';
		
	} else {
		
		$return_value = date("l F d, Y", strtotime($date)) . ' at ' . date("g:i A", strtotime($date));
		
	}

	return $return_value;

} // end of - function dateAndTimeFormattedForDisplayLongVersionWithDayName


// Friday August 13, 2010 at 4:34 PM
function dateAndTimeFormattedForDisplayLongVersionWithDayName($date) {

	if (($date == '0000-00-00') || ($date == '')) {
		
		$return_value = '';
		
	} else {
		
		$return_value = date("l F d, Y", strtotime($date)) . ' at ' . date("g:i A", strtotime($date));
		
	}

	return $return_value;

} // end of - function dateAndTimeFormattedForDisplayLongVersionWithDayName


/* End of file MY_date_helper.php */
/* Location: ./application/helpers/MY_date_helper.php */