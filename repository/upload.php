<?php
include "../phpcore/simpleauth.php";
require_auth();
/**
* WARNING:
* THIS CODE IS WORK IN PROGRESS
* I have decided to not put all data in memory as it might cause performance issues.
* I, however, am not confident about this decision. Please raise an issue in the repo if this may lead to future issues.
*
* @author Job Lipat
*/

/**
* Executes the function on button press
*/

if(isset($_POST["submitButton"])){
    $val = $_POST["submitButton"];
    if($val == "updateIndividualCases"){
        callUpdateIndividualCases();
    }else if($val == "updateBarangayHistory"){
        callUpdateBarangayHistory();
    }else if($val == "updateBarangayHistoryNew"){
        callUpdateBarangayHistoryNew();
    }else if($val == "clearCache"){
        clearCache();
    }
}
//Link to allow user to return to uploadView.php
echo "<br><a href = 'uploadView.php'>Return to uploader</a>";

/**
 * Deletes all cached queries.
 */
function clearCache(){
    $files = glob(dirname(__FILE__).("/cached/*")); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file))
        unlink($file); // delete file
    }
    echo "Cache Cleared";

}

/**
* Calls the update updateIndividualCases with the API links
*/
function callUpdateIndividualCases(){
    if(!file_exists("links.json")){
        echo "links.json is not found please contact the developers";
        return;
    }
    $links =  json_decode(file_get_contents("links.json"), true);
    $individualLinks = $links["individual"];
    updateIndividualCases($individualLinks);
    
}

/**
* Calls the update updateBarangayHistory with the API links
*/
function callUpdateBarangayHistory(){
    if(!file_exists("links.json")){
        echo "links.json is not found please contact the developers";
        return;
    }
    $links =  json_decode(file_get_contents("links.json"), true);
    $overviewLinks = $links["overview"];
    updateBarangayHistory($overviewLinks);
    
}

/**
* Calls the update updateBarangayHistoryNew with the API links
*/
function callUpdateBarangayHistoryNew(){
    if(!file_exists("links.json")){
        echo "links.json is not found please contact the developers";
        return;
    }
    $links =  json_decode(file_get_contents("links.json"), true);
    $overviewLinks = $links["overview"];
    updateBarangayHistoryNew($overviewLinks);
}

/**
* Updates the individual cases table using data from the google sheets.
*
* @param array $apiLinks the list of google sheet csv file links to import
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
            
            //extract data from line of csv
            $barangay = getSqlStr($current[0]);
            $cityMunicipality = getSqlStr($current[1]);
            $caseCode = getSqlStr($current[2]);
            $gender = getSqlStr($current[3]);
            $age = $current[4];
            $dateConfirmed = getSqlStr($current[5]);
            $caseStatus = getSqlStr($current[6]);
            $dateOfStatus = getSqlStr($current[7]);
            
            //build query
            $insertQuery .= "(".$barangay.", ".$cityMunicipality.", ".$caseCode.", ".$gender.", ".$age.", ".$dateConfirmed.", ".$caseStatus.", ".$dateOfStatus."), ";
        }
        //remove space and comma and replace with semicolon
        $insertQuery  = substr($insertQuery, 0, -2).";";
        mysqli_query($con, $insertQuery)  or die(mysqli_error($con));
    }
    if (!mysqli_commit($con)) {
        echo "Commit transaction failed"; //Query Fails
        exit();
    }else{
        $lastInsertID = mysqli_insert_id($con);
        echo "Imported data to individual_cases without any errors. Last insert ID: ".$lastInsertID; //Query Succeeds
    }
    return TRUE;
    
}

/**
* Updates the barangay history table using data from the google sheets
*
* @param array $apiLinks the list of google sheet csv file links to import
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
            
            //extract data from line of csv
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
            if($suspectPUI < 0) $suspectPUI = 0;
            $probablePUI = $current[9];
            if($probablePUI < 0) $probablePUI = 0;
            //build query
            $insertQuery .= "(".$referenceDate.", ".$cityMunicipality.", ".$barangay.", ".$newPositiveCase.", ".$currentPositiveCase.", ".$currentDeceased.", ".$currentRecovered.", ".$totalPositiveCases.", ".$currentPUI.", ".$suspectPUI.", ".$probablePUI.", 0), ";
        }
        //remove space and comma and replace with semicolon
        $insertQuery  = substr($insertQuery, 0, -2).";";
        mysqli_query($con, $insertQuery) or die(mysqli_error($con));
    }
    if (!mysqli_commit($con)) {
        echo "Commit transaction failed"; //Query Fails
        exit();
    }else{
        $lastInsertID = mysqli_insert_id($con);
        echo "Imported data to barangay_history without any errors. Last insert ID: ".$lastInsertID; //Query Succeeds
    }
    return TRUE;
}

/**
* Updates the barangay history new table using data from the google sheets
*
* @param array $apiLinks the list of google sheet csv file links to import
*/
function updateBarangayHistoryNew($apiLinks){
    $con = getConnection();       
    mysqli_autocommit($con, FALSE); 
    
    // TRUNCATE TABLE
    $truncateBarangayHistory = "TRUNCATE barangay_history_new;";
    mysqli_query($con, $truncateBarangayHistory) or die("Failed to truncate barangay_history_new");
    $truncateNewCases = "TRUNCATE New_Cases;" or die("Failed to truncate New_Cases");
    mysqli_query($con, $truncateNewCases);
    foreach ($apiLinks as $link) {
        $insertQuery = "";
        $apiContent = file_get_contents($link);
        $lines = explode(PHP_EOL, $apiContent);
        foreach ($lines as $line) {
            $current = str_getcsv($line);
            
            //extract data from line of csv
            $referenceDate = getSqlStr($current[0]);
            $cityMunicipality = getSqlStr($current[1]);
            $barangay = getSqlStr($current[2]);
            $newPositiveCase = $current[3];
            $currentPositiveCase = $current[4];
            $currentDeceased = $current[5];
            $currentRecovered = $current[6];
            $totalPositiveCases = $current[7];
            $suspectPUI = $current[8];
            if($suspectPUI < 0) $suspectPUI = 0;
            $probablePUI = $current[9];
            if($probablePUI < 0) $probablePUI = 0;
            $totalPUI = $current[10];
            
            //build query
            $insertQuery = "CALL `normInsertBarangayHistoryNew`(".$referenceDate.", ".$cityMunicipality.", ".$barangay.", ".$newPositiveCase.", ".$currentPositiveCase.", ".$currentDeceased.", ".$currentRecovered.", ".$totalPositiveCases.", ".$suspectPUI.", ".$probablePUI.", ".$totalPUI."); ";
            mysqli_query($con, $insertQuery) or die(mysqli_error($con));
        }
    }
    if (!mysqli_commit($con)) {
        echo "Commit transaction failed"; //Query Fails
        exit();
    }else{
        $lastInsertID = mysqli_insert_id($con);
        echo "Imported data to barangay_history_new without any errors. Last insert ID: ".$lastInsertID; //Query Succeeds
    }
    return TRUE;
}

/**
* 
*/
function getConnection(){
    include '../phpcore/connection.php';
    return $con;
}

/**
* Helper function to aid inserting string in SQL. Puts quotes around a string.
*
* @param string $string the string to enclose in quotation marks
* @return string returns the string enclosed in quotation marks. 
*/
function getSqlStr($string){
    return "'".$string."'";
}




?>