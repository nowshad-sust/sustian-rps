@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <section class="panel">
        @include('includes.chartmenu')
        <div class="row">
        @if($courseList!=null||$grades!=null)
        <div class="col-lg-11">
        <div class="panel-body">
            <div class="tab-content tasi-tab">
                <div class="tab-pane active" id="popular">
                    <article class="media">
                        <h4 class="text-center">Result Chart</h4>
                        <h5 class="text-center">(course vs grade)</h5>
                        <canvas id="myChart" ></canvas>
                    </article>
                </div>
            </div>
        </div>
            @else
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active" id="popular">
                        <article class="media">
                            <h4 class="text-center">you don't have enough data to populate the graph</h4>
                        </article>
                    </div>
                </div>
            </div>
            @endif
          </div>
        </div>
    </section>

@stop

@section('style')
    <style type="text/css">
        canvas {
            display: block;
            padding: 0;
            margin: 0 auto;

            background-color:whitesmoke;
            width: 80%;
            height: auto;
        }
    </style>

@stop


@section('script')
    {{HTML::script('js/Chart.min.js')}}

    <script>
        (function() {
            var data = {
                labels: {{ json_encode($courseList) }},
                //labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Grade",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: {{ json_encode($grades) }}
                    }
                ]
            };
            var ctx = document.getElementById('myChart').getContext('2d');
            //var myLineChart = new Chart(ctx).Line(data, { bezierCurve: false});
            var myBarChart = new Chart(ctx).Bar(data, { bezierCurve: true,
                responsive: true,
                multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"});

        })();
    </script>

@stop
