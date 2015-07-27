<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>home</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<meta name="author" content="Macsee">
	<style type="text/css">

	.button_example{
			background-color: #a5bed8;
			text-decoration: none;
			border-radius: 4px;
			font-size: 60px;
			color: white;
			text-shadow: 0 2px 0 #b3b3b3;
	}
	
	.button_example:active {
		background-color: #dae3f0;
	}
	
	.button_example:hover {
		background-color: #dae3f0;
	}	
	
	.button_example:visited {color: none}
	
	.clase1{
			padding-left: 321px;
			padding-right: 350px;
			padding-top: 30px;
			padding-bottom: 30px;
	}
	
	.clase2{
			padding-left: 280px;
			padding-right: 321px;
			padding-top: 30px;
			padding-bottom: 30px;
	}
	.clase3{
			padding-left: 248px;
			padding-right: 298px;
			padding-top: 30px;
			padding-bottom: 30px;
	}
	.clase4{
			padding-left: 296px;
			padding-right: 327px;
			padding-top: 30px;
			padding-bottom: 30px;
	}
	.clase5{
			padding-left: 262px;
			padding-right: 305px;
			padding-top: 30px;
			padding-bottom: 30px;
	}
	.boton_home{
			margin-bottom: 80px;
			margin-left: 6%;
	}
	
	#portada{
		margin-top: 15px;
	}


	</style>
	</head>	
<body>
	<div id = "home">
	<div id = "logo">
		<img src="<?php echo base_url('css/images/logo.png')?>" alt="logo">
	</div>
	<div id = "portada">
<?php 
		echo '<div class = "boton_home">';
			echo '<a class = "button_example clase1" href="'.base_url('index.php/main/cambiar_dia/'.date("Y-m-d")).'">Turnos</a>';
		echo '</div>';
		echo '<div class = "boton_home">';
			echo '<a class = "button_example clase2" href="#">Pacientes</a>';
		echo '</div>';
		echo '<div class = "boton_home">';
			echo '<a class = "button_example clase3" href="#">Facturación</a>';
		echo '</div>';
		echo '<div class = "boton_home">';
			echo '<a class = "button_example clase4" href="#">Agendas</a>';
		echo '</div>';
		echo '<div class = "boton_home">';
			echo '<a class = "button_example clase5" href="'.base_url('index.php/main/show_calendar/').'">Calendario</a>';
		echo '</div>';
?>		
	</div>
	</div>
</body>
</html>
