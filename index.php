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
    <?php include_once 'template/include_header.php' ?>
</head>

<body>
    <!-- INCLUDE NAVBAR-->
    <?php include_once 'template/navbar.php' ?>

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
            <div class="col-lg-3 col-md-12 col-sm-12">
                <!-- CASES BY GENDER -->
                <div id='casesByGenderChart' class="item-container"></div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                <!-- CASES BY AGE GROUP -->
                <div id='casesByAgeGroupChart' class="item-container"></div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">

            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                
            </div>
        </div>
        
        <div class="item-container">
            <div class="card card-danger2">
                <div class="card-header">
                    <h3 id='localHead' class="card-title" style="color: white; margin-top : 9px;">TOTAL CASES PER MUNICIPALITY/CITY</h3>
                    <div style="float:right;" class="btn-group btn-group-toggle" data-toggle="buttons">
                        <button type="button" id='toggleLocal' class="btn btn-sm btn-primary" value="graph">SWITCH TO
                            TABLE VIEW</button>
                        </div>
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
                                                <table id="overviewTable"
                                                    class="table table-hover table-striped table-bordered datatable table-light rounded-5">
                                                    <thead id="header" class=""
                                                        style="color:white; background-color: #354664; border-radius:5px">
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
                
                
                
                <!-- END OF MAIN CONTENT-->
            </div>
            <div class="modal-footer">
            </div>



            <!-- END OF MAIN CONTENT-->
        </div>
    </div>
    </div>
    </div>
    
    
    <!-- INCLUDE FOOTER-->
    <?php include("template/footer.php") ?>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"> </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <?php include("legacy/viewModal.php") ?>
    
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
            searching: false,
            order: [[1, "desc"]]
        });

        //INITIALIZE CLOCK

        setInterval(function() {
            var date = moment(new Date());
            $('#mcl_timer').html(date.format('dddd, Do of MMMM YYYY | h:mm:ss a'));
        }, 1000);


        //INITIALIZE VIDEO
        $('#videomodal').modal('show');
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
        registerChartUpdate("#summaryPerMunicipalityCityChart",
        "views/summaryPerMunicipalityCityChartView.php");
        registerChartUpdate("#recoveryPerDateChart", "views/recoveryPerDateChartView.php");
        registerChartUpdate("#deceasedPerDateChart", "views/deceasedPerDateChartView.php");
        registerChartUpdate("#currentTrendChart", "views/casesTrendPerDateChartView.php")

        //LOAD INITIAL GRAPHS
        updatePage("LAGUNA");

        function updateSummaryPerMunicipalityCityTable(location) {
            $.ajax({
                type: "GET",
                url: "views/summaryPerMunicipalityCityTableView.php",
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
