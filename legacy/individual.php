<?php
include 'phpcore/connection.php';

 $rx = mysqli_query($con,"SELECT MAX(reference_date) as TIME_UPDATE from barangay_history");
            while($time_update = mysqli_fetch_array($rx)){
              $last_update = date('F j, Y',strtotime($time_update['TIME_UPDATE']));
            }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163203245-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-163203245-1');
        </script>

        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
            
            .logo-image {
                width: 42px;
                height: 42px;
                margin-top: -6px;
            }
        </style>

        <title>COVID-19 CASE TRACKER DASHBOARD</title>
    </head>

    <body onload="">
        <!-- TOP -->
       <!-- INCLUDE NAVBAR-->
    <?php include("navbar.php") ?>

        <!-- MAIN CONTENT-->
    <div class="content container-fluid">
        <!-- Title bar and city/municipality selector -->
        <div class="container-fluid" >
            <div class="row">
                <div class=" col-lg-9 col-md-12 col-sm-12">
                    <h1 id="title_header" style="padding-left: 15px; font-size: 24; font-weight: 500 !important; font-family: Segoe UI Semibold !important; "> Region IV-A: Province of Laguna<br>
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

                <div class="container-parent-horizontal">
                    <!-- GRAPHS -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">

                                    <!-- LINE CHART -->
                                    <div id='graph1' class="item-container">
                                        <!-- CHART -->
                                    </div>
                                    <!-- /.card -->

                                </div>
                                <!-- /.col (LEFT) -->
                                <div class="col-md-6">

                                    <!-- AREA CHART -->
                                    <div id='graph2' class="item-container">
                                        <!-- AREA CHART -->
                                    </div>

                                    <!-- /.card -->

                                </div>
                                <!-- /.col (RIGHT) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </section>

                    <!-- GRAPHS -->
                </div>
                <div class="container-parent-horizontal" id ='graph3'>
                </div>

                <!-- TABLE -->

                <div id="refreshthis" class="card card-danger2" style="width: 100%; color: white;">

                </div>

                <!-- -->
            </div>
        </div>

        
            <!-- FOOTER -->
        <div class="row" >
            <div class="item-container" style="text-align:center; height: 100%; background-color: #333333; color: white; width: 100%; bottom: -50px; left: 0px; padding-top: 20px; padding-bottom: 10px;">
                <p>Disclaimer: Data in this case tracker is based on the daily update posted from the social media account of the different LGUs in the province of Laguna.</p>
                <p>Copyright © 2020 Malayan Colleges Laguna. All rights reserved. <br> COVID-19 CASE TRACKER for the Province of Laguna Region IV-A Calabarzon.</p>
            </div>
        </div>
        <!-- END OF FOOTER-->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
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
            <script src="plugins/datatables/jquery.dataTables.js"></script>
            <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

            <script>
                function toggle(button) {
                    if (button.value == "OFF") {
                        button.value = "ON";
                        $("#refreshthis").load("caserefresh.php?location=LAGUNA");
                    } else {
                        button.value = "OFF";
                        alert(button.value);
                    }
                }

                $(function() {
                    $('#barangay').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                    });
                });

                $(function() {
                    $("#refreshthis").load("caserefresh.php?location=LAGUNA");
                    $('#graph2').load('ageChart.php?location=LAGUNA');
                    $('#graph1').load('genChart.php?location=LAGUNA');
                    $("#graph3").load("perlocal.php?location=LAGUNA");

                    $("#city").on('change', function() {

                        var selcity = document.getElementById('city');
                        var city = selcity.options[selcity.selectedIndex].value;

                        if (city.includes(" ") && city.includes("%20")) {
                            city = city.replace(" ", "");
                        } else {
                            city = city.replace(" ", "%20");
                        }

                        /* HEADER */
                        /* HEADER */
                        /* HEADER */

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
                        /* HEADER */
                        /* HEADER */
                        /* HEADER */ /* HEADER */ /* HEADER */
                        $('#refreshthis').load('caserefresh.php?location=' + city);
                        $("#graph3").load("perlocal.php?location=" + city);
                        $('#graph2').load('ageChart.php?location=' + city);
                        $('#graph1').load('genChart.php?location=' + city);
                    });

                    $(document).ready(function(e) {
                        $.ajaxSetup({
                            cache: false
                        });
                        setInterval(function() {
                            $('#mcl_timer').load('timer.php');
                        }, 1000);
                    });
                })
            </script>

            </script>
    </body>

    </html>