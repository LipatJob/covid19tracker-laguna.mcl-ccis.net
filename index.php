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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163203245-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        
        gtag('config', 'UA-163203245-1');
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=false;">
    <title>COVID-19 CASE TRACKER DASHBOARD</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    
    <!-- STYLES -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- DataTables -->
    <!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <link rel="stylesheet" href="css/flexme.css">
    
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
        
        #overviewTable{
            border-radius: 5px;
        }
        #overviewTable th{
            border-radius: 5px;
            text-align: center;
            
        }
        #overviewTable td{
            text-align: center;
        }
        
        tr :first-child{
            text-align: left !important; 
        }
        #footer{
            font-weight: bold;
            color: green;
        }
        
        
        
        
        
    </style>
    <!-- END OF STYLES-->
</head>
<body>
    
   <!-- INCLUDE NAVBAR-->
    <?php include("navbar.php") ?>
    
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
            <div class="container-fluid" id="divCount">
                <div class="row">

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
                        
                        <div id='linepage' class="item-container">
                             
                        </div>

                </div>
            </div>
            
            <!-- Table -->
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid" id="divCount">
                    <div class="card card-outline" style="padding: 0px;">
                        <div class="card-body ">
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
                                    <tfoot id = "footer">
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
        <!-- END OF MAIN CONTENT-->
        
         <!-- INCLUDE FOOTER-->
        <?php include("phpcore/footer.php") ?>
        
        
        <!-- SCRIPTS -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
            //INITIALIZE NAVBAR
            $("#indexNav a").addClass("active");
        </script>
        
        <script>
            jQuery(function($) {  
                // Get context with jQuery - using jQuery's .get() method.
                $("#barpage").load("casesLineNew.php?location=LAGUNA");
                $("#linepage").load("newCasesNew.php?location=LAGUNA");
                //DEPRECIATED: $('#putthisrefresh').load('testrefresh.php?location=LAGUNA');
                $("#divCount").load('countNew.php?location=ALL');
                $("#title_header").load('title_header.php?city=LAGUNA');
                $("#overviewTable").DataTable({
                    paging: false,
                    searching: false
                });
                
                updateTable("LAGUNA");
                

                
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
                    
                    $("#barpage").load("casesLineNew.php?location=" + city);
                    
                    $("#linepage").load("newCasesNew.php?location=" + city);
                    
                    updateTable(city);
                    
                    //DEPRECIATED: $('#putthisrefresh').load('testrefresh.php?location=' + city);
                    
                    $("#divCount").load('countNew.php?location=' + city);
                    
                    
                    
                });
                
                function updateTable(location){
                    $.noConflict();
                    $.ajax({
                        type:"post",
                        url:"overviewData.php",
                        data:{functionname:'getData',arguments: [location]},
                        success:function(data){
                            data = JSON.parse(data);
                            table = $("#overviewTable").DataTable();
                            table.clear();
                            // update header
                            var index = 0;
                            $("#header tr th").each(function(){
                                $(this)[0].innerText = data.HEADER[index];
                                index++;
                            });
                            // update body
                            table.rows.add(data.BODY);
                            // update footer
                            index = 0;
                            if(data.FOOTER.length > 0){
                                $("#footer tr td").each(function(){
                                    if(index == 0){
                                        $(this)[0].innerText = "TOTAL"
                                    }else{
                                        $(this)[0].innerText = data.FOOTER[0][index];
                                    }
                                    index++;
                                });
                            }
                            
                            table.draw();
                        },
                        error:function(data){
                            console.log(data);
                        }
                    })
                }
                
                $(document).ready(function(e) {
                    $.ajaxSetup({cache:false});
                    setInterval(function() {
                        $('#mcl_timer').load('timer.php');
                    },1000);
                });
                
            })
        </script>
        
        <!-- END OF SCRIPTS-->
    </body>
    </html>