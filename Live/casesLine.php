<?php
   include 'phpcore/connection.php';

  $location = $_GET['location'];
  $location = str_replace("%20", " ",$location);

  //$result = mysqli_query($con,"SELECT MAX(reference_date) AS fdate from barangay_history");
  //$row = mysqli_fetch_assoc($result);
  //$lDate = $row['fdate'];
  //$prevdate = date('Y-m-d', strtotime('-13 days', strtotime($lDate))); 
  $i = 0;

  $string = "SELECT reference_date, sum(current_positive_case) AS current,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(current_pui) AS TOTAL_PUI, sum(current_pum) AS TOTAL_PUM, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history ";
  //$string = "SELECT reference_date, sum(current_positive_case) AS current,sum(total_positive_cases) AS TOTAL_POSITIVE_CASES, sum(current_deceased) AS TOTAL_DECEASED, sum(current_recovered) AS TOTAL_RECOVERED, sum(PROBABLE_PUI, SUSPECT_PUI) AS TOTAL_PUI, sum(current_recovered) AS TOTAL_RECOVERED from barangay_history ";
  // $string2 = $string;

  if($location != "LAGUNA")
  {
    // $res = mysqli_query($con,"SELECT MIN(reference_date) AS fdate from barangay_history WHERE city_municipality = '$location'");
    // $row = mysqli_fetch_assoc($res);
    // $firstDate =  $row['fdate'];
    $string.="WHERE city_municipality = '$location' GROUP BY reference_date";
    //$string2.=" WHERE city_municipality = '$location' AND reference_date = '$firstDate'";
  }
  else
  {
    // $res = mysqli_query($con,"SELECT MIN(reference_date) AS fdate from barangay_history");
    // $row = mysqli_fetch_assoc($res);
    // $firstDate =  $row['fdate'];
    $string.="WHERE reference_date >= '2020-03-20' GROUP BY reference_date";
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
      $cases[$i] = $extract['TOTAL_POSITIVE_CASES'];
      $deceased[$i] = $extract['TOTAL_DECEASED'];
      $recovered[$i] = $extract['TOTAL_RECOVERED'];
      $current[$i] = $extract['current'];
      $i++;
    }


?>


  <div class="card card-danger2">
              <div class="card-header">
                <h3 class="card-title" style="color: white;">CASES PER DATE</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
  </div>

  


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
          label               : 'TOTAL POSITIVE CASES',
          backgroundColor     : 'rgba(60,141,188,0.5)',
          borderColor         : 'rgba(60,141,188,0.5)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188, .5)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188, .5)',
          data                : [<?php
          echo json_encode($cases[0]);
          for($j=1;$j<$i;$j++)
          {
            echo ",";
            echo json_encode($cases[$j]);
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
            echo $deceased[0];
          for($j=1;$j<$i;$j++)
          {
            echo ",";
            echo $deceased[$j];
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
            echo $recovered[0];
          for($j=1;$j<$i;$j++)
          {
            echo ",";
            echo $recovered[$j];
          }

        ?>]
        },
          {
          label               : 'ACTIVE CASES',
          backgroundColor     : 'rgb(0,128,128,1)',
          borderColor         : 'rgb(0,128,128,1)',
          pointRadius         : true,
          pointColor          : 'rgb(0,128,128,1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgb(0,128,128,1)',
          data                : [<?php
            echo $current[0];
          for($j=1;$j<$i;$j++)
          {
            echo ",";
            echo $current[$j];
          }

        ?>]
        },
      ]
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
          var flag = false;

          ci.data.datasets.forEach(function(e, i) {
            var meta = ci.getDatasetMeta(i);

            if (i !== index) {
              if (!alreadyHidden) {
                meta.hidden = meta.hidden === null ? !meta.hidden : null;
              } else if (meta.hidden === null) {
                meta.hidden = null;
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


    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartData.datasets[2].fill = false;
    lineChartData.datasets[3].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })

    
  })
</script>