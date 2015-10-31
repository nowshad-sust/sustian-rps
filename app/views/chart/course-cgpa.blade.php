@extends('layouts.default')
@section('content')
    @include('includes.alert')

    <section class="panel">
        <header class="panel-heading tab-bg-dark-navy-blue">
            <ul class="nav nav-tabs nav-justified ">
                <li>
                    <a href="{{route('chart.course-grade')}}" aria-expanded="true">
                        Course vs Grade
                    </a>
                </li>
                <li class="active">
                    <a href="#" aria-expanded="false">
                        Course vs CGPA & GPA
                    </a>
                </li>
                <li class="">
                    <a href="{{route('chart.class-cgpa')}}" aria-expanded="false">
                        Class Stat
                    </a>
                </li>
                <li class="">
                    <a href="{{route('chart.semester-cgpa')}}" aria-expanded="false">
                        Semester CGPA
                    </a>
                </li>
            </ul>
        </header>
        @if($courseList!=null && $grades!=null && $cgpa!=null)
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active" id="popular">
                        <article class="media">
                            <h4 class="text-center">CGPA Chart</h4>
                            <h5 class="text-center">(course vs cgpa)</h5>
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

    <script>
        (function() {
            var data = {
                labels: {{ json_encode($courseList) }},
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
                        label: "Grade",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: {{ json_encode($grades) }}
                    }
                ]
            };
            var ctx = document.getElementById('myChart').getContext('2d');
            var myLineChart = new Chart(ctx).Line(data, { bezierCurve: false,
                multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"});
            //var myBarChart = new Chart(ctx).Bar(data, { bezierCurve: false});
            myLineChart.generateLegend();

        })();
    </script>

@stop