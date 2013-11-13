<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('mysql_to_format'))
{
	function mysql_to_format($datetime, $format = 'j M Y')
	{
		$timestamp = human_to_unix($datetime);
		
		return date($format, $timestamp);
	}
}
 
if ( ! function_exists('unix_to_mysql'))
{
	function unix_to_mysql($timestamp)
	{
		return date('Y-m-d H:i:s', $timestamp);
	}
}

if ( ! function_exists('human_to_mysql'))
{
	function human_to_mysql($date, $time = null)
	{
		$parts = explode('/', $date);
		
		if( ! empty($time))
		{
			if(is_array($time))
			{
				$t = $time['hours'] . ':' . $time['minutes'];
			} else
			{
				$t = $time;
			}
		} else
		{
			$t = $time;
		}
		
		return trim($parts[2] . '-' . $parts[1] . '-' . $parts[0] . ' ' . $t);
	}
}

if ( ! function_exists('day_of_week'))
{
	function day_of_week($i)
	{
		$days = array(
			1	=> 'Monday',
			2	=> 'Tuesday',
			3 	=> 'Wednesday',
			4 	=> 'Thursday',
			5 	=> 'Friday',
			6 	=> 'Saturday',
			7 	=> 'Sunday'
			);
		
		return $days[$i];	
	}
}

function time_remaining($start, $duration)
{
	if( ! is_numeric($start))
	{
		$start = human_to_unix($start);
	}

	//return $start;

	$end = $start + $duration;

	return timespan(time(), $end);
}