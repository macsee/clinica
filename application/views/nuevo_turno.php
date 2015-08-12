<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Nuevo Turno</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
  	<style>
	    .ui-autocomplete {
	        max-height: 300px;
	        overflow-y: auto;
	        /* prevent horizontal scrollbar */
	        overflow-x: hidden;
	    }
	    /* IE 6 doesn't support max-height
	     * we use height instead, but this forces the menu to always be this tall
	     */
	    * html .ui-autocomplete {
	        height: 100px;
	    }
		
		.ui-widget {
			font-size: 30pt;
		}
		
		.ui-dialog {
			//position: relative;
			margin: auto;
			font-size: 25pt;
			text-align: center;
		}
		
		.ui-dialog .ui-dialog-buttonpane { 
		    text-align: center;
		}
		.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { 
		    float: none;
		}
		
		#fecha1 { width: 40%;}
		#fecha2 { width: 60%; margin-top: 20px;}
		.titulo{ height: 220px;width:100%}

	</style>
	<script> 

	$(document).ready(function(){
		
	   		$('#medico').change(function(){

	 			var valorSeleccionado = $(this).val();
	 			if(valorSeleccionado == "Otro"){
	 				$('#test').fadeIn();  
	 			}
	 			else{
	 				$('#test').fadeOut(); 
	 				return false;		
	 			}
			});
			
		
			$("#contact_form").submit(function () {
				  
	    		var tel1 = $("#tel1_1").val();
				var tel2 = $("#tel1_2").val();
				
				tel = tel1.length + tel2.length;
				
				var tel11 = $("#tel2_1").val();
				var tel21 = $("#tel2_2").val();
				
				tel3 = tel11.length + tel21.length;
				
				var medico = $("#medico").val();
				var otro = $("#otro").val();
				
	    		var check = $("input[type='checkbox']:checked").length;
	
				if (check == 0) {
					mensaje_casillas();
					return false;  
				}

				if (!( (tel == 11) || (tel == 13) )) {
					mensaje_tel();
					return false;
				}
				
				if (tel3 != 0)
				{
					if (!( (tel3 == 11) || (tel3 == 13) )) {
						mensaje_tel();
					  	return false;
					}
				}
				
				if (medico == "Otro" && otro == "")
				{
					mensaje_medico();	
				  	return false;
				}
									
			});			
			
			  
	});
	
	function mensaje_casillas() {
        $( "#mensaje_casillas" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 700,
            height:350,
            modal: true,
            buttons: {
				"Aceptar": function() {
                    $( this ).dialog( "close" );
				}
            }
        });
	};
	
	function mensaje_tel() {
        $( "#mensaje_tel" ).dialog({
			autoOpen: true,
           	resizable: false,
			width: 700,
        	height:350,
	       	modal: true,
	        buttons: {
				"Aceptar": function() {
	               $( this ).dialog( "close" );
				}
          	}
	     });
	};
		
	function mensaje_medico() {
	    $( "#mensaje_medico" ).dialog({
			autoOpen: true,
	      	resizable: false,
			width: 700,
	        height:350,
            modal: true,
        	buttons: {
				"Aceptar": function() {
               	$( this ).dialog( "close" );
				}
			}
		});
	};
/*
	$(function() {
        var availableTags = [
            "AAPM - Propag. Med.",
			"ACA Salud",
			"ACINDAR",
			"Agua y Energía",
			"AMR",
			"AMUR",
			"APSOT",
			"Asoc. Española",
			"Caja Forense",
			"Caja Ingenieros",
			"Camioneros - Mutual",
			"Ciencias Económicas",
			"Docthos",
			"Emedic",
			"EPE-SMAI",
			"Federación Médica",
			"Femedic",
			"Fuerza Aérea",
			"Galeno",
			"Grupo Oroño",
			"IAPOS",
			"IOSE",
			"IPAM",
			"Jerárquico Salud",
			"Luis Pasteur",
			"Luz y Fuerza",
			"Luz y Fuerza - Mutual",
			"Medicus",
			"Medife",
			"Mutual Federada",
			"OMINT",
			"OSDEA",
			"OSDOP",
			"OSPAC",
			"OSPAGA",
			"OSPESGA",
			"OSPI Maderera",
			"OSSIMRA",
			"Particular",
			"Patrones de Cabotaje",
			"Poder Judicial",
			"Prensa - OSPRO",
			"Publicidad",
			"SADAIC",
			"San Pedro",
			"SAT Televisión",
			"SERVE Salud",
			"Sind. Camioneros",
			"Swiss Medical",
			"Teleg. y Radioteleg.",
			"Universidad"
        ];
        $( "#obra" ).autocomplete({
            source: availableTags
        });
    });
*/
/*	$(function() {
       
        $( "#obra" ).autocomplete({
            source: "/clinica/scripts/search.php",
            minLength: 1,
        });
    });
*/		  
	</script>	
</head>
<body>
	
<div id="mensaje_casillas" style="display:none"> Se debe marcar al menos una casilla </div>
<div id="mensaje_tel" style="display:none"> El nro de teléfono no es correcto </div>
<div id="mensaje_medico" style="display:none"> Se debe ingresar médico</div>
	
	<div class = "titulo">
		<div style="float:left">
			<?php
			echo '<a href="'.base_url('index.php/main/cambiar_dia/'.$fecha).'">';
				echo '<img src = "'.base_url('css/images/volver.png').'"/>';
			echo '</a>';
			?>
		</div>		
		<div style="text-align:right; font-size: 60px; margin-bottom: 30px; width: 95%">
			Nuevo Turno
		</div>	
		<div id= "fecha1">
			<?php 
				echo $day." ".$daynum.",";
				$var = explode(':', $horario);
				$hora = $var[0];
				$minuto = $var[1];
			?>
		</div>
		<div id = "fecha2">
			<?php
				echo $month." ".$year;
			?>	
		</div>	
     <!-- <span class="required_notification">* Campos obligatorios</span> -->
	</div>	
	<span class="required_notification">* Campos obligatorios</span>
	<form class="contact_form" action="<?php echo base_url('index.php/main/pro_nuevo_turno')?>" method="post" name="contact_form" id="contact_form">
		
    	<div style = "float:left; width:100%; height: 200px; border-bottom: 1px solid #eee; margin-top: 30px";>
			<div style="float:left; margin-left: 12px; margin-bottom: 20px">
				<label for="minutos" style = "width: 150px"><font color = "red">* </font> Hora: </label>
				<?php
            		echo '<input type="time" size = "4" name="hora_turno" required autocomplete="off" value = "'.$hora.':'.$minuto.'">';
				?>
			</div>

			<div style="float:left; margin-left:12px">
				<label for="citado" style = "width: 150px;">Citado: </label>
				<?php
            	echo '<input type="time" size = "4" name="hora_cita" autocomplete="off" value = "'.$hora.':'.$minuto.'">';
				?>
			</div>
		</div>
		<div id = "ul1">		
	        <ul>
				
	        	<li>
	            	<label for="apellido"><font color = "red">* </font> Apellido:</label>
	            	<input type="text" size = "14" name="apellido" autocomplete="off" style="text-transform:capitalize" required/>
	        	</li>
	        	<li>
	            	<label for="nombre"><font color = "red">* </font> Nombre:</label>
	            	<input type="text" size = "14" name="nombre" autocomplete="off" style="text-transform:capitalize" required />
	        	</li>
		 	</ul>
		</div>
	    <div id="tipo_turno"><font color = "red">* </font> Tipo de turno:</div>
		<div id = "tabla">
			<div class = "fila">
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "CVC" id = "CVC"/><label for="CVC"> CVC </label> 		
				</div>
				<div class = "celda_2">	
					<input type="checkbox" name="tipo[]" value = "TOPO" id = "TOPO"/><label for="TOPO"> TOPO </label>	
				</div>
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "IOL"id = "IOL"/><label for="IOL"> IOL </label>
				</div>
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "ME" id = "ME"/><label for="ME"> ME </label>
				</div>	
			</div>
			<div class = "fila">
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "RFG"id = "RFG"/><label for="RFG"> RFG </label>
				</div>
				<div class = "celda_2">
					<input type="checkbox" name="tipo[]" value = "RFG-Color" id = "RFG-Color"/><label for="RFG-Color"> RFG-Color </label> 
				</div>			
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "OCT" id = "OCT"/><label for="OCT"> OCT </label>
				</div>
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "PAQUI"id = "PAQUI"/><label for="PAQUI"> PAQUI </label>
				</div>
			</div>
			<div class = "fila">
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "OBI" id = "OBI"/><label for="OBI"> OBI </label> 
				</div>			
				<div class = "celda_2">	
					<input type="checkbox" name="tipo[]" value = "YAG" id = "YAG"/><label for="YAG"> YAG </label> 
				</div>
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "Laser" id = "Laser"/><label for="LASER"> Laser </label>
				</div>
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "HRT" id = "HRT"/><label for="HRT"> HRT </label>	
				</div>			
			</div>
			<div class = "fila">
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "Consulta" id = "Consulta"/><label for="Consulta"> Consulta </label> 				
				</div>
				<div class = "celda_2" style = "margin-left:70px">
					<input type="checkbox" name="tipo[]" value = "S/Cargo" id = "S/Cargo"/><label for="S/Cargo"> Sin Cargo </label> 				
				</div>				
			</div>
		</div>	
		<div id = "ul2">	
			<ul>
				<li>
				</li>						
				<li>
					<label for="medico"><font color = "red">* </font> Médico:</label>
						<select id = "medico" name = "medico">
							<?php
								foreach ($medicos as $medico) {
									if ($medico_selected == $medico->id_medico)
										if ($medico->nombre == "Otro")
											echo '<option value ="'.$medico->nombre.'" selected>'.$medico->nombre.'</option>';
										else
											echo '<option value ="'.$medico->nombre.'" selected>Dr. '.$medico->nombre.'</option>';
									else
										if ($medico->nombre == "Otro")
											echo '<option value ="'.$medico->nombre.'">'.$medico->nombre.'</option>';
										else
											echo '<option value ="'.$medico->nombre.'">Dr. '.$medico->nombre.'</option>';
								}
							?>
						</select>
						<div id = "test" style = "display: none">
							<input type="text" size = "14" name="otro" id = "otro" style="text-transform:capitalize" autocomplete="off"/>
						</div>		
				</li>
				<li>
					<label for="obra"><font color = "red">* </font> Obra social:</label>
						<select id ="obra" name = "obra" required>
								<option value = ""></option>';
							<?php
								foreach ($obras as $value) {
									if (!strcasecmp($obra,$value->obra))
										echo '<option value ="'.$value->obra.'" selected>'.$value->obra.'</option>';
									else
										echo '<option value ="'.$value->obra.'">'.$value->obra.'</option>';
								}
							?>
						</select>	
				</li>	
				<li>	
	            	<label for="tel1_1"><font color = "red">* </font> Teléfono 1:</label>
	            	<input type="tel" size="3" maxlength = "5" name="tel1_1" id="tel1_1" value="0341" autocomplete="off" onFocus="if (this.value=='0341') this.value='';" required pattern="[0-9].{2,}"/>
			    	<input type="tel" size = "8" maxlength = "10" name="tel1_2" id="tel1_2" autocomplete="off" required pattern="[0-9].{5,}"/>
	        	</li>
				<li>
	            	<label for="tel2_1">Teléfono 2:</label>
	            	<input type="tel" size="3" maxlength = "5" name="tel2_1" id ="tel2_1" autocomplete="off" pattern="[0-9].{2,}"/>
					<input type="tel" size = "8" maxlength = "10" name="tel2_2" id ="tel2_2" autocomplete="off" pattern="[0-9].{5,}"/>
					<input type="hidden" name="fecha" value="<?php echo $fecha ?>">
					<input type="hidden" name="hora" value="<?php echo $hora?>">
					<input type="hidden" id = "ficha" name="ficha" value = "">
					<input type="hidden" id = "id_paciente" name="id_paciente" value = "">
	        	</li>
	        	<li>
	            	<label for="notas">Notas:</label>
	            	<textarea name="notas" cols="40" rows="6"></textarea>
	        	</li>
	        	<li>
	        		<button class="submit" type="submit">Guardar</button>
					<button class="cancel" type = "button" onclick = "location.href= '<?php echo base_url("/index.php/main/cambiar_dia/$fecha")?>';">Cancelar</button>
	        	</li>
			</ul>
		</div>
	</form>
</body>
</html>
