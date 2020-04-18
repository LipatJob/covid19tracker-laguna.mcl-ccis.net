<?php
include "../repository/queries.php";
$data = getDeceasedPerDate($_GET["location"]);
?>


<div class="card card-danger2">
    <div class="card-header">
        <h3 class="card-title" style="color: white;">DECEASED PER DATE</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="decChart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<script src="plugins/chart.js/Chart.min.js"></script>
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

    var areaChartData = {
        labels: <?php echo json_encode($data["Dates"]) ?> ,
        datasets: [{
            label: 'DECEASED',
            type: 'bar',
            backgroundColor: 'rgb(128,128,128,1)',
            borderColor: 'rgb(128,128,128,1)',
            pointRadius: true,
            pointColor: 'rgb(128,128,128,1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgb(128,128,128,1)',
            data: <?php echo json_encode($data["Deceased"]) ?>
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
                    display: false,
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
                    display: false,
                }
            }]
        }
    }


    var lineChartCanvas = $('#decChart').get(0).getContext('2d')
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