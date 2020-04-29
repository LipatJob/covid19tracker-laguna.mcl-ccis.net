<?php
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <link rel="stylesheet" href="css/flexme.css">

    <style>
      
    #title{
        -webkit-box-shadow: 0px 3px 5px 0px rgba(115,113,111,1);
-moz-box-shadow: 0px 3px 5px 0px rgba(115,113,111,1);
box-shadow: 0px 3px 5px 0px rgba(115,113,111,1);
      background-color: #354664;
      color: white;
    }

    #navtop{
      -webkit-box-shadow: 0px 3px 5px 0px rgba(115,113,111,1);
  -moz-box-shadow: 0px 3px 5px 0px rgba(115,113,111,1);
  box-shadow: 0px 3px 5px 0px rgba(115,113,111,1);
      color: white;
    }  

    </style>

    <title>COVID-19: LAGUNA</title>
  </head>
  <body onload="onLoad()">
    <!-- As a link -->
<nav class="navbar navbar-light" id="title">
  <a style="color: white; font-size: 1.3em;">COVID-19 : DASHBOARD</a>
</nav>

<nav id="navtop" class="navbar navbar-expand-md navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarText">
  <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"> Overview <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="cases.php"> Individual Cases </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">  </a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="#"> </a>
      </li>
    </ul>
    <span class="navbar-text">
      last update: 4/5/2020 
    </span>
  </div>
</nav>
    <div class="main-parent-container">
    <div class="parent-container-vertical" style="padding-left: 15px; padding-right: 15px; height: 100%;">
    <div class="parent-container-horizontal">
    <div class="item-container" style="padding-top: 10px;">
    <h1> Individual Cases </h1>
    </div></div>

<div class="card card-warning" >
              <div class="card-header">
                <h3 class="card-title">General Elements</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="parent-container-horizontal">
      
      
                <?php
                
                $msql0 = "SELECT * FROM individual_cases";
                $rsl = mysqli_query($con, $msql0);
				while($extract = mysqli_fetch_array($rsl)){
        				$sum1 = $extract['sum1'];
        				$sum2 = $extract['sum2'];
        				$sum3 = $extract['sum3'];
        				$sum4 = $extract['sum4'];
        				$sum5 = $extract['sum5'];
        				$sum6 = $extract['sum6'];
        				$sum7 = $extract['sum7'];
			
                
                
                
                echo "
                          <div class='card bg-light' style='width: 20%;'>
                        <div class='card-header text-muted border-bottom-0'>
                          Digital Strategist
                        </div>
                        <div class='card-body pt-0'>
                          <div class='row'>
                            <div class='col-7'>
                              <h2 class='lead'><b>Nicole Pearson</b></h2>
                              <p class='text-muted text-sm'><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class='ml-4 mb-0 fa-ul text-muted'>
                                <li class='small'><span class='fa-li'><i class='fas fa-lg fa-building'></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                <li class='small'><span class='fa-li'><i class='fas fa-lg fa-phone'></i></span> Phone #: + 800 - 12 12 23 52</li>
                              </ul>
                            </div>
                            <div class='col-5 text-center'>
                              <img src='../../dist/img/user1-128x128.jpg' alt='' class='img-circle img-fluid'>
                            </div>
                          </div>
                        </div>
                        <div class='card-footer'>
                          <div class='text-right'>
                          </div>
                        </div>
                      </div>
        
                      </div>  
                      </div>
                      <!-- /.card-body -->
                    </div>
            ";
            
            
				}
            
            ?>
    
 
  
    <!-- -->
  </div>
</div>

 
           <

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
  $(function () {
    $('#barangay').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

</script>
  </body>
</html>