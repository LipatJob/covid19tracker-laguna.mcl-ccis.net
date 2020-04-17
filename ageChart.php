<?php
   include 'phpcore/connection.php';
   $location = $_GET['location'];

   $strage2 = "SELECT COUNT(age) AS age, case_status FROM individual_cases WHERE AGE >= 80 ";
   $strage3 = "SELECT COUNT(city_municipality) AS age, case_status FROM individual_cases WHERE AGE = -1 ";
    
  
   if($location!='LAGUNA')
   {
      $strage2 .="AND barangay = '$location' GROUP BY case_status";
      $strage3 .="AND barangay = '$location' GROUP BY case_status";
   }
   else
   {
      $strage2 .="GROUP BY case_status";
      $strage3 .="GROUP BY case_status";
   }
   

   $age = array();
   $current = array();
   $recovered = array();
   $deceased = array();
   $total = 0;
   $perCur = array();
   $perDec = array();
   $perRec = array();

   $start = 0;
   $end = 9;

   for($i=0;$i<9;$i++){

      if($i!=8)
      {
        $strage1 = "SELECT COUNT(age) AS age, case_status FROM individual_cases WHERE AGE BETWEEN '$start' AND '$end' ";
        if($location!="LAGUNA")
          $strage1 .= "AND barangay = '$location' GROUP BY case_status";
        else
          $strage1 .= "GROUP BY case_status";
          
        $result = mysqli_query($con,$strage1);
        $start = $start + 10;
        $end = $end + 10;
      }
      else
      {
        $result = mysqli_query($con,$strage2);
      }
      
     while($extract = mysqli_fetch_array($result)){
        
      if($extract['case_status']=='CONFIRMED')
        $current[$i] = $extract['age'];     
      if($extract['case_status']=='DECEASED')
        $deceased[$i] = $extract['age'];
      if($extract['case_status']=='RECOVERED')    
        $recovered[$i] = $extract['age'];
        
      $age[$i] = $deceased[$i] + $recovered[$i] + $current[$i];
      $total = $total + $age[$i];
     }
 
  }
    $result = mysqli_query($con,$strage3);
  while($extract = mysqli_fetch_array($result)){
        
      if($extract['case_status']=='CONFIRMED')
        $current[9] = $extract['age'];     
      if($extract['case_status']=='DECEASED')
        $deceased[9] = $extract['age'];
      if($extract['case_status']=='RECOVERED')    
        $recovered[9] = $extract['age'];
        
      $age[9] = $deceased[$i] + $recovered[$i] + $current[$i];
     }
     
     
     for($x = 0; $x<10; $x++)
    {
        if($current[$x] == 0)
            $perCur[$x] = 0;
        else
        {
            $perCur[$x] = number_format($current[$x]/$age[$x]*100, 2, '.', '');
        }
            
        if($recovered[$x] == 0)
            $perRec[$x] = 0;
        else
            $perRec[$x] = number_format($recovered[$x]/$age[$x]*100, 2, '.', '');
        
        if($deceased[$x] == 0)
            $perDec[$x] = 0;
        else
            $perDec[$x] = number_format($deceased[$x]/$age[$x]*100, 2, '.', '');
            
    }

?>


            <div class="card card-danger2" >
              <div class="card-header">
                <h3 class="card-title" style="color: white;">CASES BY AGE GROUP</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
      labels  : ['0-9 yrs old', '10-19 yrs old', '20-29 yrs old', '30-39 yrs old', '40-49 yrs old', '50-59 yrs old', '60-69 yrs old', '70-79 yrs old', '80+ yrs old', 'NOT SPECIFIED'],
      datasets: [
        {
          label               : 'RECOVERED',
          backgroundColor     : 'rgba(42, 187, 155, 1)',
          borderColor         : 'rgb(128,128,128,1)',
          pointRadius          : false,
          pointColor          : 'rgba(42, 187, 155, 1)',
          pointStrokeColor    : 'rgba(42, 187, 155, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(42, 187, 155, 1)',
          data                : [
            <?php
            echo $perRec[0];
            for($j=1;$j<10;$j++)
            {
              echo ",";
              echo $perRec[$j];
            }
            ?>
          ]
        },
         {
          label               : 'DECEASED',
          backgroundColor     : 'rgb(128,128,128,1)',
          borderColor         : 'rgb(128,128,128,1)',
          pointRadius          : false,
          pointColor          : 'rgb(128,128,128,1)',
          pointStrokeColor    : '#4d7bfa',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgb(128,128,128,1)',
          data                : [
            <?php
            echo $perDec[0];
            for($j=1;$j<10;$j++)
            {
              echo ",";
              echo $perDec[$j];
            }
            ?>
          ]
        },
        {
          label               : 'CONFIRMED',
          backgroundColor     : 'rgba(60,141,188,0.5)',
          borderColor         : 'rgba(60,141,188,0.5)',
          pointRadius          : false,
          pointColor          : 'rgba(60,141,188,0.5)',
          pointStrokeColor    : 'rgba(60,141,188,0.5)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,0.5)',
          data                : [
            <?php
            echo $perCur[0];
            for($j=1;$j<10;$j++)
            {
              echo ",";
              echo $perCur[$j];
            }
            ?>
          ]
        },
         
         {
          label               : 'Total',
          backgroundColor     : 'rgb(128,128,128,1)',
          borderColor         : 'rgb(128,128,128,1)',
          pointRadius          : false,
          pointColor          : 'rgb(128,128,128,1)',
          pointStrokeColor    : '#4d7bfa',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgb(128,128,128,1)',
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

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
     legend: {
        labels: {
         filter: function(item, chart) {
                    // Logic to remove a particular legend item goes here
                    return !item.text.includes('Total');
                }
            }
     },
      datasetFill             : false,
              tooltips: {
                mode: 'label',
                callbacks: {
                label: function(tooltipItem, data) {
          	                return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]+ '%';
                    },
                afterLabel: function(tooltipItem, data) {
          	                return "COUNT: " + Math.round(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]*data.datasets[3].data[tooltipItem.index]/100);
                    }
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
           min: 0,
           suggestedMax: 5,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       },
                  gridLines : {
            display : false,
          }
      }]
      }
    
    }

    
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, areaChartData)
    

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar', 
      data: stackedBarChartData,
      options: barChartOptions
    })

    stackedBarChart.getDatasetMeta(3).hidden=true;
    stackedBarChart.defaults.global.legend[3].display = false
    stackedBarChart.update();
  })
</script>