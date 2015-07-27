<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="<?php echo base_url('css/template.css')?>" rel="stylesheet" type="text/css"/>
	<title>Calendario</title>
	<!-- Date: 2012-09-02 -->
</head>
<body>

<div id = "menu" style="height: 130px; margin-bottom: 5px">
    <div id = "dia_anterior">
    	<div style = "float: left">
        <?php 
            echo '<a href="'.base_url('index.php/main/cambiar_dia/'.date('Y-m-d')).'">';
                echo '<img src = "'.base_url('css/images/atras.png').'"/>';
            echo '</a>';
         ?>
     	</div>
         <div id = "calendario_titulo" style = "font-size: 50px; float: left; font-weigth: bold; color: white; margin-left: 30px">
            Volver a Turnos
        </div>	
    </div>
</div>
<div style = "margin-top: 50px">   
<?php
echo $calendario;
?>
</div>
</body>
</html>
