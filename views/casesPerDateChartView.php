<?php
include "../repository/cachedqueries.php";
$data = getCachedCasesPerDate($_GET["location"]);
$dataTrend = getCachedCurrentTrend($_GET["location"]);
?>


<div class="card card-danger2">
    <div class="card-header">
        <h3 class="card-title" style="color: white;">CONFIRMED AND ACTIVE CASES</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="lineChart"
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
            label: 'CONFIRMED',
            type: 'line',
            backgroundColor: '#6BC9FF',
            borderColor: '#1988C8',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188, .5)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188, .5)',
            data: <?php echo json_encode($data["TotalPositiveCases"]) ?>
        },{
            label: 'ACTIVE CASES',
            type: 'bar',
            backgroundColor: '#008080',
            borderColor: '#008080',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: '#ffcc00',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#ffcc00',
            data: <?php echo json_encode($dataTrend["ActiveCases"]) ?>
        }]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            labels: {
                filter: function(item, chart) {
                    // Logic to remove a particular legend item goes here
                    return !item.text.includes('line');
                }
            },
            onClick: function(e, legendItem) {
                var index = legendItem.datasetIndex;
                var ci = this.chart;
                var alreadyHidden = (ci.getDatasetMeta(index).hidden === null) ? false : ci
                    .getDatasetMeta(index).hidden;
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
                stacked: false,
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                stacked: false,
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


    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
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