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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'phpcore/include_header.php' ?>
    
    <style>
        #title {
            -webkit-box-shadow: 0px 3px 5px 0px rgba(115, 113, 111, 1);
            -moz-box-shadow: 0px 3px 5px 0px rgba(115, 113, 111, 1);
            box-shadow: 0px 3px 5px 0px rgba(115, 113, 111, 1);
            background-color: #354664;
            color: white;
        }
        
        #navtop {
            -webkit-box-shadow: 0px 3px 5px 0px rgba(115, 113, 111, 1);
            -moz-box-shadow: 0px 3px 5px 0px rgba(115, 113, 111, 1);
            box-shadow: 0px 3px 5px 0px rgba(115, 113, 111, 1);
            color: white;
        }
        
        html {
            -webkit-text-size-adjust: 100%;
        }
        
        .logo-image {
            width: 42px;
            height: 42px;
            margin-top: -6px;
        }
        
        .dataTables_filter {
            display: none;
        }
        
        #overviewTable {
            border-radius: 5px;
        }
        
        #overviewTable th {
            border-radius: 5px;
            text-align: center;
            
        }
        
        #overviewTable td {
            text-align: center;
        }
        
        tr :first-child {
            text-align: left !important;
        }
        
        #footer {
            font-weight: bold;
            color: green;
        }
        
        .modal-lg {
            max-width: 80% !important;
        }
        
        #navtop ul {
            display: flex;
            flex-direction: row;
            list-style: none;
        }
        
        #navtop ul li a {
            color: rgba(0, 0, 0, .5);
            font-size: 20px;
            font-weight: 500;
        }
        
        #navtop ul li a:hover {
            color: rgba(0, 0, 0, .7);
        }
        
        #mcl_timer {
            margin-left: auto;
        }
        
        .active {
            color: black !important;
            font-weight: bold !important;
        }
        
        
        @media only screen and (max-width: 400px) {
            ul li a {
                color: #505050;
                font-size: 18px;
                padding: 5px;
                font-weight: 500;
                padding-left: 0 !important;
                padding-right: 0 !important;
                
            }
        }
        
        @media only screen and (max-width: 600px) {
            ul {
                justify-content: space-evenly;
            }
            
        }
        
        @media only screen and (max-width: 770px) {
            #mcl_timer {
                visibility: hidden;
                width: 1px;
                height: 1px;
                margin: -1px;
                border: 0;
                padding: 0;
            }
        }
        
        #title_header {
            font-weight: 520 !important;
            font-size: 21 !important;
        }
    </style>
    <!-- END OF STYLES-->
</head>

<body>
    <!-- NAVIGATION BAR -->
    <div class="col col-md-12 col-lg-12 col-sm-12" style="padding: 0px; margin:0px;">
        <nav class="navbar navbar-light" id="title">
            <a style="color: white; font-size: 1.315em; font-weight: 600;">
                <img src="imgs/v1c with text.png" class="logo-image" style="height: 36px; width: 36px; margin-right: 5px; -webkit-box-shadow: 1px 1px 5px 0px rgba(252,247,252,1);
                -moz-box-shadow: 1px 1px 5px 0px rgba(252,247,252,1);
                box-shadow: 1px 1px 5px 0px rgba(252,247,252,1);">COVID-19 Case Tracker
            </a>
            <div>
                <img src="imgs/DOH.png" class="logo-image">
                <img src="imgs/DOH_calabarzon.png" class="logo-image">
                <img src="imgs/mcl.png" class="logo-image">
            </div>
        </nav>
    </div>
    
    
    <div id="navtop" class=" navbar-light bg-light mb-4"
    style="padding: 0px !important;  border-bottom: 0.5px solid #2F333D !important; margin-top: -10px; overflow: hidden; width: 100% !important; ">
    <ul class="row p-2" style="padding: 0px; margin: 0px;">
        <li class="" id="indexNav" style="padding: 0px; margin: 0px;">
            <a class="nav-link" href="index.php"> Dashboard </a>
        </li>
        <li class="" id="individualNav" style="padding: 0px; margin: 0px;">
            <a class="nav-link" id="maps" href="maps.php"> Map </a>
        </li>
        <li class="" id="sourcesNav" style="padding: 0px; margin: 0px;">
            <a class="nav-link" href="info.php"> Hotlines </a>
        </li>
        <span id="mcl_timer" class="navbar-text" style="font-size: 20px; font-weight: 400; color:black; "></span>
    </ul>
</div>
<!-- END OF NAVIGATION BAR-->

<!-- MAIN CONTENT-->
<div class="content container-fluid">
    <!-- Title bar and city/municipality selector -->
    <div class="container-fluid">
        <div class="row">
            <div class=" col-lg-9 col-md-12 col-sm-12">
                <h4 id="title_header" style="padding-left: 15px;"> Region IV-A: Province of Laguna<br>
                    <h6 style="padding-left: 15px; font-weight: 400;">SUMMARY AS OF <?php echo $last_update?></h6>
                </h4>
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
</div>

<!-- Counts-->
<div class="container-fluid" id="divCount">
    <div class="row">
        
    </div>
</div>

<!-- Graphs -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <!-- CASE PER DATE -->
            <div id='barpage' class="item-container">
            </div>
            <!-- RECOVERY PER DATE -->
            <div id='recoveryperdate' class="item-container">
            </div>
            
            <!-- CASES BY GENDER -->
            <div id='graph1' class="item-container">
                <!-- CHART -->
            </div>
            <!-- /.card -->
            
        </div>
        
        <div class="col-lg-6 col-md-12 col-sm-12">
            
            <!-- CASES BY GENDER -->
            <div id='linepage' class="item-container">
            </div>
            <!-- CASES BY GENDER -->
            <div id='deceasedperdate' class="item-container">
            </div>
            
            <!-- AREA CHART -->
            <div id='graph2' class="item-container">
                <!-- AREA CHART -->
            </div>
            
        </div>
    </div>
    
    <div class="item-container">
        <div class="card card-danger2">
            <div class="card-header">
                <h3 id='localHead' class="card-title" style="color: white;">TOTAL CASES PER MUNICIPALITY/CITY</h3>
                <div style="float:right;" class="btn-group btn-group-toggle" data-toggle="buttons">
                    <button type="button" id='toggleLocal' class="btn btn-sm btn-primary" value="graph">SWITCH TO
                        TABLE VIEW</button>
                    </div>
                </div>
                <div id='graph3'>
                    
                </div>
                <div class="container-fluid">
                    <div id='table' class="row">
                        <div class="container-fluid"  id="tableContainer">
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            
            <!-- END OF MAIN CONTENT-->
        </div>
        <div class="modal-footer">
        </div>
    </div>
</div>
</div>

<!-- INCLUDE FOOTER-->
<?php include("phpcore/footer.php") ?>



<!-- Modal -->
<div class="modal fade bd-example-modal-md" id="videomodal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-md modal-dialog-centered" role="video">
    <div class="modal-content" style="background-color: #095779; color: white;">
        <div class="modal-header">
            <div class="parent-container-horizontal">
                <img src="imgs/mcl.png" class="logo-image" style="height: 100%; margin-top: 5px;">
                <h5 class="modal-title" id="exampleModalLongTitle"
                style="font-size: 1.1em; font-weight: 400; margin-left: 10px;"> MCL's way of saying <br>
                <strong>Thank You</strong> to our Frontliners!</h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="wrapper">
                <iframe
                src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fmclcsce%2Fvideos%2F2517862128542744%2F&show_text=0&width=560"
                width="100%" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                allowTransparency="true" allowFullScreen="true" style="margin: 15px;"></iframe></div>
            </div>
        </div>
    </div>
</div>


<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- App -->
<!-- for demo purposes -->
<!-- page script -->
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"> </script>

<script>
    //INITIALIZE NAVBAR
    $("#indexNav a").addClass("active");
</script>

<script>
    $(document).ready(function() {
        //INITIALIZE NAVBAR
        $("#indexNav a").addClass("active");
        
        //INITIALIZE DATATABLES
        $("#tableContainer").load("./views/summaryPerMunicipalityCityTableView.php");
        $("#overviewTable").DataTable({
            paging: false,
            searching: false
        });
        
        //INITIALIZE CLOCK
        $(document).ready(function(e) {
            $.ajaxSetup({
                cache: false
            });
            setInterval(function() {
                $('#mcl_timer').load('timer.php');
            }, 1000);
        });
        
        //INITIALIZE CONDITIONS            
        var flag = false;
        $("#graph3").show();
        $("#table").hide();
        updatePage("LAGUNA");
        
        //EVENT HANDLERS
        $("#toggleLocal").click(function() {
            
            if (flag == false) {
                $("#graph3").hide();
                $("#table").show();
                $("#toggleLocal").html("GRAPH VIEW");
                flag = true;
            } else {
                $("#graph3").show();
                $("#table").hide();
                $("#toggleLocal").html("TABLE VIEW");
                flag = false;
            }
            
        });
        
        $("#city").on('change', function() {
            var location = document.getElementById('city').value;
            updatePage(location)
        });
        
        //HANDLE GRAPH UPDATES
        //REGISTER GRAPHS HERE
        function updatePage(location) {
            updateTitleHeader(location);
            updateSummary(location);
            updateCasesPerDate(location);
            updateCasesByGender(location);
            updateCasesByAgeGroup(location);
            updatePUIPerDate(location);
            updateSummaryPerMunicipalityCityChart(location);
            updateSummaryPerMunicipalityCityTable(location);
            updateRecoveryPerDate(location)
            updateDeceasedPerDate(location)
            
        }
        
        function updateSummary(location) {
            $.ajax({
                method: "GET",
                url: "views/summaryView.php",
                data: {
                    location: location
                },
                type: "html",
                success: function(data) {
                    $("#divCount").html(data);
                }
            });
        }
        
        function updateCasesPerDate(location) {
            $.ajax({
                method: "GET",
                url: "views/casesPerDateChartView.php",
                data: {
                    location: location
                },
                type: "html",
                success: function(data) {
                    $("#barpage").html(data);
                }
            });
        }
        
        function updateCasesByGender(location) {
            $.ajax({
                method: "GET",
                url: "views/casesByGenderChartView.php",
                data: {
                    location: location
                },
                type: "html",
                success: function(data) {
                    $("#graph1").html(data);
                }
            });
        }
        
        function updateCasesByAgeGroup(location) {
            $.ajax({
                method: "GET",
                url: "views/casesByAgeGroupChartView.php",
                data: {
                    location: location
                },
                type: "html",
                success: function(data) {
                    $("#graph2").html(data);
                }
            });
        }
        
        function updatePUIPerDate(location) {
            $.ajax({
                method: "GET",
                url: "views/puiPerDateChartView.php",
                data: {
                    location: location
                },
                type: "html",
                success: function(data) {
                    $("#linepage").html(data);
                }
            });
        }
        
        function updateSummaryPerMunicipalityCityChart(location) {
            $.ajax({
                method: "GET",
                url: "views/summaryPerMunicipalityCityChartView.php",
                data: {
                    location: location
                },
                type: "html",
                success: function(data) {
                    $("#graph3").html(data);
                }
            });
        }
        
        function updateSummaryPerMunicipalityCityTable(location) {
            $.ajax({
                type: "GET",
                url: "overviewData.php",
                data: {
                    functionname: 'getData',
                    arguments: [location]
                },
                success: function(data) {
                    data = JSON.parse(data);
                    table = $("#overviewTable").DataTable();
                    table.clear();
                    // update header
                    var index = 0;
                    $("#header tr th").each(function() {
                        $(this)[0].innerText = data.HEADER[index];
                        index++;
                    });
                    // update body
                    table.rows.add(data.BODY);
                    // update footer
                    index = 0;
                    if (data.FOOTER.length > 0) {
                        $("#footer tr td").each(function() {
                            if (index == 0) {
                                $(this)[0].innerText = "TOTAL"
                            } else {
                                $(this)[0].innerText = data.FOOTER[0][index];
                            }
                            index++;
                        });
                    }
                    
                    table.draw();
                },
                error: function(data) {
                    console.log(data);
                }
            })
        }
        
        function updateTitleHeader(location) {
            if (city != 'LAGUNA') $("#localHead").html("TOTAL CASES OF " + location);
            else $("#localHead").html("TOTAL CASES PER MUNICIPALITY/CITY");
            var titleHeader = location;
            if (titleHeader === 'LAGUNA') {
                titleHeader = "Region IV-A: Province of Laguna";
            } else if (titleHeader === 'BINAN' || titleHeader === 'CALAMBA' || titleHeader === 'SANPEDRO' ||
            titleHeader === 'SANTAROSA' || titleHeader === 'SANPABLO' || titleHeader === 'CABUYAO') {
                titleHeader = "Province of Laguna: City of " + location;
            } else {
                titleHeader = "Province of Laguna: Municipality of " + location;
            }
            document.getElementById('title_header').innerHTML = titleHeader;
        }
        
        function registerUpdate(target, viewlocation) {
            return function(updateData) {
                $.ajax({
                    method: "GET",
                    url: viewlocation,
                    data: {
                        updateData: updateData
                    },
                    type: "html",
                    success: function(data) {
                        $(target).html(data);
                        console.log(data);
                    }
                });
            }
        }
        
        function updateRecoveryPerDate(location) {
            $.ajax({
                method: "GET",
                url: "views/recoveryPerDateView.php",
                data: {
                    location: location
                },
                type: "html",
                success: function(data) {
                    $("#recoveryperdate").html(data);
                }
            });
        }
        
        function updateDeceasedPerDate(location) {
            $.ajax({
                method: "GET",
                url: "views/deceasedPerDateView.php",
                data: {
                    location: location
                },
                type: "html",
                success: function(data) {
                    $("#deceasedperdate").html(data);
                }
            });
        }
    });
</script>

<!-- END OF SCRIPTS-->
</body>

</html>