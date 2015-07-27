<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Turnos</title>
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

	.search_form input[type="text"] {
    	background: url(search-white.png) no-repeat 10px 6px #fcfcfc;
    	border: 1px solid #d1d1d1;
    	font: bold 40px 'Segoe';
    	width: 350px;
    	height: 50px;
    	padding: 6px 15px 6px 35px;
    	-webkit-border-radius: 15px;
    	-moz-border-radius: 15px;
    	border-radius: 15px;
    	text-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
    	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    	-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    }

	</style>
	<script>
    function chequear(url,data) {
        $( "#dialog-confirm" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 800,
            height:380,
            modal: true,
            buttons: {
                "Si": function() {
					var x = url+"/cambiar_turno/"+data;
					location.href = x;
                },
				"No": function() {
                    $( this ).dialog( "close" );
				},
                Anular: function() {
					var x = url+"/anular_cambio_turno/"+data;
                    location.href = x;
                }
            }
        });
   };
		
	</script>	
</head>
<body>
<div id = "busqueda">
	<form class="form-wrapper cf" action="<?php echo base_url('index.php/main/busqueda')?>" method="post" name="search_form" id="search_form">
		<input type="text" name="busqueda_texto" id = "busqueda_texto" autocomplete="off" placeholder="Busqueda de turnos..." required/>
		<button type="submit"> Buscar </button>
	</form>	
</div>	
<div id = "menu">
	<div id = "dia_anterior">
		<?php 
			$dia_anterior = strtotime("-1 day", strtotime($fecha));
echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d',$dia_anterior)).'">';
				echo '<img src = "'.base_url('css/images/atras.png').'"/>';
			echo '</a>';
		?>
	</div>
	<div id = "hoy">
		<?php 
			echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d')).'">';
				echo '<img src = "'.base_url('css/images/hoy.png').'"/>';
			echo '</a>';
		?>	
	</div>
	<div id = "dia_siguiente">
		<?php 
			$dia_siguiente = strtotime("+1 day", strtotime($fecha));
echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d',$dia_siguiente)).'">';
				echo '<img src = "'.base_url('css/images/adelante.png').'"/>';
			echo '</a>';
		?>
	</div>
	<div id = "agregar_notas">
		<?php
		echo '<a href="'.base_url('index.php/main/add_notas/'.$fecha).'">'; 
			echo '<img src = "'.base_url('css/images/notas.png').'"/>';  
		echo '</a>';
		?>
	</div>
	<div id = "principal">
		<?php
		echo '<a href="'.base_url('index.php').'">'; 
			echo '<img src = "'.base_url('css/images/home.png').'"/>'; 
		echo '</a>';
		?>
	</div>
	<div id = "calendario">
		<?php
		echo '<a href="'.base_url('index.php/main/show_calendar').'">';
			echo '<img src = "'.base_url('css/images/calendar.png').'"/>'; 
		echo '</a>';
		?>
	</div>
	<div id ="header">
		<div id = "fecha_dia">
			<?php echo $day." ".$daynum ?>
		</div>
		<div id = "fecha_mes_ano">
			<?php echo $month." ".$year?>
		</div>
		<div class="count">
			<?php 	if ($filas == 0) {
						echo "0";
					}
					else {
						$cantidad = 0;
						foreach ($filas as $fila) {
							if ($fila->medico == "Dr. Jelusich") {
								$cantidad++; 
							}
						}
						echo $cantidad;
					}
			?>
		</div>
	</div>
</div>
<div id = "notas_dia">
	<ul>
	<?php
		if ($notas <> NULL) {
			foreach ($notas as $nota) {
				echo '<li>';
				echo anchor('main/edit_notas/'.$nota->id, $nota->nota);
				echo '</li>';		
			}
		}	
	?>
	</ul>
</div>	

<div id="dialog-confirm" title="¿Cambiar turno?" style = "display:none">
<?php
	if (isset($nombre_turno)) {
		echo $apellido_turno.', '.$nombre_turno;
	}
?>
</div>

<div id = "horarios">
<?php
/* VIEJO
 	foreach ($horario as $esta) {
	
		$hora_completa = date('H:i', strtotime($esta->hora));
		$array[$hora_completa] = $hora_completa;
		
	}
	
	if ($filas <> 0) {

		foreach ($filas as $fila) {
			$hora_completa = date('H:i', strtotime($fila->hora));
			$array[$hora_completa] = $fila;
		}
		
	}
	
	ksort($array);
*/	if ($filas <> 0) {

			$i = 0;	
			foreach ($filas as $fila) {

				$hora_comp_turno = date('H:i', strtotime($fila->hora));
				$array[$i] = $hora_comp_turno;
				$array_turnos[$i] = $fila;
				$i++;
			}

			foreach ($horario as $esta) {

				$hora_comp = date('H:i', strtotime($esta->hora));
				if (!in_array($hora_comp, $array)) {
					$array[$i] = $hora_comp;
					$i++;	
				}			
			}

			asort($array);

			$h = 0;

			foreach ($array as $hora_turno) {

				for ($j = $h; $j < sizeof($array_turnos); $j++) {

					$turnos_hora = date('H:i', strtotime($array_turnos[$j]->hora));

					if ($hora_turno = $turnos_hora) {
						$array[$j] = $array_turnos[$j];
						$h = $j;
					}

				}

			}		
			
		}

		else {

			$i = 0;
			foreach ($horario as $esta) {

				$hora_comp = date('H:i', strtotime($esta->hora));
					$array[$i] = $hora_comp;
					$i++;				
			}
		}


	foreach ($array as $fila) {
		
		if (is_object($fila)) {
			
			$hora_completa = date('H:i', strtotime($fila->hora));
			$cita = date('H:i', strtotime($fila->citado));
			
			echo '<div class = "fila_ocupada" >';
				echo '<div class = "fila_superior" onclick = "location.href=\''.base_url("/index.php/main/vista_turno/".$fila->id).'\';" style="cursor: pointer;"">';
					echo '<div class = "nombre_apellido">'; 	
						echo $fila->apellido.', '.$fila->nombre;
					echo '</div>';
					
					echo '<div class = "hora_ocupada">';
						echo '<a name="'.$hora_completa.'">'.$hora_completa.'</a>';
					echo '</div>';
				echo '</div>';
					
					if (($cita <> '00:00') && ($cita <> $hora_completa)){
						echo '<div class = "hora_citado">';
							echo '<a>cita: '.$cita.'</a>';
						echo '</div>';	
					}
						
				echo '<div class = "datos" onclick = "location.href=\''.base_url("/index.php/main/vista_turno/".$fila->id).'\';" style="cursor: pointer;">';
					
					echo '<div class = "campos">';
						echo "Médico: ";
					echo '</div>';
					echo '<div class = "valores">';
						$auxi = explode(' - ', $fila->medico);
						$med = $auxi[0];
						if ($med == "Otro") {
							echo $auxi[1];
						}
						else {
							echo $fila->medico;	
						}
					echo '</div>';
					echo '<div class = "campos">';
						echo "Tipo de Turno: ";
					echo '</div>';
					echo '<div class = "valores tipo">';
						echo $fila->tipo;
					echo '</div>';
				echo '</div>';
				
				echo '<div class = "fila_inferior">';
					
					echo '<div class = "campo_ficha">';
						echo "Nro de ficha: ";
					echo '</div>';

					echo '<div class = "valor_ficha">';
						if ($fila->ficha == -1) {
							echo anchor('main/nuevo_paciente', 'Nuevo Paciente');
						}	
						else if ($fila->ficha == -2) {	
							echo anchor('main/buscar_paciente', 'Buscar..');
						}
						else {
							echo anchor('main/buscar_ficha/'.$fila->ficha, $fila->ficha);
						}		
					echo '</div>';
					
					echo '<div id = "estado">';
					
					$hora = date('H', strtotime($fila->hora));
					$minutos = date('i', strtotime($fila->hora));
					$data = $fecha.'/'.$hora.'/'.$minutos;
					
					if ($fila->estado == "")
					{
						echo '<a href="'.base_url('index.php/main/cambiar_estado/1/'.$fila->id.'/'.$data).'">'; 
							echo '<img src = "'.base_url('css/images/check_32x26.png').'"/>'; 
						echo '</a>';
					}
					else	
					{	
						echo '<a href="'.base_url('index.php/main/cambiar_estado/0/'.$fila->id.'/'.$data).'">'; 
							echo '<img src = "'.base_url('css/images/check_alt_32x32.png').'"/>'; 
						echo '</a>';
					}		
					echo '</div>';
				echo '</div>';	
				
			echo '</div>';
		}
		else {
			$hora = date('H', strtotime($fila));
			$minutos = date('i', strtotime($fila));
			$data = $fecha.'/'.$hora.'/'.$minutos;
			
				if ($id_turno <> NULL)
				{				
				echo '<div class = "fila_vacia" style="cursor: pointer" onclick = "return chequear(\''.base_url("/index.php/main/").'\', \''.$data.'\');">';
				}	
				else
				{
				echo '<div class = "fila_vacia" onclick = "location.href=\''.base_url("/index.php/main/nuevo_turno/".$fecha.'/'.$hora.'/'.$minutos).'\';" style="cursor: pointer;">';	
				}	
				echo '<div class = "hora">'; 
					echo '<a name="'.$fila.'">'.$fila.'</a>';
				echo '</div>';	 
			echo '</div>';
		}
	}

?>
</div>
</body>
</html>
