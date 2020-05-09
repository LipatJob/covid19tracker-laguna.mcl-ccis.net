<?php
include "../repository/cachedqueries.php";

$data = getCachedCurrentTrend($_GET["location"]);
?>

<style>


    
</style>

<div class="card card-danger2">
    <div class="card-header">
        <div class="">
        <h3 class="card-title mt-2 mb-2" style="color: white; height: 19px">NEW CONFIRMED CASES AND 7-DAY MOVING AVERAGES</h3>
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
    var debugMode = false;
    var areaChartData = {

        labels: <?php echo json_encode($data["dates"]) ?> ,
        datasets: [
            {
            label: 'MOVING AVERAGE',
            type: 'line',
            borderColor: '#969ad9',
            pointRadius: true,
            pointColor: '#969ad9',
            pointHighlightStroke: '#969ad9',
            lineTension: 0,
            data: <?php echo json_encode($data["MovingAverage"]) ?>
        },
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

/*
var dataToTable = function (dataset) {
    var html = '<table>';
    html += '<thead><tr><th style="width:120px;">#</th>';
    
    var columnCount = 0;
    jQuery.each(dataset.datasets, function (idx, item) {
        html += '<th style="background-color:' + item.fillColor + ';">' + item.label + '</th>';
        columnCount += 1;
    });

    html += '</tr></thead>';

    jQuery.each(dataset.labels, function (idx, item) {
        html += '<tr><td>' + item + '</td>';
        for (i = 0; i < columnCount; i++) {
            html += '<td style="background-color:' + dataset.datasets[i].fillColor + ';">' + (dataset.datasets[i].data[idx] === '0' ? '-' : dataset.datasets[i].data[idx]) + '</td>';
        }
        html += '</tr>';
    });

    html += '</tr><tbody></table>';

    return html;
};

if(debugMode){
    jQuery('#checkData').html(dataToTable(lineChart.data));
}
*/

});




</script>


<div id="checkData">

</div>