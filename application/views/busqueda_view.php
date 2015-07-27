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

    .fecha_completa {width: 65%; float: left; font-size: 50px; margin-left: 10px;}
    .fila_superior1 {height: 100px; border-bottom: 4px solid white; background-color: #efefef; //#efefef}
    .hora_citado {margin-left: 50px; margin-top: 20px }
	</style>
	<script>
    function chequear(url,data) {
        $( "#dialog-confirm" ).dialog({
			autoOpen: true,
            resizable: false,
			width: 800,
            height:240,
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
            Volver a Turnos..
        </div>  
    </div>
</div>  
<div id = "horarios">
 <?php
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    if ($busqueda <> 0) {
    
        foreach ($busqueda as $fila) 
        { 
            $hora_completa = date('H:i', strtotime($fila->hora));
            $cita = date('H:i', strtotime($fila->citado));

                echo '<div class = "fila_superior1">';
                    echo '<div class = "fecha_completa">';
                        $ind_mes = (int) date("m", strtotime($fila->fecha));
                        $ind_dia = (int) date("w", strtotime($fila->fecha));
                        $ind_num = (int) date("d", strtotime($fila->fecha));
                        $ind_anio = (int) date("Y", strtotime($fila->fecha));
                        echo $dias[$ind_dia].' '.$ind_num.', '.$meses[$ind_mes - 1].' '.$ind_anio;
                    echo '</div>';
                    echo '<div class = "hora_ocupada">';
                        echo '<a name="'.$hora_completa.'">'.$hora_completa.'</a>';
                    echo '</div>';

                    if (($cita <> '00:00') && ($cita <> $hora_completa)){
                        echo '<div class = "hora_citado">';
                            echo '<a>cita: '.$cita.'</a>';
                        echo '</div>';  
                    }

                echo '</div>';

            echo '<div class = "fila_ocupada" onclick = "location.href=\''.base_url("/index.php/main/vista_turno/".$fila->id).'\';" style="cursor: pointer;">';
                echo '<div class = "fila_superior2">';
                    echo '<div class = "nombre_apellido">';     
                       echo $fila->apellido.', '.$fila->nombre;
                    echo '</div>';
                echo '</div>';  
                echo '<div class = "datos">';
                    
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
                    echo '<div class = "campos">';
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
                    $data = $fila->fecha.'/'.$hora.'/'.$minutos;
                    
                    
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }

    }    
    else 
    {
    ?>    
    <div style = "font-size: 70px; text-align: center; margin-top: 100px">
        <?php echo "<i>No hay coincidencias..</i>"; ?>
    </div>    
    <?php 
}
?>
</div>
</body>
</html>
