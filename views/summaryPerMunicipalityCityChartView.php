<?php
include "../repository/queries.php";
$data = getSummaryPerCityMunicipalityChart($_GET["location"]);
?>



    <div class="card-body">
        <div class="chart">
            <canvas id="barChart2"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>

    <script src="plugins/chart.js/Chart.min.js"></script>

    <script>
    $(function() {

        var areaChartData = {
            labels: <?php echo json_encode($data["Locals"])?> ,
            datasets: [{
                    label: 'TOTAL POSITIVE CASES',
                    backgroundColor: 'rgba(60,141,188,0.5)',
                    borderColor: 'rgba(60,141,188,0.5)',
                    pointRadius: true,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188, .5)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188, .5)',
                    data: <?php echo json_encode($data["TotalPositiveCases"])?>
                },

                {
                    label: 'RECOVERED',
                    backgroundColor: 'rgba(42, 187, 155, 1)',
                    borderColor: 'rgba(42, 187, 155, 1)',
                    pointRadius: true,
                    pointColor: 'rgba(42, 187, 155, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(42, 187, 155, 1)',
                    data: <?php echo json_encode($data["Recovered"])?>
                }, {
                    label: 'DECEASED',
                    backgroundColor: 'rgb(128,128,128,1)',
                    borderColor: 'rgb(128,128,128,1)',
                    pointRadius: true,
                    pointColor: 'rgb(128,128,128,1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgb(128,128,128,1)',
                    data: <?php echo json_encode($data["Deceased"])?>
                },
            ]
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
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }



        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
                onClick: function(e, legendItem) {
                    var index = legendItem.datasetIndex;
                    var ci = this.chart;
                    var alreadyHidden = (ci.getDatasetMeta(index).hidden === null) ? false : ci
                        .getDatasetMeta(index).hidden;

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
                    stacked: true,
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    stacked: true,
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
        var barChartCanvas = $('#barChart2').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        var temp2 = areaChartData.datasets[2]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0
        barChartData.datasets[2] = temp2

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: areaChartOptions
        })

    });
    </script>