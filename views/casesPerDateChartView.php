<?php
include "../repository/cachedqueries.php";
$data = getCachedCasesPerDate($_GET["location"]);
$dataTrend = getCachedCurrentTrend($_GET["location"]);
?>


<div class="card card-danger2">
    <div class="card-header">
        <div class="pt-1">
            <div style="" class="btn-group btn-group-toggle float-lg-right float-sm-left" data-toggle="buttons">
                <button type="button" id='toggleCasesChart' class="btn btn-sm btn-primary" value="graph">SWITCH TO LOGARITHMIC</button>
            </div>
            <h3 class="card-title mt-1 ml-1 float-lg-left float-sm-right" style="color: white;">CUMULATIVE CONFIRMED AND ACTIVE CASES</h3>

        </div>

    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<!--<script src="plugins/chart.js/Chart.min.js"></script>-->

<script>
    $(function() {

    })

    $(document).ready(function() {
        var flag = false;
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
            labels: <?php echo json_encode($data["Dates"]) ?>,
            datasets: [{
                label: 'CONFIRMED',
                type: 'line',
                lineTension: 0,
                backgroundColor: '#1988C8',
                borderColor: '#1988C8',
                pointRadius: true,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188, .5)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188, .5)',
                data: <?php echo json_encode($data["TotalPositiveCases"]) ?>
            }, {
                label: 'ACTIVE CASES',
                type: 'line',
                lineTension: 0,
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
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'index',
                intersect: false
            },
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
                    type: 'linear',
                    stacked: false,
                    ticks: {
                        //beginAtZero: true,
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

        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
        var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
        var lineChartData = jQuery.extend(true, {}, areaChartData)
        lineChartData.datasets[0].fill = false;
        lineChartData.datasets[1].fill = true;
        lineChartOptions.datasetFill = false;

        $("#toggleCasesChart").click(function() {
            if (flag == false) {
                lineChart.options.scales.yAxes = [{
                    /*
                    stacked: false,
                    ticks: {
                        //beginAtZero: true,
                        //suggestedMax: 5,
                        
                        callback: function(value) {
                            if (value % 1 === 0) {
                                return value;
                            }
                        }
                        
                        
                    },
                    */
                    type: 'logarithmic',
                    position: 'left',
                    ticks: {
                        min: 0.1, //minimum tick
                        max: 1000, //maximum tick
                        callback: function(value, index, values) {
                            return Number(value.toString()); //pass tick values as a string into Number function
                        }
                    },
                    afterBuildTicks: function(chartObj) { //Build ticks labelling as per your need
                        chartObj.ticks = [];
                        chartObj.ticks.push(0);
                        chartObj.ticks.push(1);
                        chartObj.ticks.push(10);
                        chartObj.ticks.push(100);
                        chartObj.ticks.push(1000);
                    },
                    gridLines: {
                        display: true,
                    }
                }];
                $("#toggleCasesChart").html("SWITCH TO LINEAR");
                flag = true;
            } else {
                lineChart.options.scales.yAxes = [{
                    type: 'linear',
                    stacked: false,
                    ticks: {
                        //beginAtZero: true,
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
                }];
                $("#toggleCasesChart").html("SWITCH TO LOGARITHMIC");
                flag = false;
            }


            lineChart.update();
        });

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })
    });
</script>