<?php

include_once "queries.php";

function testSortKeyValueArray(){
    $items = [["item1", "item2", "item3", "item4", "item5"], [1, 4, 3, 5, 2]];
    $items = sortKeyValueArray($items);
    echo json_encode($items);
}

testSortKeyValueArray();
echo json_encode(getSummaryPerCityMunicipalityChart("LAGUNA")["NonZeroCases"]);