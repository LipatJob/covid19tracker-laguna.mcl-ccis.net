<?php
include "../repository/cachedqueries.php";
$data = getCachedCasesByAgeGroup($_GET["location"]);
?>


<div class="card card-danger2">
    <div class="card-header">
        <h3 class="card-title" style="color: white;">CASES BY AGE GROUP</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="confirmPie"
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
            '0-9 yrs old',
            '10-19 yrs old',
            '20-29 yrs old',
            '30-39 yrs old',
            '40-49 yrs old',
            '50-59 yrs old',
            '60-69 yrs old',
            '70-79 yrs old',
            '80 and Above'
        ],
        datasets: [{
            data: <?php echo json_encode($data["Total"]) ?> ,
            backgroundColor: ['#c2edf', '#a4e2fc','#75d6ff','#5ecfff','#30c1ff','#14b9ff','#00a8f0','#0293d1','#0072a3'],
        }]
    }

    var pieChartCanvas = $('#confirmPie').get(0).getContext('2d')
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
