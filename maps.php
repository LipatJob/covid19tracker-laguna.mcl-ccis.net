<html>
<head>

<?php include_once 'phpcore/include_header.php';

include 'phpcore/connection.php';
$rx = mysqli_query($con,"SELECT MAX(reference_date) as TIME_UPDATE from barangay_history");
while($time_update = mysqli_fetch_array($rx)){
    $last_update = date('F j, Y',strtotime($time_update['TIME_UPDATE']));
}
 ?>   
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
    
    #title_header{
        font-size: 22 !important;
        font-weight: 530 !important;
        font-size: 22 !important;
    }
                
    </style>
    <!-- END OF STYLES-->
</head>
<?php
$rx = mysqli_query($con,"SELECT MAX(reference_date) as TIME_UPDATE from barangay_history");
while($time_update = mysqli_fetch_array($rx)){
    $last_update = date('F j, Y',strtotime($time_update['TIME_UPDATE']));
}?>
<body>
   <!-- INCLUDE NAVBAR-->
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
     <script>
            //INITIALIZE NAVBAR
            $("#individualNav a").addClass("active");
        </script>

<!-- END OF NAVIGATION BAR-->
    
    <!-- MAIN CONTENT-->
    <div class="content container-fluid">
        <!-- Title bar and city/municipality selector -->
        <div class="container-fluid" >
            <div class="row">
                <div class=" col-lg-7 col-md-5 col-sm-7">
                <div style="width: 100%:"><h4 id="title_header" style="margin-left: 15px;"> Region IV-A: Province of Laguna <br> <h6 style="margin-left: 15px; font-weight: 400; " >SUMMARY AS OF  <?php echo $last_update?></h6></h4> </div></div>
                <div class=" col-lg-5 col-md-7 col-sm-5">
                <div style="align: justify;">&nbsp;<i class="fa fa-map-marker-alt" style="color: #195387; height: 22px; width: 22px;"></i>Click a blue marker to zoom in and view Covid-19 data for each locality.<br><img src="imgs/marker.png" alt="Individual" height="24" width="20">&nbsp; Click inside the circumference of the circle to view individual cases. </div> 
                </div>
                
                </div>
            </div>
            </div>
            
            <!-- Counts-->
            <div class="container-fluid" id="divCount">
                <div class="row">

                </div>
            </div>

    <!-- END OF NAVIGATION BAR-->
    <div class="container-fluid" >
         <div class="card card-danger2" style="height: 69%; width: 100%; padding: 10px; margin: 5px; margin-left: 0px; margin-right: 0px">
            <?php include_once 'MapWithLoop.php' ?>
        </div>
        </div>   </div> 
  <!-- INCLUDE FOOTER-->
        <?php include("phpcore/footer.php") ?>
        
        


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-map-marked-alt" style="color: #195387;"></i> MAP Instructions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="font-size: 16px;  text-align: justify">
       A quick view of the Total Covid Cases of each City/Municipality pops out as you hover your mouse/finger in each of the blue marker on the map <br><br>

<i class="fa fa-map-marker-alt" style="color: #195387; height: 24px; width: 24px;"></i>Click a blue marker to zoom in and view Covid-19 data including Total Cases, PUI's, deaths and Recovery Rate of specific City/Municipality<br><br>

<img src="imgs/marker.png" alt="Individual" height="24" width="20"> To view Individual Covid Cases per City/Municipality, click inside the circumference of the circle around each marker.
 Circumference of colored circles graphically indicates the total cases per city/municipality. <br><br>
 
 <i class="fa fa-check" style="color: #009CDE;"></i> It is advisable to click each marker to zoom in circles you wish to click<br><br>


<i class="fa fa-hand-pointer"></i> Double tap anywhere in the map to zoom in and out, or use the two-finger gesture to zoom in or out more. You may also use the (+) and (-) buttons found at the upper left corner of the map
<br><br>
Tap anywhere in the map to re-center the map, or click the recenter button when the gesture is unavailable in your smart phones.<br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

        
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="jquery183.js"></script>
 <script>
            jQuery(function($) {  
          
                $(document).ready(function(e) {
                    $.ajaxSetup({cache:false});
                    setInterval(function() {
                        $('#mcl_timer').load('timer.php');
                    },1000);
                });
                
            })
        </script>
<script>
    $('p a').tooltip().eq(0).tooltip('show').tooltip('disable').one('mouseout', function() {
  $(this).tooltip('enable');
});

setTimeout(function() {
 $('#tooltip').tooltip().eq(0).tooltip('hide').tooltip('enable');
}, 5000);
</script>

<script>// script ito for detecting the screensize oke
$(document).ready(function(){
    $(window).on('resize',function(){
       var winWidth =  $(window).width();
       if(winWidth < 768 ){
          console.log('Window Width: '+ winWidth + 'class used: col-xs');
           document.getElementById("txte").style.cssFloat = "left";
           document.getElementById("title_header").style.fontSize = "23";
       }else if( winWidth <= 991){
          console.log('Window Width: '+ winWidth + 'class used: col-sm');
          document.getElementById("title_header").style.fontSize = "23";
       }else if( winWidth <= 1199){
          console.log('Window Width: '+ winWidth + 'class used: col-md');
          document.getElementById("title_header").style.fontSize = "20";
          document.getElementById("title_header").style.fontStyle = "bold";
       }else{
          console.log('Window Width: '+ winWidth + 'class used: col-lg');
          document.getElementById("title_header").style.fontSize = "20";
          document.getElementById("title_header").style.fontStyle = "bold";
          
       }
    });
});
    </script>    

        <!-- END OF SCRIPTS-->
    </body>
    </html>