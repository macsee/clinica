<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Vista Turno</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Macsee">
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style>
	.ui-widget {
		font-size: 30pt;
	}
	.ui-dialog {
		position: relative;
		margin: auto;
	}
	</style>

	<script>

    function chequear(url,data) {
        $( "#dialog-confirm" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 800,
            height:240,
            modal: true,
            buttons: {
                "Si": function() {
					var x = url+"/borrar_turno/"+data;
					location.href = x;
                },
				"No": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
   };

	</script>
	<script>

			$(document).ready(function() {


				$('.ask-plain').click(function(e) {

					e.preventDefault();
					thisHref	= $(this).attr('href');

					if(confirm('¿Borrar turno?')) {
						window.location = thisHref;
					}

				});

			});

	</script>

</head>
<body>

	<div id="dialog-confirm" title="¿Borrar turno?"></div>

	<?php
	 	$data = $result[0];
		$fecha = $data->fecha;
		$minutos = date('i', strtotime($data->hora));
		$hora_completa = date('H:i', strtotime($data->hora));
		$aux = explode(':',$hora_completa);
		$hora = $aux[0];
		$mes = date('m', strtotime($fecha));
		$year = date('Y', strtotime($fecha));
		$day = date('d', strtotime($fecha));
		$daynum    = date("l", strtotime($fecha));
		$month  = date("F", strtotime($fecha));

		switch($daynum)
		{
		        case "Monday":  $daynum = "Lunes";  break;
		        case "Tuesday":   $daynum = "Martes"; break;
		        case "Wednesday": $daynum = "Miércoles";  break;
		        case "Thursday":  $daynum = "Jueves"; break;
		        case "Friday":  $daynum = "Viernes";  break;
		        case "Saturday":  $daynum = "Sábado";  break;
		        case "Sunday":  $daynum = "Domingo";  break;
		        default:  $daynum = "Unknown"; break;
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

		echo '<div class = "titulo_turno">';

			echo '<div class = "dia_turno">';
				echo $daynum.' '.$day;
			echo '</div>';

			echo '<div class = "mes_ano_turno">';
				echo $month.' '.$year;
			echo '</div>';

			echo '<div class = "hora_turno">';
				echo $hora_completa.' hs';
			echo '</div>';

		echo '</div>';

	echo '<div class = "nombre_apellido_vista">';
		echo $data->nombre.' '.' '.$data->apellido;
	echo '</div>';

	echo '<div class = "datos_vista">';
		echo '<div class = "campos_vista">';
			echo "Teléfono: ";
		echo '</div>';
		echo '<div class = "valores_vista">';
			echo $data->tel1;
		echo '</div>';
		echo '<div class = "campos_vista">';
			echo "Obra Social: ";
		echo '</div>';
		echo '<div class = "valores_vista" style ="overflow:hidden;white-space:nowrap">';
			echo $data->obra_social;
		echo '</div>';
		echo '<div class = "campos_vista">';
			echo "Médico: ";
		echo '</div>';
		echo '<div class = "valores_vista">';
			$auxi = explode(' - ', $data->medico);
			$med = $auxi[0];
			if ($med == "Otro") {
				echo $auxi[1];
			}
			else {
				echo $data->medico;
			}
		echo '</div>';
		echo '<div class = "campos_vista">';
			echo "Tipo de Turno: ";
		echo '</div>';
		echo '<div class = "valores_vista tipo_vista">';
			echo $data->tipo;
		echo '</div>';
		echo '<div class = "campos_vista">';
			echo "Nro de ficha: ";
		echo '</div>';
		echo '<div class = "valores_vista">';
			if ($data->ficha == -1) {
				echo anchor('main/nuevo_paciente', 'Nuevo Paciente');
			}
			else if ($data->ficha == -2) {
				echo anchor('main/buscar_paciente', 'Buscar..');
			}
			else {
				echo anchor('main/buscar_ficha/'.$data->ficha, $data->ficha);
			}
		echo '</div>';
		echo '<div class = "campos_vista">';
			echo "Notas: ";
		echo '</div>';
		echo '<div class = "valores_vista">';
			if ($data->notas == "") {
				echo '<i> No hay notas </i>';
			}
			else {
				echo $data->notas;
			}
		echo '</div>';
	echo '</div>';

	echo '<div class = "botones">';
		echo '<div class = "icono">';
			echo '<a href="'.base_url('index.php/main/editar_turno/'.$data->id).'">';
				echo '<img src = "'.base_url('css/images/editar.png').'"/>';
			echo '</a>';
		echo '</div>';
		echo '<div class = "icono" style = "cursor:pointer">';
			echo '<a onclick = "return chequear(\''.base_url("/index.php/main/").'\', \''.$data->id.'\');">';
				echo '<img src = "'.base_url('css/images/borrar.png').'"/>';
			echo '</a>';
		echo '</div>';
		echo '<div class = "icono">';
			echo '<a href="'.base_url('index.php/main/set_cambio/'.$data->fecha.'/'.$data->id.'/'.$data->nombre.'/'.$data->apellido).'">';
				echo '<img src = "'.base_url('css/images/cambiar.png').'"/>';
			echo '</a>';
		echo '</div>';
		/*
		echo '<div class = "icono">';
			echo '<a href="'.base_url('index.php/main/facturar/'.$data->id).'">';
				echo '<img src = "'.base_url('css/images/facturar.png').'"/>';
			echo '</a>';
		echo '</div>';
		*/
		echo '<div class = "icono">';
			echo '<a href="'.base_url('index.php/main/nuevo_turno/'.$fecha.'/'.$hora.'/'.$minutos).'">';
				echo '<img src = "'.base_url('css/images/sobreturno.png').'"/>';
			echo '</a>';
		echo '</div>';
		echo '<div class = "icono">';
			echo '<a href="'.base_url('index.php/main/cambiar_dia/'.$fecha).'">';
				echo '<img src = "'.base_url('css/images/volver.png').'"/>';
			echo '</a>';
		echo '</div>';
	echo '</div>';
	?>
</body>
</html>
