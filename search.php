<?php

$host="localhost";
$user="root";
$password="power";

$link = mysql_connect ($host, $user, $password) or die ("<center>No se puede conectar con la base de datos\n</center>\n");
mysql_select_db("CCO") or die("Error en la selección de la base de datos");

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$query = "SELECT obra FROM obras_sociales WHERE obra LIKE '%Grupo%'";
$result = mysql_query ($query, $link);

while ($row = mysql_fetch_array($result))//loop through the retrieved values
{
		$row['value']= htmlentities($row['obra']);
		$row_set[] = $row;//build an array
}

//echo json_encode($row_set);//format the array into json data
$resultados = json_encode($row_set); 
$resultados = str_replace("\/","/",$resultados); 
$resultados = str_replace('"','\\"',$resultados); 
$resultados = json_decode('"'.$resultados.'"'); 
print_r($resultados);

mysql_close($link);

?>
