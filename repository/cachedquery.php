<?php
include "cache.php";
include "queries.php";


function getCachedSummary($location){
    return getCached("getSummary", "getSummary", $location);
}
function getCachedPUIPerDate($location){
    return getCached("getPUIPerDate", "getPUIPerDate", $location);
}
function getCachedCasesPerDate($location){
    return getCached("getCasesPerDate", "getCasesPerDate", $location);
}
function getCachedSummaryPerCityMunicipalityTable($brgyname){
    return getCached("getSummaryPerCityMunicipalityTable", "getSummaryPerCityMunicipalityTable", $brgyname);
}
function getCachedSummaryPerCityMunicipalityChart($location){
    return getCached("getSummaryPerCityMunicipalityChart", "getSummaryPerCityMunicipalityChart", $location);
}
function getCachedCasesByGender($location){
    return getCached("getCasesByGender", "getCasesByGender", $location);
}
function getCachedCasesByAgeGroup($location){
    return getCached("getCasesByAgeGroup", "getCasesByAgeGroup", $location);
}
function getCachedRecoveredPerDate($location){
    return getCached("getRecoveredPerDate", "getRecoveredPerDate", $location);
}
function getCachedDeceasedPerDate($location){
    return getCached("getDeceasedPerDate", "getDeceasedPerDate", $location);
}
print_r(getCachedSummary("BINAN"));
?>