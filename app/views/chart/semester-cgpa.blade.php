@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <section class="panel">
        @include('includes.chartmenu')

    @if($semesters!=null && $semestersGPA!=null && $cgpa!=null)
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active" id="popular">
                        <article class="media">
                            <h4 class="text-center">CGPA & GPA</h4>
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
    </section>

@stop

@section('style')
    <style type="text/css">
        canvas {
            display: block;
            padding: 0;
            margin: 0 auto;

            background-color:whitesmoke;
            width: 90%;
            height: auto;
        }
    </style>

@stop


@section('script')
    {{HTML::script('js/Chart.min.js')}}
    {{HTML::script('js/jquery-1.11.3.min.js')}}


    <script>
        (function() {
            var data = {
                labels: {{ json_encode($semesters) }},
                //labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "CGPA",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: {{ json_encode($cgpa) }}
                    },
                    {
                        label: "GPA",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: {{ json_encode($semestersGPA) }}
                    }
                ]
            };
            var ctx = document.getElementById('myChart').getContext('2d');
            var myLineChart = new Chart(ctx).Line(data, { bezierCurve: false,
                multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>",
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
            });
            myLineChart.generateLegend();
        })();
    </script>

@stop