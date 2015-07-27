<?php

class Calendar_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}

	function crear_calendario($ano, $mes)
	{
		$conf = array (
			'show_next_prev' => true,
			'next_prev_url' => base_url().'calendar/show_calendar'
		);
	
		$this->load->library('calendar', $conf);
		return $this->calendar->generate($ano, $mes);
	}

}

?>