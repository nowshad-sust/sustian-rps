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
                        Course vs CGPA
                    </a>
                </li>
                <li class="">
                    <a href="#recent" aria-expanded="false">
                        Recents
                    </a>
                </li>
            </ul>
        </header>
        <div class="panel-body">
            <div class="tab-content tasi-tab">
                <div class="tab-pane active" id="popular">
                    <article class="media">
                        <h3 class="text-center">Result Chart</h3>
                        <h5 class="text-center">(course vs cgpa)</h5>
                        <canvas id="myChart" ></canvas>
                    </article>
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
                        label: "My result dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: {{ json_encode($cgpa) }}
                    }
                ]
            };
            var ctx = document.getElementById('myChart').getContext('2d');
            var myLineChart = new Chart(ctx).Line(data, { bezierCurve: false});
            //var myBarChart = new Chart(ctx).Bar(data, { bezierCurve: false});

        })();
    </script>

@stop