<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Nueva Nota</title>
	<link href="<?php echo base_url('css/styles.css')?>" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.2.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery-ui-1.8.24.custom.min.js')?>"></script>
	<link href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" type="text/css"/>
	<style>

		.contact_form textarea {width: 900px;}

		#fecha1 { width: 40%;}
		#fecha2 { width: 60%; margin-top: 20px;}
		.titulo{ height: 220px;}
		button.submit {font-size: 40px; padding-left: 60px; padding-right: 60px; font-family: 'Segoe'}
		button.cancel {font-size: 40px; padding-left: 60px; padding-right: 60px; font-family: 'Segoe'}
		.contact_form button {margin-left: 120px}

	</style>
</head>
<body>
	<div class = "titulo">	
		<div style="text-align:right; font-size: 60px; margin-bottom: 30px; width: 95%">
			Notas del día
		</div>	
		<div id= "fecha1">
			<?php 
				echo $dia." ".$nombre_dia.",";
			?>
		</div>
		<div id = "fecha2">
			<?php
				echo $mes." ".$ano;
			?>	
		</div>	
     <!-- <span class="required_notification">* Campos obligatorios</span> -->
	</div>	
	<form class="contact_form" action="<?php echo base_url('index.php/main/pro_add_notas#'.$fecha)?>" method="post" name="contact_form" onsubmit = "return validar(this)">
	<ul>
		<li>
			<textarea name="notas" cols="40" rows="6" required></textarea>		
			<input type="hidden" name="fecha" value="<?php echo $fecha ?>">
		</li>	
		<li>
			<button class="submit" type="submit">Guardar</button>
			<button class="cancel" type = "button" onclick = "location.href= '<?php echo base_url("/index.php/main/cambiar_dia/$fecha")?>';">Cancelar</button>
		</li>
	</ul>
	</form>
</body>
</html>
