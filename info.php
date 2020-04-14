<?php
?>
<!doctype html>
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

    <meta charset="euc-jp">
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- DataTables -->
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

        html {
        -webkit-text-size-adjust: 100%;
        }

        #itemC:hover {
            -webkit-box-shadow: 0px 0px 19px 0px rgba(24, 156, 217, 1);
            -moz-box-shadow: 0px 0px 19px 0px rgba(24, 156, 217, 1);
            box-shadow: 0px 0px 19px 0px rgba(24, 156, 217, 1);
        }

        #itemC {
            margin-top: 5px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>

    <title>COVID-19 Tracker for LAGUNA</title>
</head>

<body onload="">
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
                <li class="nav-item ">
                    <a class="nav-link" href="index.php" style="font-size: 20px; font-weight: 500;"> Overview </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="individual.php" style="font-size: 20px; font-weight: 500;"> Individual Cases </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="info.php" style="font-size: 20px; font-weight: bold;"> Sources <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> </a>
                </li>
                
            </ul>
            <span id="mcl_timer" class="navbar-text" style="font-size: 20px; font-weight: 400; color:black;"></span>
            
            
        </div>
    </nav>
    <!-- END OF NAVIGATION BAR-->
    <!-- As a link -->
    <!-- As a link -->
    <!-- As a link -->


    <div class="main-parent-container">
        <div class="parent-container-vertical" style="padding-left: 15px; padding-right: 15px; height: 100%;">
            <div class="parent-container-horizontal">
                <div class="item-container" style="padding-top: 10px;">
                    <h1> </h1>
                </div>
            </div>


            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Note:</h5>
                <p class="text-muted" style="font-size: 20px;">EMERGENCY NUMBERS : <strong>02-894-COVID</strong> and <strong>1555</strong> for PLDT, SMART, SUN and TnT Subscribers are FREE OF CHARGE, both hotlines maybe accessed 24/7.</p>
            </div>



            <div class="parent-container-horizontal">
                <div class="item-container" style="flex-grow: 3;">
                    <!-- START -->
                    <section class="content">
                        <!-- Default box -->
                        <div class="card" style="height: 100%;">

                            <div class="card-header">
                                <h3 class="card-title">List of Sources</h3>

                            </div>
                            <!-- BODY -->

                            <div class="item-container" style="margin: 20px; padding: 20px; margin-bottom:0px">
                                <h3 style="color: #333333;"><i class="fas fa-user-check" style="color: #333333;"></i> COVID-19 CASE TRACKER DASHBOARD </h3>
                                <p class="text-muted">Resources and official announcements are found from respective city goverment offices and official social media announcement pages.</p>

                            </div>

                            <table style="width:95%; padding: 20px; margin: 16px;  justify: center;">
                                <tr>
                                    <th style="width: 40%; font-size: 18; letter-spacing: 2px;"> Offices and Sources </th>
                                    <th style="width: 20%; font-size: 18; letter-spacing: 2px;"> Links </th>
                                    <th style="width: 40%; font-size: 18; letter-spacing: 2px;"> Hotline </th>
                                </tr>

                                <tr>
                                    <td>Provincial Government of Laguna</td>
                                    <td><a href="https://www.facebook.com/GovRamil/" target="_blank">Social Media</a></td>
                                    <td>(049) 501 6534</td>
                                </tr>
                                <tr>
                                    <td>Department of Health Calabarzon</td>
                                    <td><a href="https://www.facebook.com/dohro4a/" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>


                                <tr>
                                    <td>Municipality of Alaminos</td>
                                    <td><a href="https://web.facebook.com/mdrrm.alaminos" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>
                                <tr>
                                    <td>Municipality of Bay</td>
                                    <td><a href="https://web.facebook.com/Lokal-na-Pamahalaan-ng-Bayan-ng-Bay-459322491527615" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>
                                <tr>
                                    <td>City of Binan</td>
                                    <td><a href="https://web.facebook.com/pg/CIOBinan" target="_blank">Social Media</a></td>
                                    <td>(049) 513 5028 </td>
                                <tr>
                                    <td>City of Cabuyao</td>
                                    <td><a href="https://web.facebook.com/pg/ciocabuyaoph" target="_blank">Social Media</a></td>
                                    <td> (049) 502 6760 </td>
                                </tr>
                                <tr>
                                    <td>City of Calamba</td>
                                    <td><a href="https://web.facebook.com/IIPESO" target="_blank">Social Media</a></td>
                                    <td>(+49) 5456 789</td>
                                </tr>
                                <tr>
                                    <td>Municipality of Calauan</td>
                                    <td><a href="https://www.facebook.com/calauanlgu.gov.ph" target="_blank">Social Media</a></td>
                                    <td>(049) 543 6927</td>
                                </tr>
                                <tr>
                                    <td>Municipality of Cavinti</td>
                                    <td><a href="https://web.facebook.com/profile.php?id=100001231141441&sk=photos" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>
                                <tr>
                                    <td>Municipality of Famy</td>
                                    <td><a href="https://www.facebook.com/mayoredwinpangilinan/" target="_blank">Social Media</a></td>
                                    <td>501-7733</td>
                                </tr>
                                <tr>
                                    <td>Municipality of Kalayaan</td>
                                    <td><a href="https://www.facebook.com/sandy.laganapan.3" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                    
                                </tr>
                                <tr>
                                    <td>Municipality of Liliw</td>
                                    <td><a href="https://web.facebook.com/municipalityofliliw.laguna.1" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>
                                <tr>
                                    <td>Municipality of Los Banos</td>
                                    <td><a href="https://web.facebook.com/elbilagunaph" target="_blank">Social Media</a></td>
                                    <td>(049) 530 2818</td>
                                </tr>
                                <tr>
                                    <td>Municipality of Luisiana</td>
                                    <td><a href="https://www.facebook.com/rhu.luisiana.5" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>
                                <tr>
                                    <td>Municipality of Lumban</td>
                                    <td><a href="https://web.facebook.com/lumban.laguna.3" target="_blank">Social Media</a></td>
                                    <td>(049) 250-5998 / 0918-224-7570 / 0917-506-6095</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Mabitac</td>
                                    <td><a href="https://www.facebook.com/rhu.mabitaclaguna/photos_all" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Magdalena</td>
                                    <td><a href="https://www.facebook.com/DiscoverMagdalenaPH/" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Majayjay</td>
                                    <td><a href="https://www.facebook.com/carloclado" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>
                                <tr>
                                    <td>Municipal of Nagcarlan</td>
                                    <td><a href="https://www.facebook.com/NagcarlanOfficial" target="_blank">Social Media</a></td>
                                    <td>0945-996-8898 / 0961-574-8748 / 530-6844 / 572-3979</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Paete</td>
                                    <td><a href="https://web.facebook.com/mutuk.bagabaldo?sk=photos" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Pagsanjan</td>
                                    <td><a href="https://web.facebook.com/pambayang.pangkalusugan.3?_rdc=1&_rdr" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Pakil</td>
                                    <td><a href="https://www.facebook.com/VinceSoriano2022/" target="_blank">Social Media</a></td>
                                    <td>(049) 557-1766 / (+639) 952-2661</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Panguil</td>
                                    <td><a href="https://web.facebook.com/panguil.laguna.96" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>
                                <tr>
                                    <td>Municipality of Pila</td>
                                    <td><a href="https://web.facebook.com/pg/municipalityofpila" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>


                                <tr>
                                    <td>Municipality of Rizal</td>
                                    <td><a href="https://www.facebook.com/MunicipalityofRizalLaguna/" target="_blank">Social Media</a></td>
                                    <td>(049) 521 0672</td>
                                </tr>
                                <tr>
                                    <td>City of San Pablo</td>
                                    <td><a href="https://www.facebook.com/spcanticovid.taskforce" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>


                                <tr>
                                    <td>City of San Pedro</td>
                                    <td><a href="https://www.facebook.com/CityofSanPedroOfficial/" target="_blank">Social Media</a></td>
                                    <td>808-2020</td>
                                </tr>

                                <tr>
                                    <td>City Municipality of Santa Cruz</td>
                                    <td><a href="https://web.facebook.com/pg/SantaCruzLagunaCityhood/photos" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Santa Maria</td>
                                    <td><a href="https://www.facebook.com/MayorCindySML/" target="_blank">Social Media</a></td>
                                    <td>(049) 501 1611</td>
                                </tr>

                                <tr>
                                    <td>City of Santa Rosa</td>
                                    <td><a href="https://web.facebook.com/pg/citygovernmentofsantarosa" target="_blank">Social Media</a></td>
                                    <td>(049) 530 0015</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Siniloan</td>
                                    <td><a href="https://www.facebook.com/SiniloanKongMahal/" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>

                                <tr>
                                    <td>Municipality of Victoria</td>
                                    <td><a href="https://web.facebook.com/pg/VictoriaCovid19" target="_blank">Social Media</a></td>
                                    <td>Not Specified</td>
                                </tr>

                  </table>



                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                </div>




                <div class="item-container" style="width: 20%">
                    <!-- KANAN -->
                    <div class="card card-danger2">
                        <div class="card-header">
                            <h3 class="card-title" style="color: white">Other Official Sources</h3>
                            <div class="card-tools">
                            </div>
                            <!-- /.card-header -->




                            <!-- /ITEM -->



                            <!-- /ITEM -->




                            <!-- /ITEM -->


                        </div>
                        <!-- /.card-body -->


                    </div>
                    <!-- /.card-footer -->
                </div>



            </div><!-- KANAN itemcontainer-->

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
                $('').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                });
            </script>
            <script>
                 $(function() {  
                
                    $(document).ready(function(e) {
                    $.ajaxSetup({cache:false});
                    setInterval(function() {
                        $('#mcl_timer').load('timer.php');
                    },1000);
                });
                
            })
        </script>
</body>

</html>