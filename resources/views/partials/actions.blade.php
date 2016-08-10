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
                <canvas id="action-{{ $action->id }}" data-action-id="{{ $action->id }}" height="160" width="600"></canvas>
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

            console.log(data);

            chart.chart = new Chart(chart.context, {
                type: 'line',
                data: {
                    labels: _.keys(data),
                    datasets: [{
                        data: _.values(data),
                        fill: false,
                        backgroundColor: "{{ $theme_metrics }}",
                        borderColor: "{{ color_darken($theme_metrics, -0.1) }}",
                        pointBackgroundColor: "{{ color_darken($theme_metrics, -0.1) }}",
                        pointBorderColor: "{{ color_darken($theme_metrics, -0.1) }}",
                        pointHoverBackgroundColor: "{{ color_darken($theme_metrics, -0.2) }}",
                        pointHoverBorderColor: "{{ color_darken($theme_metrics, -0.2) }}",
                        spanGaps: false,
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            type: 'time',
                            time: {
                                // unit: 'YYYY-MM-DD HH:mm'
                                displayFormats: {
                                    millisecond: 'YYYY-MM-DD HH:mm',
                                    second: 'YYYY-MM-DD HH:mm',
                                    minute: 'YYYY-MM-DD HH:mm',
                                    hour: 'YYYY-MM-DD HH:mm',
                                    day: 'YYYY-MM-DD HH:mm',
                                    week: 'YYYY-MM-DD HH:mm',
                                    month: 'YYYY-MM-DD HH:mm',
                                    quarter: 'YYYY-MM-DD HH:mm',
                                    year: 'YYYY-MM-DD HH:mm',
                                }
                            }
                        }]
                    }
                }
            });
        });
    }
}());
</script>
@endif
