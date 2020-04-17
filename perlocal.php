

<?php
  include 'phpcore/connection.php';

  $location = $_GET['location'];
  $header = "";

  $cases = array();
  $recovered = array();
  $deceased = array();
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
            $i++;
          }    
        
    $max1 = max($cases);
    $max2 = max($deceased);
    $max3 = max($recovered);
    $totalMax = max($max1,$max2,$max3);

    if($totalMax%5==0)
    {
    	$totalMax = $totalMax + 5;
    }
    else
    {
    	$totalMax = (5 - $totalMax%5) + $totalMax; 
    }
  }

?>
 

              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>



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

            if($cases[$j]>0||$deceased[$j]>0&&$recovered[$j]>0){
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

            if($cases[$j]>0||$deceased[$j]>0&&$recovered[$j]>0){
              echo json_encode($recovered[$j]);
              echo ",";
            }
          }

        ?>]
        },
        {
          label               : 'CONFIRMED',
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
            if($cases[$j]>0||$deceased[$j]>0&&$recovered[$j]>0){
              echo json_encode($cases[$j]);
              echo ",";
            }
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
            stacked: true,
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
            stacked: true,
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