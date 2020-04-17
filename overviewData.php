<?php
include 'phpcore/connection.php';

if(mysqli_error($con)){
    echo "Error connection to database";
}


$brgyname = $_GET['arguments'][0];

switch($_GET["functionname"]){ 
    case 'getData': 
        getData($brgyname,$con);
    break;      
}


// nevermind the multiple code smells and anti patterns
function getData($brgyname,$con){
    $brgyname = str_replace("%20"," ",$brgyname);
  //$brgyname = str_replace(" ","",$brgyname);
    
    // returned json file is split into header, body and footer
    $header = [];
    $body = [];
    $footer = [];
    
    // initialize queries
    if($brgyname == 'LAGUNA'){
        $header = ["CITY / MUNICIPALITY","TOTAL CASES","NEW CASES","ACTIVE CASES","RECOVERED","SUSPECT","PROBABLE","DECEASED"];
        //$bodyQuery = "SELECT Province, TOTAL_POSITIVE_CASES, NEW_POSITIVE_CASES, TOTAL_CURRENT_POSITIVE, TOTAL_RECOVERED, TOTAL_SUSPECT, TOTAL_PROBABLE, TOTAL_DECEASED FROM ALL_TOTAL";
        $bodyQuery = "SELECT city.CityName, SUM(brgynew.total_positive_cases), SUM(brgynew.new_positive_case), SUM(brgynew.current_positive_case), SUM(brgynew.current_recovered), SUM(casesN.current_suspect_PUI), SUM(casesN.current_probable_PUI), SUM(brgynew.current_deceased)
            FROM barangay_history_new as brgynew
                INNER JOIN New_Cases as casesN
                on brgynew.ID = casesN.BarangayHistID
                INNER JOIN Barangay as brgy
                on brgynew.barangayID = brgy.ID
                INNER JOIN City as city
                on brgy.CityID = city.ID
                INNER JOIN reference_dates refDates
                on brgynew.refDateID = refDates.ID 
                GROUP BY city.CityName";
        //$footerQuery = "SELECT Province, SUM(TOTAL_POSITIVE_CASES) as POSCASES, SUM(NEW_POSITIVE_CASES) as NEWPOS, SUM(TOTAL_CURRENT_POSITIVE) as ACTIVE,SUM(TOTAL_RECOVERED) as RECOVERED,  SUM(TOTAL_SUSPECT) as PUI,SUM(TOTAL_PROBABLE) as PUM, SUM(TOTAL_DECEASED) as DECEASED FROM ALL_TOTAL";
        $footerQuery = "SELECT city.CityName, SUM(brgynew.total_positive_cases), SUM(brgynew.new_positive_case), SUM(brgynew.current_positive_case), SUM(brgynew.current_recovered), SUM(casesN.current_suspect_PUI), SUM(casesN.current_probable_PUI), SUM(brgynew.current_deceased)
            FROM barangay_history_new as brgynew
                INNER JOIN New_Cases as casesN
                on brgynew.ID = casesN.BarangayHistID
                INNER JOIN Barangay as brgy
                on brgynew.barangayID = brgy.ID
                INNER JOIN City as city
                on brgy.CityID = city.ID
                INNER JOIN reference_dates refDates
                on brgynew.refDateID = refDates.ID
                WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = (SELECT max(ref_date) from reference_dates))";
    }else{
        $header = ["BARANGAY","TOTAL CASES","NEW CASES","ACTIVE CASES","RECOVERED","SUSPECT","PROBABLE","DECEASED"];
        //$bodyQuery =  "SELECT barangay, TOTAL_POSITIVE_CASES, NEW_CASES, ACTIVE_CASES, TOTAL_RECOVERED, TOTAL_SUSPECT, TOTAL_PROBABLE, TOTAL_DECEASED     FROM " .$brgyname."_BRGY_DATA WHERE NOT (NEW_CASES = 0 AND ACTIVE_CASES = 0 AND TOTAL_POSITIVE_CASES = 0 AND TOTAL_DECEASED = 0 AND TOTAL_RECOVERED = 0 AND TOTAL_SUSPECT = 0 AND TOTAL_PROBABLE = 0) ORDER BY barangay REGEXP '^[^a-zA-A]' ASC";
        $bodyQuery =  "SELECT brgy.BarangayName, SUM(brgynew.total_positive_cases), SUM(brgynew.new_positive_case), SUM(brgynew.current_positive_case), SUM(brgynew.current_recovered), SUM(casesN.current_suspect_PUI), SUM(casesN.current_probable_PUI), SUM(brgynew.current_deceased)
            FROM barangay_history_new as brgynew
                INNER JOIN New_Cases as casesN
                on brgynew.ID = casesN.BarangayHistID
                INNER JOIN Barangay as brgy
                on brgynew.barangayID = brgy.ID
                INNER JOIN City as city
                on brgy.CityID = city.ID
                INNER JOIN reference_dates refDates
                on brgynew.refDateID = refDates.ID 
                WHERE city.CityName = '" . $brgyname . "' and brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = (SELECT max(ref_date) from reference_dates)) 
                GROUP BY brgy.BarangayName 
                ORDER by brgy.BarangayName REGEXP '^[^a-zA-A]' ASC";
        //$footerQuery =  'SELECT barangay, SUM(TOTAL_POSITIVE_CASES) AS POSCASES, SUM(NEW_CASES) AS NEWPOS, SUM(ACTIVE_CASES) AS ACTIVE, SUM(TOTAL_RECOVERED) AS RECOVERED, SUM(TOTAL_SUSPECT) AS PUI, SUM(TOTAL_PROBABLE) AS PUM, SUM(TOTAL_DECEASED) AS DECEASED FROM ' .$brgyname.'_BRGY_DATA';
        $footerQuery =  "SELECT brgy.BarangayName, SUM(brgynew.total_positive_cases), SUM(brgynew.new_positive_case), SUM(brgynew.current_positive_case), SUM(brgynew.current_recovered), SUM(casesN.current_suspect_PUI), SUM(casesN.current_probable_PUI), SUM(brgynew.current_deceased)
            FROM barangay_history_new as brgynew
                INNER JOIN New_Cases as casesN
                on brgynew.ID = casesN.BarangayHistID
                INNER JOIN Barangay as brgy
                on brgynew.barangayID = brgy.ID
                INNER JOIN City as city
                on brgy.CityID = city.ID
                INNER JOIN reference_dates refDates
                on brgynew.refDateID = refDates.ID 
                WHERE city.CityName = '" . $brgyname . "' and brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = (SELECT max(ref_date) from reference_dates))";
    }
    
    // query database
    $bodyData = mysqli_query($con, $bodyQuery);
    $footerData = mysqli_query($con, $footerQuery);
    if($bodyData){
        // put data into lists
        foreach ($bodyData as $keyrow => $row) {
            // body data
            $rowData = array();
            foreach ($row as $keycell => $cell) {
                array_push($rowData,$cell);
            }
            array_push($body, $rowData);
        }
    }
    if($footerData){
        foreach ($footerData as $keyrow => $row) {
            // footer data
            $rowData = array();
            foreach ($row as $keycell => $cell) {
                array_push($rowData, $cell);
            }
            array_push($footer, $rowData);
        }
    }
    
    
    $data = ["HEADER" => $header, "BODY" => $body, "FOOTER" => $footer];
    
    echo json_encode($data);
}
