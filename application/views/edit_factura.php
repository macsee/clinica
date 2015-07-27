<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Nuevo Turno</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script> 
	function validar(esto){
		
		 
		if(!valido){ 
			alert("Se debe seleccionar al menos una casilla!");
			return false 
		}
/*
		if( tel1 == null || tel1.length == 0 || /^\s+$/.test(test) ) {
			alert("Se necesita ingresar al menos un teléfono");	
		  	return false
		}
		else {
			return true
		}
*/		
	}  
	</script>	
</head>
<body>
		
	<div class = "titulo">	
		Facturación
     <!-- <span class="required_notification">* Campos obligatorios</span> -->
	</div>	
	
	<form class="contact_form" action="<?php echo base_url('index.php/main/pro_facturacion')?>" method="post" name="contact_form" onsubmit = "return validar(this)">
		<div id = "ul1">
	    	<ul>
	        	<li>
	        		<label for="medico">Paciente:</label>
	            	<?php echo $filas[0]->nombre.' '.$filas[0]->apellido.' '.$filas[0]->ficha?>
	        	</li>
	        	<li>
					<label for="medico">Médico:</label>
						
							<?php echo $filas[0]->medico?>
								
				</li>
				<li>
					<label for="obra">Obra social:</label>
							<?php echo $filas[0]->obra_social?>
				</li>
		 	</ul>
		</div>
	    <div id="tipo_turno"> Tipo de turno:</div>
		<div id = "tabla">
			<?php 
				$cadena = $filas[0]->tipo;
			?>
			<div class = "fila">
				<div class = "celda">
					<?php if ( strstr($cadena, "CVC") <> "") {?>
						<input type="checkbox" name="tipo[]" value = "CVC" id = "CVC" checked/><label for="CVC"> CVC </label> 		
					<?php }
					else { ?>
						<input type="checkbox" name="tipo[]" value = "CVC" id = "CVC"/><label for="CVC"> CVC </label>
					<?php }?> 		
				</div>
				<div class = "celda_2">
					<?php if ( strstr($cadena, "TOPO") <> "") {?>
						<input type="checkbox" name="tipo[]" value = "TOPO" id = "TOPO" checked/><label for="TOPO"> TOPO </label>
					<?php }
					else { ?>
						<input type="checkbox" name="tipo[]" value = "TOPO" id = "TOPO"/><label for="TOPO"> TOPO </label>
					<?php }?>	
				</div>
				<div class = "celda">
					<?php if ( strstr($cadena, "IOL") <> "") {?>
						<input type="checkbox" name="tipo[]" value = "IOL"id = "IOL" checked/><label for="IOL"> IOL </label>
					<?php }
					else { ?>
						<input type="checkbox" name="tipo[]" value = "IOL"id = "IOL"/><label for="IOL"> IOL </label>
					<?php }?>	
				</div>
				<div class = "celda">
					<?php if ( strstr($cadena, "ME") <> "") {?>
						<input type="checkbox" name="tipo[]" value = "ME" id = "ME" checked/><label for="ME"> ME </label>
					<?php }
					else { ?>
						<input type="checkbox" name="tipo[]" value = "ME" id = "ME"/><label for="ME"> ME </label>
					<?php }?>
				</div>	
			</div>
			<div class = "fila">
				<div class = "celda">
					<?php if ( strstr($cadena, "RFG") <> "") {?>
						<input type="checkbox" name="tipo[]" value = "RFG"id = "RFG" checked/><label for="RFG"> RFG </label>
					<?php }
					else { ?>
						<input type="checkbox" name="tipo[]" value = "RFG"id = "RFG"/><label for="RFG"> RFG </label>
					<?php }?>	
				</div>
				<div class = "celda_2">
					<?php if ( strstr($cadena, "RFG-Color") <> "") {?>
						<input type="checkbox" name="tipo[]" value = "RFG-Color"id = "RFG-Color" checked/><label for="RFG-Color"> RFG-Color </label>
					<?php }
					else { ?>
						<input type="checkbox" name="tipo[]" value = "RFG-Color"id = "RFG-Color"/><label for="RFG-Color"> RFG-Color </label>
					<?php }?>	
				</div>
				<div class = "celda">
					<?php if ( strstr($cadena, "OCT") <> "") {?>
						<input type="checkbox" name="tipo[]" value = "OCT" id = "OCT" checked/><label for="OCT"> OCT </label>
					<?php }
					else { ?>
						<input type="checkbox" name="tipo[]" value = "OCT" id = "OCT"/><label for="OCT"> OCT </label>	
					<?php }?>	
				</div>
				<div class = "celda">
					<?php if ( strstr($cadena, "PAQUI") <> "") {?>
						<input type="checkbox" name="tipo[]" value = "PAQUI"id = "PAQUI" checked/><label for="PAQUI"> PAQUI </label>
					<?php }
					else { ?>
						<input type="checkbox" name="tipo[]" value = "PAQUI"id = "PAQUI"/><label for="PAQUI"> PAQUI </label>
					<?php }?>	
				</div>
			</div>
			<div class = "fila">
				<div class = "celda">
					<?php if ( strstr($cadena, "OBI") <> "") {?>
						<input type="checkbox" name="tipo[]" value = "OBI" id = "OBI" checked/><label for="OBI"> OBI </label>
					<?php }
					else { ?>
						<input type="checkbox" name="tipo[]" value = "OBI" id = "OBI"/><label for="OBI"> OBI </label>
					<?php }?>		 
				</div>			
				<div class = "celda_2">
				<?php if ( strstr($cadena, "YAG") <> "") {?>	
					<input type="checkbox" name="tipo[]" value = "YAG" id = "YAG" checked/><label for="YAG"> YAG </label>
				<?php }
					else { ?>
					<input type="checkbox" name="tipo[]" value = "YAG" id = "YAG"/><label for="YAG"> YAG </label>
				<?php }?>		 
				</div>
				<div class = "celda">
				<?php if ( strstr($cadena, "LASER") <> "") {?>	
					<input type="checkbox" name="tipo[]" value = "LASER" id = "LASER" checked/><label for="LASER"> LASER </label>
				<?php }
					else { ?>
					<input type="checkbox" name="tipo[]" value = "LASER" id = "LASER"/><label for="LASER"> LASER </label>
				<?php }?>		
				</div>
				<div class = "celda">
				<?php if ( strstr($cadena, "CONSULTA") <> "") {?>
					<input type="checkbox" name="tipo[]" value = "CONSULTA" id = "CONSULTA" checked/><label for="CONSULTA"> Consulta </label> 
				<?php }
					else { ?>
					<input type="checkbox" name="tipo[]" value = "CONSULTA" id = "CONSULTA"/><label for="CONSULTA"> Consulta </label> 
				<?php }?>		
				</div>			
			</div>			
			<div class = "fila">
				<div class = "celda">
				<?php if ( strstr($cadena, "HRT") <> "") {?>
					<input type="checkbox" name="tipo[]" value = "HRT" id = "HRT" checked/><label for="HRT"> HRT </label> 
				<?php }
					else { ?>
					<input type="checkbox" name="tipo[]" value = "HRT" id = "HRT"/><label for="HRT"> HRT </label> 
				<?php }?>		
				</div>			
			</div>			
		</div>
		<div id = "ul2">	
			<ul>
				<li>
				</li>						
					        	
	        	<li>
	        		<input type="hidden" name="fecha" value="<?php echo $filas[0]->fecha?>"/>
	        		<input type="hidden" name="id" value="<?php echo $filas[0]->id?>"/>
	        		<input type="hidden" name="medico" value="<?php echo $filas[0]->medico?>"/>
	        		<input type="hidden" name="obra" value="<?php echo $filas[0]->obra_social?>"/>
	           	</li>	
	        	<li>
	        		<button class="submit" type="submit">Guardar</button>
					<button class="cancel" type = "button" onclick = "location.href= '<?php echo base_url("/index.php/main/vista_turno/".$filas[0]->id)?>';">Cancelar</button>
	        	</li>
			</ul>
		</div>
	</form>

<div id="result"></div>

</body>
</html>