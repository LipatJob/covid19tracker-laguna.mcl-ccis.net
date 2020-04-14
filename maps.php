<html>
<head>

<?php include_once 'phpcore/include_header.php' ?>
<style>
    body{
        overflow: hidden;
    }
    
    .footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: red;
   color: white;
   text-align: center;
}

</style>

</head>
<body>
    <!-- INCLUDE NAVBAR-->
    <?php include("navbar.php") ?>
    </div>
    <!-- END OF NAVIGATION BAR-->
   
    <div class="col col-sm-12">
        <div class="card card-danger2" style="height: 900px; width: 100%; padding: 10px; margin-top: -10px;">
        <?php include_once 'MyNewMap.php' ?>
        </div>
    </div>

      <!-- INCLUDE FOOTER-->

        <!-- END OF FOOTER-->


  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
        <!-- END OF SCRIPTS-->
    </body>
    </html>