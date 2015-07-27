<?php

class Main_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	
	function turnos_del_dia($dia)
	{
		$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$dia' ORDER BY hora");

		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}
	
	
	function get_horarios()
	{
		$query = $this->db->query("SELECT * FROM horarios");
		
		foreach ($query->result() as $fila)
		{
			$data[] = $fila;
		}
		return $data;
	}
	
	function get_ficha($nombre, $apellido)
	{
		$query = $this->db->query("SELECT nroficha FROM pacientes WHERE nombre = '$nombre' AND apellido = '$apellido'");
		
		if ($query->num_rows()>1)
		{
			return -2; //Busqueda manual
		}
		else if ($query->num_rows() == 1)
		{
			$row = 	$query->row();
			return $row->nroficha; 
		}
		else if ($query->num_rows() == 0)
		{
			return -1; //Nuevo Paciente
		}
	}
	
	
	function get_turnos($dia)
	{
		$turnos = $this->turnos_del_dia($dia);
		
		if ($turnos <> 0)
		{
			foreach ($turnos as $turno)
			{	
				if ( $turno->ficha == 0) {
					$ficha = $this->get_ficha($turno->nombre, $turno->apellido);
					$this->db->query("UPDATE turnos SET ficha = '$ficha' WHERE id = '$turno->id'");
				}								
			}
			return $this->turnos_del_dia($dia);
		}
		else
		{
			return 0;
		}
		
	}
	
	
	function get_obras()
	{
		$query = $this->db->query("SELECT * FROM obras_sociales");
		
		foreach ($query->result() as $resultado)
		{
			$data[] = $resultado;
		}
		return $data;
	}
	
	
	function get_medicos()
	{
		$query = $this->db->query("SELECT nombre FROM medicos ORDER BY id");
		
		foreach ($query->result() as $resultado)
		{
			$data[] = $resultado;
		}
		return $data;
	}
	
	function guardar_turno($array)
	{	
		$data['tel1'] = $array['tel1_1'].'-'.$array['tel1_2'];
		
		if ($array['tel2_1'] == "") 
		{
			$data['tel2'] = "";   	
		}
		else 
		{
			$data['tel2'] = $array['tel2_1'].'-'.$array['tel2_2'];
		}
		$cadena = "";
		$tipo = $array['tipo'];
		for ($i=0; $i < sizeof($tipo); $i++) {
			$cadena = $tipo[$i].','.' '.$cadena;
		}
		$cadena = substr($cadena, 0, -2);

		$nombre_1 = ucwords($array['nombre']);
		$nombre_1 = ucwords(strtolower($nombre_1));

		$apellido_1 = ucwords($array['apellido']);
		$apellido_1 = ucwords(strtolower($apellido_1));

		$data['nombre'] = $nombre_1;
		$data['apellido'] = $apellido_1;
		$data['obra_social'] = $array['obra'];
		$data['fecha'] = $array['fecha'];
		$data['hora'] = $array['hora_turno'];
		$data['citado'] = $array['hora_cita'];
		$data['tipo'] = $cadena;		
		if ( ($array['medico'] == "Otro") & ($array['otro'] <> "")) {

			$medico_1 = ucwords($array['otro']);
			$medico_1 = ucwords(strtolower($medico_1));

			if ( strpos($medico_1, 'Dr.') === false ) {
				$medico_1 = 'Dr. '.$medico_1;
			}		

			$data['medico'] = $array['medico'].' - '.$medico_1;
		}
		else {
			$data['medico'] = $array['medico'];
		}
		$data['notas'] = $array['notas'];
		$str = $this->db->insert_string('turnos', $data);
		$this->db->query($str);
	}
	
	function guardar_notas($array)
	{
		$data['fecha'] = $array['fecha'];
		$data['nota'] = $array['notas'];
		$str = $this->db->insert_string('notas', $data);
		$this->db->query($str);
	}

	function get_notas($dia)
	{
		$query = $this->db->query("SELECT * FROM notas WHERE fecha = '$dia'");
			if ($query->num_rows()>0)
			{
				foreach ($query->result() as $fila)
				{
					$data[] = $fila;
				}
				return $data;
			}
			else
			{
				return 0;
			}
	}
	
	function get_notas_by_id($id)
	{
		$query = $this->db->query("SELECT * FROM notas WHERE id = '$id'");
			if ($query->num_rows()>0)
			{
				foreach ($query->result() as $fila)
				{
					$data[] = $fila;
				}
				return $data;
			}
			else
			{
				return 0;
			}
	}
	
	function actualizar_notas($array)
	{
		$data['nota'] = $array['notas'];
		$where = "id = '".$array['id']."'";
		$str = $this->db->update_string('notas', $data, $where);
		$this->db->query($str);
	}
	
	function eliminar_nota($id)
	{
		$this->db->delete('notas', array('id' => $id)); 
	}

	function actualizar_turno($array)
	{
		$data['tel1'] = $array['tel1_1'].'-'.$array['tel1_2'];
		
		if ($array['tel2_1'] == "") 
		{
			$data['tel2'] = "";   	
		}
		else 
		{
			$data['tel2'] = $array['tel2_1'].'-'.$array['tel2_2'];
		}
		$cadena = "";
		$tipo = $array['tipo'];
		for ($i=0; $i < sizeof($tipo); $i++) {
			$cadena = $tipo[$i].','.' '.$cadena;
		}
		$cadena = substr($cadena, 0, -2);

		$nombre_1 = ucwords($array['nombre']);
		$nombre_1 = ucwords(strtolower($nombre_1));

		$apellido_1 = ucwords($array['apellido']);
		$apellido_1 = ucwords(strtolower($apellido_1));

		$data['nombre'] = $nombre_1;
		$data['apellido'] = $apellido_1;
		$data['obra_social'] = $array['obra'];
		$data['fecha'] = $array['fecha'];
		$data['hora'] = $array['hora'];
		$data['citado'] = $array['hora_citado'];
		$data['tipo'] = $cadena;
		$data['ficha'] = 0;
		
		if ( ($array['medico'] == "Otro") & ($array['otro'] <> "")) {
			$medico_1 = ucwords($array['otro']);
			$medico_1 = ucwords(strtolower($medico_1));

			if ( strpos($medico_1, 'Dr.') === false ) {
				$medico_1 = 'Dr. '.$medico_1;
			}		

			$data['medico'] = $array['medico'].' - '.$medico_1;
		}
		else {
			$data['medico'] = $array['medico'];
		}
		
		$data['notas'] = $array['notas'];
		$where = "id = '".$array['id']."'";
		$str = $this->db->update_string('turnos', $data, $where);
		$this->db->query($str);
	}

	function get_turno_by($id) 
	{
		$query = $this->db->query("SELECT * FROM turnos WHERE id = '$id'");
		
		foreach ($query->result() as $resultado)
		{
			$data[] = $resultado;
		}
		return $data;
	}

	function delete_turno($id)
	{
		$this->db->delete('turnos', array('id' => $id)); 
	}

	function cambiar_estado($var, $id)
	{
		$where = "id = '".$id."'";
		
		if ($var == 0)
		{	
			$data['estado'] = "";
			
		}
		else
		{
			$data['estado'] = "presente";
		}
		
		$str = $this->db->update_string('turnos', $data, $where);
		$this->db->query($str);
	}

	function turnos_del_mes($mes, $ano) 
	{
		$query = $this->db->query("SELECT fecha FROM turnos WHERE MONTH(fecha) = '$mes' AND YEAR(fecha) = '$ano'");

		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}
	}

	function cantidad_turnos_man($fecha, $medico) 
	{
		$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND hora <= '13:00:00' and medico = '$medico' ORDER BY hora");

		return $query->num_rows();
	}

	function cantidad_turnos_tarde($fecha, $medico) 
	{
		$query = $this->db->query("SELECT * FROM turnos WHERE fecha = '$fecha' AND hora > '13:00:00' and medico = '$medico' ORDER BY hora");

		return $query->num_rows();
	}

	function cambiar_turno($array)
	{
		$data['fecha'] = $array['fecha'];
		$data['hora'] = $array['hora'];
		$where = "id = '".$array['id']."'";
		$this->setear('id',"");
		$str = $this->db->update_string('turnos', $data, $where);
		$this->db->query($str);
	}

	function anular_cambio()
	{
		$this->setear('id',"");
		$this->setear('nombre',"");
		$this->setear('apellido',"");

	}
	function setear($var, $valor)
	{
		$this->db->query("UPDATE variables SET valor = '$valor' WHERE nombre = '$var'");
	}
	
	function obtener($var)
	{
		$query = $this->db->query("SELECT valor FROM variables WHERE nombre = '$var'");	

		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				return $fila->valor;
			}
		}
		else
		{
			return 0;
		}
	}

	function buscar($text) 
	{
		$query = $this->db->query("SELECT * FROM turnos WHERE apellido LIKE '".$text."%'");

		if ($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
			return $data;
		}
		else
		{
			return 0;
		}	
	}

	function facturar($array)
	{

		$data['obra_social'] = $array['obra'];
		$data['fecha'] = $array['fecha'];
		$data['medico'] = $array['medico'];
		$data['id_turno'] = $array['id'];
		$tipo = $array['tipo'];

		for ($i=0; $i < sizeof($tipo); $i++) 
		{
			switch($tipo[$i])
			{
		        case "CVC":  $data['cvc'] = 1;  break;
		        case "TOPO":  $data['topo'] = 1;  break;
		        case "IOL":  $data['iol'] = 1;  break;
		        case "ME":  $data['me'] = 1;  break;
		        case "RFG":  $data['rfg'] = 1;  break;
		        case "RFG-Color":  $data['rfg-color'] = 1;  break;
		        case "OCT":  $data['oct'] = 1;  break;
		        case "PAQUI":  $data['paqui'] = 1;  break;
		        case "OBI":  $data['obi'] = 1;  break;
		        case "YAG":  $data['yag'] = 1;  break;
		        case "LASER":  $data['laser'] = 1;  break;
		        case "CONSULTA":  $data['consulta'] = 1;  break;
				case "HRT":  $data['hrt'] = 1;  break;
			}

		}
				
		$str = $this->db->insert_string('facturacion', $data);
		$this->db->query($str);
	}

	function create_calendar($ano = null, $mes = null)
	{
		$conf = array (
			'show_next_prev' => true,
			'next_prev_url' => base_url().'index.php/main/show_calendar'
		);
		
		$conf['template'] = '

   		{table_open}<table border="0" cellpadding="0" cellspacing="0" class = "calendar">{/table_open}

   		{heading_row_start}<tr class = "cabecera">{/heading_row_start}

   		{heading_previous_cell}<th class = "previous"><a href="{previous_url}"><img src = "http://consultoriocco.dyndns.org/clinica/css/images/prev_month.png"/></a></th>{/heading_previous_cell}
   		{heading_title_cell}<th  colspan="{colspan}">{heading}</th>{/heading_title_cell}
   		{heading_next_cell}<th class = "next"><a href="{next_url}"><img src = "http://consultoriocco.dyndns.org/clinica/css/images/next_month.png"/></a></th>{/heading_next_cell}

		{heading_row_end}</tr>{/heading_row_end}

 		{week_row_start}<tr class = "semana">{/week_row_start}
   		{week_day_cell}<td class = "dia_semana">{week_day}</td>{/week_day_cell}
   		{week_row_end}</tr>{/week_row_end}

   		{cal_row_start}<tr class ="days">{/cal_row_start}
   		{cal_cell_start}<td>{/cal_cell_start}

   		{cal_cell_content}{content}{/cal_cell_content}
   		{cal_cell_content_today}<div class="highlight">{content}</div>{/cal_cell_content_today}

   		{cal_cell_no_content}<a href="{day}">{day}</a>{/cal_cell_no_content}
   		{cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

		{cal_cell_blank}&nbsp;{/cal_cell_blank}

	   	{cal_cell_end}</div></td>{/cal_cell_end}
   		{cal_row_end}</tr>{/cal_row_end}

   		{table_close}</table>{/table_close}';

   		if ($mes == null) { $mes = date('m');}

   		if ($ano == null) { $ano = date('Y');}

   		$id = $this->obtener('id');  		

   		$mesano = $ano.'-'.$mes;

   		for ($dia=1; $dia <= 31; $dia++) 
   		{

   			$fecha = $mesano.'-'.$dia;
   			$cant_turnos_manana = $this->cantidad_turnos_man($fecha, 'Dr. Jelusich');
   			$cant_turnos_tarde = $this->cantidad_turnos_tarde($fecha, 'Dr. Jelusich');
   			$doble_jornada = 0;	

   			if ( date("l", strtotime($fecha)) == "Tuesday" )
   			{
   				$doble_jornada = 1;	
   			}
   			
   			if ($doble_jornada == 1)
   			{

   				if ( (($cant_turnos_manana > 0) & ($cant_turnos_manana < 6)) | (($cant_turnos_tarde > 0) & ($cant_turnos_tarde < 6)) )
   				{
   					
   					$cal_data[$dia] = '<div class = "celda vacia" onclick = "location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				elseif ( ( ($cant_turnos_manana > 5) & ($cant_turnos_manana < 9) ) | ( ($cant_turnos_tarde > 5) & ($cant_turnos_tarde < 9) ) )
   				{
   					$cal_data[$dia] = '<div class = "celda media" onclick = "location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				elseif ( ($cant_turnos_manana > 8) | ($cant_turnos_tarde > 8) )
   				{
   					$cal_data[$dia] = '<div class = "celda llena" onclick = "location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				elseif ( ($cant_turnos_manana == 0) & ($cant_turnos_tarde == 0) )
   				{
   					$cal_data[$dia] = '<div class = "celda" onclick = "location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   			}
   			else
   			{
   				if ( ($cant_turnos_manana > 0) & ($cant_turnos_manana < 6) )
   				{
   					
   					$cal_data[$dia] = '<div class = "celda vacia" onclick = "location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				elseif ( ($cant_turnos_manana > 5) & ($cant_turnos_manana < 9) )
   				{
   					$cal_data[$dia] = '<div class = "celda media" onclick = "location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				elseif ( ($cant_turnos_manana > 8) )
   				{
   					$cal_data[$dia] = '<div class = "celda llena" onclick = "location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}
   				elseif ( ($cant_turnos_manana == 0) )
   				{
   					$cal_data[$dia] = '<div class = "celda" onclick = "location.href=\''.base_url("/index.php/main/cambiar_dia/".$fecha).'\';" style="cursor: pointer;">'.$dia.'</a>';
   				}

   			}	
   		
   		}
			$this->load->library('calendar', $conf);
		
			return $this->calendar->generate($ano, $mes, $cal_data);
	}

	
}

?>