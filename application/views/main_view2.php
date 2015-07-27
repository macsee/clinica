<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Turnos</title>
	<link href="<?php echo base_url('css/jquery.mobile-1.1.0.min.css')?>" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url('css/general_foundicons.css')?>" rel="stylesheet" type="text/css"/>
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head>
<body>	



<?php 	
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
	        case "September": $month = "Septiembre"; break;
	        case "October":   $month = "Octubre";   break;
	        case "November":  $month = "Noviembre";  break;
	        case "December":  $month = "Diciembre";  break;
	        default:                  $month = "Unknown";   break;
	}
		
?>	

<div data-role="page">

	<div data-role="header">
		<h1 class="titulo">Turnos </h1>
		
	</div><!-- /header -->

	<div data-role="content">	
		<ul data-role="listview" data-theme="c" data-divider-theme="d">
			<li data-role="list-divider" style = "height: 25px;">
				<div id = "dia_anterior">
					<?php 
						$dia_anterior = strtotime("-1 day", strtotime($fecha));
			echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d',$dia_anterior)).'"data-transition="none">';
							echo '<img src = "'.base_url('css/images/glyphicons_216_circle_arrow_left.png').'"/>';
						echo '</a>';
					?>
				</div>
				<div id = "hoy">
					<?php 
						echo '<a href="'.base_url('index.php').'"data-transition="none">';
							echo '<img src = "'.base_url('css/images/glyphicons_219_circle_arrow_down.png').'"/>';
						echo '</a>';
					?>	
				</div>
				<div id = "dia_siguiente">
					<?php 
						$dia_siguiente = strtotime("+1 day", strtotime($fecha));
			echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d',$dia_siguiente)).'"data-transition="none">';
							echo '<img src = "'.base_url('css/images/glyphicons_217_circle_arrow_right.png').'"/>';
						echo '</a>';
					?>
				</div>
				<div id = "calendario">
					<?php
					echo '<a href="'.base_url('index.php/main/show_calendar').'"data-transition="none">';
						echo '<img src = "'.base_url('css/images/glyphicons_045_calendar.png').'"/>'; 
					echo '</a>';
					?>
				</div>

				<div id = "principal">
					<?php
					echo '<a href="'.base_url('index.php/main/nuevo_paciente').'"data-transition="none">'; 
						echo '<img src = "'.base_url('css/images/glyphicons_020_home.png').'"/>'; 
					echo '</a>';
					?>
				</div>
			</li>
			<li data-role="list-divider" style = "height: 20px">
				<div id = "fecha">
					<?php echo $day." ".$daynum. " de " .$month.", ".$year?> 
				</div>
				
				<div class="ui-li-count">
					<?php 	if ($filas == 0) {
								echo "0";
							}
							else {
								echo count($filas);
							}
					?>
				</div>
			</li>
<?php
			foreach ($horario as $esta) {
	
				$ya_se_imprimio = 0;
				$k	= 1;
				$minutos = date('i', strtotime($esta->hora));
				$hora_completa = date('H:i', strtotime($esta->hora));
		
				if ($filas <> 0) {
					foreach ( $filas as $fila) {
			
						$hora_turno = date('H:i', strtotime($fila->hora));

						if ($hora_turno == $hora_completa) {
							echo '<li class = "fila">';
								echo '<p class="ui-li-aside hora"><strong><a name="'.$hora_completa.'">'.$hora_completa.'</a></strong></p>';
								echo '<h3 class = "nombre">'.$fila->nombre.' '.' '.$fila->apellido.'</h3>';

								echo '<div class = "datos">';
	 								echo '<div class = "campos">';
										echo "Teléfono: ";
									echo '</div>';
									echo '<div class = "valores">';
										echo $fila->tel1;
									echo '</div>';
									echo '<div class = "campos">';		
										echo "Obra Social: ";
									echo '</div>';
									echo '<div class = "valores">';
										echo $fila->obra_social;
									echo '</div>';
									echo '<div class = "campos">';
										echo "Médico: ";
									echo '</div>';
									echo '<div class = "valores">';
										echo $fila->medico;
									echo '</div>';
									echo '<div class = "campos">';
										echo "Tipo de Turno: ";
									echo '</div>';
									echo '<div class = "valores tipo">';
										echo $fila->tipo;
									echo '</div>';
									echo '<div class = "campos">';
										echo "Nro de ficha: ";
									echo '</div>';
									echo '<div class = "valores">';
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
								echo '</div>';
								$ya_se_imprimio = 1;
						}
						echo '</li>';
						if ( ($ya_se_imprimio <> 1) & ($k == count($filas)) ) {
							$aux = explode(':',$hora_completa);
							$hora_1 = $aux[0];
							$minuto_1 = $aux[1];
	echo '<li><a href="'.base_url("/index.php/main/nuevo_turno/".$fecha.'/'.$hora_1.'/'.$minuto_1).'"data-transition="none">';
								echo '<h3 class = "nombre">'; 
									echo $hora_completa;
								echo '</h3>';	 
							echo '</li>';
						}
						$k++;
					}	
				}
				else {  
					$aux = explode(':',$hora_completa);
					$hora_1 = $aux[0];
					$minuto_1 = $aux[1];
	echo '<li><a href="'.base_url("/index.php/main/nuevo_turno/".$fecha.'/'.$hora_1.'/'.$minuto_1).'"data-transition="none">';
						echo '<h3 class = "nombre">'; 
							echo $hora_completa;
						echo '</h3>';	 
					echo '</li>';
				}
			}	
?>	
		</ul>
	</div>
</div>	
</body>
</html>
