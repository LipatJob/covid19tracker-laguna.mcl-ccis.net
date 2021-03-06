<?php
include_once "cache.php";
include_once "queries.php";

function getQueryCache($functionName, $location){
    return getCached($functionName.$location, $functionName, $location);
}

/**
 * WRAPPER FUNCTIONS FOR CACHE AND QUERIES
 */

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
    return getQueryCache("getSummaryPerCityMunicipalityTable", $brgyname);
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

function getCachedCurrentTrend($location){
    return getQueryCache("getCurrentTrend", $location);
}

?>