<?php
   include 'phpcore/connection.php';

  $location = $_GET['location'];
  $location = str_replace("%20", " ",$location);

  //$result = mysqli_query($con,"SELECT MAX(reference_date) AS fdate from barangay_history");
  //$row = mysqli_fetch_assoc($result);
  //$lDate = $row['fdate'];
  //$prevdate = date('Y-m-d', strtotime('-13 days', strtotime($lDate))); 
  $i = 0;
$dates = array();
$pui = array();
$pum = array();
  $string = "SELECT reference_date, sum(current_pum) AS PUM,sum(current_pui) AS PUI from barangay_history WHERE reference_date >= '2020-03-20' ";
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
    $string.="GROUP BY reference_date";
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
      $pui[$i] = $extract['PUI'];
      $i++;
    }


?>


  <div class="card card-danger2">
              <div class="card-header">
                <h3 class="card-title" style="color: white;">PUI PER DATE</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
          label               : 'PUI',
          type                : 'bar',
          backgroundColor     : '#ff6a00',
          borderColor         : '#ff6a00',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : '#ff6a00',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: '#ff6a00',
          data                : [<?php
          echo json_encode($pui[0]);
          for($j=1;$j<$i;$j++)
          {
            echo ",";
            echo json_encode($pui[$j]);
          }

        ?>
          ]
        }
      ]
    }


    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
      	labels: {
         filter: function(item, chart) {
                    // Logic to remove a particular legend item goes here
                    return !item.text.includes('line');
                }
            },
        onClick: function(e, legendItem) {

          var index = legendItem.datasetIndex;
          var ci = this.chart;
          var alreadyHidden = (ci.getDatasetMeta(index).hidden === null) ? false : ci.getDatasetMeta(index).hidden;
          var flag = false;

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


    var lineChartCanvas = $('#lineChart2').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })
    lineChartOptions.le
    
  })
</script>