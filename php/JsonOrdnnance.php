<?php
function LoadOrdonnance($idOrdonnance)
{
	require 'php/database.inc';
    require 'php/traitement.inc';
    $database=new database();
    $result=$database->query(" select nom_medicament,doz,nbrboit from ordonnance as ord join traitement as trat join medicament as medi on ord.id_ordonnance=trat.id_ordonnance and trat.id_medicament=medi.id_medicament where ord.id_ordonnance=".$idOrdonnance);

    $array=array();
    while ($row =mysqli_fetch_assoc($result)) {
	    $array[]=new traitement($row["nom_medicament"],$row["doz"],$row["nbrboit"]);
    }

    echo "{ \"List\":".json_encode($array,JSON_UNESCAPED_UNICODE)."}";
}
?>
