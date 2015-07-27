<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Nuevo Turno</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui-1.8.24.custom.css')?>" rel="stylesheet" type="text/css"/>
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
		});

	function validar(esto){
		tel1 = document.getElementById("tel1_1").value;
		tel2 = document.getElementById("tel1_2").value;
		
		tel = tel1.length + tel2.length;		 
		
		tel11 = document.getElementById("tel2_1").value;
		tel21 = document.getElementById("tel2_2").value;
		
		tel3 = tel11.length + tel21.length;		 
		
		valido=false; 
		for(i=0; i<esto.elements.length; i++){
			var elem = esto[i]; 
			if(elem.type=="checkbox" && elem.checked==true){ 
				valido=true;
				break 
			} 
		} 
		if(!valido){ 
			alert("Se debe seleccionar al menos una casilla!");
			return false 
		}

		if (!( (tel == 11) || (tel == 13) )) {
			alert("El nro de téléfono no es válido");	
		  	return false
		}
		
		if (tel3 != 0)
		{
			if (!( (tel3 == 11) || (tel3 == 13) )) {
				alert("El nro de téléfono no es válido");	
			  	return false
			}
		}

	}
	
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
	<div class = "titulo">	

		<div id= "fecha">
			<?php 

				echo $day." ".$daynum. " de " .$month." de ".$year." "."-"." ".$horario."hs";
				$var = explode(':',$horario);
				$hora = $var[0];
				$minuto = $var[1];
			?>
		</div>
     <!-- <span class="required_notification">* Campos obligatorios</span> -->
	</div>	
	<span class="required_notification">* Campos obligatorios</span>
	<form class="contact_form" action="<?php echo base_url('index.php/main/pro_nuevo_turno#'.$horario)?>" method="post" name="contact_form" onsubmit = "return validar(this)">
		<div id = "ul1">
	    	<ul>
	    		<li>
	            	<label for="hora"><font color = "red">* </font> Hora:</label>
	            	<?php echo $hora ?><input type="text" size = "14" name="hora" autocomplete="off" value = "<?php echo $minuto ?>"required autofocus/>
	        	</li>
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
					<input type="checkbox" name="tipo[]" value = "LASER" id = "LASER"/><label for="LASER"> LASER </label>
				</div>
				<div class = "celda">
					<input type="checkbox" name="tipo[]" value = "CONSULTA" id = "CONSULTA"/><label for="CONSULTA"> Consulta </label> 
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
									echo '<option>'.$medico->nombre.'</option>';
								}
							?>
						</select>
						<div id = "test" style = "display: none">
							<input type="text" size = "14" name="otro" autocomplete="off"/>
						</div>		
				</li>
				<li>
					<label for="obra"><font color = "red">* </font> Obra social:</label>
						<div class="ui-widget">
							<input type="text" size = "21" id="obra" name ="obra" required autocomplete="off">
						</div>
				</li>	
				<li>	
	            	<label for="tel1_1"><font color = "red">* </font> Teléfono 1:</label>
	            	<input type="text" size="3" maxlength = "5" name="tel1_1" id="tel1_1" value="0341" autocomplete="off" onFocus="if (this.value=='0341') this.value='';" required pattern="[0-9].{2,}"/>
			    	<input type="text" size = "8" maxlength = "10" name="tel1_2" id="tel1_2" autocomplete="off" required pattern="[0-9].{5,}"/>
	        	</li>
				<li>
	            	<label for="tel2_1">Teléfono 2:</label>
	            	<input type="text" size="3" maxlength = "5" name="tel2_1" id ="tel2_1" autocomplete="off" pattern="[0-9].{2,}"/>
					<input type="text" size = "8" maxlength = "10" name="tel2_2" id ="tel2_2" autocomplete="off" pattern="[0-9].{5,}"/>
					<input type="hidden" name="fecha" value="<?php echo $fecha ?>">
					<input type="hidden" name="horario" value="<?php echo $horario?>">
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
