<?php

/**
* WARNING:
* THIS CODE IS WORK IN PROGRESS
* I have decided to not put all data in memory as it might cause performance issues.
* I, however, am not confident about this decision. Please raise an issue in the repo if this may lead to future issues.
*/
function getConnection(){
    include '../phpcore/connection.php';
    return $con;
}

/**
* Helper function to aid inserting string in SQL. Puts quotes around a string.
* @param String $string the string to enclose in quotation marks
* @return String returns the string enclosed in quotation marks. 
*/
function getSqlStr($string){
    return "'".$string."'";
}

/**
* Updates the individual cases table using data from the google sheets.
* @param Array $apiLinks the list of google sheet csv file links to import
*/
function updateIndividualCases($apiLinks){
    $con = getConnection();       
    mysqli_autocommit($con, FALSE); 
    
    // TRUNCATE TABLE
    $truncateQuery = "TRUNCATE individual_cases;";
    mysqli_query($con, $truncateQuery);
    foreach ($apiLinks as $link) {
        $insertQuery = "INSERT INTO `individual_cases` (`barangay`, `city_municipality`, `official_case_code`, `gender`, `age`, `date_confirmed`, `case_status`, `date_of_status`) VALUES ";
        $apiContent = file_get_contents($link);
        $lines = array_slice(explode(PHP_EOL, $apiContent),1);
        foreach ($lines as $line) {
            $current = str_getcsv($line);
            
            $barangay = getSqlStr($current[0]);
            $cityMunicipality = getSqlStr($current[1]);
            $caseCode = getSqlStr($current[2]);
            $gender = getSqlStr($current[3]);
            $age = $current[4];
            $dateConfirmed = getSqlStr($current[5]);
            $caseStatus = getSqlStr($current[6]);
            $dateOfStatus = getSqlStr($current[7]);
            
            $insertQuery .= "(".$barangay.", ".$cityMunicipality.", ".$caseCode.", ".$gender.", ".$age.", ".$dateConfirmed.", ".$caseStatus.", ".$dateOfStatus."), ";
        }
        $insertQuery  = substr($insertQuery, 0, -2).";";
        mysqli_query($con, $insertQuery)  or die(mysqli_error($con));
    }
    if (!mysqli_commit($con)) {
        echo "Commit transaction failed";
        exit();
    }else{
        echo "success";
    }
    
}

/**
* Updates the barangay history table using data from the google sheets
* @param Array $apiLinks the list of google sheet csv file links to import
*/
function updateBarangayHistory($apiLinks){
    $con = getConnection();       
    mysqli_autocommit($con, FALSE); 
    
    // TRUNCATE TABLE
    $truncateQuery = "TRUNCATE barangay_history;";
    mysqli_query($con, $truncateQuery);
    foreach ($apiLinks as $link) {
        $insertQuery = "INSERT INTO `barangay_history` (`reference_date`, `city_municipality`, `barangay`, `new_positive_case`, `current_positive_case`, `current_deceased`, `current_recovered`, `total_positive_cases`, `current_pui`, `suspect_PUI`, `probable_PUI`,`current_pum`) VALUES ";
        $apiContent = file_get_contents($link);
        $lines = explode(PHP_EOL, $apiContent);
        foreach ($lines as $line) {
            $current = str_getcsv($line);
            
            $referenceDate = getSqlStr($current[0]);
            $cityMunicipality = getSqlStr($current[1]);
            $barangay = getSqlStr($current[2]);
            $newPositiveCase = $current[3];
            $currentPositiveCase = $current[4];
            $currentDeceased = $current[5];
            $currentRecovered = $current[6];
            $totalPositiveCases = $current[7];
            $currentPUI = $current[10];
            $suspectPUI = $current[8];
            $probablePUI = $current[9];
            
            $insertQuery .= "(".$referenceDate.", ".$cityMunicipality.", ".$barangay.", ".$newPositiveCase.", ".$currentPositiveCase.", ".$currentDeceased.", ".$currentRecovered.", ".$totalPositiveCases.", ".$currentPUI.", ".$suspectPUI.", ".$probablePUI.", 0), ";
        }
        $insertQuery  = substr($insertQuery, 0, -2).";";
        mysqli_query($con, $insertQuery)  or die(mysqli_error($con));
    }
    if (!mysqli_commit($con)) {
        echo "Commit transaction failed";
        exit();
    }else{
        echo "success";
    }
}

/**
* Updates the barangay history new table using data from the google sheets
* @param Array $apiLinks the list of google sheet csv file links to import
*/
function updateBarangayHistoryNew($apiLinks){
    $con = getConnection();       
    mysqli_autocommit($con, FALSE); 

    // TRUNCATE TABLE
    $truncateQuery = "TRUNCATE barangay_history_new; TRUNCATE New_Cases;";
    mysqli_query($con, $truncateQuery);
    foreach ($apiLinks as $link) {
        $insertQuery = "";
        $apiContent = file_get_contents($link);
        $lines = explode(PHP_EOL, $apiContent);
        foreach ($lines as $line) {
            $current = str_getcsv($line);
            
            $referenceDate = getSqlStr($current[0]);
            $cityMunicipality = getSqlStr($current[1]);
            $barangay = getSqlStr($current[2]);
            $newPositiveCase = $current[3];
            $currentPositiveCase = $current[4];
            $currentDeceased = $current[5];
            $currentRecovered = $current[6];
            $totalPositiveCases = $current[7];
            $suspectPUI = $current[8];
            $probablePUI = $current[9];
            $totalPUI = $current[10];
            
            $insertQuery = "CALL `normInsertBarangayHistoryNew`(".$referenceDate.", ".$cityMunicipality.", ".$barangay.", ".$newPositiveCase.", ".$currentPositiveCase.", ".$currentDeceased.", ".$currentRecovered.", ".$totalPositiveCases.", ".$suspectPUI.", ".$probablePUI.", ".$totalPUI."); ";
            mysqli_query($con, $insertQuery) or die(mysqli_error($con));
        }
    }
    if (!mysqli_commit($con)) {
        echo "Commit transaction failed";
        exit();
    }else{
        echo "success";
    }
}


/**
* Calls the update database functions with the API links
*/
function callUpdates(){
    /**
     * @todo decide where to put the API links
     * @todo call the functions with the API links
     */
}

?>