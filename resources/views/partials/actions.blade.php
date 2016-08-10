@if($actions->count() > 0)
<ul class="list-group">
    @foreach($actions as $action)
    <li class="list-group-item action" data-action-id="{{ $action->id }}">
        <div class="row">
            <div class="col-xs-12">
                <strong>
                    {{ $action->name }}
                    @if($action->description)
                    <i class="ion ion-ios-help-outline" data-toggle="tooltip" data-title="{{ $action->description }}"></i>
                    @endif
                </strong>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <canvas id="action-{{ $action->id }}" data-start-at="{{ $action->start_at }}" data-completion-latency="{{ $action->completion_latency }}" data-action-id="{{ $action->id }}" height="160" width="600"></canvas>
            </div>
        </div>
    </li>
    @endforeach
</ul>
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

            chart.chart = new Chart(chart.context, {
                type: 'line',
                data: {
                    labels: _.map(chartData, function (data) {
                        return data.completed_at;
                    }),
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
                                autoSkip: false,
                                callback: function (value, index, values) {
                                    var keys = _.keys(data)

                                    return data[keys[index]].completed_at;
                                }
                            }
                        }],
                        xAxes: [{
                            display: false,
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var startAt = $el.data('start-at')

                                return moment(startAt).add(tooltipItem.yLabel, 's').format('h:mm');
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
