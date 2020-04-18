<?php
include "../repository/queries.php";
$data = getRecoveredPerDate($_GET["location"]);
$dataDeceased = getDeceasedPerDate(($_GET["location"]));
?>



<div class="card card-danger2">
    <div class="card-header">
        <h3 class="card-title" style="color: white;">RECOVERY VERSUS DEATH PER DATE</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="recovChart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>



<script src="plugins/chart.js/Chart.min.js"></script>

<script>
$(function() {

    var areaChartData = {
        labels: <?php echo json_encode($data["Dates"]) ?> ,
        datasets: [{
            label: 'RECOVERED',
            type: 'bar',
            backgroundColor: 'rgba(42, 187, 155, 1)',
            borderColor: 'rgba(42, 187, 155, 1)',
            pointRadius: true,
            pointColor: 'rgba(42, 187, 155, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(42, 187, 155, 1)',
            data: <?php echo json_encode($data["Recovered"]) ?>
        },{
            label: 'DECEASED',
            type: 'bar',
            backgroundColor: '#7d7d7d',
            borderColor: '#7d7d7d',
            pointRadius: true,
            pointColor: 'rgba(42, 187, 155, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(42, 187, 155, 1)',
            data: <?php echo json_encode($dataDeceased["Deceased"]) ?>
        }]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false
                    
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    suggestedMax: 5,
                    callback: function(value) {
                        if (value % 1 === 0) {
                            return value;
                        }
                    }
                },
                gridLines: {
                    display: true
                    
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
        type: 'bar',
        data: lineChartData,
        options: lineChartOptions
    })


})
</script>