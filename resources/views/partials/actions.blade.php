@if($actions->count() > 0)
@foreach($actions as $action)
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>
            {{ $action->name }}
            @if($action->description)
            <i class="ion ion-ios-help-outline" data-toggle="tooltip" data-title="{{ $action->description }}"></i>
            @endif
        </strong>
    </div>
    <div class="panel-body">
        <canvas id="action-{{ $action->id }}" data-start-at="{{ $action->start_at }}" data-completion-latency="{{ $action->completion_latency }}" data-action-id="{{ $action->id }}" height="160" width="600"></canvas>
    </div>
</div>
@endforeach
<script>
(function () {
    Chart.defaults.global.elements.point.hitRadius = 10;
    Chart.defaults.global.responsiveAnimationDuration = 1000;
    Chart.defaults.global.legend.display = false;

    var charts = {};

    $('canvas[data-action-id]').each(function() {
        drawChart($(this));
    });

    function drawChart($el) {
        var actionId = $el.data('action-id');

        if (typeof charts[actionId] === 'undefined') {
            charts[actionId] = {
                context: document.getElementById("action-"+actionId).getContext("2d"),
                chart: null,
            };
        }

        var chart = charts[actionId];

        $.getJSON('/actions/'+actionId).done(function (result) {
            var data = result.data.items;

            if (chart.chart !== null) {
                chart.chart.destroy();
            }

            var chartData = _.values(data);

            var yLabels = _.map(chartData, function (data) {
                return data.completed_at;
            });

            console.log(yLabels)

            chart.chart = new Chart(chart.context, {
                type: 'line',
                data: {
                    labels: yLabels,
                    datasets: [{
                        lineTension: 0,
                        data: _.map(chartData, function (data) {
                            return data.time_taken;
                        }),
                        fill: false,
                        backgroundColor: "{{ $theme_metrics }}",
                        borderColor: "{{ color_darken($theme_metrics, -0.1) }}",
                        pointBackgroundColor: "{{ color_darken($theme_metrics, -0.1) }}",
                        pointBorderColor: "{{ color_darken($theme_metrics, -0.1) }}",
                        pointHoverBackgroundColor: "{{ color_darken($theme_metrics, -0.2) }}",
                        pointHoverBorderColor: "{{ color_darken($theme_metrics, -0.2) }}",
                    }, {
                        lineTension: 0,
                        data: Array.from({ length: chartData.length }, function () { return $el.data('completion-latency'); }),
                        fill: false,
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                callback: function (value, index, values) {
                                    var keys = _.keys(data).reverse()

                                    return data[keys[index]].completed_at;
                                }
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                callback: function (value, index, values) {
                                    return _.keys(data)[index]
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            beforeLabel: function (tooltipItem, data) {
                                return 'Completed at: '+ data.labels[tooltipItem.index];
                            },
                            label: function(tooltipItem, data) {
                                var startAt = $el.data('start-at');

                                // We can safely assume use of index 0
                                return 'Target completion time: ' + moment(startAt).add(data.datasets[1].data[0], 's').format('h:mm');
                            }
                        }
                    }
                }
            });
        });
    }
}());
</script>
@endif
