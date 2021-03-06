<!doctype html>
<html lang="en">

<head>
    <?php include_once 'template/include_header.php' ?>

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

    #mt {
        font-size: 18;
        border-style: none;
        color: #2D76A8;
        text-align: left;
        border-top: 1px;
        border-bottom: 1px;
        font-weight: 500;
    }

    #mt:hover {
        font-size: 22;
        font-weight: 600;
    }

    #picbox {
        justify-content: space-around;
        border-style: solid;
        border-width: 2px;
        border-color: #095779;

    }

    #picbox:hover {
        border-width: 5px;
        border-color: #095779;
    }
    </style>

    <title>COVID-19 Tracker for LAGUNA</title>
</head>

<body onload="">
    <!-- INCLUDE NAVBAR-->
    <?php include_once 'template/navbar.php' ?>
    
    <div class="main-parent-container">
        <div class="parent-container-vertical" style="padding-left: 15px; padding-right: 15px; height: 100%;">
            <div class="parent-container-horizontal col-sm-12 col-lg-12">
                <div class="item-container col-sm-12 col-lg-12">
                    <!-- START -->
                    <!-- Default box -->
                    <div class="card col-sm-12 col-lg-12" style="height: 100%; ;">
                        <!-- BODY -->


                        <div class="item-container col-sm-12 col-lg-12">
                            <h3 style="color: #333333;  margin: 20px;"><i class="fas fa-user-check"
                                    style="color: #333333;"></i> COVID-19 CASE TRACKER DASHBOARD </h3>
                            <p class="text-muted" style="margin-left: 20px; margin-right: 20px; margin-bottom: 1px;">
                                Resources and official announcements are found from respective city goverment offices
                                and official social media announcement pages.</p>





                            <div class="parent-container-horizontal col-sm-12 col-lg-12"
                                style=" justify-content: space-evenly;">
                                <div class="col-sm-12 col-lg-4" style="padding-top: 15px;">
                                    <div id="picbox" class="card card-danger2">
                                        <img class="img-fluid" style="height: auto;" src="imgs/hotline_01.jpg">
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-4" style="padding-top: 15px;">
                                    <div id="picbox" class="card card-danger2">
                                        <img class="img-fluid" style="height: auto;" id="himg"
                                            src="imgs/hotline_02.jpg">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4" style="padding-top: 15px;">
                                    <div id="picbox" class="card card-danger2">
                                        <img class="img-fluid" style="height: auto;" id="himg"
                                            src="imgs/hotline_03.jpg">
                                    </div>
                                </div>


                            </div>

                            <div class="row col-sm-12 col-lg-12"
                                style="display: flex; justify-content: space-evenly; width: 100%;">
                            </div>

                            <div class="row col-sm-12 col-lg-12"
                                style="display: flex; justify-content: space-evenly; width: 100%;">
                                <a id="mt" href="https://web.facebook.com/mdrrm.alaminos" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Alaminos</a>
                                <a id="mt"
                                    href="https://web.facebook.com/Lokal-na-Pamahalaan-ng-Bayan-ng-Bay-459322491527615"
                                    target="_blank" class="col-sm-12 col-lg-2">Municipality of Bay</a>
                                <a id="mt" href="https://web.facebook.com/pg/CIOBinan" target="_blank"
                                    class="col-sm-12 col-lg-2">City of Binan</a>
                                <a id="mt" href="https://web.facebook.com/pg/ciocabuyaoph" target="_blank"
                                    class="col-sm-12 col-lg-2">City of Cabuyao</a>
                                <a id="mt" href="https://web.facebook.com/IIPESO" target="_blank"
                                    class="col-sm-12 col-lg-2">City of Calamba</a>
                            </div>
                            <div class="row col-sm-12 col-lg-12"
                                style="display: flex; justify-content: space-evenly; width: 100%;">
                                <a id="mt" href="https://www.facebook.com/calauanlgu.gov.ph" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Calauan</a>
                                <a id="mt" href="https://web.facebook.com/profile.php?id=100001231141441&sk=photos"
                                    target="_blank" class="col-sm-12 col-lg-2">Municipality of Cavinti</a>
                                <a id="mt" href="https://www.facebook.com/mayoredwinpangilinan/" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Famy</a>
                                <a id="mt" href="https://www.facebook.com/sandy.laganapan.3" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Kalayaan</a>
                                <a id="mt" href="https://web.facebook.com/municipalityofliliw.laguna.1" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Liliw</a>
                            </div>
                            <div class="row col-sm-12 col-lg-12"
                                style="display: flex; justify-content: space-evenly; width: 100%;">
                                <a id="mt" href="https://web.facebook.com/elbilagunaph" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Los Banos</a>
                                <a id="mt" href="https://www.facebook.com/rhu.luisiana.5" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Luisiana</a>
                                <a id="mt" href="https://web.facebook.com/lumban.laguna.3" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Lumban</a>
                                <a id="mt" href="https://www.facebook.com/rhu.mabitaclaguna/photos_all" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Mabitac</a>
                                <a id="mt" href="https://www.facebook.com/DiscoverMagdalenaPH/" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Magdalena</a>
                            </div>
                            <div class="row col-sm-12 col-lg-12"
                                style="display: flex; justify-content: space-evenly; width: 100%;">
                                <a id="mt" href="https://www.facebook.com/carloclado" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Majayjay</a>
                                <a id="mt" href="https://www.facebook.com/NagcarlanOfficial" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipal of Nagcarlan</a>
                                <a id="mt" href="https://web.facebook.com/mutuk.bagabaldo?sk=photos" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Paete</a>
                                <a id="mt" href="https://web.facebook.com/pambayang.pangkalusugan.3?_rdc=1&_rdr"
                                    target="_blank" class="col-sm-12 col-lg-2">Municipality of Pagsanjan</a>
                                <a id="mt" href="https://web.facebook.com/panguil.laguna.96" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Panguil</a>
                            </div>
                            <div class="row col-sm-12 col-lg-12"
                                style="display: flex; justify-content: space-evenly; width: 100%;">
                                <a id="mt" href="https://www.facebook.com/VinceSoriano2022/" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Pakil</a>
                                <a id="mt" href="https://web.facebook.com/pg/municipalityofpila" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Pila</a>
                                <a id="mt" href="https://www.facebook.com/MunicipalityofRizalLaguna/" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Rizal</a>
                                <a id="mt" href="https://www.facebook.com/spcanticovid.taskforce" target="_blank"
                                    class="col-sm-12 col-lg-2">City of San Pablo</a>
                                <a id="mt" href="https://www.facebook.com/CityofSanPedroOfficial/" target="_blank"
                                    class="col-sm-12 col-lg-2">City of San Pedro</a>


                            </div>
                            <div class="row col-sm-12 col-lg-12"
                                style="display: flex; justify-content: space-evenly; width: 100%;">
                                <a id="mt" href="https://web.facebook.com/pg/SantaCruzLagunaCityhood/photos"
                                    target="_blank" class="col-sm-12 col-lg-2">Municipality of Santa Cruz</a>
                                <a id="mt" href="https://www.facebook.com/MayorCindySML/" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Santa Maria</a>
                                <a id="mt" href="https://web.facebook.com/pg/citygovernmentofsantarosa" target="_blank"
                                    class="col-sm-12 col-lg-2">City of Santa Rosa</a>
                                <a id="mt" href="https://www.facebook.com/SiniloanKongMahal/" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Siniloan</a>
                                <a id="mt" href="https://web.facebook.com/pg/VictoriaCovid19" target="_blank"
                                    class="col-sm-12 col-lg-2">Municipality of Victoria</a>
                            </div>





                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>




        </div>
        <!-- INCLUDE FOOTER -->
        <?php include_once 'template/footer.php' ?>

        
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

        <script>
        jQuery(function($) {
            $(document).ready(function(e) {
                $("#sourcesNav a").addClass("active");
                setInterval(function() {
                    var date = moment(new Date());
                    $('#mcl_timer').html(date.format('dddd, Do of MMMM YYYY | h:mm:ss a'));
                }, 1000);
            });

        })
        </script>
</body>

</html>