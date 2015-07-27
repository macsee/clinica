<?php 

class Calendar extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('calendar_model');
	}
	
	function show_calendar($ano = null, $mes = null)
	{
		$data['calendario'] = $this->calendar_model->crear_calendario($ano, $mes);
		$this->load->view('main_view', $data);
	}
}		
?>