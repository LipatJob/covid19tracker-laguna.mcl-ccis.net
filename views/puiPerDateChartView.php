<?php
include "../repository/cachedqueries.php";
$data = getCachedPUIPerDate($_GET["location"]);
?>


<div class="card card-danger2">
    <div class="card-header">
        <h3 class="card-title" style="color: white;">PERSONS UNDER INVESTIGATION</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="puiCanvas"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>


<!-- ChartJS -->
<!--<script src="plugins/chart.js/Chart.min.js"></script>-->


<script>
$(function() {


    var areaChartData = {

        labels: <?php echo json_encode($data["Dates"]) ?> ,
        datasets: [{
            label: 'PROBABLE',
            type: 'bar',
            backgroundColor: '#FF7F7F',
            borderColor: '#FF7F7F',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: '#ffcc00',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#ffcc00',
            data: <?php echo json_encode($data["Probable"]) ?>
        },
        {
            label: 'SUSPECT',
            type: 'bar',
            backgroundColor: '#FF712D',
            borderColor: '#FF712D',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: '#ffcc00',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#ffcc00',
            data: <?php echo json_encode($data["Suspect"]) ?>
        },{
            label: 'TOTAL PUI',
            type: 'line',
            backgroundColor: '#CC3722',
            borderColor: '#CC3722',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: '#ffcc00',
            pointHighlightFill: '#fff',
            pointHighlightStroke: '#ffcc00',
            data: <?php echo json_encode($data["Total"]) ?>
        }]
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
                    //suggestedMax: 5,
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


    var lineChartCanvas = $('#puiCanvas').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartData.datasets[2].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
        type: 'bar',
        data: lineChartData,
        options: lineChartOptions
    })

})
</script>