<?php

/**
 * WARNING:
 * THIS CODE IS WORK IN PROGRESS
 */

 
function getConnection(){
    include '../phpcore/connection.php';
    return $con;
}

/**
 * Updates the individual cases table using data from the google sheets.
 * I have decided to not put all data in memoery as it might cause performance issues.
 * I, however, am not confident about this decision. Please raise an issue in the repo if this may lead to future issue.
 * @param Array $apiLinks the list of google sheet csv file links to import
 */
function updateIndividualCases($apiLinks){
    // TRUNCATE TABLE
    $truncateQuery = "TRUNCATE individual_cases;";
    foreach ($apiLinks as $link) {
        $insertQuery = "INSERT INTO `individual_cases` (`barangay`, `city_municipality`, `official_case_code`, `gender`, `age`, `date_confirmed`, `case_status`, `date_of_status`) VALUES ";
        //COMPILE 
    }
}

/**
 * Updates the barangay history table using data from the google sheets
 * @param Array $apiLinks the list of google sheet csv file links to import
 */
function updateBarangayHistory($apiLinks){
    // TRUNCATE TABLE
    $truncateQuery = "TRUNCATE barangay_history;";

}

/**
 * Updates the barangay history new table using data from the google sheets
 * @param Array $apiLinks the list of google sheet csv file links to import
 */
function updateBarangayHistoryNew($apiLinks){
    // TRUNCATE TABLE
    $truncateQuery = "TRUNCATE barangay_history_new; TRUNCATE New_Cases";
}


/**
 * Calls the update database functions with the API links
 */
function callUpdates(){

}

?>