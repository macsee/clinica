<?php
  
$host="localhost";
$user="root";
$password="power";

$link = mysql_connect ($host, $user, $password) or die ("<center>No se puede conectar con la base de datos\n</center>\n");
mysql_select_db("CCO") or die("Error en la selección de la base de datos");

//$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
//$query = "SELECT obra FROM obras_sociales WHERE obra LIKE '%".$term."%'";
$query = "SELECT obra FROM obras_sociales";
//mysql_query('SET CHARACTER SET utf8-');
$result = mysql_query ($query, $link);

while ($row = mysql_fetch_array($result))//loop through the retrieved values
{
		//$row['value']= $row['obra'];
		echo $row['obra'];
		echo '<br>';
		//$row_set[] = array_map('utf8_encode', $row);//build an array
}

//print_r($row_set);
//echo json_encode($row_set);//format the array into json data
/*
$resultados = json_encode($row_set);  
$resultados = str_replace("U+00F1","ñ",$resultados); 
$resultados = str_replace("U+00E1","á",$resultados);
$resultados = str_replace("U+00E9","é",$resultados);
$resultados = str_replace("U+00ED","í",$resultados);
$resultados = str_replace("U+00F3","ó",$resultados);
$resultados = str_replace("U+00FA","ú",$resultados);
echo $resultados;*/
mysql_close($link);

?>
