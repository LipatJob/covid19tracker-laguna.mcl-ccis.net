<?php
include "cache.php";
include "queries.php";

function getQueryCache($functionName, $location){
    $location = str_replace(' ', '', $location);
    return getCached($functionName.$location, $functionName, $location);
}

function getCachedSummary($location){
    return getQueryCache("getSummary", $location);
}

function getCachedPUIPerDate($location){
    return getQueryCache("getPUIPerDate", $location);
}

function getCachedCasesPerDate($location){
    return getQueryCache("getCasesPerDate", $location);
}

function getCachedSummaryPerCityMunicipalityTable($brgyname){
    return getQueryCache("getSummaryPerCityMunicipalityTable", $location);
}

function getCachedSummaryPerCityMunicipalityChart($location){
    return getQueryCache("getSummaryPerCityMunicipalityChart", $location);
}

function getCachedCasesByGender($location){
    return getQueryCache("getCasesByGender", $location);
}

function getCachedCasesByAgeGroup($location){
    return getQueryCache("getCasesByAgeGroup", $location);
}

function getCachedRecoveredPerDate($location){
    return getQueryCache("getRecoveredPerDate", $location);
}

function getCachedDeceasedPerDate($location){
    return getQueryCache("getDeceasedPerDate", $location);
}

print_r(getCachedDeceasedPerDate("CALAMBA"));
?>