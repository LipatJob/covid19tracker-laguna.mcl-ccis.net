<?php

    include 'phpcore/connection.php';
    $location = $_GET['location'];
    
    $dbCity = str_replace("%20","",$location);
    $dbCity = str_replace(" ","",$location);
    
    /*
    if ($dbCity == 'LAGUNA') {
        //$dbCity = 'ALL';
        $dbCity = '';
    }
    */
    
    $query = "SELECT SUM(brgynew.NEW_POSITIVE_CASE) as NEWPOS, SUM(brgynew.total_positive_cases) as CURRENTPOS, SUM(brgynew.current_deceased) as DECEASED, SUM(brgynew.current_recovered) as RECOVERED, SUM(brgynew.total_positive_cases) as POSCASES, SUM(cases.current_suspect_PUI) as PUM, SUM(cases.current_probable_PUI) as PUI  FROM barangay_history_new as brgynew
	INNER JOIN New_Cases as cases
    on brgynew.ID = cases.BarangayHistID
    INNER JOIN Barangay as brgy
    on brgynew.barangayID = brgy.ID
    INNER JOIN City as city
    on brgy.CityID = city.ID
    WHERE brgynew.refDateID = (SELECT ID FROM reference_dates where ref_date = (SELECT max(ref_date) from reference_dates))";
    
    if ($dbCity != 'LAGUNA') {
        $query = $query . " AND city.CityName = '" . $dbCity . "'";
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
?>


        <div class="parent-container-horizontal">


            <div class="col-lg-2 col-md-6 col-sm-12">
            <!-- small card -->
            <div class="small-box" style="background-color: #1988C8;  color: white;">
              <div class="inner">
                <strong><h1><?php echo $POSCASES; ?></sup></h1></strong>

                <p>TOTAL CASES</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>

            
            <div class="col-lg-2 col-md-6 col-sm-12">
            <!-- small card -->
            <div class="small-box" style="background-color: #2ABB9B !important; color: white !important;">
              <div class="inner">
                <h1><?php echo $RECOVERED ?></h1>

                <p>RECOVERED</p>
              </div>
              <div class="icon">
                <i class="fa fa-hand-holding-heart"></i>
              </div>
            </div>
          </div>

            
           <div class="col-lg-2 col-md-6 col-sm-12">
            <!-- small card -->
            <div class="small-box" style="background-color: #008080 !important; color: white !important;">
              <div class="inner">
                <strong><h1><?php echo $CURRENTPOS; ?></sup></h1></strong>

            <p>ACTIVE CASES</p>
              </div>
              <div class="icon">
                <i class="fa fa-hospital-user"></i>
              </div>
            </div>
          </div>
          
            <div class="col-lg-2 col-md-6 col-sm-12">
            <!-- small card -->
            <div class="small-box" style="background-color: #FF712D; color: white;">
              <div class="inner">
                <strong><h1><?php echo $PUI?></h1></strong>

            <p>PUI</p>
              </div>
              <div class="icon">
                <i class="fa fa-search"></i>
              </div>
            </div>
          </div>
          
          <div class="col-lg-2 col-md-6 col-sm-12">
            
            <div class="small-box" style="background-color: #FFCC00; color: white;">
              <div class="inner">
                <strong><h1><?php echo $PUM ?></h1></strong>

            <p>PUM</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-injured"></i>
              </div>
            </div>
          </div>
           

            <div class="col-lg-2 col-md-6 col-sm-12">
            <!-- small card -->
            <div class="small-box" style="background-color: #7d7d7d;color: white;">
              <div class="inner">
                <h1><?php echo $DECEASED; ?></h1>

                <p>DECEASED</p>
              </div>
              <div class="icon">
                <i class="fa fa-skull-crossbones"></i>
              </div>
            </div>
          </div>


        </div>
