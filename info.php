<!doctype html>
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

    <title>COVID-19 Tracker for LAGUNA</title>
</head>

<body onload="">
<!-- NAVIGATION BAR -->
    <div class="col col-md-12 col-lg-12 col-sm-12" style="padding: 0px; margin:0px;">
    <nav class="navbar navbar-light" id="title">
        <a style="color: white; font-size: 1.3em; font-weight: 600;">
            <img src="imgs/android-icon-72x72.png" class="logo-image" style="height: 36px; width: 36px; margin-right: 5px; -webkit-box-shadow: 1px 1px 5px 0px rgba(252,247,252,1);
-moz-box-shadow: 1px 1px 5px 0px rgba(252,247,252,1);
box-shadow: 1px 1px 5px 0px rgba(252,247,252,1);">COVID-19 Case Tracker
        </a>
        <div>
            <img src="imgs/DOH.png" class="logo-image" >
            <img src="imgs/DOH_calabarzon.png" class="logo-image" >
            <img src="imgs/mcl.png" class="logo-image" >
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
        <span id="mcl_timer" class="navbar-text" style="font-size: 20px; font-weight: 400; color:black; margin-top: 15px;"></span>
    </ul>
</div>
<!-- END OF NAVIGATION BAR-->
<!-- END OF NAVIGATION BAR-->
     <script>
            //INITIALIZE NAVBAR
            $("#sourcesNav a").addClass("active");
        </script>


    <div class="main-parent-container">
        <div class="parent-container-vertical" style="padding-left: 15px; padding-right: 15px; height: 100%;">

            <!--<div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Note:</h5>
                <p class="text-muted" style="font-size: 20px;">EMERGENCY NUMBERS : <strong>02-894-COVID</strong> and <strong>1555</strong> for PLDT, SMART, SUN and TnT Subscribers are FREE OF CHARGE, both hotlines maybe accessed 24/7.</p>
            </div>-->



            <div class="parent-container-horizontal col-sm-12 col-lg-12">
                <div class="item-container col-sm-12 col-lg-12">
                    <!-- START -->
                        <!-- Default box -->
                        <div class="card col-sm-12 col-lg-12" style="height: 100%; ;">
                            <!-- BODY -->
                            
                            
                            <div class="item-container col-sm-12 col-lg-12">
                                <h3 style="color: #333333;  margin: 20px;"><i class="fas fa-user-check" style="color: #333333;"></i> COVID-19 CASE TRACKER DASHBOARD </h3>
                                <p class="text-muted" style="margin-left: 20px; margin-right: 20px; margin-bottom: 1px;">Resources and official announcements are found from respective city goverment offices and official social media announcement pages.</p>
                            
                            
                            

                            
                                <div class="parent-container-horizontal col-sm-12 col-lg-12"  style=" justify-content: space-around;">
                                                                                <div class="col-sm-12 col-lg-4" style="padding-top: 15px;">
                                                                                    <div class="card card-danger2">
                                                                                        <img class="img-fluid" style="height: auto;" src="imgs/hotline_01.jpg">
                                                                                    </div>
                                                                                </div>
                                                                                                                
                                     <div class="col-sm-12 col-lg-4" style="padding-top: 15px;">
                                                                                    <div class="card card-danger2" >
                                                                                        <img class="img-fluid" style="height: auto;" id="himg" src="imgs/hotline_02.jpg" >
                                                                                    </div>
                                                                                </div>
                                     <div class="col-sm-12 col-lg-4" style="padding-top: 15px;">
                                                                                    <div class="card card-danger2" >
                                                                                        <img class="img-fluid" style="height: auto;" id="himg" src="imgs/hotline_03.jpg">
                                                                                    </div>
                                                                                </div>
                                
                                
                               </div>
                            
                            
                             
                              <div class="row col-sm-12 col-lg-12" style = "display: flex; justify-content: center; text-align: center;" >
                                   <a href="https://web.facebook.com/mdrrm.alaminos" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Alaminos</a>
                                   <a href="https://web.facebook.com/Lokal-na-Pamahalaan-ng-Bayan-ng-Bay-459322491527615" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Bay</a>
                                   <a href="https://web.facebook.com/pg/CIOBinan" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">City of Binan</a>
                                   <a href="https://web.facebook.com/pg/ciocabuyaoph" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">City of Cabuyao</a>
                                   <a href="https://web.facebook.com/IIPESO" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">City of Calamba</a>
                              </div>
                                    <div class="row col-sm-12 col-lg-12" style = "display: flex; justify-content: center; text-align: center;" >
                                   <a href="https://www.facebook.com/calauanlgu.gov.ph" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Calauan</a>
                                   <a href="https://web.facebook.com/profile.php?id=100001231141441&sk=photos" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Cavinti</a>
                                   <a href="https://www.facebook.com/mayoredwinpangilinan/" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Famy</a>
                                   <a href="https://www.facebook.com/sandy.laganapan.3" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Kalayaan</a>
                                   <a href="https://web.facebook.com/municipalityofliliw.laguna.1" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Liliw</a>
                               </div>
                                   <div class="row col-sm-12 col-lg-12" style = "display: flex; justify-content: center; text-align: center;" >
                                   <a href="https://web.facebook.com/elbilagunaph" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Los Banos</a>
                                   <a href="https://www.facebook.com/rhu.luisiana.5" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Luisiana</a>
                                   <a href="https://web.facebook.com/lumban.laguna.3" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Lumban</a>
                                   <a href="https://www.facebook.com/rhu.mabitaclaguna/photos_all" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Mabitac</a>
                                   <a href="https://www.facebook.com/DiscoverMagdalenaPH/" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Magdalena</a>
                             </div>
                                    <div class="row col-sm-12 col-lg-12" style = "display: flex; justify-content: center; text-align: center;" >
                                   <a href="https://www.facebook.com/carloclado" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Majayjay</a>
                                   <a href="https://www.facebook.com/NagcarlanOfficial" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipal of Nagcarlan</a>
                                   <a href="https://web.facebook.com/mutuk.bagabaldo?sk=photos" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Paete</a>
                                   <a href="https://web.facebook.com/pambayang.pangkalusugan.3?_rdc=1&_rdr" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Pagsanjan</a>
                                   <a href="https://web.facebook.com/panguil.laguna.96" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Panguil</a>
                               </div>
                            <div class="row col-sm-12 col-lg-12" style = "display: flex; justify-content: center; text-align: center;" >
                                   <a href="https://www.facebook.com/VinceSoriano2022/" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Pakil</a>
                                   <a href="https://web.facebook.com/pg/municipalityofpila" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Pila</a>
                                   <a href="https://www.facebook.com/MunicipalityofRizalLaguna/" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Rizal</a>
                                   <a href="https://www.facebook.com/spcanticovid.taskforce" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">City of San Pablo</a>
                                   <a href="https://www.facebook.com/CityofSanPedroOfficial/" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">City of San Pedro</a>
                                   
                                   
                            </div>
                               <div class="row col-sm-12 col-lg-12" style = "display: flex; justify-content: center; text-align: center;" >
                                   <a href="https://web.facebook.com/pg/SantaCruzLagunaCityhood/photos" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Santa Cruz</a>
                                   <a href="https://www.facebook.com/MayorCindySML/" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Santa Maria</a>
                                   <a href="https://web.facebook.com/pg/citygovernmentofsantarosa" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">City of Santa Rosa</a>
                                   <a href="https://www.facebook.com/SiniloanKongMahal/" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Siniloan</a>
                                   <a href="https://web.facebook.com/pg/VictoriaCovid19" target="_blank" style = "border-style: solid;" class = "col-sm-12 col-lg-2">Municipality of Victoria</a>
                               </div>
                              

                 


                        </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                </div></div>




    </div>
         <!-- FOOTER -->
         <?php include_once 'phpcore/footer.php' ?>
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