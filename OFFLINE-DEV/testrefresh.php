<?php
  include 'phpcore/connection.php';
  $testingthis = $_GET['location'];
  $testget = str_replace("%20","",$testingthis);
  $testget = str_replace(" ","",$testingthis);
	
	
	$msql =  "SELECT 
        barangay,
        TOTAL_POSITIVE_CASES,
        NEW_CASES,
        ACTIVE_CASES,
        TOTAL_RECOVERED,
        TOTAL_SUSPECT,
        TOTAL_PROBABLE,
        TOTAL_DECEASED 
        FROM 
        " .$testget."_BRGY_DATA WHERE NOT (NEW_CASES = 0 AND ACTIVE_CASES = 0 AND TOTAL_POSITIVE_CASES = 0 AND TOTAL_DECEASED = 0 AND TOTAL_RECOVERED = 0 AND TOTAL_SUSPECT = 0 AND TOTAL_PROBABLE = 0) ORDER BY barangay REGEXP '^[^a-zA-A]' ASC";
    $msql2 = "SELECT 
        barangay,
        TOTAL_POSITIVE_CASES,
        NEW_CASES,
        ACTIVE_CASES,
        TOTAL_RECOVERED,
        TOTAL_SUSPECT,
        TOTAL_PROBABLE,
        TOTAL_DECEASED
        FROM 
        " .$testget. "_BRGY_DATA WHERE NOT (NEW_CASES = 0 AND ACTIVE_CASES = 0 AND TOTAL_POSITIVE_CASES = 0 AND TOTAL_DECEASED = 0 AND TOTAL_RECOVERED = 0 AND TOTAL_SUSPECT = 0 AND TOTAL_PROBABLE = 0) ORDER BY barangay REGEXP '^[^a-zA-A]' ASC";
        
        
	if($testget == 'LAGUNA')
	{
		$msql = "SELECT Province, TOTAL_POSITIVE_CASES, NEW_POSITIVE_CASES, TOTAL_CURRENT_POSITIVE, TOTAL_RECOVERED, TOTAL_SUSPECT, TOTAL_PROBABLE, TOTAL_DECEASED FROM ALL_TOTAL";
		$msql2 = "SELECT Province, TOTAL_POSITIVE_CASES, NEW_POSITIVE_CASES, TOTAL_CURRENT_POSITIVE, TOTAL_RECOVERED, TOTAL_SUSPECT, TOTAL_PROBABLE, TOTAL_DECEASED FROM ALL_TOTAL";
	}
	
	

?>
                <?php
                
                    if($testget == 'LAGUNA'){
                       include 'LdLaguna.php';
                    }
                    else
                    {
                       include 'LdBarangay.php';
                    }

                     ?>
                
                

