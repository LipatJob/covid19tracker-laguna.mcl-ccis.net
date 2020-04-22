<?php

//echo json_encode(getCasesPerCityMunicipality("BINAN"));

/**
* This function returns the SQL connection
* @return SQLConnection: SQL connection 
*/ 
function getConnection(){
    include '../phpcore/connection.php';
    return $con;
}

/**
* This function returns the values return for the summary part of the website
* @param $string $location: The desired location
* @return array: The data for summary.
*/
function getSummary($location){
    $con = getConnection();
	$testingthisone = 0;
	$testingthisone2 = 0;
	$checkcount2 = 0;
	$checkcount = 0;
	$checkcount3 = 0;
	$PUIcount = 0;
	$PUMcount = 0;
	$Activecount = 0;
    $dbCity = $location;
    $dbCity = str_replace("%20","",$location);
    if ($dbCity == 'LAGUNA') {
        $dbCity = 'ALL';
        //$dbCity = '';
    }
    
    $query = "SELECT SUM(brgynew.NEW_POSITIVE_CASE) as NEWPOS, SUM(brgynew.current_positive_case) as CURRENTPOS, SUM(brgynew.current_deceased) as DECEASED, SUM(brgynew.current_recovered) as RECOVERED, SUM(brgynew.total_positive_cases) as POSCASES, SUM(cases.current_suspect_PUI) as PUM, SUM(cases.current_probable_PUI) as PUI  FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = (SELECT max(ref_date) from reference_dates))";
    
    if ($dbCity != 'ALL') {
        $query .= " AND city.CityName = '" . $dbCity . "'";
    }
    
    //$resultCount = mysqli_query($con,"SELECT SUM(NEW_POSITIVE_CASES) as NEWPOS, SUM(TOTAL_CURRENT_POSITIVE) as CURRENTPOS, SUM(TOTAL_DECEASED) as DECEASED, SUM(TOTAL_RECOVERED) as RECOVERED, SUM(TOTAL_POSITIVE_CASES) as POSCASES, SUM(TOTAL_PUM) as PUM, SUM(TOTAL_PUI) as PUI FROM ". $dbCity ."_TOTAL");
    $resultCount = mysqli_query($con, $query);
    
    while($extract = mysqli_fetch_array($resultCount)){
        $NEWPOS = $extract['NEWPOS'];
        $CURRENTPOS = $extract['CURRENTPOS'];
        $DECEASED = $extract['DECEASED'];
        $RECOVERED = $extract['RECOVERED'];
        $POSCASES = $extract['POSCASES'];
        $PUM = $extract['PUM'];
        $PUI = $extract['PUI'];
    }

    $recoveredDeceased[0] = $RECOVERED;
    $recoveredDeceased[1] = $DECEASED;
	
	
	date_default_timezone_set("Asia/Singapore");
	$date = date('Y-m-d');
	$date = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$mypastdate = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$days_ago = $date;
	$testbool = "true";
	
	while($testbool == "true")
	{
	
    $query5 = "SELECT SUM(brgynew.NEW_POSITIVE_CASE) as NEWPOS FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$days_ago')";
    
    if ($dbCity != 'ALL') {
        $query5 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount5 = mysqli_query($con, $query5);
	 
	 while($extract5 = mysqli_fetch_array($resultCount5)){
		 if($POSCASES != 0){
      $checkcount = $extract5['NEWPOS'];
		 }else
		{
			$testbool = "false";
		}
    }
	
	if($checkcount == 0)
	{
		$days_ago = date('Y-m-d', strtotime('-1 day', strtotime($days_ago)));
	}
	else
	{
		if($days_ago == $mypastdate)
		{
			$checkcount = 0;
			$days_ago = $date;
		}
		$testbool = "false";
	}
	
	}
	
	$days_ago_PUM = $date;
	$past_days2 = date('Y-m-d', strtotime('-1 day', strtotime($days_ago_PUM)));
	$PUMcount2 = 0;
	
	
	
	
    $query5 = "SELECT SUM(cases.current_suspect_PUI) as PUM FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$days_ago_PUM')";
    
    if ($dbCity != 'ALL') {
        $query5 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount5 = mysqli_query($con, $query5);
	 
	 while($extract5 = mysqli_fetch_array($resultCount5)){
      $PUMcount = $extract5['PUM'];
    }
	
	$query5 = "SELECT SUM(cases.current_suspect_PUI) as PUM FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$past_days2')";
    
    if ($dbCity != 'ALL') {
        $query5 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount5 = mysqli_query($con, $query5);
	 
	 while($extract5 = mysqli_fetch_array($resultCount5)){
      $PUMcount2 = $extract5['PUM'];
    }
	
	
	$PUMcount = $PUMcount - $PUMcount2;


	$days_ago_Active = $date;
	$days_ago_Active2 = date('Y-m-d', strtotime('-1 day', strtotime($days_ago_Active)));
	$Activecount2 = 0;
	
	
	
	
    $query5 = "SELECT SUM(brgynew.current_positive_case) as CURRENTPOS FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$days_ago_Active')";
    
    if ($dbCity != 'ALL') {
        $query5 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount5 = mysqli_query($con, $query5);
	 
	 while($extract5 = mysqli_fetch_array($resultCount5)){
      $Activecount = $extract5['CURRENTPOS'];
    }
	
	$query5 = "SELECT SUM(brgynew.current_positive_case) as CURRENTPOS FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$days_ago_Active2')";
    
    if ($dbCity != 'ALL') {
        $query5 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount5 = mysqli_query($con, $query5);
	 
	 while($extract5 = mysqli_fetch_array($resultCount5)){
      $Activecount2 = $extract5['CURRENTPOS'];
    }
	
	
	$Activecount = $Activecount - $Activecount2;



	
	$days_ago_PUI = $date;
	$past_days3 = date('Y-m-d', strtotime('-1 day', strtotime($days_ago_PUI)));
	$testbool = "true";
	$PUIcount2 = 0;
	
	
	
	
    $query5 = "SELECT SUM(cases.current_probable_PUI) as PUI FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$days_ago_PUI')";
    
    if ($dbCity != 'ALL') {
        $query5 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount5 = mysqli_query($con, $query5);
	 
	 while($extract5 = mysqli_fetch_array($resultCount5)){
      $PUIcount = $extract5['PUI'];

    }
	
	
	$query5 = "SELECT SUM(cases.current_probable_PUI) as PUI FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$past_days3')";
    
    if ($dbCity != 'ALL') {
        $query5 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount5 = mysqli_query($con, $query5);
	 
	 while($extract5 = mysqli_fetch_array($resultCount5)){
      $PUIcount2 = $extract5['PUI'];

    }
	
	$PUIcount = $PUIcount - $PUIcount2;
	
	
	
	
	
	
	
	
	$days_ago2 = $date;
	$past_days = date('Y-m-d', strtotime('-1 day', strtotime($days_ago2)));
	$testbool = "true";
	
	while($testbool == "true")
	{
	
    $query6 = "SELECT SUM(brgynew.current_deceased) as DECEASED FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$days_ago2')";
    
    if ($dbCity != 'ALL') {
        $query6 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount6 = mysqli_query($con, $query6);
	 
	 while($extract6 = mysqli_fetch_array($resultCount6)){
		 if($DECEASED != 0)
		 {
      $checkcount2 = $extract6['DECEASED'];
		 }
	else
	{
		$testbool = "false";
	}
    }
	
	$query7 = "SELECT SUM(brgynew.current_deceased) as DECEASED2 FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$past_days')";
    
    if ($dbCity != 'ALL') {
        $query7 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount7 = mysqli_query($con, $query7);
	 
	 while($extract7 = mysqli_fetch_array($resultCount7)){
		if($DECEASED != 0)
		{
      $testingthisone = $extract7['DECEASED2'];
		}
	else
	{
		$testbool = "false";
	}
    }
	$minusthis = 0;
	$minusthis = $checkcount2 - $testingthisone;
	?>
	<!-- if > 0 -->
	<?php
	
	if($minusthis == 0)
	{
		$past_days = date('Y-m-d', strtotime('-1 day', strtotime($past_days)));
	}
	else
	{
		
		$days_ago2 = $past_days;
		
		if($date != $days_ago2)
		{
			$days_ago2 = date('Y-m-d', strtotime('+1 day', strtotime($days_ago2)));
		}
		if($days_ago2 == $mypastdate)
		{
			$minusthis = 0;
			$days_ago2 = $date;
		}
		
		$testbool = "false";
	}
	
	}
	
	?>
	<!-- recover count -->
	<?php
	
	$days_ago3 = $date;
	$past_days = date('Y-m-d', strtotime('-1 day', strtotime($days_ago3)));
	$testbool = "true";
	
	
	
	
    $query6 = "SELECT SUM(brgynew.current_recovered) as RECOVERED FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$days_ago3')";
    
    if ($dbCity != 'ALL') {
        $query6 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount6 = mysqli_query($con, $query6);
	 
	 while($extract6 = mysqli_fetch_array($resultCount6)){
		if($RECOVERED != 0)
		{
      $checkcount3 = $extract6['RECOVERED'];
		}else
		{
			$testbool = "false";
		}
    }
	
	$query7 = "SELECT SUM(brgynew.current_recovered) as RECOVERED FROM barangay_history_new as brgynew
    INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = '$past_days')";
    
    if ($dbCity != 'ALL') {
        $query7 .= " AND city.CityName = '" . $dbCity . "'";
    }
	
	 $resultCount7 = mysqli_query($con, $query7);
	 
	 while($extract7 = mysqli_fetch_array($resultCount7)){
		 if($RECOVERED !=0)
		 {
      $testingthisone2 = $extract7['RECOVERED'];
		 }
    }
	$minusthis2 = 0;
	$minusthis2 = $checkcount3 - $testingthisone2;
	
	
	
	
	
	
	$outputconfirmed=date('Y-m-d', strtotime('+1 day', strtotime($days_ago)));
	$outputPUM=date('Y-m-d', strtotime('+1 day', strtotime($days_ago_PUM)));
	$outputPUI=date('Y-m-d', strtotime('+1 day', strtotime($days_ago_PUI)));
	$outputdeceased=date('Y-m-d', strtotime('+1 day', strtotime($days_ago2)));
	$outputrecovered=date('Y-m-d', strtotime('+1 day', strtotime($days_ago3)));
	
	$outputconfirmed = date('M. d', strtotime($outputconfirmed));
	$outputdeceased = date('M. d', strtotime($outputdeceased));
	$outputrecovered = date('M. d', strtotime($outputrecovered));
    
	

    return [
        "ConfirmedCases" => $POSCASES,
        "ActiveCases" => $CURRENTPOS,
        "Deceased" => $DECEASED,
        "Recovered" => $RECOVERED,
        "Suspect" => $PUM,
        "Probable" => $PUI,
        "RecoveredDeceased" => $recoveredDeceased,
		"CountDays" => $days_ago,
		"DeceasedDate" => $days_ago2,
		"DeceasedCheck" => $minusthis,
		"RecoverCheck" => $minusthis2,
		"RecoverDate" => $days_ago3,
		"TotalConfirmed" => $checkcount,
		"OutputConfirmed" => $outputconfirmed,
		"OutputDeceased" => $outputdeceased,
		"OutputRecovered" => $outputrecovered,
		"PUMDate" => $days_ago_PUM,
		"PUIDate" => $days_ago_PUI,
		"PUICheck" => $PUIcount,
		"PUMCheck" => $PUMcount,
		"OutputPUM" => $outputPUM,
		"OutputPUI" => $outputPUI,
		"ThisCity" => $dbCity,
		"ActiveCheck" => $Activecount
		
    ];
}

function getPUIPerDate($location){
    $con = getConnection();
    $location = str_replace("%20", " ",$location);
    
    $result = mysqli_query($con,"SELECT MAX(reference_date) AS fdate from barangay_history");
    $row = mysqli_fetch_assoc($result);
    $i = 0;
    $dates = array();
    $pui = array();
    $pum = array();
    //$string = "SELECT reference_date, sum(current_pum) AS PUM,sum(current_pui) AS PUI from barangay_history WHERE reference_date >= '2020-03-20' ";

    
    if($location != "LAGUNA")
    {
        $string = "SELECT refDates.ref_date as reference_date, 0 as PROBABLE, 0 as SUSPECT, sum(casesO.current_PUI) as TOTALPUI FROM barangay_history_new brgynew
            INNER JOIN Old_Cases casesO
            ON brgynew.ID = casesO.BarangayHistID
            INNER JOIN reference_dates refDates
            ON brgynew.refDateID = refDates.ID
            INNER JOIN Barangay brgy
            ON brgynew.barangayID = brgy.ID
            INNER JOIN City city
            on brgy.CityID = city.ID
            WHERE city.CityName = '" . $location . "' AND refDates.ref_date >= '2020-03-25' GROUP BY reference_date
            
        UNION ALL
        SELECT refDates.ref_date as reference_date, sum(casesN.current_probable_PUI) as PROBABLE, sum(casesN.current_suspect_PUI) as SUSPECT, sum(casesN.total_PUI) as TOTALPUI FROM barangay_history_new brgynew
            INNER JOIN New_Cases casesN
            ON brgynew.ID = casesN.BarangayHistID
            INNER JOIN reference_dates refDates
            ON brgynew.refDateID = refDates.ID
            INNER JOIN Barangay brgy
            ON brgynew.barangayID = brgy.ID
            INNER JOIN City city
            on brgy.CityID = city.ID
            WHERE city.CityName = '" . $location . "' AND refDates.ref_date >= '2020-03-25' GROUP BY reference_date";

        //$string.="AND city_municipality = '$location' GROUP BY reference_date";
        //$string.="WHERE city.CityName = '" . $location . "' GROUP BY refDates.ref_date";
    }
    else
    {
        //$string.=" GROUP BY reference_date";
        $string = "SELECT refDates.ref_date as reference_date, 0 as PROBABLE, 0 as SUSPECT, sum(casesO.current_PUI) as TOTALPUI FROM barangay_history_new brgynew
            INNER JOIN Old_Cases casesO
            ON brgynew.ID = casesO.BarangayHistID
            INNER JOIN reference_dates refDates
            ON brgynew.refDateID = refDates.ID
            INNER JOIN Barangay brgy
            ON brgynew.barangayID = brgy.ID
            INNER JOIN City city
            on brgy.CityID = city.ID 
            WHERE refDates.ref_date >= '2020-03-25'
            GROUP BY refDates.ref_date
        UNION ALL
        SELECT refDates.ref_date as reference_date, sum(casesN.current_probable_PUI) as PROBABLE, sum(casesN.current_suspect_PUI) as SUSPECT, sum(casesN.total_PUI) as TOTALPUI FROM barangay_history_new brgynew
            INNER JOIN New_Cases casesN
            ON brgynew.ID = casesN.BarangayHistID
            INNER JOIN reference_dates refDates
            ON brgynew.refDateID = refDates.ID
            INNER JOIN Barangay brgy
            ON brgynew.barangayID = brgy.ID
            INNER JOIN City city
            on brgy.CityID = city.ID 
            WHERE refDates.ref_date >= '2020-03-25'
            GROUP BY refDates.ref_date ORDER BY reference_date";
    }

    $result2 = mysqli_query($con,$string);
    while($extract = mysqli_fetch_array($result2)){
        $dates[$i] = str_replace("2020-", "", $extract['reference_date']);
        //$pui[$i] = $extract['PUI'];
        $probable[$i] = $extract['PROBABLE'];
        $suspect[$i] = $extract['SUSPECT'];
        $totalCases[$i] = $extract['TOTALPUI'];
        $i++;
    }
    return [
        "Dates" => $dates,
        //"PUI" => $pui,
        "Probable" => $probable,
        "Suspect" => $suspect,
        "Total" => $totalCases
    ];
}

function getCasesPerDate($location){
    $con = getConnection();
    $location = str_replace("%20", " ",$location);
    
    $result = mysqli_query($con,"SELECT MAX(reference_date) AS fdate from barangay_history");
    $row = mysqli_fetch_assoc($result);
    $i = 0;
    
    $string = "SELECT reference_date, sum(current_positive_case) AS current,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_recovered) AS CURRENT_RECOVERED from barangay_history WHERE reference_date >= '2020-03-25' ";
    
    if($location != "LAGUNA")
    {
        $string.="AND city_municipality = '$location' GROUP BY reference_date";
    }
    else
    {
        $string.=" GROUP BY reference_date";
    }
    
    $result2 = mysqli_query($con,$string);
    while($extract = mysqli_fetch_array($result2)){
        $dates[$i] = str_replace("2020-", "", $extract['reference_date']);
        $cases[$i] = intval($extract['TOTAL_POSITIVE_CASES']);
        $current[$i] = intval($extract['current']);
        $recovered[$i] = intval($extract['CURRENT_RECOVERED']);
        $i++;
    }
    
    return [
        "Dates" => $dates,
        "TotalPositiveCases" => $cases,
        "CurrentPositiveCases" => $current,
        "CurrentRecovered" => $recovered
    ];
    
}

function getSummaryPerCityMunicipalityTable($brgyname){
    $con = getConnection();
    
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
    return $data;
}

function getSummaryPerCityMunicipalityChart($location){
    $con = getConnection();
    $header = "";
    
    $cases = array();
    $recovered = array();
    $deceased = array();
    $locals = array();
    $i = 0;
    $max1 = 0;
    $max2 = 0;
    $max3 = 0;
    $totalMax = 0;
    
    //$cities = {};
    if($location != "LAGUNA")
    {
        $header = "TOTAL CASES FOR $location";
        
        $string = "SELECT barangay,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(current_pui) AS TOTAL_PUI, sum(current_pum) AS TOTAL_PUM, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history where city_municipality='$location' AND reference_date IN (SELECT MAX(reference_date) from barangay_history where city_municipality='$location') AND NOT (total_positive_cases = 0 AND current_deceased = 0 AND current_recovered = 0) GROUP BY barangay";
        $result1 = mysqli_query($con,$string);
        while($extract = mysqli_fetch_array($result1)){
            
            $locals[$i] = $extract['barangay'];
            $cases[$i] = $extract['TOTAL_POSITIVE_CASES'];
            $deceased[$i] = $extract['TOTAL_DECEASED'];
            $recovered[$i] = $extract['TOTAL_RECOVERED'];
            $i++;
        }
    }
    else
    {
        $header = "TOTAL CASES PER CITY/MUNICIPALITY";
        $string = "SELECT city_municipality AS city,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(current_pui) AS TOTAL_PUI, sum(current_pum) AS TOTAL_PUM, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history where reference_date IN (SELECT MAX(reference_date) from barangay_history) GROUP BY city_municipality";
        $result1 = mysqli_query($con,$string);
        
        while($extract = mysqli_fetch_array($result1)){
            $locals[$i] = $extract['city'];
            $cases[$i] = $extract['TOTAL_POSITIVE_CASES'];
            $deceased[$i] = $extract['TOTAL_DECEASED'];
            $recovered[$i] = $extract['TOTAL_RECOVERED'];
            $i++;
        }    
        
        $max1 = max($cases);
        $max2 = max($deceased);
        $max3 = max($recovered);
        $totalMax = max($max1,$max2,$max3);
        
        if($totalMax%5==0)
        {
            $totalMax = $totalMax + 5;
        }
        else
        {
            $totalMax = (5 - $totalMax%5) + $totalMax; 
        }
    }
    
    return ["Locals" => array_values($locals) ,"TotalPositiveCases" => array_values($cases), "Deceased" => array_values($deceased), "Recovered" => array_values($recovered),
    "CasesMax" => $max1, "DeceasedMax" => $max2, "RecoveredMax" => $max3, "TotalMax" => $totalMax, "Header" => $header];
    
}

function getCasesByGender($location){
    $con = getConnection();
    $strfem = "SELECT COUNT(gender) AS fem FROM individual_cases WHERE gender =  'F'";
    $strmale = "SELECT COUNT(gender) AS male FROM individual_cases WHERE gender =  'M'";
    
    if($location!='LAGUNA')
    {
        $strfem .=" AND barangay = '$location'";
        $strmale .=" AND barangay = '$location'";
    }
    
    
    $result = mysqli_query($con,$strfem);
    $row = mysqli_fetch_assoc($result);
    $fem = $row['fem'];
    
    $result = mysqli_query($con,$strmale);
    $row = mysqli_fetch_assoc($result);
    $male = $row['male'];
    
    $genSum = $male + $fem;
    
    if($male == 0)
    $permale = 0;
    else
    $permale = number_format($male/$genSum*100, 2, '.', '');
    if($fem==0)
    $perfem = 0;
    else
    $perfem = number_format($fem/$genSum*100, 2, '.', '');
    
    return ["GenderData" => [$male, $fem] , "MalePercentage" => $permale, "FemalePercentage" => $perfem];
}

function getCasesByAgeGroup($location){
    $con = getConnection();
    
    
    
    $strage2 = "SELECT COUNT(age) AS age, case_status FROM individual_cases WHERE AGE >= 80 ";
    $strage3 = "SELECT COUNT(city_municipality) AS age, case_status FROM individual_cases WHERE AGE = -1 ";
    
    
    if($location!='LAGUNA')
    {
        $strage2 .="AND barangay = '$location' GROUP BY case_status";
        $strage3 .="AND barangay = '$location' GROUP BY case_status";
    }
    else
    {
        $strage2 .="GROUP BY case_status";
        $strage3 .="GROUP BY case_status";
    }
    
    
    $age = [0,0,0,0,0,0,0,0,0,0];
    $current = [0,0,0,0,0,0,0,0,0,0];
    $recovered = [0,0,0,0,0,0,0,0,0,0];
    $deceased = [0,0,0,0,0,0,0,0,0,0];
    $total = 0;
    $perCur = [0,0,0,0,0,0,0,0,0,0];
    $perDec = [0,0,0,0,0,0,0,0,0,0];
    $perRec = [0,0,0,0,0,0,0,0,0,0] ;
    
    $start = 0;
    $end = 9;
    
    for($i=0;$i<9;$i++){
        
        if($i!=8)
        {
            $strage1 = "SELECT COUNT(age) AS age, case_status FROM individual_cases WHERE AGE BETWEEN '$start' AND '$end' ";
            if($location!="LAGUNA")
            $strage1 .= "AND barangay = '$location' GROUP BY case_status";
            else
            $strage1 .= "GROUP BY case_status";
            
            $result = mysqli_query($con,$strage1);
            $start = $start + 10;
            $end = $end + 10;
        }
        else
        {
            $result = mysqli_query($con,$strage2);
        }
        
        while($extract = mysqli_fetch_array($result)){
            
            if($extract['case_status']=='CONFIRMED')
            $current[$i] = $extract['age'];     
            if($extract['case_status']=='DECEASED')
            $deceased[$i] = $extract['age'];
            if($extract['case_status']=='RECOVERED')    
            $recovered[$i] = $extract['age'];
            
            $age[$i] = $deceased[$i] + $recovered[$i] + $current[$i];
            $total = $total + $age[$i];
        }
        
    }
    $result = mysqli_query($con,$strage3);
    while($extract = mysqli_fetch_array($result)){
        
        if($extract['case_status']=='CONFIRMED')
        $current[9] = $extract['age'];     
        if($extract['case_status']=='DECEASED')
        $deceased[9] = $extract['age'];
        if($extract['case_status']=='RECOVERED')    
        $recovered[9] = $extract['age'];
        
        $age[9] = $deceased[$i] + $recovered[$i] + $current[$i];
    }
    
    
    for($x = 0; $x<10; $x++)
    {
        if($current[$x] == 0)
        $perCur[$x] = 0;
        else
        {
            $perCur[$x] = number_format($current[$x]/$age[$x]*100, 2, '.', '');
        }
        
        if($recovered[$x] == 0)
        $perRec[$x] = 0;
        else
        $perRec[$x] = number_format($recovered[$x]/$age[$x]*100, 2, '.', '');
        
        if($deceased[$x] == 0)
        $perDec[$x] = 0;
        else
        $perDec[$x] = number_format($deceased[$x]/$age[$x]*100, 2, '.', '');
        
    }
    
    return [
        "RecoveredPercentage" => $perRec,
        "DeceasedPercentage" => $perDec,
        "CurrentPercentage" => $perCur,
        "Total" => $age,
    ];
}

function getRecoveredPerDate($location){
    $con = getConnection();
    $location = str_replace("%20", " ",$location);
    
    $result = mysqli_query($con,"SELECT MAX(reference_date) AS fdate from barangay_history");
    $row = mysqli_fetch_assoc($result);
    $i = 0;
    
    $string = "SELECT reference_date, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history WHERE reference_date >= '2020-03-31' ";
    
    if($location != "LAGUNA")
    {
        $string.="AND city_municipality = '$location' GROUP BY reference_date";
    }
    else
    {
        $string.=" GROUP BY reference_date";
    }
    
    $result2 = mysqli_query($con,$string);
    while($extract = mysqli_fetch_array($result2)){
        $dates[$i] = str_replace("2020-", "", $extract['reference_date']);
        $recovered[$i] = intval($extract['TOTAL_RECOVERED']);
        $i++;
    }
    $specificRecovered = [];
    for($i = 1; $i < sizeof($recovered); $i++){
        $current = 0;

        $current = $recovered[$i] - $recovered[$i - 1];

        
        if($current < 0){
            array_push($specificRecovered, 0);
        }else{
            array_push($specificRecovered, $current);
        }
    }

    array_shift($dates);

    return [
        "Dates" => $dates,
        "Recovered" => $specificRecovered,
        "CumulativeRecovered" => $recovered
    ];
}

function getDeceasedPerDate($location){
    $con = getConnection();
    $location = str_replace("%20", " ",$location);
    
    $result = mysqli_query($con,"SELECT MAX(reference_date) AS fdate from barangay_history");
    $row = mysqli_fetch_assoc($result);
    $i = 0;
    
    $string = "SELECT reference_date, sum(current_deceased) AS TOTAL_DECEASED from barangay_history WHERE reference_date >= '2020-03-31' ";

    if($location != "LAGUNA")
    {
        $string.="AND city_municipality = '$location' GROUP BY reference_date";
    }
    else
    {
        $string.=" GROUP BY reference_date";
    }
    
    $result2 = mysqli_query($con,$string);
    while($extract = mysqli_fetch_array($result2)){
        $dates[$i] = str_replace("2020-", "", $extract['reference_date']);
        $deceased[$i] = intval($extract['TOTAL_DECEASED']);
        $i++;
    }
    
    $specificDeceased = [];
    for($i = 1; $i < sizeof($deceased); $i++){
        $current = 0;
        
        $current = $deceased[$i] - $deceased[$i - 1];

        if($current < 0){
            array_push($specificDeceased, 0);
        }else{
            array_push($specificDeceased, $current);
        }
    }

    array_shift($dates);
    
    return [
        "Dates" => $dates,
        "Deceased" => $specificDeceased,
        "CumulativeDeceased" => $deceased
    ];
    
}


function getCityMunicipalities(){
    $con = getConnection();
    $storethis = "";
    $query1 = "SELECT CityName FROM City ORDER BY CityName ASC";
    $result1 = mysqli_query($con,$query1);
    $cityNames = ["LAGUNA"];

    while($rows3 = mysqli_fetch_array($result1))
    {
        if($storethis!=$rows3['CityName'])
        {
            array_push($cityNames, $rows3['CityName']);
        }
    }
    echo json_encode($cityNames);
    return $cityNames;
    
}




















////////////////////////////////////////////////////

function getCasesPerCityMunicipality($location){
    $con = getConnection();
    $header = "";
    $cases = array();
    $recovered = array();
    $deceased = array();
    $locals = array();
    $i = 0;
    
    if($location != "LAGUNA")
    {
        $header = "TOTAL CASES FOR $location";
        
        $string = "SELECT barangay,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(current_pui) AS TOTAL_PUI, sum(current_pum) AS TOTAL_PUM, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history where city_municipality='$location' AND reference_date IN (SELECT MAX(reference_date) from barangay_history where city_municipality='$location') GROUP BY barangay";
        $result1 = mysqli_query($con,$string);
        while($extract = mysqli_fetch_array($result1)){
            
            $locals[$i] = $extract['barangay'];
            $cases[$i] = $extract['TOTAL_POSITIVE_CASES'];
            $deceased[$i] = $extract['TOTAL_DECEASED'];
            $recovered[$i] = $extract['TOTAL_RECOVERED'];
            $i++;
        }
    }
    else
    {
        $header = "TOTAL CASES PER CITY/MUNICIPALITY";
        $string = "SELECT city_municipality AS city,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(current_pui) AS TOTAL_PUI, sum(current_pum) AS TOTAL_PUM, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history where reference_date IN (SELECT MAX(reference_date) from barangay_history) GROUP BY city_municipality";
        $result1 = mysqli_query($con,$string);
        
        while($extract = mysqli_fetch_array($result1)){
            $locals[$i] = $extract['city'];
            $cases[$i] = $extract['TOTAL_POSITIVE_CASES'];
            $deceased[$i] = $extract['TOTAL_DECEASED'];
            $recovered[$i] = $extract['TOTAL_RECOVERED'];
            $i++;
        }    
        
        $max1 = max($cases);
        $max2 = max($deceased);
        $max3 = max($recovered);
        $totalMax = max($max1,$max2,$max3);
        
        if($totalMax%5==0)
        {
            $totalMax = $totalMax + 5;
        }
        else
        {
            $totalMax = (5 - $totalMax%5) + $totalMax; 
        }
    }
    
    return [
        "Header" => $header,
        "Cases" => $cases,
        "Recovered" => $recovered,
        "Deceased" => $deceased,
        "Locals" => $locals
    ];
    
    
    
}

function getIndividualCaseInformation($location){
    $con = getConnection();
    if ($location == 'LAGUNA') {
        $query1 = "SELECT * FROM individual_cases order by date_confirmed asc, barangay";
    } else {
        $query1 = "SELECT * FROM individual_cases where barangay = '$location' order by date_confirmed asc, barangay";
    }
    
    $result = mysqli_query($con, $query1);
    $data = [];
    foreach ($result as $keyrow => $row) {
        // body data
        $rowData = array();
        foreach ($row as $keycell => $cell) {
            array_push($rowData,$cell);
        }
        array_push($data, $rowData);
    }
    
    $genderData = [];
    $byAgeGroupData = [];
    $perLocaleData = [];
    
    return $data;
    
}

function getCurrentTrend ($location){
    $con = getConnection();
    $header = "";
    $cases = array();
    $recovered = array();
    $deceased = array();
    $locals = array();
    $i = 0;
    
    if($location != "LAGUNA")
    {
        //$header = "TOTAL CASES FOR $location";
        
        //$string = "SELECT barangay,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(current_pui) AS TOTAL_PUI, sum(current_pum) AS TOTAL_PUM, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history where city_municipality='$location' AND reference_date IN (SELECT MAX(reference_date) from barangay_history where city_municipality='$location') GROUP BY barangay";
        $string = "SELECT  refDates.ref_date as reference_date, 
		sum(brgynew.current_positive_case) as ACTIVECASES, 
		sum(brgynew.new_positive_case) as NEWCASES, 
        sum(brgynew.current_recovered) as NEWRECOVERED,
        sum(brgynew.current_deceased) as DECEASED
        FROM barangay_history_new brgynew
        INNER JOIN reference_dates refDates
        ON brgynew.refDateID = refDates.ID
        INNER JOIN Barangay brgy
        ON brgynew.barangayID = brgy.ID
        INNER JOIN City city
        on brgy.CityID = city.ID 
        WHERE refDates.ref_date >= '2020-03-24' and city.cityName = '" . $location . "'
        GROUP BY refDates.ref_date;";
    }
    else
    {
        $string = "SELECT  refDates.ref_date as reference_date, 
		sum(brgynew.current_positive_case) as ACTIVECASES, 
		sum(brgynew.new_positive_case) as NEWCASES, 
        sum(brgynew.current_recovered) as NEWRECOVERED,
        sum(brgynew.current_deceased) as DECEASED
        FROM barangay_history_new brgynew
        INNER JOIN reference_dates refDates
        ON brgynew.refDateID = refDates.ID
        INNER JOIN Barangay brgy
        ON brgynew.barangayID = brgy.ID
        INNER JOIN City city
        on brgy.CityID = city.ID 
        WHERE refDates.ref_date >= '2020-03-24' 
        GROUP BY refDates.ref_date";
    }

    $result1 = mysqli_query($con,$string);

    while($extract = mysqli_fetch_array($result1)) {
            
        $dates[$i] = str_replace("2020-", "", $extract['reference_date']);
        $activecases[$i] = $extract['ACTIVECASES'];
        $newcases[$i] = $extract['NEWCASES'];
        $recovered[$i] = $extract['NEWRECOVERED'];
        $deceased[$i] = $extract['DECEASED'];
        $i++;
    }

    for ($j = 1; $j < count($dates); $j++) {
        $recoveredPerDay[$j - 1] = $recovered[$j] - $recovered[$j - 1];
        $deceasedPerDay[$j - 1] = $deceased[$j] - $deceased[$j - 1];
    }

    for ($j = 0; $j < count($recoveredPerDay); $j++) {
        $totalRecoveryDeceased[$j] = $recoveredPerDay[$j] + $deceasedPerDay[$j];
    }

    if ($dates[0] < '03-25') {
        array_shift($dates);
        array_shift($activecases);
        array_shift($newcases);
        array_shift($recovered);
    }
    
    return [
        "dates" => $dates,
        "ActiveCases" => $activecases,
        "NewCases" => $newcases,
        "Recovered" => $recoveredPerDay,
        "Deceased"=> $deceasedPerDay,
        "SumRecoveredDeceased" => $totalRecoveryDeceased
    ];
    
    
}
