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

    #medico {
    	width:70%;
    	font-size: 50px;
    }

	</style>
	<script>

	$(document).ready(function()
	{	
		$("#cita_hora").keyup(function() {
			
   			if($(this).val().length == $(this).attr('maxlength')) {
        		$("#cita_minutos").focus();
    		}
			
		});
		
		$( "#medico" ).change(function () {
				var base_url = '<?php echo base_url(); ?>';
	    		var str = "";
	    		var segment = $(location).attr('href').split("/");
	    		$( "#medico option:selected" ).each(function() {
	    			str += base_url+"index.php/main/cambiar_medico/"+$(this).val()+"/"+segment[7].replace("#","")+"/turnos";
	    		});
	    		//alert( segment[7] );
	    		location.href = str;
	  	});

	  	$(".check").click(function(event)
		{
			var base_url = '<?php echo base_url(); ?>';
		
			var img1 = '<?php echo base_url("css/images/check_32x26.png"); ?>'; //unchecked
			var img2 = '<?php echo base_url("css/images/check_alt_32x32.png"); ?>'; //checked
			
			//event.preventDefault();
			var value = $(this).attr('id');
			var status = "";

			//alert($(this).attr('id'));

            if ($(this).attr('src') === img1) {
             	$(this).attr('src', img2);
             	status = "ok";

             	//var datastring = "posteo="+value+","+"1";
            }	
         	else {
          		$(this).attr('src', img1);
          		status = "medico";
          		
          		//var datastring = "posteo="+value+","+"0";
          	}

          	var values = {
            		'id'		: value,
            		'estado'	: status,
    		};
                  
          	$.ajax({
					type: 'POST',
 					url: base_url+"cambiar_estado.php",
 					data: values,
			});

        });
	}); 


    function chequear(fecha,hora,minutos) {

   		$("#cita_hora").val("");
   		$("#cita_minutos").val("");

   		$("#form_fecha").val(fecha);
   		$("#form_hora").val(hora);
   		$("#form_minutos").val(minutos);

        $( "#dialog-confirm" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 800,
            height: 450,
            modal: true,
            buttons: {
                "Si": function() {
                	$("#form_cambiar").submit();
					//var x = url+"/cambiar_turno/"+data;
					//location.href = x;
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

   function bloquear() {
        $( "#bloquear_dia" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 750,
            height: 700,
            modal: true,
            buttons: {
                "Si": function() {
                	if ($("#motivo").val() == "")
                		$("#error_motivo").html("Debe escribir un motivo.");	
                	else
						$("#form_bloquear").submit();
                },
				"No": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
   	};

   	function desbloquear() {
        $( "#desbloquear_dia" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 750,
            height: 450,
            modal: true,
            buttons: {
                "Si": function() {
					$("#form_desbloquear").submit();
                },
				"No": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
   	};
		
	</script>	
</head>
<body>
<div id = "busqueda" style = "margin-right:8px">
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
	<div class="count">
		<?php 	
			if ($filas == 0) {
					echo "0";
			}
			else {
				$cantidad = 0;
				foreach ($filas as $fila) {
					//if ($fila->medico == "Dr. Jelusich") {
						$cantidad++; 
					//}
				}
				echo $cantidad;
			}
		?>
	</div>
	<div id = "agregar_notas">
		<?php
		echo '<a href="'.base_url('index.php/main/add_notas/'.$fecha).'">'; 
			echo '<img src = "'.base_url('css/images/notas.png').'"/>';  
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
	<div id = "principal">
		<?php
			if ($bloqueado != null) {
				echo '<a href="#" onclick = "return desbloquear()">';
					echo '<img src = "'.base_url('css/images/lock.png').'"/>'; 
				echo '</a>';	
			}
			else {
				echo '<a href="#" onclick = "return bloquear()">';
					echo '<img src = "'.base_url('css/images/lock.png').'"/>'; 
				echo '</a>';	
			}
		/*
		echo '<a href="'.base_url('index.php').'">'; 
			echo '<img src = "'.base_url('css/images/home.png').'"/>'; 
		echo '</a>';
		*/
		?>
	</div>
	<div id ="header">
		<div id = "fecha_dia">
			<?php echo $day." ".$daynum.", " ?>
		</div>
		<div id = "fecha_mes_ano">
			<?php echo $month." ".$year?>
		</div>
	</div>
	<div style = "float:left;margin-left:10px;margin-top:20px;font-size:50px;width:100%;color:white">
		Medico:
		<select id = "medico" name = "medico">
			<?php
				echo '<option value = "todos" selected>TODOS</option>';
				foreach ($medicos as $med) {	
					if ($medico_selected == $med->id_medico)
						if ($med->nombre == "Otro")
							echo '<option value ='.$med->id_medico.' selected>'.$med->nombre.'</option>';
						else
							echo '<option value ='.$med->id_medico.' selected>Dr. '.$med->nombre.'</option>';
					else
						if ($med->nombre == "Otro")
							echo '<option value ='.$med->id_medico.'>'.$med->nombre.'</option>';
						else
							echo '<option value ='.$med->id_medico.'>Dr. '.$med->nombre.'</option>';
				}
			?>
		</select>
	</div>	
</div>
<div id = "notas_dia">
	<ul>
	<?php
		if ($notas <> NULL) {
			foreach ($notas as $nota) {
				echo '<li>';
					echo anchor('main/edit_notas/'.$nota->id, $nota->nota);
					echo '<p style = "font-style:italic;font-size:15px">'.date('d-m-Y@H:i', strtotime($nota->last_update)).' - '.$nota->usuario.'</p>';
				echo '</li>';		
			}
		}	
	?>
	</ul>
</div>	

<div id="dialog-confirm" title="¿Cambiar turno?" style = "display:none">
	<form action="<?php echo base_url('index.php/main/cambiar_turno')?>" method="post" name="form_cambiar" id="form_cambiar">
		<?php
			if (isset($nombre_turno)) {
				echo str_replace('%20', ' ', $apellido_turno.', '.$nombre_turno);
			}
		?>
		<div style = "margin-top:10px">
			<b>Citado:</b>
			<input type="text" size="2" id = "cita_hora" name="cita_hora" pattern="[0-9].{1,}" autocomplete="off" maxlength="2" required=""> :
			<input type="text" size="2" id = "cita_minutos" name="cita_minutos" pattern="[0-9].{1,}" autocomplete="off" maxlength="2" required="">
			<input type="hidden" name="form_fecha" id ="form_fecha">
			<input type="hidden" name="form_hora" id ="form_hora">
			<input type="hidden" name="form_minutos" id ="form_minutos">
			<b> hs</b>
		</div>
	</form>
</div>
<div id="desbloquear_dia" title="¿Desbloquear agenda?" style = "display:none">
	<form id = "form_desbloquear" action="<?php echo base_url('index.php/main/desbloquear_dia/')?>" method="post">
		<?php if ($medico_selected_name == "") {?>
			<div style = "margin-bottom:15px;margin-top:5px">Desbloquear agenda para <b>Todos</b>?</div>
		<?php }
			else {?>
			<div style = "margin-bottom:15px;margin-top:5px">Desbloquear agenda para <b>Dr. <?php echo $medico_selected_name?></b>?</div>
		<?php }?>
		<input name = "fecha" type = "hidden" value = "<?php echo $fecha?>"/>
		<input name = "medico" type = "hidden" value = "<?php echo $medico_selected?>"/>
	</form>
</div>	
<div id="bloquear_dia" title="¿Bloquear agenda?" style = "display:none">
	<form id = "form_bloquear" action="<?php echo base_url('index.php/main/bloquear_dia/')?>" method="post">
		<input name = "fecha" type = "hidden" value = "<?php echo $fecha?>"/>
		<input name = "medico" type = "hidden" value = "<?php echo $medico_selected?>"/>
		<?php if ($medico_selected_name == "") {?>
			<div style = "margin-bottom:15px;margin-top:5px">Bloquear agenda para <b>Todos</b>?</div>
		<?php }
			else {?>
			<div style = "margin-bottom:15px;margin-top:5px">Bloquear agenda para <b>Dr. <?php echo $medico_selected_name?></b>?</div>
		<?php }?>	
		Motivo: <textarea id = "motivo" name = "motivo" style = "margin-top:20px;width:440px;height:240px;float:right" required/></textarea>
		<div id = "error_motivo" style ="color:red;float:left;width:100%"></div>
	</form>
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
*/	
	if ($bloqueado == null) {

		if ($filas <> 0) {

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

				$config = $this->main_model->get_config_medico($fila->medico);
				if (empty($config))
					$color = "#FFD9B5";//#FFCDCD";
				else
					$color = $config->config;

				echo '<div class = "fila_ocupada" style = "background-color:'.$color.'">'; 
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
							echo "Obra Social: ";
						echo '</div>';
						echo '<div class = "valores">';
							echo $fila->obra_social;
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
								//echo anchor('main/nuevo_paciente', 'Nuevo Paciente');
								echo '<a href = "#">Nuevo Paciente</a>';
							}	
							else if ($fila->ficha == -2) {
								//echo anchor('main/buscar_paciente', 'Buscar..');
								echo '<a href = "#">Buscar..</a>';
							}
							else {
								//echo anchor('main/buscar_ficha/'.$fila->ficha, $fila->ficha);
								echo '<a href = "#">'.$fila->ficha.'</a>';
							}		
						echo '</div>';
						
						echo '<div class = "estado" id = "'.$fila->id.'" style="cursor: pointer;margin-left:50px;float:left;">';
						
						$hora = date('H', strtotime($fila->hora));
						$minutos = date('i', strtotime($fila->hora));
						$data = $fecha.'/'.$hora.'/'.$minutos;

						if ($fila->estado != "ok")
							echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/check_32x26.png').'"/>'; 
						else
							echo '<img class = "check" id = "'.$fila->id.'" src = "'.base_url('css/images/check_alt_32x32.png').'"/>';	

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
						echo '<div class = "fila_vacia" style="cursor: pointer" onclick = "return chequear(\''.$fecha.'\', \''.$hora.'\', \''.$minutos.'\');">';
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
	}
	else {
		if ($bloqueado->motivo != "")
			$motivo = $bloqueado->motivo;
		else
			$motivo = "Sin Especificar";

		echo '<div style = "height:486px">';
			if ($medico_selected_name == "")
				echo "<p style = 'text-align:center;font-size:25px;'>Agenda bloqueada para <b style = 'margin-left:5px;margin-right:5px;font-size:30px'>Todos</b> en esta fecha.</p>";
			else
				echo "<p style = 'text-align:center;font-size:25px;>Agenda de  <b style = 'margin-left:5px;margin-right:5px;font-size:30px'>Dr. ".$medico_selected_name."</b>  bloqueada para esta fecha.</p>";
			echo "<p style = 'text-align:center;font-size:25px;>Motivo: <i>".$motivo."</i></p>";
			echo "<p style = 'text-align:center;font-size:15px;>Última edición: <i>".date('d-m-Y',strtotime($bloqueado->last_update))." - ".$bloqueado->usuario."</i></p>";
		echo '</div>';
	}	

?>
</div>
</body>
</html>
