<?php
include "../repository/cachedqueries.php";
$brgyname = $_GET['arguments'][0];

switch($_GET["functionname"]){ 
    case 'getData': 
        getData($brgyname);
    break;      
}

function getData($brgyname){
    $data = getCachedSummaryPerCityMunicipalityTable($brgyname);
    echo json_encode($data);
}

?>