<?php
    include "../repository/cachedqueries.php";
    $data = getCachedRecoveredPerDate($_GET["location"]);
    $dataDeceased = getCachedDeceasedPerDate($_GET["location"]);
    $summary = getCachedSummary($_GET["location"]);
    $dataCases = getCachedCasesPerDate($_GET["location"]);
    $recoveryPercent = [];
    $deceasedPercent = [];

    for ($i = 0; $i < count($data['CumulativeRecovered']); $i++) {
        if ($summary['ConfirmedCases'] != 0) {
            $recoveryPercent[$i] = number_format(($data['CumulativeRecovered'][$i] / $summary['ConfirmedCases']) * 100, 2, '.', '');
            $deceasedPercent[$i] = number_format(($dataDeceased['CumulativeDeceased'][$i] / $summary['ConfirmedCases']) * 100, 2, '.', '');
        }
        else {
            $recoveryPercent[$i] = 0;
            $deceasedPercent[$i] = 0;
        }
    }

    array_shift($recoveryPercent);
    array_shift($deceasedPercent);
?>

<div class="card card-danger2">
    <div class="card-header">
        <h3 class="card-title" style="color: white;">CUMULATIVE RECOVERED AND DECEASED CASES</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="recovChart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>



<!--<script src="plugins/chart.js/Chart.min.js"></script>-->

<script>
$(function() {

    var areaChartData = {
        labels: <?php echo json_encode($data["Dates"]) ?> ,
        datasets: [/*{
            label: 'RECOVERY RATE',
            type: 'line',
            backgroundColor: 'rgba(42, 187, 155, 1)',
            borderColor: 'rgba(42, 187, 155, 1)',
            pointRadius: true,
            pointColor: 'rgba(42, 187, 155, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(42, 187, 155, 1)',
            data: <?php echo json_encode($recoveryPercent) ?>
        },{
            label: 'DEATH RATE',
            type: 'line',
            backgroundColor: '#7d7d7d',
            borderColor: '#7d7d7d',
            pointRadius: true,
            pointColor: 'rgba(42, 187, 155, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(42, 187, 155, 1)',
            data: <?php echo json_encode($deceasedPercent) ?>
        },*/
        {
            label: 'DECEASED CASES',
            type: 'line',
            backgroundColor: '#7d7d7d',
            borderColor: '#7d7d7d',
            pointRadius: true,
            pointColor: 'rgba(42, 187, 155, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(42, 187, 155, 1)',
            data: <?php echo json_encode($dataDeceased['CumulativeDeceased']) ?>
        },{
            label: 'RECOVERED CASES',
            type: 'line',
            backgroundColor: 'rgba(42, 187, 155, 1)',
            borderColor: 'rgba(42, 187, 155, 1)',
            pointRadius: true,
            pointColor: 'rgba(42, 187, 155, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(42, 187, 155, 1)',
            data: <?php echo json_encode($data['CumulativeRecovered']) ?>
        }/*,{
            label: 'CONFIRMED',
            type: 'line',
            backgroundColor: '#1988C8',
            borderColor: '#1988C8',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188, .5)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188, .5)',
            data: <?php echo json_encode($dataCases["TotalPositiveCases"]) ?>
        }*/
        ]
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
                gridLines: {
                    display: false
                    
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    //suggestedMax: 30,
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
    lineChartData.datasets[0].fill = true;
    lineChartData.datasets[1].fill = true;
    //lineChartData.datasets[2].fill = true;
    lineChartOptions.datasetFill = false;

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    })


})
</script>