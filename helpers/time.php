<?php

class time {

	public function set_tz_by_offset($offset)
	{
		$abbrarray = timezone_abbreviations_list();
		foreach ($abbrarray as $abbr)
		{
			foreach ($abbr as $city)
			{
				if ($city['offset'] == $offset)
				{
					cookie::set('timezone', $offset, 0);
					date_default_timezone_set($city['timezone_id']);
					return TRUE;
				}
			}
		}

		date_default_timezone_set('gmt');
		return FALSE;
	}

	public function display_zones($name)
	{
		return form::dropdown($name, array_combine(range(-43200, 43200, 3600), range(-12, 12)), cookie::get('timezone', 0));
	}
}