<?php
   include 'phpcore/connection.php';

  $location = $_GET['location'];
  $location = str_replace("%20", " ",$location);

  $result = mysqli_query($con,"SELECT MAX(reference_date) AS fdate from barangay_history");
  //$result = mysqli_query($con,"SELECT MAX(ref_date) FROM reference_dates");
  $row = mysqli_fetch_assoc($result);
  //$lDate = $row['fdate'];
  //$prevdate = date('Y-m-d', strtotime('-13 days', strtotime($lDate))); 
  $i = 0;

  //$string = "SELECT reference_date, sum(current_positive_case) AS current,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(current_pui) AS TOTAL_PUI, sum(current_pum) AS TOTAL_PUM, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history ";
  $string = "SELECT reference_date, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history WHERE reference_date >= '2020-03-28' ";
  // $string2 = $string;

  if($location != "LAGUNA")
  {
    // $res = mysqli_query($con,"SELECT MIN(reference_date) AS fdate from barangay_history WHERE city_municipality = '$location'");
    // $row = mysqli_fetch_assoc($res);
    // $firstDate =  $row['fdate'];
    $string.="AND city_municipality = '$location' GROUP BY reference_date";
    //$string2.=" WHERE city_municipality = '$location' AND reference_date = '$firstDate'";
  }
  else
  {
    // $res = mysqli_query($con,"SELECT MIN(reference_date) AS fdate from barangay_history");
    // $row = mysqli_fetch_assoc($res);
    // $firstDate =  $row['fdate'];
    $string.=" GROUP BY reference_date";
    // $string2.=" WHERE reference_date = '$firstDate'";
  }

  // $result1 = mysqli_query($con,$string2);
  // $row = mysqli_fetch_assoc($result1);
  // $dates[$i] = $row['reference_date'];
  // $cases[$i] = $row['TOTAL_POSITIVE_CASES'];
  // $deceased[$i] = $row['TOTAL_DECEASED'];
  // $recovered[$i] = $row['TOTAL_RECOVERED'];
  // $current[$i] = $row['current'];
  // $i++;

  $result2 = mysqli_query($con,$string);
    while($extract = mysqli_fetch_array($result2)){
      $dates[$i] = $extract['reference_date'];
      $recovered[$i] = $extract['TOTAL_RECOVERED'];
      $i++;
    }


?>


  <div class="card card-danger2">
              <div class="card-header">
                <h3 class="card-title" style="color: white;">RECOVERY PER DATE</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="recovChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
  </div>

  
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>

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
      labels  : [<?php
        echo json_encode($dates[0]);
          for($j=1;$j<$i;$j++)
          {
            echo ",";
            echo json_encode($dates[$j]);
          }

        ?>],
      datasets: [
        {
          label               : 'RECOVERED',
          type: 'bar',
          backgroundColor     : 'rgba(42, 187, 155, 1)',
          borderColor         : 'rgba(42, 187, 155, 1)',
          pointRadius         : true,
          pointColor          : 'rgba(42, 187, 155, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(42, 187, 155, 1)',
          data                : [<?php
            echo $recovered[0];
          for($j=1;$j<$i;$j++)
          {
            $x = $j - 1;
            echo ",";
            echo  $recovered[$j] - $recovered[$x];
          }

        ?>]
        }
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


    var lineChartCanvas = $('#recovChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })

    
  })
</script>