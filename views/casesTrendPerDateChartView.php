<?php
include "../repository/cachedqueries.php";

$data = getCachedCurrentTrend($_GET["location"]);
?>

<style>

@media screen and (max-width: 900px) {
    #navButtonContainer{
        margin-right: 100px
    }
}
    
</style>

<div class="card card-danger2">
    <div class="card-header">
        <div class="pt-1">
            <div id = "navButtonContainer" class="btn-group btn-group-toggle float-lg-right float-sm-left"  data-toggle="buttons">
                <button type="button" id='toggleTrendCasesChart' class="btn btn-sm btn-primary" value="graph">SHOW MOVING AVERAGES</button>
            </div>
            <h3 class="card-title mt-1 ml-1 float-lg-left float-sm-right" style="color: white;">NEW CONFIRMED CASES</h3>
        </div>

    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="currentTrendCanvas"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>


<!-- ChartJS -->
<!--<script src="plugins/chart.js/Chart.min.js"></script>-->


<script>
$(function() {

    var movingAverageData = [{
            label: 'MOVING AVERAGE',
            type: 'line',
            borderColor: '#79a5b8',
            pointRadius: true,
            pointColor: '#79a5b8',
            pointHighlightStroke: '#79a5b8',
            lineTension: 0,
            data: <?php echo json_encode($data["MovingAverage"]) ?>
        }
        ];
    var rawData = [{
            label: 'NEW CASES',
            type: 'bar',
            backgroundColor: '#080E85',
            borderColor: '#080E85',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: '#ffcc00',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#ffcc00',
            data: <?php echo json_encode($data["NewCases"]) ?>
        }];

    var areaChartData = {

        labels: <?php echo json_encode($data["dates"]) ?> ,
        datasets: [
        {
            label: 'NEW CASES',
            type: 'bar',
            backgroundColor: '#080E85',
            borderColor: '#080E85',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: '#ffcc00',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#ffcc00',
            data: <?php echo json_encode($data["NewCases"]) ?>
        }
        ]
    }


    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            labels: {
                filter: function(item, chart) {
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
                    display: true,
                }
            }]
        }
    }


    var lineChartCanvas = $('#currentTrendCanvas').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    //lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
        type: 'bar',
        data: lineChartData,
        options: lineChartOptions
    })

    var isMovingAverage = false;
    $("#toggleTrendCasesChart").on("click", function() {
        if(isMovingAverage){
            $("#toggleTrendCasesChart").text("SHOW MOVING AVERAGE");
            isMovingAverage = false;
            lineChart.data.datasets = rawData;
        }else{
            $("#toggleTrendCasesChart").text("SHOW DAILY NEW CASES");
            isMovingAverage = true;
            lineChart.data.datasets = movingAverageData;

        }
        lineChart.update();
   });


})
</script>