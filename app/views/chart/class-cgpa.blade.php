@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <section class="panel">
        @include('includes.chartmenu')
        <div class="row">
        <div class="col-lg-10">
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
      </div>
      <div class="col-lg-2">
        <div class="panel-body">
            <div class="tab-content tasi-tab">
                <div class="tab-pane active" id="popular">

                    <article class="media">
                      @foreach($data as $singledata)
                      <div style="width: 15px;
                                  height: 15px;
                                  background-color: {{ $singledata['color']}};
                                  border: solid 1px silver;">
                      </div>
                    <h5>{{ $singledata['label']}}: {{ $singledata['value'] }} people</h5>
                    <br>
                      @endforeach
                    </article>
                </div>
            </div>
        </div>
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
            var doughnutChartWithCustomLegend = new Chart(ctx).Doughnut(data,{
                bezierCurve: false,
                responsive: true,
                multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
            });

            legend(document.getElementById("doughnutChartCustomLegend"), data, doughnutChartWithCustomLegend, "<%=label%>: <%=value%>");

        })();

    </script>

@stop
