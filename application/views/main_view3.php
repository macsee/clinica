<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Turnos</title>
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	
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

			function chequear(url)
			{
				confirmar=confirm("¿Cambiar turno?"); 
				if (confirmar) 
				{
					location.href = url;
				}
				else
				{
					return false;
				}
			} 
			
		
	</script>	
</head>
<body>	

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
			echo '<a href="'.base_url('index.php').'">';
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
	<div id = "principal">
		<?php
		echo '<a href="'.base_url('index.php/main/nuevo_paciente').'">'; 
			echo '<img src = "'.base_url('css/images/home.png').'"/>'; 
		echo '</a>';
		?>
	</div>
	<div id = "calendario">
		<?php
		echo '<a href="'.base_url('index.php/main/show_calendar').'">';
			echo '<img src = "'.base_url('css/images/calendario.png').'"/>'; 
		echo '</a>';
		?>
	</div>
</div>
<div id ="header">
	<div id = "fecha_y_hora">
		<?php echo $day." ".$daynum. " de " .$month." de ".$year?>
	</div>
	<div class="count">
		<?php 	if ($filas == 0) {
					echo "0";
				}
				else {
					echo count($filas);
				}
		?>
	</div>
</div>	



<div id = "horarios">
<?php

foreach ($horario as $esta) {
	
	$ya_se_imprimio = 0;
	$k	= 1;
	$minutos = date('i', strtotime($esta->hora));
	$hora_completa = date('H:i', strtotime($esta->hora));
	$aux = explode(':',$hora_completa);
	$hora = $aux[0];

	$mes = date('m', strtotime($fecha));

	if ($filas <> 0) {
		foreach ( $filas as $fila) {
			
			$hora_turno = date('H:i', strtotime($fila->hora));
			

			if ($hora_turno == $hora_completa) {
				echo '<div class = "fila_ocupada">';
					echo '<div class = "fila_superior">';
						echo '<div class = "botones">';
							echo '<div class = "icono">';
								echo anchor('main/editar_turno/'.$fila->id, 'Editar');
							echo '</div>';
							echo '<div class = "icono">';
								echo '<a class="ask-plain" href="'.base_url("/index.php/main/borrar_turno/".$fila->id).'">Borrar</a>';
							echo '</div>';
							echo '<div class = "icono">';
								echo anchor('main/show_calendar/'.$year.'/'.$mes.'/'.$fila->id, 'Cambiar turno');
							echo '</div>';
							echo '<div class = "icono">';
								echo anchor('main/facturar/'.$fila->id, 'Facturar');
							echo '</div>';
							echo '<div class = "icono">';
								echo anchor('main/nuevo_turno/'.$fecha.'/'.$hora.'/'.$minutos, 'Sobre turno');
							echo '</div>';
						echo '</div>';
						echo '<div class = "hora_ocupada">';
							echo '<a name="'.$hora_completa.'">'.$hora_completa.'</a>';
						echo '</div>';
					echo '</div>';	

					echo '<div class = "nombre_apellido">'; 	
						echo $fila->nombre.' '.' '.$fila->apellido;
					echo '</div>';

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
				echo '</div>';	
				$ya_se_imprimio = 1;

			}
			if ( ($ya_se_imprimio <> 1) & ($k == count($filas)) ) {
								
				if ($id_turno <> NULL)
				{
					echo '<div class = "fila_vacia cambiar" onclick = "return chequear(\''.base_url("/index.php/main/cambiar_turno/".$fecha.'/'.$hora.'/'.$minutos).'\');" style="cursor: pointer;">';
				}	
				else
				{
					echo '<div class = "fila_vacia" onclick = "location.href=\''.base_url("/index.php/main/nuevo_turno/".$fecha.'/'.$hora.'/'.$minutos).'\';" style="cursor: pointer;">';	
				}	
				echo '<div class = "hora">'; 
					echo '<a name="'.$hora_completa.'">'.$hora_completa.'</a>';
				echo '</div>';	 
			echo '</div>';
			}
			$k++;
		}	
	}
	else {  
		
		if ($id_turno <> NULL)
		{
			echo '<div class = "fila_vacia cambiar" onclick = "return chequear(\''.base_url("/index.php/main/cambiar_turno/".$fecha.'/'.$hora.'/'.$minutos).'\');" style="cursor: pointer;">';
		}	
		else
		{
			echo '<div class = "fila_vacia" onclick = "location.href=\''.base_url("/index.php/main/nuevo_turno/".$fecha.'/'.$hora.'/'.$minutos).'\';" style="cursor: pointer;">';	
		}	
		echo '<div class = "hora">'; 
			echo '<a name="'.$hora_completa.'">'.$hora_completa.'</a>';
		echo '</div>';	 
	echo '</div>';
	}
}
	
?>
</div>
</body>
</html>
