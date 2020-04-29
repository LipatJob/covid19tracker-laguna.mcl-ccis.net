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
            <canvas id="stackedBarChart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>


<!--<script src="plugins/chart.js/Chart.min.js"></script>-->

<!-- page script -->
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
        /*labels: ['0-9 yrs old', '10-19 yrs old', '20-29 yrs old', '30-39 yrs old', '40-49 yrs old',
            '50-59 yrs old', '60-69 yrs old', '70-79 yrs old', '80+ yrs old', 'NOT SPECIFIED'
        ]*/
        labels: ['0-19 yrs old', '20-39 yrs old', '40-59 yrs old', '60-79 yrs old', '80+ yrs old' ],
        datasets: [{
                label: 'RECOVERED',
                backgroundColor: 'rgba(42, 187, 155, 1)',
                borderColor: 'rgb(128,128,128,1)',
                pointRadius: false,
                pointColor: 'rgba(42, 187, 155, 1)',
                pointStrokeColor: 'rgba(42, 187, 155, 1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(42, 187, 155, 1)',
                data: <?php echo json_encode($data["RecoveredPercentage"]) ?>
            },
            {
                label: 'DECEASED',
                backgroundColor: 'rgb(128,128,128,1)',
                borderColor: 'rgb(128,128,128,1)',
                pointRadius: false,
                pointColor: 'rgb(128,128,128,1)',
                pointStrokeColor: '#4d7bfa',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgb(128,128,128,1)',
                data: <?php echo json_encode($data["DeceasedPercentage"]) ?>
            },
            {
                label: 'ACTIVE CASES',
                backgroundColor: 'rgba(0,128,128, 0.8)',
                borderColor: 'rgba(0,128,128, 0.8)',
                pointRadius: false,
                pointColor: 'rgba(0,128,128, 0.8)',
                pointStrokeColor: 'rgba(0,128,128, 0.8)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(0,128,128, 0.8)',
                data: <?php echo json_encode($data["CurrentPercentage"]) ?>
            },

            {
                label: 'Total',
                backgroundColor: 'rgb(128,128,128,1)',
                borderColor: 'rgb(128,128,128,1)',
                pointRadius: false,
                pointColor: 'rgb(128,128,128,1)',
                pointStrokeColor: '#4d7bfa',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgb(128,128,128,1)',
                data: <?php echo json_encode($data["Total"]) ?>
            }
        ]
    }

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        labels: {
          filter: function(item, chart) {
            // Logic to remove a particular legend item goes here
            return !item.text.includes('Total');
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
                meta.hidden = null;
              }
            } else if (i === index) {
              meta.hidden = null;
            }
          });
          ci.getDatasetMeta(3).hidden = true;
          ci.update();

        }
      },
      datasetFill: false,
      tooltips: {
        mode: 'label',
        callbacks: {
          label: function(tooltipItem, data) {
            return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] + '%';
          },
          afterLabel: function(tooltipItem, data) {
            return "COUNT: " + Math.round(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] * data.datasets[3].data[tooltipItem.index] / 100);
          }
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
            min: 0,
            suggestedMax: 5,
            callback: function(value) {
              return value + "%"
            },
            max: 100
          },
          scaleLabel: {
            display: true,
            labelString: "Percentage"
          },
          gridLines: {
            display: false,
          }
        }]
      }

    }


    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, areaChartData)


    var stackedBarChart = new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: barChartOptions
    })

    stackedBarChart.getDatasetMeta(3).hidden = true;
    stackedBarChart.defaults.global.legend[3].display = false
    stackedBarChart.update();
})
</script>
