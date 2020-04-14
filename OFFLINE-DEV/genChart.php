<?php
   include 'phpcore/connection.php';
   $location = $_GET['location'];
   $strfem = "SELECT COUNT(gender) AS fem FROM individual_cases WHERE gender =  'F'";
   $strmale = "SELECT COUNT(gender) AS male FROM individual_cases WHERE gender =  'M'";
   $strnp = "SELECT COUNT(gender) AS male FROM individual_cases WHERE gender =  '*NOT SPECIFIED'";

   if($location!='LAGUNA')
   {
      $strfem .=" AND barangay = '$location'";
      $strmale .=" AND barangay = '$location'";
      $strnp .=" AND barangay = '$location'";
   }


   $result = mysqli_query($con,$strfem);
   $row = mysqli_fetch_assoc($result);
   $fem = $row['fem'];

   $result = mysqli_query($con,$strmale);
   $row = mysqli_fetch_assoc($result);
   $male = $row['male'];
   
   $result = mysqli_query($con,$strnp);
   $row = mysqli_fetch_assoc($result);
   $np = $row['male'];

   $genSum = $male + $fem + $np;

   if($male == 0)
    $permale = 0;
   else
     $permale = number_format($male/$genSum*100, 2, '.', '');
   if($fem==0)
    $perfem = 0;
   else
    $perfem = number_format($fem/$genSum*100, 2, '.', '');
    
   if($np==0)
    $pernp = 0;
   else
    $pernp = number_format($np/$genSum*100, 2, '.', '');

  

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

   <div class="card card-danger2">
              <div class="card-header">
                <h3 class="card-title" style="color: white;"></i>CASES BY GENDER</h3>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
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
    
    var donutData        = {
      labels: [
          'MALE: <?php echo $permale?>% ', 
          'FEMALE: <?php echo $perfem?>% ',
          'NOT SPECIFIED: <?php echo $pernp?>% ',
      ],
      datasets: [
        {
          data: [<?php
            echo $male . "," . $fem . "," . $np;
           ?>],
          backgroundColor : ['#3c4ef0', '#ed54f0','#948e8e'],
        }
      ]
    }

    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })

  
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
	
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })
	
	
	var mypiechart = document.getElementById("pieChart");

	    mypiechart.onclick = function(evt) {
      var activePoints = pieChart.getElementsAtEvent(evt);
      if (activePoints[0]) {
        var chartData = activePoints[0]['_chart'].config.data;
        var idx = activePoints[0]['_index'];
        var dIndex = pieChart.getDatasetAtEvent(evt)[0]._datasetIndex;

        var label = chartData.labels[idx];
        var value = chartData.datasets[dIndex].data[idx];
        
        
		var $_GET = <?php echo json_encode($_GET); ?>;

        var url = "http://example.com/?label=" + label + "&value=" + value;
		$('#refreshthis').load('caserefresh.php?location='+city);
        console.log(url);
		var storethis = $_GET['location'];
		alert(storethis);
        alert(url);
      }
	  
	  
    }


    
  })
</script>