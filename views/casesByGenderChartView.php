<?php
include "../repository/cachedqueries.php";
$data = getCachedCasesByGender($_GET["location"]);
?>
<div class="card card-danger2">
    <div class="card-header">
        <h3 class="card-title" style="color: white;"></i>CASES BY GENDER</h3>
    </div>
    <div class="card-body">
        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
    <!-- /.card-body -->
</div>

<script src="plugins/chart.js/Chart.min.js"></script>

<!-- page script -->
<script>
$(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    //var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var donutData = {
        labels: [
            'MALE: <?php echo json_encode($data["MalePercentage"]) ?>% ',
            'FEMALE: <?php echo json_encode($data["FemalePercentage"]) ?>% ',
        ],
        datasets: [{
            data: <?php echo json_encode($data["GenderData"]) ?> ,
            backgroundColor: ['#3c4ef0', '#ed54f0'],
        }]
    }

    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = donutData;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
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



})
</script>