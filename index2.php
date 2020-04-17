

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
    <meta property="og:image" content="http://covid19tracker-lagunadev.mcl-ccis.net/imgs/mcl.PNG">
    <meta property="og:image:type" content="imgs/mcl.PNG">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    
    <title>COVID-19 CASE TRACKER</title>
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
        
        .modal-lg {
            max-width: 80% !important;
        }
        
        #navtop ul{
            display: flex;
            flex-direction: row;
            list-style: none;
        }
        #navtop ul li a{
            color:rgba(0, 0, 0, .5);
            font-size: 20px;
            font-weight: 500;
        }
        #navtop ul li a:hover{
            color:rgba(0, 0, 0, .7);
        }
        
        #mcl_timer{
            margin-left: auto;
        }
        
        .active{
            color:black !important;
            font-weight:bold !important;
        }
        
        
        @media only screen and (max-width: 400px){
            ul li a{
                color:#505050;
                font-size: 18px;
                padding: 5px;
                font-weight: 500;
                padding-left:0 !important;
                padding-right:0 !important;
                
            }
        }
        @media only screen and (max-width: 600px){
            ul{
                justify-content: space-evenly;
            }
            
        }
        @media only screen and (max-width: 770px){
            #mcl_timer{
                visibility: hidden;
                width: 1px;
                height: 1px;
                margin: -1px;
                border: 0;
                padding: 0;
            }
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
                    <h4 id="title_header" style="padding-left: 15px; font-size: 20 !important; font-weight: 600 !important;"> Region IV-A: Province of Laguna<br>
                        <h6 style="padding-left: 15px; font-weight: 400;" >SUMMARY AS OF  <?php echo $last_update?></h6></h4> 
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
                                            <option value="<?php echo $rows3['city_municipality']; ?>">
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
                        
                        <!-- LINE CHART -->
                        <div id='graph1' class="item-container">
                            <!-- CHART -->
                        </div>
                        <!-- /.card -->
                        
                    </div>
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        
                        <div id='linepage' class="item-container">
                            
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
                                <button type="button" id='toggleLocal' class="btn btn-sm btn-primary" value="graph">TABLE VIEW</button>
                            </div>
                        </div>
                        <div id='graph3'>
                            
                        </div>
                        <div class="container-fluid" id="tableContainer">

                            
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
    
    
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    
    <script>
        $(document).ready(function() {
            //INITIALIZE NAVBAR
            $("#indexNav a").addClass("active");
            
            //INITIALIZE DATATABLES
            $("#tableContainer").load("/views/summaryPerMunicipalityCityTableView.php");
            $("#overviewTable").DataTable({
                paging: false,
                searching: false
            });

            //INITIALIZE CLOCK
            $(document).ready(function(e) {
                $.ajaxSetup({cache:false});
                setInterval(function() {
                    $('#mcl_timer').load('timer.php');
                },1000);
            });
            
            //INITIALIZE CONDITIONS            
            var flag = false;
            $("#graph3").show();
            $("#table").hide();
            updatePage("LAGUNA");
            
            //EVENT HANDLERS
            $("#toggleLocal").click(function() {
                
                if(flag == false)
                {
                    $("#graph3").hide();
                    $("#table").show();
                    $("#toggleLocal").html("GRAPH VIEW");
                    flag = true;
                }
                else
                {
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
            function updatePage(location){
                updateTitleHeader(location);
                updateSummary(location);
                updateCasesPerDate(location);
                updateCasesByGender(location);
                updateCasesByAgeGroup(location);
                updatePUIPerDate(location);
                updateSummaryPerMunicipalityCityChart(location);
                updateSummaryPerMunicipalityCityTable(location);
            }
            
            function updateSummary(location){
                $.ajax({
                    method:"GET",
                    url:"views/summaryView.php",
                    data:{location:location},
                    type:"html",
                    success:function(data){
                        $("#divCount").html(data);
                        console.log(data);
                    }
                });
            }
            
            function updateCasesPerDate(location){
                $.ajax({
                    method:"GET",
                    url:"views/casesPerDateChartView.php",
                    data:{location:location},
                    type:"html",
                    success:function(data){
                        $("#barpage").html(data);
                        console.log(data);
                    }
                });
            }
            
            function updateCasesByGender(location){
                $.ajax({
                    method:"GET",
                    url:"views/casesByGenderChartView.php",
                    data:{location:location},
                    type:"html",
                    success:function(data){
                        $("#graph1").html(data);
                        console.log(data);
                    }
                });
            }
            
            function updateCasesByAgeGroup(location){
                $.ajax({
                    method:"GET",
                    url:"views/casesByAgeGroupChartView.php",
                    data:{location:location},
                    type:"html",
                    success:function(data){
                        $("#graph2").html(data);
                        console.log(data);
                    }
                });
            }
            
            function updatePUIPerDate(location){
                $.ajax({
                    method:"GET",
                    url:"views/puiPerDateChartView.php",
                    data:{location:location},
                    type:"html",
                    success:function(data){
                        $("#linepage").html(data);
                        console.log(data);
                    }
                });
            }
            
            function updateSummaryPerMunicipalityCityChart(location){
                $.ajax({
                    method:"GET",
                    url:"views/summaryPerMunicipalityCityChartView.php",
                    data:{location:location},
                    type:"html",
                    success:function(data){
                        $("#graph3").html(data);
                        console.log(data);
                    }
                });
            }
            
            function updateSummaryPerMunicipalityCityTable(location){
                $.ajax({
                    type:"GET",
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
            
            function updateTitleHeader(location){
                if(city!='LAGUNA')  $("#localHead").html("TOTAL CASES OF " + location);
                else $("#localHead").html("TOTAL CASES PER MUNICIPALITY/CITY");
                var titleHeader = location;
                if (titleHeader === 'LAGUNA') {
                    titleHeader = "Region IV-A: Province of Laguna";
                } else if (titleHeader === 'BINAN' || titleHeader === 'CALAMBA' || titleHeader === 'SANPEDRO' || titleHeader === 'SANTAROSA' || titleHeader === 'SANPABLO' || titleHeader === 'CABUYAO') {
                    titleHeader = "Province of Laguna: City of " + location;
                } else {
                    titleHeader = "Province of Laguna: Municipality of " + location;
                }
                document.getElementById('title_header').innerHTML = titleHeader;
            }
        })
    </script>
    
    <!-- END OF SCRIPTS-->
</body>
</html>