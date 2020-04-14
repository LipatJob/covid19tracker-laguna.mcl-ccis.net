<html>
<head>

<?php include_once 'phpcore/include_header.php' ?>
<style>
    body{
        overflow: hidden;
    }
</style>

</head>
<body>
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php" style="font-size: 20px; font-weight: bold;"> Overview <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="individual.php" style="font-size: 20px; font-weight: 500;"> Individual Cases </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="info.php" style="font-size: 20px; font-weight: 500;"> Sources </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> </a>
                </li>
                
            </ul>
            <span id="mcl_timer" class="navbar-text" style="font-size: 20px; font-weight: 400; color:black;"></span>
            
            
        </div>
    </nav>
    <!-- END OF NAVIGATION BAR-->
   
    <div class="col col-sm-12">
        <div class="card card-danger2" style="height: 60%; width: 80%; padding: 10px; margin-top: -10px;">
        <?php include_once 'MyNewMap.php' ?>
        </div>
    </div>

    <div class="col col-sm-12">
        <div class="card card-danger2" style="height: 20%; width: 80%; padding: 10px;">

        <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light" >
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Estimated budget</span>
                      <span class="info-box-number text-center text-muted mb-0">2300</span>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Estimated budget</span>
                      <span class="info-box-number text-center text-muted mb-0">2300</span>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Estimated budget</span>
                      <span class="info-box-number text-center text-muted mb-0">2300</span>
                    </div>
                  </div>
                </div>
        <div class="row">
        </div>
    </div>



 





    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script>
	 $(function() {  

	 	 $("#mapz").load("MyNewMap.php");
     
       });
     </script> 
        <!-- END OF SCRIPTS-->
    </body>
    </html>