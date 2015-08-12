<?php

class Main extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('main_model');

	}
	
	
	function index()
	{	
		/*
		$data = array(
			'user' => "susana",
			'nombre' => "Susana",
			'apellido' => "Jelusich",
			'grupo' => "Secretaria_1",
			'id_user' => "susanaj",
			'is_logged_in' => true
		);
		
		$this->session->set_userdata($data);
		*/
		$this->session->set_userdata('medico_seleccionado', "todos");

		$this->load->view('home');
		//$this->cambiar_dia(date("Y-m-d"));
	}
	
	function translate($fecha) 
	{
		$day    = date("l", strtotime($fecha));
		$daynum = date("j", strtotime($fecha));
		$month  = date("F", strtotime($fecha));
		$year   = date("Y", strtotime($fecha));

		switch($day)
		{
		        case "Monday":  $day = "Lunes";  break;
		        case "Tuesday":   $day = "Martes"; break;
		        case "Wednesday": $day = "Miércoles";  break;
		        case "Thursday":  $day = "Jueves"; break;
		        case "Friday":  $day = "Viernes";  break;
		        case "Saturday":  $day = "Sábado";  break;
		        case "Sunday":  $day = "Domingo";  break;
		        default:                  $day = "Unknown"; break;
		}

		switch($month)
		{
		        case "January":   $month = "Enero";    break;
		        case "February":  $month = "Febrero";   break;
		        case "March":    $month = "Marzo";       break;
		        case "April":    $month = "Abril";       break;
		        case "May":        $month = "Mayo";         break;
		        case "June":      $month = "Junio";        break;
		        case "July":      $month = "Julio";        break;
		        case "August":  $month = "Agosto";      break;
		        case "September": $month = "Setiembre"; break;
		        case "October":   $month = "Octubre";   break;
		        case "November":  $month = "Noviembre";  break;
		        case "December":  $month = "Diciembre";  break;
		        default:                  $month = "Unknown";   break;
		}
		$data['day'] = $day;
		$data['daynum'] = $daynum;
		$data['month'] = $month;
		$data['year'] = $year;
		return $data;
	}
	
	function cambiar_dia($dia) {

		$data['medico_selected'] = $this->session->userdata('medico_seleccionado');
		$medico = $this->main_model->get_medico_by_id($data['medico_selected']);

		$data['fecha'] = $dia;
		$data['filas'] = $this->main_model->turnos_del_dia($dia,$medico);
		//$data['filas'] = $this->main_model->get_turnos($dia);
		$data['horario'] = $this->main_model->get_horarios();
		$data['notas'] = $this->main_model->get_notas($dia);
		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$array = $this->translate($dia);
		$data['day'] = $array['day'];
		$data['daynum'] = $array['daynum'];
		$data['month'] = $array['month'];
		$data['year'] = $array['year'];
		$data['nombre_turno'] = $this->get('nombre');
		$data['apellido_turno'] = $this->get('apellido');
		$data['id_turno'] = $this->get('id');
		$data['bloqueado'] = $this->main_model->is_bloqueado($dia,$data['medico_selected']);
		$data['medico_selected_name'] = $medico;
		$this->load->view('main_view', $data);
	}
	
	function nuevo_paciente()
	{
		echo "Crear nuevo paciente";
	}
	
	function buscar_ficha()
	{
		echo "Buscar Ficha..";
	}
	
	function add_notas($fecha)
	{	$data['fecha'] = $fecha;
		$array = $this->translate($fecha);
		$data['dia'] = $array['day'];
		$data['nombre_dia'] = $array['daynum'];
		$data['mes'] = $array['month'];
		$data['ano'] = $array['year'];
		$this->load->view('nota_view', $data);
	}
	
	function pro_add_notas()
	{
		$this->main_model->guardar_notas($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha'], 'location');
		//$this->cambiar_dia($_POST['fecha']);
	}
	
	function edit_notas($id)
	{
		$resultado = $this->main_model->get_notas_by_id($id);
		$data['notas'] = $resultado[0]->nota;
		$data['id'] = $resultado[0]->id;
		$data['fecha'] = $resultado[0]->fecha;
		$array = $this->translate($data['fecha']);
		$data['dia'] = $array['day'];
		$data['nombre_dia'] = $array['daynum'];
		$data['mes'] = $array['month'];
		$data['ano'] = $array['year'];
		$this->load->view('edit_nota', $data);
	}
	
	function pro_edit_notas()
	{
		$this->main_model->actualizar_notas($_POST);
		$this->cambiar_dia($_POST['fecha']);
	}
	
	function eliminar_nota($fecha,$id)
	{
		$this->main_model->eliminar_nota($id);
		$this->cambiar_dia($fecha);
	}
	
	function nuevo_turno($fecha,$hora,$minutos)
	{
		$data['medico_selected'] = $this->session->userdata('medico_seleccionado');
		$horario = $hora.':'.$minutos;
		$data['fecha'] = $fecha; //$this->uri->segment(3);
		$data['horario'] = $horario;
		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$array = $this->translate($fecha);
		$data['day'] = $array['day'];
		$data['daynum'] = $array['daynum'];
		$data['month'] = $array['month'];
		$data['year'] = $array['year'];	
		$this->load->view('nuevo_turno', $data);
	}
	
	function pro_nuevo_turno()
	{	
		//print_r($_POST);
		$this->main_model->guardar_turno($_POST);
		//$this->cambiar_dia($_POST['fecha']);
		redirect('main/cambiar_dia/'.$_POST['fecha'], 'location');
		//$this->load->view('nuevo_turno_exito');
	}
	
	function editar_turno($id)
	{

		$data['obras'] = $this->main_model->get_obras();
		$data['medicos'] = $this->main_model->get_medicos();
		$data['filas'] = $this->main_model->get_turno_by($id);
		
		$aux = $data['filas'][0]->fecha;
		$aux2 = $data['filas'][0]->hora;
				
		$fecha = date('d-m-Y', strtotime($aux));
		$hora = date('H:i', strtotime($aux2));
		
		$array = $this->translate($fecha);
		$data['day'] = $array['day'];
		$data['daynum'] = $array['daynum'];
		$data['month'] = $array['month'];
		$data['year'] = $array['year'];
		$data['hora'] = $hora;
		$data['id'] = $id;	
		$this->load->view('editar_turno', $data);
	}

	function pro_edit_turno()
	{
		$this->main_model->actualizar_turno($_POST);
		$this->cambiar_dia($_POST['fecha']);
		//$this->load->view('nuevo_turno_exito');
	}
	
	function borrar_turno($id)
	{
		$data = $this->main_model->get_turno_by($id);
		$hora = date('H:i', strtotime($data[0]->hora));
		$this->main_model->delete_turno($id);
		redirect('main/cambiar_dia/'.$data[0]->fecha, 'location');
	}

	function cambiar_turno($fecha, $hora, $minuto)
	{
		$data['fecha'] = $fecha;
		$data['hora'] = $hora.':'.$minuto;
		$data['id'] = $this->get('id');
		$data['nombre_turno'] = $this->get('nombre');
		$data['apellido_turno'] = $this->get('apellido');
		$this->main_model->cambiar_turno($data);
		redirect('main/cambiar_dia/'.$fecha.'#'.$data['hora'], 'location');
	}

	function bloquear_dia() {

		$this->main_model->bloquear_dia($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha']);
	}

	function desbloquear_dia() {

		//$fecha = $_POST['fecha'];
		$this->main_model->desbloquear_dia($_POST);
		redirect('main/cambiar_dia/'.$_POST['fecha']);
	}

	function set($var,$valor)
	{
		$this->main_model->setear($var, $valor);
	}

	function get($var)
	{
		return $this->main_model->obtener($var);

	}

	function facturar($id)
	{
		$data['filas'] = $this->main_model->get_turno_by($id);
		$this->load->view('edit_factura',$data);
	}

	function pro_facturacion()
	{
		$this->main_model->facturar($_POST);
		$this->cambiar_dia($_POST['fecha']);
	}
	
	function vista_turno($id)
	{
		$data['result'] = $this->main_model->get_turno_by($id);
		$this->load->view('turno_view', $data);
	}
	
	function anular_cambio_turno($fecha, $hora, $minuto)
	{
		$this->main_model->anular_cambio();
		redirect('main/cambiar_dia/'.$fecha.'#'.$hora.':'.$minuto, 'location');
	}

	function set_cambio($fecha, $id, $nombre, $apellido)
	{
		$this->set('id',$id);
		$this->set('nombre',$nombre);
		$this->set('apellido',$apellido);
		$fecha = explode('-', $fecha);
		$anio = $fecha[0];
		$mes = $fecha[1];
		redirect('main/show_calendar/'.$anio.'/'.$mes, 'location');
	}
	
	function show_calendar()
	{
		$ano = $this->uri->segment(3);
		$mes = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$data['calendario'] = $this->main_model->create_calendar($ano, $mes);
		if ($id <> "") 
		{
			$this->set('id',$id);
		}
		
		$this->load->view('calendario_view', $data);
	}
	
	function cambiar_estado($var,$id,$fecha,$hora,$minuto)
	{	
		$this->main_model->cambiar_estado($var,$id);
		redirect('main/cambiar_dia/'.$fecha.'#'.$hora.':'.$minuto, 'location');
	}
	
	function busqueda()
	{
		$array['busqueda'] = $this->main_model->buscar($_POST['busqueda_texto']);
		$this->load->view('busqueda_view', $array);
	}

	function cambiar_medico($medico,$fecha,$url) {
		//$this->main_model->setSelectedMedico($medico);

		$this->session->set_userdata('medico_seleccionado', $medico);
		redirect('main/cambiar_dia/'.$fecha);
	}

}


?>
