<?php
   include 'phpcore/connection.php';
   $location = $_GET['location'];

   $strSum = "SELECT COUNT(age) AS age FROM individual_cases";
   $strage2 = "SELECT COUNT(age) AS age FROM individual_cases WHERE AGE >= 80";
    $strage3 = "SELECT COUNT(city_municipality) AS age FROM individual_cases WHERE AGE = -1";
   if($location!='LAGUNA')
   {
      $strSum .=" WHERE barangay = '$location'";
      $strage2 .=" AND barangay = '$location'";
      $strage3 .=" AND barangay = '$location'";
   }


   $result = mysqli_query($con,$strSum);
   $row = mysqli_fetch_assoc($result);
   $sum = $row['age'];

   $age = array();
   $perage =array();
   $start = 0;
   $end = 9;

   for($i=0;$i<9;$i++){

      if($i!=8)
      {
        $strage1 = "SELECT COUNT(age) AS age FROM individual_cases WHERE AGE BETWEEN '$start' AND '$end'";
        if($location!="LAGUNA")
          $strage1 .= " AND barangay = '$location'";
        $result = mysqli_query($con,$strage1);
        $start = $start + 10;
        $end = $end + 10;
      }
      else
      {
        $result = mysqli_query($con,$strage2);
      }
      $row = mysqli_fetch_assoc($result);
      $age[$i] = $row['age'];
      if($age[$i] == 0)
        $perage[$i] = 0;
      else
        $perage[$i] = number_format($row['age']/$sum*100, 2, '.', '');
  }
  $result = mysqli_query($con,$strage3);
  $row = mysqli_fetch_assoc($result);
  $age[9] = $row['age'];

  if($age[9] == 0)
    $perage[9] = 0;
  else
    $perage[9] = number_format($row['age']/$sum*100, 2, '.', '');

  

?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=XdyGvDXK2CqT96ETs_U89hnjSgfzJdQfn8gQfFo7pzRenkoWNWUYmBd7FC80B1VTLhOEKKXmIP6cgfsKiIUqow" charset="UTF-8"></script><script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=8Kfy1mXCZIbE2oiGl9bh2kwde3Rh16OccRlcRJghLQgL1BjG_YQ38JEs88jUNdfsNPzSmiT1iRSDCHIQt1fraklf8c9sQ4-nKlEkISHcxJeu3lAKPbQh4qdu2yXydySfdMY7538xBULpdjzIasVy1yU7ghaT-vYkuwmEFL0A0Q-HScKwcE-oMUX5-b8qReCa0HwOMj6IPRxg_UktGjjqEuXiUT9LIMp-dBpIpBw31gEuCr_guatqQsC71QmzNjj7HlcjvuXiDwElTCw5P4jF1jV6EAhJwI6JWAHhznQ-sRRYBZoulfPYNrQSA3H5QHwyfwU8QRGXS-H3Ee-7o14RI3pKqdCELqfIIJ2lvhuA-8KKJZlrmje1Xi-bWqvwA1xmkzr29YKoSrSdSEkxMqrAv-0sU7aKajWOoCI-szLqqOLHo1z-g_DWLQ4gs3erm7825m4cDS-GZNuNp2ZHbufdqVTNDCHx_JPZncttc4ATJtIBFJU_hUHY8aSySTsJgvEwizRu0PrKPEYTC3NlHT9j7UBeInffvCfxAvVIPjq09eo" charset="UTF-8"></script>

            <div class="card card-danger2" >
              <div class="card-header">
                <h3 class="card-title" style="color: white;">CASES BY AGE GROUP</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
    </div>


  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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

<!-- page script -->
<script>


  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    //var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    
   
     var areaChartData = {
      labels  : ['0-9 yrs old', '10-19 yrs old', '20-29 yrs old', '30-39 yrs old', '40-49 yrs old', '50-59 yrs old', '60-69 yrs old', '70-79 yrs old', '80+ yrs old', 'NO DATA'],
      datasets: [
        {
          label               : 'AGE GROUPS',
          backgroundColor     : '#4d7bfa',
          borderColor         : '#4d7bfa',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : '#4d7bfa',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: '#4d7bfa',
          data                : [
            <?php
            echo $age[0];
            for($j=1;$j<10;$j++)
            {
              echo ",";
              echo $age[$j];
            }
            ?>
          ]
        }
      ]
    }


    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
        scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
        ticks: {
          beginAtZero: true,
          suggestedMax: 5,
          callback: function(value) {if (value % 1 === 0) {return value;}}
        },
                  gridLines : {
            display : false,
          }
      }]
      }
    
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: areaChartData,
      options: barChartOptions
    })

    
  })
</script>