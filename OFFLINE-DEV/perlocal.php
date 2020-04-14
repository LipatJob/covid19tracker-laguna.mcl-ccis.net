

<?php
  include 'phpcore/connection.php';

  $location = $_GET['location'];
  $header = "";

  $cases = array();
  $recovered = array();
  $deceased = array();
  $rate = array();
  $locals = array();
  $i = 0;

  //$cities = {};
  if($location != "LAGUNA")
  {
      $header = "TOTAL CASES FOR $location";
        
      $string = "SELECT barangay,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(current_pui) AS TOTAL_PUI, sum(current_pum) AS TOTAL_PUM, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history where city_municipality='$location' AND reference_date IN (SELECT MAX(reference_date) from barangay_history where city_municipality='$location') GROUP BY barangay";
      $result1 = mysqli_query($con,$string);
      while($extract = mysqli_fetch_array($result1)){

            $locals[$i] = $extract['barangay'];
            $cases[$i] = $extract['TOTAL_POSITIVE_CASES'];
            $deceased[$i] = $extract['TOTAL_DECEASED'];
            $recovered[$i] = $extract['TOTAL_RECOVERED'];
            $i++;
      }
  }
  else
  {
      $header = "TOTAL CASES PER CITY/MUNICIPALITY";
    $string = "SELECT city_municipality AS city,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(current_pui) AS TOTAL_PUI, sum(current_pum) AS TOTAL_PUM, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history where reference_date IN (SELECT MAX(reference_date) from barangay_history) GROUP BY city_municipality";
          $result1 = mysqli_query($con,$string);

          while($extract = mysqli_fetch_array($result1)){
            $locals[$i] = $extract['city'];
            $cases[$i] = $extract['TOTAL_POSITIVE_CASES'];
            $deceased[$i] = $extract['TOTAL_DECEASED'];
            $recovered[$i] = $extract['TOTAL_RECOVERED'];
            $rate[$i] = $recovered[$i] / $cases[$i] * 100;
            $rate[$i] = number_format($rate[$i], 2, '.', ' ');
            $i++;
          }    
        
        

  }

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

 
 <div class="card card-danger2">
              <div class="card-header">
                <h3 class="card-title" style="color: white;"><?php echo $header?></h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>

  <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>

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
      labels  : [<?php
        $flag = false;
          for($j=0;$j<$i;$j++)
          {
            if($cases[$j]>0||$deceased[$j]>0&&$recovered[$j]>0){
              echo json_encode($locals[$j]);
              echo ",";
            }
          }

        ?>],
      datasets: [
        {
          label               : 'TOTAL POSITIVE CASES',
          backgroundColor     : 'rgba(60,141,188,0.5)',
          borderColor         : 'rgba(60,141,188,0.5)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188, .5)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188, .5)',
          data                : [<?php
            $flag = false;
          for($j=0;$j<$i;$j++)
          {
            if($cases[$j]>0||$deceased[$j]>0&&$recovered[$j]>0&&$rate[$j]>0){
              echo json_encode($cases[$j]);
              echo ",";
            }
          }

        ?>
          ]
        },
        {
          label               : 'DECEASED',
          backgroundColor     : 'rgb(128,128,128,1)',
          borderColor         : 'rgb(128,128,128,1)',
          pointRadius         : true,
          pointColor          : 'rgb(128,128,128,1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgb(128,128,128,1)',
          data                : [<?php
          $flag = false;
          for($j=0;$j<$i;$j++)
          {

            if($cases[$j]>0||$deceased[$j]>0&&$recovered[$j]>0&&$rate[$j]>0){
                echo json_encode($deceased[$j]);
                echo ",";
            } 
          }

        ?>]
        },
        {
          label               : 'RECOVERED',
          backgroundColor     : 'rgba(42, 187, 155, 1)',
          borderColor         : 'rgba(42, 187, 155, 1)',
          pointRadius         : true,
          pointColor          : 'rgba(42, 187, 155, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(42, 187, 155, 1)',
          data                : [<?php
            $flag = false;
          for($j=0;$j<$i;$j++)
          {

            if($cases[$j]>0||$deceased[$j]>0&&$recovered[$j]>0&&$rate[$j]>0){
              echo json_encode($recovered[$j]);
              echo ",";
            }
          }

        ?>]
        },
         {
          label               : 'RECOVERY RATE',
          backgroundColor     : '#94fc03',
          borderColor         : '#94fc03)',
          pointRadius         : true,
          pointColor          : '#94fc03',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: '#94fc03',
          data                : [<?php
            $flag = false;
          for($j=0;$j<$i;$j++)
          {

            if($cases[$j]>0||$deceased[$j]>0&&$recovered[$j]>0&&$rate[$j]>0){
              echo json_encode($rate[$j]);
              echo ",";
            }
          }

        ?>]
        },
      ]
    }
    
    

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }



    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true,
        onClick: function(e, legendItem) {
          var index = legendItem.datasetIndex;
          var ci = this.chart;
          var alreadyHidden = (ci.getDatasetMeta(index).hidden === null) ? false : ci.getDatasetMeta(index).hidden;

          ci.data.datasets.forEach(function(e, i) {
            var meta = ci.getDatasetMeta(i);

            if (i !== index) {
              if (!alreadyHidden) {
                meta.hidden = meta.hidden === null ? !meta.hidden : null;
              } else if (meta.hidden === null) {
                meta.hidden = true;
              }
            } else if (i === index) {
              meta.hidden = null;
            }
          });

          ci.update();
        }
      },
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
    var barChartCanvas = $('#barChart2').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    var temp2 = areaChartData.datasets[2]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0
    barChartData.datasets[2] = temp2

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: areaChartOptions
    })

  })


</script>