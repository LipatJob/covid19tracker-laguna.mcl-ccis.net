<?php
include 'phpcore/connection.php';


$query1 = "SELECT * FROM barangay_history order by reference_date";
$result1 = mysqli_query($con, $query1);
$result2 = mysqli_query($con, $query1);
while ($rows2 = mysqli_fetch_array($result2)) {
    $rowsData2 = $rows2['reference_date'];
    break;
}
while ($rows1 = mysqli_fetch_array($result1)) {
    $rowsData1 = $rows1['reference_date'];
}
$ref1 = $rowsData2;
$ref2 = $rowsData1;

$msql = "SELECT * FROM ALL_TOTAL";
//$msql2 = "SELECT SUM(`new_positive_case`) as sum1, SUM(`current_positive_case`) as sum2, SUM(`current_deceased`) as sum3, SUM(`current_recovered`) as sum4, SUM(`total_positive_cases`) as sum5, SUM(`current_pum`) as sum6, SUM(`current_pui`) as sum7 FROM `barangay_history`";
$msql2 = "SELECT SUM(`new_positive_case`) as sum1, SUM(`current_positive_case`) as sum2, SUM(`current_deceased`) as sum3, SUM(`current_recovered`) as sum4, SUM(`total_positive_cases`) as sum5, SUM(`current_pum`) as sum6, SUM(`current_pui`) as sum7 FROM `barangay_history` where reference_date = (SELECT Max(reference_date) from barangay_history)";

$result1 = mysqli_query($con, $msql2);
while ($extract = mysqli_fetch_array($result1)) {
    $sum1 = $extract['sum1'];
    $sum2 = $extract['sum2'];
    $sum3 = $extract['sum3'];
    $sum4 = $extract['sum4'];
    $sum5 = $extract['sum5'];
    $sum6 = $extract['sum6'];
    $sum7 = $extract['sum7'];
}

$rx = mysqli_query($con, "SELECT MAX(reference_date) as TIME_UPDATE from barangay_history");
while ($time_update = mysqli_fetch_array($rx)) {
    $last_update = date('F j, Y', strtotime($time_update['TIME_UPDATE']));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'phpcore/include_header.php' ?>
</head>

<body>
    <!-- NAVIGATION BAR -->
    <div class="col col-md-12 col-lg-12 col-sm-12" style="padding: 0px; margin:0px;">
        <nav class="navbar navbar-light" id="title">
            <a style="color: white; font-size: 1.315em; font-weight: 600;">
                <img src="imgs/android-icon-48x48.png" class="logo-image" style="height: 36px; width: 36px; margin-right: 5px; -webkit-box-shadow: 1px 1px 5px 0px rgba(252,247,252,1);
                -moz-box-shadow: 1px 1px 5px 0px rgba(252,247,252,1);
                box-shadow: 1px 1px 5px 0px rgba(252,247,252,1);">COVID-19 Case Tracker
            </a>
            <div>
                <img src="imgs/DOH-min.png" class="logo-image">
                <img src="imgs/DOH_calabarzon-min.png" class="logo-image">
                <img src="imgs/mcl-min.png" class="logo-image">
            </div>
        </nav>
    </div>
    
    
    <div id="navtop" class=" navbar-light bg-light mb-4" style="padding: 0px !important;  border-bottom: 0.5px solid #2F333D !important; margin-top: -10px; overflow: hidden; width: 100% !important; ">
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
                        <h6 style="padding-left: 15px; font-weight: 400;">SUMMARY AS OF <?php echo $last_update ?></h6>
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
                                $query1 = "SELECT CityName as city_municipality from City ORDER BY CityName ASC;";
                                $result1 = mysqli_query($con, $query1);
                                while ($rows3 = mysqli_fetch_array($result1)) {
                                    if ($storethis != $rows3['city_municipality']) {
                                        ?>
                                        <option value="<?php echo $rows3['city_municipality'] ?>">
                                            <?php echo $rows3['city_municipality']; ?>
                                        </option>
                                        
                                        <?php
                                        $storethis = $rows3['city_municipality'];
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
    <div class="container-fluid" id="summary">
        <style>
            .small-box {
                margin: 0px;
            }
        </style>
        <div class="row">
            
        </div>
    </div>
    
    <!-- Graphs -->
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <!-- CASE PER DATE -->
                <div id='casesPerDateChart' class="item-container"></div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <!-- CURRENT CASES TREND -->
                <div id='currentTrendChart' class="item-container"></div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <!-- PUI PER DATE -->
                <div id='puiPerDateChart' class="item-container"></div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <!-- RECOVERY AND DECEASED PER DATE -->
                <div id='recoveryPerDateChart' class="item-container"></div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <!-- CASES BY GENDER -->
                <div id='casesByGenderChart' class="item-container"></div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <!-- CASES BY AGE GROUP -->
                <div id='casesByAgeGroupChart' class="item-container"></div>
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
                    <div id='summaryPerMunicipalityCityChart'>
                        
                    </div>
                    <div class="container-fluid">
                        <div id='table' class="row">
                            <div class="container-fluid" id="tableContainer">
                                <div id='table' class="row">
                                    <div class="container-fluid" id="divCount">
                                        <div class="card card-outline" style="padding: 0px;">
                                            <div class="card-body" style="overflow: scroll;">
                                                <div class="table-responsive">
                                                    <table id="overviewTable" class="table table-hover table-striped table-bordered datatable table-light rounded-5">
                                                        <thead id="header" class="" style="color:white; background-color: #354664; border-radius:5px">
                                                            <tr>
                                                                <th class=""></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="">
                                                            <tr>
                                                                <td class=""></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot id="footer">
                                                            <tr>
                                                                <td class=""></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<div class="modal fade bd-example-modal-md" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="video">
        <div class="modal-content" style="background-color: #095779; color: white;">
            <div class="modal-header">
                <div class="parent-container-horizontal">
                    <img src="imgs/mcl.png" class="logo-image" style="height: 100%; margin-top: 5px;">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 1.1em; font-weight: 400; margin-left: 10px;"> MCL's way of saying <br>
                        <strong>Thank You</strong> to our Frontliners!</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="wrapper">
                        <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fmclcsce%2Fvideos%2F2517862128542744%2F&show_text=0&width=560" width="100%" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true" style="margin: 15px;"></iframe></div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- SCRIPTS -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!--<script src="plugins/chart.js/Chart.min.js"></script>-->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"> </script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        
        <script>
            //INITIALIZE NAVBAR
            $("#indexNav a").addClass("active");
        </script>
        
        <script>
            $(document).ready(function() {
                //INITIALIZE NAVBAR
                $("#indexNav a").addClass("active");
                
                //INITIALIZE DATATABLES
                //$("#tableContainer").load("./views/summaryPerMunicipalityCityTableView.php");
                $("#overviewTable").DataTable({
                    paging: false,
                    searching: false
                });
                
                //INITIALIZE CLOCK
                
                setInterval(function() {
                    var date = moment(new Date());
                    $('#mcl_timer').html(date.format('dddd, Do of MMMM YYYY | h:mm:ss a'));
                }, 1000);
                
                
                //INITIALIZE VIDEO
                //$('#videomodal').modal('show');
                $('.modal').on('hidden.bs.modal', function(e) {
                    $iframe = $(this).find("iframe");
                    $iframe.attr("src", $iframe.attr("src"));
                });
                
                //INITIALIZE CONDITIONS            
                var flag = false;
                $("#summaryPerMunicipalityCityChart").show();
                $("#table").hide();
                
                //EVENT HANDLERS
                $("#toggleLocal").click(function() {
                    if (flag == false) {
                        $("#summaryPerMunicipalityCityChart").hide();
                        $("#table").show();
                        $("#toggleLocal").html("SWITCH TO GRAPH VIEW");
                        flag = true;
                    } else {
                        $("#summaryPerMunicipalityCityChart").show();
                        $("#table").hide();
                        $("#toggleLocal").html("SWITCH TO TABLE VIEW");
                        flag = false;
                    }
                });
                
                $("#city").on('change', function() {
                    var location = document.getElementById('city').value;
                    updatePage(location)
                });
                
                //HANDLE GRAPH UPDATES
                var registeredCharts = [];
                
                function updatePage(location) {
                    // Manual register update
                    updateTitleHeader(location);
                    updateSummaryPerMunicipalityCityTable(location);
                    registeredCharts.forEach(function(chart) {
                        chart(location);
                    });
                }
                
                //UPDATE DECORATOR
                /**
                * Register a chart for update. All charts must be regsitered below the function.
                * @param {String} target jQuery selector of the container of the chart 
                * @param {String} viewlocation location of the view of the chart
                * @return {Function} function of the ajax update
                */
                function registerChartUpdate(target, viewlocation) {
                    chartUpdate = function(updateData) {
                        $.ajax({
                            method: "GET",
                            url: viewlocation,
                            data: {
                                location: updateData
                            },
                            type: "html",
                            success: function(data) {
                                $(target).html(data);
                            }
                        });
                    }
                    registeredCharts.push(chartUpdate);
                    return chartUpdate;
                }
                
                //REGISTER SERVER SIDE LOADED GRAPHS HERE
                registerChartUpdate("#summary", "views/summaryView.php");
                registerChartUpdate("#casesPerDateChart", "views/casesPerDateChartView.php");
                registerChartUpdate("#casesByGenderChart", "views/casesByGenderChartView.php");
                registerChartUpdate("#casesByAgeGroupChart", "views/casesByAgeGroupChartView.php");
                registerChartUpdate("#puiPerDateChart", "views/puiPerDateChartView.php");
                registerChartUpdate("#summaryPerMunicipalityCityChart", "views/summaryPerMunicipalityCityChartView.php");
                registerChartUpdate("#recoveryPerDateChart", "views/recoveryPerDateChartView.php");
                registerChartUpdate("#deceasedPerDateChart", "views/deceasedPerDateChartView.php");
                registerChartUpdate("#currentTrendChart", "views/casesTrendPerDateChartView.php")
                
                //LOAD INITIAL GRAPHS
                updatePage("LAGUNA");
                
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
                            console.log("An error has occured while loading the table: " + data);
                        }
                    })
                }
                
                function updateTitleHeader(location) {
                    if (location != 'LAGUNA') $("#localHead").html("SUMMARY OF CASES: " + location);
                    else $("#localHead").html("SUMMARY OF CASES");
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
                
                
            });
        </script>
        
        <!-- END OF SCRIPTS-->
    </body>
    
    </html>