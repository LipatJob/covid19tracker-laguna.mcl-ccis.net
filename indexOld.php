<?php
include 'phpcore/connection.php';

$result1 = mysqli_query($con,"SELECT SUM(NEW_POSITIVE_CASES) as NEWPOS, SUM(TOTAL_CURRENT_POSITIVE) as CURRENTPOS, SUM(TOTAL_DECEASED) as DECEASED, SUM(TOTAL_RECOVERED) as RECOVERED, SUM(TOTAL_POSITIVE_CASES) as POSCASES, SUM(TOTAL_PUM) as PUM, SUM(TOTAL_PUI) as PUI FROM ALL_TOTAL");
while($extract = mysqli_fetch_array($result1)){
    $NEWPOS = $extract['NEWPOS'];
    $CURRENTPOS = $extract['CURRENTPOS'];
    $DECEASED = $extract['DECEASED'];
    $RECOVERED = $extract['RECOVERED'];
    $POSCASES = $extract['POSCASES'];
    $PUM = $extract['PUM'];
    $PUI = $extract['PUI'];
}

$result2 = mysqli_query($con,"SELECT SUM(current_positive_case) AND  reference_date IN (SELECT MAX(reference_date) from barangay_history) AS TOTAL_CASES from barangay_history");
while($extract2 = mysqli_fetch_array($result2)){
    $positive_current_case = $extract2['TOTAL_CASES'];
}

$query1 = "SELECT * FROM barangay_history order by reference_date";
$result1 = mysqli_query($con,$query1);
$result2 = mysqli_query($con,$query1);
while($rows2 = mysqli_fetch_array($result2))
{
    $rowsData2 = $rows2['reference_date'];
    break;
}
while($rows1 = mysqli_fetch_array($result1))
{
    $rowsData1 = $rows1['reference_date'];
}
$ref1 = $rowsData2;
$ref2 = $rowsData1;

$msql = "SELECT * FROM ALL_TOTAL";
//$msql2 = "SELECT SUM(`new_positive_case`) as sum1, SUM(`current_positive_case`) as sum2, SUM(`current_deceased`) as sum3, SUM(`current_recovered`) as sum4, SUM(`total_positive_cases`) as sum5, SUM(`current_pum`) as sum6, SUM(`current_pui`) as sum7 FROM `barangay_history`";
$msql2 = "SELECT SUM(`new_positive_case`) as sum1, SUM(`current_positive_case`) as sum2, SUM(`current_deceased`) as sum3, SUM(`current_recovered`) as sum4, SUM(`total_positive_cases`) as sum5, SUM(`current_pum`) as sum6, SUM(`current_pui`) as sum7 FROM `barangay_history` where reference_date = (SELECT Max(reference_date) from barangay_history)";
if(isset($_POST['submit']))
{
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $msql = "SELECT `city_municipality`, SUM(`new_positive_case`), SUM(`current_positive_case`), SUM(`current_deceased`), SUM(`current_recovered`), SUM(`total_positive_cases`), SUM(`current_pum`), SUM(`current_pui`) FROM `barangay_history` where reference_date between '$startdate' and '$enddate' GROUP BY `city_municipality` ORDER BY MAX(total_positive_cases) DESC";
    //$msql2 = "SELECT SUM(`new_positive_case`) as sum1, SUM(`current_positive_case`) as sum2, SUM(`current_deceased`) as sum3, SUM(`current_recovered`) as sum4, SUM(`total_positive_cases`) as sum5, SUM(`current_pum`) as sum6, SUM(`current_pui`) as sum7 FROM `barangay_history` where reference_date between '$startdate' and '$enddate'";
    $msql2 = "SELECT SUM(`new_positive_case`) as sum1, SUM(`current_positive_case`) as sum2, SUM(`current_deceased`) as sum3, SUM(`current_recovered`) as sum4, SUM(`total_positive_cases`) as sum5, SUM(`current_pum`) as sum6, SUM(`current_pui`) as sum7 FROM `barangay_history` where reference_date = (SELECT Max(reference_date) from barangay_history)";
    $thisresult = mysqli_query($con,$msql);
    $count = mysqli_num_rows($thisresult);
    if ($count == "0")
    {
        $ref1 = $rowsData2;
        $ref2 = $rowsData1;
        $message="No cases found within the dates.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $msql = "SELECT `city_municipality`, SUM(`new_positive_case`), SUM(`current_positive_case`), SUM(`current_deceased`), SUM(`current_recovered`), SUM(`total_positive_cases`), SUM(`current_pum`), SUM(`current_pui`) FROM `barangay_history` GROUP BY `city_municipality` ORDER BY MAX(total_positive_cases) DESC`";
        //$msql2 = "SELECT SUM(`new_positive_case`) as sum1, SUM(`current_positive_case`) as sum2, SUM(`current_deceased`) as sum3, SUM(`current_recovered`) as sum4, SUM(`total_positive_cases`) as sum5, SUM(`current_pum`) as sum6, SUM(`current_pui`) as sum7 FROM `barangay_history`";
        $msql2 = "SELECT SUM(`new_positive_case`) as sum1, SUM(`current_positive_case`) as sum2, SUM(`current_deceased`) as sum3, SUM(`current_recovered`) as sum4, SUM(`total_positive_cases`) as sum5, SUM(`current_pum`) as sum6, SUM(`current_pui`) as sum7 FROM `barangay_history` where reference_date = (SELECT Max(reference_date) from barangay_history)";
        
    }
    else
    {
        $ref1 = $startdate;
        $ref2 = $enddate;
    }
}

$result1 = mysqli_query($con, $msql2);
while($extract = mysqli_fetch_array($result1)){
    $sum1 = $extract['sum1'];
    $sum2 = $extract['sum2'];
    $sum3 = $extract['sum3'];
    $sum4 = $extract['sum4'];
    $sum5 = $extract['sum5'];
    $sum6 = $extract['sum6'];
    $sum7 = $extract['sum7'];
}

$rx = mysqli_query($con,"SELECT MAX(reference_date) as TIME_UPDATE from barangay_history");
while($time_update = mysqli_fetch_array($rx)){
    $last_update = date('F j, Y',strtotime($time_update['TIME_UPDATE']));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once 'include_header.php' ?>
    <!-- END OF STYLES-->
</head>
<body>
    
    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-light" id="title">
        <a style="color: white; font-size: 1.7em;">
            <img src="imgs/DOH.png" class="logo-image" style="marigin-right: 10px;"> COVID-19 CASE TRACKER DASHBOARD <img src="imgs/DOH_calabarzon.png" class="logo-image" style="marigin-right: 10px;">
        </a>
        <a style="color: white; font-size: 1em; color: F0F0F0;" href="https://mcl.edu.ph/">
            mcl.edu.ph<img src="imgs/mcl.png" class="logo-image" style="marigin-left: 10px;">
        </a>
    </nav>
    
    <nav id="navtop" class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php" style="font-size: 20px; font-weight: bold;">Overview <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="individual.php" style="font-size: 20px; font-weight: 500;"> Individual Cases </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="info.php" style="font-size: 20px; font-weight: 500;">Sources </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> </a>
                </li>
                
            </ul>
            <span id="mcl_timer" class="navbar-text" style="font-size: 20px; font-weight: 400; color:black;"></span>
            
            
        </div>
    </nav>
    <!-- END OF NAVIGATION BAR-->
    
    <!-- MAIN CONTENT-->
    <div class="content container-fluid">
        <!-- Title bar and city/municipality selector -->
        <div class="container-fluid" >
            <div class="row">
                <div class=" col-lg-9 col-md-12 col-sm-12">
                    <h1 id="title_header" style="padding-left: 15px; font-size: 24; font-weight: 600;"> Region IV-A: Province of Laguna<br>
                        <h6 style="padding-left: 15px; font-weight: 400;" >SUMMARY AS OF  <?php echo $last_update?></h6></h1> 
                    </div>
                    
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fa fa-flag"></i></span>
                            
                            <div class="info-box-content ">
                                <span class="info-box-text" style="padding: 3px;">Select City / Municipality</span>
                                
                                <select id='city' class="form-control" style="padding: 0px; margin: 0px;">
                                    <option value='LAGUNA'>LAGUNA</option>
                                    <?php
                                    $storethis = "";
                                    $query1 = "SELECT distinct(city_municipality) FROM barangay_history ORDER BY city_municipality ASC";
                                    $result1 = mysqli_query($con,$query1);
                                    while($rows3 = mysqli_fetch_array($result1))
                                    {
                                        if($storethis!=$rows3['city_municipality'])
                                        {
                                            ?>
                                            <option value="<?php echo str_replace(" ","%20 ",$rows3['city_municipality']); ?>">
                                                <?php echo $rows3['city_municipality']; ?>
                                            </option>
                                            
                                            <?php
                                            $storethis=$rows3['city_municipality'];
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Counts-->
            <div class="row">
                <div class="container-fluid" id="divCount">
                </div>
            </div>
            
            <!-- Graphs -->
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <!-- LINE CHART -->
                        <div id='barpage' class="item-container">
                            <!-- CHART -->
                        </div>
                        
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <!-- AREA CHART -->
                        <div id='linepage' class="item-container">
                            <!-- AREA CHART -->
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Table -->
            <div class="row">
                <div class="container-fluid" id="divCount">
                    <div class="card card-outline" style="padding: 0px;">
                        <div class="card-body">
                            <div class = "" style= "overflow-x:auto; overflow-y:hidden;">
                            <div class="parent-container-horizontal">
                                <div class="item-container">
                                    <div class="parent-container-vertical">

                                        <div class="card card-danger2 col-sm-12" style="color: white;">
                                            <div class="card-header">
                                                
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
     
                                                <div id="example1_wrapper" class="table table-striped table-bordered">
                                                    <div class="row">
                                                        <div class="col-sm-12" id="putthisrefresh">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            </div>
                                        </div>
                                        <!-- /.card -->

                                    </div>
                                </div>
                                <!-- TABLE END -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
      
        </div>
        <!-- END OF MAIN CONTENT-->
        
        <!-- FOOTER -->
        <?php include_once 'footer.php' ?>
        <!-- END OF FOOTER-->
        
        
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- SCRIPTS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <!-- App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- page script -->
        <!-- DataTables -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        
        <script>
            $(function() {  
                
                
                // Get context with jQuery - using jQuery's .get() method.
                $("#barpage").load("casesLine.php?location=LAGUNA");
                $("#linepage").load("newCases.php?location=LAGUNA");
                $('#putthisrefresh').load('testrefresh.php?location=LAGUNA');
                $("#divCount").load('count.php?location=ALL');
                $("#title_header").load('title_header.php?city=LAGUNA');
                
                
                
                $("#city").on('change', function() {
                    var selcity = document.getElementById('city');
                    var city = selcity.options[selcity.selectedIndex].value;
                    
                    if (city.includes(" ") && city.includes("%20")) {
                        city = city.replace(" ", "");
                    }
                    else {
                        city = city.replace(" ", "%20");
                    }
                    
                    /* HEADER */
                    /* HEADER */ /* HEADER */
                    
                    var titleHeader = city.replace("%20", "");
                    
                    titleHeader = titleHeader.replace(" ", "");
                    
                    if (titleHeader === 'LAGUNA') {
                        titleHeader = "Region IV-A: Province of Laguna";
                    } else if (titleHeader === 'BINAN' || titleHeader === 'CALAMBA' || titleHeader === 'SANPEDRO' || titleHeader === 'SANTAROSA' || titleHeader === 'SANPABLO' || titleHeader === 'CABUYAO') {
                        titleHeader = "Province of Laguna: City of " + city.replace("%20", " ");
                    } else {
                        titleHeader = "Province of Laguna: Municipality of " + city.replace("%20", " ");
                    }
                    
                    document.getElementById('title_header').innerHTML = titleHeader;
                    
                    /* HEADER */
                    /* HEADER */ /* HEADER */ /* HEADER */ /* HEADER */ /* HEADER */
                    
                    $("#barpage").load("casesLine.php?location=" + city);
                    
                    $("#linepage").load("newCases.php?location=" + city);
                    
                    $('#putthisrefresh').load('testrefresh.php?location=' + city);
                    
                    $("#divCount").load('count.php?location=' + city);
                    
                });
                
                $(document).ready(function(e) {
                    $.ajaxSetup({cache:false});
                    setInterval(function() {
                        $('#mcl_timer').load('timer.php');
                    },1000);
                    $('#checkthistable').DataTable();
                });
                
            })
        </script>
        
        <!-- END OF SCRIPTS-->
    </body>
    </html>