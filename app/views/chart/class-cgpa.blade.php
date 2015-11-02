@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <section class="panel">
        @include('includes.chartmenu')

        @if($data!=null && $categories!=null && $user_number!=null)
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active" id="popular">
                        <article class="media">
                            <div class="labeled-chart-container">
                                <div class="canvas-holder">
                                    <h4 class="text-center">Class CGPA Population</h4>
                                    <canvas id="myChart" ></canvas>
                                </div>
                            </div>
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
    </section>

@stop

@section('style')
    <style type="text/css">
        canvas {
            display: block;
            padding: 0;
            margin: 0 auto;

            background-color:whitesmoke;
            width: 70%;
            height: auto;
        }
    </style>

@stop


@section('script')
    {{HTML::script('js/Chart.min.js')}}

    <script>
        (function() {
            var data = {{ json_encode($data) }}
            var ctx = document.getElementById('myChart').getContext('2d');
            /*var myPieChart = new Chart(ctx).Pie(data, { bezierCurve: false,
                animateScale: true,
                multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"});
            */
            var doughnutChartWithCustomLegend = new Chart(ctx).Doughnut(data,{tooltipTemplate:"<%=label%>: <%=value%>"});

            legend(document.getElementById("doughnutChartCustomLegend"), data, doughnutChartWithCustomLegend, "<%=label%>: <%=value%>");

        })();

    </script>

@stop