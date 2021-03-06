<?php
include "../repository/cachedqueries.php";
$data = getCachedCasesByAgeGroup($_GET["location"]);
?>


<div class="card card-danger2">
    <div class="card-header">
        <h3 class="card-title" style="color: white;">DECEASED CASES BY AGE GROUP</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="decPie"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>


<!--<script src="plugins/chart.js/Chart.min.js"></script>-->

<!-- page script -->
<script>
$(function() {
    var donutData = {
        labels: [
            '0-19 yrs old',
            '20-39 yrs old',
            '40-59 yrs old',
            '60-79 yrs old',
            '80 yrs old and Above'
        ],
        datasets: [{
            data: <?php echo json_encode($data["DeceasedCount"]) ?> ,
            backgroundColor: ['#f4f4f4', '#d5d5d5','#979797','#4a4a4a','#1c1c1c'],
        }]
    }

    var pieChartCanvas = $('#decPie').get(0).getContext('2d')
    var pieData = donutData;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            position: 'left'
        }
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
